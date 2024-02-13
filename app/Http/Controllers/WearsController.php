<?php

namespace App\Http\Controllers;
use Ramsey\Uuid\Uuid;
use App\Models\Sessions;
use App\Models\Sports;
use App\Models\Wears;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Http\Traits\GeneralTrait ;
class WearsController extends Controller
{
   use GeneralTrait;
    public function index(){
      $data =  $Wears = Wears::get();
        return $this->apiResponse($data, true, null, 200);
    }

    public function store(Request $request){
        // echo $request->sessions_id;
    // $validator=Validator::make($request->all(), [
    //         'image'=>'required'|'string',
    //         'sessions_id'=>'required|exists:sessions,id',
    //         'Sports_id'=>'exists:sports,id',
    //   ]);
    //   if ($validator->fails()) {
    //      return $this->requiredField($validator->errors()->first());
         
    //      }
       
        $wear = new Wears();
        $wear->uuid=Uuid::uuid4();
        $wear->image=$request->input('image');
        $wear->Sports_id=$request->input('Sports_id');
        $wear->sessions_id=$request->input('sessions_id');
        $wear->save();
            return response()->json(['message'=>"Done"]);
    }

}

