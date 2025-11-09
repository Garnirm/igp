<!doctype html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="domain" content="{{ config('app.url') }}">
        <meta name="robots" content="noindex, nofollow">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite([ 'resources/sass/app.scss', 'resources/js/app.js' ])

        @livewireStyles
    </head>

    <body class="h-screen bg-gray-100">
        <div class="flex h-full">
            @include('honey-layout::sidebar')

            <div class="flex-1 flex flex-col h-full overflow-y-auto">
                @if ($panel->has_topbar)
                    @include('honey-layout::topbar')
                @endif

                @include('honey-layout::page', [
                    'header' => $header,
                    'widgets' => $widgets,
                ])
            </div>
        </div>

        @livewireScripts
    </body>
</html>
<!-- End supervision -->