<?php
class User_Controller extends Base_Controller {

  public function action_login() {
    $netid = Input::get('netid');
    $password = Input::get('password');

    $credentials = array(
      'username' => $netid,
      'password' => $password
    );

    if(Auth::attempt($credentials)) {
      return Redirect::to('dashboard/index');
    } else {
      echo "Failed to login!";
    }
  }

  public function action_register() {
    $email = Input::get('email');
    $ruid = Input::get('ruid');
    $netid = Input::get('netid');
    $name = Input::get('name');
    $password = Input::get('password');

    try {
      $user = new User();
      $user->email = $email;
      $user->ruid = $ruid;
      $user->netid = $netid;
      $user->name = $name;
      $user->password = Hash::make($password);
      Auth::login($user);

      return Redirect::to('dashboard/index');
    } catch(Exception $e) {
      echo "Failed to create new user!" . $e;
    }
  }

  public function action_logout() {
    Auth::logout();
    echo "Logged out";
  }

}
?>
