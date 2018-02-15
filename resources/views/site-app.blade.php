@extends('layouts.master')

@section('content')

    <div id="app">
        <reveal ref="reveal"></reveal>

        <navbar :theme="navTheme" ></navbar>

        <router-view
            v-on:set-nav-theme="setNavTheme"
            v-on:view-loaded="closeReveal"
            v-on:view-leave="openReveal"
        ></router-view>

        @include('layouts.footer')

        @include('partials.photoswipe')
    </div>

@endsection