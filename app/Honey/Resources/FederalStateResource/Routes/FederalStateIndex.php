<?php

namespace App\Honey\Resources\FederalStateResource\Routes;

use App\Honey\Resources\FederalStateResource;
use Honey\Render\RenderResource;
use Honey\Resource\ResourcePage;

class FederalStateIndex extends ResourcePage
{
    public string $resource = FederalStateResource::class;

    public function handle(RenderResource $render): RenderResource
    {
        return $render;
    }
}