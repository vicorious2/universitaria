<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function loginAdmin(Request $request){

        $credentials = $request->validate([
            'correo' => ['required', 'email'],
            'password' => ['required'],
        ]);
       
        if (Auth::attempt(['correo' => $request->correo, 'password' =>  $request->password, 'id_estado' => 1, 'id_tipo_usuario' => 1])) {
            
            $request->session()->regenerate();

            return redirect()->intended('/')->with('Mensaje','Bienvenido!');;
        }

        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('correo');

    }

    public function logoutAdmin(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('Mensaje','Sesion Cerrada!');
    }

    // Login y Logout de estudiantes y profesores
    public function loginUser(Request $request){
        
        if (Auth::attempt(['correo' => $request->correo, 'password' => $request->password, 'id_tipo_usuario' => $request->tipo_usuario ])) {
            
           return response()->json(['message' =>'Unauthorized'],401);
        }

        //datos de ususario diferentes de administrador
        $user = User::where([
            ['correo', '=', $request->correo],
            ['id_tipo_usuario', '<>', 1],
        ])->firstOrFail();
        
        //validacion estado activo
        if($user->id_estado <> 1){
            return response()->json(['message' =>'Ususario Inactivo'],401);
        }
        
        //generacion de token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json([
                'message' => 'Authorized',
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);

    }

    public function logoutUser(Request $request){

        $user = User::where('id_usuario', $request->id_usuario )->firstOrFail();
        $user->tokens()->delete();
    }
}
