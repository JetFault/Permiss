<?php

class Req extends Eloquent {
  public static $timestamps = false;

  public function sects() {
    return $this->belongs_to('Sect');
  }

  public function students() {
    return $this->belongs_to('Student');
  }
}
