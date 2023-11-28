@extends('website.panel.panel_layouts.MasterPanel')

@section("title_page" , 'مدیریت نظرات')

@section('css_links')

<link rel="stylesheet" href="/website/Css/Panel/manage_jobs/list_job.css">
<link rel="stylesheet" href="/website/Css/Panel/comments/commentList.css">

@endsection

@section('panel_content')

@if($comments->count() != 0 || $answers->count() != 0)

<div class="AllManageCMT">
    
    
    @if($comments->count() > 0)
    <div class="commentTbCon">
        <p class="titleAll"> {{ __('message.cmtLits') }} </p>

        <div class="TableAll">
            <div class="ThAll">
                <div class="th"> {{ __('message.table_th1') }} </div>
                <div class="th"> {{ __('message.table_th7') }} </div>
                <div class="th"> {{ __('message.table_th6') }} </div>
                <div class="th"> {{ __('message.table_th3') }} </div>
                <div class="th"> {{ __('message.table_th4') }} </div>
                <div class="th"> {{ __('message.table_th10') }} </div>
                <div class="th"> {{ __('message.table_th5') }} </div>
            </div>
            <div class="TdAllCon">


                @foreach($comments as $comment)

                <div class="TdAll {{ $comment->deleted_at != null ? 'noAccepted' : '' }} ">
                    <div class="td"> {{ $loop->iteration }} </div>
                    <div class="td">
                        <span><?= str_replace('<br />' , ' ' , $comment->comment_text) ?></span>
                    </div>
                    <div class="td">
                        <span> {{ $comment->job()->first()->{'job_name_' . session('lang')} }}</span>
                    </div>
                    <div class="td">
                        {{ App\Http\Controllers\helper\DateHelper::FaConvert($comment->created_at) }}
                    </div>
                    <div class="td">
                        @if($comment->deleted_at == null)

                        @if($comment->status == "تایید شده")

                        <span class="green">{{ __('message.AcceptedJob') }}</span>

                        @else

                        <span class="orange">{{ __('message.deletedJob2') }}</span>

                        @endif

                        @else

                        <span class="red">{{ __('message.deletedJob') }}</span>

                        @endif
                    </div>
                    <div class="td">
                        <span> {{ $comment->likesNum() . ' ' . __('message.likeText') }}</span>
                    </div>
                    <div class="td">
                        @if($comment->deleted_at == null)

                        <div class="dots_operation">
                            <ion-icon name="ellipsis-horizontal"></ion-icon>
                            <div class="dots_drp">

                                @if($comment->status == "تایید شده")

                                <div class="options">
                                    <a href="/panel/editComment/{{ $comment->id }}/comment">
                                        <span> {{ __('message.options_dots_drp1') }} </span>
                                    </a>
                                </div>
                                @if($comment->job->first()->status == "تایید شده")

                                <div class="options">
                                    <a href="/Job/{{ $comment->job()->first()->id }}">
                                        <span> {{ __('message.options_dots_drp3') }} </span>
                                    </a>
                                </div>

                                @endif

                                @endif
                                <div class="options">
                                    <form action="/panel/Cmt/{{ $comment->id }}/comment/delete" method="post">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" class="btn btn-danger deleteBtn">
                                            {{ __('message.options_dots_drp4') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @else

                        <div class="dots_operation">
                            <ion-icon name="ellipsis-horizontal"></ion-icon>
                            <div class="dots_drp">

                                <div class="options">
                                    <a href="/panel/editComment/{{ $comment->id }}/comment">
                                        <span> {{ __('message.options_dots_drp1') }} </span>
                                    </a>
                                </div>

                                <div class="options">
                                    <a href="/panel/comment/{{ $comment->id }}/comment/request">
                                        <span> {{ __('message.request_again') }} </span>
                                    </a>
                                </div>

                            </div>
                        </div>

                        @endif

                    </div>
                </div>

                @endforeach

            </div>
        </div>

    </div>

    @endif

    @if($answers->count() > 0)

    <div class="commentTbCon">
        <p class="titleAll"> {{ __('message.cmtLits2') }} </p>

        <div class="TableAll">
            <div class="ThAll">
                <div class="th"> {{ __('message.table_th1') }} </div>
                <div class="th"> {{ __('message.table_th9') }} </div>
                <div class="th"> {{ __('message.table_th7') }} </div>
                <div class="th"> {{ __('message.table_th6') }} </div>
                <div class="th"> {{ __('message.table_th3') }} </div>
                <div class="th"> {{ __('message.table_th4') }} </div>
                <div class="th"> {{ __('message.table_th10') }} </div>
                <div class="th"> {{ __('message.table_th5') }} </div>
            </div>
            <div class="TdAllCon">


                @foreach($answers as $answer)

                <div class="TdAll {{ $answer->deleted_at != null ? 'noAccepted' : '' }} ">
                    <div class="td"> {{ $loop->iteration }} </div>
                    <div class="td">
                        <span>
                            @if($answer->type_receiver == "user")

                            {{ App\Models\User::where("id" , $answer->user_id_receiver)->first()->name . ' ' . App\Models\User::where("id" , $answer->user_id_receiver)->first()->family }}

                            @elseif($answer->type_receiver == "admin")

                            {{ __('message.atibank_admin') }}

                            @endif
                        </span>
                    </div>
                    <div class="td">
                        <span> <?= str_replace('<br />' , ' ' , $answer->answer_text) ?></span>
                    </div>
                    <div class="td">
                        <span> {{ $answer->comment()->first()->job()->first()->{'job_name_' . session('lang')} }}</span>
                    </div>
                    <div class="td">
                        {{ App\Http\Controllers\helper\DateHelper::FaConvert($answer->created_at) }}
                    </div>
                    <div class="td">
                        @if($answer->deleted_at == null)

                        @if($answer->status == "تایید شده")

                        <span class="green">{{ __('message.AcceptedJob') }}</span>

                        @else

                        <span class="orange">{{ __('message.deletedJob2') }}</span>

                        @endif

                        @else

                        <span class="red">{{ __('message.deletedJob') }}</span>

                        @endif
                    </div>
                    <div class="td">
                        <span> {{ $answer->likesNum() . ' ' . __('message.likeText') }}</span>
                    </div>
                    <div class="td">
                        @if($answer->deleted_at == null)

                        <div class="dots_operation">
                            <ion-icon name="ellipsis-horizontal"></ion-icon>
                            <div class="dots_drp">

                                @if($answer->status == "تایید شده")

                                <div class="options">
                                    <a href="/panel/editComment/{{ $answer->id }}/answer">
                                        <span> {{ __('message.options_dots_drp1') }} </span>
                                    </a>
                                </div>
                                @if($answer->comment()->first()->job->first()->status == "تایید شده")

                                <div class="options">
                                    <a href="/Job/{{ $answer->comment()->first()->job()->first()->id }}">
                                        <span> {{ __('message.options_dots_drp3') }} </span>
                                    </a>
                                </div>

                                @endif

                                @endif
                                <div class="options">
                                    <form action="/panel/Cmt/{{ $answer->id }}/answer/delete" method="post">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" class="btn btn-danger deleteBtn">
                                            {{ __('message.options_dots_drp4') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @else

                        <div class="dots_operation">
                            <ion-icon name="ellipsis-horizontal"></ion-icon>
                            <div class="dots_drp">

                                <div class="options">
                                    <a href="/panel/editComment/{{ $answer->id }}/answer">
                                        <span> {{ __('message.options_dots_drp1') }} </span>
                                    </a>
                                </div>

                                <div class="options">
                                    <a href="/panel/comment/{{ $answer->id }}/answer/request">
                                        <span> {{ __('message.request_again') }} </span>
                                    </a>
                                </div>

                            </div>
                        </div>

                        @endif

                    </div>
                </div>

                @endforeach

            </div>
        </div>

    </div>

    @endif



</div>

@endif


@if($comments->count() == 0 && $answers->count() == 0)


<div class="Empty"> {{ __("message.NotFound") }} </div>


@endif


@endsection


@section("js_links")


@endsection