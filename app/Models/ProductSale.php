<?php

namespace DevChallenge\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    protected $table = 'product_sale';
    
    protected $fillable = [
      'product_id',
      'sale_id',
      'price',
      'qty'
    ];

    public function product() {
      return $this->belongsTo('DevChallenge\Models\Product');
    }

    public function sale() {
      return $this->belongsTo('DevChallenge\Models\Sale');
    }
}
