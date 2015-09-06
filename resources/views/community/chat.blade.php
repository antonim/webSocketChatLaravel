@extends('layouts.app')

@section('title', 'Chat Room')

@section('content')


    <h2>Chat Room with "{{ $user->email }}"</h2>

    <div class="container-fluid">

        <div>History of messages</div>

        @foreach($messageHistory as $message)

        <div class="row ">
            <div class="col-xs-12">
                Message from "{{ $message['user_from']['username'] }}" to "{{ $message['user_to']['username'] }}" ({{$message['created_at']}}) : {{$message['message']}}
            </div>
        </div>

        @endforeach

        <div class="row ">
            <div class="col-xs-12">
                <br/>
                <input type="text" id="input" placeholder="Message…"/>
                <hr/>
                <pre id="messages">
                </pre>
            </div>
        </div>
    </div>

<script>
    //The homestead or local host server (don't forget the ws prefix)
    var host = 'ws://192.168.0.51:8889';
    var socket = null;
    var input = document.getElementById('input');
    var messages = document.getElementById('messages');
    var print = function (message) {
        var samp = document.createElement('samp');
        samp.innerHTML = '\n' + message + '\n';
        messages.appendChild(samp);
        return;
    };

    //Manges the keyup event
    input.addEventListener('keyup', function (evt) {
        if (13 === evt.keyCode) {
            var msg = JSON.stringify({
                to: '{{ $user->id }}',
                message: input.value
            });
            if (!msg)
                return;
            try {
                //Send the message to the socket
                socket.send(msg);
                input.value = '';
                input.focus();
            } catch (e) {
                console.log(e);
            }

            return;
        }
    });

    try {
        socket = new WebSocket(host);

        var myUserId = {{ $myUser->id }};
        var opponentUserId = {{ $user->id }};

        //Manages the open event within your client code
        socket.onopen = function () {


             var msg = JSON.stringify({
                    user: myUserId
                });
            socket.send(msg);

            print('Connection Opened');

            input.focus();
            return;
        };
        //Manages the message event within your client code
        socket.onmessage = function (msg) {
            message = JSON.parse(msg.data);

            if (message.user_from == myUserId) {
                print('My message (' + message.created_at + ') : ' + message.message);
            } else if (message.user_from == opponentUserId) {
                print('From {{ $user->email }} (' + message.created_at + ') : ' + message.message);
            }

            return;
        };
        //Manages the close event within your client code
        socket.onclose = function () {
            print('Connection Closed');
            return;
        };
    } catch (e) {
        console.log(e);
    }
</script>
@stop