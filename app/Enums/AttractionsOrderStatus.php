<?php

namespace App\Enums;

use App\Traits\OptionsEnum;

enum AttractionsOrderStatus: string
{
    use OptionsEnum;

    case InQueue   = ['in_queue', 'Na fila'];
    case WaitingToStart = ['waiting_to_start', 'Esperando para começar'];
    case Playing   = ['playing', 'Jogando'];
    case Finished  = ['finished', 'Finalizado'];
    case Canceled  = ['canceled', 'Cancelado'];
}