<?php

namespace Honey\Render;

use Illuminate\View\View;

class RenderResource
{
    public function view(): View
    {
        return view('honey-layout::base');
    }
}