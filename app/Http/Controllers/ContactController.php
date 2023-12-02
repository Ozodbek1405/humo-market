<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contacts.contact');
    }

    public function send_message(ContactRequest $request)
    {
        $data = $request->validated();
        Contact::query()->create($data);
        return redirect()->back()->with('success', 'Sent successfully');
    }
}
