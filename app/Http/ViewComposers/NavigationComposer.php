<?php
/**
 * User: Gamma-iron
 * Date: 26.05.2019
 */

namespace App\Http\ViewComposers;


use App\Entity\Blog\Category;
use App\Entity\Organization\Bank;
use App\Entity\Organization\Mfo;
use App\Entity\Product\CreditCard;
use App\Entity\Product\CreditCash;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view)
    {
        $data = Cache::tags(['categories', 'banks', 'mfos', 'cards', 'credits'])->rememberForever('navigation:data', function (){
            return [
                'categories' => Category::select(['name', 'slug'])->get(),
                'banks' => Bank::select(['name', 'slug'])->get(),
                'mfos' => Mfo::select(['name', 'slug'])->get(),
                'cards' => CreditCard::select(['name', 'slug'])->get(),
                'credits' => CreditCash::select(['name', 'slug'])->get(),
            ];
        });
        return $view->with($data);
    }
}