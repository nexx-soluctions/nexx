<?php

namespace App\Actions\ATCM;
use App\Enums\OrderItemsStatus;
use App\Enums\OrderStatus;
use App\Models\Modules\ComercialAutomation\Card;
use App\Models\Modules\ComercialAutomation\Order;
use App\Models\Modules\ComercialAutomation\OrderItem;
use Exception;

class CreateOrderAction
{
    public static function execute(string $comanda, array $itens): void
    {
        $card = Card::find($comanda);

        if (!$card) {
            throw new Exception("Comanda não encontrada!", 1);
        }

        $order = new Order;
        $order->card_id = $comanda;
        $order->status = OrderStatus::options()[0];
        $order->save();

        try {
            foreach ($itens as $key => $item) {
                $orderItem = new OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->status = OrderItemsStatus::options()[0];
                $orderItem->value = $item->value;
                $orderItem->amount = 1;
                $orderItem->observations = '';
                $orderItem->product_id = $item->id;
                $orderItem->attraction_id = null;
                $orderItem->save();
            }
        } catch (\Throwable $th) {
            $order->delete();
            throw $th;
        }
    }
}