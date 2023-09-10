<?php

namespace App\Models;

use App\Policies\RouteStatisticPolicy;
use Bilfeldt\LaravelRouteStatistics\Models\RouteStatistic as BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteStatistic extends BaseModel
{
    use HasFactory;
}
