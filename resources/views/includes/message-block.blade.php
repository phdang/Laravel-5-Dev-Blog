<?php if(count($errors) > 0) {?>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 error">

      <ul>
        <?php foreach ($errors->all() as $error):?>
          <li> <?=$error?> </li>
        <?php endforeach ?>

      </ul>

  </div>

</div>

<?php } ?>
@if(Session::has('message'))

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 success">
    {{Session::get('message')}}
  </div>

</div>

 <script>

 window.onload = function() {


   $('.success').fadeOut(3000);
}

 </script>

@endif
