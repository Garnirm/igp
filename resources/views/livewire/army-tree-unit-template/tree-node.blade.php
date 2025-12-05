@props([ 'node', 'name', 'path' ])

<?php
    $items = collect($node)->filter(fn ($value, $key) => !in_array($key, [ 'effectifs', 'materiels', 'description' ]))->toArray();
?>

<li class="ml-6 pl-4 border-l-2 border-gray-200 relative" x-data="{ open: false }" wire:key="node-{{ $path }}">
    <div class="flex items-center gap-2 py-1 hover:bg-gray-50 rounded">
        <button @click="open = !open" type="button" class="text-gray-500 w-4 text-center">
            @if (!empty($items))
                <span x-show="open">▼</span>
                <span x-show="!open">▶</span>
            @else
                <span class="text-gray-300">•</span>
            @endif
        </button>

        <button 
            type="button" 
            wire:click="editNode('{{ str_replace('\'', '_', $path) }}')" 
            class="font-medium text-sm hover:underline hover:text-primary-600 text-left"
        >
            {{ $name }}
        </button>
    </div>

    @if (!empty($items))
        <ul x-show="open" class="mt-1" x-transition>
            @foreach ($items as $node_name => $node_data)
                @include('livewire.army-tree-unit-template.tree-node', [
                    'node' => $node_data,
                    'name' => $node_name,
                    'path' => $path.'.'.$node_name,
                ])
            @endforeach
        </ul>
    @endif
</li>