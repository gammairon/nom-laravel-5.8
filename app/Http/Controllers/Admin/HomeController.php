<?php
/**
 * User: Gamma-iron
 * Date: 25.03.2019
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{


    public function __construct()
    {

    }

    public function index()
    {
        return view('admin.home');
    }
}
