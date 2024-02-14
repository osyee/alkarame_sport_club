<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sessions;
use App\Models\Sports;
use App\Models\Wears;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use App\Http\Traits\FileUploader;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\resourcewears;

class WearsController extends Controller
{
    
    use GeneralTrait;
    
    public function store(Request $request)
    {
        
        $fileextension=$request->image->getclientoriginalExtension();
        $filename=time().'.'.$fileextension;
        $path='images/wears';
        $request->image->move($path,$filename);
        





        $validato=Validator::make($request->all(),[
            'sessions_id'=>'required|exists:sessions,id|unique:wears,sessions_id',
            'image'=>'required',
            'Sports_id'=>'required|exists:Sports,id|unique:wears,Sports_id',

         ]);
         if($validato->fails())
         {
         $validato->errors();
         return $this->apiResponse($validato,false);
         }
        $wear=new Wears();
        $wear->uuid=Uuid::uuid4();
        $wear->image=$filename;
        $wear->sessions_id=$request->sessions_id;
        $wear->Sports_id=$request->Sports_id;
        $wear->save();
        return response()->json(['message'=>'successfull']);


    }
    public function index()
    {

        $sta=Wears::with('session','sport')->get();
        $data=resourcewears::collection(Wears::all());
         return $this->apiResponse($data);
        
    }

    public function update(REQUEST $request,$id)
    {
        $validato=Validator::make($request->all(),[
            'sessions_id'=>'required|string|exists:sessions,id|unique:wears,sessions_id',
            'image'=>'required',
            'Sports_id'=>'required|string|exists:Sports,id|unique:wears,Sports_id',

         ]);
         if($validato->fails())
         {
         $validato->errors();
         return $this->apiResponse($validato,false);
         }
      //  $uplodeimage=$request->image;
        $wear=Wears::find($id);
        $wear->uuid=Uuid::uuid4();
        $wear->image=$request->image;
        $wear->sessions_id=$request->sessions_id;
        $wear->Sports_id=$request->Sports_id;
        $input=$request->all();
        $wear->update($input);
        return response()->json(['message'=>'successfull']);
        
    }
    
    public function destore($id)
    {
        $exists=Wears::where('id',$id)->delete();
      if($exists)
      {
        return $this->apiResponse($exists,true);
      }
      else
      {
        return $this->apiResponse($exists,false);
      }

    }
}
