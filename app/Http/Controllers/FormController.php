<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Fields;
use Illuminate\Support\Facades\Response;
use App\Models\FieldsData;

class FormController extends Controller
{
    public function form()
    {
        $fields = Fields::get();
        $data = FieldsData::get();


        return view('form.form', compact('fields', 'data'));
    }

    public function addField(request $request)
    {

       // dd($request);
        $feildType = $request->input('feildType');
        $fieldLength = $request->input('field_length');
        $fieldName = $request->input('fieldName');


        if ($feildType == "checkbox") {
            $type = "string";

        } elseif ($feildType == "varchar") {
            $type = "string";
            $fieldClass =  $request->input('fieldClass') + " " +"";
        } elseif ($feildType == "text") {
            $type = "string";
        } elseif ($feildType == "decimal") {
            $type = "string";
        } else {
            $type = "string";
        }


        if ($feildType == "decimal") {
            $length = $fieldLength;
        } else {
            $length = 255;
        }
        $field_btn_del = "btn btn-outline-danger";

        $newField = new Fields();

        $newField->fieldLable = $request->input('fieldLable');
        $newField->feildType = $feildType;
        $newField->fieldName = $request->input('fieldName');
        $newField->feildType = $request->input('feildType');
        $newField->fieldClass = $request->input('fieldClass');
        $newField->field_btn_del = $field_btn_del;

        $newField->save();

        Schema::table('fieldsdata', function (Blueprint $table) use ($type, $length, $fieldName) {
            $table->$type($fieldName, $length)->nullable();
        });
        return back();

    }

    public function addRecord(request $request){

        $fieldsArray = Fields::select(array('fieldName'))->get();

        $newRecord = new FieldsData();

        foreach ($fieldsArray as $field) {

            $thisField = $field->fieldName;

            $newRecord->$thisField = $request->input($thisField);
        }

        $newRecord ->save();

        return back();

    }

    public function delField(request $request)
    {
        $deleteId = $request->deleteId;
        Fields::where('id', $deleteId)
            ->delete();

        //dd($request->id);
        $deleteField = $request->deleteField;
        //dd($deleteField);
        Schema::table('fieldsdata', function (Blueprint $table) use ($deleteField) {

            $table->dropColumn($deleteField);
        });

        $fields = Fields::get();


        $html = view('form.input')->with(compact('fields'))
            ->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
}
