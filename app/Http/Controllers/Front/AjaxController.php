<?php

namespace App\Http\Controllers\Front;

use App\UseCases\AjaxService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    protected $service;

    public function __construct(AjaxService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request, string $action)
    {
        $actionMethod = Str::camel($action);

        if( method_exists($this->service, $actionMethod))
            return $this->service->{$actionMethod}($request);

        return null;
    }
}
