<?php
    $tree_items = collect($tree)->filter(fn ($value, $key) => !in_array($key, [ 'effectifs', 'materiels', 'description' ]))->toArray();
?>

<div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
    <ul class="space-y-2">
        @forelse ($tree_items as $node_name => $node_data)
            @include('livewire.army-tree-unit-template.tree-node', [ 'node' => $node_data, 'name' => $node_name, 'path' => $node_name ])
        @empty
            <li class="text-gray-400 italic text-sm p-4 text-center border-2 border-dashed rounded-lg">
                Aucune structure définie.
            </li>
        @endforelse
    </ul>

    <x-filament::modal id="edit-node-modal" width="md">
        <x-slot name="heading">
            Éditer l'échelon
        </x-slot>

        {{ $this->formEdit }}

        <x-slot name="footer">
            <x-filament::button wire:click="saveNode">Enregistrer</x-filament::button>

            <x-filament::button color="gray" wire:click="$dispatch('close-modal', { id: 'edit-node-modal' })">
                Annuler
            </x-filament::button>
        </x-slot>
    </x-filament::modal>
</div>