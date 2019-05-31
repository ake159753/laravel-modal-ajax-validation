<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personal;
use Illuminate\Support\Facades\Response;

class UserPageController extends Controller
{
    public function index(){
        $personal = personal::latest()->paginate(5);

        return view('welcome', compact('personal'));
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $firstName = $request->input('firstname');
            if(!$firstName){
                $personal = personal::latest()->paginate(5);
                return view('recordsTable', compact('personal'))->render();
            }else{
                $personal = personal::Where('firstname', 'like', '%' . $firstName . '%')->latest()->paginate(5);
                //dd($personal);
                return view('recordsTable', compact('personal'))->render();
            }

        }
    }

    function search(Request $request)
    {
        $firstName = $request->input('firstname');
        $lastName = $request->input('lastname');


        $personal = personal::query();

        if (!empty($firstName)) {
            $personal = $personal->where('firstname', 'like', '%'.$firstName.'%');
        }
        if (!empty($lastName)) {
            $personal = $personal->where('lastname', 'like', '%'.$lastName.'%');
        }

        $personal = $personal->paginate(5);
        //$personal = personal::Where('firstname', 'like', '%' . $firstName . '%')->paginate(5);
        //dd($personal);
        return view('recordsTable', compact('personal'))->render();

      /*  firlds = ['firstname', 'lastname'];
        foreach ($firlds as $field){
            if(!empty($request->$field)){
                $personal = personal::Where($field, '=', $request->$field)->latest()->paginate(5);
            }
        }*/


    }

    public function store(request $request){

        //dd($request);
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

        $personal = personal::latest()->paginate(5);

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

    public function deleteRecord(request $request) {

        $id=$request->input('id');

        $delRecord = personal::find($id);
        $delRecord->delete();

        $personal = personal::latest()->paginate(5);
        $html = view('recordsTable')->with(compact('personal'))
            ->render();

        return response()->json(['success' => true, 'html' => $html]);
    }
    public function storeDynamicly(request $request) {
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
            // dd(123);
            $file = $request->file('cv');
            $filename = $file->getClientOriginalName();
            $filename = date('Y-m-d_H-i-s') . "_" . $filename;
            $file->storeAs('/public/upload/cv/', $filename);

            $newRecord->cv = $filename;
        }
        $newRecord->save();

        $personal = personal::latest()->paginate(5);

        $html = view('recordsTable')->with(compact('personal'))
            ->render();

        return response()->json(['success' => true, 'html' => $html]);
    }
    public function update(request $request) {

        $id = $request->input('editId');
        $editRecord = personal::find($id);
        $editRecord->firstname = $request->input('editFirstname');
        $editRecord->lastname = $request->input('editLastname');
        $editRecord->birthdate = $request->input('editBirthdate');
        $editRecord->status = $request->input('editStatus');
        $editRecord->save();

        if ($request->hasFile('cv') ) {
            // dd(123);
            $file = $request->file('cv');
            $filename = $file->getClientOriginalName();
            $filename = date('Y-m-d_H-i-s') . "_" . $filename;
            $file->storeAs('/public/upload/cv/', $filename);

            $editRecord->cv = $filename;
        }

        $personal = personal::latest()->paginate(5);

        $html = view('recordsTable')->with(compact('personal'))
            ->render();

        return response()->json(['success' => true, 'html' => $html]);
    }
}
