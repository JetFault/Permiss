<?php

class Section extends Eloquent {
  public static $timestamps = false;

  public function course() {
    return $this->belongs_to('Course');
  }

  public function instructor() {
    return $this->belongs_to('Instructor');
  }
}
