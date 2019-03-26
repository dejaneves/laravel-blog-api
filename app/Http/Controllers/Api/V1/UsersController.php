<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Users;
use App\Http\Controllers\Controller;
use Exception;

use Illuminate\Http\Request;

class UsersController extends Controller {

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
   * @param  \App\Models\Users  $users
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    try {
      $this->response["data"] = Users::find($id);
    } catch (Exception $e) {
      $this->response["error"] = $e->getMessage();
    }
    return $this->response;
  }

  /**
   * Save user
   */
  public function store(Request $request) {
    try {
      $users = new Users();

      $users->name = $request->name;
      $users->username = $request->username;
      $users->email = $request->email; 
      $users->address = $request->address;
      $users->phone = $request->phone;
      $users->website = $request->website;
      $users->company = $request->company;

      $this->response["data"] = $users->save();
    } catch (Exception $e) {
      $this->response["error"] = $e->getMessage();
    }
    return $this->response;
  }

}
