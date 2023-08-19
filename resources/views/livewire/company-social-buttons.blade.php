<div>
    @if (count($providers))
        <div class="relative flex items-center justify-center text-center">
            <div class="absolute h-px w-full border-t border-gray-200"></div>
            <p
                class="relative inline-block rounded-full bg-white p-2 text-sm font-medium text-gray-500 dark:bg-gray-800 dark:text-gray-100">
                Or continue with
            </p>
        </div>

        <div class="@if (count($providers) > 1) grid-cols-2 @endif mt-2 grid gap-4">
            @foreach ($providers as $key => $provider)
                <x-filament::button
                    color="secondary"
                    :icon="$provider['icon'] ?? null"
                    tag="a"
                    :href="route('filament.company.social.oauth.redirect', $key)"
                >
                    {{ $provider['label'] }}
                </x-filament::button>
            @endforeach
        </div>
    @endif
</div>
