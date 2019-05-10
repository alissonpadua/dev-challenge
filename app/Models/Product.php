<?php

namespace DevChallenge\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use SoftDeletes;
  
    protected $fillable = [
      'category_id',
      'description',
      'price'
    ];

    public function category(){
      return $this->belongsTo('DevChallenge\Models\Category');
    }
}
