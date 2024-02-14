<?php

namespace App\Http\Controllers;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeesResource;
use App\Models\Employees;
use App\Models\Sports;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\FileUploader;

class EmployeesController extends Controller
{
    use GeneralTrait;
    use FileUploader ;
    public function index()
    {
        $employee = Employees::with('sport')->get() ;
        return $this->apiResponse($employee, true, null, 200);

     
       
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name' =>'required|regex:/[a-z]/',
            'job_type'=> 'required|in:manager,coach' ,
            'work' => 'required|string',
            'image'=> 'required|file|mimes:jpg,png,jpeg,jfif',
            'Sports_id' => 'required|integer|exists:sports,id',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }
        try {
          
            $image = $this->uploadImage2($request,'employee','image');
          if(!$image )
          {
              return $this->apiResponse(null, false, "error", 500); 
          }


            Employees::create([
                    'uuid'=> Str::uuid() ,
                    'name' =>$request->name ,
                    'job_type' => $request->job_type,
                    'work' => $request->work ,
                    'image'=>$image,
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
            'uuid' => 'required|string|exists:employees,uuid',
            'name' =>'required|regex:/[a-z]/',
            'job_type'=> 'required|in:manager,coach' ,
            'work' => 'required|string',
            'image'=>'required|file|mimes:jpg,png,jpeg,jfif',
            'Sports_id' => 'required|integer|exists:sports,id',
        ]);

        if ($validator->fails()) {
           
            return $this->requiredField($validator->errors()->first());
        }
        try {

            $image = $this->uploadImage2($request,'employee','image');
            if(!$image)
            {
                return $this->apiResponse(null, false, "error", 500); 
            }
        
            $employee = Employees::where('uuid', $request->input('uuid'))->first();

        
            $data = [
                'uuid'=> Str::uuid()   ,
                'name' =>$request->name ,
                'job_type' => $request->job_type,
              'work' => $request->work ,
              'image'=>$image,
                'Sports_id'=> $request->Sports_id ,
            ] ;
            $employee->update($data);
        $data = 'update successfully';

            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    public function delete(Request $request)
    {
        
        try {
            $employee = Employees::where('uuid',$request->input('uuid'))->first();

            if (!$employee) {
                return $this->notFoundResponse('employee not found.');
            }
            $id= $employee->Sports_id;
            $sport = Sports::where('id',$id)->delete() ;
            if($sport)
            {
                $employee->delete();
                return $this->apiResponse([], true, null, 200);
                    
            }

           
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
    public function search(Request $request)
    {
        try {
            $name = $request->input('name');
            $query = Employees::query();

            if ($name) {
                $query->where('name',  $name );
            }

            $employee = $query->get();

            if ($employee->isEmpty()) {
                $data['message'] = 'No employee found';
                return $this->apiResponse($data, true, null, 200);
            }

            $data['employees'] = EmployeesResource::collection($employee);
            return $this->apiResponse($data, true, null, 200);

        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }



}



        
    
   

   
 



