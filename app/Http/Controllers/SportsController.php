<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait ;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Sports;
use App\Models\Players;

class SportsController extends Controller
{
    use GeneralTrait ;
    public function index($id)
    {
        $data =  $sport = Sports::find($id);
        return $this->apiResponse($data, true, null, 200);    
    }
    
    public function show()
    {
      $data =  $sport = Sports::get();
      return $this->apiResponse($data, true, null, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'uuid'=>'string',
            'name'=>'required | string ',
            'image'=>'required | string',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors());
        }
        else{           
           $data= Sports::create([  
            'uuid'=> Str::uuid(),
            'name'=>$request->name,
           'image'=>$request->image,
        ]);
        return $this->apiResponse($data, true, null, 200);
        }
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(),[
            'uuid'=>'string',
            'name'=>'required | string ',
            'image'=>'required | string',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors());
        }
        else
        {
            $data=$sport=Sports::find($id);
            $sport->name = $request->name ;
            $sport->image = $request->image ;
            $sport->uuid = Str::uuid() ;
            $sport->save();
            return $this->apiResponse($data, true, null, 200);

        }
    }
    public function destroy($id)
    {
        $player=Sports::find($id);
        $player->delete();
        return $this->apiResponse($data=Null, true, null, 200);
    }

}
