<?php

namespace Honey\Form;

use Closure;

class TextInput
{
    private string $view_path = 'honey-form::text-input';
    private null|string|Closure $label = null;

    public function label(null|string|Closure $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'view_path' => $this->view_path,
            'label' => $this->label,
        ];
    }

    public static function make(): static
    {
        return app(static::class);
    }
}