@extends('layouts.master')

@section('head')
    @parent
    <title>Forums</title>
@stop

@section('content')

    @foreach($groups as $group)
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $group->title }}</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    @foreach($categories as $category)
                        @if($category->group_id == $group->id)
                        <a class="list-group-item">{{ $category->title }}</a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

@stop