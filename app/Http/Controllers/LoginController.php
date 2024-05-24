<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Person;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginPage(){
        $error = '';
        $categories = Category::get()->toArray();
        $data = compact('error','categories');
        return view('login')->with($data);
    }

    public function showRegisterPage(){
        $categories = Category::get()->toArray();
        $data = compact('categories');
        return view('register')->with($data);
    }

    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $person = Person::where('email','=',$request['email'])->get()->toArray();
        if ($person == null){
            $error = 'User not found.';
            $categories = Category::get()->toArray();
            $data = compact('error','categories');
            return view('login')->with($data);
        }else{
            $password = $person[0]['password'];
            if ($password != sha1($request['password'])){
                $error = 'Password is incorrect.';
                $categories = Category::get()->toArray();
                $data = compact('error','categories');
                return view('login')->with($data);
            }else{
                session()->put([
                    'name' => $person[0]['name'],
                    'role' => $person[0]['role']
                ]);

                Person::where('email','=',$request['email'])->update([
                    'status' => true,
                ]);

                return redirect('/');
            }
        }
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $person = new Person();
        $person->name = $request['name'];
        $person->email = $request['email'];
        $person->password = sha1($request['password']);
        $person->role = 'user';
        // echo '<pre>';
        // print_r($person);
        // echo '</pre>';die;
        $person->save();

        return redirect('/');
    }
}
