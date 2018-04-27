<?php

namespace App\Controllers\Auth;

use App\Controller;

class LogoutController extends Controller
{
    public function index()
    {
        auth()->logOut();

        return $this->redirect("/auth/login?fail=You have been logged out.");
    }
}
