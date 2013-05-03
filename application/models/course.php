<?php

class Course extends Eloquent {
  public static $timestamps = false;

  public function sections() {
    return $this->has_many_and_belongs_to('Section');
  }

  public function students() {
    return $this->has_many_and_belongs_to('Student');
  }
}
