@layout('layout.header')

@section('head')
  <script src="/js/sorttable.js"></script>
@endsection

@section('content')
  <div class="row"> 
    <div class="small-6 columns">

      <div class="panel radius">
        <h3>{{{ $course->name }}}</h3>
        <p>{{{ $course->school_num . ":" . $course->dept_num . ":" . $course->course_num }}}</p>
      </div>
    </div>
    <div class="small-6 columns">

      <div class="panel radius">
        <p>Applicants: {{{ count($reqs) }}}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="small-12 columns">
      <div class="requests">
        <table style="width:100%;" class="sortable">
          <thead>
            <tr>
              <th width="200">Name</th>
              <th width="150">NetID</th>
              <th>Section</th>
              <th>Grad Date</th>
              <th width="90">Required</th>
              <th width="90">Priority</th>
              <th class="sorttable_nosort">Request</th>
              <th class="sorttable_nosort">Student</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($reqs as $req)
              <? $student = Student::where('id', '=', $req->student_id)->first(); ?>
              <tr>
                <td>{{{ $student->user->name }}}</td>
                <td>{{{ $student->user->netid }}}</td>
                <td>{{{ $req->course_index }}}</td>
                <td>{{{ $student->grad_semester . " " . $student->grad_year }}}</td>
                <td>{{{ $req->required }}}</td>
                <td>{{{ $req->priority }}}</td>
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

