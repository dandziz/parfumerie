<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfume extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'perfumes';
    protected $fillable = ['code', 'name', 'slug', 'gender', 'origin', 'description', 'brand_id', 'supplier_id', 'user_id'];
}
