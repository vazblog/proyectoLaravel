<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controlador para manejar las solicitudes relacionadas con el panel de control.
 */
class DashboardController extends Controller
{

    /**
     * Muestra el panel de control.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Aquí puedes colocar la lógica para mostrar el panel de control
        return view('dashboard.index');
    }
}
