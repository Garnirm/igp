@props(['node'])

<li class="ml-6 pl-4 border-l-2 border-gray-300 relative" x-data="{ open: true }">
    <div class="flex items-center gap-2 py-1 hover:bg-gray-50 rounded">
        <button @click="open = !open" type="button" class="text-gray-500 w-4 text-center">
            @if (!empty($node['items']) || !empty($node['virtual_items']))
                <span x-show="open">▼</span>
                <span x-show="!open">▶</span>
            @else
                <span class="text-gray-300">•</span>
            @endif
        </button>

        <span class="font-medium text-sm {{ isset($node['template_id']) ? 'text-blue-600' : 'text-gray-800' }}">
            {{ $node['name'] ?? 'Sans nom' }}
        </span>

        @if(isset($node['template_id']))
            <span class="text-[10px] px-1.5 py-0.5 rounded border {{ ($node['fixed'] ?? false) ? 'bg-orange-100 text-orange-700 border-orange-200' : 'bg-blue-100 text-blue-700 border-blue-200' }}">
                {{ ($node['fixed'] ?? false) ? 'Fixed' : 'Template Link' }}
            </span>
        @endif
    </div>

    <ul x-show="open" class="mt-1" x-transition>
        @if (!empty($node['items']))
            @foreach ($node['items'] as $child)
                @include('livewire.army-tree-unit-template.tree-node', ['node' => $child])
            @endforeach
        @endif

        @if (!empty($node['virtual_items']))
            <div class="border-l-2 border-blue-100 ml-2 pl-2">
                @foreach ($node['virtual_items'] as $child)
                    @include('livewire.army-tree-unit-template.tree-node', ['node' => $child])
                @endforeach
            </div>
        @endif
    </ul>
</li>