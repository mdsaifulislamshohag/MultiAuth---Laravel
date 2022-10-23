@extends('multiauth::layouts.mailbox')
@section('content')
<section class="content-header">
    <h1>
    Mailbox
    <small>{{ count($msgtop) }} unread messages</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        @include('multiauth::message')
        {{-- @include('vendor.multiauth.email.mailbar') --}}
        @include('vendor.multiauth.email.inbox')
    </div>
</section>

@endsection