<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait ;
use App\Models\Clubs ;
use App\Http\Resources\ClubsResource ;
use App\Models\Sports ;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\FileUploader;


class ClubsController extends Controller
{
    use GeneralTrait ;
    use FileUploader ;

    public function index()
    {
        $club = Clubs::with('sport')->get() ;
        return $this->apiResponse($club, true, null, 200);
        
    }

    
    public function store(Request $request)
    {
        //$user = auth('sanctum')->user();
        $validator = Validator::make($request->all(), [
        
            'name' =>'required|unique:clubs|regex:/[a-z]/',
            'address' =>'required|regex:/[a-z]/',
            'logo' =>'required|file|mimes:jpg,png,jpeg,jfif',
            'Sports_id'=> 'required|exists:sports,id',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }
        
        try {
          
          $logo = $this-> uploadImage2($request,'club','logo');
        if(!$logo)
        {
            return $this->apiResponse(null, false, "error", 500); 
        }
        
           $clubs = new Clubs();
            $clubs->uuid = Str::uuid();

            Clubs::create([
                    'uuid'=> $clubs->uuid  ,
                    'name' =>$request->name ,
                    'address' => $request->address,
                    'logo' => $logo,
                    'Sports_id'=> $request->Sports_id,
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
            'uuid' =>'required|exists:clubs,uuid',
            'name' =>'required|regex:/[a-z]/',
            'address' =>'required|regex:/[a-z]/',
            'logo' =>'required|file|mimes:jpg,png,jpeg,jfif',
            'Sports_id'=> 'required|exists:sports,id',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }
        try {

            $logo = $this-> uploadImage2($request,'club','logo');
            if(!$logo)
            {
                return $this->apiResponse(null, false, "error", 500); 
            }
           
           $club = Clubs::where('uuid', $request->input('uuid'))->first();
    
            $data = [
                'uuid'=> Str::uuid() ,
                'name' =>$request->name ,
                'address' => $request->address,
                'logo' => $logo ,
                'Sports_id'=> $request->Sports_id ,
            ] ;
            $club->update($data);
        $data = 'update successfully';

            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    public function delete(request $request)
    {
        try {
            $club = Clubs::where('uuid', $request->input('uuid'))->first();

            if (!$club) {
                return $this->notFoundResponse('club not found.');
            }

                $id= $club->Sports_id;
                $sport = Sports::where('id',$id)->delete() ;
                if($sport)
                {
                $club->delete();
            return $this->apiResponse([], true, null, 200);
                
        }
        
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
}
