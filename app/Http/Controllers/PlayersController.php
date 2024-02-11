<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Http\Traits\GeneralTrait ;
 use Illuminate\Support\Facades\Validator;
 use Illuminate\Support\Str;


 use App\Models\Players ;
 use App\Models\Sports ;

class PlayersController extends Controller
{
     use GeneralTrait ;
    public function index($id)
    {
       $data = Players::find($id); 
        return $this->apiResponse($data, true, null, 200);
        
    }
    public function show()
    {
        $data =  $players = Players::get();
        return $this->apiResponse($data, true, null, 200);
      
    }
    public function store(Request $request)
    {
        $player = Players::where('uuid', $request->input('uuid'))->first();

        $validator = Validator::make($request->all(),[
            'uuid'=>'string',
            'name'=>'required|string',
            'high'=>'required|integer',
            'play'=>'required|string',
            'number'=>'required|integer | max:99',
            'born'=>'required|date',
            'from'=>'required|string',
            'first_club'=>'required|string',
            'career'=>'required|string',
            'image'=>'required|string',
            'Sports_id'=>'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }
        else{
           $data = Players::create([
            'uuid'=> Str::uuid(),
            'name'=> $request->name,
            'high'=>$request->high,
            'play'=>$request->play,
            'number'=>$request->number,
            'born'=>$request->born,
            'from'=> $request->from,
            'first_club'=>$request->first_club,
            'career'=>$request->career,
            'image'=>$request->image,
            'Sports_id'=>$request->Sports_id,
           ]);
           return $this->apiResponse($data, true, null, 200);
        }
        

    }
    
    public function destroy($id)
    {
        $player=Players::find($id);
        $player->delete();
        return $this->apiResponse($data=Null, true, null, 200);
    }

   public function update(Request $request , $id )
    {
     
        $validator = Validator::make($request->all(),[
            'uuid'=>'string',
            'name'=>'string',
            'high'=>'integer',
            'play'=>'string',
            'number'=>'integer | max:99',
            'born'=>'date',
            'from'=>'string',
            'first_club'=>'string',
            'career'=>'string',
            'image'=>'string',
            'Sports_id'=>'integer',

        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }
        else{
            
            $data=$player=Players::find($id);
            $player->uuid = Str::uuid() ;
            $player->name = $request->name ;
            $player->high = $request->high ;
            $player->play = $request->play ;
            $player->number = $request->number ;
            $player->born = $request->born ;
            $player->from = $request->from ;
            $player->first_club = $request->first_club ;
            $player->career = $request->career ;
            $player->image = $request->image ;
            $player->Sports_id = $request->Sports_id ;
            $player->save();

            return $this->apiResponse($data, true, null, 200);

        }   
    }

}

?>  