<?php
class User_Controller extends Base_Controller {

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
    $ruid = Input::get('ruid');
    $netid = Input::get('netid');
    $name = Input::get('name');
    $password = Input::get('password');

    $rules = array(
      'email' => 'required|email|unique:users|confirmed',
      'ruid' => 'required|unique:users|numeric',
      'netid' => 'required|unique:users',
      'name' => 'required',
      'password' => 'required|confirmed'
    );

    $validation = Validator::make($input, $rules);

    if($validation->fails()) {
      return Redirect::to_action('user@register')->with_input->with('errors', $validation->errors);
    }

    try {
      $user = new User();
      $user->email = $email;
      $user->ruid = $ruid;
      $user->netid = $netid;
      $user->name = $name;
      $user->password = Hash::make($password);
      $user->save();
      Auth::login($user);

      return Redirect::to_action('home@index');
    } catch(Exception $e) {
      return Redirect::to_action('home@register')->with_input->with('error', $e);
    }
  }

  public function get_logout() {
    Auth::logout();
    return Redirect::to('');
  }

}
?>
