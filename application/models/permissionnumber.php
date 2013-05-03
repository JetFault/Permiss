<?php

class PermissionNumber extends Eloquent {
  public static $timestamps = false;

  public function students() {
    return $this->belongs_to('Student');
  }

  public function sections() {
    return $this->belongs_to('Section');
  }
}
