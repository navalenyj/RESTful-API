<?php

namespace App\Http\Controllers;


use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotebookController extends Controller
{
    public function notebook(){
        return response()->json(Notebook::get() , 200);
    }

    public function notebookSave(Request $req){
        $rules = [
            'full_name' => 'required',
            'phone' => 'integer|min:10',
            'email' => 'required|email',
            'birthdate' => 'date_format:Y-m-d',
            'image'=> 'image'
        ];
        $validator = Validator::make($req->all() ,$rules);
        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $path = null;
        if($req->file('image')){
            $path = $req->file('image')->store('uploads','public');
        }
        $record = Notebook::create([
            'full_name' => $req->full_name,
            'company' => $req->company,
            'phone' => $req->phone,
            'email' => $req->email,
            'birthdate' => $req->birthdate,
            'image' => $path,

        ]);
        return response()->json($record , 201);
    }

    public function notebookById($id){
        $record = Notebook::find($id);
        if (is_null($record)){
            return response()->json(['error' => true , 'message' => 'Not found'] , 404 );
        }
        return response()->json($record, 200);
    }

    public function notebookEdit(Request $req, $id){
        $record = Notebook::find($id);
        if (is_null($record)){
            return response()->json(['error' => true , 'message' => 'Not found'] , 404 );
        }
        $rules = [
            'phone' => 'integer|min:10',
            'email' => 'email',
            'birthdate' => 'date_format:Y-m-d',
            'image'=> 'image'
        ];

        $validator = Validator::make($req->all() ,$rules);

        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $record->update($req->all());


        if($req->file('image')){
            $path = $req->file('image')->store('uploads','public');
            $record->image = $path;
            $record->save();
        }

        return response()->json($record , 200);
    }

    public function notebookDelete($id){
        $record = Notebook::find($id);
        if (is_null($record)){
            return response()->json(['error' => true , 'message' => 'Not found'] , 404 );
        }
        $record->delete();
        return response()->json('' , 204);
    }
}
