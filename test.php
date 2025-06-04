<?php 

class Square{
  public static function square($a,$b){
    return $a * $b;
  }
}

echo Square ::square(2,3);