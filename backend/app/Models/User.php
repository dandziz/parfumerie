<?php

namespace App\Models;

use App\Http\Controllers\Auth\MustVerifyApiEmail;
use App\Http\Controllers\Auth\MustVerifyApiEmailInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyApiEmailInterface
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes, MustVerifyApiEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $appends = ['role', 'default_address'];

    protected $hidden = [
        'password',
        'roles',
        'deleted_at',
        'email_verified_at',
        'updated_at',
        'created_at',
        'status',
        'social_token',
        'provider'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string'
    ];
    private mixed $email_verified_at;

    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return null;
    }

    public function getDefaultAddressAttribute() {
        $address = $this->address()->where('default', 1)->first();
        if ($address) {
            return $address->address .', ' . $address->ward .', ' .
                $address->district . ', ' . $address->province;
        } else {
            return '';
        }
    }

    public function getRoleAttribute() {
        return $this->roles[0]->name;
    }

    public function orders(): HasMany {
        return $this->hasMany(Order::class);
    }

    public function address(): HasMany {
        return $this->hasMany(Address::class);
    }

    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
