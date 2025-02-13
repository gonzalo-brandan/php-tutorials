<?php
namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Core\Router;
use Core\View;

class PostController {
  public function index() {
    return "All posts";
  }
  public function show($id) {
    //1. fetch
    $post = Post::find($id);
    //2. 404
    if(!$post){
      Router::notFound();
    }
    //3. load comments
    $comments = Comment::forPost($id);
    //4. Increment view number
    Post::incrementViews($id);
    //5. render
    return View::render(
      template: 'post/show',
      layout: 'layouts/main',
      data: ['post' => $post, 'comments' => $comments]
    );

  }
}