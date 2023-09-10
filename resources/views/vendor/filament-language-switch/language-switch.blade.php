<x-filament::dropdown teleport placement="bottom-end" class="fi-dropdown fi-user-menu">
    <style>
        .filament-dropdown-list-item-label {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
    </style>
    <x-slot name="trigger" class="">
        <div
            class="flex items-center justify-center w-9 h-9 font-semibold text-sm text-white rounded-full language-switch-trigger dark:text-primary-500 dark:bg-gray-900">                
                @php
                    $supportedLocales = ['en' => 'us', 'pt-BR' => 'br', 'es' => 'es', 'fr' => 'fr'];
                    $locale = app()->getLocale();
                    $component = 'flag-1x1-' . (isset($supportedLocales[$locale]) ? $supportedLocales[$locale] : 'br');
                @endphp
                <x-dynamic-component :component="$component"
                    class="flex-shrink-0 w-6 h-6  group-hover:text-white group-focus:text-white text-primary-500"
                    style="border-radius: 0.25rem" 
                />
        </div>
    </x-slot>
    <x-filament::dropdown.list class="!border-t-0">
        @foreach (config('filament-language-switch.locales') as $key => $locale)
            @if (!app()->isLocale($key))
                <button type="button" class="fi-dropdown-list-item flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 fi-dropdown-list-item-color-gray hover:bg-gray-950/5 focus:bg-gray-950/5 dark:hover:bg-white/5 dark:focus:bg-white/5" wire:click="changeLocale('{{ $key }}')">

                    @if (config('filament-language-switch.flag'))
                        <span>
                            <x-dynamic-component :component="'flag-1x1-' . (!blank($locale['flag_code']) ? $locale['flag_code'] : 'un')"
                                class="flex-shrink-0 w-5 h-5 group-hover:text-white group-focus:text-white text-primary-500"
                                style="border-radius: 0.25rem" />
                        </span>
                    @else
                        <span
                            class="w-6 h-6 flex items-center justify-center flex-shrink-0 @if (!app()->isLocale($key)) group-hover:bg-white group-hover:text-primary-600 group-hover:border group-hover:border-primary-500/10 group-focus:text-white @endif bg-primary-500/10 text-primary-500 font-semibold rounded-full p-4 text-xs">
                            {{ \Illuminate\Support\Str::of($locale['name'])->snake()->upper()->explode('_')->map(function ($string) use ($locale) {
                                    return \Illuminate\Support\Str::of($locale['name'])->wordCount() > 1 ? \Illuminate\Support\Str::substr($string, 0, 1) : \Illuminate\Support\Str::substr($string, 0, 2);
                                })->take(2)->implode('') }}
                        </span>
                    @endif
                    <span class="hover:bg-transparent text-gray-700 dark:text-gray-200">
                        {{ \Illuminate\Support\Str::of($locale[config('filament-language-switch.native') ? 'native' : 'name'])->headline() }}
                    </span>
                </button>
            @endif
        @endforeach

    </x-filament::dropdown.list>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.addEventListener('filament-language-changed', () => {
                location.reload(true);
            });
        })
    </script>
</x-filament::dropdown>
