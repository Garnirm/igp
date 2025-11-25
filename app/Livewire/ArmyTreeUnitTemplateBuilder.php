<?php

namespace App\Livewire;

use App\Models\Army\TreeUnitTemplate;
use Illuminate\View\View;
use Livewire\Component;

class ArmyTreeUnitTemplateBuilder extends Component
{
    public TreeUnitTemplate $template;

    public function mount(TreeUnitTemplate $record): void
    {
        $this->template = $record;
    }

    public function getTreeProperty(): array
    {
        return $this->expandNodes($this->template->items ?? []);
    }

    protected function expandNodes(array $nodes): array
    {
        $hydrated_nodes = [];

        foreach ($nodes as $node) {
            $hydrated_node = $node;
            $children = $node['items'] ?? [];

            if (isset($node['template_id']) && !($node['fixed'] ?? false)) {
                $linked_template = TreeUnitTemplate::find($node['template_id']);

                if ($linked_template) {
                    $template_items = $this->expandNodes($linked_template->items ?? []);

                    $hydrated_node['virtual_items'] = $template_items;
                }
            } else {
                $hydrated_node['items'] = $this->expandNodes($children);
            }

            $hydrated_nodes[] = $hydrated_node;
        }

        return $hydrated_nodes;
    }

    public function render(): View
    {
        return view('livewire.army-tree-unit-template-builder', [
            'tree' => $this->tree,
        ]);
    }
}
