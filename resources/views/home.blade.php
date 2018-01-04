@extends('layouts.master')

@section('content')
    <div id="app">
        <navbar></navbar>
        <router-view></router-view>
        <reveal></reveal>
    </div>
@endsection