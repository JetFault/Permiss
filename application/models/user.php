<?php
class User extends Eloquent {
  public static $timestamps = true;

  public function user_profile() {
    return $this->has_one('User_Profile');
  }

}
?>
