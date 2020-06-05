<?php

namespace App\Http\Controllers;

use App\Http\Requests\Front\AccountUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $user=auth()->user();
        return view('front.account.index',['user'=>$user]);
    }
    public function edit():View
    {
        $user=auth()->user();
        return view('front.account.form',['user'=>$user]);
    }
    public function update(AccountUpdateRequest $request): RedirectResponse
    {
        try {
            $user=auth()->user();
            $data = $request->getData();
            $user->update($data);
        } catch (Exception $exception) {
            return back()->with('danger',$exception->getMessage())
            ->withInput();
        }
        return redirect()->route('account.index')
        ->with('success','Your acc data update');
    }
}
