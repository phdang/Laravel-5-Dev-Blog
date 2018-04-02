<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    function posts() {
      return $this->hasMany('App\Post');
    }

    function likes() {
      return $this->hasMany('App\Like');
    }
}
