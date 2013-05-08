<?php

class Req extends Eloquent {
  public static $timestamps = false;

  public function sect() {
    return $this->belongs_to('Sect');
  }

  public function student() {
    return $this->belongs_to('Student');
  }
}
