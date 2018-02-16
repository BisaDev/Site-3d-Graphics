@extends('layouts.admin')
@section('content')
    <div id="app">
        <navbar :is-logged="isLoggedIn"></navbar>

        <router-view v-on:not-found="notFound"></router-view>
    </div>
@endsection