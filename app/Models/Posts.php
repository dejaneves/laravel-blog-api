<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Posts extends Eloquent {
  
  protected $connection = 'mongodb';
  protected $collection = 'posts';

  protected $primaryKey = 'id';

  protected $hidden = array(
    '_id'
  );

  public function autor(){
    return $this->belongsTo('App\Models\Users','userId', 'id')
      ->select(array('id', 'name', 'username', 'email'));
  }

  public function comments(){
    return $this->hasMany('App\Models\Comments','postId', 'id');
  }

}
