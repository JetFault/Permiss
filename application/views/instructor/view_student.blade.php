@layout('layout.header')

@section('content')
  <div class="row"> 
    <div class="small-6 columns">
      <div class="panel radius">
        <h3>{{{ $student->user->name }}}</h3>
        <p><span style="font-weight:bold;">NetID: </span>: {{{ $student->user->netid }}}</p>
        <p><span style="font-weight:bold;">RUID: </span>: {{{ $student->user->ruid }}}</p>
        <p><span style="font-weight:bold;">Email: </span>: {{{ $student->user->email }}}</p>
        <p><span style="font-weight:bold;">Graduating: </span>{{{ $student->grad_semester . " " . $student->grad_year }}}</p>
      </div>
    </div>
  </div>

  @foreach
  <div class="row">
    <div class="small-12 columns">
      <div class="requests">
        <table style="width:100%;">
          <thead>
            <tr>
              <th width="200">Name</th>
              <th width="150">NetID</th>
              <th>Grad Date</th>
              <th width="90">Required</th>
              <th width="90">Priority</th>
              <th>Request</th>
              <th>Student</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($reqs as $req)
              <? $student = $req->student; ?>
              <tr>
                <td>{{{ $student->user->name }}}</td>
                <td>{{{ $student->user->netid }}}</td>
                <td>{{{ $student->grad_semester . " " . $student->grad_year }}}</td>
                <td>{{{ $req->priority }}}</td>
                <td>{{{ $req->required }}}</td>
                <td><a class="button" href="/instructor/view_request/{{{ $req->id }}}">Request</a></td>
                <td><a class="button success" href="/instructor/view_student/{{{ $student->id }}}">Student</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>

@endsection

