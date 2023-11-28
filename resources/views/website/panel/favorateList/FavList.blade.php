@extends('website.panel.panel_layouts.MasterPanel')

@section("title_page" , 'لیست علاقه مندی')

@section('css_links')

<link rel="stylesheet" href="/website/Css/Panel/favorateList/style.css">

@endsection

@section('panel_content')

<div class="ContentFavCon">

    @if($jobs->count() > 0)

    @foreach($jobs as $job)

    <div class="Job_Card">
        <div class="Job_Banner">
            <a href="/Job/{{ $job->id }}">
                <img src="/{{ $job->banner }}" alt="">
            </a>
        </div>
        <div class="locations">

            @if($job->city()->first()->state()->first()->country()->first()->{'country_name_' . session('lang') } != null)

            <p class="country"> {{ $job->city()->first()->state()->first()->country()->first()->{'country_name_' . session('lang') } }} </p>

            @endif

            @if($job->city()->first()->{'city_name_' . session('lang') } != null)
            <p class="city">
                {{ $job->city()->first()->{'city_name_' . session('lang') } }}
            </p>
            @endif

        </div>
        <p class="title_job">
            {{ $job->{'job_name_' . session('lang')} }}
        </p>
        <p class="job_about">
            {{ $job->{'description_' . session('lang')} }}
        </p>
        <div class="job_propertys">
            <div class="right_property">
                @if(auth()->check())

                @if(App\Models\Like::checkLike($job->id))

                <div class="like_num liked" data-id="{{ $job->id }}">
                    <svg class="ml-1 -mt-0.5" width="13" height="11" viewBox="0 0 13 11" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="currentColor" d="M3.95035 1.229C4.81955 1.229 5.61243 1.66166 6.21284 2.15457C6.81326 1.66166 7.60614 1.229 8.47534 1.229C10.3497 1.229 11.8691 2.62275 11.8691 4.34192C11.8691 7.80824 7.92382 9.82702 6.62321 10.3984C6.36123 10.5134 6.06445 10.5134 5.80248 10.3984C4.50187 9.827 0.556602 7.80816 0.556602 4.34184C0.556602 2.62267 2.07603 1.229 3.95035 1.229Z" stroke-width="0.761705"></path>
                    </svg>
                    {{ $job->likes()->get()->count() }}
                </div>

                @else

                <div class="like_num" data-id="{{ $job->id }}">
                    <svg class="ml-1 -mt-0.5" width="13" height="11" viewBox="0 0 13 11" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="currentColor" d="M3.95035 1.229C4.81955 1.229 5.61243 1.66166 6.21284 2.15457C6.81326 1.66166 7.60614 1.229 8.47534 1.229C10.3497 1.229 11.8691 2.62275 11.8691 4.34192C11.8691 7.80824 7.92382 9.82702 6.62321 10.3984C6.36123 10.5134 6.06445 10.5134 5.80248 10.3984C4.50187 9.827 0.556602 7.80816 0.556602 4.34184C0.556602 2.62267 2.07603 1.229 3.95035 1.229Z" stroke-width="0.761705"></path>
                    </svg>
                    {{ $job->likes()->get()->count() }}
                </div>

                @endif

                @else

                <div class="like_num" data-id="{{ $job->id }}">
                    <svg class="ml-1 -mt-0.5" width="13" height="11" viewBox="0 0 13 11" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="currentColor" d="M3.95035 1.229C4.81955 1.229 5.61243 1.66166 6.21284 2.15457C6.81326 1.66166 7.60614 1.229 8.47534 1.229C10.3497 1.229 11.8691 2.62275 11.8691 4.34192C11.8691 7.80824 7.92382 9.82702 6.62321 10.3984C6.36123 10.5134 6.06445 10.5134 5.80248 10.3984C4.50187 9.827 0.556602 7.80816 0.556602 4.34184C0.556602 2.62267 2.07603 1.229 3.95035 1.229Z" stroke-width="0.761705"></path>
                    </svg>
                    {{ $job->likes()->get()->count() }}
                </div>

                @endif
                <div class="comment_num">
                    <svg viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.99646 0.827528C7.17456 0.827528 8.09169 0.881027 8.80899 1.01903C9.52386 1.15656 10.0045 1.37154 10.3411 1.66825C11.0098 2.25772 11.2804 3.32306 11.2804 5.47101C11.2804 6.85518 11.1561 7.87367 10.8215 8.53718C10.661 8.85564 10.4576 9.07995 10.2017 9.22916C9.94304 9.37996 9.59628 9.474 9.11892 9.474C8.5035 9.474 8.0416 9.61219 7.68041 9.85692C7.32786 10.0958 7.11521 10.4085 6.95703 10.6574C6.9331 10.6951 6.91069 10.7307 6.88949 10.7643C6.75685 10.9749 6.67103 11.1111 6.55187 11.2181C6.44568 11.3134 6.29728 11.3954 5.99659 11.3954C5.69593 11.3954 5.54754 11.3133 5.44133 11.218C5.32218 11.1111 5.23635 10.9749 5.10373 10.7643C5.08251 10.7307 5.0601 10.6951 5.03616 10.6574C4.87797 10.4085 4.66531 10.0958 4.31276 9.8569C3.95156 9.61218 3.48966 9.474 2.87424 9.474C2.39941 9.474 2.05376 9.37759 1.79518 9.22368C1.53855 9.07092 1.33387 8.84146 1.17225 8.51818C0.836472 7.84655 0.712507 6.82628 0.712507 5.47101C0.712507 3.35035 0.982347 2.28225 1.65335 1.68581C1.99094 1.38572 2.47232 1.1667 3.18628 1.02566C3.90284 0.884101 4.81936 0.827528 5.99646 0.827528Z" stroke-width="0.960719" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M6.47668 4.67017H8.39812" stroke-width="0.960719" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3.59465 6.5918H8.39825" stroke-width="0.960719" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    {{ $job->getCommentsNum($job->id) }}
                </div>
            </div>
            <div class="left_property">

                <?php

                $Rate = new App\Models\Rate();

                ?>


                {!! $Rate->GetRateStars($job->Rate) !!}


            </div>
        </div>
        <div class="seeJob">
            <a href="/panel/Job/{{ $job->id }}/deleteList">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <path d="M448 85.333h-66.133C371.66 35.703 328.002.064 277.333 0h-42.667c-50.669.064-94.327 35.703-104.533 85.333H64c-11.782 0-21.333 9.551-21.333 21.333S52.218 128 64 128h21.333v277.333C85.404 464.214 133.119 511.93 192 512h128c58.881-.07 106.596-47.786 106.667-106.667V128H448c11.782 0 21.333-9.551 21.333-21.333S459.782 85.333 448 85.333zM234.667 362.667c0 11.782-9.551 21.333-21.333 21.333-11.783 0-21.334-9.551-21.334-21.333v-128c0-11.782 9.551-21.333 21.333-21.333 11.782 0 21.333 9.551 21.333 21.333v128zm85.333 0c0 11.782-9.551 21.333-21.333 21.333-11.782 0-21.333-9.551-21.333-21.333v-128c0-11.782 9.551-21.333 21.333-21.333 11.782 0 21.333 9.551 21.333 21.333v128zM174.315 85.333c9.074-25.551 33.238-42.634 60.352-42.667h42.667c27.114.033 51.278 17.116 60.352 42.667H174.315z" data-original="#000000" class=""></path>
                    </g>
                </svg>
                {{ __('message.delete_job_fav') }}
            </a>
        </div>
    </div>

    @endforeach

    @else

    <div class="Empty"> {{ __('message.NotFound') }} </div>

    @endif

</div>

@endsection


@section("js_links")


@endsection