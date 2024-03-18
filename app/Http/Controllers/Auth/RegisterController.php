<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Perfil;
use App\Models\Empleado;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Carbon\Carbon;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'apellido_uno' => 'required|string|max:255',
            'apellido_dos' => 'nullable|string|max:255',
            'fecha_nac' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $fechaNacimiento = Carbon::createFromFormat('Y-m-d', $value);
                    $edadMinima = Carbon::now()->subYears(18);
                    if ($fechaNacimiento->greaterThanOrEqualTo($edadMinima)) {
                        $fail('Debes tener al menos 18 años.');
                    }
                },
            ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => 'required|integer|digits:9',
            'direccion' => 'required|string|max:255',
            'cp' => 'required|integer|digits:5',
            'poblacion' => 'required|string|max:255',
            'DNI' => 'required|string|max:9|regex:/^\d{8}[a-zA-Z]$/',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'suscripcion' => 'required|in:S,N',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,tmp|max:2048',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function create(array $data)
    {

        try {
            // Validar los datos del formulario
            $validator = $this->validator($data);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Obtener el ID del perfil de tipo cliente
            $perfilClienteId = Perfil::where('tipo', 'cliente')->value('id');

            // Crear el nuevo usuario con el perfil de cliente
            $user = User::create([
                'DNI' => $data['DNI'],
                'name' => $data['name'],
                'apellido_uno' => $data['apellido_uno'],
                'apellido_dos' => $data['apellido_dos'],
                'fecha_nac' => $data['fecha_nac'],
                'telefono' => $data['telefono'],
                'direccion' => $data['direccion'],
                'cp' => $data['cp'],
                'poblacion' => $data['poblacion'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'perfil_id' => $perfilClienteId,
            ]);

            // Guardar la imagen de perfil del usuario si se ha proporcionado
            if (isset($data['photo'])) {
                $file = $data['photo'];
                $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $filename);
                $user->photo = $filename;
                $user->save();
            }

            // Crear el registro de cliente
            Cliente::create([
                'user_id' => $user->id,
                'suscripcion' => $data['suscripcion'], // Asignar la suscripción del cliente
            ]);

            return $user;

        } catch (\Exception $e) {
            // Manejar cualquier excepción y redirigir con un mensaje de error
            return redirect()->back()->withInput()->with('error', 'Error al crear el cliente: ' . $e->getMessage());
        }
    }









    public function showRegistrationForm()
    {

        if (auth()->check()) {
            return redirect()->route('home'); // Redirige al usuario a la página principal si ya está autenticado
        }

        return view('auth.register'); // Muestra el formulario de registro si el usuario no está autenticado
    }
}
