<?php

namespace App\Controllers\Auth;

use App\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;

class LoginController extends Controller
{
    public function index()
    {
        return $this->view('auth.login');
    }

    public function store(Request $request)
    {
        $request = $request->getParsedBody();

        if (!empty($request['email']) && !empty($request['password'])) {
            try {
                $login = auth()->login($request['email'], $request['password']);
            } catch (\Exception $e) {
                return $this->redirect("/auth/login?fail=Invalid Login Attempt");
            }
        }

        return $this->redirect("/dashboard");
    }
}
