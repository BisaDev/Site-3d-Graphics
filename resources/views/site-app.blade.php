@extends('layouts.master')

@section('content')

    <div id="app">
        <span ref="consoleChecker"></span>
        <death-screen v-if="death"></death-screen>
        <div v-else>

            <reveal ref="reveal"></reveal>

            <navbar :theme="navTheme"></navbar>

            <router-view
                    v-on:set-nav-theme="setNavTheme"
                    v-on:view-loaded="closeReveal"
                    v-on:view-leave="openReveal"
            ></router-view>

            <footer-component></footer-component>

            @include('partials.photoswipe')
        </div>

    </div>

@endsection