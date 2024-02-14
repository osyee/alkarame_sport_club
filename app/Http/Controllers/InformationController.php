<?php

namespace App\Http\Controllers;

use App\Models\Clubs;
use App\Models\Matches;
use App\Models\Sessions;
use App\Models\Information;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Storage;
use App\Models\Sports;
use App\Http\Traits\GeneralTrait;
use illuminate\Support\Str;
use App\Http\Resources\resourcesinfo;
use Carbon\Carbon;
use App\Http\Traits\FileUploader;
use GrahamCampbell\ResultType\Success;

class InformationController extends Controller
{ use GeneralTrait;
  
    public function store(Request $request)
    { 
        
      
        $spor=Sports::find(3);
        $club=Clubs::find(1);
       /* $session=Sessions::find();
        $match=Matches::find();*/
        
       
       $meesage=[
            'title'=>'Please enter the news title',
            'content' =>'Please enter the news',
            'type'=>'Not recognized',

        ];
         $validato=Validator::make($request->all(),[
            'title'=>'required|string|max:255',
            'image'=>'required|file|mimes:jpg,png,jpeg,gif',
            'content'=>'required|string',
            'reads'=>'required',
            'type'=>'required|in:stategy,news,regular,slider',
         ],$meesage);
        if($validato->fails())
         {
         $validato->errors();
         return $this->apiResponse($validato,false);
         }
        $uplodeimage=$this->uploadImage2($request,'Information','image');
        $info=new Information();
        $info->uuid=Uuid::uuid4();
        $info->title=$request->title;
        $info->image=$uplodeimage;
        $info->content=$request->content;
        $info->reads=$request->reads;
        $info->type=$request->type;
        $info->information_able()->associate($spor);
        $info->save();
        return response()->json(['message'=>'successfull']);
    }


    public function index()
    {
     $news=Information::with('information_able')->where('type','news')->get();
     $data=resourcesinfo::collection(Information::all());
     return $this->apiResponse($data);
    }

 

    public function destore($id)
    {
        $exists=Information::where('id',$id)->delete();
        
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
      }

    }

    public function update(REQUEST $request,$id)
    {
        $spor=Sports::find(5);
       
       $meesage=[
        'title'=>'Please enter the news title',
        'content' =>'Please enter the news',
        'type'=>'Not recognized',
        ];
         $validato=Validator::make($request->all(),[
            'title'=>'required|string|max:255',
            'image'=>'required',
            'content'=>'required|string',
            'reads'=>'required',
            'type'=>'required|in:stategy,news,regular,slider',
         ],$meesage);
         if($validato->fails())
         {
         $validato->errors();
         return $this->apiResponse($validato);
         }

       $uplodeimage=$request->image;
        $info=Information::find($id);
        $info->uuid=Uuid::uuid4();
        $info->title=$request->title;
        $info->image=$uplodeimage;
        $info->content=$request->content;
        $info->reads=$request->reads;
        $info->information_able()->associate($spor);
        $info->type='news';
        
        $info->save();
        return response()->json(['message'=>'Success']);

    }
  
}
