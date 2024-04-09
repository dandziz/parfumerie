<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $fillable = ['name', 'quantity', 'perfume_id', 'user_id', 'price_id'];
    protected $appends = ['img_link', 'slug', 'unit_price'];
    protected $hidden = [
        'updated_at',
    ];

    public function getImgLinkAttribute(): string
    {
        $img = Media::query()->where('mediable_id', $this->perfume_id)
            ->where(function (Builder $query) {
                $query->where('type', 2)
                    ->orWhere('type', 0);
            })->orderBy('created_at')
            ->first();
        return asset('storage/images/'.$img->thumb);
    }

    public function getSlugAttribute(): string
    {
        $perfume = Perfume::query()->where('id', $this->perfume_id)->first();
        return $perfume->slug;
    }

    public function getUnitPriceAttribute(): int
    {
        return $this->price()->select(['price'])->get()->first()->price;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function price(): BelongsTo
    {
        return $this->belongsTo(PerfumePrice::class);
    }
}
