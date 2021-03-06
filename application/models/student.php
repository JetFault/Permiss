<?php

class Student extends Eloquent {
  public static $timestamps = false;

  public function user() {
    return $this->belongs_to('User');
  }

  public function majors() {
    return $this->has_many_and_belongs_to('Major');
  }

  public function courses() {
    return $this->has_many_and_belongs_to('Course');
  }

  public function reqs() {
    return $this->has_many('Req');
  }

  public function permissionnumbers() {
    return $this->has_many_and_belongs_to('PermissionNumber');
  }
}
