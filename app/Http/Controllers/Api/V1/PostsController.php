<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Posts;
use App\Http\Controllers\Controller;
use Exception;

use Illuminate\Http\Request;

class PostsController extends Controller {

  private $response = [
    "data" => null,
    "error" => null
  ];

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    //
  }

  public function __construct() {}

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Posts  $posts
   */
  public function show($id) {
    try {
      $paramId = $id * 1;
      $this->response["data"] = Posts::with('autor','comments')->where('id',$paramId)->first();
    } catch (Exception $e) {
      $this->response["error"] = $e->getMessage();
    }
    return $this->response;
  }

}
