<?php
class User_Controller extends Base_Controller {

  public function get_login() {
    // Should render form for login
    return View::make('user.login');
  }

  public function post_login() {
    $netid = Input::get('netid');
    $password = Input::get('password');

    if (Input::get('affiliation') === 'faculty') {
      Config::set('auth.table', 'facultys');
      Config::set('auth.model', 'Faculty');
    }

    $credentials = array(
      'username' => $netid,
      'password' => $password
    );

    if(Auth::attempt($credentials)) {
      //var_dump(Auth::user());die;
      return Redirect::to('/home');
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
    $id = Input::get('id');
    $netid = Input::get('netid');
    $name = Input::get('name');
    $password = Input::get('password');
    $affiliation = Input::get('affiliation');

    $rules = array(
      'email' => 'required|email|unique:students|unique:facultys|confirmed',
      'id' => 'required|unique:students|unique:facultys|integer',
      'netid' => 'required|unique:students|unique:facultys',
      'name' => 'required',
      'password' => 'required|confirmed',
      'affiliation' => 'required|in:faculty,student'
    );

    $user = null;
    if($affiliation === 'faculty') {
      Config::set('auth.table', 'facultys');
      Config::set('auth.model', 'Faculty');
    } else if($affiliation === 'student') {
      $rules['gradsemester'] = 'required|in:fall,winter,spring,summer';
      $rules['gradyear'] = 'required|integer|between:1700,3000';
    }

    $validation = Validator::make($input, $rules);

    if($validation->fails()) {
      //var_dump($validation->errors->all());
      return Redirect::to_action('user@register')->with_input()->with_errors($validation);
    }

    $user = null;
    if($affiliation === 'faculty') {
      $user = new Faculty();
    } else {
      $user = new Student();
      $user->gradsemester = $input['gradsemester'];
      $user->gradyear = $input['gradyear'];
    }

    $user->email = $email;
    $user->id = $id;
    $user->netid = $netid;
    $user->name = $name;
    $user->password = Hash::make($password);
    $user->save();

    if (is_null($user)) {
      return Redirect::to_action('home@register')->with_input->with_errors(array('Failed to save user'));
    }

    Auth::login($user);
    return Redirect::to_action('home@index');
  }

  public function get_logout() {
    Auth::logout();
    return Redirect::to('/');
  }

}
