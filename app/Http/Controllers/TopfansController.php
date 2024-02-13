<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\GeneralTrait ;
use App\Models\Topfans ;
use App\Http\Resources\TopfansResource ;
use App\Models\Associations ;
use App\Models\Sports ;
use Illuminate\Support\Str;

class TopfansController extends Controller
{
    use GeneralTrait ;

    public function show(request $request)
    {
       $topfans = Topfans::where('uuid', $request->uuid)->with('association')->get();
       if($topfans)
       {
        return $this->apiResponse($topfans, true, null, 200);
       }
       else{
        return $this->notFoundResponse('topfans not found');
       }
        
    }

    public function all()
    {
        $topfans = Topfans::with('association')->get() ;
       return $this->apiResponse($topfans, true, null, 200);
    
    }

    
    public function store(Request $request)
    {
        //$user = auth('sanctum')->user();
        $validator = Validator::make($request->all(), [
            'associations_id' =>'required|string|exists:associations,id',

        ]);

       if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }

        try {

            Topfans::create([
                'uuid'=>Str::uuid() ,
              'associations_id'=> $request->associations_id ,
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
            'uuid' => 'required|string|exists:topfans,uuid',
            'associations_id' =>'required|string|exists:associations,id',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }
        try {

           $topfans = Topfans::where('uuid', $request->input('uuid'))->first();
            
       
            $data = [
                'uuid' => Str::uuid() ,
                'associations_id'=> $request->associations_id ,
            ] ;

            $topfans->update($data);
        $data = 'update successfully';

            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    public function delete(request $request)
    {
        try {
            $topfans = Topfans::where('uuid', $request->input('uuid'))->first();

            if (!$topfans) {
                return $this->notFoundResponse('topfans not found.');
            }

            $id = $topfans->associations_id ;
            $asso = Associations::where('id',$id)->first();

            if($asso->delete())
            {
                $topfans->delete() ;
            return $this->apiResponse([], true, null, 200);
            }
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    

}
