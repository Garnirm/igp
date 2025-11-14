<?php

namespace App\Services\Army;

use App\Models\Army\Establishment;
use App\Models\Army\TreeUnit;
use Illuminate\Support\Collection;

class ExportTreeUnits
{
    public static function run(): array
    {
        $data = [];

        $primary_units = TreeUnit::query()->with('establishment')->whereNull('parent_id')->get();

        foreach ($primary_units as $unit) {
            $establishment = $unit->establishment;

            $unit_data = [];
            $unit_data['immobilier'] = $establishment->name;

            $unit_data = self::retrieveSubUnits($unit->children()->with('establishment')->get(), $unit_data, $establishment);

            $data[ $unit->name ] = $unit_data;
        }

        return $data;
    }

    private static function retrieveSubUnits(Collection $units, array $parent_data, Establishment $establishment): array
    {
        foreach ($units as $unit) {
            $establishment_iteration = $establishment;
            $unit_data = [];

            if ($establishment->name !== $unit->establishment->name) {
                $establishment_iteration = $unit->establishment;

                $unit_data['immobilier'] = $establishment_iteration->name;
            }

            $unit_data = self::retrieveSubUnits($unit->children()->with('establishment')->get(), $unit_data, $establishment_iteration);

            $parent_data[ $unit->name ] = $unit_data;
        }

        return $parent_data;
    }
}