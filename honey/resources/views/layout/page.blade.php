@include('honey-layout::page.header', [
    'header' => $header,
])

<div class="px-4 md:px-6">
    @foreach ($widgets as $widget_id => $widget)
        <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-6">
            <livewire:is :component="$widget->widget_namespace" :identifier="$widget_id" />
        </div>
    @endforeach
</div>