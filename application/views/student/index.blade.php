@layout('layout.header')

@section('head')
  <script src="/js/sorttable.js"></script>
@endsection

@section('content')
  <div class="row small-12 columns">
    <div class="requests">
      <table style="width:100%;" class="sortable">
        <thead>
          <tr>
            <th width="500">Name</th>
            <th>Course</th>
            <th class="sorttable_nosort">Section</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($reqs as $req)
            <? $course = $req->sect->course; ?>
            <tr>
              <td>{{{ $course->name }}}</td>
              <td>{{{ $course->school_num . ":" . $course->dept_num . ":" . $course->course_num }}}</td>
              <td>{{{ $req->sect->course_index }}}</td>
              <td>{{{ $req->status }}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>

@endsection
