<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 4/21/2016
 * Time: 6:16 PM
 */

namespace Crowdbabble\Controllers;

class HomeController extends Controller
{

    public function index($request, $response)
    {
        return $this->view->render($response, 'home.twig');
    }
}