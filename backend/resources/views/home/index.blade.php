@extends('layouts.app')

@section('title','Laravel + Vue 3 + TS')

@section('head')
  @vite(['resources/js/top_app.ts'])
@endsection

@section('content')
{{-- ①vueをbladeへマウント:HTML属性で値を渡す --}}
<?php
  // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/.docx
?>

<div id="app" data-signup-url="{{ route('accounts.create') }}"></div>

{{-- ②vueをbladeへマウント:routeUrlsで値を渡す
<script>
  <?php
    // file:///C:/Users/owner/Desktop/vue.js,TypeScript,Laravel,docker/reference_file/.docx
  ?>

  window.routeUrls = {
    signupUrl: "{{ route('accounts.create') }}"
  };
</script>

<div id="app">
  <top-page></top-page>
</div> --}}

@endsection
