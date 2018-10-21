<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

class LoginController extends Controller
{
    public function login()
    {
    	return view('Authentication.login');
    }

    public function postLogin(Request $request)
    {
        try {
            if(Sentinel::authenticate($request->all())) {
                return redirect('/home');
            } else {
                return redirect()->back()->with(['error' => 'wrong credentials.']);
            }
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            return redirect()->back()->with(['error' => 'you was banned for ' . $delay .  ' seconds.']);
        } catch (NotActivatedException $e) {
            return redirect()->back()->with(['error' => 'your account is not activated !!!']);
        }
    }

    public function logout()
    {
    	Sentinel::logout();
    	return redirect('/login');
    }
}
