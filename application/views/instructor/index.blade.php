@layout('instr_head')

@section('content')
  <div class="courses">

    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Course</th>
          <th># Applicants</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sects as $sect)
          <tr>
            <td>{{{ $sect->course->name }}}
            <td>{{{ $sect->course->school_num . $sect->course->dept_num . $course->course->course_num }}}
            <td>{{{ count($sect->reqs()) }}}
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>

@endsection

