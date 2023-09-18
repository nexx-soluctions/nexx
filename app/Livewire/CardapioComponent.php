<?php

namespace App\Livewire;

use App\Actions\ATCM\CreateOrderAction;
use App\Models\Modules\ComercialAutomation\Product;
use Livewire\Component;

class CardapioComponent extends Component
{
    public $selectedCategory = null;

    public $menuCategories = [];

    public $categoryProducts = [];

    public $carrinho = [];

    public $mostrarCardapio = true;

    public $mostrarPedidos = false;

    public $modalPergunte = false;

    public $somaCarrinho = 0;

    public $modalErrorMsg = '';

    public $modalError = false;

    public $comanda;

    public function alteraMostrarCardapio()
    {
        $this->mostrarPedidos = false;
        $this->mostrarCardapio = true;
    }

    public function alteraMostrarPedidos()
    {
        $this->mostrarPedidos = true;
        $this->mostrarCardapio = false;
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function adicionarAoCarrinho($produtoId)
    {
        // Adicione o produto ao carrinho
        $produto = Product::find($produtoId);

        if ($produto) {
            $this->carrinho[] = $produto;
        }

        $this->somarCarrinho();
    }

    public function removerDoCarrinho($key)
    {
        unset($this->carrinho[$key]);
        $this->somarCarrinho();
    }

    public function somarCarrinho()
    {
        $this->somaCarrinho = array_sum(array_column($this->carrinho, 'value'));
    }

    public function limparItensPedido()
    {
        $this->carrinho = [];
    }

    public function showModalPergunte()
    {
        $this->modalPergunte = true;
    }

    public function closeModalPergunte()
    {
        $this->modalPergunte = false;
    }

    public function showModalError()
    {
        $this->modalError = true;
    }

    public function closeModalError()
    {
        $this->modalError = false;
    }

    public function concluirPedido()
    {
        try {
            CreateOrderAction::execute($this->comanda, $this->carrinho);

            $this->closeModalPergunte();
            $this->limparItensPedido();
            $this->comanda = '';
        } catch (\Throwable $th) {
            $this->modalErrorMsg = $th->getMessage();
            $this->closeModalPergunte();
            $this->showModalError();
        }
    }

    public function render()
    {
        // $this->menuCategories = ProductCategory::all();
        $this->menuCategories = collect((object)[(object)['id' => 1, 'name' => 'Refrigerante'], (object)['id' => 2, 'name' => 'Comida']]);

        $this->categoryProducts = [];

        if (!$this->selectedCategory && $this->menuCategories) {
            $this->selectedCategory = $this->menuCategories->first()->id;
        }

        if ($this->selectedCategory) {
            // $this->categoryOrders = Product::where('atm_product_category_id', $this->selectedCategory)->get();
            $this->categoryProducts = Product::all();

            if ($this->selectedCategory == '2') {

                $this->categoryProducts = collect();
            }
        }

        return view('livewire.cardapio-component');
    }
}
