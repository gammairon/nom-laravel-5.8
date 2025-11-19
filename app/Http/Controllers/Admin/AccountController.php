<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Seo\Seo;
use App\Http\Requests\Admin\User\AccountRequest;
use App\UseCases\Admin\User\AccountService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    protected $service;


    public function __construct(AccountService $service)
    {
        $this->service = $service;
    }

    public function edit()
    {
        $user = Auth::user();

        return view('admin.account', [
            'user' => $user,
            'seo' => $user->seo ?: new Seo(),
        ]);
    }

    public function update(AccountRequest $request)
    {
        if($this->service->update($request))
            $request->session()->flash('success', 'Account updated successfully!');
        else
            $request->session()->flash('error', 'Update failed. Try again!');

        return back();
    }

}
