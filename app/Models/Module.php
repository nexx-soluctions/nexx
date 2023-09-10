<?php

namespace App\Models;

use App\Policies\ModulePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;

class Module extends Model
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
        'acronym',
    ];

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Module::class => ModulePolicy::class,
    ];

    public function enterprises(): BelongsToMany
    {
        return $this->belongsToMany(Enterprise::class, 'enterprise_has_modules');
    }

    public function signModule(): void
    {
        Session::put('module_connected', $this);
    }

    public function changeModuleTo(string $acronym): void
    {
        Session::put('module_connected', $this);
    }
}
