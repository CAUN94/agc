<?php

namespace App\Http\Controllers;

use App\Mail\ContactExample;
use Illuminate\Http\Request;

class MailContactController extends Controller
{
    public function show()
    {
        return view('admin.contact.index');
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        \Mail::to($request->email)
            ->send(new ContactExample());

        return redirect('/mailcontact')
            ->with('message', 'Email sent!');
    }
}
