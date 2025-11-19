<?php
/**
 * User: Gamma-iron
 * Date: 06.06.2019
 */

namespace App\UseCases;


use App\Entity\Blog\Post;
use App\Entity\Comment;
use App\Entity\NewsSubscriber;
use App\Entity\Organization\Bank;
use App\Entity\Organization\Mfo;
use App\Entity\Product\CreditCash;
use App\Helpers\Common;
use App\UseCases\Admin\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AjaxService
{

    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function mfoFilter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'nullable|numeric',
            'days' => 'nullable|integer',
            'no_procent' => 'nullable|boolean',
            'age_from' => 'required|boolean',
            'age_to' => 'required|boolean',
            'order' => 'nullable|string|max:25',
        ]);

        if ($validator->fails()) {
            $mfos = Mfo::with('media')->all();
        }
        else{

            $builder = Mfo::with('media');

            if($amount = $request->input('amount', 0)){
                $builder->where('max_amount', '>=', $amount)->where('min_amount', '<=', $amount);
            }

            if($days = $request->input('days', 0)){
                $builder->where('max_term', '>=', $days)->where('min_term', '<=', $days);
            }

            if($request->input('no_procent')){
                $builder->where('free_credit_bid', '<=', 0.01);
            }

            if($request->input('age_from')){
                $builder->where('min_age', '>=', 18);
            }

            if($request->input('age_to')){
                $builder->where('max_age', '<=', 80);
            }

            //Фильтрация списков МФО ListMfo
            if($request->input('type') == 'group'){
                /*$builder->join('list_mfo', 'mfo_org.id', '=', 'list_mfo.mfo_id')->where('list_mfo.list_id', '=', $request->input('list'))->orderBy('list_mfo.sort')->get();*/
                $builder->join('list_mfo', function ($query) use ($request){
                    $query->on('mfo_org.id', 'list_mfo.mfo_id')
                        ->where('list_mfo.list_id', $request->input('list'));
                })->orderBy('list_mfo.sort')->get();
            }

            $orderBy = $request->input('order') ?? 'rating_desc';

            //Если сортировка равна 'rating_desc' тогда
            //Запрос пришел из списка безпроцентных кредитов
            if($orderBy == 'rating_desc'){
                $builder->where('free_credit_bid', '<=', 0.01);
            }

            $mfos = $builder->sort($orderBy)->get();
        }




        return view('front/partials/mfo_list', compact('mfos'));
    }

    public function loadMorePosts(Request $request)
    {
        $except = $request->input('except', []);

        $lastPostId = $request->input('last_post');

        $query = Post::whereNotIn('id', array_keys($except))->public()->with(['categories', 'user', 'tags', 'media', 'seo'])->defaultOrdered()->limit(2);

        $lastPost = Post::select(['public_date'])->where('id', '=', $lastPostId)->first();

        if($lastPost instanceof Post)
            $query->where('public_date', '<', $lastPost->public_date);

        $posts = $query->get();

        $except = Common::groupLoadedPosts($posts, $except);

        return response()->json([
            'content' =>  view('nominal20.partials.blog.list_single_post', compact('posts'))->render(),
            'except' => $except,
        ]);
    }

    public function bankFilter(Request $request)
    {

        $query = Bank::with('media');
        if($name = $request->input('name')){
            $query->where('name', 'like', '%'.$name.'%');
        }

        if($letter = $request->input('letter')){
            $query = $letter == 'all' ? $query : $query->where('name', 'like', $letter.'%');
        }

        $banks = $query->get();

        $groupedBanks = Common::groupedBanks($banks);

        return view('front/partials/bank_list', ['banks' => $groupedBanks]);
    }

    public  function creditCashFilter(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'amount' => 'nullable|numeric',
            'days' => 'nullable|integer',
        ]);

        $query = CreditCash::with('organization')->orderByDesc('rating');

        if (!$validator->fails()) {
            if($amount = $request->input('amount', 0))
                $query->where('max_amount', '>=', $amount)->where('min_amount', '<=', $amount);

            if($days = $request->input('days', 0))
                $query->where('max_term', '>=', $days)->where('min_term', '<=', $days);
        }

        $creditsCash = $query->get();

        return view('front.partials.credit_cash_list', ['creditsCash' => $creditsCash]);
    }

    public function creditCardsFilter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank' => 'required',
            'free_service' => 'nullable|boolean',
            'cashback' => 'nullable|boolean',
            'paypass' => 'nullable|boolean',
            'chip' => 'nullable|boolean',
            'mastercard' => 'nullable|boolean',
            'visa' => 'nullable|boolean',
        ]);

        $builder = Bank::orderByDesc('rating');

        if (!$validator->fails()) {

            if($request->input('bank') != 'all')
                $builder->where('id', '=', $request->input('bank'));

            $builder->with(['creditsCard' => function($query) use ($request){
                if($request->input('free_service'))
                    $query->where('service', 'like', 'Бе%');

                if($request->input('cashback'))
                    $query->where('cash_back', '>', 0);

                if($request->input('paypass'))
                    $query->where('pay_wave', '=', 1);

                if($request->input('chip'))
                    $query->where('chip', '=', 1);

                if($request->input('mastercard'))
                    $query->where('master_card', '=', 1);

                if($request->input('visa'))
                    $query->where('visa', '=', 1);

                return $query->orderByDesc('rating');
            }]);
        }

        $banks = $builder->get();

        foreach ($banks as $key => $bank){
            if($bank->creditsCard->isEmpty())
                $banks->forget($key);
        }

        return view('front.partials.credit_cards_list', ['banks' => $banks]);
    }


    public function addComment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:2000',
            'email' => 'nullable|email',
            'name_sender' => 'required|string',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'errors' =>  $validator->errors()
            ]);
        }

        $data = [
            'user_id' => Auth::check() ? Auth::id():null,
            'commentable_id' => $request->input('id', 0),
            'commentable_type' => $request->input('type', 'none'),
            'parent_id' => $request->input('parent_id') ?:null,
            'email' => $request->input('email'),
            'name' => $request->input('name_sender'),
            'message' => $request->input('message'),
            'status' =>  Comment::PANDING_STATUS,
        ];

        if($this->commentService->create($data)){
            return response()->json([
                'errors' =>  false
            ]);
        }
        else{
            return response('Bad Request', 400);
        }

    }

    public function subscribeNews(Request $request)
    {
        $subscriber = NewsSubscriber::whereEmail($request->email)->first();

        if($subscriber == null){
            NewsSubscriber::create(['email' => $request->email]);
            return response()->json([
                'text' =>  'Спасибо! Вы Подписаны!'
            ]);
        }
        else{
            return response()->json([
                'text' =>  'Вы уже подписаны!',
            ]);
        }

    }

}
