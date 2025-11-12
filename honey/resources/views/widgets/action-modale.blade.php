<div>
    <button type="button" wire:click="openModale">{{ $label }}</button>

    @if ($opened_modale)
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75" wire:click="closeModale"></div>
            
            <div class="relative bg-white rounded-lg shadow-xl mx-auto p-6" style="max-width: 500px; margin-top: 10vh;">
                @foreach ($widgets as $widget)
                    @include($widget['view_path'], [ 'items' => $widget['items'] ])
                @endforeach
            </div>
        </div>
    @endif
</div>