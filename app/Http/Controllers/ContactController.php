<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function index() {
        return view('contact');
    }

    public function submit(Request $request) {

        // server side validation of the form
        $this->validate($request, [
            'name' => 'required|string',
            'email'  => 'required|email',
            'msg' => 'required|string'
        ]);
        
        // adding inputs to the database
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->msg = $request->msg;
        $contact->save();
        

        return redirect('/contact')->with('msg_success', 'Message Sent Successfully');

       
        
       // $msg_success = 'Message Sent Successfully';
       // return redirect('contact', compact('msg_success'));
    }
}
