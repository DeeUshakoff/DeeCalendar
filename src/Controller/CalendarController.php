<?php

namespace App\Controller;

use App\Entity\Month;
use http\QueryString;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class CalendarController extends AbstractController
{
    #[Route('/calendar/{monthNumber?}', methods: ['GET'])]
    public function Calendar(Request $request, ?int $monthNumber){
        if(is_null($monthNumber)){
            $monthNumber = date('m');
        }

        if($monthNumber < 1 || $monthNumber > 12){
            return new Response($this->render('error.twig',['errorCode'=>'666', 'errorExplanation'=>'Month number must be in range [1;12]']) );
        }


        $formatting = $request->get('formatting');
        $selectWeekends = $request->get('selectWeekends') == 'true';
        $year = date('Y');

        $month = new Month($monthNumber, $year);

        if($formatting == 'list'){
            return new Response($this->render('calendar.list.twig',['month'=>$month]) );
        }
        if($formatting == 'table'){
            return new Response($this->render('calendar.table.twig',['month'=>$month, 'selectWeekends' => $selectWeekends]) );
        }
        return new Response($this->render('calendar.list.twig',['month'=>$month]) );
    }
}