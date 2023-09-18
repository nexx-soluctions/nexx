<div>
    <div class="container mx-auto mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 p-5">
        @forelse ($pedidoItens as $key => $item)
        <div class="bg-white p-4 rounded-lg shadow-lg border-2 border-neutral-200">
            <div class="flex items-center justify-between">
                <div class="ml-4">
                    @if (!empty($item->order))
                    <p># {{ $item->order->id }}</p>
                    @endif
                    @if (!empty($item->product))
                    <p class="text-gray-800 font-semibold">{{ $item->product->name }}</p>
                    @endif
                    @if (!empty($item->order->card))
                    <p>Comanda: {{ $item->order->card->id }}</p>
                    @endif
                    @if (!empty($item->order->card->table))
                    <p>Mesa: {{ $item->order->card->table->id }}</p>
                    @endif
                </div>
                <div class="text-white">
                    <button wire:click="concluirItemPedido({{ $item }})" class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700 transition duration-300 uppercase text-xs font-semibold">Concluir</button>
                </div>
            </div>
        </div>
        @empty
            Tudo em ordem
        @endforelse
    </div>
</div>
