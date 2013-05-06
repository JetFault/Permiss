<?php

class Course extends Eloquent {
  public static $timestamps = false;

  public function sects() {
    return $this->has_many('Sect');
  }

  public function students() {
    return $this->has_many_and_belongs_to('Student'); }
}
