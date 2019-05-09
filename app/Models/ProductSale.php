<?php

namespace DevChallenge\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    protected $fillable = [
      'product_id',
      'sale_id'
    ];
}
