@extends('website.panel.panel_layouts.MasterPanel')

@section("title_page" , 'پروفایل کاربری')

@section('css_links')

<link rel="stylesheet" href="/website/Css/Panel/profile/style.css">

@endsection

@section('panel_content')

<div class="AllProfileCon SignUp_right">
    <form action="/panel/profile/edit" method="post" class="edit_from" enctype="multipart/form-data">
        <div class="Image_profileCon">
            <div class="bgAnimate"></div>
            <input type="file" id="profile" name="profile" style="display: none;">
            <input type="hidden" id="profile_status" name="profile_status">
            <div class="profileUserCon {{ auth()->user()->profile != 'Tools/Images/Website_images/user.svg' ? 'uploaded' : '' }}">
                <label for="profile" class="profileUser" style="background-image: url(/<?= auth()->user()->profile ?>);"></label>
                <div class="deleteShadow">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M448 85.333h-66.133C371.66 35.703 328.002.064 277.333 0h-42.667c-50.669.064-94.327 35.703-104.533 85.333H64c-11.782 0-21.333 9.551-21.333 21.333S52.218 128 64 128h21.333v277.333C85.404 464.214 133.119 511.93 192 512h128c58.881-.07 106.596-47.786 106.667-106.667V128H448c11.782 0 21.333-9.551 21.333-21.333S459.782 85.333 448 85.333zM234.667 362.667c0 11.782-9.551 21.333-21.333 21.333-11.783 0-21.334-9.551-21.334-21.333v-128c0-11.782 9.551-21.333 21.333-21.333 11.782 0 21.333 9.551 21.333 21.333v128zm85.333 0c0 11.782-9.551 21.333-21.333 21.333-11.782 0-21.333-9.551-21.333-21.333v-128c0-11.782 9.551-21.333 21.333-21.333 11.782 0 21.333 9.551 21.333 21.333v128zM174.315 85.333c9.074-25.551 33.238-42.634 60.352-42.667h42.667c27.114.033 51.278 17.116 60.352 42.667H174.315z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <div class="IntsAllCon">
            <div class="ints twoSide user_info">
                <div class="right">
                    <label for="name"> {{ __('message.sign_up_name') }} </label>
                    <input type="text" name="name" id="name" value="{{ auth()->user()->name }}">
                </div>
                <div class="left">
                    <label for="family"> {{ __('message.sign_up_family') }} </label>
                    <input type="text" name="family" id="family" value="{{ auth()->user()->family }}">
                </div>
            </div>
            <div class="ints twoSide phone">
                <div class="right">
                    <label for="phoneNumber"> {{ __('message.sign_up_phone') }} </label>
                    <input type="text" name="phoneNumber" id="phoneNumber" value="<?= str_replace(auth()->user()->phone_code, '', auth()->user()->phoneNumber) ?>">
                </div>
                <div class="left">
                    <input type="text" name="Number_code" id="Number_code" value="{{ auth()->user()->phone_code }}">
                </div>
            </div>
            <div class="ints pas">
                <label for="password"> {{ __('message.sign_up_password') }} </label>
                <input type="password" name="password" id="password" value="{{ Illuminate\Support\Facades\Crypt::decrypt(auth()->user()->password) }}">
                <ion-icon name="eye-outline"></ion-icon>
            </div>
            <div class="ints">
                <div class="drp_btn">
                    <label for=""> {{ __('message.sign_up_county') }} </label>
                    <span>{{ auth()->user()->city()->first()->state()->first()->country()->first()->{'country_name_' . session('lang')} }}</span>
                    <ion-icon name="chevron-down-outline"></ion-icon>
                </div>
                <div class="drps">
                    @if(App\Models\Country::all()->count() > 0)
                    @foreach(App\Models\Country::all() as $ct)

                    <div class="drps_option" onclick="GetStates(<?= $ct->id ?>,event)">{{ $ct->{'country_name_' . session('lang')} }} </div>

                    @endforeach
                    @else

                    <div class="empty">{{ __('message.noCountry') }}</div>
                    @endif

                </div>
            </div>
            <div class="ints twoSide dropDowns">
                <div class="right">
                    <div class="drp_btn">
                        <label for=""> {{ __('message.sign_up_state') }} </label>
                        <span class="drp_btn_span_state">{{ auth()->user()->city()->first()->state()->first()->{'state_name_' . session('lang')} }}</span>
                        <ion-icon name="chevron-down-outline"></ion-icon>
                    </div>
                    <div class="drps state">
                        @if(auth()->user()->city()->first()->state()->first()->country()->first()->states()->get()->count() > 0)

                        @foreach(auth()->user()->city()->first()->state()->first()->country()->first()->states()->get() as  $state)

                        <?php

                        $name = $state->{'state_name_' . session('lang')} != null ? $state->{'state_name_' . session('lang')} : $state->state_name_fa;

                        ?>
                        <div class='drps_option' onclick='getCitys(<?= $state->id ?>,event)'><?= $name ?></div>

                        @endforeach

                        @else

                        <div class='empty'>
                            {{ __('message.choose_country') }}
                        </div>

                        @endif

                    </div>
                </div>
                <div class="left">
                    <div class="drp_btn">
                        <label for=""> {{ __('message.sign_up_city') }} </label>
                        <span class="drp_btn_span_city">{{ auth()->user()->city()->first()->{'city_name_' . session('lang')} }}</span>
                        <ion-icon name="chevron-down-outline"></ion-icon>
                    </div>
                    <div class="drps city">
                        @if(auth()->user()->city()->first()->state()->first()->cities()->get()->count() > 0)

                        @foreach(auth()->user()->city()->first()->state()->first()->cities()->get() as $city)

                        <?php

                        $name = $city->{'city_name_' . session('lang')} != null ? $city->{'city_name_' . session('lang')} : $city->city_name_fa;

                        ?>
                        <div class='drps_option' onclick='pickCity(<?= $city->id ?>,event)'><?= $name ?></div>

                        @endforeach

                        @else

                        <div class="empty">
                            {{ __('message.choose_state') }}
                        </div>

                        @endif
                        
                    </div>
                </div>
            </div>
            <div class="drps_overlay"></div>
            <input type="hidden" name="city_id" id="city_id" value="{{ auth()->user()->city_id }}">
            @csrf
            <button type="submit" class="signUpBtn"> {{ __('message.edit_profileBtn') }} </button>
        </div>
    </form>
</div>

@endsection


@section("js_links")

<script defer src="/website/Js/panel/profile/profile_image.js"></script>
<script defer src="/website/Js/logIn&signup/signup.js"></script>
<script defer src="/website/Js/logIn&signup/phone.js"></script>
<script defer src="/website/Js/logIn&signup/validation_<?= session('lang') ?>.js" type="module"></script>

@endsection