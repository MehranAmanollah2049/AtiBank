<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helper\DateHelper;
use App\Http\Controllers\helper\Helper;
use App\Models\Job;
use App\Models\Ticket;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    // delete
    public function delete(Ticket $ticket)
    {

        if($ticket->ticket_image != null) {
            unlink($ticket->ticket_image);
        }
        $ticket->delete();
        Helper::msg('تیکت مورد نظر با موفقیت حذف شد', 'success');
        return back();
    }

    // show Ticket Text
    public function showTicketText($ticket)
    {

        return Ticket::where('id', $ticket)->withTrashed()->first()->ticket_text;
    }

    // search
    public function search(Request $request)
    {

        $tickets = Ticket::all();

        if ($request->input("searchVal") != "") {

            $user = User::where("name", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("family", "LIKE", "%" . $request->input("searchVal") . "%")->first();
            if ($user != []) {
                $tickets = Ticket::where("sender", $user->id)->where("sender_text", "user")->orwhere("receiver", $user->id)->where("receiver_text", "user")->get();
            } else {

                $job = Job::where("job_name_fa", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("job_name_en", "LIKE", "%" . $request->input("searchVal") . "%")->orwhere("job_name_ar", "LIKE", "%" . $request->input("searchVal") . "%")->first();
                if ($job != []) {

                    $tickets = Ticket::where("sender", $job->id)->where("sender_text", "job")->orwhere("receiver", $job->id)->where("receiver_text", "job")->get();
                }
            }
        }

        return view("admin.Comments.tickets", [
            "sideBar" => "comments",
            "tickets" => $tickets,
        ]);
    }


    public function getJobsList($searchVal)
    {

        $result = [];

        $jobsList = Ticket::where("sender", auth()->user()->id)->where("sender_text", "user")->select(['sender', 'receiver', 'sender_text', 'receiver_text'])->distinct()->get();

        if ($jobsList->count() > 0) {

            foreach ($jobsList as $chat) {

                if (Job::where('id', $chat->receiver)->get()->count() > 0) {

                    $job = Job::where('id', $chat->receiver)->first();

                    $checkJobSearch = true;

                    if($searchVal != 'all') {

                        if(strpos(strtolower($job->job_name_fa) , strtolower($searchVal)) || strpos(strtolower($job->job_name_en) , strtolower($searchVal)) || strpos(strtolower($job->job_name_ar) , strtolower($searchVal))) {

                            $checkJobSearch = true;
                        }
                        else {

                            $checkJobSearch = false;
                        }
                    }
                   
                    
                    if($checkJobSearch) {

                        $jobName  = $job->{'job_name_' . session('lang')};

                        $lastChat = Ticket::where("sender", $chat->sender)->where("sender_text", "user")->where("receiver", $chat->receiver)->where("receiver_text", "job")->orwhere("sender", $chat->receiver)->where("sender_text", "job")->where("receiver", $chat->sender)->where("receiver_text", "user")->orderBy('id', 'DESC')->first();

                        $typeLastMsgSender = '';
                        $LastMsgSender = '';
                        $seen = '';
                        if ($lastChat->sender == $chat->sender && $lastChat->sender_text == "user") {

                            $typeLastMsgSender =  __('message.YOU');
                        }

                        if ($lastChat->ticket_text != null && $lastChat->ticket_image == null) {

                            $LastMsgSender = $lastChat->ticket_text;
                        } else if ($lastChat->ticket_text == null && $lastChat->ticket_image != null) {

                            $LastMsgSender =  "<svg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''>
                                <g>
                                    <path d='M11.122 12.536a3 3 0 0 0-4.244 0l-6.84 6.84A4.991 4.991 0 0 0 5 24h14a4.969 4.969 0 0 0 2.753-.833Z' data-original='#000000' class=''></path>
                                    <circle cx='18' cy='6' r='2' data-original='#000000' class=''></circle>
                                    <path d='M19 0H5a5.006 5.006 0 0 0-5 5v11.586l5.464-5.464a5 5 0 0 1 7.072 0l10.631 10.631A4.969 4.969 0 0 0 24 19V5a5.006 5.006 0 0 0-5-5Zm-1 10a4 4 0 1 1 4-4 4 4 0 0 1-4 4Z' data-original='#000000' class=''></path>
                                </g>
                            </svg>" . $lastChat->ticket_image;
                        } else if ($lastChat->ticket_text != null && $lastChat->ticket_image != null) {

                            $LastMsgSender =  "<svg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.  com/svgjs' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''>
                                <g>
                                    <path d='M11.122 12.536a3 3 0 0 0-4.244 0l-6.84 6.84A4.991 4.991 0 0 0 5 24h14a4.969 4.969 0 0 0 2.753-.833Z' data-original='#000000' class=''></path>
                                    <circle cx='18' cy='6' r='2' data-original='#000000' class=''></circle>
                                    <path d='M19 0H5a5.006 5.006 0 0 0-5 5v11.586l5.464-5.464a5 5 0 0 1 7.072 0l10.631 10.631A4.969 4.969 0 0 0 24 19V5a5.006 5.006 0 0 0-5-5Zm-1 10a4 4 0 1 1 4-4 4 4 0 0 1-4 4Z' data-original='#000000' class=''></path>
                                </g>
                            </svg>" . $lastChat->ticket_text;
                        }

                        $seenNum = Ticket::where("sender", $chat->receiver)->where("sender_text", "job")->where("receiver", $chat->sender)->where("receiver_text", "user")->where('seen', null)->get()->count();

                        if ($seenNum > 0) {

                            $seen = "<div class='chat_seenNum'>$seenNum</div>";
                        }

                        $result[] = "<div class='Chats' onclick='setDatas($chat->sender,`$chat->sender_text`,$chat->receiver,`$chat->receiver_text`)'>
                                <img src='/$job->banner' alt=''>
                                <div class='chat_infos'>
                                    <p class='title'> $jobName</p>
                                    <p class='lastMsg'>$typeLastMsgSender  $LastMsgSender </p>
                                </div>
                                $seen
                            </div>";
                    }
                }
            }
        }

        if ($result == []) {

            $emptyText = __('message.NotFound');
            $result[] = "<div class='emptyChats'>
                        <svg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''>
                            <g>
                                <path d='M20 0H4a4 4 0 0 0-4 4v12a4 4 0 0 0 4 4h2.9l4.451 3.763a1 1 0 0 0 1.292 0L17.1 20H20a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4Zm2 16a2 2 0 0 1-2 2h-2.9a2 2 0 0 0-1.291.473L12 21.69l-3.807-3.217A2 2 0 0 0 6.9 18H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2Z'  data-original='#000000'></path>
                                <path d='M7 7h5a1 1 0 0 0 0-2H7a1 1 0 0 0 0 2ZM17 9H7a1 1 0 0 0 0 2h10a1 1 0 0 0 0-2ZM17 13H7a1 1 0 0 0 0 2h10a1 1 0 0 0 0-2Z'  data-original='#000000'></path>
                            </g>
                        </svg>
                        $emptyText
                    </div>";
        }

        return join('', $result);
    }

    public function getUserList($searchVal)
    {

        $result = [];

        $user = User::where("id", auth()->user()->id)->first();
        $jobs = $user->jobs()->get();
        if ($jobs->count() > 0) {

            foreach ($jobs as $job) {

                $UserList = Ticket::where("job_id", $job->id)->where('sender_text', 'user')->select(['sender', 'receiver', 'sender_text', 'receiver_text'])->distinct()->get();
                if ($UserList->count() > 0) {

                    foreach ($UserList as $chat) {
                        if (User::where('id', $chat->sender)->first() != []) {

                            $UserSender = User::where('id', $chat->sender)->first();

                            $checkUserSearch = true;

                            if($searchVal != 'all') {

                                if(strpos(strtolower($UserSender->name) , strtolower($searchVal)) || strpos(strtolower($UserSender->family) , strtolower($searchVal))) {

                                    $checkUserSearch = true;
                                }
                                else {

                                    $checkUserSearch = false;
                                }
                            }
                   
                            
                            if($checkUserSearch) {

                                    $UserName  = $UserSender->name . ' ' . $UserSender->family;

                                    $lastChat = Ticket::where("job_id", $job->id)->orderBy('id', 'DESC')->first();

                                    $typeLastMsgSender = '';
                                    $LastMsgSender = '';
                                    $seen = '';
                                    if ($lastChat->sender == $job->id && $lastChat->sender_text == "job") {

                                        $typeLastMsgSender =  __('message.YOU');
                                    }

                                    if ($lastChat->ticket_text != null && $lastChat->ticket_image == null) {

                                        $LastMsgSender = $lastChat->ticket_text;
                                    } else if ($lastChat->ticket_text == null && $lastChat->ticket_image != null) {

                                        $LastMsgSender =  "<svg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''>
                                            <g>
                                                <path d='M11.122 12.536a3 3 0 0 0-4.244 0l-6.84 6.84A4.991 4.991 0 0 0 5 24h14a4.969 4.969 0 0 0 2.753-.833Z' data-original='#000000' class=''></path>
                                                <circle cx='18' cy='6' r='2' data-original='#000000' class=''></circle>
                                                <path d='M19 0H5a5.006 5.006 0 0 0-5 5v11.586l5.464-5.464a5 5 0 0 1 7.072 0l10.631 10.631A4.969 4.969 0 0 0 24 19V5a5.006 5.006 0 0 0-5-5Zm-1 10a4 4 0 1 1 4-4 4 4 0 0 1-4 4Z' data-original='#000000' class=''></path>
                                            </g>
                                        </svg>" . $lastChat->ticket_image;
                                    } else if ($lastChat->ticket_text != null && $lastChat->ticket_image != null) {

                                        $LastMsgSender =  "<svg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''>
                                    <g>
                                        <path d='M11.122 12.536a3 3 0 0 0-4.244 0l-6.84 6.84A4.991 4.991 0 0 0 5 24h14a4.969 4.969 0 0 0 2.753-.833Z' data-original='#000000' class=''></path>
                                        <circle cx='18' cy='6' r='2' data-original='#000000' class=''></circle>
                                        <path d='M19 0H5a5.006 5.006 0 0 0-5 5v11.586l5.464-5.464a5 5 0 0 1 7.072 0l10.631 10.631A4.969 4.969 0 0 0 24 19V5a5.006 5.006 0 0 0-5-5Zm-1 10a4 4 0 1 1 4-4 4 4 0 0 1-4 4Z' data-original='#000000' class=''></path>
                                    </g>
                                </svg>" . $lastChat->ticket_text;
                                    }

                                    $seenNum = Ticket::where("sender", $chat->sender)->where("sender_text", $chat->sender_text)->where("receiver", $chat->receiver)->where("receiver_text", $chat->receiver_text)->where('seen', null)->get()->count();

                                    if ($seenNum > 0) {

                                        $seen = "<div class='chat_seenNum'>$seenNum</div>";
                                    }

                                    $result[] = "<div class='Chats' onclick='setDatas($chat->receiver,`$chat->receiver_text`,$chat->sender,`$chat->sender_text`)'>
                                            <img src='/$UserSender->profile' alt=''>
                                            <div class='chat_infos'>
                                                <p class='title'> $UserName</p>
                                                <p class='lastMsg'>$typeLastMsgSender  $LastMsgSender </p>
                                            </div>
                                            $seen
                                        </div>";
                            }
                        }
                    }
                }
            }
        }

        if ($result == []) {

            $emptyText = __('message.NotFound');
            $result = ["<div class='emptyChats'>
                        <svg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''>
                            <g>
                                <path d='M20 0H4a4 4 0 0 0-4 4v12a4 4 0 0 0 4 4h2.9l4.451 3.763a1 1 0 0 0 1.292 0L17.1 20H20a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4Zm2 16a2 2 0 0 1-2 2h-2.9a2 2 0 0 0-1.291.473L12 21.69l-3.807-3.217A2 2 0 0 0 6.9 18H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2Z'  data-original='#000000'></path>
                                <path d='M7 7h5a1 1 0 0 0 0-2H7a1 1 0 0 0 0 2ZM17 9H7a1 1 0 0 0 0 2h10a1 1 0 0 0 0-2ZM17 13H7a1 1 0 0 0 0 2h10a1 1 0 0 0 0-2Z'  data-original='#000000'></path>
                            </g>
                        </svg>
                        $emptyText
                    </div>"];
        }


        return join('', $result);
    }

    public function setDatas($sender_id, $sender_type, $receiver_id, $receiver_type)
    {

        $this->clearDatas();

        if ($sender_type == 'job') {

            $checkJob = Job::where('id', $sender_id)->first();
        } else if ($receiver_type == 'job') {

            $checkJob = Job::where('id', $receiver_id)->first();
        }

        if ($sender_type == 'user') {

            $checkUser = User::where('id', $sender_id)->first();
        } else if ($receiver_type == 'user') {

            $checkUser = User::where('id', $receiver_id)->first();
        }

        if ($checkJob != null && $checkUser != null) {

            session(['sender' => ['id' => $sender_id, 'type' => $sender_type]]);
            session(['receiver' => ['id' => $receiver_id, 'type' => $receiver_type]]);
        }


        if (session()->has('sender') && session()->has('receiver')) {

            return 'true';
        } else {

            return 'false';
        }
    }


    private function clearDatas()
    {

        if (session()->has('sender')) {

            session()->forget('sender');
        }
        if (session()->has('receiver')) {

            session()->forget('receiver');
        }
    }

    private function getReceiverInfos($id, $type, $sender)
    {

        if ($type == "user") {

            $user = User::where('id', $id)->first();

            $job = Job::where('id', $sender)->first()->{'job_name_' . session('lang')};

            return join("|", ['/'.$user->profile, $user->name . ' ' . $user->family . ' ' . '(' . $job .  ')', $user->phoneNumber]);
        } else {

            $job = Job::where('id', $id)->first();

            return join("|", ['/' . $job->banner, $job->{'job_name_' . session('lang')}, $job->phoneNumber]);
        }
    }

    public function addMsg(Request $request)
    {

        if (session()->has('sender') && session()->has('receiver')) {

            $jobId = 0;

            if (session('sender')['type'] == 'job') {

                $jobId = session('sender')['id'];
            } else if (session('receiver')['type'] == 'job') {

                $jobId = session('receiver')['id'];
            }


            if ($request->text != null && $request->file('file') == null) {

                $validation = Validator::make($request->all(), [
                    "text" => 'required|string|max:2000',
                ]);

                if ($validation->fails()) {

                    $errors = $validation->errors();
                    return join('|', ['error', $errors->first()]);
                }

                Ticket::create([
                    'sender' => session('sender')['id'],
                    'receiver' => session('receiver')['id'],
                    'ticket_text' => $request->text,
                    'sender_text' => session('sender')['type'],
                    'receiver_text' => session('receiver')['type'],
                    'job_id' => $jobId,
                ]);
            } else if ($request->text == null && $request->file('file') != null) {

                $validation = Validator::make($request->all(), [
                    "file" => 'required|mimes:png,jpg,jpeg,webp|max:500000'
                ]);

                if ($validation->fails()) {

                    $errors = $validation->errors();
                    return join('|', ['error', $errors->first()]);
                }

                if ($path = Helper::uploadImg($request->file("file"), '/Ticket_images')) {


                    Ticket::create([
                        'sender' => session('sender')['id'],
                        'receiver' => session('receiver')['id'],
                        'ticket_image' => $path,
                        'sender_text' => session('sender')['type'],
                        'receiver_text' => session('receiver')['type'],
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
                    return join('|', ['error', $errors->first()]);
                }

                if ($path = Helper::uploadImg($request->file("file"), '/Ticket_images')) {

                    Ticket::create([
                        'sender' => session('sender')['id'],
                        'receiver' => session('receiver')['id'],
                        'ticket_text' => $request->text,
                        'ticket_image' => $path,
                        'sender_text' => session('sender')['type'],
                        'receiver_text' => session('receiver')['type'],
                        'job_id' => $jobId,
                    ]);
                }
            }


            return join('|', ['true']);
        } else {

            return false;
        }
    }

    public function getAllMsgs()
    {

        if (session()->has('sender') && session()->has('receiver')) {

            $this->seenMsgs();

            $msgsAll = [];

            $getMsgs = Ticket::where("sender", session('sender')['id'])->where("sender_text", session('sender')['type'])->where("receiver", session('receiver')['id'])->where("receiver_text", session('receiver')['type'])->orwhere("sender", session('receiver')['id'])->where("sender_text", session('receiver')['type'])->where("receiver", session('sender')['id'])->where("receiver_text", session('sender')['type'])->get();

            if ($getMsgs->count() > 0) {

                foreach ($getMsgs as $msg) {

                    $editText = __('message.options_dots_drp1');
                    $deleteText = __('message.options_dots_drp4');

                    $time = DateHelper::FaConvert4($msg->updated_at);

                    if ($msg->sender == session('sender')['id'] && $msg->sender_text == session('sender')['type']) {

                        $seen = "<div class='msg_status'>
                            <svg class='seenIcon' xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 507.506 507.506' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''>
                                <g>
                                    <path d='M163.865 436.934a54.228 54.228 0 0 1-38.4-15.915L9.369 304.966c-12.492-12.496-12.492-32.752 0-45.248 12.496-12.492 32.752-12.492 45.248 0l109.248 109.248L452.889 79.942c12.496-12.492 32.752-12.492 45.248 0 12.492 12.496 12.492 32.752 0 45.248L202.265 421.019a54.228 54.228 0 0 1-38.4 15.915z' data-original='#000000' class=''></path>
                                </g>
                            </svg>";

                        if ($msg->seen != null) {

                            $seen = "<svg class='seenIcon' xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs'  x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''><g><path d='M1.283 7.697a1 1 0 1 1 1.435-1.393l4.089 4.211c.307.31.727.485 1.173.486.445 0 .867-.173 1.182-.488l9.128-9.217a.998.998 0 0 1 1.414-.007.999.999 0 0 1 .007 1.414l-9.131 9.219A3.663 3.663 0 0 1 7.976 13a3.641 3.641 0 0 1-2.596-1.085L1.283 7.697Zm22.423-.405a.999.999 0 0 0-1.414.002L9.205 20.414a1.996 1.996 0 0 1-2.841-.013l-4.665-4.617a1 1 0 0 0-1.408 1.422l4.659 4.61A3.979 3.979 0 0 0 7.783 23a3.99 3.99 0 0 0 2.837-1.173L23.708 8.706a1 1 0 0 0-.002-1.414Z' data-original='#000000' class=''></path></g></svg>";
                        }

                        $profile = '';

                        if (session('sender')['type'] == "user") {

                            $profile = '/'. User::where('id', session('sender')['id'])->first()->profile;
                        } else {

                            $profile = '/' . Job::where('id', session('sender')['id'])->first()->banner;
                        }


                        if ($msg->ticket_text != null && $msg->ticket_image == null) {

                            $msgsAll[] = "<div class='MessageAll Me' onclick='ShowMenuOptions(event)'>
                                        <img src='$profile' class='user_profile_msg' alt='user_image'>
                                        <div class='msgContentCon'>
                                            <div class='msg_sec'>
                                                <p> $msg->ticket_text </p>
                    
                                            </div>
                                            <div class='msg_status'>
                                                $seen
                                                <p class='dateSent'>$time</p>
                                            </div>
                                                
                                            </div>
                                            <div class='Menu_msg_con'>
                                                <div class='options' onclick='editMsg($msg->id)'> $editText </div>
                                                <div class='options' onclick='DeleteMsg($msg->id)'> $deleteText </div>
                                            </div>
                                        </div>
                                    </div>";
                        } else if ($msg->ticket_text == null && $msg->ticket_image != null) {

                            $msgsAll[] = "<div class='MessageAll Me' onclick='ShowMenuOptions(event)'>
                            <img src='$profile' class='user_profile_msg' alt='user_image'>
                            <div class='msgContentCon'>
                                <div class='msg_sec'>
                                    <img src='/$msg->ticket_image' alt='image not load'>
                                </div>
                                <div class='msg_status'>
                                    $seen
                                    <p class='dateSent'>$time</p>
                                </div>
                                </div>
                                <div class='Menu_msg_con'>
                                    <div class='options' onclick='editMsg($msg->id)'> $editText </div>
                                    <div class='options' onclick='DeleteMsg($msg->id)'> $deleteText </div>
                                </div>
                            </div>
                        
                        </div>";
                        } else if ($msg->ticket_text != null && $msg->ticket_image != null) {

                            $msgsAll[] = "<div class='MessageAll Me' onclick='ShowMenuOptions(event)'>
                            <img src='$profile' class='user_profile_msg' alt='user_image'>
                            <div class='msgContentCon'>
                                <div class='msg_sec'>
                                    <img src='/$msg->ticket_image' alt='image not load'>
                                    <p> $msg->ticket_text </p>
                                </div>
                                <div class='msg_status'>
                                    $seen
                                    <p class='dateSent'>$time</p>
                                </div>
                                </div>
                                <div class='Menu_msg_con'>
                                    <div class='options' onclick='editMsg($msg->id)'> $editText </div>
                                    <div class='options' onclick='DeleteMsg($msg->id)'> $deleteText </div>
                                </div>
                            </div>
                        
                        </div>";
                        }
                    } else {


                        $profile = '';

                        if (session('receiver')['type'] == "user") {

                            $profile = '/' . User::where('id', session('receiver')['id'])->first()->profile;
                        } else {

                            $profile = '/' . Job::where('id', session('receiver')['id'])->first()->banner;
                        }


                        if ($msg->ticket_text != null && $msg->ticket_image == null) {

                            $msgsAll[] = "<div class='MessageAll'>
                                                <div class='msgContentCon'>
                                                    <div class='msg_sec'>
                                                        <p> $msg->ticket_text </p>
                                                    </div>
                                                        <p class='dateSent'>$time</p>
                                                 
                                                </div>
                                                    <img src='$profile' class='user_profile_msg' alt='job_image'>
                                            </div>";
                        } else if ($msg->ticket_text == null && $msg->ticket_image != null) {

                            $msgsAll[] = "<div class='MessageAll'>      
                                                <div class='msgContentCon'>
                                                    <div class='msg_sec'>
                                                        <img src='/$msg->ticket_image' alt='image not load'>
                                                    </div>
                                                    <p class='dateSent'>$time</p>
                                                </div>
                                                <img src='$profile' class='user_profile_msg' alt='job_image'>
                                                </div>";
                        } else if ($msg->ticket_text != null && $msg->ticket_image != null) {

                            $msgsAll[] = "<div class='MessageAll'>
                                            <div class='msgContentCon'>
                                                <div class='msg_sec'>
                                                    <img src='/$msg->ticket_image' alt='image not load'>
                                                    <p> $msg->ticket_text </p>
                                                </div>
                                                    <p class='dateSent'>$time</p>
                                            </div>
                                            <img src='$profile' class='user_profile_msg' alt='job_image'>
                                        </div>";
                        }
                    }
                }
            } else {

                return 'EmptyAll';
            }


            return join('', $msgsAll);
        } else {

            return 'EmptyAll';
        }
    }

    public function seenMsgs()
    {

        $getMsgs = Ticket::where("sender", session('receiver')['id'])->where("sender_text", session('receiver')['type'])->where("receiver", session('sender')['id'])->where("receiver_text", session('sender')['type'])->get();

        foreach ($getMsgs as $msg) {

            $msg->update([
                'seen' => now(),
            ]);
        }
    }

    public function editMsg(Ticket $ticket)
    {

        $result = [];

        if ($ticket->ticket_text != null && $ticket->ticket_image == null) {

            $result = [$ticket->ticket_text, 0, $ticket->id];
        } else if ($ticket->ticket_text == null && $ticket->ticket_image != null) {

            $result = [0, $ticket->ticket_image, $ticket->id];
        } else if ($ticket->ticket_text != null && $ticket->ticket_image != null) {

            $result = [$ticket->ticket_text, $ticket->ticket_image, $ticket->id];
        }


        return join("|", $result);
    }

    public function EditFormMsg(Request $request, Ticket $ticket)
    {

        if (session()->has('sender') && session()->has('receiver')) {


            if ($request->text != null) {

                $validation = Validator::make($request->all(), [
                    "text" => 'required|string|max:2000',
                ]);

                if ($validation->fails()) {

                    $errors = $validation->errors();
                    return join('|', ['error', $errors->first()]);
                }

                $ticket->update([
                    'ticket_text' => $request->text,
                ]);
            } else {

                $ticket->update([
                    'ticket_text' => null,
                ]);
            }

            if ($request->file("file") != null) {

                $validation = Validator::make($request->all(), [
                    "file" => 'required|mimes:png,jpg,jpeg,webp|max:500000',
                ]);

                if ($validation->fails()) {

                    $errors = $validation->errors();
                    return join('|', ['error', $errors->first()]);
                }

                unlink($ticket->ticket_image);

                if ($path = Helper::uploadImg($request->file("file"), '/Ticket_images')) {

                    $ticket->update([
                        'ticket_image' => $path,
                    ]);
                }
            }

            if ($request->fileStatus != null) {

                unlink($ticket->ticket_image);
                $ticket->update([
                    'ticket_image' => null,
                ]);
            }

            return join('|', ['true']);
        } else {

            return false;
        }
    }

    public function deleteMsg(Ticket $ticket)
    {

        if ($ticket->ticket_image != null) {

            unlink($ticket->ticket_image);
        }

        $ticket->delete();
        return 'true';
    }

    public function getGetterInfo()
    {

        if (session()->has("receiver")) {

            return $this->getReceiverInfos(session('receiver')['id'], session('receiver')['type'], session('sender')['id']);
        }
    }

    public function deleteAllChatBtn()
    {

        $getMsgs = Ticket::where("sender", session('sender')['id'])->where("sender_text", session('sender')['type'])->where("receiver", session('receiver')['id'])->where("receiver_text", session('receiver')['type'])->orwhere("sender", session('receiver')['id'])->where("sender_text", session('receiver')['type'])->where("receiver", session('sender')['id'])->where("receiver_text", session('sender')['type'])->get();

        foreach ($getMsgs as $msg) {

            if ($msg->ticket_image != null) {

                unlink($msg->ticket_image);
            }

            $msg->delete();
        }

        Helper::msg(__('message.deletedAll'), 'success');
        return back();
    }

    public function addTicketFromJobPage(Request $request, Job $job)
    {

        if (auth()->check()) {

            $validation = Validator::make($request->all(), [
                "text" => 'required|string|max:2000',
            ]);

            if ($validation->fails()) {

                $errors = $validation->errors();
                return join('|', ['error', $errors->first()]);
            }


            Ticket::create([
                'sender' => auth()->user()->id,
                'receiver' => $job->id,
                'ticket_text' => $request->text,
                'sender_text' => 'user',
                'receiver_text' => 'job',
                'job_id' => $job->id
            ]);

            Helper::msg(__('message.MsgSent'), 'success');
            return back();
        }
    }
}
