<?php

namespace App\Models\Modules\ComercialAutomation;

use App\Models\Modules\ModularModel;
use App\Policies\AttractionPolicy;
use App\Policies\CardPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttractionQueue extends ModularModel
{
    use HasFactory, SoftDeletes;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Attraction::class => AttractionPolicy::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'card_id',
        'attraction_id',
        'done',
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function attraction(): BelongsTo
    {
        return $this->belongsTo(Attraction::class);
    }

}
