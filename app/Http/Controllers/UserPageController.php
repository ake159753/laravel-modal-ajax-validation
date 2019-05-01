<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPageController extends Controller
{
   public function store(request $request){
       request()->validate([
           'firstname' => 'required',
           'lastname' => 'required',
       ],
           [
               'firstname.required' => 'please enter firstname!',
               'lastname.required' => 'please enter lastname!',
           ]);

dd($request);
   }
}
