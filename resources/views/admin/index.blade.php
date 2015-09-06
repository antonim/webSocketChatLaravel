@extends('layouts.app')

@section('title', 'List Of Messages')

@section('content')



    <div class="container-fluid">

        <h3>History of messages</h3>

        <table class="table table-bordered">

        <tr>
            <th>#</th>
            <th>From</th>
            <th>To</th>
            <th>Created at</th>
            <th>Message</th>
            <th></th>

        </tr>
        @foreach($messages as $message)

        <tr>
            <td>{{ $message['id'] }}</td>
            <td>{{ $message['user_from']['username'] }}</td>
            <td>{{ $message['user_to']['username'] }}</td>
            <td>{{$message['created_at']}}</td>
            <td>{{$message['message']}}</td>
            <td><a href="{{ action('AdminController@getDestroy', [$message['id']]) }}" class="btn bg-danger">DELETE</a></td>
        </tr>

        @endforeach

        </table>
    </div>

@stop