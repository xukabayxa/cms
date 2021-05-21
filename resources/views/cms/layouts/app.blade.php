<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('cms.partial.header_css')
</head>
@php
    $route=\Request::route()->getName();
@endphp
<body class="navbar-top">

@include('cms.partial.top-bar')

<!-- Page content -->
<div class="page-content">

@include('cms.partial.left-sidebar')
@include('cms.partial.right-sidebar')

</div>
<!-- /page content -->
<form id="logout-form" action="" method="POST" style="display: none;">
    @csrf
</form>
@include('cms.partial.bottom_js')
@include('cms.partial.message')
</body>

