<?php
/**
 * User: Artem
 * Date: 27.07.2020
 */

namespace App\Http\ViewComposers\Nominal20;


use App\Entity\Weather;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
        $data = [
            //'weather' => Weather::first(),
        ];
        return $view->with($data);
    }
}
