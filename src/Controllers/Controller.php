<?php
/**
 * Created by PhpStorm.
 * User: Christianson
 * Date: 4/21/2016
 * Time: 11:18 PM
 */

namespace Crowdbabble\Controllers;


class Controller
{

    protected $container;

    public function __construct($container){
        $this->container = $container;
    }

    public function __get($property){
        if($this->container->{$property}){
            return $this->container->{$property};
        }
    }
}