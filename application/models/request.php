<?php

class Request extends Eloquent {
  public static $timestamps = false;

  public function sections() {
    return $this->belongs_to('Section');
  }

  public function students() {
    return $this->belongs_to('Student');
  }
}
