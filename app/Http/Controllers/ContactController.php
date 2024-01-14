<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactAudit;
use App\Traits\HasCaptcha;

class ContactController extends Controller
{
    //
    use HasCaptcha;

    public function index()
    {
        return view('contact');
    }

    protected function contains($needle, $haystack): bool {
        return strpos($haystack, $needle) !== false;
    }

    public function shouldBlock($message): bool {
        //Check for any blacklisted keywords
        $blacklist = ['our services', 'contact us', 'automated message', 'http', 'www', 'whatsapp', 'whats app'];

        foreach($blacklist as $word) {
            if($this->contains($word, $message)) {
                return true;
            }
        }
        return false;
    }

    public function send(Request $request) {
        //Validate captcha and return the redirect request IF not null
        $isFailed = $this->validateCaptcha($request);
        if($isFailed) return $isFailed;

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|max:10000'
        ]);

        $shouldBlock = $this->shouldBlock(strtolower($validated['message']));

        //Log request
        $ip = $request->ip();
        $user_agent = $request->userAgent();
        ContactAudit::create([
            'ip' => $ip,
            'user_agent' => $user_agent,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_blocked' => $shouldBlock
        ]);

        if($shouldBlock) {
            return redirect('/contact')->withErrors('Sorry, we could not send this email. Please try again later.');
        }

        //Send email
        $recipient = new \stdClass();
        $recipient->name = "Dual Element Universe";
        $recipient->email = "laszlocseik@duelun.com";

        //dd($recipient);

        Mail::to($recipient)->send(new Contact($request));

        return redirect('/contact')->with('alert_message', 'Your email has been sent. I will get back to you as soon as possible.');
    }
}
