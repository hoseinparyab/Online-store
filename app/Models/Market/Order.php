<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
