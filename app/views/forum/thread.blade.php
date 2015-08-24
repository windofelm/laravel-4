@extends('layouts.master')


@section('head')
    @parent
    <title> {{ $thread->title }} </title>

@stop


@section('content')

    <div class="well">
        <h1>{{ $thread->title }}</h1>
        <h4>By: {{ $thread->author->username }} on {{ $thread->created_at }}</h4>
        <hr/>

        <p>{{ nl2br(BBCode::parse($thread->body)) }}</p>
    </div>

@stop