<?php

namespace DevChallenge\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
      'category_id',
      'description',
      'price'
    ];

    public function category(){
      return $this->belongsTo('DevChallenge\Models\Category');
    }
}
