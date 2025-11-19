<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Comment;
use App\Entity\Product\CreditCard;
use App\Http\Requests\Admin\CommentRequest;
use App\UseCases\Admin\CommentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    protected $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    public function newComments()
    {
        $model = CreditCard::find(1);

        return view('admin.comment.list', [
            'comments' => Comment::panding()->paginate(config('settings.perPage')),
        ]);
    }

    public function index()
    {
        return view('admin.comment.list', [
            'comments' => Comment::paginate(config('settings.perPage')),
        ]);
    }

    public function create()
    {
        return redirect()->route('admin.comments.index');
        /*return view('admin.comment.create', [
            'comment' => new Comment(),
        ]);*/
    }

    public function store(CommentRequest $request)
    {
        return redirect()->route('admin.comments.index');

        /*if( $bank = $this->service->create($request->all()) )
            return redirect()->route('admin.comments.index')->with('success', 'Коментарий был удачно добавлен!');
        else
            return back()->with('error', 'Не удалось создать Коментарий, попробуйте ещё раз!')->withInput();*/
    }

    public function show(CommentRequest $bank)
    {
        //
    }

    public function edit(Comment $comment)
    {
        return view('admin.comment.edit', [
            'comment' => $comment,
            'statuses' => $comment->getStatuses(),
        ]);
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $msg = ['error' => 'Не удалось обновить Коментарий, попробуйте ещё раз!'];

        if($this->service->update($comment, $request->all()))
            $msg = ['success' => 'Коментарий был удачно обновлен!'];

        return back()->with($msg);
    }

    public function destroy(Comment $comment)
    {

        $msg = ['error' => 'Не удалось удалить Коментарий! Попробуйте ещё раз!'];

        if ($comment->delete())
            $msg = ['success' => 'Коментарий был удален!'];

        return redirect()->route('admin.comments.index')->with($msg);
    }

    public function all(Request $request)
    {
        $msg = ['error' => 'Не удалось удалить все Коментарии, попробуйте ещё раз!'];

        if($this->service->deleteItems($request->input('ids', [])))
            $msg = ['success' => 'Коментарии были удачно удалены!'];

        return back()->with($msg);
    }
}
