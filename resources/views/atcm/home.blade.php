<x-waiter-layout>
    <div class="container mx-auto mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 p-5">
        <a href="{{ route('waiter.new-order') }}" class="bg-white p-4 rounded-lg shadow-lg border-2 border-neutral-200 cursor-pointer">
            <div class="flex items-center">
                <div class="bg-neutral-500 text-white w-10 h-10 flex items-center justify-center rounded-full">
                    <x-filament::icon-button icon="heroicon-o-clipboard-document-list"/>
                </div>
                <div class="ml-4">
                    <p class="text-gray-800 font-semibold">Pedidos</p>
                    <p class="text-gray-600">Realizar um pedido</p>
                </div>
            </div>
        </a>
        <a href="{{ route('waiter.cards') }}" class="bg-white p-4 rounded-lg shadow-lg border-2 border-neutral-200">
            <div class="flex items-center">
                <div class="bg-neutral-500 text-white w-10 h-10 flex items-center justify-center rounded-full">
                    <x-filament::icon-button icon="heroicon-o-clipboard-document-check"/>
                </div>
                <div class="ml-4">
                    <p class="text-gray-800 font-semibold">Conferência</p>
                    <p class="text-gray-600">Conferir comandas</p>
                </div>
            </div>
        </a>
        <a href="{{ route('waiter.tables') }}" class="bg-white p-4 rounded-lg shadow-lg border-2 border-neutral-200">
            <div class="flex items-center">
                <div class="bg-neutral-500 text-white w-10 h-10 flex items-center justify-center rounded-full">
                    <x-filament::icon-button icon="heroicon-o-squares-2x2"/>
                </div>
                <div class="ml-4">
                    <p class="text-gray-800 font-semibold">Mapa</p>
                    <p class="text-gray-600">Mapa de mesas</p>
                </div>
            </div>
        </a>
        <a href="{{ route('waiter.orders.concluded') }}" class="bg-white p-4 rounded-lg shadow-lg border-2 border-neutral-200">
            <div class="flex items-center">
                <div class="bg-neutral-500 text-white w-10 h-10 flex items-center justify-center rounded-full">
                    <x-filament::icon-button icon="heroicon-o-check-badge"/>
                </div>
                <div class="ml-4">
                    <p class="text-gray-800 font-semibold">Pedidos concluídos</p>
                    <p class="text-gray-600">Pedidos a entregar</p>
                </div>
            </div>
        </a>
        <a href="{{ route('login') }}" class="bg-white p-4 rounded-lg shadow-lg border-2 border-neutral-200">
            <div class="flex items-center">
                <div class="bg-neutral-500 text-white w-10 h-10 flex items-center justify-center rounded-full">
                    <x-filament::icon-button icon="heroicon-o-arrow-uturn-left"/>
                </div>
                <div class="ml-4">
                    <p class="text-gray-800 font-semibold">Voltar</p>
                    <p class="text-gray-600">Voltar ao sistema</p>
                </div>
            </div>
        </a>
    </div>
    <div class="text-center mt-5 drop-shadow-2xl">{{ auth()->user()->enterprise->name }}</div>
</x-waiter-layout>