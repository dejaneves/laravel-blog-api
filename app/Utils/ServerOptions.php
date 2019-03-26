<?php

namespace App\Utils;

class ServerOptions {
  
  public function CodeError() {
    $code['DATABASE_ERROR'] = 1;
    $code['ERROR_CREATE_TO_DB'] = 2;
    $code['INVALID_FIELDS'] = 3;

    return $code; 
  }

}
