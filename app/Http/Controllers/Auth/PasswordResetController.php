<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class PasswordResetController extends Controller
{
     // Mostrar formulario para solicitar restablecimiento
     public function showForgotPasswordForm()
     {
         return view('administrador.auth.forgot-password');
     }
 
     // Enviar enlace de restablecimiento
     public function sendResetLinkEmail(Request $request)
     {
         $request->validate(['email' => 'required|email']);
 
         $status = Password::sendResetLink(
             $request->only('email')
         );
 
         return $status === Password::RESET_LINK_SENT
             ? back()->with(['status' => __($status)])
             : back()->withErrors(['email' => __($status)]);
     }
 
     // Mostrar formulario para ingresar nueva contraseña
     public function showResetPasswordForm($token)
     {
         return view('administrador.auth.reset-password', ['token' => $token]);
     }
 
     // Restablecer la contraseña
     public function resetPassword(Request $request)
     {
         $request->validate([
             'token' => 'required',
             'email' => 'required|email',
             'password' => 'required|min:8|confirmed',
         ]);
 
         $status = Password::reset(
             $request->only('email', 'password', 'password_confirmation', 'token'),
             function ($user, $password) {
                 $user->forceFill([
                     'password' => Hash::make($password),
                     'remember_token' => Str::random(60),
                 ])->save();
             }
         );
 
         return $status === Password::PASSWORD_RESET
             ? redirect()->route('login')->with('status', __($status))
             : back()->withErrors(['email' => [__($status)]]);
     }
}
