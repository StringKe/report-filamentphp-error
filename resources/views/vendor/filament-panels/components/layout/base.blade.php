@php use Filament\Support\Facades\FilamentView; @endphp
@props(['livewire'])

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
    @class(['fi min-h-screen', 'dark' => filament()->hasDarkModeForced()])
>

    <head>
        {{ FilamentView::renderHook('panels::head.start') }}

        <meta charset="utf-8" />
        <meta
            name="csrf-token"
            content="{{ csrf_token() }}"
        />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        />

        @if ($favicon = filament()->getFavicon())
            <link
                rel="icon"
                href="{{ $favicon }}"
            />
        @endif

        <title>
            {{ filled($title = $livewire->getTitle()) ? "{$title} - " : null }}{{ filament()->getBrandName() }}
        </title>

        {{ FilamentView::renderHook('panels::styles.before') }}

        <style>
            [x-cloak=''],
            [x-cloak='x-cloak'],
            [x-cloak='1'] {
                display: none !important;
            }

            @media (max-width: 1023px) {
                [x-cloak='-lg'] {
                    display: none !important;
                }
            }

            @media (min-width: 1024px) {
                [x-cloak='lg'] {
                    display: none !important;
                }
            }
        </style>

        @filamentStyles
        @livewireStyles
        @vite('resources/css/app.css')
        {{ filament()->getTheme()->getHtml() }}
        {{ filament()->getFontHtml() }}

        <style>
            :root {
                --font-family: {!! filament()->getFontFamily() !!};
                --sidebar-width: {{ filament()->getSidebarWidth() }};
                --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }};
            }
        </style>

        {{ FilamentView::renderHook('panels::styles.after') }}

        @if (!filament()->hasDarkMode())
            <script>
                localStorage.setItem('theme', 'light')
            </script>
        @elseif (filament()->hasDarkModeForced())
            <script>
                localStorage.setItem('theme', 'dark')
            </script>
        @else
            <script>
                const theme = localStorage.getItem('theme') ?? 'system'

                if (
                    theme === 'dark' ||
                    (theme === 'system' &&
                        window.matchMedia('(prefers-color-scheme: dark)')
                        .matches)
                ) {
                    document.documentElement.classList.add('dark')
                }
            </script>
        @endif

        {{ FilamentView::renderHook('panels::head.end') }}
    </head>

    <body
        class="min-h-screen overscroll-y-none bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white"
    >
        {{ FilamentView::renderHook('panels::body.start') }}

        {{ $slot }}

        @livewire(Filament\Livewire\Notifications::class)

        {{ FilamentView::renderHook('panels::scripts.before') }}

        @livewireScriptConfig
        @vite('resources/js/app.ts')
        @filamentScripts(withCore: true)

        @if (config('filament.broadcasting.echo'))
            <script>
                window.addEventListener('DOMContentLoaded'
                    {{-- 'livewire:navigated' --}}, () => {
                        window.Echo = new window.EchoFactory(@js(config('filament.broadcasting.echo')))

                        window.dispatchEvent(new CustomEvent('EchoLoaded'))
                    })
            </script>
        @endif

        @stack('scripts')

        {{ FilamentView::renderHook('panels::scripts.after') }}

        {{ FilamentView::renderHook('panels::body.end') }}
    </body>

</html>
