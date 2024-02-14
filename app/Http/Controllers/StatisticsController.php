<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;
use App\Models\Matches;
use App\Models\Statistics;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\resourcesstatic;

class StatisticsController extends Controller
{
    use GeneralTrait;
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|unique:statistics,matches_id',
            'vaalue'=>'required',
            'matches_id'=>'required|string|exists:matches,id|unique:statistics,matches_id',

        ]);
        if($validator->fails())
        {
        $validator->errors();
        return $this->apiResponse($validator);
        }
       
       
        $stat=new Statistics();
        $stat->uuid=Uuid::uuid4();
        $stat->name=$request->name;
        $stat->vaalue=$request->vaalue;
        $stat->matches_id=$request->matches_id;
        $stat->save();
        return response()->json(['message'=>'successfull']);
    }

    public function update(REQUEST $request,$id)
    {
        
       
       $meesage=[

        
        ];
         $validato=Validator::make($request->all(),[
            'name'=>'required|string|unique:statistics,matches_id',
            'vaalue'=>'required',
           'matches_id'=>'required|string|exists:matches,id|unique:statistics,matches_id',
         ],$meesage);
         if($validato->fails())
         {
         $validato->errors();
         return $this->apiResponse($validato);
         }

         $stat=Statistics::find($id);
         $stat->uuid=Uuid::uuid4();
         $stat->name=$request->name;
         $stat->vaalue=$request->vaalue;
          $stat->matches_id=$request->matches_id;
         $input=$request->all();
         $stat->update($input);
        return response()->json(['message'=>'successfull']);

    }

    public function destore($id)
    {
        $exists=Statistics::where('id',$id)->delete();
      if($exists)
      {
        return $this->apiResponse($exists,true);
      }
      else
      {
        return $this->apiResponse($exists,false);
      }

    }

    public function index()
    {
        $sta=Statistics::with('match')->get();
       $data=resourcesstatic::collection(Statistics::all());
        return $this->apiResponse($data);
    }


    
    
}
