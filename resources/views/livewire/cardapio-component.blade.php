<div>
    @if ($modalError)
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-neutral-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <x-filament::icon icon="heroicon-o-exclamation-triangle" class="h-6 w-6 text-red-600"/>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <div class="mt-2">
                                    <p>{{ $modalErrorMsg }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-neutral-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" wire:click="closeModalError" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 hover:bg-neutral-50 sm:mt-0 sm:w-auto">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($modalPergunte)
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-neutral-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <x-filament::icon icon="heroicon-o-clipboard-document-list" class="h-6 w-6 text-green-600"/>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <div class="mt-2">
                                    <label for="comanda" class="block text-sm font-semibold leading-6 text-neutral-900">Informe a comanda</label>
                                    <div class="mt-2.5">
                                      <input type="text" wire:model="comanda" name="comanda" id="comanda" autocomplete="comanda" required class="block w-full rounded-md border-0 px-3.5 py-2 text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 placeholder:text-neutral-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-neutral-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" wire:click="concluirPedido" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-black shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Concluir</button>
                        <button type="button" wire:click="closeModalPergunte" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 hover:bg-neutral-50 sm:mt-0 sm:w-auto">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="flex flex-wrap mt-2">
        @if ($mostrarPedidos)
        <div class="w-full px-2">
            <div class="mb-2 bg-neutral-100 text-black transition duration-300 rounded shadow-lg text-center">
                <h2 class="text-center p-2">Itens do Pedido</h2>
            </div>
            @if ($carrinho)
            <div class="mb-2 bg-neutral-100 text-black transition duration-300 rounded shadow-lg">
                <div class="p-2 flex justify-between">
                    <p>Total <span class="font-semibold">R$ {{ $somaCarrinho }},00</span></p>
                    <button wire:click="showModalPergunte" class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700 transition duration-300 font-semibold">Enviar pedido</button>
                </div>
            </div>
            @endif
            <ul>
                @forelse ($carrinho as $key => $produtoNoCarrinho)
                    <li class="mb-2 bg-neutral-100 text-black transition duration-300 rounded shadow-lg">
                        <div class="flex justify-between items-center px-2 py-1">
                            <h3 class="font-semibold uppercase">{{ $produtoNoCarrinho->name }}</h3>
                            <p class="font-semibold">R$ {{ $produtoNoCarrinho->value }},00</p>
                        </div>
                        <div class="p-2 flex justify-end">
                            <button wire:click="removerDoCarrinho({{ $key }})" class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700 transition duration-300 uppercase text-xs font-semibold">Remover</button>
                        </div>
                    </li>
                @empty
                <li class="mb-2 bg-neutral-200 text-black transition duration-300 rounded shadow-lg">
                    <p class="text-center p-5">Nenhum item no pedido</p>
                </li>
                @endforelse
            </ul>
        </div>
        @endif
        @if ($mostrarCardapio)
        <!-- Painel de Seções do Cardápio -->
        <div class="w-full md:w-1/4">
            <ul class="px-2">
                @foreach ($menuCategories as $key => $category)
                <li wire:click="selectCategory({{ $category->id }})" 
                    class="cursor-pointer transition duration-300 py-1 border-b border-neutral-200 text-white uppercase text-center
                    {{ $category->id === $selectedCategory ? 'bg-blue-600 hover:bg-blue-700' : 'bg-neutral-400 hover:bg-neutral-500' }}
                    @if ($key === 0) rounded-t @endif
                    @if ($key === count($menuCategories) - 1) rounded-b @endif">
                    {{ $category->name }}
                </li>
                @endforeach
            </ul>
        </div>
        <!-- Painel de Pedidos da Categoria Selecionada -->
        <div class="w-full md:w-3/4 mt-2 md:mt-0">
            <ul class="px-2">
                @forelse ($categoryProducts as $product)
                <li class="mb-2 bg-neutral-200 text-black transition duration-300 rounded shadow-lg">
                    <div class="flex flex-row justify-between items-center">
                        <div class="w-1/5 md:w-1/3 h-full">
                            <img src="/storage/{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded w-full h-full object-cover m-auto max-w-32 max-h-32 overflow-hidden">
                        </div>
                        <div class="w-4/5 md:w-2/3 md:pl-4">
                            <div class="flex justify-between items-center px-2 py-1">
                                <h3 class="font-semibold uppercase">{{ $product->name }}</h3>
                                <p class="font-semibold">R$ {{ $product->value }},00</p>
                            </div>
                            <div class="px-2 py-1">
                                <p class="text-sm">{{ $product->description }}</p>
                            </div>
                            <div class="p-2 flex justify-end">
                                <button wire:click="adicionarAoCarrinho({{ $product->id }})" class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700 transition duration-300 uppercase text-xs font-semibold">Adicionar ao pedido</button>
                            </div>
                        </div>
                    </div>
                </li>
                @empty
                    <li class="mb-2 bg-neutral-200 text-black transition duration-300 rounded shadow-lg">
                        <p class="text-center p-5">Nenhum produto encontrado</p>
                    </li>
                @endforelse
            </ul>
        </div>
        @endif

        <div class="fixed bottom-0 left-0 z-9 w-full h-16 bg-white border-t border-neutral-200 dark:bg-neutral-700 dark:border-neutral-600">
            <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
                <a type="button" href="{{ route('waiter.home') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-neutral-50 dark:hover:bg-neutral-200 group">
                    <x-filament::icon icon="heroicon-o-chevron-left" class="w-5 h-5 mb-2 text-neutral-500 dark:text-neutral-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"/>
                    <span class="text-sm text-neutral-500 dark:text-neutral-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Voltar</span>
                </a>
                <button type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-neutral-50 dark:hover:bg-neutral-200 group">
                    {{-- <x-filament::icon icon="heroicon-o-clipboard-document-check" class="w-5 h-5 mb-2 text-neutral-500 dark:text-neutral-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"/>
                    <span class="text-sm text-neutral-500 dark:text-neutral-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Wallet</span> --}}
                </button>
                <button wire:click="alteraMostrarCardapio" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-neutral-50 dark:hover:bg-neutral-200 group">
                    <x-filament::icon icon="heroicon-o-clipboard-document-list" class="w-5 h-5 mb-2 text-neutral-500 dark:text-neutral-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"/>
                    <span class="text-sm text-neutral-500 dark:text-neutral-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Cardápio</span>
                </button>
                <button wire:click="alteraMostrarPedidos" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-neutral-50 dark:hover:bg-neutral-200 group">
                    <x-filament::icon icon="heroicon-o-shopping-bag" class="w-5 h-5 mb-2 text-neutral-500 dark:text-neutral-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"/>
                    <span class="text-sm text-neutral-500 dark:text-neutral-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Pedido</span>
                </button>
            </div>
        </div>
    </div>
</div>