<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Laravel\Passport\HasApiTokens;

class UserController extends Controller
{
    use HasApiTokens, Notifiable;

    public function toggle_saved()
    {
        $id = Input::get('id');
        $user = Auth::user();
        $saved = $user->saved;
        $key = array_search($id, $saved);
        if ($key === FALSE) {
            array_push($saved, $id);
        } else {
            array_splice($saved, $key, 1);
        }
        $user->saved = $saved;
        $user->save();
        return response()->json();
    }
}
