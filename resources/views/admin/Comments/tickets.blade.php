@extends("admin.Master_layouts.Master")

@section("page_title","مدیریت تیکت ها ")

@section("Main_content")

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست تیکت ها </h3>

                    <div class="box-tools">
                        <form action="/admin/searchTicket" method="get">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="searchVal" class="form-control pull-right" placeholder="جستجو">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        @if($tickets->count() > 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>فرستنده</th>
                                    <th>گیرنده</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)

                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        @if($ticket->sender_text == "user")
                                        <a href="/admin/users/{{ $ticket->user_sender()->first()->phoneNumber }}/info">
                                            {{ $ticket->user_sender()->first()->name . ' ' . $ticket->user_sender()->first()->family }}
                                        </a>
                                        @else
                                        <a href="/admin/searchJob?searchVal={{ $ticket->job_sender()->first()->job_name_fa }}">
                                            {{ $ticket->job_sender()->first()->job_name_fa }}
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($ticket->receiver_text == "job")
                                        <a href="/admin/searchJob?searchVal={{ $ticket->job_receiver()->first()->job_name_fa }}">
                                            {{ $ticket->job_receiver()->first()->job_name_fa }}
                                        </a>
                                        @else
                                        <a href="/admin/users/{{ $ticket->user_receiver()->first()->phoneNumber }}/info">
                                            {{ $ticket->user_receiver()->first()->name . ' ' . $ticket->user_receiver()->first()->family }}
                                        </a>
                                        @endif
                                    </td>
                                    <td>{{ App\Http\Controllers\helper\DateHelper::FaConvert($ticket->created_at) }}</td>
                                    <td>
                                        <form style="display: inline;" action="/admin/tickets/{{ $ticket->id }}/delete" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger deleteBtn">حذف</button>
                                        </form>
                                        <button type="button" class="btn btn-warning showTicketTextBtn" data-id="{{ $ticket->id }}" data-toggle="modal" data-target="#modal-warning">مشاهده تیکت </button>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                        @else
                        <div class="Empty">
                            <img src="/Tools/Images/website_images/empty.png" alt="">
                            <span> موردی یافت نشد </span>
                        </div>
                        @endif

                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<div class="modal modal-warning fade" id="modal-warning">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">متن نظر</h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">خروج</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection


@section("js_links")

<script defer src="/admin/dist/js/ticket/showTicketText.js"></script>

@endsection