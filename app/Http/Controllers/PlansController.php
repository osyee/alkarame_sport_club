<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use  App\Http\Resources;
use  App\Http\Resources\PlansResource;
use App\Models\Plans;
use App\Models\Players;
use App\Models\Matches;
class PlansController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $plan = Plans::with('player','match')->get() ;
        return $this->apiResponse($plan, true, null, 200);
    }
    public function store(Request $request)
    {
       $validator=Validator::make($request->all(),[
            'Players_id' => 'required|string|exists:players,id',
            'matches_id' => 'required|string|exists:matches,id',
            'status'=> 'required|in:main,beanch',
            
           
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }

       
      



            Plans::create([
            'uuid'=>Str::uuid(),
            'Players_id' =>$request->Players_id,
            'matches_id' =>$request->matches_id,
            'status'=>$request->status,
            
                ]);

            $data = 'created successfully' ;

            return $this->apiResponse($data, true, null, 200);
            
        
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        
    }

  
    public function delete()
    {
        try {
            $plan =Plans::where('uuid', $request->input('uuid'))->first();

            if (!$plan) {
                return $this->notFoundResponse('employee not found.');
            }

            $id= $plan->Player_id;
            $id2=$plan->match_id;

            $match= Matches::where('id',$id)->delete();
            $player = Players::where('id',$id)->delete() ;
            if($player && $match)
            
            {
            $plan->delete();
        return $this->apiResponse([], true, null, 200);
            
    }
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
}
 

