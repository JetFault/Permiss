<?php
class User_Controller extends Base_Controller {

  public function get_index() {
    if(Auth::check()) {
      if(Session::get('role') === 'instructor') {
        return View::make('instructor.index');
      } else {
        return View::make('student.index');
      }
    } else {
      return View::make('user.login');
    }
  }

  public function get_login() {
    // Should render form for login
    return View::make('user.login');
  }

  public function post_login() {
    $netid = Input::get('netid');
    $password = Input::get('password');


    $credentials = array(
      'username' => $netid,
      'password' => $password
    );

    if(Auth::attempt($credentials)) {
      if (Input::get('affiliation') === 'instructor') {
        Session::put('role', 'instructor');
        Session::put('user', Auth::user()->instructor);
      } else {
        Session::put('role', 'student');
        Session::put('user', Auth::user()->student);
      }

      return Redirect::to_route('home');
    } else {
      return Redirect::to_action('user@login')->with('error', 'Invalid username/password');
    }
  }

  public function get_register() {
    // Should render form for registration
    return View::make('user.register');
  }

  public function post_register() {

    $input = Input::all();

    $email = Input::get('email');
    $ruid = Input::get('ruid');
    $netid = Input::get('netid');
    $name = Input::get('name');
    $password = Input::get('password');
    $affiliation = Input::get('affiliation');

    $rules = array(
      'email' => 'required|email|unique:users|confirmed',
      'ruid' => 'required|unique:users',
      'netid' => 'required|unique:users',
      'name' => 'required',
      'password' => 'required|confirmed',
      'affiliation' => 'required|in:instructor,student'
    );

    if($affiliation === 'instructor') {

    } else if($affiliation === 'student') {
      $rules['gradsemester'] = 'required|in:fall,winter,spring,summer';
      $rules['gradyear'] = 'required|integer|between:1700,3000';
    }

    $validation = Validator::make($input, $rules);

    if($validation->fails()) {
      return Redirect::to_action('user@register')->with_input()->with_errors($validation);
    }


    $user = new User();
    $user->email = $email;
    $user->ruid = $ruid;
    $user->netid = $netid;
    $user->name = $name;
    $user->password = Hash::make($password);
    $user->save();

    $role_user = null;
    if($affiliation === 'instructor') {
      $role_user = new Instructor();
    } else {
      $role_user = new Student();
      $role_user->grad_semester = $input['gradsemester'];
      $role_user->grad_year = $input['gradyear'];
    }

    $role_user->user_id = $user->ruid;

    $role_user->save();

    if (is_null($user) || is_null($role_user)) {
      $user->delete();
      return Redirect::to_action('home@register')->with_input->with_errors(array('Failed to save user'));
    }

    Auth::login($user);

    if ($affiliation === 'instructor') {
      Session::put('role', 'instructor');
      Session::put('user', Auth::user()->instructor);
    } else {
      Session::put('role', 'student');
      Session::put('user', Auth::user()->student);
    }

    return Redirect::to_route('home');
  }

  public function get_logout() {
    Auth::logout();
    Session::forget('role');
    Session::forget('user');
    return Redirect::to_route('home');
  }

}
