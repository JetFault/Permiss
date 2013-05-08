@layout('layout.header')

@section('head')
  <script src="/js/sorttable.js"></script>
@endsection

@section('content')
  <div class="row small-12 columns">
    <div class="courses">

      <table style="width:100%;" class="sortable">
        <thead>
          <tr>
            <th width="500">Name</th>
            <th>Course</th>
            <th class="sorttable_nosort">Section</th>
            <th width="110"># Applicants</th>
            <th width="110" class="sorttable_nosort">More Info</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sects as $sect)
            <? $course = $sect->course; ?>
            <tr>
              <td>{{{ $course->name }}}</td>
              <td><a href="/instructor/view_course/{{{ $course->id }}}">
                {{{ $course->school_num . ":" . $course->dept_num . ":" . $course->course_num }}}
              </a></td>
              <td>{{{ $sect->course_index }}}</td>
              <td>{{{ count($sect->reqs) }}}</td>
              <td><a class="button" href="/instructor/view_section/{{{ $sect->id }}}">View</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>

@endsection

