<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personal;

class UserPageController extends Controller
{
    public function index(){
        $personal = personal::get();

        return view('welcome', compact('personal'));
    }

    public function store(request $request){

        //dd($request->input('firstname'));
        request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required',
            'status' => 'required',
            'cv' => 'required|mimes:pdf' //jpeg, png. ect... or image for all images

        ],
            [
                'firstname.required' => 'please enter firstname!',
                'lastname.required' => 'please enter lastname!',
                'birthdate.required' => 'please enter birth date!',
                'status.required' => 'please select status!',
                'cv.mimes:pdf' => 'only pdf format is allowed!',
            ]);

        $newRecord = new personal();

        $newRecord->firstname = $request->input('firstname');
        $newRecord->lastname = $request->input('lastname');
        $newRecord->birthdate = $request->input('birthdate');
        $newRecord->status = $request->input('status');

        if ($request->hasFile('cv') ) {
            $file = $request->file('cv');
            $filename = $file->getClientOriginalName();
            $filename = date('Y-m-d_H-i-s') . "_" . $filename;
            $file->storeAs('/public/upload/cv/', $filename);

            $newRecord->cv = $filename;

        }

        $newRecord->save();

        $personal = personal::get();

        $html = view('recordsTable')->with(compact('personal'))
            ->render();

        return response()->json(['success' => true, 'html' => $html]);
    }
    public function livestore(request $request)
    {

        $id = $request->input('id');
        $name = $request->input('name');
        $input = $request->input('input');

        if ($name == "status") {

            $findID = personal::where('id', '=', $id)
                ->select('id')
                ->pluck('id')
                ->first();
            $liveRecord = personal::find($findID);
            $liveRecord->$name = $input;
            $liveRecord->save();

            $personal = personal::get();
            $html = view('recordsTable')->with(compact('personal'))
                ->render();

            return response()->json(['success' => true, 'html' => $html]);

        } else {
            $findID = personal::where('id', '=', $id)
                ->select('id')
                ->pluck('id')
                ->first();

            $liveRecord = personal::find($findID);
            $liveRecord->$name = $input;
            $liveRecord->save();
        }
    }
}
