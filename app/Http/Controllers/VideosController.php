<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Http\Traits\FileUploader;
use App\Http\Traits\GeneralTrait;
use App\Models\Videos;
use App\Models\Associations;
use App\Models\Matches;
use App\Models\Clubs;
use App\Models\Standings;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\resourcevidio;

class VideosController extends Controller
{
    use FileUploader;
    use GeneralTrait;


    
    public function store(Request $request)
    {
   // $associations=Associations::find();
    $club=Clubs::find(3);
   // $matche=Matches::find();

    $vidio=new Videos();
    $vidio->uuid=Uuid::uuid4();
    $vidio->url=$request->url;
    $vidio->description=$request->description;
    $vidio->video_able()->associate($club);
    $vidio->save();


    return response()->json(['message'=>'successfull']);
    }


    public function update(REQUEST $request,$id)
    {
        //$associations=Associations::find();
       $club=Clubs::find(1);
       // $matche=Matches::find();
       
       $meesage=[

        ];
         $validato=Validator::make($request->all(),[
            'url'=>'string|max:255',
            'description'=>'string',

         ],$meesage);
         if($validato->fails())
         {
         $validato->errors();
         
         return response()->json($validato);
        // return $this->apiResponse($validato);
         }

       
        $vidio=Videos::find($id);
        $vidio->uuid=Uuid::uuid4();
        $vidio->url=$request->url;
        $vidio->description=$request->description;
        $vidio->video_able()->associate($club);
        $vidio->save();
        
        return response()->json(['status'=>'succss']);
       // return $this->apiResponse($vidio,true);

    }

    public function destore($id)
    {
        $exists=Videos::where('id',$id)->delete();
        
      //  $info=Information::find($id);
      //  $exists->delete();
      // return response()->json('successfull');
      if($exists)
      {
        return $this->apiResponse($exists,true);
      }
      else
      {
        return $this->apiResponse($exists,false);
      }}

      public function index()
      {
       $video=Videos::all();
       $data=resourcevidio::collection(Videos::all());
       return $this->apiResponse($data);

      }
}
