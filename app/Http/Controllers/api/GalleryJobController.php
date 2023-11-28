<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helper\Helper;
use App\Models\Job;
use App\Models\JobGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class GalleryJobController extends Controller
{
    // add_pic
    public function add_pic(Request $request, Job $job)
    {

        // validation
        $validation = Validator::make($request->all(), [
            "file" => 'required|mimes:png,jpg,jpeg,webp|max:500000',
            'description_fa' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
        ]);

        if ($validation->fails()) {

            $errors = $validation->errors();
            return response($errors->first(),302);
        }

        if ($path = Helper::uploadImg($request->file("file"), '/Job_images')) {

            JobGallery::create([
                "job_id" => $job->id,
                "image" => $path,
                'description_fa' => $request['description_fa'],
                'description_en' => $request['description_en'],
                'description_ar' => $request['description_ar'],
                "status" => "تایید نشده", 
            ]);

            return response('success',200);
        }

    }
    

    // delete_pic
    public function delete_pic(JobGallery $jobgallery)
    {

        Helper::RemoveImg($jobgallery->image);

        $jobgallery->update([
            'status' => 'تایید نشده',
        ]);
        $jobgallery->delete();

        return $this->getAll_withTrash($jobgallery->job()->first());
    }

    
    public function getAll_withoutTrash(Job $job) {

        return response($job->galley()->where('status' , 'تایید شده')->get()->toArray(),200);
    }

    public function getAll_withTrash(Job $job) {

        return response($job->galley()->withTrashed()->get()->toArray(),200);
    }
    
    
    public function uploadImg(Request $request) {
        
        if($img = $this->Upload_image($request->file('img'),'zaky')) {
            
            if($this->addToTable($img,$request)) {
                
               return response('added sucessfully',200);
            }
            return response("image uploaded but couldn't add it to the table",302);
        }
        return response("image upload error",302);
    }


    public function addToTable($img,$request) {
        
        if(DB::table('upload')->insert(['img' => $img,'title' => $request->title])) {
            return true;
        }
        
        return false;
    }
    


    public function Upload_image($file,$uploadTo) {
        
        $path = 'Tools/Images/' . $uploadTo;
        $imagePt = $file->store($path);
        $move = $file->move(public_path($path),$imagePt);
        if($move) {
            
            return $imagePt;
        }
        else {
            
            return false;
        }
        
    }

}
