<?php

class User extends Eloquent {
  public static $timestamps = false;
  public static $key = 'ruid';

  public function student() {
    return $this->has_one('Student');
  }

}

