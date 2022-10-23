@extends('multiauth::layouts.mailbox')
@section('content')
<section class="content-header">
    <h1>
    Mailbox ::&nbsp;
    @if($message->sender == '0' and $message->trash == 0)
        Sent Message
    @elseif($message->sender == 1 and $message->trash == 0)
        Inbox
    @elseif($message->sender == null  and $message->trash == 0)
        Draft Message
    @else
        Trash Message
    @endif
    <small>{{ count($msgtop) }} unread messages</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Compose Email</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        {{-- @include('vendor.multiauth.email.mailbar') --}}
        {{-- Compose Email --}}
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="mailbox-read-info">
                        <span class="mailbox-read-time pull-right hide-sm">{{ $message->created_at->diffForHumans() }}</span>
                        <h3>{{ $message->subject }}</h3>
                        
                        <h5>From: &nbsp; <i style="color: #1DB5D0">{{ $message->from }}</i></h5>
                        <h5>To: &nbsp; <i style="color: #1DB5D0">{{ $message->to }}</i></h5>
                        
                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        <p>Hello {{ $message->name }},</p>
                        <p>{{ $message->message }}</p>
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.box-body -->
                <!-- /.box-footer -->
                <div class="box-footer">
                    <div class="pull-right">
                        <a href="{{route('admin.reply',[Crypt::encrypt($message->id)])}}" class="btn btn-primary btn-sm"  title="Reply">
                            <i class="fa fa-reply"></i>
                            @if($message->sender == null)
                            <span class="hide-sm">&nbsp; Send it</span>
                            @else
                            <span class="hide-sm">&nbsp; Reply</span>
                            @endif
                        </a>
                        <a href="{{route('admin.forward',[Crypt::encrypt($message->id)])}}" class="btn btn-default">
                            <i class="fa fa-share"></i><span class="hide-sm"> 
                            <span class="hide-sm">&nbsp;Forward</span>
                        </a>
                    </div>
                    
                    <form action="{{ route('admin.deletemsg',[Crypt::encrypt($message->id)]) }}" method="POST">
                        @csrf @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return deleteconfig()" style="margin-left: 7px;margin-right: 5px;">
                            <i class="fa fa-trash-o"></i>
                            <span class="hide-sm">&nbsp; Delete</span>
                        </button>
                        <button type="button" class="btn btn-default">
                            <i class="fa fa-print"></i> 
                            <span class="hide-sm">&nbsp;Print</span>
                        </button>
                    </form>
                    
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /. box -->
        </div>
    </div>
</section>
@endsection