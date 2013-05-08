@layout('layout.header');

@section('content')
  <? $messages = array('You can\'t go here!', 'Not allowed!', 'You are not the droid you claim to be!'); ?>

  <h2><?php echo $messages[mt_rand(0, 2)]; ?></h2>

  <h3>Server Error: 403 (Forbidden)</h3>

  <hr>

  <h4>What does this mean?</h4>

  <p>
    It seems like you tried to access a page you don't have access to.
  </p>

  <p>
    Perhaps you would like to go to our <? echo HTML::link('/', 'home page'); ?>?
  </p>

@endsection
