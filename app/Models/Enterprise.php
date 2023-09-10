<?php

namespace App\Models;

use App\Policies\EnterprisePolicy;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SQLite3;

class Enterprise extends Model
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
        'show_landing_page',
        'dns',
        'db_url',
        'db_host',
        'db_port',
        'db_user',
        'db_password',
    ];

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Enterprise::class => EnterprisePolicy::class,
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'enterprise_has_modules');
    }

    public function connectByAuthUser(): void
    {
        auth()->user()->enterprise->connect();
    }

    public function executeMigration() {
        try {
            $this->connect(false);    
            
            foreach ($this->modules as $key => $module) {
                Artisan::call('migrate:fresh', [
                    '--database' => 'db_enterprise',
                    '--path'     => "database/migrations/Modules/{$module->acronym}",
                    '--force'    => true, 
                ]);
            }
        } catch (\Throwable $th) {
            $this->connectByAuthUser();
            throw $th;
        }

        $this->connectByAuthUser();
    }

    public function connect(bool $reconnect = true): void
    {
        if ($reconnect) {
            $preDatabase = Config::get('database.connections.db_enterprise.database');
            $preUsername = Config::get('database.connections.db_enterprise.username');
            $prePassword = Config::get('database.connections.db_enterprise.password');
        }

        try {
            $this->tryConnect();

            DB::connection('db_enterprise')->getPDO();
            DB::connection('db_enterprise')->getDatabaseName();
        } catch (\Throwable $th) {
            throw new Exception($th);
        }

        if ($reconnect) {
            $this->tryConnect($preDatabase, $preUsername, $prePassword);
        }
    }

    private function tryConnect(?string $database = null, ?string $username = null, ?string $password = null): void
    {
        try {
            Config::set('database.connections.db_enterprise.database', $database ? $database : $this->db_url);
            Config::set('database.connections.db_enterprise.username', $username ? $username : $this->db_user);
            Config::set('database.connections.db_enterprise.password', $password ? $password : $this->db_password);
    
            DB::purge('db_enterprise');
            DB::reconnect('db_enterprise');
            Session::put('enterprise_connected', $this);
        } catch (\Throwable $th) {
            throw new Exception($th);
        }
    }

    public static function continueConnecting(): void
    {
        $enterprise = Session::get('enterprise_connected');

        Config::set('database.connections.db_enterprise.database', $enterprise->db_url);
        Config::set('database.connections.db_enterprise.username', $enterprise->db_user);
        Config::set('database.connections.db_enterprise.password', $enterprise->db_password);

        DB::purge('db_enterprise');
        DB::reconnect('db_enterprise');
        Session::put('enterprise_connected', $enterprise);
    }
}
