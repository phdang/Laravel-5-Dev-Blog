@extends('layouts.master')
@section('content')
@include('includes.message-block')

  <section class="row new-post">

    <div class="col-md-6 col-md-offset-3">

      <header><h3>What do you have to say?</h3></header>

      <form action="{{route('post.create')}}" method="post">

        <div class="form-group">

          <textarea class="form-control" name="body" id="body" rows="5" placeholder="Your post"></textarea>

        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>

        <input type="hidden" name="_token" value="{{ Session::token()}}">

      </form>

    </div>

  </section>

  <section class="row posts">

    <div class="col-md-6 col-md-offset-3">

        <header><h3>What other people say...</h3></header>

        <?php foreach($posts as $post ): ?>

        <article class="post" data-postid="{{$post->id}}">

          <p><?= $post->body ?></p>

          <div class="info">Posted by {{$post->user->first_name}} at  {{date('d/m/Y H:i', strtotime($post->created_at))}}</div>

          <div class="interation">

            <a href="#" class="like"><?= $user->likes()->where('post_id', $post->id)->first() ? $user->likes()->where('post_id', $post->id)->first()->like ? 'You liked this post' : 'Like' : 'Like' ?></a> |

            <a href="#" class="like"><?= $user->likes()->where('post_id', $post->id)->first() ? $user->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You disliked this post' : 'Dislike' : 'Dislike' ?></a>
            @if (Auth::user() == $post->user)
            |

            <a class="edit-modal" href="#">Edit</a> |

            <a href="{{route('post.delete', ['post_id' => $post->id])}}">Delete</a>

            @endif

          </div>

        </article>

      <?php endforeach ?>

    </div>

  </section>

  <div class="modal fade" tabindex="-1" role="dialog" id="my-edit-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Post</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="">

          <div class="form-group">

            <label for="post-body">Edit the Post</label>

            <textarea name="post-body" id="post-body" class="form-control" rows="5"></textarea>

          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
  var token = '{{Session::token()}}';
  var urlEdit = '{{route('edit')}}';
  var urlLike = '{{route('like')}}';
</script>

@endsection