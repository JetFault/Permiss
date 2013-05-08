@layout('layout.header')

@section('content')
  <div class="row"> 
    <div class="small-6 columns">
      <div class="panel radius">
        <? $student = $req->student; ?>
        <h3>{{{ $student->user->name }}}</h3>
        <p><span style="font-weight:bold;">NetID: </span>{{{ $student->user->netid }}}</p>
        <p><span style="font-weight:bold;">RUID: </span>{{{ $student->user->ruid }}}</p>
        <p><span style="font-weight:bold;">Email: </span>{{{ $student->user->email }}}</p>
        <p><span style="font-weight:bold;">Graduating: </span>{{{ $student->grad_semester . " " . $student->grad_year }}}</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="small-12 columns">
      <div class="request">
        <div class="panel radius">
          <? $sect = $req->sect; ?>
          <? $course = $sect->course; ?>
          <h3 style="display:inline; margin-right: 10px;">{{{ $course->name }}}</h3><span>{{{ $course->school_num . ":" . $course->dept_num . ":" . $course->course_num }}}</span>
          <p></p>
          <p><span style="font-weight:bold;">Section: </span>{{{ $sect->course_index }}}</p>
          <p><span style="font-weight:bold;">Status: </span>{{{ $req->status }}}</p>
          <p><span style="font-weight:bold;">Priority: </span>{{{ $req->priority }}}</p>
          <p><span style="font-weight:bold;">Required: </span>{{{ $req->required }}}</p>
          <div class="comment">
            <span style="font-weight:bold;">Comment:</span>
             <p>{{{ $req->comment }}}</p>
          </div>
          @if( $req->status === 'pending')
          <form method="POST" action="/instructor/send_review">
            <div class="row">
            <div class="small-12 columns">
              <input type="hidden" name="request_id" value="{{{ $req->id }}}">
              <textarea id="comment" name="comment"></textarea>
              <input type="submit" name="status" value="accept" class="register-button radius button">
              <input type="submit" name="status" value="deny" class="register-button radius button">
              </div>
            </div>
          </form>
          @elseif( $req->status === 'accepted')
            <div class="small-12 columns" style="background-color:green;">Accepted</div>
          @else
            <div class="small-12 columns" style="background-color:red; text-align:center;">Denied</div>
          @endif
        </div>
      </div>
    </div>
  </div>

@endsection

