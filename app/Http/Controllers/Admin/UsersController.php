<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Seo\Seo;
use App\Entity\User\User;
use App\Http\Requests\Admin\User\UserRequest;
use App\UseCases\Admin\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    public function index(Request $request)
    {
        $query = User::query();

        if($search = $request->input('search'))
            $query->where('name', 'like', '%'.$search.'%');

        $users = $query->paginate(config('settings.perPage'));

        /*$to_name = 'Артём';
        $to_email = 'gammaironak@gmail.com';
        $data = ['name' => 'Артём', 'body' => 'Это сообщение из сайта nominal.com.ua Вам было добавлено новый коментарий'];
        Mail::send('emails.new_comment_mfo', $data, function( $message ) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Вам было добавлено новый коментарий');
            //$message->from('admin@nominal.com.ua','nominal.com.ua');
        });*/

        return view('admin.users.list', compact('users'));
    }

    public function create()
    {
        $roles = Role::all()->reverse();
        $seo = new Seo();
        return view('admin.users.create', compact('roles', 'seo'));
    }

    public function store(UserRequest $request)
    {
        if($this->service->create($request))
            return redirect()->route('admin.users.index')->with('success', 'Пользователь был удачно создан!');
        else
            return back()->with('error', 'Не удалось создать пользователя, попробуйте ещё раз!')->withInput();
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoleId = $user->getRole()->id;
        $seo = $user->seo ?: new Seo();
        return view('admin.users.edit', compact('roles', 'user', 'userRoleId', 'seo'));
    }

    public function update(UserRequest $request, User $user)
    {
        if($this->service->update($request, $user))
            return back()->with('success', 'Пользователь был удачно обновлен!');
        else
            return back()->with('success', 'Не удалось обновить пользователя, попробуйте ещё раз!')->withInput();
    }

    public function destroy(User $user)
    {
        $userName = $user->name;

        if ($user->delete())
            return redirect()->route('admin.users.index')->with('success', 'Пользователь: '.$userName.' был удален!');
        else
            return redirect()->route('admin.users.index')->with('error', 'Не удалось удалить пользователя: '.$userName.'! Попробуйте ещё раз!');

    }
}
