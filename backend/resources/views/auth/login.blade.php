@extends('layouts.app')

@section('title','Laravel + Vue 3 + TS')

@section('head')
  @vite(['resources/js/login_app.ts'])
@endsection

@section('content')
{{-- ①vueをbladeへマウント:HTML属性で値を渡す --}}
<?php
  // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/.docx
?>

<div id="login-app"
     data-csrf-token="{{ csrf_token() }}"
     data-login-url="{{ route('login.process') }}"
     data-errors='@json($errors->toArray())'
     data-old='@json(old())'
     data-auth-error="{{ $errors->first('auth') }}">
</div>

@endsection
