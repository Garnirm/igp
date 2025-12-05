<?php

namespace App\Livewire;

use App\Models\Army\TreeUnitTemplate;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class ArmyTreeUnitTemplateBuilder extends Component implements HasForms
{
    use InteractsWithForms;

    public array $tree = [];

    public ?string $active_path = null;
    public array $node_data = [];

    public TreeUnitTemplate $template;

    public function mount(TreeUnitTemplate $record): void
    {
        $this->template = $record;

        $this->tree = $record->items ?? [];
    }

    public function formEdit(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Structure')->schema([
                            TextInput::make('name')->label('Nom de l\'échelon')->required(),
                        ]),
                    ]),
            ])
            ->statePath('node_data');
    }

    public function editNode(?string $path = null): void
    {
        $path = str_replace('_', '\'', $path);

        $last_path = $path;

        if (Str::of($path)->contains('.')) {
            $last_path = Str::of($path)->explode('.')->last();
        }

        $this->active_path = $path;

        $this->formEdit->fill([
            'name' => $last_path,
        ]);

        $this->dispatch('open-modal', id: 'edit-node-modal');
    }

    public function saveNode(): void
    {
        $tree = $this->tree;
        $state = $this->formEdit->getState();

        if (Str::of($this->active_path)->contains('.')) {
            $last_path = Str::of($this->active_path)->explode('.')->last();

            $data_node = data_get($tree, $this->active_path);

            if ($last_path !== $state['name']) {
                data_forget($tree, $this->active_path);
            }

            $new_path = str_replace($last_path, $state['name'], $this->active_path);

            data_set($tree, $new_path, $data_node);
        } else {
            $last_path = $this->active_path;

            $data_node = $tree[ $last_path ];

            if ($last_path !== $state['name']) {
                unset($tree[ $last_path ]);
            }

            $tree[ $state['name'] ] = $data_node;
        }

        $this->template->update([ 'items' => $tree ]);

        $this->tree = $tree;

        $this->dispatch('close-modal', id: 'edit-node-modal');

        Notification::make()->title('Nœud mis à jour')->success()->send();
    }

    public function getTreeProperty(): array
    {
        return $this->expandNodes($this->tree ?? []);
    }

    protected function expandNodes(array $nodes): array
    {
        $hydrated_nodes = $nodes;

        return $hydrated_nodes;
    }

    public function render(): View
    {
        return view('livewire.army-tree-unit-template-builder', [
            'tree' => $this->tree,
        ]);
    }
}
