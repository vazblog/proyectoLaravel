<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Perfil;
use App\Models\Tratamiento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;



class TratamientoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    /**
     * Test unitario: Verifica que un usuario no autenticado sea redirigido a la página de inicio de sesión al intentar acceder a una página protegida.
     *
     * @return void
     */
    public function test_usuario_no_autenticado_redirigido_a_pagina_de_inicio_sesion()
    {
        // Hacemos una solicitud HTTP GET a una página protegida, en este caso, la página de lista de tratamientos
        $response = $this->get(route('tratamientos.index'));

        // Verificamos que la respuesta sea una redirección (código de estado 302)
        $response->assertStatus(302);

        // Verificamos que el usuario sea redirigido a la página de inicio de sesión
        $response->assertRedirect(route('login'));
    }



    /**
     * Test unitario: Verifica que la vista de index muestre la lista de administradores.
     *
     * @return void
     */
    public function test_index_muestra_la_lista_de_administradores()
    {

        $controller = new AdminController();


        $adminPerfil = Perfil::create(['descripcion' => 'Perfil de usuario', 'tipo' => 'administrador']);
        $admin = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'apellido_uno' => 'Apellido Uno',
            'fecha_nac' => '1990-01-01',
            'telefono' => '123456789',
            'direccion' => 'Calle Principal',
            'cp' => '12345',
            'poblacion' => 'Ciudad',
            'DNI' => '12345678X',
            'suscripcion' => 'S',
            'perfil_id' => $adminPerfil->id,
        ]);


        $administradores = [];
        for ($i = 0; $i < 3; $i++) {
            $administrador = new User();
            $administrador->name = 'Admin ' . ($i + 1);
            $administrador->email = 'admin' . ($i + 1) . '@example.com';
            $administrador->password = bcrypt('password');
            $administrador->save();

            $perfilAdministrador = Perfil::create(['descripcion' => 'Perfil de administrador', 'tipo' => 'administrador']);
            $administrador->perfil_id = $perfilAdministrador->id;
            $administrador->save();

            $administradores[] = $administrador;
        }

        $this->actingAs($admin);

        $response = $this->withoutMiddleware()->get(route('usuarios.administrador.index'));

        $response->assertStatus(200);


        $response->assertViewIs('usuarios.administrador.index');


        $response->assertViewHas('administradores');
    }


    /**
     * Test unitario: Verifica que se pueda acceder a la página de inicio.
     *
     * @return void
     */
    public function test_index_muestra_la_pagina_de_inicio()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    /**
     * Test unitario: Verifica que se pueda renderizar la pantalla de inicio de sesión.
     *
     * @return void
     */
    public function test_renderizado_pantalla_de_inicio_de_sesion()
    {
        $response = $this->get('/auth/login');

        $response->assertStatus(200);
    }

    /**
     * Test unitario: Verifica que los usuarios puedan autenticarse correctamente.
     *
     * @return void
     */
    public function test_usuarios_autenticacion_pantalla_login()
    {
        $user = User::factory()->create();

        $response = $this->post('/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * Test unitario: Verifica que los usuarios no puedan autenticarse con contraseña incorrecta.
     *
     * @return void
     */
    public function test_suarios_no_pueden_autenticarse_con_contraseña_invalida()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }


    /**
     * Test unitario: Verifica que se pueda renderizar la pantalla de registro.
     *
     * @return void
     */
    public function test_renderizado_de_pantalla_de_registro()
    {
        $response = $this->get('/auth/register');

        $response->assertStatus(200);
    }


    /**
     * Test unitario: Verifica que se pueda acceder a la lista de productos cuando el usuario esté autenticado como cliente.
     *
     * @return void
     */
    public function test_index_muestra_lista_productos_autenticado()
    {


        $imagePath = public_path('upload/no_images.jpg');


        $file = new UploadedFile($imagePath, 'no_images.jpg', 'image/jpeg', null, true);


        $perfilCliente = Perfil::create(['descripcion' => 'Perfil de cliente', 'tipo' => 'cliente']);


        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'apellido_uno' => 'Apellido Uno',
            'fecha_nac' => '1990-01-01',
            'telefono' => '123456789',
            'direccion' => 'Calle Principal',
            'cp' => '12345',
            'poblacion' => 'Ciudad',
            'DNI' => '12345678X',
            'suscripcion' => 'S',
            'photo' => $file,
            'perfil_id' => $perfilCliente->id,
        ]);


        $this->actingAs($user);


        $response = $this->get(route('productos.index'));


        $response->assertStatus(200);

        $response->assertViewIs('productos.index');


        $response->assertViewHas('productos');
    }


    /**
     * Test unitario: Verifica que se pueda acceder a la lista de usuarios cliente cuando el usuario esté autenticado como cliente.
     *
     * @return void
     */
    public function test_index_muestra_lista_usuarios_cliente()
    {

        $imagePath = public_path('upload/no_images.jpg');


        $file = new UploadedFile($imagePath, 'no_images.jpg', 'image/jpeg', null, true);


        $perfilCliente = Perfil::create(['descripcion' => 'Perfil de cliente', 'tipo' => 'cliente']);

        $usuarioCliente = User::create([
            'name' => 'Test Cliente',
            'email' => 'cliente@example.com',
            'password' => bcrypt('password'),
            'apellido_uno' => 'Apellido Uno',
            'fecha_nac' => '1990-01-01',
            'telefono' => '123456789',
            'direccion' => 'Calle Principal',
            'cp' => '12345',
            'poblacion' => 'Ciudad',
            'DNI' => '12345678X',
            'suscripcion' => 'S',
            'photo' => $file,
            'perfil_id' => $perfilCliente->id,
        ]);

        $this->actingAs($usuarioCliente);

        $response = $this->get(route('usuarios.cliente.index'));


        $response->assertStatus(200);


        $response->assertViewIs('usuarios.cliente.index');
    }


    /**
     * Test unitario: Verifica que se pueda acceder a la lista de usuarios empleado cuando el usuario esté autenticado como empleado.
     *
     * @return void
     */
    public function test_index_muestra_lista_usuarios_empleado()
    {

        $imagePath = public_path('upload/no_images.jpg');


        $file = new UploadedFile($imagePath, 'no_images.jpg', 'image/jpeg', null, true);


        $perfilEmpleado = Perfil::create(['descripcion' => 'Perfil de empleado', 'tipo' => 'empleado']);


        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'apellido_uno' => 'Apellido Uno',
            'fecha_nac' => '1990-01-01',
            'telefono' => '123456789',
            'direccion' => 'Calle Principal',
            'cp' => '12345',
            'poblacion' => 'Ciudad',
            'DNI' => '12345678X',
            'suscripcion' => 'S',
            'photo' => $file,
            'perfil_id' => $perfilEmpleado->id,
        ]);


        $this->actingAs($user);


        $response = $this->withoutMiddleware()->get(route('usuarios.empleado.index'));

        $response->assertStatus(200);


        $response->assertViewIs('usuarios.empleado.index');


        $response->assertViewHas('empleados');
    }

    /**
     * Test unitario: Verifica que se pueda acceder a la lista de usuarios administrador cuando el usuario esté autenticado como administrador.
     *
     * @return void
     */
    public function test_index_muestra_lista_usuarios_administrador()
    {


        $imagePath = public_path('upload/no_images.jpg');


        $file = new UploadedFile($imagePath, 'no_images.jpg', 'image/jpeg', null, true);



        $perfilAdministrador = Perfil::create(['descripcion' => 'Perfil de usuario', 'tipo' => 'administrador']);


        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'apellido_uno' => 'Apellido Uno',
            'fecha_nac' => '1990-01-01',
            'telefono' => '123456789',
            'direccion' => 'Calle Principal',
            'cp' => '12345',
            'poblacion' => 'Ciudad',
            'DNI' => '12345678X',
            'suscripcion' => 'S',
            'photo' => $file,
            'perfil_id' => $perfilAdministrador->id,
        ]);


        $this->actingAs($user);

        $response = $this->withoutMiddleware()->get(route('usuarios.administrador.index'));

        $response->assertStatus(200);


        $response->assertViewIs('usuarios.administrador.index');

        // Verificar que la vista contenga la variable 'usuarios'
        $response->assertViewHas('administradores');
    }




    /**
     * Test unitario: Verifica que un usuario autenticado como administrador pueda acceder a la página de administradores.
     *
     * @return void
     */
    public function test_authenticated_user_can_access_administrators_page()
    {


        $imagePath = public_path('upload/no_images.jpg');


        $file = new UploadedFile($imagePath, 'no_images.jpg', 'image/jpeg', null, true);

        // Antes de tus pruebas, asegúrate de crear un perfil de administrador en la base de datos
        Perfil::create(['descripcion' => 'Perfil de administrador', 'tipo' => 'administrador']);

        // Ahora, en tus pruebas, asegúrate de asignar el ID del perfil de administrador al crear el usuario
        $adminPerfil = Perfil::where('tipo', 'administrador')->first();


        // Creamos un usuario administrador
        $admin = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'apellido_uno' => 'Apellido Uno',
            'fecha_nac' => '1990-01-01',
            'telefono' => '123456789',
            'direccion' => 'Calle Principal',
            'cp' => '12345',
            'poblacion' => 'Ciudad',
            'DNI' => '12345678X',
            'photo' => $file,
            'perfil_id' => 1,
        ]);

        // Actuamos como el usuario administrador
        $this->actingAs($admin);

        // Hacemos una solicitud HTTP GET a la página de administradores
        $response = $this->get(route('usuarios.administrador.index'));

        // Verificamos que la solicitud sea exitosa (código de estado 200)
        $response->assertStatus(200);

        // Verificamos que la vista devuelta sea la vista esperada
        $response->assertViewIs('usuarios.administrador.index');

        // Verificamos que la vista tenga la variable 'administradores'
        $response->assertViewHas('administradores');
    }


    /**
     * Test integración: Verifica que se pueda acceder a la lista de citas cuando el usuario esté autenticado como administrador.
     *
     * @return void
     */
    public function test_index_muestra_lista_citas_autenticado()
    {

        $perfilAdministrador = Perfil::create(['descripcion' => 'Perfil de administrador', 'tipo' => 'administrador']);


        $imagePath = public_path('upload/no_images.jpg');

        $file = new UploadedFile($imagePath, 'no_images.jpg', 'image/jpeg', null, true);


        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'apellido_uno' => 'Apellido Uno',
            'fecha_nac' => '1990-01-01',
            'telefono' => '123456789',
            'direccion' => 'Calle Principal',
            'cp' => '12345',
            'poblacion' => 'Ciudad',
            'DNI' => '12345678X',
            'suscripcion' => 'S',
            'photo' => $file,
            'perfil_id' => $perfilAdministrador->id,
        ]);



        $this->actingAs($user);


        $response = $this->get(route('citas.index'));


        $response->assertStatus(200);


        $response->assertViewIs('citas.index');


        $response->assertViewHas('citas');
    }

    /**
     * Test integración: Verifica que se pueda acceder a la lista de facturas cuando el usuario esté autenticado como administrador.
     *
     * @return void
     */
    public function test_index_muestra_lista_facturas_autenticado()
    {

        $perfilAdministrador = Perfil::create(['descripcion' => 'Perfil de administrador', 'tipo' => 'administrador']);


        $imagePath = public_path('upload/no_images.jpg');

        $file = new UploadedFile($imagePath, 'no_images.jpg', 'image/jpeg', null, true);


        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'apellido_uno' => 'Apellido Uno',
            'fecha_nac' => '1990-01-01',
            'telefono' => '123456789',
            'direccion' => 'Calle Principal',
            'cp' => '12345',
            'poblacion' => 'Ciudad',
            'DNI' => '12345678X',
            'suscripcion' => 'S',
            'photo' => $file,
            'perfil_id' => $perfilAdministrador->id,
        ]);



        $this->actingAs($user);


        $response = $this->get(route('facturas.index'));


        $response->assertStatus(200);


        $response->assertViewIs('facturas.index');


        $response->assertViewHas('facturas');
    }


    /**
     * Test de integración: Verifica que se pueda acceder a la lista de tratamientos.
     *
     * @return void
     */
    public function test_index_muestra_lista_tratamientos()
    {

        $imagePath = public_path('upload/no_images.jpg');

        $file = new UploadedFile($imagePath, 'no_images.jpg', 'image/jpeg', null, true);

        // Creamos un usuario administrador
        $perfilAdministrador = Perfil::create(['descripcion' => 'Perfil de administrador', 'tipo' => 'administrador']);
        $admin = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'apellido_uno' => 'Apellido Uno',
            'fecha_nac' => '1990-01-01',
            'telefono' => '123456789',
            'direccion' => 'Calle Principal',
            'cp' => '12345',
            'poblacion' => 'Ciudad',
            'DNI' => '12345678X',
            'suscripcion' => 'S',
            'photo' => $file,
            'perfil_id' => $perfilAdministrador->id,
        ]);

        // Creamos algunos tratamientos manualmente
        $tratamiento1 = Tratamiento::create([
            'nombre' => 'Limpieza profunda de cutis',
            'descripcion' => 'Limpieza de cutis profunda antienvejecmeinto',
            'precio' => '50',
            'duracion' => '50',
        ]);
        $tratamiento2 = Tratamiento::create([
            'nombre' => 'Masaje facial antiedad',
            'descripcion' => 'Masaje facial para estimular la circulación',
            'precio' => '35',
            'duracion' => '40',
        ]);

        // Actuamos como el usuario administrador
        $this->actingAs($admin);

        // Hacemos una solicitud HTTP GET a la ruta de index de tratamientos
        $response = $this->get(route('tratamientos.index'));

        // Verificamos que la respuesta sea exitosa (código de estado 200)
        $response->assertStatus(200);

        // Verificamos que la vista devuelta sea la vista esperada
        $response->assertViewIs('tratamientos.index');

        // Verificamos que la vista contenga los tratamientos creados manualmente
        $response->assertSee($tratamiento1->nombre);
        $response->assertSee($tratamiento2->nombre);
    }
}
