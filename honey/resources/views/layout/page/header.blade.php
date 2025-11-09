@if (!empty($header->items))
    <div class="p-4 md:p-6">
        @foreach ($header->items as $item)
            @if (isset($item->view_path))
                @include($item->view_path, $item->viewData())
            @endif
        @endforeach
    </div>
@endif