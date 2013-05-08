<?php

class Sect extends Eloquent {
  public static $timestamps = false;

  public $includes = array('course');

  public function course() {
    return $this->belongs_to('Course');
  }

  public function instructor() {
    return $this->belongs_to('Instructor');
  }

  public function reqs() {
    return $this->has_many('Req');
  }
}
