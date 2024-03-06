<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function create(){
        return view('contact');
    }
    public function store(Request $request){
        $data = $request->all();
        Mail::to(request('email'))->send(new Contact($data));
        return back()->with('status', 'Form received, thank you')->with('alert-type', 'success');
    }
}
