<div class="p-4 md:p-6">
    @if (!empty($breadcrumb))
        <nav class="mb-4 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                @foreach ($breadcrumb as $item)
                    <li class="flex items-center">
                        <a href="{{ $item->url }}" class="hover:underline">{{ $item->label }}</a>

                        @if (!$loop->last)
                            <svg class="fill-current w-3 h-3 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.62c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z"/></svg>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    @endif

    @include('honey-layout::page.title', [ 'title' => $title ])
</div>

<div class="px-4 md:px-6">
    @foreach ($widgets as $widget_id => $widget)
        <livewire:is :component="$widget->widget_namespace" :identifier="$widget_id" />
    @endforeach
</div>