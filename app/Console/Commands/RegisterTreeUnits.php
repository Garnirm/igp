<?php

namespace App\Console\Commands;

use App\Models\Army\Establishment;
use App\Models\Army\Materiel;
use App\Models\Army\Role;
use App\Models\Army\TreeUnit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RegisterTreeUnits extends Command
{
    private array $materiels = [];
    private array $roles = [];

    protected $signature = 'register:tree-units';

    public function handle(): int
    {
        $ministere_defense = Establishment::query()->where('name', 'Ministère de la défense')->first();
        $tree = json_decode(File::get(public_path('armee_igp.json')), true);

        TreeUnit::query()->forceDelete();

        foreach ($tree as $name => $units) {
            $establishment_iteration = $ministere_defense;

            if (isset($units['immobilier'])) {
                $establishment_iteration = Establishment::query()->where('name', $units['immobilier'])->first();
            }

            unset($units['immobilier']);

            $this->registerUnit($name, $units, $establishment_iteration);
        }

        return Command::SUCCESS;
    }

    private function transformEffectifs(array $effectifs = []): array
    {
        $effectifs_db = [];

        foreach ($effectifs as $category => $effectifs_list) {
            foreach ($effectifs_list as $role => $amount) {
                if (!isset($this->roles[ $role ])) {
                    $this->roles[ $role ] = Role::query()->where('name', $role)->first();
                }

                $role_id = $this->roles[ $role ]->id;

                $effectifs_db[] = [
                    'role' => $role_id,
                    'category' => $category,
                    'amount' => $amount,
                ];
            }
        }

        return $effectifs_db;
    }

    private function transformMateriels(array $materiels = []): array
    {
        $materiels_db = [];

        foreach ($materiels as $materiels_list) {
            foreach ($materiels_list as $materiel => $amount) {
                if (!isset($this->materiels[ $materiel ])) {
                    $this->materiels[ $materiel ] = Materiel::query()->where('name', $materiel)->first();
                }

                $materiel_id = $this->materiels[ $materiel ]->id;

                $materiels_db[] = [
                    'materiel' => $materiel_id,
                    'amount' => $amount,
                ];
            }
        }

        return $materiels_db;
    }

    private function registerUnit(string $name, array $units = [], Establishment $establishment, ?TreeUnit $parent = null)
    {
        $unit = new TreeUnit();
        $unit->name = $name;
        $unit->establishment_id = $establishment->id;
        $unit->parent_id = $parent?->id;

        if (isset($units['effectifs'])) {
            $unit->effectifs = self::transformEffectifs($units['effectifs']);
        }

        if (isset($units['materiels'])) {
            $unit->materiels = self::transformMateriels($units['materiels']);
        }

        $unit->save();

        unset($units['effectifs']);
        unset($units['materiels']);

        foreach ($units as $name_unit => $sub_units) {
            $establishment_iteration = $establishment;

            if (isset($sub_units['immobilier'])) {
                $establishment_iteration = Establishment::query()->where('name', $sub_units['immobilier'])->first();
            }

            unset($sub_units['immobilier']);

            $this->registerUnit($name_unit, $sub_units, $establishment_iteration, $unit);
        }
    }
}
