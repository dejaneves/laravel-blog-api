<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Posts;
use App\Models\Users;
use App\Utils\ServerOptions;
use App\Http\Controllers\Controller;
use Exception;

use Illuminate\Http\Request;

// Dingo\Api\Exception\DeleteResourceFailedException
// Dingo\Api\Exception\ResourceException
use Dingo\Api\Exception\StoreResourceFailedException;
// Dingo\Api\Exception\UpdateResourceFailedException

class PostsController extends Controller {

  private $response = [
    "data" => null,
    "error" => null
  ];

  public function __construct() {}

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

  /**
   * List posts by id
   *
   */
  public function show($id) {
    $paramId = $id * 1;
    $this->response["data"] = Posts::with('author','comments')->where('id',$paramId)->firstOrFail();
    return $this->response;
  }

  /**
   * Create Posts
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request) {
    $rules = [
      'title' => 'required',
      'body' => 'required'
    ];

    $rules2 = [
      'author_name' => 'required',
      'author_username' => 'required',
      'author_email' => 'required'
    ];

    $payload = app('request')->only('title', 'body');
    $validator = app('validator')->make($payload, $rules);

    if ($validator->fails()) {
      throw new StoreResourceFailedException('Could not create new post.', $validator->errors());
    }

    $nextId = Posts::max('id') + 1;
    $posts = new Posts;

    if($request->has('author_id')) {
      $authorId = floatval($request->author_id);
      $users = Users::where('id', $authorId)->first();
      if($users) {
        $posts->userId = $users->id;
      } else {
        return $this->response->errorNotFound('Could not find the user.');
      }
    } else {
      $payloadAuthor = app('request')->only('author_name','author_username', 'author_email');
      $validator2 = app('validator')->make($payloadAuthor, $rules2);

      if ($validator2->fails()) {
        throw new StoreResourceFailedException('Could not create new post.', $validator2->errors());
      }

      $resCreateAutor = $this->createAuthor($this->prepateAuthor($request));
      if($resCreateAutor['success']) {
        $posts->userId = $resCreateAutor['last_insert_id'];
      }
    }

    $posts->id = $nextId;
    $posts->title = $request->title;
    $posts->body = $request->body;
    
    $success = $posts->save();

    $result = array(
      'success' => $success,
      'last_insert_id' => $posts->id,
    );
  
    $this->response['data'] = $result;
    return $this->response;
  }

  /**
   * Prepare author storage
   * 
   * @param {Object} $fields
   */
  protected function prepateAuthor($fields) {
    $author = [];
    if($fields) {
      $author['name'] = $fields->author_name;
      $author['username'] = $fields->author_username;
      $author['email'] = $fields->author_email;
      $author['phone'] = $fields->author_phone;
      $author['website'] = $fields->author_website;
    }
    return $author;
  }

  /**
   * Create author
   */
  protected function createAuthor($author) {
    try {
      $result['success'] = false;
      $users = new Users;
      $serverOptions = new ServerOptions;

      $users->id = Users::max('id') + 1;
      $users->name = $author['name'];
      $users->username = $author['username'];
      $users->email = $author['email'];
      $users->phone = $author['phone'];
      $users->website = $author['website'];

      $success = $users->save();

      if($success) {
        $result = array(
          'success' => $success,
          'last_insert_id' => $users->id
        );
        return $result;
      } else {
        throw new Exception($serverOptions->CodeError()['ERROR_CREATE_TO_DB']);
      }
    } catch (\Exception $e) {
      $result['success'] = false;
      $result['code'] = $e->getMessage() * 1;
      return $result;
    }
  }

}
