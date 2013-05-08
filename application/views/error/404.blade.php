@layout('layout.header');

@section('content')
  <? $messages = array('We need a map.', 'I think we\'re lost.', 'We took a wrong turn.'); ?>

  <h2><?php echo $messages[mt_rand(0, 2)]; ?></h2>

  <h3>Server Error: 404 (Not Found)</h3>

  <hr>

  <h4>What does this mean?</h4>

  <p>
    We couldn't find the page you requested on our servers. We're really sorry
    about that.
  </p>

  <p>
    Perhaps you would like to go to our <? echo HTML::link('/', 'home page'); ?>?
  </p>

@endsection
