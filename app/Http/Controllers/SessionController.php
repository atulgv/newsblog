<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getSession(Request $request){
        $session = $request->session()->all();

        echo '<pre>';
        print_r($session);
        echo '</pre>';
    }

    public function setSession(Request $request){
        $request->session()->put(
            [
                'name' => 'atul',
                'role' => 'admin'
            ]
        );

        return redirect('/');
    }

    public function destroySession(Request $request){
        Person::where('name','=',session()->get('name'))->update([
            'status' => false,
        ]);
        $request->session()->forget(['name','role']);

        return redirect('/');
    }
}
