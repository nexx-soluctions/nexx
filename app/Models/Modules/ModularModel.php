<?php

namespace App\Models\Modules;

use App\Models\Modules\ComercialAutomation\Card;
use App\Policies\Modules\ModularModelPolicy;
use Illuminate\Database\Eloquent\Model;

class ModularModel extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'db_enterprise';
}