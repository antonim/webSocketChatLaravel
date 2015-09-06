@extends('layouts.app')

@section('title', 'Community Room')

@section('content')


    <h2>Community Room</h2>
    <h4>Please choose partner for chat</h4>
    <table class="table table-bordered table-responsive">


    @foreach($users as $user)
        <tr>
            <td>{{ $user->email }}</td>
            <td><a href="{{ action('CommunityController@getChat', [$user->id]) }}">Go chat</a></td>
        </tr>
    @endforeach

    </table>
@stop