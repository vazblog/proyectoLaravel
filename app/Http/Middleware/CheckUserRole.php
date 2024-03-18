<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Obtener el usuario actualmente autenticado
            $user = Auth::user();

            // Verificar el tipo de usuario
            $tipoPerfil = $user->perfil->tipo;

            // Verificar si el usuario es administrador o cliente
            if ($tipoPerfil === 'administrador' || $tipoPerfil === 'cliente') {
                // Si es administrador o cliente, permite continuar
                return $next($request);
            }

            // Verificar si el usuario es empleado y tiene un rol permitido
            if ($tipoPerfil === 'empleado') {
                $rolEmpleado = $user->empleado ? $user->empleado->rol_empleado : null;
                // Verificar si el rol de empleado es uno de los permitidos
                if ($rolEmpleado === 'medico' || $rolEmpleado === 'estetico' || $rolEmpleado === 'auxiliar' || $rolEmpleado === 'recepcionista') {
                    // Si el rol de empleado es válido, permite continuar
                    return $next($request);
                }
            }
        }

        // Si el usuario no tiene el tipo de usuario adecuado o el rol de empleado correcto, redirige o devuelve una respuesta según sea necesario
        return redirect()->route('dashboard')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
