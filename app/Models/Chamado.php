<?php

namespace App\Models;

use App\Observers\ChamadoObserver;
use App\Policies\ChamadoPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chamado extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'contact',
        'place',
        'problem',
        'chamado_category_id',
    ];

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Chamado::class => ChamadoPolicy::class,
    ];

    /**
     * Get the ChamadoCategory that owns the Chamado.
     */
    public function chamadoCategory(): BelongsTo
    {
        return $this->belongsTo(ChamadoCategory::class);
    }
}
