<?php
/**
 * User: Gamma-iron
 * Date: 26.05.2019
 */

namespace App\UseCases\Blade;


use App\Entity\Organization\Bank;
use App\Entity\Organization\Mfo;
use App\Entity\Product\CreditCard;
use App\Entity\Product\CreditCash;
use Gornymedia\Shortcodes\Facades\Shortcode;
use Illuminate\Support\Facades\Auth;

class ShortcodeFactory
{
    private $viewPath = 'front/shortcodes';

    protected $shortcodes = [
        'mfo_list',
        'mfo_list_group',
        'mfo_free_loan_list',
        'mfo_contact_list',
        'credit_card_list',
        'credit_cash_list'
    ];


    public function __construct(array $config = [])
    {
    }

    public function register()
    {
        foreach ($this->shortcodes as $shortcode) {
            $this->$shortcode();
        }
    }

    public function mfo_list()
    {
        Shortcode::add('mfo_list', function($atts, $content, $name)
        {
            $attributes = Shortcode::atts([
                'exclude' => '0',
            ], $atts);

            $excludeIds = array_map(function ($id){
                return intval($id);
            }, explode(',', $attributes['exclude']));

           /* if(Auth::check() && Auth::user()->id === 1){

                dump($excludeIds);
            }*/

            $mfos = Mfo::with('media')->whereNotIn('id', $excludeIds)->orderByDesc('rating')->get();
            $min_amount = Mfo::whereNotIn('id', $excludeIds)->min('min_amount');
            $max_amount = Mfo::whereNotIn('id', $excludeIds)->max('max_amount');
            $min_term = Mfo::whereNotIn('id', $excludeIds)->min('min_term');
            $max_term = Mfo::whereNotIn('id', $excludeIds)->max('max_term');

            return view($this->viewPath.'/mfo_list', compact('mfos', 'min_amount', 'max_amount', 'min_term', 'max_term'));
        });
    }

    public function mfo_list_group()
    {
        Shortcode::add('mfo_list_group', function($atts, $content, $name)
        {
            $properties = Shortcode::atts([
                'list_id' => 0,
                'ref_link' => 1,
            ], $atts);

            $mfos = Mfo::with('media')->join('list_mfo', function ($query) use ($properties){
                $query->on('mfo_org.id', 'list_mfo.mfo_id')
                    ->where('list_mfo.list_id', $properties['list_id']);
            })->orderBy('list_mfo.sort')->get();

            //Эксперимент с реферами контекстной рекламы
            /*if (request()->path() == 'zaim-na-kartochku'){
                foreach ($mfos as $mfo) {
                    $mfo->ref_link .= '&sub2=cntx';
                }
            }*/
            //===============================================

            $min_amount = $mfos->min('min_amount');
            $max_amount = $mfos->max('max_amount');
            $min_term = $mfos->min('min_term');
            $max_term = $mfos->max('max_term');
            $type = 'group';
            $list_id = $properties['list_id'];
            $ref_link_type = $properties['ref_link'];


            return view($this->viewPath.'/mfo_list_group', compact('mfos', 'min_amount', 'max_amount', 'min_term', 'max_term', 'type', 'list_id', 'ref_link_type'));
        });
    }

    public function mfo_free_loan_list()
    {
        Shortcode::add('mfo_free_loan_list', function($atts, $content, $name)
        {
            /*$a = Shortcode::atts([
                'view_name' => $name,
                'foo' => 'something',
            ], $atts);*/

            $mfos = Mfo::with('media')->where('free_credit_bid', '<=', 0.01)->orderByDesc('rating')->get();
            $min_amount = Mfo::min('min_amount');
            $max_amount = Mfo::max('max_amount');
            $min_term = Mfo::min('min_term');
            $max_term = Mfo::max('max_term');

            return view($this->viewPath.'/mfo_free_loan_list', compact('mfos', 'min_amount', 'max_amount', 'min_term', 'max_term'));
        });
    }

    public function mfo_contact_list()
    {
        Shortcode::add('mfo_contact_list', function($atts, $content, $name)
        {
            $properties = Shortcode::atts([
                'list_id' => 0,
            ], $atts);

            if ($properties['list_id'] != 0){
                $mfos = Mfo::with('media')->whereNotNull('nfs_license')->join('list_mfo', function ($query) use ($properties){
                    $query->on('mfo_org.id', 'list_mfo.mfo_id')
                        ->where('list_mfo.list_id', $properties['list_id']);
                })->orderBy('list_mfo.sort')->get();
            }
            else{
                $mfos = Mfo::with('media')->whereNotNull('nfs_license')->orderByDesc('rating')->get();
            }




            return view($this->viewPath.'/mfo_contact_list', compact('mfos'));
        });
    }

    public function credit_card_list()
    {
        Shortcode::add('credit_card_list', function($atts, $content, $name)
        {
            /*$a = Shortcode::atts([
                'view_name' => $name,
                'foo' => 'something',
            ], $atts);*/

            $banks = Bank::with(['creditsCard' => function($query){
                return $query->with('media')->orderByDesc('rating');
            }, 'media'])->orderByDesc('rating')->get();

            return view($this->viewPath.'/credit_card_list', compact('banks'));
        });
    }

    public function credit_cash_list()
    {
        Shortcode::add('credit_cash_list', function($atts, $content, $name)
        {
            /*$a = Shortcode::atts([
                'view_name' => $name,
                'foo' => 'something',
            ], $atts);*/

            $creditsCash = CreditCash::with('organization')->orderByDesc('rating')->get();

            $min_amount = CreditCash::min('min_amount');
            $max_amount = CreditCash::max('max_amount');
            $min_term = CreditCash::min('min_term');
            $max_term = CreditCash::max('max_term');

            return view($this->viewPath.'/credit_cash_list', compact('creditsCash', 'min_amount', 'max_amount', 'min_term', 'max_term'));
        });
    }

}
