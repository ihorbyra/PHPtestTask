@extends('layouts.main')

@section('content')
<div class="jumbotron">
    <h3>Message</h3>
    <form id="messageForm" action="/message/save" method="post">
        {{ csrf_field() }}
        <div  id="messArea" class="form-group">
            <textarea id="message" name="message" class="form-control" rows="3"></textarea>
            <span class="form-text text-muted danger-mess">Field is required</span>
            <input value="" type="hidden" name="messageEncoded" id="messageEncoded">
        </div>
        <div>
            <br>
            <br>
            <strong>Choose destruction option:</strong>
            <div class="radio">
                <label>
                    <input value="1" type="radio" name="destruction" id="destruction1" checked>
                    Destroy message after <input style="display: inline-block; width: 70px; vertical-align: middle;" type="text" class="form-control" name="visits" id="visits" value="1"> link visits
                </label>
            </div>
            <div class="radio">
                <label>
                    <input value="2" type="radio" name="destruction" id="destruction2">
                    Destroy after 1 hour
                </label>
            </div>
        </div>
        <div>
            <button onclick="submitForm(); return false;" class="btn btn-lg btn-success">Save</button>
        </div>
    </form>
</div>

<div class="row marketing">
    @if(count($messages) > 0)
    @foreach($messages as $message)
        <div class="col-lg-6">
            <h4>Message #{{ $message['id'] }}</h4>
            @if($message['destruction'] == 1)
                <p><em>The message will destroy after {{ ($message['visits'] - $message['visited']) }} visits</em></p>
            @else
                <p>The message will destroy in {{ $message['diff'] }} minutes</p>
            @endif

            <p><strong><a href="/message/{{ $message['url'] }}">Show me the message</a></strong></p>

        </div>
    @endforeach
    @endif

</div>
@endsection