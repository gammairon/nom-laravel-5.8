<?php

namespace App\Http\Controllers\Admin\Product;

use App\Entity\Organization\Bank;
use App\Entity\Product\CreditCard;
use App\Entity\Seo\Seo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreditCardRequest;
use App\UseCases\Admin\Product\CreditCardService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CreditCardController extends Controller
{
    protected $service;

    public function __construct(CreditCardService $service)
    {
        $this->service = $service;
    }


    public function index(Request $request)
    {
        $query = CreditCard::query();

        if ($search = $request->input('search'))
            $query->where('name', 'like', '%'.$search.'%');

        $credits = $query->paginate(config('settings.perPage'));

        return view('admin.product.credit_card.list', compact('credits'));
    }

    public function create()
    {
        return view('admin.product.credit_card.create', [
            'banks' => Bank::all()->pluck('name', 'id'),
            'seo' => new Seo(),
        ]);
    }

    public function store(CreditCardRequest $request)
    {
        if ($creditCard = $this->service->create($request->all()))
            return redirect()->route('admin.products.credit-cards.index')->with('success', 'Продукт был удачно создан!');
        else
            return back()->with('error', 'Не удалось создать продукт, попробуйте ещё раз!')->withInput();
    }

    public function show(CreditCard $creditCard)
    {

    }

    public function edit(CreditCard $creditCard)
    {
        $banks = Bank::all()->pluck('name', 'id');
        $advantages = $creditCard->getAdvantages();
        $seo = $creditCard->seo ?: new Seo();

        return view('admin.product.credit_card.edit', compact('creditCard', 'banks', 'advantages', 'seo'));
    }

    public function update(CreditCardRequest $request, CreditCard $creditCard)
    {
        $msg = ['error' => 'Не удалось обновить продукт, попробуйте ещё раз!'];

        if ($this->service->update($creditCard, $request->all()))
            $msg = ['success' => 'Продукт был удачно обновлен!'];

        return back()->with($msg);
    }


    public function destroy(CreditCard $creditCard)
    {
        $name = $creditCard->name;
        $msg = ['error' => 'Не удалось удалить Продукт: ' . $name . '! Попробуйте ещё раз!'];


        if ($creditCard->delete())
            $msg = ['success' => 'Продукт: ' . $name . ' был удален!'];

        return redirect()->route('admin.products.credit-cards.index')->with($msg);
    }

    public function all(Request $request)
    {
        $msg = ['error' => 'Не удалось удалить все продукты, попробуйте ещё раз!'];

        if($this->service->deleteItems($request->input('ids', [])))
            $msg = ['success' => 'Продукты были удачно удалены!'];

        return back()->with($msg);
    }
}
