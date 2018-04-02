<header>

  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="{{route('dashboard')}}">Dev Blog</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    @if(Auth::user())

   <div class="navbar-collapse" id="bs-example-navbar-collapse-1">

     <ul class="nav navbar-nav navbar-right">

        <li><a href="{{route('logout')}}">Log out</a></li>

        <li><a href="{{route('account')}}">My Account</a></li>

        @if(Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))


        <li class="user-image"><a href="{{route('account')}}"><img src="{{route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg'])}}" alt="{{$user->first_name}}" class=""></a></li>

        @endif

      </ul>

   </div>
   @endif
  </div>
</nav>

</header>
