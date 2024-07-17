<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContentFormRequest;
use App\Models\Contact;
use Auth;

class AjaxController extends Controller
{
    public function iletisimkaydet(ContentFormRequest $request)
    {
        $newdata = [
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'ip'=>request()->ip(),
        ];

        $data = $request->all();
        $data['ip'] = request()->ip();

        $sonkaydedilen = Contact::create($newdata);

        return back()->with(['message'=>'Basariyla gonderildi']);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('anasayfa');
    }
}
