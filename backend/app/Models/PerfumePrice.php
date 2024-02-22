<?php

namespace App\Models;

use App\Models\Scopes\PriceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfumePrice extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'perfume_price';

    protected $fillable = ['perfume_id', 'capacity', 'import_price', 'price', 'quantity'];
    protected $casts = [
        'quantity' => 'boolean',
    ];

    public function perfume(): BelongsTo {
        return $this->belongsTo(Perfume::class);
    }

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new PriceScope());
    }
}
