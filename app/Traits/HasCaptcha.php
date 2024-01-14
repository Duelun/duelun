<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait HasCaptcha {

    public function validateCaptcha(Request $request) {
        $messages = [
            'g-recaptcha-response.required' => 'You must check the reCAPTCHA.',
            'g-recaptcha-response.captcha' => 'Captcha invalid. Please try again later or contact the site administrator.',
        ];
 
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha'
        ], $messages);
 
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
    }

}