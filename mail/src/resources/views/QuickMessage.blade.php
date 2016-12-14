@extends('jumperMail::layouts.user_email_layout')
@section('mail_content')
        {{ $content->msg }}
@stop