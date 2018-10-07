@extends('layouts.app')

@section('content')
<h1>{{$title}}</h1>
{!! Form::open(['action' => ['PictureController@update', $picture->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{ Form::label('image', 'Image') }}
        {{ Form::file('image', ['class' => 'form-control']) }}
    </div>
    {{ Form::hidden('_method', 'PUT') }}
    <div class="form-group">
        {{ Form::submit('Submit', ['class' => 'btn btn-primary float-left']) }}
        <a href="/home" class="btn btn-danger float-right">Back</a>
    </div>
{!! Form::close() !!}
@endsection

