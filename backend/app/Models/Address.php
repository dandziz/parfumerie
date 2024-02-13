<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $appends = ['full_address'];
    protected $casts = [
        'default' => 'boolean',
    ];
    protected $fillable = ['name', 'phone_number', 'company', 'address', 'province', 'district', 'ward', 'zip_code', 'default', 'user_id'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function getFullAddressAttribute() {
        return $this->address .', ' . $this->ward .', ' . $this->district . ', ' . $this->province;
    }
}
