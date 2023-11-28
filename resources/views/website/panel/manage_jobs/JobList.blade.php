@extends('website.panel.manage_jobs.master')


@section('css_links')
@parent

<link rel="stylesheet" href="/website/Css/Panel/manage_jobs/list_job.css">


@endsection

@section('job_manage_content')


@if($jobs->count() > 0)

<div class="TableAll">
    <div class="ThAll">
        <div class="th"> {{ __('message.table_th1') }} </div>
        <div class="th"> {{ __('message.table_th2') }} </div>
        <div class="th"> {{ __('message.table_th3') }} </div>
        <div class="th"> {{ __('message.table_th4') }} </div>
        <div class="th"> {{ __('message.table_th5') }} </div>
    </div>
    <div class="TdAllCon">


        @foreach($jobs as $job)

        <div class="TdAll{{ $job->deleted_at != null ? ' noAccepted' : '' }}">
            <div class="td image">
                <img src="/{{$job->banner}}" alt="/{{$job->banner}}">
            </div>
            <div class="td"> {{ $loop->iteration }} </div>
            <div class="td">
                <span> {{ $job->{'job_name_' . session('lang')} }} </span>
            </div>
            <div class="td">
                {{ App\Http\Controllers\helper\DateHelper::FaConvert($job->created_at) }}
            </div>
            <div class="td">
                @if($job->deleted_at == null)

                @if($job->status == "تایید شده")

                <span class="green">{{ __('message.AcceptedJob') }}</span>

                @else

                <span class="orange">{{ __('message.deletedJob2') }}</span>

                @endif

                @else

                <span class="red">{{ __('message.deletedJob') }}</span>

                @endif
            </div>
            <div class="td">
                @if($job->deleted_at == null)

                <div class="dots_operation">
                    <ion-icon name="ellipsis-horizontal"></ion-icon>
                    <div class="dots_drp">

                        @if($job->status == "تایید شده")

                        <div class="options">
                            <a href="/panel/job/{{ $job->id }}/edit_job">
                                <span> {{ __('message.options_dots_drp1') }} </span>
                            </a>
                        </div>
                        <div class="options">
                            <a href="/panel/job/addGallery/{{ $job->id }}/show/withTrashed">
                                <span> {{ __('message.options_dots_drp2') }} </span>
                            </a>
                        </div>
                        <div class="options">
                            <a href="/Job/{{ $job->id }}">
                                <span> {{ __('message.options_dots_drp3') }} </span>
                            </a>
                        </div>

                        @endif
                        <div class="options">
                            <form action="/panel/job/{{ $job->id }}/delete" method="post">
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
                            <a href="/panel/job/{{ $job->id }}/edit_job">
                                <span> {{ __('message.options_dots_drp1') }} </span>
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

{{ $jobs->onEachSide(1)->links() }}

@else

<div class="Empty"> <span>{{ __("message.NoJobsAdded") }}</span> </div>

@endif


@if($jobsAll->count() > 0)

@if($typeResend == "withTrashed")

<a href="/panel/JobList/{{ $typeResend }}" class="change_status"> {{ __('message.withTrashed') }} </a>

@else

<a href="/panel/JobList/{{ $typeResend }}" class="change_status"> {{ __('message.withOutTrashed') }} </a>

@endif

@endif


@endsection


@section("js_links")

<script defer src="/Tools/Js/checkDeletePanel.js"></script>

@endsection