<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\models\Ajustes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{



  // public function create()
  // {
  //   User::create([
  //     'name' => 'Erick Costas',
  //     'email' => 'admin@gmail.com',
  //     'password' => Hash::make('123'),
  //     'foto' => '',
  //     'rol' => 'Administrador',
  //     'estado' => 'Disponible',
  //   ]);
  // }


  public function __construct()
  {
    $this->middleware('auth');
  }






  public function Ajustes()
  {
    $ajustes = Ajustes::find(1);

    return view('modulos.Inicio', compact('ajustes'));
  }



  public function ActualizarAjustes(Request $request)
  {
    $datos = request();

    $ajustes = Ajustes::find(1);

    $ajustes->telefono = $datos["telefono"];
    $ajustes->direccion = $datos["direccion"];
    $ajustes->moneda = $datos["moneda"];
    $ajustes->zona_horaria = $datos["zona_horaria"];


    if (request('logo')) {
      $datos["logo"]->move(storage_path('app/public'), 'logo.png');
    }

    $ajustes->save();

    return redirect('Inicio');
  }



  public function ActualizarMisDatos(Request $request)
  {
    $datos = request();

    if (auth()->user()->email != request('email')) {

      if (request('password')) {

        $datos = request()->validate([
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'email', 'unique:users'],
          'password' => ['required', 'string', 'min:3'],
        ]);
      } else {

        $datos = request()->validate([
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'email', 'unique:users'],
        ]);
      }
    } else {
      if (request('password')) {

        $datos = request()->validate([
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'email'],
          'password' => ['required', 'string', 'min:3'],
        ]);
      } else {

        $datos = request()->validate([
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'email'],
        ]);
      }
    }

    if (request('fotoPerfil')) {
      $path = storage_path('app/public/' . auth()->user()->foto);

      unlink($path);

      $rutaImg = $request["fotoPerfil"]->store('Usuarios/' . $datos["name"] . '-' . $datos["email"], 'public');
    } else {
      $rutaImg = auth()->user()->foto;
    }


    if (isset($datos["password"])) {
      DB::table('users')->where('id', auth()->user()->id)->update([
        'name' => $datos["name"],
        'email' => $datos["email"],
        'foto' => $rutaImg,
        'password' => Hash::make($datos["password"])
      ]);
    } else {
      DB::table('users')->where('id', auth()->user()->id)->update([
        'name' => $datos["name"],
        'email' => $datos["email"],
        'foto' => $rutaImg,
      ]);
    }

    return redirect('Mis-Datos');
  }


  public function index()
  {
    if (auth()->user()->rol != 'Administrador') {
      return view('Inicio');
    }

    $users = User::all();
    return view('modulos.users.Usuarios', compact('users'));
  }



  public function store(Request $request)
  {
    $datos = request()->validate([
      'name' => ['string', 'max:255'],
      'email' => ['string', 'unique:users'],
      'password' => ['string', 'min:3'],
      'rol' => ['string', 'max:255']
    ]);

    User::create([
      'name' => $datos["name"],
      'email' => $datos["email"],
      'rol' => $datos["rol"],
      'password' => Hash::make($datos["password"]),
      'foto' => '',
      'estado' => 'Disponible',
    ]);

    return redirect('Usuarios')->with('UsuarioCreado', 'OK');
  }


  public function edit(string $id_usuario)
  {
    $users = User::all();

    $usuario = User::find($id_usuario);

    return view('modulos.users.Usuarios', compact('users', 'usuario'));
  }


  public function update(Request $request,  $id_usuario)
  {
    $usuario = User::find($id_usuario);

    if ($usuario["email"] != request('email')) {

      if (request('password')) {

        $datos = request()->validate([
          'name' => ['required', 'string', 'max:255'],
          'rol' => ['required'],
          'email' => ['required', 'unique:users'],
          'password' => ['string', 'min:3']
        ]);
      } else {
        $datos = request()->validate([
          'name' => ['required', 'string', 'max:255'],
          'rol' => ['required'],
          'email' => ['required', 'unique:users'],
        ]);
      }
    } else {
      if (request('password')) {

        $datos = request()->validate([
          'name' => ['required', 'string', 'max:255'],
          'rol' => ['required'],
          'email' => ['required'],
          'password' => ['string', 'min:3']
        ]);
      } else {
        $datos = request()->validate([
          'name' => ['required', 'string', 'max:255'],
          'rol' => ['required'],
          'email' => ['required'],
        ]);
      }
    }

    if (request('password')) {
      DB::table('users')->where('id', $id_usuario)->update([
        'name' => $datos['name'],
        'rol' => $datos['rol'],
        'email' => $datos['email'],
        'password' => Hash::make($datos['password'])
      ]);
    } else {
      DB::table('users')->where('id', $id_usuario)->update([
        'name' => $datos['name'],
        'rol' => $datos['rol'],
        'email' => $datos['email']
      ]);
    }

    return redirect('Usuarios')->with('UsuarioActualizado', 'OK');
  }



  public function destroy($id_usuario)
  {
    $usuario = User::find($id_usuario);

    $exp  = explode('/', $usuario->foto);

    if (Storage::delete('public/' . $usuario->foto)) {
      Storage::deleteDirectory('public/' . $exp[0] . '/' . $exp[1]);
    }

    User::destroy($id_usuario);

    return redirect('Usuarios');
  }
}
