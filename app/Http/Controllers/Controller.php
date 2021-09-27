<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Default page title
     *
     * @var string
     */
    public $_pageTitle = "";

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setupPageTitle();
    }

    /**
     * Sets page title data
     *
     * @return void
     */
    protected function setupPageTitle()
    {
        View::share('_pageTitle', $this->_pageTitle);
    }

}
