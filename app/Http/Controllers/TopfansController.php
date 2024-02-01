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

class TopfansController extends Controller
{
    use GeneralTrait ;
    public function index()
    {
        
        return TopfansResource::collection(Topfans::all()) ;
    }
    public function store(Request $request)
    {
        $user = auth('sanctum')->user();
        $validator = Validator::make($request->all(), [
            'associations_uuid' => ['required', 'string', 'exists:associations,uuid'],

        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }

        try {

            $topfans = new Topfans();
            $topfans->uuid = Str::uuid();
            $topfans->user()->associate($user)->save();

            Topfans::create([
                    'associations_id'=> $request->associations_id ,
                ]);

            $data['topfans'] = new TopfansResource($topfans);

            return $this->apiResponse($data, true, null, 200);
            }
        catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    public function update(Request $request )
    {
        $validator = Validator::make($request->all(), [
            'associations_id' => ['required', 'string', 'exists:associations,uuid'],
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }
        try {
            $topfans = Topfans::where('uuid', $request->input('uuid'))->first();

            if (!$topfans) {
                return $this->notFoundResponse('topfans not found.');
            }

            $topfans->associations()->delete();

                $topfans = Topfans::where('uuid',$request->associations_uuid)->firstOrFail();

                Associations::create([
                    'boss' => $request->boss,
                    'description' => $request->description,
                    'image' => $request->image,
                    'country'=> $request->country,
                    'sports_id' => $sports->id ,
                    
                ]);

            $data['topfans'] = new TopfansResource($topfans);

            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    public function delete()
    {
        try {
            $topfans = Topfans::where('uuid', $request->input('topfans_uuid'))->first();

            if (!$topfans) {
                return $this->notFoundResponse('topfans not found.');
            }

            $topfans->associations()->delete();

            $topfans->delete();

            return $this->apiResponse([], true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    public function show()
    {
        $uuid = $request->input('topfans_uuid') ;
        return new TopfansResource(Topfans::findOrFail($uuid));
    }

}
