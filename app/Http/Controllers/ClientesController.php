<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }



  public function index()
  {
    $clientes = Clientes::all();
    return view('modulos.clientes.Clientes', compact('clientes'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('modulos.clientes.Crear-Clientes');
  }


  public function store(Request $request)
  {
    $datos = request()->validate([
      'nombre' => ['string', 'max:255'],
      'email' => ['email', 'unique:clientes'],
      'documento' => ['string', 'unique:clientes'],
      'telefono' => ['string'],
      'direccion' => ['string',],
    ]);

    Clientes::create([
      'nombre' => $datos["nombre"],
      'documento' => $datos["documento"],
      'telefono' => $datos["telefono"],
      'email' => $datos["email"],
      'direccion' => $datos["direccion"],
    ]);

    return redirect('Clientes')->with('ClienteAgreagado', 'OK');
  }



  public function edit($id_clientes)
  {
    $cliente = Clientes::find($id_clientes);

    return view('modulos.clientes.Editar-Cliente', compact('cliente'));
  }



  public function update(Request $request, $id_cliente)
  {
    $cliente = Clientes::find($id_cliente);

    if ($cliente["documento"] != request('documento') && $cliente["email"] != request('email')) {

      $datos = request()->validate([
        'nombre' => ['string', 'max:255'],
        'email' => ['email', 'unique:clientes'],
        'documento' => ['string', 'unique:clientes'],
        'telefono' => ['string'],
        'direccion' => ['string'],
      ]);
    } elseif ($cliente["documento"] != request('documento') && $cliente["email"] == request('email')) {

      $datos = request()->validate([
        'nombre' => ['string', 'max:255'],
        'email' => ['email',],
        'documento' => ['string'],
        'telefono' => ['string'],
        'direccion' => ['string'],
      ]);
    } elseif ($cliente["documento"] == request('documento') && $cliente["email"] == request('email')) {

      $datos = request()->validate([
        'nombre' => ['string', 'max:255'],
        'email' => ['email'],
        'documento' => ['string'],
        'telefono' => ['string'],
        'direccion' => ['string'],
      ]);
    } elseif ($cliente["documento"] == request('documento') && $cliente["email"] != request('email')) {

      $datos = request()->validate([
        'nombre' => ['string', 'max:255'],
        'email' => ['email', 'unique:clientes'],
        'documento' => ['string'],
        'telefono' => ['string'],
        'direccion' => ['string'],
      ]);
    }

    DB::table('clientes')->where('id', $id_cliente)->update([
      'nombre' => $datos['nombre'],
      'email' => $datos['email'],
      'documento' => $datos['documento'],
      'telefono' => $datos['telefono'],
      'direccion' => $datos['direccion'],
    ]);
    return redirect('Clientes')->with('ClienteActualizado', 'OK');
  }
}
