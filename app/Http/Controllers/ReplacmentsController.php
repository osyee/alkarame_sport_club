<?php

namespace App\Http\Controllers;
use Ramsey\Uuid\Uuid;

use App\Models\Replacments;
use App\Models\Matches;
use App\Models\Players;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Resources\ReplacmentResource;
class ReplacmentsController extends Controller
{
    use GeneralTrait;
    public function index(){
        
       
       $Replacments= Replacments::with('match','outplayer','inplayer')->get();
       return $this->apiResponse($Replacments,true,null,200);
          
       
    //    return $this->apiResponse($data, true, null, 200);
    }
    public function store(Request $request){
        $validator=Validator::make($request->all(), [
            
        'inplayer_id'=>"required|integer|exists:players,id",
        'outplayer_id'=>"required|integer|exists:players,id",
        'matches_id'=>"required|integer|exists:matches,id",
        ]);
        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }else{
            $Replacment = New Replacments();
            $Replacment->uuid=Uuid::uuid4();
            $Replacment->inplayer_id=$request->input('inplayer_id');
            $Replacment->outplayer_id=$request->input('outplayer_id');
            $Replacment->matches_id=$request->input('matches_id');
           $data= $Replacment->save();
            return $this->apiResponse($data, true, null, 200);
          //  return response()->json(['Message'=>'Done']);
        }
    }


    public function show($id){
        $data =  replacments::find($id);
        if ($data) {
            return $this->apiResponse($data, true, null, 200);

        } else {
            return response()->json([
                'status' =>404,
                'message'=>"Nothing to show"
            ],404);
        }
        
    }
    public function edit($id){
        $data =  replacments::find($id);
        if ($data) {
            return $this->apiResponse($data, true, null, 200);

        } else {
            return response()->json([
                'status' =>404,
                'message'=>"Nothing to show"
            ],404);
        }
    }
    public function update(Request $request ,int $id){
        
        $validator=Validator::make($request->all(), [
            
            'inplayer_id'=>"required|integer|exists:players,id",
            'outplayer_id'=>"required|integer|exists:players,id",
            'matches_id'=>"required|integer|exists:matches,id",
            ]);
            if ($validator->fails()) {
                return $this->requiredField($validator->errors()->first());
            }else{
                $Replacment = Replacments::find($id);
               if ($Replacment) {
                $Replacment->update([
              
                    'uuid'=>Uuid::uuid4(),
                    'inplayer_id'=>$request->inplayer_id,
                    'outplayer_id'=>$request->outplayer_id,
                    'matches_id'=>$request->matches_id,
                  ]);
                  return response()->json([
                    'status' =>200,
                    'message'=>"Created successfully"
                ],200);
               } else {
                return response()->json([
                    'status' =>404,
                    'message'=>"Nothing Created"
                ],404);
               }
               
               // return $this->apiResponse($data, true, null, 200);
                //  return response()->json(['Message'=>'Done']);
            }
        
    }
    public function Destroy($id){
        $Replacment = Replacments::find($id);
        if ($Replacment) {
            $Replacment->delete();
        } else {
            return response()->json([
                'status' =>404,
                'message'=>"Nothing Created"
            ],404);
        }
        
    }
}
