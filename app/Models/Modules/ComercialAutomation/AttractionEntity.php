<?php

namespace App\Models\Modules\ComercialAutomation;

use App\Models\Modules\ModularModel;
use App\Policies\AttractionEntityPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttractionEntity extends ModularModel
{
    use HasFactory, SoftDeletes;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        AttractionEntity::class => AttractionEntityPolicy::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'attraction_id',
        'name',
        'status',
        'active',
    ];

    public function attraction(): BelongsTo
    {
        return $this->belongsTo(Attraction::class);
    }
}
