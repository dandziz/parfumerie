<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfumePrice extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'perfume_price';

    protected $fillable = ['perfume_id', 'capacity', 'import_price', 'price'];

    public function perfume(): BelongsTo {
        return $this->belongsTo(Perfume::class);
    }
}
