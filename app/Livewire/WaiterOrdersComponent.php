<?php

namespace App\Livewire;

use App\Actions\ATCM\UpdateItemOrderAction;
use App\Enums\OrderItemsStatus;
use App\Models\Modules\ComercialAutomation\OrderItem;
use Livewire\Component;

class WaiterOrdersComponent extends Component
{
    public $pedidoItens;

    public function concluirItemPedido(OrderItem $item)
    {
        UpdateItemOrderAction::execute($item);
    }

    public function render()
    {
        $this->pedidoItens = OrderItem::where('status', OrderItemsStatus::options()[0])->get();

        return view('livewire.waiter-orders-component');
    }
}
