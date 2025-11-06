<?php

namespace App\Honey\Resources;

use App\Honey\Resources\FederalStateResource\Routes\FederalStateIndex;
use Honey\Resource\ResourceRoute;

class FederalStateResource
{
    public static string $id = 'federal_state';

    /**
     * @return array<ResourceRoute>
     */
    public static function routes(): array
    {
        return [
            ResourceRoute::make(path: '/', name: 'index', page: FederalStateIndex::class),
        ];
    }
}