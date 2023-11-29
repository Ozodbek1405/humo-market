<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShoeSize extends Model
{
    use HasFactory;

    public function shoe_size()
    {
        return $this->belongsTo(ShoeSize::class, 'shoe_size_id', 'id');
    }
}
