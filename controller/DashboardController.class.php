<?php

class DashboardController
{

    static function index()
    {
        ViewController::view('templates/header');
        ViewController::view('dashboard/index');
        ViewController::view('templates/footer');
    }
}
