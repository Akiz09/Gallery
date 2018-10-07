@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'PictureController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{ Form::label('image[]', 'Image') }}
        {{ Form::file('image[]', ['class' => 'form-control', 'multiple' => 'multiple']) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Submit', ['class' => 'btn btn-primary float-left']) }}
        <a href="/home" class="btn btn-danger float-right">Back</a>
    </div>
{!! Form::close() !!}
@endsection

