<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\MessageBag;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email',$request->email)->first();
        $token = Password::createToken($user);
        Mail::to($request->email)->send(new ResetPassword($user->name,$token));

        if(Mail::failures() != 0) {
            return response()->json(null, Response::HTTP_OK);
        }
        else {
            return response()->json(['messages' => new MessageBag(['email' => __($user->email)])], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
