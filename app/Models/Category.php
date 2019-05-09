<?php

namespace DevChallenge\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
      'description'
    ];

    public function products(){
      return $this->hasMany('DevChallenge\Models\Product');
    }
}
