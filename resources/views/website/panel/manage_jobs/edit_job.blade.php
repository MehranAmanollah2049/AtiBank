@extends('website.panel.manage_jobs.master')


@section('css_links')
@parent

<link rel="stylesheet" href="/website/Css/Panel/manage_jobs/add_job.css">


@endsection

@section('job_manage_content')



<form action="/panel/job/{{ $job->id }}/edit" method="post" enctype="multipart/form-data" class="add_Job_from">

    <div class="UploadJobImageCon">
        <input type="file" style="display: none;" name="banner" id="file">
        <div class="uploadPlace uploaded">
            <label for="file" style="background-image: url(/<?= $job->banner ?>);">
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
            <label> {{ __('message.sign_up_county') }} </label>
            <select class="form-control select2 selectCountry" style="width: 100%;" name="country_id" value="{{ old('country_id') }}">
                <option selected="selected" value=""> {{ __('message.choose') }} </option>
                @foreach(App\Models\Country::all() as $country)
                @if($job->city()->first()->state()->first()->country()->first()->id == $country->id)
                <option value="{{ $country->id }}" selected> {{ $country->country_name_fa }} </option>
                @else
                <option value="{{ $country->id }}"> {{ $country->{'country_name_' . session('lang')} }} </option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="ints_sec">
            <label>{{ __('message.sign_up_state') }}</label>
            <select class="form-control select2 selectState" style="width: 100%;" name="state_id" value="{{ old('state_id') }}">
                <option selected="selected" value=""> {{ __('message.choose') }} </option>
                @foreach($job->city()->first()->state()->first()->country()->first()->states()->get() as $state)
                @if($job->city()->first()->state()->first()->id == $state->id)
                <option value="{{ $state->id }}" selected> {{ $state->{'state_name_' . session("lang")} }} </option>
                @else
                <option value="{{ $state->id }}"> {{ $state->{'state_name_' . session("lang")} }} </option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="ints_sec">
            <label> {{ __('message.sign_up_city') }}</label>
            <select class="form-control select2 selectCity" style="width: 100%;" name="city_id" value="{{ old('city_id') }}">
                <option selected="selected" value=""> {{ __('message.choose') }} </option>
                @foreach($job->city()->first()->state()->first()->cities()->get() as $city)
                @if($job->city_id == $city->id)
                <option value="{{ $city->id }}" selected> {{ $city->{'city_name_' . session('lang')} }} </option>
                @else
                <option value="{{ $city->id }}"> {{ $city->{'city_name_' . session('lang')} }} </option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="ints_sec">
            <label> {{ __('message.main_catergories') }} </label>
            <select class="form-control select2 selectMainCategory" style="width: 100%;" name="category_id" value="{{ old('category_id') }}">
                <option selected="selected" value=""> {{ __('message.choose') }} </option>
                @foreach(App\Models\MainCategory::all() as $catagory)
                @if($job->subcategory()->first()->category()->first()->id == $catagory->id)
                <option value="{{ $catagory->id }}" selected> {{ $catagory->{'category_name_' . session('lang')} }} </option>
                @else
                <option value="{{ $catagory->id }}"> {{ $catagory->{'category_name_' . session('lang')} }} </option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="ints_sec">
            <label>{{ __('message.sub_category') }}</label>
            <select class="form-control select2 selectSubCategory" style="width: 100%;" name="subcategory_id" value="{{ old('subcategory_id') }}">
                <option selected="selected" value=""> {{ __('message.choose') }} </option>
                @foreach($job->subcategory()->first()->category()->first()->subcategories()->get() as $subcatagory)
                @if($job->subcategory_id == $subcatagory->id)
                <option value="{{ $subcatagory->id }}" selected> {{ $subcatagory->{'subcategory_name_' . session('lang')} }} </option>
                @else
                <option value="{{ $subcatagory->id }}"> {{ $subcatagory->{'subcategory_name_' . session('lang')} }} </option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.job_title_fa') }} </label>
            <input type="text" name="job_name_fa" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->job_name_fa }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.job_title_en') }} </label>
            <input type="text" name="job_name_en" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->job_name_en }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.job_title_ar') }} </label>
            <input type="text" name="job_name_ar" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->job_name_ar }}">
        </div>
        <div class="ints_sec textarea_sec">
            <label for="exampleInputEmail1"> {{ __('message.description_fa') }} </label>
            <textarea type="text" style="max-width: 100% !important;" name="description_fa" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}">{{ $job->description_fa }}</textarea>
        </div>
        <div class="ints_sec textarea_sec">
            <label for="exampleInputEmail1"> {{ __('message.description_en') }} </label>
            <textarea type="text" style="max-width: 100% !important;" name="description_en" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}">{{ $job->description_en }}</textarea>
        </div>
        <div class="ints_sec textarea_sec">
            <label for="exampleInputEmail1"> {{ __('message.description_ar') }} </label>
            <textarea type="text" style="max-width: 100% !important;" name="description_ar" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}">{{ $job->description_ar }}</textarea>
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __("message.manager_name_fa") }} </label>
            <input type="text" name="manager_name_fa" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->manager_name_fa }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1">{{ __("message.manager_name_en") }}</label>
            <input type="text" name="manager_name_en" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->manager_name_en }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1">{{ __("message.manager_name_ar") }}</label>
            <input type="text" name="manager_name_ar" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->manager_name_ar }}">
        </div>
        <div class="ints_sec phoneNum">
            <label for="exampleInputEmail1"> {{ __('message.phoneNumber') }} </label>
            <input type="text" name="phoneNumber" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->phoneNumber }}" readonly>
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.address_fa') }} </label>
            <input type="text" name="address_fa" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->address_fa }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.address_en') }}</label>
            <input type="text" name="address_en" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->address_en }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.address_ar') }}</label>
            <input type="text" name="address_ar" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->address_ar }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.log') }} </label>
            <input type="text" name="longitude" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->longitude }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.lat') }} </label>
            <input type="text" name="latitude" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->latitude }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.timeWork_sat') }} </label>
            <input type="text" name="saturday_time_work" class="form-control" id="exampleInputEmail1" placeholder="08:00-13:00 15:00-20:00" value="{{ $job->saturday_time_work }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.timeWork_sun') }}</label>
            <input type="text" name="sunday_time_work" class="form-control" id="exampleInputEmail1" placeholder="08:00-13:00 15:00-20:00" value="{{ $job->sunday_time_work }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.timeWork_mon') }}</label>
            <input type="text" name="monday_time_work" class="form-control" id="exampleInputEmail1" placeholder="08:00-13:00 15:00-20:00" value="{{ $job->monday_time_work }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.timeWork_tue') }}</label>
            <input type="text" name="tusday_time_work" class="form-control" id="exampleInputEmail1" placeholder="08:00-13:00 15:00-20:00" value="{{ $job->tusday_time_work }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.timeWork_wed') }}</label>
            <input type="text" name="wednesday_time_work" class="form-control" id="exampleInputEmail1" placeholder="08:00-13:00 15:00-20:00" value="{{ $job->wednesday_time_work }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.timeWork_thu') }}</label>
            <input type="text" name="thursday_time_work" class="form-control" id="exampleInputEmail1" placeholder="08:00-13:00 15:00-20:00" value="{{ $job->thursday_time_work }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.timeWork_fri') }}</label>
            <input type="text" name="friday_time_work" class="form-control" id="exampleInputEmail1" placeholder="08:00-13:00 15:00-20:00" value="{{ $job->friday_time_work }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.insta_field') }} </label>
            <input type="text" name="instagram" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->instagram }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.telegram_field') }}</label>
            <input type="text" name="telegram" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->telegram }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.email_field') }}</label>
            <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->email }}">
        </div>
        <div class="ints_sec">
            <label for="exampleInputEmail1"> {{ __('message.website_field') }}</label>
            <input type="text" name="website_url" class="form-control" id="exampleInputEmail1" placeholder="{{ __('message.write_infos_here') }}" value="{{ $job->website_url }}">
        </div>

        <button type="button" class="submitBtn">
            {{ __('message.edit_job_btn') }}
        </button>

    </div>

    @csrf
    @method("put")
</form>

@endsection



@section("js_links")

<script defer src="/website/Js/panel/manage_jobs/uploadImage.js"></script>
<script defer src="/website/Js/panel/manage_jobs/validation_edit_<?= session('lang') ?>.js"></script>
<script defer src="/website/Js/panel/manage_jobs/SelectGet.js"></script>
<script defer src="/website/Js/panel/manage_jobs/phone.js"></script>

@endsection