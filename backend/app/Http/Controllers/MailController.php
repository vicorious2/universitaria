<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller {
    
    public function subscribe(Request $request){

        $validator = $request->validate([
            'email' => ['required', 'email'],
        ]);
        /*if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }*/

        $email = $request->all()['email'];

        Mail::to($email)->send(new SendMail($email));
        return new JsonResponse(['success' => true, 'message' => "Thank you for subscribing to our mail, please check your inbox"], 200);

    }

}