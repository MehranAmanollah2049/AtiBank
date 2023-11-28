@extends("website.layouts.Master")

@section("title_page" , __('message.AllJobs'))

@section("css_links")
<link rel="stylesheet" href="/website/Css/Jobs/style.css">
@endsection

@section("content")

<div class="container_header_con">
    <div class="container_header_sec">
        <div class="header_top">
            <div class="header_right">
                <p class="title_job"> {{ $job->{'job_name_' . session('lang')} }} </p>
                <p class="descriptio_job"> {{ $job->{'description_' . session('lang')} }} </p>
                <div class="header_options_con">

                    @if($job->galley()->where("status" , "تایید شده")->get()->count() > 0)

                    <div class="watch_gallery_btns">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M9 5.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5S11.33 7 10.5 7 9 6.33 9 5.5ZM24 5v6c0 2.76-2.24 5-5 5h-9c-2.76 0-5-2.24-5-5V5c0-2.76 2.24-5 5-5h9c2.76 0 5 2.24 5 5ZM7 11c0 .77.29 1.47.77 2.01l5.24-5.24c.98-.98 2.69-.98 3.67 0l1.04 1.04c.23.23.62.23.85 0L22 5.38V5c0-1.65-1.35-3-3-3h-9C8.35 2 7 3.35 7 5v6Zm15 0V8.21l-2.02 2.02c-.98.98-2.69.98-3.67 0l-1.04-1.04a.61.61 0 0 0-.85 0l-4.79 4.79c.12.02.24.02.37.02h9c1.65 0 3-1.35 3-3Zm-3.91 7.04c-.53-.15-1.08.17-1.23.7l-.29 1.06c-.21.77-.71 1.42-1.41 1.81-.7.4-1.51.5-2.28.29L4.2 19.52a3 3 0 0 1-2.1-3.69l.96-3.56c.14-.53-.17-1.08-.7-1.23-.53-.14-1.08.17-1.23.7l-.95 3.55a5.01 5.01 0 0 0 3.5 6.15l8.68 2.38c.44.12.89.18 1.33.18.86 0 1.7-.22 2.47-.66a4.984 4.984 0 0 0 2.35-3.02l.29-1.06c.15-.53-.17-1.08-.7-1.23Z" fill="#ffffff" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        {{ __('message.watchGallery') }}
                    </div>

                    @else

                    <div class="watch_gallery_btns NoGallery">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M9 5.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5S11.33 7 10.5 7 9 6.33 9 5.5ZM24 5v6c0 2.76-2.24 5-5 5h-9c-2.76 0-5-2.24-5-5V5c0-2.76 2.24-5 5-5h9c2.76 0 5 2.24 5 5ZM7 11c0 .77.29 1.47.77 2.01l5.24-5.24c.98-.98 2.69-.98 3.67 0l1.04 1.04c.23.23.62.23.85 0L22 5.38V5c0-1.65-1.35-3-3-3h-9C8.35 2 7 3.35 7 5v6Zm15 0V8.21l-2.02 2.02c-.98.98-2.69.98-3.67 0l-1.04-1.04a.61.61 0 0 0-.85 0l-4.79 4.79c.12.02.24.02.37.02h9c1.65 0 3-1.35 3-3Zm-3.91 7.04c-.53-.15-1.08.17-1.23.7l-.29 1.06c-.21.77-.71 1.42-1.41 1.81-.7.4-1.51.5-2.28.29L4.2 19.52a3 3 0 0 1-2.1-3.69l.96-3.56c.14-.53-.17-1.08-.7-1.23-.53-.14-1.08.17-1.23.7l-.95 3.55a5.01 5.01 0 0 0 3.5 6.15l8.68 2.38c.44.12.89.18 1.33.18.86 0 1.7-.22 2.47-.66a4.984 4.984 0 0 0 2.35-3.02l.29-1.06c.15-.53-.17-1.08-.7-1.23Z" fill="#ffffff" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        {{ __('message.NowatchGallery') }}
                    </div>

                    @endif

                    <div class="left_options_header">

                        @if(auth()->check())

                        @if(App\Models\Like::checkLike($job->id))

                        <div class="like_num liked" data-id="{{ $job->id }}">
                            <svg class="ml-1 -mt-0.5" width="13" height="11" viewBox="0 0 13 11" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.95035 1.229C4.81955 1.229 5.61243 1.66166 6.21284 2.15457C6.81326 1.66166 7.60614 1.229 8.47534 1.229C10.3497 1.229 11.8691 2.62275 11.8691 4.34192C11.8691 7.80824 7.92382 9.82702 6.62321 10.3984C6.36123 10.5134 6.06445 10.5134 5.80248 10.3984C4.50187 9.827 0.556602 7.80816 0.556602 4.34184C0.556602 2.62267 2.07603 1.229 3.95035 1.229Z" stroke-width="0.8"></path>
                            </svg>
                            {{ $job->likes()->get()->count() }}
                        </div>

                        @else

                        <div class="like_num" data-id="{{ $job->id }}">
                            <svg class="ml-1 -mt-0.5" width="13" height="11" viewBox="0 0 13 11" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.95035 1.229C4.81955 1.229 5.61243 1.66166 6.21284 2.15457C6.81326 1.66166 7.60614 1.229 8.47534 1.229C10.3497 1.229 11.8691 2.62275 11.8691 4.34192C11.8691 7.80824 7.92382 9.82702 6.62321 10.3984C6.36123 10.5134 6.06445 10.5134 5.80248 10.3984C4.50187 9.827 0.556602 7.80816 0.556602 4.34184C0.556602 2.62267 2.07603 1.229 3.95035 1.229Z" stroke-width="0.8"></path>
                            </svg>
                            {{ $job->likes()->get()->count() }}
                        </div>

                        @endif

                        @else

                        <div class="like_num" data-id="{{ $job->id }}">
                            <svg class="ml-1 -mt-0.5" width="13" height="11" viewBox="0 0 13 11" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.95035 1.229C4.81955 1.229 5.61243 1.66166 6.21284 2.15457C6.81326 1.66166 7.60614 1.229 8.47534 1.229C10.3497 1.229 11.8691 2.62275 11.8691 4.34192C11.8691 7.80824 7.92382 9.82702 6.62321 10.3984C6.36123 10.5134 6.06445 10.5134 5.80248 10.3984C4.50187 9.827 0.556602 7.80816 0.556602 4.34184C0.556602 2.62267 2.07603 1.229 3.95035 1.229Z" stroke-width="0.8"></path>
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
                </div>
            </div>
            <div class="header_left">
                <img src="/{{ $job->banner }}" alt="">
            </div>
        </div>
        <div class="header_bottom">
            <div class="right">
                <p class="linksAll"> {{ __('message.contacts_Job') }} </p>

                @if($job->instagram != '-')

                <div class="socialMediasBoxs description_btn" data-to-copy='{{ $job->instagram }}'>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M12 2.162c3.204 0 3.584.012 4.849.07 1.308.06 2.655.358 3.608 1.311.962.962 1.251 2.296 1.311 3.608.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.059 1.301-.364 2.661-1.311 3.608-.962.962-2.295 1.251-3.608 1.311-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.291-.059-2.669-.371-3.608-1.311-.957-.957-1.251-2.304-1.311-3.608-.058-1.265-.07-1.645-.07-4.849s.012-3.584.07-4.849c.059-1.296.367-2.664 1.311-3.608.96-.96 2.299-1.251 3.608-1.311 1.265-.058 1.645-.07 4.849-.07M12 0C8.741 0 8.332.014 7.052.072 5.197.157 3.355.673 2.014 2.014.668 3.36.157 5.198.072 7.052.014 8.332 0 8.741 0 12c0 3.259.014 3.668.072 4.948.085 1.853.603 3.7 1.942 5.038 1.345 1.345 3.186 1.857 5.038 1.942C8.332 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 1.854-.085 3.698-.602 5.038-1.942 1.347-1.347 1.857-3.184 1.942-5.038.058-1.28.072-1.689.072-4.948 0-3.259-.014-3.668-.072-4.948-.085-1.855-.602-3.698-1.942-5.038C20.643.671 18.797.156 16.948.072 15.668.014 15.259 0 12 0z" data-original="#000000" class=""></path>
                            <path d="M12 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8z" data-original="#000000" class=""></path>
                            <circle cx="18.406" cy="5.594" r="1.44" data-original="#000000" class=""></circle>
                        </g>
                    </svg>
                    <div class="title_sec_hover">
                        {{ $job->instagram }}
                    </div>
                </div>

                @endif


                @if($job->telegram != '-')

                <div class="socialMediasBoxs description_btn" data-to-copy='{{ $job->telegram }}'>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M23.119.882a2.966 2.966 0 0 0-2.8-.8l-16 3.37a4.995 4.995 0 0 0-2.853 8.481l1.718 1.717a1 1 0 0 1 .293.708v3.168a2.965 2.965 0 0 0 .3 1.285l-.008.007.026.026A3 3 0 0 0 5.157 20.2l.026.026.007-.008a2.965 2.965 0 0 0 1.285.3h3.168a1 1 0 0 1 .707.292l1.717 1.717A4.963 4.963 0 0 0 15.587 24a5.049 5.049 0 0 0 1.605-.264 4.933 4.933 0 0 0 3.344-3.986l3.375-16.035a2.975 2.975 0 0 0-.792-2.833ZM4.6 12.238l-1.719-1.717a2.94 2.94 0 0 1-.722-3.074 2.978 2.978 0 0 1 2.5-2.026L20.5 2.086 5.475 17.113v-2.755a2.978 2.978 0 0 0-.875-2.12Zm13.971 7.17a3 3 0 0 1-5.089 1.712l-1.72-1.72a2.978 2.978 0 0 0-2.119-.878H6.888L21.915 3.5Z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                    <div class="title_sec_hover">
                        {{ $job->telegram }}
                    </div>
                </div>

                @endif

                @if($job->email != '-')

                <div class="socialMediasBoxs description_btn" data-to-copy='{{ $job->email }}'>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M19 1H5a5.006 5.006 0 0 0-5 5v12a5.006 5.006 0 0 0 5 5h14a5.006 5.006 0 0 0 5-5V6a5.006 5.006 0 0 0-5-5ZM5 3h14a3 3 0 0 1 2.78 1.887l-7.658 7.659a3.007 3.007 0 0 1-4.244 0L2.22 4.887A3 3 0 0 1 5 3Zm14 18H5a3 3 0 0 1-3-3V7.5l6.464 6.46a5.007 5.007 0 0 0 7.072 0L22 7.5V18a3 3 0 0 1-3 3Z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                    <div class="title_sec_hover">
                        {{ $job->email }}
                    </div>
                </div>

                @endif

                @if($job->website_url != '-')

                <div class="socialMediasBoxs description_btn">
                    <a href="{{ $job->website_url }}">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M12 0a12 12 0 1 0 12 12A12.013 12.013 0 0 0 12 0Zm8.647 7h-3.221a19.676 19.676 0 0 0-2.821-4.644A10.031 10.031 0 0 1 20.647 7ZM16.5 12a10.211 10.211 0 0 1-.476 3H7.976a10.211 10.211 0 0 1-.476-3 10.211 10.211 0 0 1 .476-3h8.048a10.211 10.211 0 0 1 .476 3Zm-7.722 5h6.444A19.614 19.614 0 0 1 12 21.588 19.57 19.57 0 0 1 8.778 17Zm0-10A19.614 19.614 0 0 1 12 2.412 19.57 19.57 0 0 1 15.222 7ZM9.4 2.356A19.676 19.676 0 0 0 6.574 7H3.353A10.031 10.031 0 0 1 9.4 2.356ZM2.461 9H5.9a12.016 12.016 0 0 0-.4 3 12.016 12.016 0 0 0 .4 3H2.461a9.992 9.992 0 0 1 0-6Zm.892 8h3.221A19.676 19.676 0 0 0 9.4 21.644 10.031 10.031 0 0 1 3.353 17Zm11.252 4.644A19.676 19.676 0 0 0 17.426 17h3.221a10.031 10.031 0 0 1-6.042 4.644ZM21.539 15H18.1a12.016 12.016 0 0 0 .4-3 12.016 12.016 0 0 0-.4-3h3.437a9.992 9.992 0 0 1 0 6Z" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <div class="title_sec_hover">
                            {{ $job->website_url }}
                        </div>
                    </a>
                </div>

                @endif

                <div class="socialMediasBoxs description_btn" data-to-copy='{{ $job->phoneNumber }}'>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M13 1a1 1 0 0 1 1-1 10.011 10.011 0 0 1 10 10 1 1 0 0 1-2 0 8.009 8.009 0 0 0-8-8 1 1 0 0 1-1-1Zm1 5a4 4 0 0 1 4 4 1 1 0 0 0 2 0 6.006 6.006 0 0 0-6-6 1 1 0 0 0 0 2Zm9.093 10.739a3.1 3.1 0 0 1 0 4.378l-.91 1.049c-8.19 7.841-28.12-12.084-20.4-20.3l1.15-1a3.081 3.081 0 0 1 4.327.04c.031.031 1.884 2.438 1.884 2.438a3.1 3.1 0 0 1-.007 4.282L7.979 9.082a12.781 12.781 0 0 0 6.931 6.945l1.465-1.165a3.1 3.1 0 0 1 4.281-.006s2.406 1.852 2.437 1.883Zm-1.376 1.454s-2.393-1.841-2.424-1.872a1.1 1.1 0 0 0-1.549 0c-.027.028-2.044 1.635-2.044 1.635a1 1 0 0 1-.979.152A15.009 15.009 0 0 1 5.9 9.3a1 1 0 0 1 .145-1s1.607-2.018 1.634-2.044a1.1 1.1 0 0 0 0-1.549c-.031-.03-1.872-2.425-1.872-2.425a1.1 1.1 0 0 0-1.51.039l-1.15 1C-2.495 10.105 14.776 26.418 20.721 20.8l.911-1.05a1.121 1.121 0 0 0 .085-1.557Z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                    <div class="title_sec_hover" style="direction: ltr;">
                        {{ $job->phoneNumber }}
                    </div>
                </div>
            </div>
            <div class="socialMediasBoxs link_us_btn" data-to-copy="{{ url()->full() }}">
                <span>{{ url()->full() }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <path d="M21.155 3.272 18.871.913A3.02 3.02 0 0 0 16.715 0H12a5.009 5.009 0 0 0-4.9 4H7a5.006 5.006 0 0 0-5 5v10a5.006 5.006 0 0 0 5 5h6a5.006 5.006 0 0 0 5-5v-.1a5.009 5.009 0 0 0 4-4.9V5.36a2.988 2.988 0 0 0-.845-2.088ZM13 22H7a3 3 0 0 1-3-3V9a3 3 0 0 1 3-3v8a5.006 5.006 0 0 0 5 5h4a3 3 0 0 1-3 3Zm4-5h-5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3h4v2a2 2 0 0 0 2 2h2v8a3 3 0 0 1-3 3Z" data-original="#000000" class=""></path>
                    </g>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="container_job">
    <div class="section_job">
        <div class="right_all">
            <div class="section_right">
                <div class="top_all">
                    <p class="title"> {{ __('message.time_job_title') }} </p>
                    <div class="time_line_all">
                        <div class="time_line">
                            @if($job->saturday_time_work != '-')

                            <div class="days_box">
                                <span class="day_title"> {{ __('message.saturday') }} </span>
                                <span class="time"> {{ $job->saturday_time_work }} </span>
                            </div>

                            @else

                            <div class="days_box job_close">
                                <span class="day_title"> {{ __('message.saturday') }} </span>
                                <span class="time"> {{ __('message.job_close') }} </span>
                            </div>

                            @endif

                            @if($job->sunday_time_work != '-')

                            <div class="days_box">
                                <span class="day_title"> {{ __('message.sunday') }} </span>
                                <span class="time"> {{ $job->sunday_time_work }} </span>
                            </div>

                            @else

                            <div class="days_box job_close">
                                <span class="day_title"> {{ __('message.sunday') }} </span>
                                <span class="time"> {{ __('message.job_close') }} </span>
                            </div>

                            @endif

                            @if($job->monday_time_work != '-')

                            <div class="days_box">
                                <span class="day_title"> {{ __('message.monday') }} </span>
                                <span class="time"> {{ $job->monday_time_work }} </span>
                            </div>

                            @else

                            <div class="days_box job_close">
                                <span class="day_title"> {{ __('message.monday') }} </span>
                                <span class="time"> {{ __('message.job_close') }} </span>
                            </div>

                            @endif

                            @if($job->tusday_time_work != '-')

                            <div class="days_box">
                                <span class="day_title"> {{ __('message.tusday') }} </span>
                                <span class="time"> {{ $job->tusday_time_work }} </span>
                            </div>

                            @else

                            <div class="days_box job_close">
                                <span class="day_title"> {{ __('message.tusday') }} </span>
                                <span class="time"> {{ __('message.job_close') }} </span>
                            </div>

                            @endif

                            @if($job->wednesday_time_work != '-')

                            <div class="days_box">
                                <span class="day_title"> {{ __('message.wednesday') }} </span>
                                <span class="time"> {{ $job->wednesday_time_work }} </span>
                            </div>

                            @else

                            <div class="days_box job_close">
                                <span class="day_title"> {{ __('message.wednesday') }} </span>
                                <span class="time"> {{ __('message.job_close') }} </span>
                            </div>

                            @endif

                            @if($job->thursday_time_work != '-')

                            <div class="days_box">
                                <span class="day_title"> {{ __('message.thursday') }} </span>
                                <span class="time"> {{ $job->thursday_time_work }} </span>
                            </div>

                            @else

                            <div class="days_box job_close">
                                <span class="day_title"> {{ __('message.thursday') }} </span>
                                <span class="time"> {{ __('message.job_close') }} </span>
                            </div>

                            @endif

                            @if($job->friday_time_work != '-')

                            <div class="days_box">
                                <span class="day_title"> {{ __('message.friday') }} </span>
                                <span class="time"> {{ $job->friday_time_work }} </span>
                            </div>

                            @else

                            <div class="days_box job_close">
                                <span class="day_title"> {{ __('message.friday') }} </span>
                                <span class="time"> {{ __('message.job_close') }} </span>
                            </div>

                            @endif

                        </div>
                    </div>

                </div>
                <div class="Map_Job">
                    <iframe src="https://maps.google.com/maps?q={{ $job->latitude }},{{ $job->longitude }}&hl=es;z=14&amp;output=embed"></iframe>
                </div>
                <div class="Address_section">
                    <p class="title_address"> {{ __('message.address_title') }} </p>
                    <p class="address"> {{ $job->{'address_' . session('lang')} }} </p>
                </div>
            </div>
            <div class="CommentsAllSection">
                <div class="top">
                    <p class="title"> {{ __('message.UserCommentsTitle') }} </p>
                </div>
                <div class="middle">

                    @if($comments->count() != 0)

                    @foreach($comments as $comment)

                    <div class="Comment">
                        <div class="top_comment">
                            <div class="right">
                                <img src="/{{ $comment->user()->first()->profile }}" alt="">
                                <div class="user_infos">
                                    <span> {{ $comment->user()->first()->name . ' ' . $comment->user()->first()->family }} </span>
                                    <span class="user_ati">
                                        @if($comment->user()->first()->phoneNumber == $job->phoneNumber)

                                        {{ __('message.job_owner') }}

                                        @else

                                        {{ __('message.atibank_user') }}

                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="left">

                                <div class="right_inside">
                                    @if(auth()->check() || session()->has('admin'))

                                    @if(auth()->check())

                                    @if($comment->user_id != auth()->user()->id)

                                    <div class="More_options_comment">
                                        <ion-icon name="ellipsis-vertical"></ion-icon>
                                        <div class="drp_options">
                                            <div class="answer_btn" data-receiver="{{ $comment->user_id }}" data-comment_id="{{ $comment->id }}" data-type_receiver="user">
                                                {{ __('message.AnswerText') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="more_options_comment_shadow"></div>


                                    @endif

                                    @else

                                    <div class="More_options_comment">
                                        <ion-icon name="ellipsis-vertical"></ion-icon>
                                        <div class="drp_options">
                                            <div class="answer_btn" data-receiver="{{ $comment->user_id }}" data-comment_id="{{ $comment->id }}" data-type_receiver="user">
                                                {{ __('message.AnswerText') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="more_options_comment_shadow"></div>

                                    @endif

                                    @endif
                                </div>

                                <div class="left_inside">
                                    <div class="like_btns like" data-comment='{{ $comment->id }}' data-type='comment'>
                                        <div class="texts">
                                            @if(auth()->check())

                                            @if(auth()->user()->hasLikedComment($comment->id,'comment'))

                                            <svg class="liked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path d="M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L8 5.417V21h10.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a4.994 4.994 0 0 0-1.183-3.979ZM0 11v5a5.006 5.006 0 0 0 5 5h1V6H5a5.006 5.006 0 0 0-5 5Z" data-original="#000000" class=""></path>
                                                </g>
                                            </svg>

                                            @else

                                            <svg class="unliked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24">
                                                <g>
                                                    <path d="M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L7.712 6H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h13.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a5 5 0 0 0-1.183-3.979ZM2 16v-5a3 3 0 0 1 3-3h2v11H5a3 3 0 0 1-3-3Zm19.971-4.581-.706 5A3.012 3.012 0 0 1 18.3 19H9V7.734a1 1 0 0 0 .23-.292l2.189-4.435a1.07 1.07 0 0 1 1.722-.207 1.024 1.024 0 0 1 .233.84l-.528 3.2A1 1 0 0 0 13.833 8H19a3 3 0 0 1 2.971 3.419Z"></path>
                                                </g>
                                            </svg>

                                            @endif

                                            @elseif(session()->has('admin'))

                                            @if(App\Models\Admin::hasLikedComment($comment->id,'comment'))

                                            <svg class="liked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path d="M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L8 5.417V21h10.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a4.994 4.994 0 0 0-1.183-3.979ZM0 11v5a5.006 5.006 0 0 0 5 5h1V6H5a5.006 5.006 0 0 0-5 5Z" data-original="#000000" class=""></path>
                                                </g>
                                            </svg>

                                            @else

                                            <svg class="unliked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24">
                                                <g>
                                                    <path d="M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L7.712 6H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h13.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a5 5 0 0 0-1.183-3.979ZM2 16v-5a3 3 0 0 1 3-3h2v11H5a3 3 0 0 1-3-3Zm19.971-4.581-.706 5A3.012 3.012 0 0 1 18.3 19H9V7.734a1 1 0 0 0 .23-.292l2.189-4.435a1.07 1.07 0 0 1 1.722-.207 1.024 1.024 0 0 1 .233.84l-.528 3.2A1 1 0 0 0 13.833 8H19a3 3 0 0 1 2.971 3.419Z"></path>
                                                </g>
                                            </svg>

                                            @endif

                                            @else

                                            <svg class="unliked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24">
                                                <g>
                                                    <path d="M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L7.712 6H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h13.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a5 5 0 0 0-1.183-3.979ZM2 16v-5a3 3 0 0 1 3-3h2v11H5a3 3 0 0 1-3-3Zm19.971-4.581-.706 5A3.012 3.012 0 0 1 18.3 19H9V7.734a1 1 0 0 0 .23-.292l2.189-4.435a1.07 1.07 0 0 1 1.722-.207 1.024 1.024 0 0 1 .233.84l-.528 3.2A1 1 0 0 0 13.833 8H19a3 3 0 0 1 2.971 3.419Z"></path>
                                                </g>
                                            </svg>

                                            @endif


                                            <span class="number"> {{ $comment->likesNum() }} </span>
                                        </div>
                                        <div class="spinner_loader_liked"></div>
                                    </div>
                                    <div class="like_btns unlike" data-comment='{{ $comment->id }}' data-type='comment'>
                                        <div class="texts">

                                            @if(auth()->check())

                                            @if(auth()->user()->hasUnLikedComment($comment->id,'comment'))

                                            <svg class="liked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path d="m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H8v15.584l1.626 3.3a3.038 3.038 0 0 0 5.721-1.838L15.011 18H19a5 5 0 0 0 4.951-5.7ZM0 8v5a5.006 5.006 0 0 0 5 5h1V3H5a5.006 5.006 0 0 0-5 5Z" data-original="#000000" class=""></path>
                                                </g>
                                            </svg>

                                            @else

                                            <svg class="unliked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path d="m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h2.712l1.914 3.878a3.037 3.037 0 0 0 5.721-1.837L15.011 18H19a5 5 0 0 0 4.951-5.7ZM5 5h2v11H5a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3Zm16.264 9.968A3 3 0 0 1 19 16h-5.167a1 1 0 0 0-.987 1.162l.528 3.2a1.024 1.024 0 0 1-.233.84 1.07 1.07 0 0 1-1.722-.212L9.23 16.558a1 1 0 0 0-.23-.292V5h9.3a3.012 3.012 0 0 1 2.97 2.581l.706 5a3 3 0 0 1-.712 2.387Z" data-original="#000000" class=""></path>
                                                </g>
                                            </svg>

                                            @endif

                                            @elseif(session()->has("admin"))

                                            @if(App\Models\Admin::hasUnLikedComment($comment->id,'comment'))

                                            <svg class="liked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path d="m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H8v15.584l1.626 3.3a3.038 3.038 0 0 0 5.721-1.838L15.011 18H19a5 5 0 0 0 4.951-5.7ZM0 8v5a5.006 5.006 0 0 0 5 5h1V3H5a5.006 5.006 0 0 0-5 5Z" data-original="#000000" class=""></path>
                                                </g>
                                            </svg>

                                            @else

                                            <svg class="unliked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path d="m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h2.712l1.914 3.878a3.037 3.037 0 0 0 5.721-1.837L15.011 18H19a5 5 0 0 0 4.951-5.7ZM5 5h2v11H5a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3Zm16.264 9.968A3 3 0 0 1 19 16h-5.167a1 1 0 0 0-.987 1.162l.528 3.2a1.024 1.024 0 0 1-.233.84 1.07 1.07 0 0 1-1.722-.212L9.23 16.558a1 1 0 0 0-.23-.292V5h9.3a3.012 3.012 0 0 1 2.97 2.581l.706 5a3 3 0 0 1-.712 2.387Z" data-original="#000000" class=""></path>
                                                </g>
                                            </svg>

                                            @endif

                                            @else

                                            <svg class="unliked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path d="m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h2.712l1.914 3.878a3.037 3.037 0 0 0 5.721-1.837L15.011 18H19a5 5 0 0 0 4.951-5.7ZM5 5h2v11H5a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3Zm16.264 9.968A3 3 0 0 1 19 16h-5.167a1 1 0 0 0-.987 1.162l.528 3.2a1.024 1.024 0 0 1-.233.84 1.07 1.07 0 0 1-1.722-.212L9.23 16.558a1 1 0 0 0-.23-.292V5h9.3a3.012 3.012 0 0 1 2.97 2.581l.706 5a3 3 0 0 1-.712 2.387Z" data-original="#000000" class=""></path>
                                                </g>
                                            </svg>

                                            @endif


                                            <span> {{ $comment->unlikesNum() }} </span>
                                        </div>
                                        <div class="spinner_loader_liked"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <p class="commentText"> {!! $comment->comment_text !!} </p>
                    </div>
                    @if($comment->answers()->where("status" , 'تایید شده')->get()->count() != 0)

                    <div class="AnswerAll_con">

                        @foreach($comment->answers()->where("status" , 'تایید شده')->get() as $answer)

                        <div class="Comment AnswerComment">
                            <div class="circle"></div>
                            <div class="top_comment">
                                <div class="right">
                                    @if($answer->type_sender == 'user')

                                    <img src="/{{ $answer->user_sender()->first()->profile }}" alt="">

                                    @elseif($answer->type_sender == 'admin')
                                    <img src="/Tools/Images/Website_images/user.svg" alt="">

                                    @endif
                                    <div class="user_infos">
                                        @if($answer->type_sender == 'user' && $answer->type_receiver == 'admin')

                                        <span>{{ $answer->user_sender()->first()->name . ' ' . $answer->user_sender()->first()->family }} </span>
                                        <span class="user_ati">

                                            @if($answer->user_sender()->first()->phoneNumber == $job->phoneNumber)
                                            {{ __('message.job_owner') }}
                                            @else

                                            {{ __('message.atibank_user') }}
                                            @endif

                                        </span>

                                        @elseif($answer->type_sender == 'admin' && $answer->type_receiver == 'user')

                                        <span>{{ App\Models\Admin::where("id" , $answer->user_id_sender)->first()->name . ' ' . App\Models\Admin::where("id" , $answer->user_id_sender)->first()->family }} </span>
                                        <span class="user_ati"> {{ __('message.atibank_admin') }} </span>

                                        @else

                                        <span>{{ $answer->user_sender()->first()->name . ' ' . $answer->user_sender()->first()->family }} </span>
                                        <span class="user_ati">
                                            @if($answer->user_sender()->first()->phoneNumber == $job->phoneNumber)
                                            {{ __('message.job_owner') }}
                                            @else

                                            {{ __('message.atibank_user') }}
                                            @endif
                                        </span>

                                        @endif


                                    </div>
                                </div>
                                <div class="left">

                                    <div class="right_inside">
                                        @if(auth()->check() || session()->has('admin'))

                                        @if(auth()->check())

                                        @if($answer->type_sender != "admin")

                                        @if($answer->user_id_sender != auth()->user()->id)

                                        <div class="More_options_comment">
                                            <ion-icon name="ellipsis-vertical"></ion-icon>
                                            <div class="drp_options">
                                                <div class="answer_btn" data-receiver="{{ $answer->user_id_sender }}" data-comment_id="{{ $answer->comment_id }}" data-type_receiver="{{ $answer->type_sender }}">
                                                    {{ __('message.AnswerText') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="more_options_comment_shadow"></div>


                                        @endif

                                        @else

                                        <div class="More_options_comment">
                                            <ion-icon name="ellipsis-vertical"></ion-icon>
                                            <div class="drp_options">
                                                <div class="answer_btn" data-receiver="{{ $answer->user_id_sender }}" data-comment_id="{{ $answer->comment_id }}" data-type_receiver="{{ $answer->type_sender }}">
                                                    {{ __('message.AnswerText') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="more_options_comment_shadow"></div>

                                        @endif

                                        @elseif(session()->has('admin'))

                                        @if($answer->type_sender != "user")

                                        @if($answer->user_id_sender != session('admin'))


                                        <div class="More_options_comment">
                                            <ion-icon name="ellipsis-vertical"></ion-icon>
                                            <div class="drp_options">
                                                <div class="answer_btn" data-receiver="{{ $answer->user_id_sender }}" data-comment_id="{{ $answer->comment_id }}" data-type_receiver="{{ $answer->type_sender }}">
                                                    {{ __('message.AnswerText') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="more_options_comment_shadow"></div>

                                        @endif

                                        @else

                                        <div class="More_options_comment">
                                            <ion-icon name="ellipsis-vertical"></ion-icon>
                                            <div class="drp_options">
                                                <div class="answer_btn" data-receiver="{{ $answer->user_id_sender }}" data-comment_id="{{ $answer->comment_id }}" data-type_receiver="{{ $answer->type_sender }}">
                                                    {{ __('message.AnswerText') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="more_options_comment_shadow"></div>

                                        @endif

                                        @endif

                                        @endif
                                    </div>


                                    <div class="left_inside">
                                        <div class="like_btns like" data-comment='{{ $answer->id }}' data-type='answer'>
                                            <div class="texts">
                                                @if(auth()->check())

                                                @if(auth()->user()->hasLikedComment($answer->id,'answer'))

                                                <svg class="liked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                    <g>
                                                        <path d="M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L8 5.417V21h10.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a4.994 4.994 0 0 0-1.183-3.979ZM0 11v5a5.006 5.006 0 0 0 5 5h1V6H5a5.006 5.006 0 0 0-5 5Z" data-original="#000000" class=""></path>
                                                    </g>
                                                </svg>

                                                @else

                                                <svg class="unliked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24">
                                                    <g>
                                                        <path d="M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L7.712 6H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h13.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a5 5 0 0 0-1.183-3.979ZM2 16v-5a3 3 0 0 1 3-3h2v11H5a3 3 0 0 1-3-3Zm19.971-4.581-.706 5A3.012 3.012 0 0 1 18.3 19H9V7.734a1 1 0 0 0 .23-.292l2.189-4.435a1.07 1.07 0 0 1 1.722-.207 1.024 1.024 0 0 1 .233.84l-.528 3.2A1 1 0 0 0 13.833 8H19a3 3 0 0 1 2.971 3.419Z"></path>
                                                    </g>
                                                </svg>

                                                @endif

                                                @elseif(session()->has('admin'))

                                                @if(App\Models\Admin::hasLikedComment($answer->id,'answer'))

                                                <svg class="liked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                    <g>
                                                        <path d="M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L8 5.417V21h10.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a4.994 4.994 0 0 0-1.183-3.979ZM0 11v5a5.006 5.006 0 0 0 5 5h1V6H5a5.006 5.006 0 0 0-5 5Z" data-original="#000000" class=""></path>
                                                    </g>
                                                </svg>

                                                @else

                                                <svg class="unliked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24">
                                                    <g>
                                                        <path d="M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L7.712 6H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h13.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a5 5 0 0 0-1.183-3.979ZM2 16v-5a3 3 0 0 1 3-3h2v11H5a3 3 0 0 1-3-3Zm19.971-4.581-.706 5A3.012 3.012 0 0 1 18.3 19H9V7.734a1 1 0 0 0 .23-.292l2.189-4.435a1.07 1.07 0 0 1 1.722-.207 1.024 1.024 0 0 1 .233.84l-.528 3.2A1 1 0 0 0 13.833 8H19a3 3 0 0 1 2.971 3.419Z"></path>
                                                    </g>
                                                </svg>

                                                @endif

                                                @else

                                                <svg class="unliked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24">
                                                    <g>
                                                        <path d="M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L7.712 6H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h13.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a5 5 0 0 0-1.183-3.979ZM2 16v-5a3 3 0 0 1 3-3h2v11H5a3 3 0 0 1-3-3Zm19.971-4.581-.706 5A3.012 3.012 0 0 1 18.3 19H9V7.734a1 1 0 0 0 .23-.292l2.189-4.435a1.07 1.07 0 0 1 1.722-.207 1.024 1.024 0 0 1 .233.84l-.528 3.2A1 1 0 0 0 13.833 8H19a3 3 0 0 1 2.971 3.419Z"></path>
                                                    </g>
                                                </svg>

                                                @endif


                                                <span class="number"> {{ $answer->likesNum() }} </span>
                                            </div>
                                            <div class="spinner_loader_liked"></div>
                                        </div>
                                        <div class="like_btns unlike" data-comment='{{ $answer->id }}' data-type='answer'>
                                            <div class="texts">

                                                @if(auth()->check())

                                                @if(auth()->user()->hasUnLikedComment($answer->id,'answer'))

                                                <svg class="liked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                    <g>
                                                        <path d="m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H8v15.584l1.626 3.3a3.038 3.038 0 0 0 5.721-1.838L15.011 18H19a5 5 0 0 0 4.951-5.7ZM0 8v5a5.006 5.006 0 0 0 5 5h1V3H5a5.006 5.006 0 0 0-5 5Z" data-original="#000000" class=""></path>
                                                    </g>
                                                </svg>

                                                @else

                                                <svg class="unliked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                    <g>
                                                        <path d="m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h2.712l1.914 3.878a3.037 3.037 0 0 0 5.721-1.837L15.011 18H19a5 5 0 0 0 4.951-5.7ZM5 5h2v11H5a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3Zm16.264 9.968A3 3 0 0 1 19 16h-5.167a1 1 0 0 0-.987 1.162l.528 3.2a1.024 1.024 0 0 1-.233.84 1.07 1.07 0 0 1-1.722-.212L9.23 16.558a1 1 0 0 0-.23-.292V5h9.3a3.012 3.012 0 0 1 2.97 2.581l.706 5a3 3 0 0 1-.712 2.387Z" data-original="#000000" class=""></path>
                                                    </g>
                                                </svg>

                                                @endif

                                                @elseif(session()->has("admin"))

                                                @if(App\Models\Admin::hasUnLikedComment($answer->id,'answer'))

                                                <svg class="liked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                    <g>
                                                        <path d="m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H8v15.584l1.626 3.3a3.038 3.038 0 0 0 5.721-1.838L15.011 18H19a5 5 0 0 0 4.951-5.7ZM0 8v5a5.006 5.006 0 0 0 5 5h1V3H5a5.006 5.006 0 0 0-5 5Z" data-original="#000000" class=""></path>
                                                    </g>
                                                </svg>

                                                @else

                                                <svg class="unliked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                    <g>
                                                        <path d="m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h2.712l1.914 3.878a3.037 3.037 0 0 0 5.721-1.837L15.011 18H19a5 5 0 0 0 4.951-5.7ZM5 5h2v11H5a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3Zm16.264 9.968A3 3 0 0 1 19 16h-5.167a1 1 0 0 0-.987 1.162l.528 3.2a1.024 1.024 0 0 1-.233.84 1.07 1.07 0 0 1-1.722-.212L9.23 16.558a1 1 0 0 0-.23-.292V5h9.3a3.012 3.012 0 0 1 2.97 2.581l.706 5a3 3 0 0 1-.712 2.387Z" data-original="#000000" class=""></path>
                                                    </g>
                                                </svg>

                                                @endif

                                                @else

                                                <svg class="unliked_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                    <g>
                                                        <path d="m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h2.712l1.914 3.878a3.037 3.037 0 0 0 5.721-1.837L15.011 18H19a5 5 0 0 0 4.951-5.7ZM5 5h2v11H5a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3Zm16.264 9.968A3 3 0 0 1 19 16h-5.167a1 1 0 0 0-.987 1.162l.528 3.2a1.024 1.024 0 0 1-.233.84 1.07 1.07 0 0 1-1.722-.212L9.23 16.558a1 1 0 0 0-.23-.292V5h9.3a3.012 3.012 0 0 1 2.97 2.581l.706 5a3 3 0 0 1-.712 2.387Z" data-original="#000000" class=""></path>
                                                    </g>
                                                </svg>

                                                @endif


                                                <span> {{ $answer->unlikesNum() }} </span>
                                            </div>
                                            <div class="spinner_loader_liked"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <p class="commentText"> {!! $answer->answer_text !!} </p>
                        </div>

                        @endforeach


                    </div>



                    @endif

                    @endforeach

                    @else

                    <div class="CommentsEmpty">
                        <svg viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M27 0C49.2345 0 54 4.00008 54 24C54 37.0001 51.7506 45 41.6256 45C36.2147 45 34.6052 47.5703 33.1064 49.9638C31.8006 52.0491 30.5789 54.0001 27.0006 54C23.4225 53.9999 22.2007 52.049 20.8949 49.9638C19.3961 47.5703 17.7865 45 12.3756 45C2.25055 45 0 36.7442 0 24C0 4.23601 4.7655 0 27 0ZM49.5 24C49.5 13.878 48.1565 9.89799 45.8623 7.87579C44.6944 6.84628 42.8722 5.95738 39.7488 5.35647C36.6026 4.75117 32.4778 4.5 27 4.5C21.5316 4.5 17.4124 4.76523 14.2732 5.38537C11.1583 6.00072 9.32897 6.90538 8.1517 7.95184C5.83648 10.0098 4.5 14.0158 4.5 24C4.5 30.3241 5.09867 34.632 6.41592 37.2668C7.01586 38.4668 7.70279 39.1862 8.47207 39.6441C9.25959 40.1128 10.4585 40.5 12.3756 40.5C15.6095 40.5 18.2372 41.232 20.3756 42.6808C22.433 44.0748 23.6339 45.8794 24.4009 47.0862L24.7092 47.5722C25.3722 48.6189 25.5918 48.9656 25.9024 49.2444L25.9146 49.256C25.9799 49.3197 26.1644 49.5 27.0007 49.5C27.8371 49.5 28.0216 49.3197 28.0867 49.2561L28.0989 49.2445C28.4096 48.9657 28.6291 48.6191 29.2923 47.572L29.6003 47.0864C30.3672 45.8797 31.5681 44.0749 33.6255 42.6809C35.7638 41.232 38.3916 40.5 41.6256 40.5C43.5662 40.5 44.7756 40.119 45.564 39.6594C46.3265 39.2148 47.0012 38.5197 47.5916 37.3489C48.8981 34.7581 49.5 30.4669 49.5 24Z" fill="#E0E3EA"></path>
                            <path d="M31.5 15.75C30.2573 15.75 29.25 16.7573 29.25 18C29.25 19.2427 30.2573 20.25 31.5 20.25H38.25C39.4927 20.25 40.5 19.2427 40.5 18C40.5 16.7573 39.4927 15.75 38.25 15.75H31.5Z" fill="#A2ACBF"></path>
                            <path d="M15.75 24.75C14.5073 24.75 13.5 25.7573 13.5 27C13.5 28.2427 14.5073 29.25 15.75 29.25H38.25C39.4927 29.25 40.5 28.2427 40.5 27C40.5 25.7573 39.4927 24.75 38.25 24.75H15.75Z" fill="#A2ACBF"></path>
                        </svg>
                        <span> {{ __('message.NoCommentYet') }} </span>
                    </div>

                    @endif


                    {{ $comments->onEachSide(1)->links() }}


                </div>
            </div>
            <?php

            $AllAds = App\Models\Advertising::where('expired_at', ">=", now())->where("payment_status", "پرداخت شده")->where("status", "تایید شده")->where("category_id", $job->subcategory()->first()->category()->first()->id)->orderBy("id", "DESC")->limit(6)->get();

            ?>

            @if($AllAds->count() > 0)

            <section class="adversting_container">
                <div class="adversting_con">
                    <div class="swiper adversting_swiper">
                        <div class="swiper-wrapper">
                            @foreach($AllAds as $ads)

                            <div class="swiper-slide">
                                <div class="adversting_sec" style="background-image: url(/<?= $ads->banner ?>);">
                                    <a href="{{ $ads->link }}" target="_blank">
                                        <div class="content_ads">
                                            <p class="title">{{ $ads->{'title_'.session("lang")} }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            @endforeach

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>

            @endif
        </div>
        <div class="left_all">
            <div class="left_all_boxes Rates">
                <div class="allRts">
                    <div class="circles"></div>
                    <?php

                    $Rate = new App\Models\Rate();

                    ?>
                    <p class="title">
                        {{ __('message.rateText' , ['rateNum' => $job->Rate , 'allRate' => $job->Rate_Num]) }}
                    </p>
                    <div class="StarsAll" data-job="{{ $job->id }}">

                        {!! $Rate->GetRateStars($job->Rate) !!}

                    </div>
                </div>
            </div>
            <div class="left_all_boxes OptionsBox">
                <div class="OptionsBoxs">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0Zm3.534 13.511-2.241 4.856a1.089 1.089 0 0 1-.989.633h-.213a1.09 1.09 0 0 1-1.09-1.09v-2.365c0-.349-.139-.684-.386-.931l-1.19-1.19A1.45 1.45 0 0 1 9 12.399v-.963c0-.279-.111-.547-.309-.745l-.373-.373A1.085 1.085 0 0 0 7.55 10H5.601a1.4 1.4 0 0 1-1.016-.436L2.927 7.821C4.514 4.391 7.979 2 12 2c.206 0 .407.019.609.031-.533.808-1.016 1.551-1.309 2.005a.886.886 0 0 0-.014.94l.837 1.396a.94.94 0 0 1-.141 1.147l-.003.003a.938.938 0 0 1-1.084.176l-.88-.44a.799.799 0 0 0-.921.149l-.529.529a.797.797 0 0 0 0 1.128l.592.592c.22.22.519.344.83.344h1.431c.381 0 .754.107 1.077.309l2.562 1.601c.539.337.744 1.023.477 1.601Zm3.99-1.251a1.266 1.266 0 0 1-.665-.827l-.627-2.507a1.266 1.266 0 0 1 .595-1.403l1.583-.913A9.928 9.928 0 0 1 22 12c0 .488-.047.963-.115 1.432l-2.362-1.172Z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                    <span class="title"> {{ __('message.sign_up_county') }} </span>
                    <span class="response"> {{ $job->city()->first()->state()->first()->country()->first()->{'country_name_' . session('lang')} }} </span>
                </div>
                <div class="OptionsBoxs">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M12 .042a9.992 9.992 0 0 0-9.981 9.98c0 2.57 1.99 6.592 5.915 11.954a5.034 5.034 0 0 0 8.132 0c3.925-5.362 5.915-9.384 5.915-11.954A9.992 9.992 0 0 0 12 .042ZM12 14a4 4 0 1 1 4-4 4 4 0 0 1-4 4Z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                    <span class="title"> {{ __('message.sign_up_state') }} </span>
                    <span class="response"> {{ $job->city()->first()->state()->first()->{'state_name_' . session('lang')} }} </span>
                </div>
                <div class="OptionsBoxs">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="m14.081 11.41-3-2.349a4.993 4.993 0 0 0-6.162 0l-3 2.348A4.97 4.97 0 0 0 0 15.347v4.152c0 2.481 2.019 4.5 4.5 4.5h7c2.481 0 4.5-2.019 4.5-4.5v-4.152a4.972 4.972 0 0 0-1.919-3.938ZM10 18a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2Zm9-18h-4c-2.757 0-5 2.243-5 5v1.306a6.972 6.972 0 0 1 2.312 1.179l3.002 2.351A6.958 6.958 0 0 1 18 15.348V18a1 1 0 0 1 1-1h1a1 1 0 1 1 0 2h-1a1 1 0 0 1-1-1v1.5a6.472 6.472 0 0 1-1.821 4.5H19c2.757 0 5-2.243 5-5V5c0-2.757-2.243-5-5-5Zm-4 7h-1a1 1 0 1 1 0-2h1a1 1 0 1 1 0 2Zm5 8h-1a1 1 0 1 1 0-2h1a1 1 0 1 1 0 2Zm0-4h-1a1 1 0 1 1 0-2h1a1 1 0 1 1 0 2Zm0-4h-1a1 1 0 1 1 0-2h1a1 1 0 1 1 0 2Z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                    <span class="title"> {{ __('message.sign_up_city') }} </span>
                    <span class="response"> {{ $job->city()->first()->{'city_name_' . session('lang')} }} </span>
                </div>
                <div class="OptionsBoxs">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M17 0H7C4.243 0 2 2.243 2 5v14c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V5c0-2.757-2.243-5-5-5Zm-7 19a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2Zm0-6a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2Zm0-6a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2Zm7 12h-4c-1.308-.006-1.307-1.994 0-2h4c1.308.006 1.307 1.994 0 2Zm0-6h-4c-1.308-.006-1.307-1.994 0-2h4c1.308.006 1.307 1.994 0 2Zm0-6h-4c-1.308-.006-1.307-1.994 0-2h4c1.308.006 1.307 1.994 0 2Z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                    <span class="title"> {{ __('message.main_categoy') }} </span>
                    <span class="response"> {{ $job->subcategory()->first()->category()->first()->{'category_name_' . session('lang')} }} </span>
                </div>
                <div class="OptionsBoxs">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M10 8V7H2v8c0 1.654 1.346 3 3 3h5v-2c0-1.654 1.346-3 3-3h2.586c.534 0 1.036.208 1.414.586L18.414 15H21c1.654 0 3 1.346 3 3v3c0 1.654-1.346 3-3 3h-8c-1.654 0-3-1.346-3-3v-1H5c-2.757 0-5-2.243-5-5V1C.006-.308 1.995-.307 2 1v4h8V3c0-1.654 1.346-3 3-3h2.586c.534 0 1.036.208 1.414.586L18.414 2H21c1.654 0 3 1.346 3 3v3c0 1.654-1.346 3-3 3h-8c-1.654 0-3-1.346-3-3Z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                    <span class="title"> {{ __('message.sub_categoy') }} </span>
                    <span class="response"> {{ $job->subcategory()->first()->{'subcategory_name_' . session('lang')} }} </span>
                </div>
                <div class="OptionsBoxs">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 512.19 512.19" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <circle cx="256.095" cy="256.095" r="85.333" data-original="#000000" class=""></circle>
                            <path d="M496.543 201.034C463.455 147.146 388.191 56.735 256.095 56.735S48.735 147.146 15.647 201.034c-20.862 33.743-20.862 76.379 0 110.123 33.088 53.888 108.352 144.299 240.448 144.299s207.36-90.411 240.448-144.299c20.862-33.744 20.862-76.38 0-110.123zM256.095 384.095c-70.692 0-128-57.308-128-128s57.308-128 128-128 128 57.308 128 128c-.071 70.663-57.337 127.929-128 128z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                    <span class="title"> {{ __('message.visit') }} </span>
                    <span class="response"> {{ $job->view }} </span>
                </div>
            </div>

            @if(auth()->check())

            @if(auth()->user()->phoneNumber != $job->phoneNumber)

            <div class="left_all_boxes sendTicket">
                <div class="top">
                    <div class="icon_bg">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M19.675 2.758A11.936 11.936 0 0 0 10.474.1 12 12 0 0 0 12.018 24H19a5.006 5.006 0 0 0 5-5v-7.754a12.044 12.044 0 0 0-4.325-8.488ZM8 7h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2Zm8 10H8a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H8a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Z" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                    </div>
                    <div class="left_info">
                        <span>{{ __('message.sendTicket_title') }}</span>
                        <p> {{ __('message.sendTicket_title2') }} </p>
                    </div>
                </div>
                <div class="sendTicketBtn">
                    <span>{{ __('message.sendTicketBtn') }}</span>
                    <svg viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M12.4789 4.53947L15.8693 4.23962C16.6302 4.23962 17.2471 4.86253 17.2471 5.63081C17.2471 6.3991 16.6302 7.022 15.8693 7.022L12.4789 6.72216C11.882 6.72216 11.3981 6.23353 11.3981 5.63081C11.3981 5.02709 11.882 4.53947 12.4789 4.53947"></path>
                        <path d="M1.09392 4.5946C1.14691 4.5411 1.34488 4.31495 1.53085 4.12717C2.61567 2.95102 5.44819 1.02779 6.92994 0.439206C7.1549 0.345316 7.7238 0.145421 8.02875 0.131287C8.3197 0.131287 8.59765 0.198928 8.86261 0.332191C9.19355 0.518962 9.45751 0.813757 9.60348 1.16105C9.69647 1.40133 9.84244 2.12317 9.84244 2.1363C9.98742 2.92477 10.0664 4.20693 10.0664 5.62437C10.0664 6.97315 9.98742 8.20281 9.86844 9.00441C9.85544 9.01855 9.70947 9.91404 9.55049 10.2209C9.25954 10.7823 8.69064 11.1296 8.08174 11.1296H8.02875C7.63182 11.1164 6.79796 10.7681 6.79796 10.756C5.3952 10.1674 2.62966 8.33708 1.51785 7.12055C1.51785 7.12055 1.2039 6.80758 1.06793 6.61274C0.855964 6.33208 0.749982 5.98478 0.749982 5.63749C0.749982 5.24981 0.868961 4.8894 1.09392 4.5946"></path>
                    </svg>
                </div>
            </div>

            @endif

            @else

            <div class="left_all_boxes sendTicket">
                <div class="top">
                    <div class="icon_bg">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M19.675 2.758A11.936 11.936 0 0 0 10.474.1 12 12 0 0 0 12.018 24H19a5.006 5.006 0 0 0 5-5v-7.754a12.044 12.044 0 0 0-4.325-8.488ZM8 7h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2Zm8 10H8a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H8a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Z" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                    </div>
                    <div class="left_info">
                        <span>{{ __('message.sendTicket_title') }}</span>
                        <p> {{ __('message.sendTicket_title2') }} </p>
                    </div>
                </div>
                <div class="sendTicketBtn error">
                    <a href="/auth/signup">
                        <span>{{ __('message.addCommentBtn2') }}</span>
                        <svg viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M12.4789 4.53947L15.8693 4.23962C16.6302 4.23962 17.2471 4.86253 17.2471 5.63081C17.2471 6.3991 16.6302 7.022 15.8693 7.022L12.4789 6.72216C11.882 6.72216 11.3981 6.23353 11.3981 5.63081C11.3981 5.02709 11.882 4.53947 12.4789 4.53947"></path>
                            <path d="M1.09392 4.5946C1.14691 4.5411 1.34488 4.31495 1.53085 4.12717C2.61567 2.95102 5.44819 1.02779 6.92994 0.439206C7.1549 0.345316 7.7238 0.145421 8.02875 0.131287C8.3197 0.131287 8.59765 0.198928 8.86261 0.332191C9.19355 0.518962 9.45751 0.813757 9.60348 1.16105C9.69647 1.40133 9.84244 2.12317 9.84244 2.1363C9.98742 2.92477 10.0664 4.20693 10.0664 5.62437C10.0664 6.97315 9.98742 8.20281 9.86844 9.00441C9.85544 9.01855 9.70947 9.91404 9.55049 10.2209C9.25954 10.7823 8.69064 11.1296 8.08174 11.1296H8.02875C7.63182 11.1164 6.79796 10.7681 6.79796 10.756C5.3952 10.1674 2.62966 8.33708 1.51785 7.12055C1.51785 7.12055 1.2039 6.80758 1.06793 6.61274C0.855964 6.33208 0.749982 5.98478 0.749982 5.63749C0.749982 5.24981 0.868961 4.8894 1.09392 4.5946"></path>
                        </svg>
                    </a>
                </div>
            </div>

            @endif



            @if(auth()->check() && !session()->has('admin'))

            <div class="left_all_boxes AddComment">
                <p class="title"> {{ __('message.addComment') }} </p>
                <div class="addCommentBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M19 1H9C6.24 1 4 3.24 4 6v8c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V6c0-2.76-2.24-5-5-5ZM9 3h10c.89 0 1.69.39 2.24 1l-5.12 5.12a3 3 0 0 1-4.24 0L6.76 4C7.31 3.38 8.11 3 9 3Zm10 14H9c-1.65 0-3-1.35-3-3V6.07l4.46 4.46a5.022 5.022 0 0 0 7.08 0L22 6.07V14c0 1.65-1.35 3-3 3Zm0 5c0 .55-.45 1-1 1H5c-2.76 0-5-2.24-5-5V7c0-.55.45-1 1-1s1 .45 1 1v11c0 1.65 1.35 3 3 3h13c.55 0 1 .45 1 1Z" data-original="#000000"></path>
                        </g>
                    </svg>
                    <span>{{ __('message.addCommentBtn') }}</span>
                </div>
            </div>

            @elseif(!session()->has('admin'))

            <div class="left_all_boxes AddComment SignUpShould">
                <p class="title"> {{ __('message.addComment') }} </p>
                <div class="addCommentBtn">
                    <a href="/auth/signup">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M12 12a6 6 0 1 0-6-6 6.006 6.006 0 0 0 6 6Zm0-10a4 4 0 1 1-4 4 4 4 0 0 1 4-4ZM12 14a9.01 9.01 0 0 0-9 9 1 1 0 0 0 2 0 7 7 0 0 1 14 0 1 1 0 0 0 2 0 9.01 9.01 0 0 0-9-9Z" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <span>{{ __('message.addCommentBtn2') }}</span>
                    </a>
                </div>
            </div>

            @endif


        </div>
    </div>
</div>


@if($job->galley()->where("status" , "تایید شده")->get()->count() > 0)

<div class="Gallery_con">
    <div class="Gallery_shadow"></div>
    <div class="swiper ImageGallery">
        <div class="swiper-wrapper">
            @foreach($job->galley()->where("status" , "تایید شده")->get() as $img)

            <div class="swiper-slide">
                <div class="slider_gallery" style="background-image: url(/<?= $img->image ?>);">
                    <img src="" alt="">
                    <div class="gallery_about">
                        <p> {{ $img->{'description_' . session('lang')} }} </p>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>

    @if($job->galley()->where("status" , "تایید شده")->get()->count() > 1)

    <div class="gallery_btns next">
        <svg viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M17.6954 12.4962L21.6468 12.1467C22.5335 12.1467 23.2525 12.8727 23.2525 13.7681C23.2525 14.6635 22.5335 15.3895 21.6468 15.3895L17.6954 15.04C16.9997 15.04 16.4357 14.4705 16.4357 13.7681C16.4357 13.0645 16.9997 12.4962 17.6954 12.4962"></path>
            <path d="M4.42637 12.5604C4.48813 12.4981 4.71885 12.2345 4.93559 12.0157C6.19989 10.6449 9.50107 8.40347 11.228 7.71751C11.4902 7.60808 12.1532 7.37512 12.5086 7.35864C12.8477 7.35864 13.1716 7.43748 13.4804 7.59279C13.8661 7.81046 14.1738 8.15403 14.3439 8.55878C14.4522 8.83882 14.6224 9.68009 14.6224 9.69539C14.7913 10.6143 14.8834 12.1086 14.8834 13.7606C14.8834 15.3325 14.7913 16.7656 14.6527 17.6999C14.6375 17.7163 14.4674 18.76 14.2821 19.1177C13.943 19.7719 13.28 20.1766 12.5704 20.1766H12.5086C12.046 20.1613 11.0742 19.7554 11.0742 19.7413C9.43931 19.0553 6.21621 16.9221 4.92044 15.5043C4.92044 15.5043 4.55455 15.1396 4.39608 14.9125C4.14904 14.5854 4.02552 14.1806 4.02552 13.7759C4.02552 13.3241 4.16419 12.904 4.42637 12.5604"></path>
        </svg>
    </div>
    <div class="gallery_btns prev">
        <svg viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4" d="M17.6954 12.4962L21.6468 12.1467C22.5335 12.1467 23.2525 12.8727 23.2525 13.7681C23.2525 14.6635 22.5335 15.3895 21.6468 15.3895L17.6954 15.04C16.9997 15.04 16.4357 14.4705 16.4357 13.7681C16.4357 13.0645 16.9997 12.4962 17.6954 12.4962"></path>
            <path d="M4.42637 12.5604C4.48813 12.4981 4.71885 12.2345 4.93559 12.0157C6.19989 10.6449 9.50107 8.40347 11.228 7.71751C11.4902 7.60808 12.1532 7.37512 12.5086 7.35864C12.8477 7.35864 13.1716 7.43748 13.4804 7.59279C13.8661 7.81046 14.1738 8.15403 14.3439 8.55878C14.4522 8.83882 14.6224 9.68009 14.6224 9.69539C14.7913 10.6143 14.8834 12.1086 14.8834 13.7606C14.8834 15.3325 14.7913 16.7656 14.6527 17.6999C14.6375 17.7163 14.4674 18.76 14.2821 19.1177C13.943 19.7719 13.28 20.1766 12.5704 20.1766H12.5086C12.046 20.1613 11.0742 19.7554 11.0742 19.7413C9.43931 19.0553 6.21621 16.9221 4.92044 15.5043C4.92044 15.5043 4.55455 15.1396 4.39608 14.9125C4.14904 14.5854 4.02552 14.1806 4.02552 13.7759C4.02552 13.3241 4.16419 12.904 4.42637 12.5604"></path>
        </svg>
    </div>

    @endif

</div>

@endif


@if(auth()->check())

<div class="CommentAdd_con Cmt">
    <div class="commentShadow"></div>
    <div class="Comment_sec">
        <p class="title"> {{ __('message.addCommentTitle') }} </p>
        <form action="/Job/{{ $job->id }}/addComment" method="post">
            <textarea name="Comment_text" placeholder="{{ __('message.write_your_comment') }}" ></textarea>
            <button type="button" class="addComment_btn">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <path d="M12.854.03a12.018 12.018 0 0 0-9.339 3.485A12.023 12.023 0 0 0 .03 12.854C.47 19.208 6.095 24 13.113 24h5.888C21.944 24 24 21.596 24 18.153v-5.815C24 5.869 19.104.463 12.854.03ZM22 18.153C22 20.454 20.795 22 19.001 22h-5.888c-6.052 0-10.715-3.905-11.088-9.285a10.022 10.022 0 0 1 2.904-7.786 10.015 10.015 0 0 1 7.786-2.905C17.922 2.385 22 6.915 22 12.336v5.815ZM17 12a1 1 0 0 1-1 1h-3v3a1 1 0 0 1-2 0v-3H8a1 1 0 0 1 0-2h3V8a1 1 0 0 1 2 0v3h3a1 1 0 0 1 1 1Z" data-original="#000000" class=""></path>
                    </g>
                </svg>
                {{ __('message.addCommentBtn') }}
            </button>
            <div class="close_comment_con">
                {{ __('message.close') }}
            </div>
            @csrf
        </form>
    </div>
</div>

@if(auth()->user()->phoneNumber != $job->phoneNumber)

<div class="CommentAdd_con Ticket">
    <div class="commentShadow"></div>
    <div class="Comment_sec">
        <p class="title"> {{ __('message.addTicketTitle') }} </p>
        <form action="/addTicket/{{ $job->id }}/send" method="post">
            <textarea name="text" placeholder="{{ __('message.write_your_ticket') }}"></textarea>
            <button type="button" class="addComment_btn">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <path d="M12.854.03a12.018 12.018 0 0 0-9.339 3.485A12.023 12.023 0 0 0 .03 12.854C.47 19.208 6.095 24 13.113 24h5.888C21.944 24 24 21.596 24 18.153v-5.815C24 5.869 19.104.463 12.854.03ZM22 18.153C22 20.454 20.795 22 19.001 22h-5.888c-6.052 0-10.715-3.905-11.088-9.285a10.022 10.022 0 0 1 2.904-7.786 10.015 10.015 0 0 1 7.786-2.905C17.922 2.385 22 6.915 22 12.336v5.815ZM17 12a1 1 0 0 1-1 1h-3v3a1 1 0 0 1-2 0v-3H8a1 1 0 0 1 0-2h3V8a1 1 0 0 1 2 0v3h3a1 1 0 0 1 1 1Z" data-original="#000000" class=""></path>
                    </g>
                </svg>
                {{ __('message.addTicketBtn') }}
            </button>
            <div class="close_comment_con">
                {{ __('message.close') }}
            </div>
            @csrf
        </form>
    </div>
</div>

@endif

@endif

@if(auth()->check() || session()->has('admin'))

<div class="CommentAdd_con Answer">
    <div class="commentShadow"></div>
    <div class="Comment_sec">
        <p class="title"> {{ __('message.addAnswerCommentTitle') }} </p>
        <form action="/answers/add" method="post">
            <textarea name="answer_text" placeholder="{{ __('message.write_your_comment') }}"></textarea>
            <input type="hidden" name="user_id_receiver" id="receiver">
            <input type="hidden" name="comment_id" id="comment_id">
            <input type="hidden" name="Receiver" id="type_receiver">
            <button type="button" class="addComment_btn">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <path d="M12.854.03a12.018 12.018 0 0 0-9.339 3.485A12.023 12.023 0 0 0 .03 12.854C.47 19.208 6.095 24 13.113 24h5.888C21.944 24 24 21.596 24 18.153v-5.815C24 5.869 19.104.463 12.854.03ZM22 18.153C22 20.454 20.795 22 19.001 22h-5.888c-6.052 0-10.715-3.905-11.088-9.285a10.022 10.022 0 0 1 2.904-7.786 10.015 10.015 0 0 1 7.786-2.905C17.922 2.385 22 6.915 22 12.336v5.815ZM17 12a1 1 0 0 1-1 1h-3v3a1 1 0 0 1-2 0v-3H8a1 1 0 0 1 0-2h3V8a1 1 0 0 1 2 0v3h3a1 1 0 0 1 1 1Z" data-original="#000000" class=""></path>
                    </g>
                </svg>
                {{ __('message.addCommentBtn') }}
            </button>
            <div class="close_comment_con">
                {{ __('message.close') }}
            </div>
            @csrf
        </form>
    </div>
</div>

@endif


@endsection


@section('js_links')

<script defer src="/website/Js/like.js"></script>
<script defer src="/website/Js/Job/copy_socialMedias_<?= session('lang') ?>.js"></script>
<script defer src="/website/Js/Job/Rating.js" class="rateScript"></script>
<script defer src="/Tools/Js/persian-date.js"></script>
<script defer src="/website/Js/Job/TimerWorking.js"></script>
<script defer src="/website/Js/Job/sliders.js"></script>

@if(auth()->check())

<script defer src="/website/Js/Job/validation_comment_<?= session('lang') ?>.js"></script>
<script defer src="/website/Js/Job/AddComment_con.js"></script>

@if(auth()->user()->phoneNumber != $job->phoneNumber)

<script defer src="/website/Js/Job/ticket_<?= session('lang') ?>.js"></script>
<script defer src="/website/Js/Job/AddTicket_con.js"></script>

@endif



@endif

@if(auth()->check() || session()->has('admin'))

<script defer src="/website/Js/Job/validation_answer_<?= session('lang') ?>.js"></script>
<script defer src="/website/Js/Job/AddAnswer_con.js"></script>


@endif


@if($job->galley()->get()->count() > 0)

<script defer src="/website/Js/Job/gallery.js"></script>

@endif

<script defer src="/website/Js/Job/like_comment.js"></script>


@endsection