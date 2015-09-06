<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Message;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{


    /**
     * Instantiate a new CommunityController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

//
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {

        $users = User::all()->filter(function($user) {
            return $user->id != Auth::user()->id && $user->is_admin != 1;
        });

        return view('community.index', compact('users'));
    }


    public function getChat($userId)
    {
        $user = User::find($userId);
        $myUser = Auth::user();

        if (is_null($user) || $myUser->id == $user->id) {
            abort(404);
        }

        $messageHistory = (new Message)->getUsersChat($myUser->id, $user->id);

        $messageHistory = $messageHistory->toArray();
//return $messageHistory;
        return view('community.chat', compact('user', 'myUser', 'messageHistory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
