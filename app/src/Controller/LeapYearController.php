<?php
namespace Crimsoncircle\Controller;

use Crimsoncircle\Model\LeapYear;
use Crimsoncircle\Model\Conectabd;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{   
    public function index(Request $request, ?int $year): string
    {   
        if ($year ==null) {
            $year = date('Y');
        }
        echo $request->query->get('filter');
        $leapYear = new LeapYear();
        $variable =$leapYear->isLeapYear($year);
        if ($leapYear->isLeapYear($year)==1) {
            return 'Yep, this is a leap year!';
        } else {
            return 'Nope, this is not a leap year.';
        }
        
    }

}