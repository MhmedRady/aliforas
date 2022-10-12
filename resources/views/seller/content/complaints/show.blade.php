@extends('seller.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-title p-2 mb-0">
                        <div class="row page-titles">
                            <div class="col-md-5 align-self-center">
                                <h4 class="text-themecolor">@lang('layouts.messages')</h4>
                            </div>
                            <div class="col-md-7 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item "><a href="javascript:void(0)">Cities</a></li>
                                        <li class="breadcrumb-item active">{{ $user->name }} Complaints</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach($messages as $message)
                <div class="col-12">
                    <div id="message_{{$message->id}}" class="card {{$message->sender->id == auth()->id()? 'float-start':'float-end'}}" style="max-width: 90%; min-width: 50%">
                        <div class="card-body" style="height: auto; overflow: auto;">
                            <div class="card-header email-detail-head" dir="{{ getPageDir() == 'rtl'? ($message->sender->id == auth()->id()? 'rtl':'ltr'): ($message->sender->id == auth()->id()? 'ltr':'rtl')}}">
                                <div class="user-details d-flex justify-content-between align-items-center flex-wrap">
                                    @if($message->sender->id == auth()->id())
                                        <div class="avatar bg-primary {{ getPageDir() == 'rtl'? 'me-1': 'me-1'}}">
                                            <div class="avatar-content text-uppercase fw-bolder" style="width: 48px;height: 48px;font-size: 1.2rem;">{{userNameSplit($message->sender->name)}}</div>
                                        </div>
                                    @else
                                        <div class="avatar {{ getPageDir() == 'rtl'? 'ms-1': 'ms-1'}}">
                                            <img src="{{$message->sender->profile_image_url}}" alt="{{userNameSplit($message->sender->name)}}" width="48" height="48" />
                                        </div>
                                    @endif
                                    <div class="mail-items">
                                        <h5 class="mb-0 {{$message->sender->id == auth()->id()? 'text-danger':'text-primary'}} text-decoration-underline text-capitalize">{{$message->sender->name}}</h5>
                                        <div class="email-info-dropup dropdown">
                                        <span role="button" class="dropdown-toggle font-small-3 text-muted" id="card_top01" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{$message->sender->email}}
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mail-meta-item d-flex align-items-center">
                                    <small class="mail-date-time text-decoration-underline text-muted" dir="ltr">
                                        {{diffToDateTimes($message->created_at) > 28? date( 'd M Y, H:i',strtotime($message->created_at)): $message->date_time}}
                                    </small>
                                    @if($message->sender->id == auth()->id())
                                        <button class="msg-delete text-muted me-50" dir="ltr" data-msg="message_{{$message->id}}">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body mail-message-wrapper pt-2" dir="rtl">
                                <div class="mail-message">
                                    @if(!is_null($message->title) && $message->title != '')
                                        <p class="card-text">{{$message->title}},</p>
                                    @endif
                                    <p class="card-text">
                                        {!! $message->body !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

                <form id="messageForm" action="{{route('seller.complaints.store')}}" method="post">
                    @csrf
                    <div class="content-right">
                        <div class="content-wrapper container-xxl p-0">
                            <div class="modal modal-sticky" id="compose-mail" data-bs-keyboard="false" style="bottom: 80px">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content p-0">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Compose Mail</h5>
                                            <div class="modal-actions">
                                                <a href="#" class="text-body me-75"><i data-feather="minus"></i></a>
                                                <a href="#" class="text-body me-75 compose-maximize"><i data-feather="maximize-2"></i></a>
                                                <a class="text-body" href="#" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x"></i></a>
                                            </div>
                                        </div>
                                        <div class="modal-body flex-grow-1 p-2">
                                            <form class="compose-form">
                                                <div class="compose-mail-form-field select2-primary mb-1">
                                                    <label for="email-to" class="form-label">To: <span class="text-primary text-capitalize"><u>{{$messages->first()->sender->name}}</u> <small><u>({{$messages->first()->sender->email}})</u></small></span></label>
                                                    <div class="flex-grow-1">
                                                        <input type="hidden" class="form-control" name="user_id" value="{{$messages->first()->sender->id}}">
                                                    </div>
                                                </div>
                                                <div class="compose-mail-form-field mb-1">
                                                    <label for="msgTitle" class="form-label">Title: </label>
                                                    <input type="text" id="msgTitle" class="form-control" placeholder="Subject" name="title" autocomplete="off"/>
                                                    <div id="msgTitleErr" class="invalid-feedback text-capitalize d-block">@error('title') {{$message}} @enderror</div>
                                                </div>
                                                <div id="message-editor" class="mb-1">
                                                    <label for="message-editor" class="form-label">Message Content: </label>
                                                    {{-- <div id="message-editor" class="editor mb-1" style="height: 200px" data-placeholder="Type message..."></div> --}}
                                                    <textarea type="text" class="form-control mb-1" id="messageContent" name="body" autocomplete="off" cols="5" rows="5"></textarea>
                                                    <div id="msgBodyErr" class="invalid-feedback text-capitalize d-block">@error('body') {{$message}} @enderror</div>
                                                    
                                                </div>
                                                <div class="compose-footer-wrapper">
                                                    <div class="btn-wrapper d-flex align-items-center">
                                                        <div class="btn-group dropup me-1">
                                                            <button id="submitMessage" type="submit" class="btn btn-primary">Send</button>
                                                            {{-- <div class="compose-editor-toolbar">
                                                                <span class="ql-formats me-0">
                                                                    <button class="ql-bold"></button>
                                                                    <button class="ql-italic"></button>
                                                                    <button class="ql-underline"></button>
                                                                </span>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="compose-email avatar bg-primary w-auto p-1 border-0 position-fixed"
                            data-bs-backdrop="false" data-bs-toggle="modal" data-bs-target="#compose-mail"
                            style="{{getPageDir() == 'ltr'? 'right: 20px;': 'left: 20px;'}}">
                        <i data-feather="message-square" style="height: 30px; width: 30px;"></i>
                    </button>
                </form>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
@endsection
@section('page-style')
    <link href="{{asset('admin-asset/assets/node_modules/wizard/steps.css')}}" rel="stylesheet">
    <!--alerts CSS -->
    <link href="{{asset('admin-asset/assets/node_modules/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin-asset/dist/css/custom.css')}}" rel="stylesheet">

    <!-- Theme included stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/assets/node_modules/summernote/dist/summernote-bs4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/plugins/forms/form-quill-editor.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/vendors/css/editors/quill/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/pages/app-email.css")}}">
@endsection
@section('page-script')
    <script src="{{asset('admin-asset/assets/node_modules/wizard/jquery.steps.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/wizard/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/summernote/dist/summernote-bs4.min.js')}}"></script>

    {{-- <script src="{{asset('admin-asset/vendors/js/editors/quill/katex.min.js')}}"></script>
    <script src="{{asset('admin-asset/vendors/js/editors/quill/quill.min.js')}}"></script>
    <script src="{{asset('admin-asset/js/scripts/pages/app-email.js')}}"></script> --}}

    <script>
        window.scrollTo(0, document.body.scrollHeight);
        let msgDelete = $('.msg-delete'),
            submitBtn = $('#submitMessage'),
            textDiv = $('#message-editor .ql-editor'),
            msgTitle = $('#msgTitle'),
            msgInput = $('#messageContent'),
            titleErr = true,
            msgErr = true,
            titleErrEl = $('#msgTitleErr'),
            msgErrEl = $('#msgBodyErr');

        // submitBtn.on('click', function () {
        //     msgInput.val($('#message-editor .ql-editor').html());
        // });
        $('#messageForm').submit(function (e) {
            console.log(msgInput.val().trim().length === 0 ? 'zero': 'more');
            if (msgTitle.val().trim().length === 0){
                titleErrEl.text('{{__('auth.error_Emp', ['var'=>__('layouts.msgTitle')])}}')
                titleErr = true;
            }else {
                titleErrEl.text('');
                titleErr = false;
            }

            if (msgInput.val().trim().length === 0)
            {
                msgErrEl.text('{{__('auth.error_Emp', ['var'=>__('layouts.msgBody')])}}')
                msgErr = true;
                console.log('errors');
            }else {
                console.log('no errors');
                msgErrEl.text('');
                msgErr = false;
            }
            console.log('text ' , msgErrEl.text());
            if (titleErr || msgErr) {
                e.preventDefault();
            }
        });

        msgDelete.on('click', function () {
            let elData = $(this).data('msg'),
                msgCard = $(`#${elData}`),
                msgId = elData.split('_')[1],
                url = `{{route('seller.complaints.destroy', '')}}/${msgId}`;

            Swal.fire({
                title: '@lang('layouts.deleteConfirm')',
                showDenyButton: true,
                confirmButtonText: '@lang('Yes')',
                denyButtonText: '@lang('Cancel')',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE',
                        },
                        success: function (res) {
                            if (res){
                                msgCard.remove();
                            }else {
                                Swal.fire(
                                    "@lang('Error')!",
                                    "@lang('layouts.msgNotDel')",
                                    'error'
                                );
                            }
                        }
                    })
                }
            })
        });
    </script>
@endsection
