<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use YogeshKoli\UserIP\UserIP;

class ViewHistory extends Model
{
    use HasFactory;
    protected $fillable = ['job_id', 'user_ip', 'updated_at'];


    public function addView($job)
    {


        $ip = request()->ip();

        $check = ViewHistory::where("job_id", $job->id)->where("user_ip", $ip)->first();
        if ($check == []) {

            ViewHistory::create([
                "job_id" => $job->id,
                'user_ip' => $ip,
            ]);

            $job->update([
                "view" => $job->view + 1,
            ]);
        } else {

            if (new DateTime(now()) > new DateTime($check->updated_at->addMinutes(60))) {

                $check->update([
                    "updated_at" => now(),
                ]);

                $job->update([
                    "view" => $job->view + 1,
                ]);
            }
        }

        return true;
    }
}
