<?php

class PermissionNumber extends Eloquent {
  public static $timestamps = false;

  public function students() {
    return $this->belongs_to('Student');
  }

  public function sects() {
    return $this->belongs_to('Sect');
  }
}
