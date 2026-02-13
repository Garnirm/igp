<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AddRoleToEntities extends Command
{
    protected $signature = 'add_role_to_entities';

    private string $role = 'Adjoint de chef de compagnie';

    public function handle(): int
    {
        $entities = array_merge([
            ...glob(storage_path().'/igp/generation/*/*.json'),
            ...glob(storage_path().'/igp/generation/*/*/*.json'),
            ...glob(storage_path().'/igp/generation/*/*/*/*.json'),
            ...glob(storage_path().'/igp/generation/*/*/*/*/*.json'),
            ...glob(storage_path().'/igp/generation/*/*/*/*/*/*.json'),
            ...glob(storage_path().'/igp/generation/*/*/*/*/*/*/*.json'),
        ]);

        foreach ($entities as $entity) {
            $entity_data = json_decode(File::get($entity), true);

            $this->overrideEntity($entity_data);

            File::put($entity, json_encode($entity_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }

        return Command::SUCCESS;
    }

    private function overrideEntity(array &$entity): void
    {
        foreach ($entity as $key => &$value) {
            if (in_array($key, ['materiels', 'description', 'tags', 'immobilier'])) {
                continue;
            }

            /*if ($key === 'effectifs') {
                if (!empty($value['militaires'][ 'Adjoint de chef d\'état-major' ])) {
                    data_set($value, 'militaires.'.$this->role, 1);
                }

                if (!empty($value['police'][ 'Adjoint de chef d\'état-major' ])) {
                    data_set($value, 'police.'.$this->role, 1);
                }
            } else {
                if (!empty($value['effectifs']['militaires'][ 'Adjoint de chef d\'état-major' ])) {
                    data_set($value, 'effectifs.militaires.'.$this->role, 1);
                }

                if (!empty($value['effectifs']['police'][ 'Adjoint de chef d\'état-major' ])) {
                    data_set($value, 'effectifs.police.'.$this->role, 1);
                }
            }*/

            if ($key === 'effectifs') {
                continue;
            }

            if (Str::contains($key, [ 'Compagnie' ])) {
                if (empty($value['effectifs']['militaires'][ $this->role ]) && empty($value['effectifs']['police'][ $this->role ])) {
                    data_set($value, 'effectifs.militaires.'.$this->role, 1);
                }
            }

            if (is_array($value)) {
                $this->overrideEntity($value);
            }
        }
    }
}
