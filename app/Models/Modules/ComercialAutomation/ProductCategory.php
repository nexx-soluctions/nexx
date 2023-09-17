<?php

namespace App\Models\Modules\ComercialAutomation;

use App\Policies\ProductCategoryPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'atm_products_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
    ];

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ProductCategory::class => ProductCategoryPolicy::class,
    ];
}
