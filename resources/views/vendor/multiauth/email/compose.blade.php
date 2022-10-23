@extends('multiauth::layouts.mailbox')
@section('content')
<section class="content-header">
    <h1>
    Mailbox
    <small>13 new messages</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Compose Email</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        @include('multiauth::message')
        {{-- @include('vendor.multiauth.email.mailbar') --}}
        {{-- Compose Email --}}
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Write a Message</h3>
                </div>
                <div class="box-body">
                    <form id="register-form" method="POST" action="{{ route('admin.composemail') }}">
                        @csrf
                        <input type="hidden" name="sender" value="0">
                        <input type="hidden" name="name" value="{{ auth('admin')->user()->name }}">
                        <input type="hidden" name="from" value="{{ auth('admin')->user()->email }}">
                        <fieldset class="form-group">
                            <input type="email" 
                                    name="to" 
                                    class="form-control" 
                                    placeholder="To:"
                                    @if(isset($reply->from))
                                        @if($reply->sender == 1)
                                            value="{{ $reply->from }}"
                                        @else
                                            value="{{ $reply->to }}"
                                        @endif
                                    @endif 
                                     
                            >
                        </fieldset>
                        <fieldset class="form-group">
                            <input type="text" 
                                    name="subject" 
                                    class="form-control" 
                                    placeholder="Subject:"
                                    @if(isset($reply->subject))
                                    value="{{ $reply->subject }}"
                                    @elseif(isset($forward->subject))
                                    value="{{ $forward->subject }}"
                                    @endif 
                                    required
                            >
                        </fieldset>
                        <fieldset class="form-group">
                            @if(isset($forward->message))  
                                <textarea type="text" name="message" class="form-control" rows="8" placeholder="Message:" required >{{ $forward->message }}</textarea>
                            @elseif(isset($reply))
                                @if($reply->sender == null)
                                <textarea type="text" name="message" class="form-control" rows="8" placeholder="Message:" required >{{ $reply->message }}</textarea>
                                @else
                                <textarea type="text" name="message" class="form-control" rows="8" placeholder="Message:" required ></textarea>
                                @endif
                            @else
                            <textarea type="text" name="message" class="form-control" rows="8" placeholder="Message:" required ></textarea>
                            @endif
                        </fieldset>
                        <fieldset class="form-group">
                            <button type="submit" name="send" class="btn btn-sm btn-primary"><i class="fa fa-envelope"></i> Send</button>
                            <input type="submit" name="draft" class="btn btn-sm btn-info" value="Save to Draft">
                            <button type="reset" class="btn btn-sm btn-defeult">Reset</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection