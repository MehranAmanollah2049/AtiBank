@extends("website.layouts.Master")

@section("title_page" , __('message.AllJobs'))

@section("css_links")
<link rel="stylesheet" href="/website/Css/AllJobs/style.css">
@endsection

@section("content")

<div class="containerAllJobs">
    <div class="AllJobs_section">
        <div class="right_all">
            <form action="/AllJobs/Filter" class="filter_all_form" method="get">

                <div class="filter_box_con">
                    <div class="filter_box_top">
                        <div class="right">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M20 4h-5a4 4 0 0 0-4-4H4a4 4 0 0 0-4 4v19a1 1 0 0 0 2 0V13h8a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V8a4 4 0 0 0-4-4zM2 11V4a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2zm20 2a2 2 0 0 1-2 2h-6a2 2 0 0 1-2-2v-.142A4 4 0 0 0 15 9V6h5a2 2 0 0 1 2 2z" fill="#2a2d53" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                            <p class="title"> {{ __("message.filter_title_countrys") }} </p>
                        </div>
                        <svg class="arrow" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="filter_box_bottom">
                        <div class="filter_content_sec country">

                            @if(App\Models\Country::all()->count() > 0)

                            <?php

                            if (isset($_GET['country'])) {

                            ?>
                                @foreach(App\Models\Country::all() as $country)

                                <?php

                                $checked = '';

                                if ($_GET['country'] == $country->id) {

                                    $checked = 'checked';
                                }

                                ?>

                                <div class="checkBoxCon" onclick="getState(event,<?= $country->id ?>)">
                                    <input type="radio" name="country" id="country{{ $loop->iteration }}" value="{{ $country->id }}" <?= $checked ?>>
                                    <label for="country{{ $loop->iteration }}">
                                        <div class="check_box">
                                            <div class="checked">
                                                <i class="fi fi-br-check"></i>
                                                <div class="loading-spinner-checkbox"></div>
                                            </div>
                                        </div>
                                        <span> {{ $country->{'country_name_' . session("lang")} }} </span>
                                    </label>
                                </div>

                                @endforeach
                            <?php

                            } else {

                            ?>
                                @foreach(App\Models\Country::all() as $country)



                                <div class="checkBoxCon" onclick="getState(event,<?= $country->id ?>)">
                                    <input type="radio" name="country" id="country{{ $loop->iteration }}" value="{{ $country->id }}">
                                    <label for="country{{ $loop->iteration }}">
                                        <div class="check_box">
                                            <div class="checked">
                                                <i class="fi fi-br-check"></i>
                                                <div class="loading-spinner-checkbox"></div>
                                            </div>
                                        </div>
                                        <span> {{ $country->{'country_name_' . session("lang")} }} </span>
                                    </label>
                                </div>

                                @endforeach
                            <?php

                            }

                            ?>

                            @else

                            <div class="empty_filter">
                                {{ __('message.noCountry') }}
                            </div>

                            @endif


                        </div>
                    </div>
                </div>
                <div class="filter_box_con">
                    <div class="filter_box_top">
                        <div class="right">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M12 6a4 4 0 1 0 4 4 4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2 2 2 0 0 1-2 2Z" fill="#2a2d53" data-original="#000000"></path>
                                    <path d="M12 24a5.271 5.271 0 0 1-4.311-2.2c-3.811-5.257-5.744-9.209-5.744-11.747a10.055 10.055 0 0 1 20.11 0c0 2.538-1.933 6.49-5.744 11.747A5.271 5.271 0 0 1 12 24Zm0-21.819a7.883 7.883 0 0 0-7.874 7.874c0 2.01 1.893 5.727 5.329 10.466a3.145 3.145 0 0 0 5.09 0c3.436-4.739 5.329-8.456 5.329-10.466A7.883 7.883 0 0 0 12 2.181Z" fill="#2a2d53" data-original="#000000"></path>
                                </g>
                            </svg>
                            <p class="title"> {{ __("message.filter_title_states") }} </p>
                        </div>
                        <svg class="arrow" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="filter_box_bottom">
                        <div class="filter_content_sec state">

                            <?php

                            if (isset($_GET['country']) && isset($_GET['state'])) {


                            ?>

                                @foreach(App\Models\Country::where('id' , $_GET['country'])->first()->states()->get() as $state)

                                <?php

                                $checked = '';

                                if ($_GET['state'] == $state->id) {

                                    $checked = 'checked';
                                }

                                ?>

                                <div class='checkBoxCon' onclick='getCity(event,<?= $state->id ?>)'>
                                    <input type='radio' name='state' id='state{{ $loop->iteration }}' value='{{ $state->id }}' <?= $checked ?>>
                                    <label for='state{{ $loop->iteration }}'>
                                        <div class='check_box'>
                                            <div class='checked'>
                                                <i class='fi fi-br-check'></i>
                                                <div class="loading-spinner-checkbox"></div>
                                            </div>
                                        </div>
                                        <span> {{ $state->{'state_name_' . session('lang')} }} </span>
                                    </label>
                                </div>

                                @endforeach

                            <?php


                            } else if (isset($_GET['country']) && !isset($_GET['state'])) {

                            ?>
                                @foreach(App\Models\Country::where('id' , $_GET['country'])->first()->states()->get() as $state)


                                <div class='checkBoxCon' onclick='getCity(event,<?= $state->id ?>)'>
                                    <input type='radio' name='state' id='state{{ $loop->iteration }}' value='{{ $state->id }}'>
                                    <label for='state{{ $loop->iteration }}'>
                                        <div class='check_box'>
                                            <div class='checked'>
                                                <i class='fi fi-br-check'></i>
                                                <div class="loading-spinner-checkbox"></div>
                                            </div>
                                        </div>
                                        <span> {{ $state->{'state_name_' . session('lang')} }} </span>
                                    </label>
                                </div>

                                @endforeach
                            <?php

                            } else {

                            ?>
                                <div class="empty_filter">
                                    {{ __('message.choose_country') }}
                                </div>
                            <?php

                            }

                            ?>



                        </div>
                    </div>
                </div>
                <div class="filter_box_con">
                    <div class="filter_box_top">
                        <div class="right">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M19 15h-1a1 1 0 1 1 0-2h1a1 1 0 1 1 0 2Zm1 3a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2h1a1 1 0 0 0 1-1ZM16 6a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2h1a1 1 0 0 0 1-1Zm4 0a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2h1a1 1 0 0 0 1-1Zm0 4a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2h1a1 1 0 0 0 1-1Zm4 9V5c0-2.757-2.243-5-5-5h-5c-2.757 0-5 2.243-5 5a1 1 0 1 0 2 0c0-1.654 1.346-3 3-3h5c1.654 0 3 1.346 3 3v14c0 1.654-1.346 3-3 3h-1a1 1 0 1 0 0 2h1c2.757 0 5-2.243 5-5Zm-8 .5v-4.152a4.972 4.972 0 0 0-1.919-3.938l-3-2.349a4.993 4.993 0 0 0-6.162 0l-3 2.348A4.97 4.97 0 0 0 0 15.347v4.152c0 2.481 2.019 4.5 4.5 4.5h7c2.481 0 4.5-2.019 4.5-4.5Zm-6.151-8.863 3 2.348A2.986 2.986 0 0 1 14 15.348V19.5c0 1.379-1.121 2.5-2.5 2.5h-7A2.502 2.502 0 0 1 2 19.5v-4.152c0-.929.42-1.79 1.151-2.363l3-2.347a2.993 2.993 0 0 1 3.698-.001ZM10 18v-2a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1Z" fill="#2a2d53" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                            <p class="title"> {{ __("message.filter_title_cities") }} </p>
                        </div>
                        <svg class="arrow" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="filter_box_bottom">
                        <div class="filter_content_sec city">

                            <?php

                            if (isset($_GET['country']) && isset($_GET['state']) && isset($_GET['city'])) {

                            ?>

                                @foreach(App\Models\State::where("id" , $_GET['state'])->first()->cities()->get() as $city)

                                <?php

                                $checked = '';

                                if ($_GET['city'] == $city->id) {

                                    $checked = 'checked';
                                }

                                ?>

                                <div class='checkBoxCon' onclick='selectCity(event)'>
                                    <input type='radio' name='city' id='city{{ $loop->iteration }}' value='{{ $city->id }}' <?= $checked ?>>
                                    <label for='city{{ $loop->iteration }}'>
                                        <div class='check_box'>
                                            <div class='checked'>
                                                <i class='fi fi-br-check'></i>
                                                <div class="loading-spinner-checkbox"></div>
                                            </div>
                                        </div>
                                        <span> {{ $city->{'city_name_' . session('lang')} }} </span>
                                    </label>
                                </div>


                                @endforeach

                            <?php

                            } else if (isset($_GET['country']) && isset($_GET['state']) && !isset($_GET['city'])) {

                            ?>
                                @foreach(App\Models\State::where("id" , $_GET['state'])->first()->cities()->get() as $city)


                                <div class='checkBoxCon' onclick='selectCity(event)'>
                                    <input type='radio' name='city' id='city{{ $loop->iteration }}' value='{{ $city->id }}'>
                                    <label for='city{{ $loop->iteration }}'>
                                        <div class='check_box'>
                                            <div class='checked'>
                                                <i class='fi fi-br-check'></i>
                                                <div class="loading-spinner-checkbox"></div>
                                            </div>
                                        </div>
                                        <span> {{ $city->{'city_name_' . session('lang')} }} </span>
                                    </label>
                                </div>


                                @endforeach
                            <?php

                            } else {

                            ?>
                                <div class="empty_filter">
                                    {{ __('message.choose_state') }}
                                </div>
                            <?php

                            }

                            ?>



                        </div>
                    </div>
                </div>
                <div class="filter_box_con">
                    <div class="filter_box_top">
                        <div class="right">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M7 0H4a4 4 0 0 0-4 4v3a4 4 0 0 0 4 4h3a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4Zm2 7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2ZM20 0h-3a4 4 0 0 0-4 4v3a4 4 0 0 0 4 4h3a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4Zm2 7a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2ZM7 13H4a4 4 0 0 0-4 4v3a4 4 0 0 0 4 4h3a4 4 0 0 0 4-4v-3a4 4 0 0 0-4-4Zm2 7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2ZM20 13h-3a4 4 0 0 0-4 4v3a4 4 0 0 0 4 4h3a4 4 0 0 0 4-4v-3a4 4 0 0 0-4-4Zm2 7a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2Z" fill="#2a2d53" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                            <p class="title"> {{ __("message.filter_title__main_catergories") }} </p>
                        </div>
                        <svg class="arrow" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="filter_box_bottom">
                        <div class="filter_content_sec mainCategory">

                            @if(App\Models\MainCategory::all()->count() > 0)
                            @foreach(App\Models\MainCategory::all() as $category)

                            <?php

                            $checked = '';

                            if (isset($_GET['category'])) {

                                if ($_GET['category'] == $category->id) {

                                    $checked = 'checked';
                                }
                            }

                            ?>

                            <div class="checkBoxCon" onclick="getSubs(event,<?= $category->id ?>)">
                                <input type="checkbox" name="category" id="category{{ $loop->iteration }}" value="{{$category->id}}" <?= $checked ?>>
                                <label for="category{{ $loop->iteration }}">
                                    <div class="check_box">
                                        <div class="checked">
                                            <i class="fi fi-br-check"></i>
                                            <div class="loading-spinner-checkbox"></div>
                                        </div>
                                    </div>
                                    <span> {{ $category->{'category_name_' . session("lang")} }} </span>
                                </label>
                            </div>

                            @endforeach
                            @else
                            <div class="empty_filter">
                                {{ __('message.noCategory') }}
                            </div>
                            @endif


                        </div>
                    </div>
                </div>
                <div class="filter_box_con">
                    <div class="filter_box_top">
                        <div class="right">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M19 2h-1V1a1 1 0 0 0-2 0v1H8V1a1 1 0 0 0-2 0v1H5a5.006 5.006 0 0 0-5 5v12a5.006 5.006 0 0 0 5 5h14a5.006 5.006 0 0 0 5-5V7a5.006 5.006 0 0 0-5-5ZM2 7a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v1H2Zm17 15H5a3 3 0 0 1-3-3v-9h20v9a3 3 0 0 1-3 3Z" fill="#2a2d53" data-original="#000000" class=""></path>
                                    <circle cx="12" cy="15" r="1.5" fill="#2a2d53" data-original="#000000" class=""></circle>
                                    <circle cx="7" cy="15" r="1.5" fill="#2a2d53" data-original="#000000" class=""></circle>
                                    <circle cx="17" cy="15" r="1.5" fill="#2a2d53" data-original="#000000" class=""></circle>
                                </g>
                            </svg>
                            <p class="title"> {{ __("message.filter_title_catergories") }} </p>
                        </div>
                        <svg class="arrow" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="filter_box_bottom">
                        <div class="filter_content_sec subs">

                            <?php

                            if (isset($_GET['category']) && isset($_GET['subcategory'])) {

                            ?>

                                @foreach(App\Models\MainCategory::where('id' , $_GET['category'])->first()->subcategories()->get() as $sub)

                                <?php

                                $checked = '';

                                if ($_GET['subcategory'] == $sub->id) {

                                    $checked = 'checked';
                                }

                                ?>

                                <div class='checkBoxCon' onclick='selectsubcategory(event)'>
                                    <input type='radio' name='subcategory' id='subcategory{{ $loop->iteration }}' value='{{ $sub->id }}' <?= $checked ?>>
                                    <label for='subcategory{{ $loop->iteration }}'>
                                        <div class='check_box'>
                                            <div class='checked'>
                                                <i class='fi fi-br-check'></i>
                                                <div class="loading-spinner-checkbox"></div>
                                            </div>
                                        </div>
                                        <span> {{ $sub->{'subcategory_name_' . session('lang')} }} </span>
                                    </label>
                                </div>

                                @endforeach

                            <?php

                            } else if (isset($_GET['category']) && !isset($_GET['subcategory'])) {

                            ?>
                                @foreach(App\Models\MainCategory::where('id' , $_GET['category'])->first()->subcategories()->get() as $sub)



                                <div class='checkBoxCon' onclick='selectsubcategory(event)'>
                                    <input type='radio' name='subcategory' id='subcategory{{ $loop->iteration }}' value='{{ $sub->id }}'>
                                    <label for='subcategory{{ $loop->iteration }}'>
                                        <div class='check_box'>
                                            <div class='checked'>
                                                <i class='fi fi-br-check'></i>
                                                <div class="loading-spinner-checkbox"></div>
                                            </div>
                                        </div>
                                        <span> {{ $sub->{'subcategory_name_' . session('lang')} }} </span>
                                    </label>
                                </div>

                                @endforeach
                            <?php

                            } else {

                            ?>
                                <div class="empty_filter">
                                    {{ __('message.choose_category') }}
                                </div>
                            <?php

                            }


                            ?>

                        </div>
                    </div>
                </div>
                <div class="filter_box_con">
                    <div class="filter_box_top">
                        <div class="right">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M1 4.75h2.736a3.728 3.728 0 0 0 7.195 0H23a1 1 0 0 0 0-2H10.931a3.728 3.728 0 0 0-7.195 0H1a1 1 0 0 0 0 2ZM7.333 2a1.75 1.75 0 1 1-1.75 1.75A1.752 1.752 0 0 1 7.333 2ZM23 11h-2.736a3.727 3.727 0 0 0-7.194 0H1a1 1 0 0 0 0 2h12.07a3.727 3.727 0 0 0 7.194 0H23a1 1 0 0 0 0-2Zm-6.333 2.75a1.75 1.75 0 1 1 1.75-1.75 1.752 1.752 0 0 1-1.75 1.75ZM23 19.25H10.931a3.728 3.728 0 0 0-7.195 0H1a1 1 0 0 0 0 2h2.736a3.728 3.728 0 0 0 7.195 0H23a1 1 0 0 0 0-2ZM7.333 22a1.75 1.75 0 1 1 1.75-1.75A1.753 1.753 0 0 1 7.333 22Z" fill="#2a2d53" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                            <p class="title"> {{ __("message.filter_title_main") }} </p>
                        </div>
                        <svg class="arrow" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="filter_box_bottom">
                        <?php

                        $checked = '';

                        if (isset($_GET['newest'])) {

                            $checked = 'checked';
                        }

                        ?>
                        <div class="filter_content_sec order">
                            <div class="checkBoxCon" onclick="selectOrder(event)">
                                <input type="checkbox" name="newest" id="newest" <?= $checked ?>>
                                <label for="newest">
                                    <div class="check_box">
                                        <div class="checked">
                                            <i class="fi fi-br-check"></i>
                                        </div>
                                    </div>
                                    <span> جدیدترین </span>
                                </label>
                            </div>
                            <?php

                            $checked = '';

                            if (isset($_GET['controversial'])) {

                                $checked = 'checked';
                            }

                            ?>
                            <div class="checkBoxCon" onclick="selectOrder(event)">
                                <input type="checkbox" name="controversial" id="controversial" <?= $checked ?>>
                                <label for="controversial">
                                    <div class="check_box">
                                        <div class="checked">
                                            <i class="fi fi-br-check"></i>
                                        </div>
                                    </div>
                                    <span> پربحث ترین </span>
                                </label>
                            </div>
                            <?php

                            $checked = '';

                            if (isset($_GET['populer'])) {

                                $checked = 'checked';
                            }

                            ?>
                            <div class="checkBoxCon" onclick="selectOrder(event)">
                                <input type="checkbox" name="populer" id="populer" <?= $checked ?>>
                                <label for="populer">
                                    <div class="check_box">
                                        <div class="checked">
                                            <i class="fi fi-br-check"></i>
                                        </div>
                                    </div>
                                    <span> محبوب ترین </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="add_filter_btn">
                    {{ __("message.addFilter") }}
                </button>

            </form>
        </div>
        <div class="left_all">

            <div class="FilterXS_container">
                <div class="filterXS_btns">
                    <svg fill="none" stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                    <span> {{ __('message.Filter_title') }} </span>
                </div>
                <div class="filterXS_btns">
                    <svg fill="none" stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                    </svg>
                    <span> {{ __('message.filter_title_main') }} </span>
                </div>
            </div>

            <div class="JobsAll">

                @if($Jobs != [] || $Jobs != null)

                    @if(gettype($Jobs) != "string")

                        @foreach($Jobs as $job)

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
                                <a href="/Job/{{ $job->id }}">
                                    {{ __('message.seeMore') }}
                                    <svg xmlns="http://www.w3.org/2000/svg" id="Layer_2" data-name="Layer 2" viewBox="0 0 20 20">
                                        <g id="Layer_1-2" data-name="Layer 1">
                                            <g>
                                                <path d="M10,20C2.62,20,0,17.38,0,10S2.62,0,10,0s10,2.62,10,10c0,6.19-1.95,9.02-6.72,9.78-.4,.06-.79-.21-.86-.62-.06-.41,.21-.79,.62-.86,4.03-.64,5.45-2.81,5.45-8.29,0-6.51-1.99-8.5-8.5-8.5S1.5,3.49,1.5,10s1.99,8.5,8.5,8.5c.41,0,.75,.34,.75,.75s-.34,.75-.75,.75Z"></path>
                                                <path d="M11.44,14.22c-.15,0-.29-.04-.42-.13-1.42-.98-3.81-2.81-3.81-4.09s2.38-3.11,3.81-4.09c.34-.23,.81-.15,1.04,.19,.23,.34,.15,.81-.19,1.04-1.58,1.09-3.06,2.44-3.16,2.88,.1,.39,1.57,1.73,3.16,2.82,.34,.23,.43,.7,.19,1.04-.15,.21-.38,.33-.62,.33Z"></path>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        @endforeach

                    @else

                    {!! $Jobs !!}

                    @endif

                @else

                <div class="emptyResults"> {{ __("message.NoJobsAdded") }} </div>

                @endif

            </div>

            @if($Jobs != [] || $Jobs != null)

                @if(gettype($Jobs) != "string")

                {{ $Jobs->onEachSide(1)->links() }}

                @endif

            @endif
            

        </div>
    </div>
</div>


<form action="/AllJobs/Filter" class="filter_all_formXS" method="get">
    <div class="filter_shadow"></div>
    <div class="drp_filterXS_box filter_all">
        <div class="top">
            <p> {{ __('message.Filter_title') }} </p>
            <ion-icon name="close-outline" class="exit_filterXS"></ion-icon>
        </div>
        <div class="bottom">
            <div class="filter_box_con">
                <div class="filter_box_top">
                    <div class="right">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M20 4h-5a4 4 0 0 0-4-4H4a4 4 0 0 0-4 4v19a1 1 0 0 0 2 0V13h8a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V8a4 4 0 0 0-4-4zM2 11V4a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2zm20 2a2 2 0 0 1-2 2h-6a2 2 0 0 1-2-2v-.142A4 4 0 0 0 15 9V6h5a2 2 0 0 1 2 2z" fill="#2a2d53" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <p class="title"> {{ __("message.filter_title_countrys") }} </p>
                    </div>
                    <svg class="arrow" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div class="filter_box_bottom">
                    <div class="filter_content_sec country XS">

                        <?php

                        if (isset($_GET['country'])) {

                        ?>
                            @foreach(App\Models\Country::all() as $country)

                            <?php

                            $checked = '';

                            if ($_GET['country'] == $country->id) {

                                $checked = 'checked';
                            }

                            ?>

                            <div class="checkBoxCon" onclick="getState(event,<?= $country->id ?>)">
                                <input type="radio" name="country" id="country{{ $loop->iteration }}" value="{{ $country->id }}" <?= $checked ?>>
                                <label for="country{{ $loop->iteration }}">
                                    <div class="check_box">
                                        <div class="checked">
                                            <i class="fi fi-br-check"></i>
                                            <div class="loading-spinner-checkbox"></div>
                                        </div>
                                    </div>
                                    <span> {{ $country->{'country_name_' . session("lang")} }} </span>
                                </label>
                            </div>

                            @endforeach
                        <?php

                        } else {

                        ?>
                            @foreach(App\Models\Country::all() as $country)



                            <div class="checkBoxCon" onclick="getState(event,<?= $country->id ?>)">
                                <input type="radio" name="country" id="country{{ $loop->iteration }}" value="{{ $country->id }}">
                                <label for="country{{ $loop->iteration }}">
                                    <div class="check_box">
                                        <div class="checked">
                                            <i class="fi fi-br-check"></i>
                                            <div class="loading-spinner-checkbox"></div>
                                        </div>
                                    </div>
                                    <span> {{ $country->{'country_name_' . session("lang")} }} </span>
                                </label>
                            </div>

                            @endforeach
                        <?php

                        }

                        ?>

                    </div>
                </div>
            </div>
            <div class="filter_box_con">
                <div class="filter_box_top">
                    <div class="right">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M12 6a4 4 0 1 0 4 4 4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2 2 2 0 0 1-2 2Z" fill="#2a2d53" data-original="#000000"></path>
                                <path d="M12 24a5.271 5.271 0 0 1-4.311-2.2c-3.811-5.257-5.744-9.209-5.744-11.747a10.055 10.055 0 0 1 20.11 0c0 2.538-1.933 6.49-5.744 11.747A5.271 5.271 0 0 1 12 24Zm0-21.819a7.883 7.883 0 0 0-7.874 7.874c0 2.01 1.893 5.727 5.329 10.466a3.145 3.145 0 0 0 5.09 0c3.436-4.739 5.329-8.456 5.329-10.466A7.883 7.883 0 0 0 12 2.181Z" fill="#2a2d53" data-original="#000000"></path>
                            </g>
                        </svg>
                        <p class="title"> {{ __("message.filter_title_states") }} </p>
                    </div>
                    <svg class="arrow" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div class="filter_box_bottom">
                    <div class="filter_content_sec state XS">

                        <?php

                        if (isset($_GET['country']) && isset($_GET['state'])) {


                        ?>

                            @foreach(App\Models\Country::where('id' , $_GET['country'])->first()->states()->get() as $state)

                            <?php

                            $checked = '';

                            if ($_GET['state'] == $state->id) {

                                $checked = 'checked';
                            }

                            ?>

                            <div class='checkBoxCon' onclick='getCity(event,<?= $state->id ?>)'>
                                <input type='radio' name='state' id='state{{ $loop->iteration }}' value='{{ $state->id }}' <?= $checked ?>>
                                <label for='state{{ $loop->iteration }}'>
                                    <div class='check_box'>
                                        <div class='checked'>
                                            <i class='fi fi-br-check'></i>
                                            <div class="loading-spinner-checkbox"></div>
                                        </div>
                                    </div>
                                    <span> {{ $state->{'state_name_' . session('lang')} }} </span>
                                </label>
                            </div>

                            @endforeach

                        <?php


                        } else if (isset($_GET['country']) && !isset($_GET['state'])) {

                        ?>
                            @foreach(App\Models\Country::where('id' , $_GET['country'])->first()->states()->get() as $state)


                            <div class='checkBoxCon' onclick='getCity(event,<?= $state->id ?>)'>
                                <input type='radio' name='state' id='state{{ $loop->iteration }}' value='{{ $state->id }}'>
                                <label for='state{{ $loop->iteration }}'>
                                    <div class='check_box'>
                                        <div class='checked'>
                                            <i class='fi fi-br-check'></i>
                                            <div class="loading-spinner-checkbox"></div>
                                        </div>
                                    </div>
                                    <span> {{ $state->{'state_name_' . session('lang')} }} </span>
                                </label>
                            </div>

                            @endforeach
                        <?php

                        } else {

                        ?>
                            <div class="empty_filter">
                                {{ __('message.choose_country') }}
                            </div>
                        <?php

                        }

                        ?>



                    </div>
                </div>
            </div>
            <div class="filter_box_con">
                <div class="filter_box_top">
                    <div class="right">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M19 15h-1a1 1 0 1 1 0-2h1a1 1 0 1 1 0 2Zm1 3a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2h1a1 1 0 0 0 1-1ZM16 6a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2h1a1 1 0 0 0 1-1Zm4 0a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2h1a1 1 0 0 0 1-1Zm0 4a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2h1a1 1 0 0 0 1-1Zm4 9V5c0-2.757-2.243-5-5-5h-5c-2.757 0-5 2.243-5 5a1 1 0 1 0 2 0c0-1.654 1.346-3 3-3h5c1.654 0 3 1.346 3 3v14c0 1.654-1.346 3-3 3h-1a1 1 0 1 0 0 2h1c2.757 0 5-2.243 5-5Zm-8 .5v-4.152a4.972 4.972 0 0 0-1.919-3.938l-3-2.349a4.993 4.993 0 0 0-6.162 0l-3 2.348A4.97 4.97 0 0 0 0 15.347v4.152c0 2.481 2.019 4.5 4.5 4.5h7c2.481 0 4.5-2.019 4.5-4.5Zm-6.151-8.863 3 2.348A2.986 2.986 0 0 1 14 15.348V19.5c0 1.379-1.121 2.5-2.5 2.5h-7A2.502 2.502 0 0 1 2 19.5v-4.152c0-.929.42-1.79 1.151-2.363l3-2.347a2.993 2.993 0 0 1 3.698-.001ZM10 18v-2a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1Z" fill="#2a2d53" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <p class="title"> {{ __("message.filter_title_cities") }} </p>
                    </div>
                    <svg class="arrow" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div class="filter_box_bottom">
                    <div class="filter_content_sec city XS">

                        <?php

                        if (isset($_GET['country']) && isset($_GET['state']) && isset($_GET['city'])) {

                        ?>

                            @foreach(App\Models\State::where("id" , $_GET['state'])->first()->cities()->get() as $city)

                            <?php

                            $checked = '';

                            if ($_GET['city'] == $city->id) {

                                $checked = 'checked';
                            }

                            ?>

                            <div class='checkBoxCon' onclick='selectCity(event)'>
                                <input type='radio' name='city' id='city{{ $loop->iteration }}' value='{{ $city->id }}' <?= $checked ?>>
                                <label for='city{{ $loop->iteration }}'>
                                    <div class='check_box'>
                                        <div class='checked'>
                                            <i class='fi fi-br-check'></i>
                                            <div class="loading-spinner-checkbox"></div>
                                        </div>
                                    </div>
                                    <span> {{ $city->{'city_name_' . session('lang')} }} </span>
                                </label>
                            </div>


                            @endforeach

                        <?php

                        } else if (isset($_GET['country']) && isset($_GET['state']) && !isset($_GET['city'])) {

                        ?>
                            @foreach(App\Models\State::where("id" , $_GET['state'])->first()->cities()->get() as $city)


                            <div class='checkBoxCon' onclick='selectCity(event)'>
                                <input type='radio' name='city' id='city{{ $loop->iteration }}' value='{{ $city->id }}'>
                                <label for='city{{ $loop->iteration }}'>
                                    <div class='check_box'>
                                        <div class='checked'>
                                            <i class='fi fi-br-check'></i>
                                            <div class="loading-spinner-checkbox"></div>
                                        </div>
                                    </div>
                                    <span> {{ $city->{'city_name_' . session('lang')} }} </span>
                                </label>
                            </div>


                            @endforeach
                        <?php

                        } else {

                        ?>
                            <div class="empty_filter">
                                {{ __('message.choose_state') }}
                            </div>
                        <?php

                        }

                        ?>



                    </div>
                </div>
            </div>
            <div class="filter_box_con">
                <div class="filter_box_top">
                    <div class="right">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M7 0H4a4 4 0 0 0-4 4v3a4 4 0 0 0 4 4h3a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4Zm2 7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2ZM20 0h-3a4 4 0 0 0-4 4v3a4 4 0 0 0 4 4h3a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4Zm2 7a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2ZM7 13H4a4 4 0 0 0-4 4v3a4 4 0 0 0 4 4h3a4 4 0 0 0 4-4v-3a4 4 0 0 0-4-4Zm2 7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2ZM20 13h-3a4 4 0 0 0-4 4v3a4 4 0 0 0 4 4h3a4 4 0 0 0 4-4v-3a4 4 0 0 0-4-4Zm2 7a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2Z" fill="#2a2d53" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <p class="title"> {{ __("message.filter_title__main_catergories") }} </p>
                    </div>
                    <svg class="arrow" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div class="filter_box_bottom">
                    <div class="filter_content_sec mainCategory XS">

                        @foreach(App\Models\MainCategory::all() as $category)

                        <?php

                        $checked = '';

                        if (isset($_GET['category'])) {

                            if ($_GET['category'] == $category->id) {

                                $checked = 'checked';
                            }
                        }

                        ?>

                        <div class="checkBoxCon" onclick="getSubs(event,<?= $category->id ?>)">
                            <input type="checkbox" name="category" id="category{{ $loop->iteration }}" value="{{$category->id}}" <?= $checked ?>>
                            <label for="category{{ $loop->iteration }}">
                                <div class="check_box">
                                    <div class="checked">
                                        <i class="fi fi-br-check"></i>
                                        <div class="loading-spinner-checkbox"></div>
                                    </div>
                                </div>
                                <span> {{ $category->{'category_name_' . session("lang")} }} </span>
                            </label>
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>
            <div class="filter_box_con">
                <div class="filter_box_top">
                    <div class="right">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M19 2h-1V1a1 1 0 0 0-2 0v1H8V1a1 1 0 0 0-2 0v1H5a5.006 5.006 0 0 0-5 5v12a5.006 5.006 0 0 0 5 5h14a5.006 5.006 0 0 0 5-5V7a5.006 5.006 0 0 0-5-5ZM2 7a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v1H2Zm17 15H5a3 3 0 0 1-3-3v-9h20v9a3 3 0 0 1-3 3Z" fill="#2a2d53" data-original="#000000" class=""></path>
                                <circle cx="12" cy="15" r="1.5" fill="#2a2d53" data-original="#000000" class=""></circle>
                                <circle cx="7" cy="15" r="1.5" fill="#2a2d53" data-original="#000000" class=""></circle>
                                <circle cx="17" cy="15" r="1.5" fill="#2a2d53" data-original="#000000" class=""></circle>
                            </g>
                        </svg>
                        <p class="title"> {{ __("message.filter_title_catergories") }} </p>
                    </div>
                    <svg class="arrow" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div class="filter_box_bottom">
                    <div class="filter_content_sec subs XS">

                        <?php

                        if (isset($_GET['category']) && isset($_GET['subcategory'])) {

                        ?>

                            @foreach(App\Models\MainCategory::where('id' , $_GET['category'])->first()->subcategories()->get() as $sub)

                            <?php

                            $checked = '';

                            if ($_GET['subcategory'] == $sub->id) {

                                $checked = 'checked';
                            }

                            ?>

                            <div class='checkBoxCon' onclick='selectsubcategory(event)'>
                                <input type='radio' name='subcategory' id='subcategory{{ $loop->iteration }}' value='{{ $sub->id }}' <?= $checked ?>>
                                <label for='subcategory{{ $loop->iteration }}'>
                                    <div class='check_box'>
                                        <div class='checked'>
                                            <i class='fi fi-br-check'></i>
                                            <div class="loading-spinner-checkbox"></div>
                                        </div>
                                    </div>
                                    <span> {{ $sub->{'subcategory_name_' . session('lang')} }} </span>
                                </label>
                            </div>

                            @endforeach

                        <?php

                        } else if (isset($_GET['category']) && !isset($_GET['subcategory'])) {

                        ?>
                            @foreach(App\Models\MainCategory::where('id' , $_GET['category'])->first()->subcategories()->get() as $sub)



                            <div class='checkBoxCon' onclick='selectsubcategory(event)'>
                                <input type='radio' name='subcategory' id='subcategory{{ $loop->iteration }}' value='{{ $sub->id }}'>
                                <label for='subcategory{{ $loop->iteration }}'>
                                    <div class='check_box'>
                                        <div class='checked'>
                                            <i class='fi fi-br-check'></i>
                                            <div class="loading-spinner-checkbox"></div>
                                        </div>
                                    </div>
                                    <span> {{ $sub->{'subcategory_name_' . session('lang')} }} </span>
                                </label>
                            </div>

                            @endforeach
                        <?php

                        } else {

                        ?>
                            <div class="empty_filter">
                                {{ __('message.choose_category') }}
                            </div>
                        <?php

                        }


                        ?>

                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="add_filter_btn">
            {{ __("message.addFilter") }}
        </button>
    </div>
    <div class="drp_filterXS_box filter_main">
        <div class="top">
            <p> {{ __('message.Filter_title') }} </p>
            <ion-icon name="close-outline" class="exit_filterXS"></ion-icon>
        </div>
        <div class="bottom">
            <div class="filter_box_con">
                <div class="filter_box_top">
                    <div class="right">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path d="M1 4.75h2.736a3.728 3.728 0 0 0 7.195 0H23a1 1 0 0 0 0-2H10.931a3.728 3.728 0 0 0-7.195 0H1a1 1 0 0 0 0 2ZM7.333 2a1.75 1.75 0 1 1-1.75 1.75A1.752 1.752 0 0 1 7.333 2ZM23 11h-2.736a3.727 3.727 0 0 0-7.194 0H1a1 1 0 0 0 0 2h12.07a3.727 3.727 0 0 0 7.194 0H23a1 1 0 0 0 0-2Zm-6.333 2.75a1.75 1.75 0 1 1 1.75-1.75 1.752 1.752 0 0 1-1.75 1.75ZM23 19.25H10.931a3.728 3.728 0 0 0-7.195 0H1a1 1 0 0 0 0 2h2.736a3.728 3.728 0 0 0 7.195 0H23a1 1 0 0 0 0-2ZM7.333 22a1.75 1.75 0 1 1 1.75-1.75A1.753 1.753 0 0 1 7.333 22Z" fill="#2a2d53" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <p class="title"> {{ __("message.filter_title_main") }} </p>
                    </div>
                    <svg class="arrow" stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div class="filter_box_bottom">
                    <?php

                    $checked = '';

                    if (isset($_GET['newest'])) {

                        $checked = 'checked';
                    }

                    ?>
                    <div class="filter_content_sec order">
                        <div class="checkBoxCon" onclick="selectOrder(event)">
                            <input type="checkbox" name="newest" id="newest" <?= $checked ?>>
                            <label for="newest">
                                <div class="check_box">
                                    <div class="checked">
                                        <i class="fi fi-br-check"></i>
                                    </div>
                                </div>
                                <span> جدیدترین </span>
                            </label>
                        </div>
                        <?php

                        $checked = '';

                        if (isset($_GET['controversial'])) {

                            $checked = 'checked';
                        }

                        ?>
                        <div class="checkBoxCon" onclick="selectOrder(event)">
                            <input type="checkbox" name="controversial" id="controversial" <?= $checked ?>>
                            <label for="controversial">
                                <div class="check_box">
                                    <div class="checked">
                                        <i class="fi fi-br-check"></i>
                                    </div>
                                </div>
                                <span> پربحث ترین </span>
                            </label>
                        </div>
                        <?php

                        $checked = '';

                        if (isset($_GET['populer'])) {

                            $checked = 'checked';
                        }

                        ?>
                        <div class="checkBoxCon" onclick="selectOrder(event)">
                            <input type="checkbox" name="populer" id="populer" <?= $checked ?>>
                            <label for="populer">
                                <div class="check_box">
                                    <div class="checked">
                                        <i class="fi fi-br-check"></i>
                                    </div>
                                </div>
                                <span> محبوب ترین </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="add_filter_btn">
            {{ __("message.addFilter") }}
        </button>
    </div>
</form>

@endsection


@section('js_links')

<script defer src="/website/Js/like.js"></script>
<script defer src="/website/Js/AllJobs/Filter.js"></script>

@endsection