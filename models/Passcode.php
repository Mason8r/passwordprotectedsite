<?php

class Passcode  {

  public static function create()
  {
      $rndLetters = "abcdfghjkmnpqrtuvwxy";
      $rndNumbers = "23456789";
      $regCode = '';

      for ($i=0;$i<9;$i++) {
         
          if ($i<2||$i>6) {
  
              $iPos = round(rand(0,strlen($rndLetters)-1));
              $regCode .= substr($rndLetters,$iPos,1);
        
          } else {

              $iPos = round(rand(0,strlen($rndNumbers)-1));
              $regCode .= substr($rndNumbers,$iPos,1);
          }

      } 

      return Passcode::unique($regCode);
  }

  public static function unique($regCode)
  {

      if(Regcode::where('reg_code','=',$regCode)->count() != 0) {

        return Passcode::create();

      }

      return $regCode;

  }

}
