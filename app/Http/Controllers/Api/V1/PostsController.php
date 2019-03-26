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
   * List all posts
   *
   */
  public function index() {
    try {
      $this->response["data"] = Posts::with('author','comments')->get();
    } catch (Exception $e) {
      $this->response["error"] = $e->getMessage();
    }
    return $this->response;
  }

  public function __construct() {}

  /**
   * List posts by id
   *
   */
  public function show($id) {
    try {
      $paramId = $id * 1;
      $this->response["data"] = Posts::with('author','comments')->where('id',$paramId)->first();
    } catch (Exception $e) {
      $this->response["error"] = $e->getMessage();
    }
    return $this->response;
  }

}
