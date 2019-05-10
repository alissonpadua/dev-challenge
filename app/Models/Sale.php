<?php

namespace DevChallenge\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sale extends Model
{
    protected $fillable = [
      'user_id',
      'client_id',
      'paymode_id'
    ];

    public function products() {
      $products = [];
      foreach($this->salesLine as $line) {
        $product = $line->product;
        $product->qty = $line->qty;
        $product->price = 'R$ ' . number_format($product->price , 2, ',', '.');
        array_push($products, $line->product);
      }
      return $products;
    }

    public function salesLine() {
      return $this->hasMany('DevChallenge\Models\ProductSale');
    }

    public function client() {
      return $this->belongsTo('DevChallenge\Models\Client');
    }

    public function paymode() {
      return $this->belongsTo('DevChallenge\Models\Paymode');
    }

    public function getCreatedAtAttribute($value){
      return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
    }

}
