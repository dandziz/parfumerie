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
        'brand_id', 'supplier_id', 'user_id', 'status', 'product_information'];
    protected $hidden = ['deleted_at', 'brand', 'supplier', 'product_information', 'brand_id',
        'user_id', 'supplier_id', 'supplier_name', 'created_at', 'deleted_at', 'updated_at',
        'price', 'status', 'media'];
    protected $appends = ['brand_name', 'supplier_name', 'display_price', 'avatar', 'price', 'media'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y',
    ];

    public function getBrandNameAttribute() {
        return $this->brand->name;
    }

    public function getSupplierNameAttribute() {
        return $this->supplier->name;
    }

    public function getAvatarAttribute() {
        $media = $this->media()->where('type', 1)->first();
        return $media->img_link;
    }

    public function getPriceAttribute() {
        return $this->price()->get();
    }

    public function getMediaAttribute() {
        return $this->media()->get();
    }

    public function getDisplayPriceAttribute(): string
    {
        $min = $this->price()->min('price');
        $max = $this->price()->max('price');
        return getMoneyFormat($min).' - '.getMoneyFormat($max);
    }

    public function setAttributeVisibility(): void
    {
        $this->makeVisible(array_merge($this->hidden, $this->appends))
            ->makeHidden(['brand', 'supplier']);
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
