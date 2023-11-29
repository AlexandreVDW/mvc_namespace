<?php
declare(strict_types = 1);

namespace App\Controllers;

class HomepageController
{
    public function index()
    {
        // Load the view
        require 'Views/home.php';
    }
}