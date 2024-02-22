<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfume extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'perfumes';
    protected $fillable = ['code', 'name', 'slug', 'gender', 'origin', 'description',
        'brand_id', 'supplier_id', 'user_id', 'status'];
    protected $hidden = ['deleted_at', 'brand', 'supplier'];
    protected $appends = ['brand_name', 'supplier_name'];

    protected $casts = [
        'start_date' => 'datetime:d/m/Y',
    ];

    public function getBrandNameAttribute() {
        return $this->brand->name;
    }

    public function getSupplierNameAttribute() {
        return $this->supplier->name;
    }

    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class);
    }

    public function supplier(): BelongsTo {
        return $this->belongsTo(Supplier::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function price(): HasMany {
        return $this->hasMany(PerfumePrice::class);
    }
}
