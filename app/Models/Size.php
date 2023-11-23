<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function getProductSize()
    {
        return ProductSize::query()->where('size_id',$this->id)->get();
    }
}
