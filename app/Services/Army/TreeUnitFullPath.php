<?php

namespace App\Services\Army;

use App\Models\Army\TreeUnit;

class TreeUnitFullPath
{
    /**
     * @var array<string> $tree
     */
    private array $tree = [];

    private string $tree_unit_id;

    public function __construct(string $tree_unit_id)
    {
        $this->tree_unit_id = $tree_unit_id;
    }

    public function generate(): static
    {
        $tree_unit = TreeUnit::find($this->tree_unit_id);

        if (is_null($tree_unit)) {
            return $this;
        }

        $this->tree[] = $tree_unit->name;

        $this->listParent($tree_unit);

        return $this;
    }

    public function get(): string
    {
        $data = array_reverse($this->tree);

        return implode(' > ', $data);
    }

    private function listParent(TreeUnit $tree_unit): void
    {
        if (is_null($tree_unit->parent_id)) {
            return;
        }

        $parent = TreeUnit::find($tree_unit->parent_id);

        if (is_null($parent)) {
            return;
        }

        $this->tree[] = $parent->name;

        $this->listParent($parent);
    }
}