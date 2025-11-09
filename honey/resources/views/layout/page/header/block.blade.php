@foreach ($items as $item)
    @if (isset($item->view_path))
        @include($item->view_path, $item->viewData())
    @elseif (isset($item->widget_namespace))
        <livewire:is :component="$item->widget_namespace" :identifier="$item->identifier" />
    @endif
@endforeach