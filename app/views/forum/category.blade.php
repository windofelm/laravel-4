@extends('layouts.master')


@section('head')
    @parent
    <title>Forum | {{ $category->title }}</title>

@stop


@section('content')


    @if(Auth::check())
        <div><a class="btn btn-default" href="{{ URL::route('forum-get-new-thread', $category->id) }}">Add Thread</a></div>
        <hr/>
    @endif


        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="clearfix">
                    <h3 class="panel-title pull-left">{{ $category->title }}</h3>
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="#" id="{{ $category->id }}" class="btn btn-danger btn-xs pull-right delete_category" data-toggle="modal" data-target="#category_delete">Delete</a>
                    @endif
                </div>
            </div>
            <div class="panel-body panel-list-group">
                <div class="list-group">
                    @foreach($threads as $thread)
                        <a href="{{ URL::route('forum-thread',$thread->id) }}" class="list-group-item">{{ $thread->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>


    {{-- Kategori Silme İçin --}}
    @if(Auth::check() && Auth::user()->isAdmin())

        <!-- Delete Group Modal -->
        <div class="modal fade" id="category_delete" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Delete Category</h4>
                    </div>
                    <div class="modal-body">
                        <h3>Are you sure you want to delete this category.</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <a href="#" class="btn btn-primary" id="btn_delete_category">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

@stop


@section('javascript')
    @parent
    {{ HTML::script('js/app.js') }}

@stop