@extends('layouts.master')

@section('content')

    <div id="app">
        <reveal ref="revealer"></reveal>

        <navbar :theme="theme" ></navbar>

        <router-view></router-view>

        @include('layouts.footer')

        @include('partials.photoswipe')
    </div>

@endsection