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
    protected $hidden = ['deleted_at', 'perfume_id', 'import_price',
        'created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'quantity' => 'boolean',
    ];

    public function perfume(): BelongsTo {
        return $this->belongsTo(Perfume::class);
    }

    public function setAttributeVisibility(): void
    {
        $this->makeVisible(array_merge($this->hidden, $this->appends));
    }

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new PriceScope());
    }
}
