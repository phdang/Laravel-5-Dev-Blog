<?php
  namespace App\Http\Controllers;

  use Illuminate\Http\Request;

  use Illuminate\Support\Facades\Auth;

  use App\Post;

  use App\Like;

  class PostController extends Controller {

    public function postCreatePost(Request $request) {

      //Validation

      $this->validate($request, [
        'body' => 'required|max:1000'
      ]);
      $post = new Post();

      $post->body = $request['body'];
      $message = 'There was an error!';
      if ($request->user()->posts()->save($post)) {
          $message = 'Post successfully created!';
      }

      return redirect()->route('dashboard')->with(['message' => $message]);

    }

    public function getDashboard() {
      $posts = Post::orderBy('created_at', 'desc')->get();
      return view('vendor/dashboard', ['posts'=> $posts, 'user' => Auth::user()]);
    }

    public function getDeletePost($post_id) {
      $post = Post::where('id', $post_id)->first();
      if (!isset($post)) {
        return redirect()->route('dashboard');
      }
      if (Auth::user() != $post->user) {
        return redirect()->back();
      }
      $post->delete();
      return redirect()->route('dashboard')->with(['message' => 'Successfully deleted!']);
    }

    public function postEditPost(Request $request) {

      $this->validate($request, [
        'body' => 'required|max:1000'
      ]);
      $post = Post::find($request['postId']);

      if (Auth::user() != $post->user) {
        return redirect()->back();
      }
      $post->body = $request['body'];
      $post->update();
      return response()->json(['new-body' => $post->body],200);
    }


    public function postLikePost(Request $request) {
      $post_id = $request['postId'];
      $is_like = $request['isLike'] === 'true';
      $update = false;
      $post = Post::find($post_id);
      if (!$post) {
        return 'No Post Found';
      }
      $user = Auth::user();
      $like = $user->likes()->where('post_id', $post_id)->first();
      // user already hit a like or dislike
      if ($like) {

        $already_like = $like->like;
        $update = true;
        // user click again to like or dislike which was clicked before
        if ($already_like == $is_like) {
          $like->delete();
          return 'Value set to neutral';
        }

      //user hasn't clicked like or dislike yet !

      } else {

        $like = new Like();
      }

      $like->like =  $is_like;
      $like->user_id = $user->id;
      $like->post_id = $post->id;
      if ($update) {
        $like->update();
      } else {
        $like ->save();
      }

      return 'Value created or changed';
    }

  }
