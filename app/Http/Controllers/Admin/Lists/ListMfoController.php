<?php
/**
 * User: Gamma-iron
 * Date: 16.01.2020
 */

namespace App\Http\Controllers\Admin\Lists;


use App\Entity\Lists\ListMfo;
use App\Entity\Organization\Mfo;
use App\Http\Controllers\Controller;
use App\UseCases\Admin\Lists\ListMfoService;
use Illuminate\Http\Request;

class ListMfoController extends Controller
{
    protected $service;

    public function __construct(ListMfoService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = ListMfo::query();

        if ($search = $request->input('search'))
            $query->where('name', 'like', '%'.$search.'%');

        $lists = $query->paginate(config('settings.perPage'));

        return view('admin.lists.mfo.index', compact('lists'));
    }

    public function create()
    {

        list($defaultMfos, $selectedMfos) = $this->service->getMfoLists();

        return view('admin.lists.mfo.create', compact('defaultMfos', 'selectedMfos'));
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        if( $bank = $this->service->create($request->all()) )
            return redirect()->route('admin.lists.mfo.index')->with('success', 'Список МФО был удачно создан!');
        else
            return back()->with('error', 'Не удалось создать Список МФО, попробуйте ещё раз!')->withInput();
    }

    public function edit(ListMfo $listMfo)
    {
        list($defaultMfos, $selectedMfos) = $this->service->getMfoLists($listMfo->id);

        return view('admin.lists.mfo.edit', compact('listMfo', 'defaultMfos', 'selectedMfos'));
    }

    public function update(Request $request, ListMfo $listMfo)
    {
        $this->validateRequest($request);

        $msg = ['error' => 'Не удалось обновить Список МФО, попробуйте ещё раз!'];

        if($this->service->update($listMfo, $request->all()))
            $msg = ['success' => 'Список МФО был удачно обновлен!'];

        return back()->with($msg);
    }

    public function destroy(ListMfo $listMfo)
    {
        $name = $listMfo->name;
        $msg = ['error' => 'Не удалось удалить Список МФО: '.$name.'! Попробуйте ещё раз!'];

        if ($listMfo->delete())
            $msg = ['success' => 'Список МФО: '.$name.' был удален!'];

        return redirect()->route('admin.lists.mfo.index')->with($msg);
    }


    public function all(Request $request)
    {
        $msg = ['error' => 'Не удалось удалить все Списки МФО, попробуйте ещё раз!'];

        if($this->service->deleteItems($request->input('ids', [])))
            $msg = ['success' => 'Списки МФО были удачно удалены!'];

        return back()->with($msg);
    }

    protected function validateRequest(Request $request)
    {
        $rules = ['name' => 'bail|required|max:255|unique:lists,name'];

        if($request->isMethod('put')){
            $rules['name'] .= ','.$request->list_mfo->id;
        }

        return parent::validate($request, $rules);
    }

}
