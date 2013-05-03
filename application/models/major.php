<?php

class Major extends Eloquent {
  public static $timestamps = false;

  public function students() {
    return $this->has_many_and_belongs_to('Student');
  }
}
