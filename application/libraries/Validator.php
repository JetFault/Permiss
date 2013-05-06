<?php

class Validator extends Laravel\Validator {

  public function __call($method, $parameters)
  {
      if (substr($method, -6) === '_array')
      {
          $method = substr($method, 0, -6);
          $values = $parameters[1];
          $success = true;
          foreach ($values as $value) {
              $parameters[1] = $value;
              $success &= call_user_func_array(array($this, $method), $parameters);
          }
          return $success;
      }
      else 
      {
          return parent::__call($method, $parameters);
      }
  }

  protected function message($attribute, $rule)
  {
      if (substr($rule, -6) === '_array')
      {
          $rule = substr($rule, 0, -6);
      }

      return parent::message($attribute, $rule);
  }
}
