@extends('layouts.main')

@section('content')
    <div class="row marketing">
        <div class="col-lg-12">
            <h4>Message #{{ $message['id'] }}</h4>
            @if($message['destruction'] == 1)
                <p><em>The message will destroy after {{ ($message['visits'] - $message['visited']) }} visits</em></p>
            @else
                <p>The message will destroy in {{ $message['diff'] }} minutes</p>
            @endif

            <p><strong>Message: </strong>{{ $message['message'] }}</p>

        </div>
    </div>
    <br>
    <a href="/">Back to messages page</a>
@endsection