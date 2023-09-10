<?php

namespace App\Models\Modules\ComercialAutomation;

use App\Models\Modules\ModularModel;
use App\Policies\CardPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends ModularModel
{
    use HasFactory, SoftDeletes;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Card::class => CardPolicy::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hash_id',
        'identity',
        'table_id',
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function cardClosing(): HasOne
    {
        return $this->hasOne(cardClosing::class);
    }

    public function attractionQueues(): HasMany
    {
        return $this->hasMany(AttractionQueue::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
