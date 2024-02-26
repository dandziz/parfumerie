<?php

namespace App\Models;

use App\Models\Scopes\MediaScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;
    protected $table = 'media';
    protected $fillable = ['name', 'img', 'thumb', 'type', 'img_sort'];
    protected $hidden = ['img', 'thumb', 'mediable_type', 'mediable_id', 'created_at',
        'updated_at', 'name', 'status'];
    protected $appends = ['img_link', 'thumb_link'];
    public function getImgLinkAttribute(): string
    {
        return asset('storage/images/'.$this->img);
    }

    public function getThumbLinkAttribute(): string
    {
        return asset('storage/images/'.$this->thumb);
    }

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function setAttributeVisibility(): void
    {
        $this->makeVisible(array_merge($this->hidden, $this->appends))
            ->makeHidden(['img', 'thumb', 'mediable_type']);
    }

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new MediaScope());
    }
}
