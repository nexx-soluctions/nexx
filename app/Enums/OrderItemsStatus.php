<?php

namespace App\Enums;

use App\Traits\OptionsEnum;

enum OrderItemsStatus: string
{
    use OptionsEnum;

    case Assessing = ['assessing', 'Analisando'];
    case Rejected  = ['rejected', 'Rejeitado'];
    case Preparing = ['preparing', 'Preparando'];
    case Concluded = ['concluded', 'Concluído'];
    case Delivered = ['delivered', 'Entregue'];
    case Canceled  = ['canceled', 'Cancelado'];
}