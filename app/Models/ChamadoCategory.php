<?php

namespace App\Models;

use App\Observers\ChamadoCategoryObserver;
use App\Policies\ChamadoCategoryPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChamadoCategory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'active',
        'name',
    ];

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ChamadoCategory::class => ChamadoCategoryPolicy::class,
    ];

    /**
     * Get the Chamado for the ChamadoCategory.
     */
    public function chamados(): HasMany
    {
        return $this->hasMany(Chamado::class);
    }

}
