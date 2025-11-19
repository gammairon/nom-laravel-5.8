<?php
/**
 * User: Gamma-iron
 * Date: 23.05.2019
 */

namespace App\UseCases;


use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;

abstract class BaseService
{


    protected $mailer;
    protected $dispatcher;

    public function __construct(Mailer $mailer, Dispatcher $dispatcher)
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
    }
}