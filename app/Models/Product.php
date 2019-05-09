<?php

namespace DevChallenge\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
      'category_id',
      'description'
    ];
}
