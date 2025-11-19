<?php

namespace App\Http\Controllers\Admin\Organization;

use App\Entity\Organization\Bank;
use App\Entity\Seo\Seo;
use App\Http\Requests\Admin\Organization\BankRequest;
use App\UseCases\Admin\Organization\BankService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankController extends Controller
{
    protected $service;

    public function __construct(BankService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = Bank::select(['id', 'name', 'slug']);

        if ($search = $request->input('search'))
            $query->where('name', 'like', '%'.$search.'%');

        $banks = $query->paginate(config('settings.perPage'));

        return view('admin.organization.bank.list', compact('banks'));
    }

    public function create()
    {
        return view('admin.organization.bank.create', [
            'seo' => new Seo(),
        ]);
    }

    public function store(BankRequest $request)
    {
        if( $bank = $this->service->create($request->all()) )
            return redirect()->route('admin.organizations.banks.index')->with('success', 'Банк был удачно создан!');
        else
            return back()->with('error', 'Не удалось создать Банк, попробуйте ещё раз!')->withInput();
    }

    public function show(BankRequest $bank)
    {
        //
    }

    public function edit(Bank $bank)
    {
        return view('admin.organization.bank.edit', [
            'bank' => $bank,
            'seo' => $bank->seo
        ]);
    }

    public function update(BankRequest $request, Bank $bank)
    {
        $msg = ['error' => 'Не удалось обновить Банк, попробуйте ещё раз!'];

        if($this->service->update($bank, $request->all()))
            $msg = ['success' => 'Банк был удачно обновлен!'];

        return back()->with($msg);
    }

    public function destroy(Bank $bank)
    {
        $name = $bank->name;
        $msg = ['error' => 'Не удалось удалить Банк: '.$name.'! Попробуйте ещё раз!'];

        if ($bank->delete())
            $msg = ['success' => 'Банк: '.$name.' был удален!'];

        return redirect()->route('admin.organizations.banks.index')->with($msg);
    }


    public function all(Request $request)
    {
        $msg = ['error' => 'Не удалось удалить все Банки, попробуйте ещё раз!'];

        if($this->service->deleteItems($request->input('ids', [])))
            $msg = ['success' => 'Банки были удачно удалены!'];

        return back()->with($msg);
    }
}
