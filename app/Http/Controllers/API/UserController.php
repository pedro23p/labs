<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request-> password
        ];

        if(Auth::attempt($credentials)) {
            $success = true;
            $messege = "Usuario foi autenticado com êxito";
        } else {
            $success = false;
            $messege = "Não autorizado!";
        }
        
        $response =[
            'success' => $success,
            'messege' => $messege
        ];
          
        return response()->json($response);
    }

    public function register(Request $request)
   {
    try {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $success = true;
        $messege = "Usuário registrado!";

    } catch (\Illuminate\Database\QueryException $ex) {
        $success = false;
        $messege = $ex->getMessage();

    }
    $response =[
        'success' => $success,
        'messege' => $messege
    ];

    return response()->json($response);

   }

   public function logout()
   {
       try {
           Session::flush();
           $success = true;
           $message = "Logout concluído";
       } catch (\Illuminate\Database\QueryException $ex) {
           $success = false;
           $message = $ex->getMessage();
       }

       $response = [
           'success' => $success,
           'message' => $message
       ];

       return response()->json($response);
   }
}
