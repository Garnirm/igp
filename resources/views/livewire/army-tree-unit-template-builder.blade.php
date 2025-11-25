<div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">
            Structure : {{ $template->name }}
        </h2>
        
        <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600">
            {{ count($tree) }} élément(s) racine(s)
        </span>
    </div>

    <ul class="space-y-2">
        @forelse ($tree as $node)
            @include('livewire.army-tree-unit-template.tree-node', ['node' => $node])
        @empty
            <li class="text-gray-400 italic text-sm p-4 text-center border-2 border-dashed rounded-lg">
                Aucune structure définie.
            </li>
        @endforelse
    </ul>
</div>