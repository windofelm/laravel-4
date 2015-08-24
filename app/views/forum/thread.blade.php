@extends('layouts.master')


@section('head')
    @parent
    <title> {{ $thread->title }} </title>

@stop


@section('content')
    <div class="clearfix">
    <ol class="breadcrumb pull-left">
        <li><a href="{{ URL::route('forum-home') }}">Forums</a></li>
        <li><a href="{{ URL::route('forum-category', $thread->category_id) }}">{{ $thread->category->title }}</a></li>
        <li class="active">{{ $thread->title }}</li>
    </ol>
        @if(Auth::check() && Auth::user()->isAdmin())
            <a href="{{ URL::route('forum-delete-thread', $thread->id) }}" class="btn btn-danger pull-right">Delete Thread</a>
        @endif
    </div>
    <div class="well">
        <h1>{{ $thread->title }}</h1>
        <h4>By: {{ $thread->author->username }} on {{ $thread->created_at }}</h4>
        <hr/>

        <p>{{ nl2br(BBCode::parse($thread->body)) }}</p>
    </div>

    @foreach($thread->comments()->get() as $comment)

        <div class="well">
            <h4>{{ $comment->author->username }} on {{ $comment->created_at }}</h4>
            <hr/>
            <p>{{ nl2br(BBCode::parse($comment->body)) }}</p>
            @if(Auth::check() && Auth::user()->isAdmin())
                <a class="btn btn-danger" href="{{ URL::route('forum-delete-comment', $comment->id) }}">Delete Comment</a>
            @endif
        </div>
    @endforeach

    @if(Auth::check())

        <form action="{{ URL::route('forum-store-comment', $thread->id) }}" method="post">

            <div class="form-group">
                <label for="title">Body:</label>
                <textarea type="text" name="body" id="body" class="form-control"></textarea>
            </div>

            {{ Form::token()  }}
            <div class="form-group">
                <input type="submit" value="Save Thread" class="btn btn-primary"/>
            </div>

        </form>

    @endif

@stop