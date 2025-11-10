<button type="button" wire:click="openModale">{{ $label }}</button>

{{ $opened_modale ? 'yes' : 'no' }}

@if ($opened_modale)
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div></div>
        {{-- <div>"..." ... (Fond gris) ...></div> --}}
        
        <div>
            ok
        </div>
    </div>
@endif