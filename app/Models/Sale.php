<?php

namespace DevChallenge\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
      'user_id',
      'client_id',
      'paymode_id'
    ];
}
