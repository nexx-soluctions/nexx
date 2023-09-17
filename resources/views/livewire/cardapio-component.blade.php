<div class="flex flex-wrap mt-3">
    <!-- Painel de Seções do Cardápio -->
    <div class="w-full md:w-1/4 bg-gray-100 p-4">
        <ul>
            @foreach ($menuCategories as $category)
            <li class="mb-2 cursor-pointer transition duration-300 p-2 rounded-md shadow-lg border-2 border-neutral-200" 
                wire:click="selectCategory({{ $category->id }})"
                :class="{ 'bg-blue-500 text-white font-semibold': {{ $category->id }} === {{ $selectedCategory }} }">
                {{ $category->name }}
            </li>
            @endforeach
        </ul>
    </div>
    <!-- Painel de Pedidos da Categoria Selecionada -->
    <div class="w-full md:w-3/4 p-4">
        <h2 class="text-lg font-semibold mb-4 text-center">Produtos</h2>
        <ul>
            @forelse ($categoryProducts as $product)
                <li class="mb-4 p-3 hover:bg-neutral-100 transition duration-300 rounded-md shadow-lg border-2 border-neutral-200">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-blue-600">{{ $product->name }}</h3>
                            <p class="text-gray-600">{{ $product->description }}</p>
                        </div>
                        <button class="bg-blue-500 text-white px-3 py-1 shadow-lg shadow-blue-200 rounded-md hover:bg-blue-600 transition duration-300">Adicionar</button>
                    </div>
                </li>
            @empty
                <li class="text-gray-600">Nenhum produto disponível nesta categoria.</li>
            @endforelse
        </ul>
    </div>
</div>

