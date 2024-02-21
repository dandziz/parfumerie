<?php

namespace App\Models;

use App\Models\Scopes\MediaScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'img', 'thumb', 'type', 'img_sort'];
    protected $hidden = ['img', 'thumb'];
    protected $appends = ['img_link', 'thumb_link'];
    public function getImgLinkAttribute() {
        return asset('storage/images/'.$this->img);
    }

    public function getThumbLinkAttribute() {
        return asset('storage/images/'.$this->thumb);
    }

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new MediaScope());
    }
}
