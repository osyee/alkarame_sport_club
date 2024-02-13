<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\GeneralTrait ;
use App\Http\Resources\AssciationssResource ;
use App\Models\Associations ;
use App\Models\Sports ;
use App\Http\Traits\FileUploader;

class AssociationsController extends Controller
{
    use FileUploader ;
    use GeneralTrait ;

    public function index()
    {
        $association = Associations::with('sport')->get() ;
        return $this->apiResponse($association, true, null, 200);
        
    }

    
    public function store(Request $request)
    {
        //$user = auth('sanctum')->user();
        $validator = Validator::make($request->all(), [
          
            'boss' =>'required|string|unique:associations|min:2|max:255|regex:/[a-z]/',
            'description'=>'required|min:2|max:255|regex:/[a-z]/' ,
            'image' =>'required|file|mimes:jpg,png,jpeg,jfif',
            'country'=>'required|regex:/[a-z]/',
            'Sports_id'=> 'required|exists:sports,id',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }

        try {
            
            $image = $this-> uploadImage2($request,'association','image');
            if(!$image)
            {
                return $this->apiResponse(null, false, "error", 500); 
            }

            Associations::create([
                    'uuid'=>Str::uuid(),
                    'boss' =>$request->boss ,
                    'description' => $request->description,
                    'image' => $image ,
                    'country' => $request->country ,
                    'Sports_id'=> $request->Sports_id ,
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
            'uuid' => 'required|string|exists:associations,uuid',
            'boss' =>'required|min:2|max:255|regex:/[a-z]/',
            'description'=> 'required|string|min:2|max:255|regex:/[a-z]/' ,
            'image' =>'required|file|mimes:jpg,png,jpeg,jfif',
            'country'=>'required|regex:/[a-z]/',
            'Sports_id' =>'required|string|exists:sports,id',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }
        try {

            $image = $this-> uploadImage2($request,'association','image');
            if(!$image)
            {
                return $this->apiResponse(null, false, "error", 500); 
            }

           $association = Associations::where('uuid', $request->input('uuid'))->first();
            $data = [
                'uuid'=>Str::uuid()  ,
                    'boss' =>$request->boss ,
                    'description' => $request->description,
                    'image' => $image ,
                    'country' => $request->country ,
                    'Sports_id'=> $request->Sports_id ,
            ] ;
            $association->update($data);
        $data = 'update successfully';

            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    public function delete(request $request)
    {
        try {
            $association = Associations::where('uuid', $request->input('uuid'))->first();

            if (!$association) {
                return $this->notFoundResponse('association not found.');
            }

            $id= $association->Sports_id;
            $sport = Sports::where('id',$id)->delete() ;
            if($sport)
            {
                $association->delete();
        return $this->apiResponse([], true, null, 200);
            
    }

            return $this->apiResponse([], true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }


}
