<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserContactDetailStoreRequest;
use App\Http\Requests\Users\UserContactDetailUpdateRequest;
use App\UserContactDetail;
use Illuminate\Http\Request;

class UserContactDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userContactDetails = UserContactDetail::all();

        return view('userContactDetail.index', compact('userContactDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('userContactDetail.create');
    }

    /**
     * @param \App\Http\Requests\Users\UserContactDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserContactDetailStoreRequest $request)
    {
        $userContactDetail = UserContactDetail::create($request->validated());

        $request->session()->flash('userContactDetail.id', $userContactDetail->id);

        return redirect()->route('userContactDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\UserContactDetail $userContactDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, UserContactDetail $userContactDetail)
    {
        return view('userContactDetail.show', compact('userContactDetail'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\UserContactDetail $userContactDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, UserContactDetail $userContactDetail)
    {
        return view('userContactDetail.edit', compact('userContactDetail'));
    }

    /**
     * @param \App\Http\Requests\Users\UserContactDetailUpdateRequest $request
     * @param \App\UserContactDetail $userContactDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UserContactDetailUpdateRequest $request, UserContactDetail $userContactDetail)
    {
        $userContactDetail->update($request->validated());

        $request->session()->flash('userContactDetail.id', $userContactDetail->id);

        return redirect()->route('userContactDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\UserContactDetail $userContactDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserContactDetail $userContactDetail)
    {
        $userContactDetail->delete();

        return redirect()->route('userContactDetail.index');
    }
}
