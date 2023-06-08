<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Curso;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use \Datetime;

class PDFController extends Controller {
    
    public function imprimir($view, $fileName, $course, $name){


        if($view == 'pdf.ejemplo') {

            $studyName = $name;
            $cou = Curso::where('id_curso',$course)->get();
            $courseName = $cou[0]->nombre;
            $date = new DateTime();
            $todayDate = $date->format('Y-m-d H:i:s');

            $pdf = \PDF::loadView($view, compact('studyName', 'courseName', 'todayDate'));
            return $pdf->download($fileName);
        }        

        $pdf = \PDF::loadView($view);
        return $pdf->download($fileName);
    }

    public function imprimirParams(Request $request){    
        
        $request->validate([
            'view' => ['required'],
            'fileName' => ['required'],
        ]);
        
        $params = $request["params"];
        $pdf = \PDF::loadView('pdf.ejemplo');
        return $pdf->download($fileName);
    }
}