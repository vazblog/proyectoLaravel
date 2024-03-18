<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


/**
 * Controlador para manejar las operaciones relacionadas con los usuarios.
 */
class UserController extends Controller
{



    /**
     * Muestra el perfil del usuario actual.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Verifica si el usuario tiene un perfil asociado
            if ($user->perfil_id && $user->perfil) {
                $perfil = $user->perfil;

                if ($perfil->tipo === 'cliente') {
                    // Si el usuario es un cliente, puedes acceder a sus citas aquí
                    $citas = $user->cliente->citas;
                    return view('profile', ['user' => $user, 'citas' => $citas]);
                } elseif ($perfil->tipo === 'administrador' || ($perfil->tipo === 'empleado' && $perfil->empleado)) {
                    // Si el perfil es de administrador o empleado, muestra el perfil
                    return view('profile', ['user' => $user]);
                } else {
                    // Manejo de error: Tipo de perfil desconocido
                    return redirect()->route('dashboard')->with('error', 'Error: Tipo de perfil desconocido.');
                }
            } else {
                // Manejo de error: Usuario sin perfil asociado
                return redirect()->route('dashboard')->with('error', 'Error: El usuario no tiene un perfil asociado.');
            }
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Muestra el perfil de un usuario específico.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return view('user.show', compact('user'));
    }
}
