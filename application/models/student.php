<?php

class Student extends Eloquent {
  public static $timestamps = false;

  public function user() {
    return $this->belongs_to('User');
  }

  public function majors() {
    return $this->has_many_and_belongs_to('Major');
  }

}
