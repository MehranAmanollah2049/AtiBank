@extends('website.panel.manage_jobs.master')


@section('css_links')
@parent

<link rel="stylesheet" href="/website/Css/Panel/manage_jobs/list_job.css">
<link rel="stylesheet" href="/website/Css/Panel/manage_jobs/add_job.css">


@endsection

@section('job_manage_content')


<form action="/panel/job/{{ $job->id }}/add_pic" method="post" enctype="multipart/form-data" class="add_Job_from" style="margin-bottom: 60px">

    <div class="UploadJobImageCon">
        <input type="file" style="display: none;" name="file" id="file">
        <div class="uploadPlace">
            <label for="file">
                <div class="uploadIcon">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M17.974 7.146a1.032 1.032 0 0 1-.742-.569c-1.55-3.271-5.143-5.1-8.734-4.438A7.946 7.946 0 0 0 2.114 8.64a8.13 8.13 0 0 0 .033 2.89c.06.309-.073.653-.346.901A5.51 5.51 0 0 0 0 16.501c0 3.032 2.467 5.5 5.5 5.5h11c4.136 0 7.5-3.364 7.5-7.5 0-3.565-2.534-6.658-6.026-7.354Zm-2.853 6.562a.997.997 0 0 1-1.414 0L12 12.001v5a1 1 0 1 1-2 0v-5l-1.707 1.707a.999.999 0 1 1-1.414-1.414l2.707-2.707a1.99 1.99 0 0 1 1.4-.583L11 9.001l.014.003a1.989 1.989 0 0 1 1.4.583l2.707 2.707a.999.999 0 0 1 0 1.414Z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                </div>
            </label>
            <div class="deleteUploadedFileCon">
                <div class="deleteBox">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M448 85.333h-66.133C371.66 35.703 328.002.064 277.333 0h-42.667c-50.669.064-94.327 35.703-104.533 85.333H64c-11.782 0-21.333 9.551-21.333 21.333S52.218 128 64 128h21.333v277.333C85.404 464.214 133.119 511.93 192 512h128c58.881-.07 106.596-47.786 106.667-106.667V128H448c11.782 0 21.333-9.551 21.333-21.333S459.782 85.333 448 85.333zM234.667 362.667c0 11.782-9.551 21.333-21.333 21.333-11.783 0-21.334-9.551-21.334-21.333v-128c0-11.782 9.551-21.333 21.333-21.333 11.782 0 21.333 9.551 21.333 21.333v128zm85.333 0c0 11.782-9.551 21.333-21.333 21.333-11.782 0-21.333-9.551-21.333-21.333v-128c0-11.782 9.551-21.333 21.333-21.333 11.782 0 21.333 9.551 21.333 21.333v128zM174.315 85.333c9.074-25.551 33.238-42.634 60.352-42.667h42.667c27.114.033 51.278 17.116 60.352 42.667H174.315z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="leaveDrag">
                <p> {{ __('message.leave_for_upload') }} </p>
            </div>
        </div>


    </div>

    <div class="bottomInts">


        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.description_fa') }}</label>
            <input type="text" name="description_fa" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ old('description_fa') }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.description_en') }}</label>
            <input type="text" name="description_en" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ old('description_en') }}">
        </div>
        <div class="ints_sec" style="width: 100%;">
            <label for="exampleInputEmail1"> {{ __('message.description_ar') }}</label>
            <input type="text" name="description_ar" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ old('description_ar') }}">
        </div>


        <button type="button" class="submitBtn">
            {{ __('message.add_job_image__btn') }}
        </button>

    </div>


    @csrf
</form>


@if($gallery->count() > 0)

<div class="TableAll">
    <div class="ThAll">
        <div class="th"> {{ __('message.table_th1') }} </div>
        <div class="th"> {{ __('message.table_th2') }} </div>
        <div class="th"> {{ __('message.table_th4') }} </div>
        <div class="th"> {{ __('message.table_th5') }} </div>
    </div>
    <div class="TdAllCon">

        @foreach($gallery as $img)

        <div class="TdAll{{ $img->deleted_at != null ? ' noAccepted' : '' }}">
            <div class="td image">
                <img src="/{{$job->banner}}" alt="/{{$job->banner}}">
            </div>
            <div class="td"> {{ $loop->iteration }} </div>
            <div class="td">
                <span> {{ $img->{'description_' . session('lang')} }} </span>
            </div>
            <div class="td">
                @if($img->deleted_at == null)

                @if($img->status == "تایید شده")

                <span class="green">{{ __('message.AcceptedJob') }}</span>

                @else

                <span class="orange">{{ __('message.deletedJob2') }}</span>

                @endif

                @else

                <span class="red">{{ __('message.deletedJob') }}</span>

                @endif
            </div>
            <div class="td">

                <div class="dots_operation">
                    <ion-icon name="ellipsis-horizontal"></ion-icon>
                    <div class="dots_drp">
                        <div class="options">
                            <a href="/{{ $img->image }}" target="_blank">
                                <span> {{ __('message.options_dots_drp3') }} </span>
                            </a>
                        </div>
                        @if($img->deleted_at == null)

                        <div class="options">
                            <form action="/panel/jobImg/{{ $img->id }}/delete" method="post">
                                @csrf
                                @method("delete")
                                <button type="submit" class="btn btn-danger deleteBtn">
                                    {{ __('message.options_dots_drp4') }}
                                </button>
                            </form>
                        </div>

                        @endif


                    </div>
                </div>

            </div>
        </div>

        @endforeach

    </div>
</div>

{{ $gallery->onEachSide(1)->links() }}


@else

<div class="Empty"> {{ __('message.NotFound') }} </div>

@endif


@if($galleryAll->count() > 0)

@if($typeResend == "withTrashed")

<a href="/panel/job/addGallery/{{ $job->id }}/show/{{ $typeResend }}" class="change_status"> {{ __('message.withTrashed') }} </a>

@else

<a href="/panel/job/addGallery/{{ $job->id }}/show/{{ $typeResend }}" class="change_status"> {{ __('message.withOutTrashed') }} </a>

@endif

@endif



@endsection


@section("js_links")

<script defer src="/website/Js/panel/manage_jobs/uploadImage.js"></script>
<script defer src="/Tools/Js/checkDeletePanel.js"></script>
<script defer src="/website/Js/panel/manage_jobs/validation_gllery_<?= session('lang') ?>.js"></script>

@endsection