@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/images/create" class="btn btn-primary mb-2">Add Image</a>
                    <a href="/videos/create" class="btn btn-primary mb-2">Add Video</a>
                    <hr class="bg-primary">
                    <h3 class="mb-1">Your Images</h3>
                    @if(count($pictures) > 0)
                        <div id="image-container" class="d-flex flex-wrap" style="margin: 0 auto;">
                            @foreach($pictures as $picture)
                            <div class="container2">
                                <div class="image-container2">
                                    <img src="/storage/pildid/{{$picture->name}}" alt="{{$picture->name}}" class="image_panel">
                                    <div class="image-overlay"></div>
                                </div>
                                <div class="buttons justify-content-around">
                                    <a class="d-flex btn btn-primary" href="/images/{{$picture->id}}/edit">Edit</a>
                                    {!!Form::open(['action' => ['PictureController@destroy', $picture->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'd-flex btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                            <div class="panel_shadow"></div>
                            @endforeach
                            {{$pictures->links()}}
                        </div>
                    <hr class="bg-primary">
                    <h3 class="mb-1">Your Videos</h3>
                    
                    @else
                        <p>You have no Images</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
