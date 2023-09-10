<?php

namespace App\Models\Modules\ComercialAutomation;

use App\Models\Modules\ModularModel;
use App\Policies\ProductPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends ModularModel
{
    use HasFactory, SoftDeletes;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image_url',
        'value',
        'show_to_waiter',
        'show_to_cashier',
        'show_to_kitchen',
        'active',
    ];
}
