@extends('layouts.master')

@section('content')

    <div id="app">
        <span ref="consoleChecker"></span>
        <death-screen v-if="death"></death-screen>
        <div :class="{'revealer-animating':  revealerIsAnimating, 'revealer-on': revealerIsOpen, 'revealer-off': !revealerIsOpen}" v-else>

            <reveal
                    v-on:revealer-animation-on="revealerIsAnimating = true"
                    v-on:revealer-animation-off="revealerIsAnimating = false"
                    v-on:revealer-opened="revealerIsOpen = true"
                    v-on:revealer-closed="revealerIsOpen = false"
                    ref="reveal"
            ></reveal>

            <navbar :theme="navTheme" ref="navbar"></navbar>

            <router-view
                    v-on:set-nav-theme="setNavTheme"
                    v-on:view-loaded="closeReveal"
                    v-on:view-leave="openReveal"
                    v-on:not-found="notFoundRedirect"
            ></router-view>

            <footer-component></footer-component>

            @include('partials.photoswipe')
        </div>

    </div>

@endsection