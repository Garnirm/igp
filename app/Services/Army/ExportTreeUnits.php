<?php

namespace App\Services\Army;

use App\Models\Army\Establishment;
use App\Models\Army\Materiel;
use App\Models\Army\Role;
use App\Models\Army\TreeUnit;
use Illuminate\Support\Collection;

class ExportTreeUnits
{
    private static array $roles = [];
    private static array $materiels = [];

    public static function run(): array
    {
        $data = [];

        $primary_units = TreeUnit::query()->with('establishment')->whereNull('parent_id')->get();

        foreach ($primary_units as $unit) {
            $establishment = $unit->establishment;

            $unit_data = [];
            $unit_data['immobilier'] = $establishment->name;

            if (!empty($unit->effectifs)) {
                $unit_data['effectifs'] = (new Collection($unit->effectifs))
                    ->groupBy('category')
                    ->map(function (Collection $roles) {
                        $roles_list = [];

                        foreach ($roles as $role) {
                            if (!isset(self::$roles[ $role['role'] ])) {
                                self::$roles[ $role['role'] ] = Role::find($role['role']);
                            }

                            $roles_list[ self::$roles[ $role['role'] ]->name ] = $role['amount'];
                        }

                        return $roles_list;
                    });
            }

            if (!empty($unit->materiels)) {
                $materiels = [];

                foreach ($unit->materiels as $materiel) {
                    if (!isset(self::$materiels[ $materiel['materiel'] ])) {
                        self::$materiels[ $materiel['materiel'] ] = Materiel::find($materiel['materiel']);
                    }

                    $materiel_iteration = self::$materiels[ $materiel['materiel'] ];

                    if (!isset($materiels[ $materiel_iteration->category_name ])) {
                        $materiels[ $materiel_iteration->category_name ] = [];
                    }

                    if (!isset($materiels[ $materiel_iteration->category_name ][ $materiel_iteration->name ])) {
                        $materiels[ $materiel_iteration->category_name ][ $materiel_iteration->name ] = 0;
                    }

                    $materiels[ $materiel_iteration->category_name ][ $materiel_iteration->name ] += $materiel['amount'];
                }

                $unit_data['materiels'] = $materiels;
            }

            if (!empty($unit->tags)) {
                $unit_data['tags'] = $unit->tags;
            }

            $unit_data = self::retrieveSubUnits($unit->children()->with('establishment')->get(), $unit_data, $establishment);

            $data[ $unit->name ] = $unit_data;
        }

        return $data;
    }

    /**
     * @param Collection<TreeUnit> $units
     * @param array<string,array<string,mixed> $parent_data
     */
    private static function retrieveSubUnits(Collection $units, array $parent_data, Establishment $establishment): array
    {
        foreach ($units as $unit) {
            $establishment_iteration = $establishment;
            $unit_data = [];

            if ($establishment->name !== $unit->establishment->name) {
                $establishment_iteration = $unit->establishment;

                $unit_data['immobilier'] = $establishment_iteration->name;
            }

            if (!empty($unit->effectifs)) {
                $unit_data['effectifs'] = $unit->effectifs;
            }

            if (!empty($unit->materiels)) {
                $unit_data['materiels'] = $unit->materiels;
            }

            if (!empty($unit->tags)) {
                $unit_data['tags'] = $unit->tags;
            }

            $unit_data = self::retrieveSubUnits($unit->children()->with('establishment')->get(), $unit_data, $establishment_iteration);

            $parent_data[ $unit->name ] = $unit_data;
        }

        return $parent_data;
    }
}