@extends('website.panel.panel_layouts.MasterPanel')

@section("title_page" , 'تیکت ها')

@section('css_links')

<link rel="stylesheet" href="/website/Css/Panel/tickets/massanger.css">

@endsection

@section('panel_content')

<div class="MassangerContainer">
    <div class="Right_massanger_section empty">
        <div class="empty_right_massanger">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                <g>
                    <path d="M24 16v5a3 3 0 0 1-3 3h-5a8 8 0 0 1-6.92-4 10.968 10.968 0 0 0 2.242-.248A5.988 5.988 0 0 0 16 22h5a1 1 0 0 0 1-1v-5a5.988 5.988 0 0 0-2.252-4.678A10.968 10.968 0 0 0 20 9.08 8 8 0 0 1 24 16Zm-6.023-6.349A9 9 0 0 0 8.349.023 9.418 9.418 0 0 0 0 9.294v5.04C0 16.866 1.507 18 3 18h5.7a9.419 9.419 0 0 0 9.277-8.349Zm-4.027-5.6a7.018 7.018 0 0 1 2.032 5.46A7.364 7.364 0 0 1 8.7 16H3c-.928 0-1-1.275-1-1.666v-5.04a7.362 7.362 0 0 1 6.49-7.276Q8.739 2 8.988 2a7.012 7.012 0 0 1 4.962 2.051Z" data-original="#000000"></path>
                </g>
            </svg>
            <p> {{ __('message.NotChatSelected') }} </p>
        </div>
        <div class="Massanger_Con">
            <div class="topUserInfos">
                <div class="left_user_infos">
                    <img src="" class="receiver_img" alt="">
                    <div class="user_infos_tap">
                        <p class="title"> </p>
                        <p class="phone"> </p>
                    </div>
                </div>
                <div class="dotsChat_options">
                    <ion-icon name="ellipsis-horizontal"></ion-icon>
                    <div class="drp_chat_options">
                        <div class="options closeChatBtn">
                            <span> {{ __('message.backToMain') }} </span>
                        </div>
                        <div class="options">
                            <form action="/panel/deleteAllChatBtn" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit">
                                    {{ __('message.deleteChat') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ChatsAll"></div>
            <div class="Massanger_nav">
                
                <form action="/panel/massanger/addMsg" data-type="insert" method="post" id="messaner_form">
                    <input type="text" name="text" class="textsender" placeholder="{{ __('message.writeText') }}" id="text_int">
                    <div class="left_Tools_chat">
                        <div class="ToolsChat editModeBtn description_btn">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M15.707 9.707 13.414 12l2.293 2.293a.999.999 0 1 1-1.414 1.414L12 13.414l-2.293 2.293a.997.997 0 0 1-1.414 0 .999.999 0 0 1 0-1.414L10.586 12 8.293 9.707a.999.999 0 1 1 1.414-1.414L12 10.586l2.293-2.293a.999.999 0 1 1 1.414 1.414ZM24 12c0 6.617-5.383 12-12 12S0 18.617 0 12 5.383 0 12 0s12 5.383 12 12Zm-2 0c0-5.514-4.486-10-10-10S2 6.486 2 12s4.486 10 10 10 10-4.486 10-10Z" fill="var(--red)" data-original="#000000"></path>
                                </g>
                            </svg>
                            <div class="title_sec_hover">
                                {{ __('message.editMode') }}
                            </div>
                        </div>
                        <div class="ToolsChat emoji">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M12 24a12 12 0 1 1 12-12 12.013 12.013 0 0 1-12 12Zm0-22a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm5.666 13.746a1 1 0 0 0-1.33-1.494A7.508 7.508 0 0 1 12 16a7.509 7.509 0 0 1-4.334-1.746 1 1 0 0 0-1.332 1.492A9.454 9.454 0 0 0 12 18a9.454 9.454 0 0 0 5.666-2.254ZM6 10c0 1 .895 1 2 1s2 0 2-1a2 2 0 0 0-4 0Zm8 0c0 1 .895 1 2 1s2 0 2-1a2 2 0 0 0-4 0Z" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                            <div class="emojiCon"></div>
                        </div>
                        <div class="OverlayAll"></div>
                        <div class="inputFilePlace" style="display: none;">
                            <input type="file" name="file" id="file" class="imageUploadSender">
                            <input type="hidden" name="fileStatus" id="fileStatus">
                        </div>
                        <label for="file" class="ToolsChat">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M17 14a1 1 0 0 1-1 1H8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1zm-4 3H8a1 1 0 0 0 0 2h5a1 1 0 0 0 0-2zm9-6.515V19a5.006 5.006 0 0 1-5 5H7a5.006 5.006 0 0 1-5-5V5a5.006 5.006 0 0 1 5-5h4.515a6.958 6.958 0 0 1 4.95 2.05l3.484 3.486A6.951 6.951 0 0 1 22 10.485zm-6.949-7.021A5.01 5.01 0 0 0 14 2.684V7a1 1 0 0 0 1 1h4.316a4.983 4.983 0 0 0-.781-1.05zM20 10.485c0-.165-.032-.323-.047-.485H15a3 3 0 0 1-3-3V2.047c-.162-.015-.321-.047-.485-.047H7a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3z" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                        </label>
                        <button type="submit" class="sendTicketBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M23.119.882a2.966 2.966 0 0 0-2.8-.8l-16 3.37a4.995 4.995 0 0 0-2.853 8.481l1.718 1.717a1 1 0 0 1 .293.708v3.168a2.965 2.965 0 0 0 .3 1.285l-.008.007.026.026A3 3 0 0 0 5.157 20.2l.026.026.007-.008a2.965 2.965 0 0 0 1.285.3h3.168a1 1 0 0 1 .707.292l1.717 1.717A4.963 4.963 0 0 0 15.587 24a5.049 5.049 0 0 0 1.605-.264 4.933 4.933 0 0 0 3.344-3.986l3.375-16.035a2.975 2.975 0 0 0-.792-2.833ZM4.6 12.238l-1.719-1.717a2.94 2.94 0 0 1-.722-3.074 2.978 2.978 0 0 1 2.5-2.026L20.5 2.086 5.475 17.113v-2.755a2.978 2.978 0 0 0-.875-2.12Zm13.971 7.17a3 3 0 0 1-5.089 1.712l-1.72-1.72a2.978 2.978 0 0 0-2.119-.878H6.888L21.915 3.5Z" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                        </button>

                    </div>
                    <div class="uploadedImageCon">
                        <div class="deleteBtn">
                            <div class="deleteIcon">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                    <g>
                                        <path d="M448 85.333h-66.133C371.66 35.703 328.002.064 277.333 0h-42.667c-50.669.064-94.327 35.703-104.533 85.333H64c-11.782 0-21.333 9.551-21.333 21.333S52.218 128 64 128h21.333v277.333C85.404 464.214 133.119 511.93 192 512h128c58.881-.07 106.596-47.786 106.667-106.667V128H448c11.782 0 21.333-9.551 21.333-21.333S459.782 85.333 448 85.333zM234.667 362.667c0 11.782-9.551 21.333-21.333 21.333-11.783 0-21.334-9.551-21.334-21.333v-128c0-11.782 9.551-21.333 21.333-21.333 11.782 0 21.333 9.551 21.333 21.333v128zm85.333 0c0 11.782-9.551 21.333-21.333 21.333-11.782 0-21.333-9.551-21.333-21.333v-128c0-11.782 9.551-21.333 21.333-21.333 11.782 0 21.333 9.551 21.333 21.333v128zM174.315 85.333c9.074-25.551 33.238-42.634 60.352-42.667h42.667c27.114.033 51.278 17.116 60.352 42.667H174.315z" data-original="#000000" class=""></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="imageUploaded"></div>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="Left_massanger_section">
        <div class="topAll_left_massanger">
            <div class="SearchBoxAll">
                <div class="searchBox">
                    <input type="text" id="searchGaps" placeholder="{{ __('message.searchPlaceHolder') }}">
                    <svg class="search_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" fill="none">
                        <path d="M22.6617 21.465L19.0811 17.9643L18.9972 17.8367C18.8411 17.6813 18.6278 17.5938 18.4051 17.5938C18.1824 17.5938 17.969 17.6813 17.8129 17.8367C14.77 20.6284 10.0811 20.7801 6.85593 18.1913C3.63078 15.6024 2.87016 11.0763 5.07851 7.61468C7.28686 4.15301 11.7789 2.82997 15.5756 4.52298C19.3722 6.21599 21.2953 10.3997 20.0695 14.2995C19.9812 14.5812 20.0534 14.8876 20.2588 15.1032C20.4642 15.3188 20.7717 15.4109 21.0653 15.3448C21.359 15.2787 21.5943 15.0644 21.6826 14.7827C23.148 10.1548 20.9348 5.17445 16.4748 3.06352C12.0148 0.952587 6.64638 2.34453 3.84244 6.33889C1.0385 10.3333 1.64049 15.7313 5.25898 19.0411C8.87747 22.3508 14.4265 22.579 18.3165 19.5779L21.4868 22.6775C21.8142 22.9963 22.3436 22.9963 22.671 22.6775C22.9981 22.3543 22.9981 21.8339 22.671 21.5106L22.6617 21.465Z"></path>
                    </svg>
                    <div class="loading_search"></div>
                </div>
            </div>
            <div class="option_messagesAll">
                <div class="underline_border active0"></div>
                <div class="options_msg active">
                    <p> {{ __('message.gap_type1') }} </p>
                </div>
                <div class="options_msg">
                    <p> {{ __('message.gap_type2') }} </p>
                </div>
            </div>
        </div>
        <div class="bottomAll_left_massanger">
            <div class="section_gaps active"></div>
            <div class="section_gaps"></div>
        </div>
    </div>
</div>



@endsection


@section("js_links")

<script src="https://cdn.jsdelivr.net/npm/emoji-mart@latest/dist/browser.js"></script>
<script defer src="/website/Js/panel/tickets/validation_<?= session('lang') ?>.js"></script>
<script defer src="/website/Js/panel/tickets/script.js"></script>

@endsection