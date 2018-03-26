@extends('layouts.admin')
@section('content')
    <div id="app">
        <navbar :is-logged="isLoggedIn"></navbar>

        <router-view :key="$route.fullPath" v-on:not-found="notFound"></router-view>
    </div>
@endsection