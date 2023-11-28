@extends('website.panel.panel_layouts.MasterPanel')

@section("title_page" , 'مدیریت مشاغل')

@section('css_links')

<link rel="stylesheet" href="/website/Css/Panel/manage_jobs/main.css">

@endsection


@section('panel_content')


<div class="allJobManage">
    <div class="right_job_manage">
        <div class="manage_jobs_btns{{ $sideBarPanel2 == 'jobs_manage_add' ? ' active' : '' }}">
            <a href="/panel/JobMangement">
                <div class="icon_sec">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M85.333 0h64c47.128 0 85.333 38.205 85.333 85.333v64c0 47.128-38.205 85.333-85.333 85.333h-64C38.205 234.667 0 196.462 0 149.333v-64C0 38.205 38.205 0 85.333 0zM85.333 277.333h64c47.128 0 85.333 38.205 85.333 85.333v64c0 47.128-38.205 85.333-85.333 85.333h-64C38.205 512 0 473.795 0 426.667v-64c0-47.129 38.205-85.334 85.333-85.334zM362.667 277.333h64c47.128 0 85.333 38.205 85.333 85.333v64C512 473.795 473.795 512 426.667 512h-64c-47.128 0-85.333-38.205-85.333-85.333v-64c-.001-47.129 38.204-85.334 85.333-85.334zM298.667 149.333h64v64c0 11.782 9.551 21.333 21.333 21.333 11.782 0 21.333-9.551 21.333-21.333v-64h64c11.782 0 21.333-9.551 21.333-21.333s-9.551-21.333-21.333-21.333h-64v-64c0-11.782-9.551-21.333-21.333-21.333-11.782 0-21.333 9.551-21.333 21.333v64h-64c-11.782 0-21.333 9.551-21.333 21.333s9.551 21.333 21.333 21.333z" data-original="#000000" class=""></path>
                        </g>
                    </svg>
                </div>
                <span> {{ __('message.add_job') }} </span>
            </a>
        </div>
        <div class="manage_jobs_btns{{ $sideBarPanel2 == 'jobs_manage_list' ? ' active' : '' }}">
            <a href="/panel/JobList/withTrashed">
                <div class="icon_sec">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path d="M17 0H7C4.243 0 2 2.243 2 5v14c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V5c0-2.757-2.243-5-5-5Zm-7 19a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2Zm0-6a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2Zm0-6a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2Zm7 12h-4c-1.308-.006-1.307-1.994 0-2h4c1.308.006 1.307 1.994 0 2Zm0-6h-4c-1.308-.006-1.307-1.994 0-2h4c1.308.006 1.307 1.994 0 2Zm0-6h-4c-1.308-.006-1.307-1.994 0-2h4c1.308.006 1.307 1.994 0 2Z"  data-original="#000000" class=""></path>
                        </g>
                    </svg>
                </div>
                <span> {{ __('message.list_of_jobs') }} </span>
            </a>
        </div>
    </div>
    <div class="left_job_manage">
        @yield("job_manage_content")
    </div>
</div>

@endsection