<?php

namespace Crimsoncircle\Model;

class LeapYear
{
    public function isLeapYear($year): bool
    {
        $entre100=fmod($year,100);
        $entre4=fmod($year,4);
        $entre400=fmod(fmod($year,400),200);
        $biciesto =false;
        
        if ($entre4==0){
            if ($entre100==0){
                if ($entre400==0){
                    $biciesto=true;
                }
            }else{
                $biciesto=true;
            }
        }
        return $biciesto;
          
    }
}