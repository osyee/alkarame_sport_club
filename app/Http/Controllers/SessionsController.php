<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use  App\Http\Resources;
use  App\Http\Resources\SeasonesResource;
use App\Models\Sessions;


class SessionsController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $session= Sessions::all();
       
        return SeasonesResource::collection(Sessions::all());
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name' =>'required|regex:/[a-z]/',
            'start_date'=> 'required|date',
            'end_date' => 'required|date',
           
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }

        try {
    

            Sessions::create([
                    'uud'=> Str::uud() ,
                    'name' =>$request->name ,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date ,
                    
                ]);

            $data = 'created successfully' ;

            return $this->apiResponse($data, true, null, 200);
            }
        catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }

    public function update(Request $request )
    {
        $validator = Validator::make($request->all(), [
            'uud' => 'required|string|exists:clubs,uuid',
            'name' =>'required|regex:/[a-z]/',
            'start_date'=> 'required|date' ,
            'end_date' => 'required|date',
        ]);

        if ($validator->fails()) {
           
            return $this->requiredField($validator->errors()->first());
        }
        try {
           
            
           $session = Sessions::where('uud', $request->input('uud'))->first();

            
        
            $data = [
                'uud'=> $session->uud  ,
                'name' =>$request->name ,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date ,
                    
            ] ;
            $session->update($data);
        $data = 'update successfully';

            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    public function delete()
    {
        try {
            $session = Sessionss::where('uud', $request->input('uud'))->first();

            if (!$session) {
                return $this->notFoundResponse('session not found.');
            }


            $session->delete();

            return $this->apiResponse([], true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
}
   

