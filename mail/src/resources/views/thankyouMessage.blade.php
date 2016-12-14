@extends('jumperMail::layouts.user_email_layout')
@section('mail_content')
	{{ $msg }}
	<a style="margin:5px; background-color: #5cb85c; border-color: #5cb85c; border-radius: 3px;display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px; color: #FFF; " href="{{ Config::get('app.live_url') }}" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">
        {{ Config::get('app.name') }}
    </a>
@stop