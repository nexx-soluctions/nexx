<?php

namespace App\Livewire;

use App\Models\Modules\ComercialAutomation\Product;
use App\Models\Modules\ComercialAutomation\ProductCategory;
use Illuminate\Support\Collection;
use Livewire\Component;

class CardapioComponent extends Component
{
    public $selectedCategory = null;
    public $menuCategories = [];
    public $categoryProducts = [];

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
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

                $this->categoryProducts = Product::where('id', 2)->get();
            }
        }

        return view('livewire.cardapio-component');
    }
}
