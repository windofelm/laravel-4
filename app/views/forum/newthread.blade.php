@extends('layouts.master')


@section('head')
    @parent
    <title> New Thread </title>

@stop


@section('content')

    <h1>New Thread</h1>

    <form action="{{ URL::route('forum-store-thread', $category_id) }}" method="post">

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control"/>
        </div>

        <div class="form-group">
            <label for="title">Body:</label>
            <textarea type="text" name="body" id="body" class="form-control"></textarea>
        </div>

        {{ Form::token()  }}
        <div class="form-group">
            <input type="submit" value="Save Thread" class="btn btn-primary"/>
        </div>

    </form>
@stop