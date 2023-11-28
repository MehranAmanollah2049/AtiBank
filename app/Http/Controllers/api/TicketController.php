<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helper\DateHelper;
use App\Http\Controllers\helper\Helper;
use App\Models\Job;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{

    public function getJobList(Request $request)
    {

        $result = [];

        $jobsList = Ticket::where("sender", $request->sender)->where("sender_text", "user")->select(['sender', 'receiver', 'sender_text', 'receiver_text'])->distinct()->get();

        if ($jobsList->count() > 0) {

            foreach ($jobsList as $chat) {
                if (Job::where('id', $chat->receiver)->get()->count() > 0) {
                    $job = Job::where('id', $chat->receiver)->first();



                    $JobInfos['jon_id'] = $job->id;
                    $JobInfos['jon_name_fa'] = $job->job_name_fa;
                    $JobInfos['jon_name_en'] = $job->job_name_en;
                    $JobInfos['jon_name_ar'] = $job->job_name_ar;
                    $JobInfos['jon_banner'] = $job->banner;

                    $lastChat = Ticket::where("sender", $chat->sender)->where("sender_text", "user")->where("receiver", $chat->receiver)->where("receiver_text", "job")->orwhere("sender", $chat->receiver)->where("sender_text", "job")->where("receiver", $chat->sender)->where("receiver_text", "user")->orderBy('id', 'DESC')->first();

                    $typeLastMsgSender = '';
                    $LastMsgSender = '';
                    $seen = '0';

                    // check that last mesage is for you or not
                    if ($lastChat->sender == $chat->sender && $lastChat->sender_text == "user") {

                        $typeLastMsgSender =  'شما';
                    }

                    // get last message value
                    if ($lastChat->ticket_text == null && $lastChat->ticket_image != null) {

                        $LastMsgSender =  $lastChat->ticket_image;
                    } else {

                        $LastMsgSender =  $lastChat->ticket_text;
                    }

                    // seen value
                    $seenNum = Ticket::where("sender", $chat->receiver)->where("sender_text", "job")->where("receiver", $chat->sender)->where("receiver_text", "user")->where('seen', null)->get()->count();

                    if ($seenNum > 0) {

                        $seen = "$seenNum";
                    }


                    $JobInfos['typeLastMsgSender'] = $typeLastMsgSender;
                    $JobInfos['LastMsgSender'] = $LastMsgSender;
                    $JobInfos['seen'] = $seen;

                    $result[] = $JobInfos;
                }
            }
        }

        if ($result == []) {

            return response('Nothing found', 302);
        } else {

            return response($result, 200);
        }
    }

    public function getUserList(Request $request)
    {

        $result = [];


        $user = User::where("id", $request->sender)->first();
        $jobs = $user->jobs()->get();


        if ($jobs->count() > 0) {

            foreach ($jobs as $job) {
                $UserList = Ticket::where("job_id", $job->id)->where('sender_text', 'user')->select(['sender', 'receiver', 'sender_text', 'receiver_text'])->distinct()->get();

                if ($UserList->count() > 0) {
                    foreach ($UserList as $chat) {
                        if (User::where('id', $chat->sender)->first() != []) {
                            $UserSender = User::where('id', $chat->sender)->first();

                            $lastChat = Ticket::where("job_id", $job->id)->orderBy('id', 'DESC')->first();

                            $typeLastMsgSender = '';
                            $LastMsgSender = '';
                            $seen = '0';

                            // check that last mesage is for you or not
                            if ($lastChat->sender == $job->id && $lastChat->sender_text == "job") {

                                $typeLastMsgSender =  'شما';
                            }

                            // get last message value
                            if ($lastChat->ticket_text == null && $lastChat->ticket_image != null) {

                                $LastMsgSender =  $lastChat->ticket_image;
                            } else {

                                $LastMsgSender =  $lastChat->ticket_text;
                            }


                            // seen value
                            $seenNum = Ticket::where("sender", $chat->sender)->where("sender_text", $chat->sender_text)->where("receiver", $chat->receiver)->where("receiver_text", $chat->receiver_text)->where('seen', null)->get()->count();

                            if ($seenNum > 0) {

                                $seen = $seenNum;
                            }

                            $UserResult['id'] = $UserSender->id;
                            $UserResult['name'] = $UserSender->name;
                            $UserResult['family'] = $UserSender->family;
                            $UserResult['profile'] = $UserSender->profile;
                            $UserResult['typeLastMsgSender'] = $typeLastMsgSender;
                            $UserResult['LastMsgSender'] = $LastMsgSender;
                            $UserResult['seen'] = $seen;
                            $UserResult['JobId'] = $job->id;
                            $UserResult['Job_name_fa'] = $job->job_name_fa;
                            $UserResult['Job_name_en'] = $job->job_name_en;
                            $UserResult['Job_name_ar'] = $job->job_name_ar;

                            $result[] = $UserResult;
                        }
                    }
                }
            }
        }

        if ($result == []) {

            return response('Nothing found', 302);
        } else {

            return response($result, 200);
        }
    }

    function getAllMsgs(Request $request)
    {

        if ($this->seenMsgs($request->receiver_id, $request->receiver_type, $request->sender_id, $request->sender_type)) {
            $msgsAll = [];


            $getMsgs = Ticket::where("sender", $request->sender_id)->where("sender_text", $request->sender_type)->where("receiver", $request->receiver_id)->where("receiver_text", $request->receiver_type)->orwhere("sender", $request->receiver_id)->where("sender_text", $request->receiver_type)->where("receiver", $request->sender_id)->where("receiver_text", $request->sender_type)->get();

            if ($getMsgs->count() > 0) {
                foreach ($getMsgs as $msg) {

                    $time = DateHelper::FaConvert4($msg->updated_at);

                    if ($msg->sender == $request->sender_id && $msg->sender_text == $request->sender_type) {

                        $seen = 'not seen yet';

                        if ($msg->seen != null) {
                            $seen = 'seen';
                        }

                        $profile = '';

                        if ($request->sender_type == "user") {

                            $profile = '/' . User::where('id', $request->sender_id)->first()->profile;
                        } else {

                            $profile = '/' . Job::where('id', $request->sender_id)->first()->banner;
                        }

                        $msgResult = $msg->toArray();
                        $msgResult['profile'] = $profile;
                        $msgResult['seen'] = $seen;
                        $msgResult['time'] = $time;
                        $msgResult['side'] = 'right';

                        $msgsAll[] = $msgResult;
                    } else {

                        $profile = '';

                        if ($request->receiver_type == "user") {

                            $profile = '/' . User::where('id', $request->receiver_id)->first()->profile;
                        } else {

                            $profile = '/' . Job::where('id', $request->receiver_id)->first()->banner;
                        }


                        $msgResult = $msg->toArray();
                        $msgResult['profile'] = $profile;
                        $msgResult['seen'] = 'null';
                        $msgResult['time'] = $time;
                        $msgResult['side'] = 'left';

                        $msgsAll[] = $msgResult;
                    }
                }
            }

            if ($msgsAll == []) {
                return response('nothing found', 302);
            } else {
                return response($msgsAll, 200);
            }
        }
    }

    public function seenMsgs($receiver_id, $receiver_type, $sender_id, $sender_type)
    {

        $getMsgs = Ticket::where("sender", $receiver_id)->where("sender_text", $receiver_type)->where("receiver", $sender_id)->where("receiver_text", $sender_type)->get();

        foreach ($getMsgs as $msg) {

            $msg->update([
                'seen' => now(),
            ]);
        }

        return true;
    }

    public function addMsg(Request $request)
    {

        $jobId = 0;

        if ($request->sender_type == 'job') {

            $jobId = $request->sender_id;
        } else if ($request->receiver_type == 'job') {

            $jobId = $request->receiver_id;
        }

        if ($request->text != null && $request->file('file') == null) {

            $validation = Validator::make($request->all(), [
                "text" => 'required|string|max:2000',
            ]);

            if ($validation->fails()) {

                $errors = $validation->errors();
                return response($errors->first(), 302);
            }

            Ticket::create([
                'sender' => $request->sender_id,
                'receiver' => $request->receiver_id,
                'ticket_text' => $request->text,
                'sender_text' => $request->sender_type,
                'receiver_text' => $request->receiver_type,
                'job_id' => $jobId,
            ]);
        } else if ($request->text == null && $request->file('file') != null) {
            $validation = Validator::make($request->all(), [
                "file" => 'required|mimes:png,jpg,jpeg,webp|max:500000'
            ]);

            if ($validation->fails()) {

                $errors = $validation->errors();
                return response($errors->first(), 302);
            }

            if ($path = Helper::uploadImg($request->file("file"), '/Ticket_images')) {


                Ticket::create([
                    'sender' => $request->sender_id,
                    'receiver' => $request->receiver_id,
                    'ticket_image' => $path,
                    'sender_text' => $request->sender_type,
                    'receiver_text' => $request->receiver_type,
                    'job_id' => $jobId,
                ]);
            }
        } else if ($request->text != null && $request->file('file') != null) {

            $validation = Validator::make($request->all(), [
                "file" => 'required|mimes:png,jpg,jpeg,webp|max:500000',
                "text" => 'required|string|max:2000',
            ]);

            if ($validation->fails()) {

                $errors = $validation->errors();
                return response($errors->first(), 302);
            }

            if ($path = Helper::uploadImg($request->file("file"), '/Ticket_images')) {

                Ticket::create([
                    'sender' => $request->sender_id,
                    'receiver' => $request->receiver_id,
                    'ticket_text' => $request->text,
                    'ticket_image' => $path,
                    'sender_text' => $request->sender_type,
                    'receiver_text' => $request->receiver_type,
                    'job_id' => $jobId,
                ]);
            }
        }


        return App::call('App\Http\Controllers\api\TicketController@getAllMsgs' , [
            'receiver_id' => $request->receiver_id,
            'receiver_type' => $request->receiver_type,
            'sender_id' => $request->sender_id,
            'sender_type' => $request->sender_type,
        ]);
    }

    public function deleteMsg(Ticket $ticket)
    {

        if ($ticket->ticket_image != null) {
            unlink($ticket->ticket_image);
        }
        $ticket->delete();
        return response('deleted', 200);
    }

    public function editMsg(Ticket $ticket, Request $request)
    {

        if ($request->text != null) {

            $validation = Validator::make($request->all(), [
                "text" => 'required|string|max:2000',
            ]);

            if ($validation->fails()) {

                $errors = $validation->errors();
                return response($errors->first(), 302);
            }

            $ticket->update([
                'ticket_text' => $request->text,
            ]);

            return App::call('App\Http\Controllers\api\TicketController@getAllMsgs' , [
                'receiver_id' => $request->receiver_id,
                'receiver_type' => $request->receiver_type,
                'sender_id' => $request->sender_id,
                'sender_type' => $request->sender_type,
            ]);
        }
    }

    public function deleteAllChat(Request $request)
    {


        $getMsgs = Ticket::where("sender", $request->sender_id)->where("sender_text", $request->sender_type)->where("receiver", $request->receiver_id)->where("receiver_text", $request->receiver_type)->orwhere("sender", $request->receiver_id)->where("sender_text", $request->receiver_type)->where("receiver", $request->sender_id)->where("receiver_text", $request->sender_type)->get();

        foreach ($getMsgs as $msg) {

            if ($msg->ticket_image != null) {

                unlink($msg->ticket_image);
            }

            $msg->delete();
        }

        return response('deleted', 200);
    }
}
