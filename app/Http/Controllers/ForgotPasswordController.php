<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Reminder;
use Mail;
use Sentinel;

class ForgotPasswordController extends Controller
{
	public function forgotPassword()
	{
    	return view('Authentication.forgot-password');
	}

	public function postForgotPassword(Request $request)
	{
		$user = User::whereEmail($request->email)->first();
		$userSentinel = Sentinel::findById($user->id);
		if(!$user) {
			return redirect()->back()->with([
				'success' => 'Rest code was send to your email.'
			]);
		}
		$reminder = Reminder::exists($userSentinel) ? : Reminder::create($userSentinel);
		$this->sendEmail($user, $reminder->code);
		return redirect()->back()->with([
			'success' => 'Rest code was send to your email.'
		]);
	}

	public function resetPassword($email, $resetCode)
	{
		$user = User::byEmail($email);
		$userSentinel = Sentinel::findById($user->id);
		if(!$user)
			abort(404);
		if($reminder = Reminder::exists($userSentinel)) {
			if($resetCode == $reminder->code) {
				return view('Authentication.reset-password', compact('email'));
			} else {
				return redirect()->back();
			}
		} else {
			return redirect()->back();
		}
	}

	public function postResetPassword(Request $request, $email, $resetCode)
	{
		/*$this->validate($request, [
			'password' => 'confirmed|required|min:6',
			'password_confirmation' => 'confirmed|required|min:6',
		]);*/
		$user = User::byEmail($email);
		$userSentinel = Sentinel::findById($user->id);
		if(!$user)
			abort(404);
		if($reminder = Reminder::exists($userSentinel)) {
			if($resetCode == $reminder->code) {
				Reminder::complete($userSentinel, $resetCode, $request->password);
				return redirect('/login')->with('success', 'Please login with your new password');
			} else {
				return redirect('/');
			}
		} else {
			return redirect('/');
		}
	}

	private function sendEmail($user, $code)
	{
		Mail::send('Emails.forgot-password',[
			'user' => $user,
			'code' => $code,
		], function ($message) use ($user) {
			$message->to($user->email);

			$message->subject("Hello $user->first_name $user->last_name, reset your password.");
		});
	}
}
