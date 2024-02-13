<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Primes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\FileUploader;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ReplacmentResource;
use App\Models\Wears;
use App\Models\Sessions;
use App\Models\Sports;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Enum;

class PrimesController extends Controller
{
    use FileUploader,GeneralTrait;
    public function index(){
          
        $Primes= Primes::with('sport','session')->get();
         return $this->apiResponse($Primes,true,null,200);
            
    }
    public function store(Request $request){
        $validator=Validator::make($request->all(), [
          //'uuid' =>'required|exists:Primes,uuid',
            'name'=>"required|regex:/[a-z]/",
            'descreption'=>"required|string|max:240",
            'Sports_id'=>"required|integer|exists:Sports,id",
            'sessions_id'=>"required|integer|exists:sessions,id",
            'image'=>"required|file|mimes:jpg,png,jpeg,gif",
            'type'=>"required|string|in:personal,club",
        ]);
        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
            
        }try {
            $image= $this->uploadImage2($request,'prime','image');
        if (!$image) {
            return $this->apiResponse(null, false, "error", 500); 

        }
        $Primes = new Primes();
        $Primes->uuid = Str::uuid();
        Primes::create([
        'uuid'=>$Primes->uuid,
            'name'=>$request->name,
            'descreption'=>$request->descreption,
            'Sports_id'=> $request->Sports_id,
            'sessions_id'=> $request->sessions_id,
            'type'=>$request->type,
            'image'=>$image,
            
            



        ]);
        $data = 'created successfully' ;

        return $this->apiResponse($data, true, null, 200);
        }
        catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }


    public function update(Request $request){
        $validator=Validator::make($request->all(), [
            'uuid' =>'required|exists:Primes,uuid',
            'name'=>"required|regex:/[a-z]/",
            'descreption'=>"required|string|max:240",
            'Sports_id'=>"required|integer|exists:Sports,id",
            'sessions_id'=>"required|integer|exists:sessions,id",
            'image'=>"required|file|mimes:jpg,png,jpeg,gif",
            'type'=>"required|string|in:personal,club",
            ]);
            if ($validator->fails()) {
                return $this->requiredField($validator->errors()->first());
                
            }
            try {
                $image= $this->uploadImage($request,'prime','image');
            if (!$image) {
                return $this->apiResponse(null, false, "error", 500); 
    
            }
        
            $Primes = Primes::where('uuid', $request->input('uuid'))->first();

            $data=[
                'uuid'=>Str::uuid(),
                'name'=>$request->name,
                'descreption'=>$request->descreption,
                'Sports_id'=> $request->Sports_id,
                'sessions_id'=> $request->sessions_id,
                'uuid'=>$Primes->uuid,
                'type'=>$request->type,
                'image'=>$image,
            ];
            $Primes->update($data) ;
    
            return $this->apiResponse($data, true, null, 200);
            }
            catch (\Exception $ex) {
                return $this->apiResponse(null, false, $ex->getMessage(), 500);
            }
    }

    public function show($id){
        $data =  Primes::find($id);
        if ($data) {
            return $this->apiResponse($data, true, null, 200);

        } else {
            return response()->json([
                'status' =>404,
                'message'=>"Nothing to show"
            ],404);
        }
    }
    public function destroy(Request $request){
        try {
            $Primes = Primes::where('uuid', $request->input('uuid'))->first();

            if (!$Primes) {
                return $this->notFoundResponse('club not found.');
            }

                $id=$Primes->Sports_id;
                $sport = Sports::where('id',$id)->delete() ;
                if($sport)
                {
                    $Primes->delete();
            return $this->apiResponse([], true, null, 200);
                
        }
        
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }

    }