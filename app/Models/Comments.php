<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Comments extends Eloquent {
  
  protected $connection = 'mongodb';
  protected $collection = 'comments';

  protected $primaryKey = 'id';

  protected $hidden = array(
    '_id'
  );

}
