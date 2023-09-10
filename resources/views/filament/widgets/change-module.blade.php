<x-filament-widgets::widget>
    <x-filament::section>
        <div style="--c-50:var(--primary-50);--c-300:var(--primary-300);--c-400:var(--primary-400);--c-600:var(--primary-600);" class="h-11 fi-badge flex items-center justify-center gap-x-1 whitespace-nowrap rounded-md  text-xs font-medium ring-1 ring-inset px-2 min-w-[theme(spacing.6)] py-1 bg-custom-50 text-custom-600 ring-custom-600/10 dark:bg-custom-400/10 dark:text-custom-400 dark:ring-custom-400/30 fi-input block w-full border-none bg-transparent py-1.5 text-base text-gray-950 outline-none transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 ps-0 pe-3">

            <x-filament::dropdown width="xs" class="flex items-center gap-x-3 px-2 py-2 cursor-pointer">
                <x-slot name="trigger" class="">
                    <span class="flex-1 text-sm font-semibold text-gray-700 dark:text-gray-200">Módulo: {{ Session::get('module_connected')->name }}</span>
                    <x-filament::icon-button
                        icon="heroicon-m-chevron-up"
                        class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus:ring-2 disabled:pointer-events-none disabled:opacity-70 h-9 w-9 text-gray-400 hover:text-gray-500 focus:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus:ring-primary-500 fi-sidebar-group-collapse-button -my-2 -me-2 rotate-180"
                    />
                </x-slot>
                <x-filament::dropdown.list class="!border-t-0">
                    @foreach (auth()->user()->enterprise->modules as $key => $module)
                        @if ($module->name !== Session::get('module_connected')->name)
                            <button type="button" class="fi-dropdown-list-item flex w-full items-center gap-2 whitespace-nowrap rounded-md p-2 text-sm transition-colors duration-75 outline-none disabled:pointer-events-none disabled:opacity-70 fi-dropdown-list-item-color-gray hover:bg-gray-950/5 focus:bg-gray-950/5 dark:hover:bg-white/5 dark:focus:bg-white/5" wire:click="changeModule('{{ $module->acronym }}')">
                                {{ $module->name }}
                            </button>
                        @endif
                    @endforeach
                </x-filament::dropdown.list>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    window.addEventListener('filament-change-module', () => {
                        location.reload(true);
                    });
                })
            </script>
            </x-filament::dropdown>
    </x-filament::section>
</x-filament-widgets::widget>


