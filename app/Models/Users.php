<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Users extends Eloquent {
  
  protected $connection = 'mongodb';
  protected $collection = 'users';

  protected $primaryKey = 'id';

  protected $hidden = array(
    '_id'
  );

  public function posts(){
    return $this->hasMany('App\Models\Posts');
  }

}
