<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Color extends Model
{
    use HasFactory,Translatable;

    protected array $translatable = ['name'];
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'color_id','id');
    }
}
