<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Invite;
use App\Mail\InviteCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class InviteController extends Controller
{

  public static function availableInvites() {
    if (Auth::user() && Auth::user()->id === 1) {
      return 99999;
    }
    $invites = 0;
    if (isset(Auth::user()->created_at)) {
      $now = time(); // or your date as well
      $your_date = strtotime(Auth::user()->created_at->format('Y-m-d'));
      $datediff = $now - $your_date;
      $invites = ceil($datediff / (60 * 60 * 24 * 30));
      if (isset(Auth::user()->invites)) {
        $invites = $invites - Auth::user()->invites;
      }
    }
    return $invites;
  }

  public function invite()
  {
    // show the user a form with an email field to invite a new user
    return view('invite');
  }

  public function process(Request $request, User $user)
  {
    // process the form submission and send the invite by email
    do {
        //generate a random string using Laravel's str_random helper
        $token = Str::random();
    } //check if the token already exists and if it does, try again
    while (Invite::where('token', $token)->first());
    //create a new invite record
    $invite = Invite::create([
        'email' => $request->get('email'),
        'token' => $token,
        'invitedBy' => Auth::user()->id
    ]);

    Auth::user()->increment('invites');

    // send the email
    Mail::to($request->get('email'))->send(new InviteCreated($invite));
    // redirect back where we came from
    return redirect()
        ->back();
  }

  public function acceptForm($token) {
    return view('acceptform');
  }

  public function accept($token)
  {
    // here we'll look up the user by the token sent provided in the URL
    // Look up the invite

    if (!$invite = Invite::where('token', $token)->first()) {
        //if the invite doesn't exist do something more graceful than this
        //abort(404);
        return false;
    }

    // create the user with the details from the invite
    //User::create(['email' => $invite->email]);

    // delete the invite so it can't be used again
    //
    $invitedBy = $invite->invitedBy;

    $invite->delete();



    // here you would probably log the user in and show them the dashboard, but we'll just prove it worked
    return $invitedBy;
  }

  public function registerForm($token = null) {
    if (!$token) {
      return view('auth.registerWithoutToken');
    }
    $validToken = Invite::where('token', $token)->first();
    if (!$validToken) {
      return redirect()->route('home');
    }
    return view('auth.register',['email'=>($validToken) ? $validToken->email : '','token'=>$token]);
  }

}
