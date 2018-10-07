@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    @if(count($pictures) > 0)
    <div id="img-container" class="d-flex flex-wrap" style="margin: 0 auto;">
        @foreach($pictures as $picture)
             <div class="pilt d-flex text-center justify-content-around" style="margin: 40px 0 25px; width: 30%;">
                <img class="myImg" style="max-height: 180px;" src="/storage/pildid/{{$picture->name}}" alt="">   
            </div>
        @endforeach
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

    {{$pictures->links()}}

    @else
        <p>No image Found</p>
    @endif

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script  src="{{ asset('js/modal.js') }}" defer></script>
@endsection