<?php

namespace App\Enums;

use App\Traits\OptionsEnum;

enum AttractionsEntityStatus: string
{
    use OptionsEnum;

    case Available = ['available', 'Disponível'];
    case InUse     = ['in_use', 'Em uso'];
    case Disabled  = ['disabled', 'Desabilitado'];
}