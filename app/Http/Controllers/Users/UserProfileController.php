<?php

namespace App\Http\Controllers\Users;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserUpdateRequest;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = Auth::user();

        return view('pages.users.show', compact('user'));
    }
}
