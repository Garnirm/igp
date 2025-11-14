<?php

namespace App\Console\Commands;

use App\Models\Army\Establishment;
use App\Models\Army\TreeUnit;
use Illuminate\Console\Command;

class RegisterTreeUnits extends Command
{
    protected $signature = 'register:tree-units';

    public function handle(): int
    {
        $ministere_defense = Establishment::query()->where('name', 'Ministère de la défense')->first();
        $tree = json_decode(config('army.tree_units.tree'), true);

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

    private function registerUnit(string $name, array $units = [], Establishment $establishment, ?TreeUnit $parent = null)
    {
        $unit = new TreeUnit();
        $unit->name = $name;
        $unit->establishment_id = $establishment->id;
        $unit->parent_id = $parent?->id;
        $unit->save();

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
