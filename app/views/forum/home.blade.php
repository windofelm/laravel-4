@extends('layouts.master')

@section('head')
    @parent
    <title>Forums</title>
@stop

@section('content')

    @if(Auth::check() && Auth::user()->isAdmin())
        <div><a class="btn btn-default" href="#" data-toggle="modal" data-target="#group_form">Add Group</a></div>
        <hr/>
    @endif

    @foreach($groups as $group)
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $group->title }}</h3>
            </div>
            <div class="panel-body panel-list-group">
                <div class="list-group">
                    @foreach($categories as $category)
                        @if($category->group_id == $group->id)
                            <a href="{{ URL::route('forum-category',$category->id) }}" class="list-group-item">{{ $category->title }}</a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    @if(Auth::check() && Auth::user()->isAdmin())
        <div class="modal fade" id="group_form" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Add New Group</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ URL::route('forum-store-group') }}" id="target_form" method="post">
                            <div class="form-group {{ ($errors->has('group_name')) ? 'has-error' : '' }}">
                                <label for="group_name">Group Name:</label>
                                <input type="text" name="group_name" id="group_name" class="form-control"/>
                                @if($errors->has('group_name'))
                                    <p>{{ $errors->first('group_name') }}</p>
                                @endif
                            </div>
                            {{ Form::token()  }}
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="form_submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

@stop

@section('javascript')
    @parent
    <script src="js/app.js" type="text/javascript"></script>

    @if(Session::has('modal'))
        <script type="text/javascript">
            $("{{ Session::get('modal') }}").modal('show');
        </script>
    @endif
@stop