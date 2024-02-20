<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'img', 'thumb', 'type', 'img_sort'];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
