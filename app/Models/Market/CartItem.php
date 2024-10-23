<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'product_id', 'color_id', 'guarantee_id', 'number',];


}
