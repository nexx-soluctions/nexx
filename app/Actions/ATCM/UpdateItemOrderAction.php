<?php

namespace App\Actions\ATCM;
use App\Enums\OrderItemsStatus;
use App\Models\Modules\ComercialAutomation\OrderItem;

class UpdateItemOrderAction
{
    public const SET_CONCLUDED = 1;

    public static function execute(OrderItem $orderItem, int $action = self::SET_CONCLUDED): void
    {
        if ($action === self::SET_CONCLUDED) {
            $orderItem->status = OrderItemsStatus::options()[2];
            $orderItem->save();
        }
    }
}