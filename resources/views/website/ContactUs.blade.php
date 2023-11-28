@extends("website.layouts.Master")

@section("title_page" , 'ارتباط با ما')

@section("css_links")

<link rel="stylesheet" href="/website/Css/contactUs/style.css">

@endsection

@section("content")

<div class="containerContactUs">
    <div class="containerContactUs_sec">

        <div class="Header_content">
            <div class="right">
                <p class="title"> {{ __('message.ContactUs') }} </p>
                <p class="about"> {{ __('message.ContactUs_about') }} </p>
                <div class="SeeMore"> {{ __('message.seeMoreDetails') }}
                    <svg viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M17.2446 13.2848L16.7227 7.38353C16.7227 6.05917 17.8069 4.98541 19.1441 4.98541C20.4814 4.98541 21.5656 6.05917 21.5656 7.38353L21.0437 13.2848C21.0437 14.3238 20.1932 15.1661 19.1441 15.1661C18.0933 15.1661 17.2446 14.3238 17.2446 13.2848Z"></path>
                        <path d="M17.3405 33.1018C17.2474 33.0095 16.8538 32.6649 16.5269 32.3413C14.4797 30.453 11.1322 25.5228 10.1077 22.9437C9.94431 22.5521 9.59638 21.5619 9.57178 21.0311C9.57178 20.5247 9.68951 20.0409 9.92147 19.5797C10.2466 19.0037 10.7597 18.5443 11.3642 18.2902C11.7824 18.1283 13.0388 17.8743 13.0617 17.8743C14.4341 17.6219 16.6658 17.4844 19.1329 17.4844C21.4806 17.4844 23.6209 17.6219 25.0162 17.829C25.0408 17.8516 26.5994 18.1057 27.1336 18.3824C28.1107 18.8888 28.7151 19.8791 28.7151 20.9389V21.0311C28.6923 21.722 28.0861 23.1734 28.065 23.1734C27.0405 25.615 23.8546 30.4287 21.7371 32.3639C21.7371 32.3639 21.1924 32.9103 20.8533 33.147C20.3647 33.5159 19.7603 33.7004 19.1558 33.7004C18.481 33.7004 17.8536 33.4933 17.3405 33.1018Z"></path>
                    </svg>
                </div>
            </div>
            <div class="left">
                <img src="/Tools/Images/Website_images/25.png" class="header_image" alt="">
            </div>
        </div>
        @if(App\Models\ContactUsInfos::all()->first() != [])

        <div class="ContactWaysCon">
            <div class="top_sec">
                <p class="title"> {{ __('message.contact') }}</p>
                <div class="line"></div>
            </div>
            <div class="bottom_sec">
                @if(App\Models\ContactUsInfos::all()->first()->insta_name != '')

                <div class="Boxs">
                    <a href="{{ App\Models\ContactUsInfos::all()->first()->insta_link }}">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M12 2.162c3.204 0 3.584.012 4.849.07 1.308.06 2.655.358 3.608 1.311.962.962 1.251 2.296 1.311 3.608.058 1.265.07 1.645.07 4.849s-.012 3.584-.07 4.849c-.059 1.301-.364 2.661-1.311 3.608-.962.962-2.295 1.251-3.608 1.311-1.265.058-1.645.07-4.849.07s-3.584-.012-4.849-.07c-1.291-.059-2.669-.371-3.608-1.311-.957-.957-1.251-2.304-1.311-3.608-.058-1.265-.07-1.645-.07-4.849s.012-3.584.07-4.849c.059-1.296.367-2.664 1.311-3.608.96-.96 2.299-1.251 3.608-1.311 1.265-.058 1.645-.07 4.849-.07M12 0C8.741 0 8.332.014 7.052.072 5.197.157 3.355.673 2.014 2.014.668 3.36.157 5.198.072 7.052.014 8.332 0 8.741 0 12c0 3.259.014 3.668.072 4.948.085 1.853.603 3.7 1.942 5.038 1.345 1.345 3.186 1.857 5.038 1.942C8.332 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 1.854-.085 3.698-.602 5.038-1.942 1.347-1.347 1.857-3.184 1.942-5.038.058-1.28.072-1.689.072-4.948 0-3.259-.014-3.668-.072-4.948-.085-1.855-.602-3.698-1.942-5.038C20.643.671 18.797.156 16.948.072 15.668.014 15.259 0 12 0z" data-original="#000000"></path>
                                    <path d="M12 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8z" data-original="#000000"></path>
                                    <circle cx="18.406" cy="5.594" r="1.44" data-original="#000000"></circle>
                                </g>
                            </svg>
                        </div>
                        <div class="content"> {{ App\Models\ContactUsInfos::all()->first()->insta_name }} </div>
                        <div class="title_box_contact"> {{ __('message.insta') }} </div>
                    </a>
                </div>

                @endif
                
                @if(App\Models\ContactUsInfos::all()->first()->email_name != '')

                <div class="Boxs">
                    <a href="{{ App\Models\ContactUsInfos::all()->first()->email_link }}">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M19 1H5a5.006 5.006 0 0 0-5 5v12a5.006 5.006 0 0 0 5 5h14a5.006 5.006 0 0 0 5-5V6a5.006 5.006 0 0 0-5-5ZM5 3h14a3 3 0 0 1 2.78 1.887l-7.658 7.659a3.007 3.007 0 0 1-4.244 0L2.22 4.887A3 3 0 0 1 5 3Zm14 18H5a3 3 0 0 1-3-3V7.5l6.464 6.46a5.007 5.007 0 0 0 7.072 0L22 7.5V18a3 3 0 0 1-3 3Z" data-original="#000000"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="content"> {{ App\Models\ContactUsInfos::all()->first()->email_name }} </div>
                        <div class="title_box_contact"> {{ __('message.email') }} </div>
                    </a>
                </div>

                @endif
                

                @if(App\Models\ContactUsInfos::all()->first()->telegram_name != '')

                <div class="Boxs">
                    <a href="{{ App\Models\ContactUsInfos::all()->first()->telegram_link }}">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M23.119.882a2.966 2.966 0 0 0-2.8-.8l-16 3.37a4.995 4.995 0 0 0-2.853 8.481l1.718 1.717a1 1 0 0 1 .293.708v3.168a2.965 2.965 0 0 0 .3 1.285l-.008.007.026.026A3 3 0 0 0 5.157 20.2l.026.026.007-.008a2.965 2.965 0 0 0 1.285.3h3.168a1 1 0 0 1 .707.292l1.717 1.717A4.963 4.963 0 0 0 15.587 24a5.049 5.049 0 0 0 1.605-.264 4.933 4.933 0 0 0 3.344-3.986l3.375-16.035a2.975 2.975 0 0 0-.792-2.833ZM4.6 12.238l-1.719-1.717a2.94 2.94 0 0 1-.722-3.074 2.978 2.978 0 0 1 2.5-2.026L20.5 2.086 5.475 17.113v-2.755a2.978 2.978 0 0 0-.875-2.12Zm13.971 7.17a3 3 0 0 1-5.089 1.712l-1.72-1.72a2.978 2.978 0 0 0-2.119-.878H6.888L21.915 3.5Z" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                        </div>
                        <div class="content"> {{ App\Models\ContactUsInfos::all()->first()->telegram_name  }} </div>
                        <div class="title_box_contact"> {{ __('message.telegram') }} </div>
                    </a>
                </div>

                @endif
                
            </div>
        </div>


        @if(App\Models\ContactUsInfos::all()->first()->phones != '' || App\Models\ContactUsInfos::all()->first()->address_fa != '')

        <div class="ContactWaysCon2">

            @if(App\Models\ContactUsInfos::all()->first()->phones != '')

            <p class="title"> {{ __('message.phoneNumbers_title') }} </p>
            <p class="infos phone"> {{ App\Models\ContactUsInfos::all()->first()->phones }} </p>

            @endif

            @if(App\Models\ContactUsInfos::all()->first()->address_fa != '')

            <p class="title"> {{ __('message.address_title2') }} </p>
            <p class="infos"> {{ App\Models\ContactUsInfos::all()->first()->{'address_' . session('lang')} }} </p>

            @endif
            
            
        </div>

        @endif
        

        @endif
       

        <div class="ContactWaysCon">
            <div class="top_sec">
                <p class="title"> {{ __('message.contact2') }}</p>
                <div class="line"></div>
            </div>
            <div class="bottom_sec map">
                <form action="/Add_contact_us_request" method="post" class="contact_us_form">
                    <p class="title_all"> {{ __('message.contact2_infos') }} </p>
                    <input type="text" name="name" class="ints" placeholder="{{ __('message.sign_up_name') }}" value="{{ auth()->check() ? auth()->user()->name : '' }}">
                    <input type="text" name="family" class="ints" placeholder="{{ __('message.sign_up_family') }}"  value="{{ auth()->check() ? auth()->user()->family : '' }}">
                    <input type="text" name="email" class="ints" placeholder="{{ __('message.email') }}">
                    <input type="text" name="phoneNumber" class="ints phoneNum" placeholder="{{ __('message.phoneNumber') }}"  value="{{ auth()->check() ? auth()->user()->phoneNumber : '' }}">
                    <textarea name="description" class="ints textarea" placeholder="{{ __('message.description') }}"></textarea>
                    <button type="button" class="btn_contact"> {{ __('message.btn_contact') }} </button>
                    @csrf
                </form>
            </div>
        </div>

    </div>
</div>

@endsection


@section('js_links')

<script defer src="/website/Js/contactUs/script.js"></script>
<script defer src="/website/Js/contactUs/validation_<?= session('lang') ?>.js"></script>

@endsection