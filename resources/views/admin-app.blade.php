@extends('layouts.admin')
@section('content')
    <div id="app">
        <navbar :is-logged="isLoggedIn"></navbar>

        <router-view></router-view>
    </div>
@endsection