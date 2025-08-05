<?php

namespace App\Http\Controllers;

use App\Models\Mascotas;
use App\Models\Clientes;
use App\Models\User;
use App\Models\Vacunas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Elibyy\TCPDF\Facades\TCPDF;
use Exception;



class MascotasController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }




  public function index()
  {
    $clientes = Clientes::all();
    $mascotas = Mascotas::all();


    return view('modulos.mascotas.Mascotas', compact('clientes', 'mascotas'));
  }



  public function store(Request $request)
  {
    $datos = request();

    $dueño = Clientes::find($datos['id_cliente']);

    if (request('foto')) {
      $rutaImg = $datos["foto"]->store('Clientes/' . $dueño->nombre . '-' . $dueño->documento . '/' . $datos['nombre'], 'public');
    }

    if ($datos["detalles"] == null) {
      $detalles = 'Sin Detalles';
    } else {
      $detalles = $datos["detalles"];
    }

    Mascotas::create([
      'id_cliente' => $datos['id_cliente'],
      'nombre' => $datos['nombre'],
      'especie' => $datos['especie'],
      'raza' => $datos['raza'],
      'peso' => $datos['peso'],
      'sexo' => $datos['sexo'],
      'edad' => $datos['edad'],
      'detalles' => $detalles,
      'foto' => $rutaImg
    ]);

    return redirect('Mascotas')->with('MascotaAgregada', 'OK');
  }



  public function VerMascotasCliente($id_cliente)
  {
    $cliente = Clientes::find($id_cliente);

    $mascotas = Mascotas::where('id_cliente', $id_cliente)->get();

    return view('modulos.mascotas.Ver-Mascotas-Cliente', compact('cliente', 'mascotas'));
  }




  public function edit($id_mascota)
  {
    $clientes = Clientes::all();

    $mascotas = Mascotas::all();

    $masc = Mascotas::find($id_mascota);

    return view('modulos.mascotas.Mascotas', compact('clientes', 'mascotas', 'masc'));
  }



  public function update(Request $request,  $id_mascota)
  {
    $datos = request();
    $MASCOTA = Mascotas::find($id_mascota);

    $MASCOTA->id_cliente = $datos['id_cliente'];
    $MASCOTA->nombre = $datos['nombre'];
    $MASCOTA->especie = $datos['especie'];
    $MASCOTA->raza = $datos['raza'];
    $MASCOTA->peso = $datos['peso'];
    $MASCOTA->sexo = $datos['sexo'];
    $MASCOTA->edad = $datos['edad'];


    if ($datos["detalles"] == null) {
      $detalles = 'Sin Detalles';
    } else {
      $detalles = $datos["detalles"];
    }
    $MASCOTA->detalles = $detalles;

    $dueño = Clientes::find($MASCOTA->id_cliente);

    if (request('foto')) {

      Storage::delete('public/' . $MASCOTA->foto);

      $rutaImg = $datos["foto"]->store('Clientes/' . $dueño->nombre . '-' . $dueño->documento . '/' . $datos['nombre'], 'public');

      $MASCOTA->foto = $rutaImg;
    }
    $MASCOTA->save();

    return redirect('Mascotas')->with('MascotaActualizada', 'OK');
  }



  public function VacunasMascota($id_mascota)
  {
    $mascota = Mascotas::find($id_mascota);
    $veterinarios = User::where('rol', 'Veterinario')->get();
    $vacunas = Vacunas::where('id_mascota', $id_mascota)->get();


    return view('modulos.mascotas.Vacunas', compact('mascota', 'veterinarios', 'vacunas'));
  }



  public function AgregarVacuna(Request $request, $id_mascota)
  {

    $datos = request();

    if ($datos["prox_fecha"] == null) {
      $prox_fecha = 'Fin';
    } else {
      $prox_fecha = $datos["prox_fecha"];
    }

    Vacunas::create([

      'id_mascota' => $id_mascota,
      'id_veterinario' => $datos['id_veterinario'],
      'vacuna' => $datos['vacuna'],
      'fecha' => $datos['fecha'],
      'prox_fecha' => $prox_fecha,

    ]);

    return redirect('Vacunas/' . $id_mascota)->with('VacunaAgregada', 'OK');
  }



  public function CarnetVacunasPDF($id_mascota)
  {
    try {
      // Configuración inicial del PDF
      $pdf = new \Elibyy\TCPDF\TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

      $pdf->SetCreator('Sistema Veterinario');
      $pdf->SetAuthor('Veterinaria');
      $pdf->SetTitle('Carnet de Vacunas - Mascota');
      $pdf->SetSubject('Registro de Vacunación');
      $pdf->SetKeywords('vacunas, mascota, veterinaria, carnet');

      // Configuración de página
      $pdf->SetMargins(15, 20, 15);
      $pdf->SetHeaderMargin(10);
      $pdf->SetFooterMargin(15);
      $pdf->SetAutoPageBreak(true, 25);

      // Agregar página
      $pdf->AddPage();

      // Obtener datos
      $mascota = Mascotas::find($id_mascota);
      if (!$mascota) {
        throw new Exception('Mascota no encontrada');
      }

      $dueño = Clientes::find($mascota->id_cliente);
      if (!$dueño) {
        throw new Exception('Propietario no encontrado');
      }

      $vacunas = Vacunas::where('id_mascota', $id_mascota)
        ->orderBy('fecha', 'desc')
        ->get();

      // Generar HTML del carnet
      $html = $this->generarHTMLCarnet($mascota, $dueño, $vacunas);

      // Escribir contenido al PDF
      $pdf->writeHTML($html, true, false, true, false, '');

      // Generar nombre de archivo seguro
      $nombreArchivo = 'Carnet-Vacunas-' . $this->sanitizarNombreArchivo($mascota->nombre) . '.pdf';

      // Salida del PDF
      $pdf->Output($nombreArchivo, 'I');
    } catch (Exception $e) {
      // Manejar errores
      abort(500, 'Error al generar el carnet: ' . $e->getMessage());
    }
  }



  private function generarHTMLCarnet($mascota, $dueño, $vacunas)
  {
    $fechaEmision = date('d/m/Y');
    $totalVacunas = $vacunas->count();

    $html = '
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { color: #2c5aa0; font-size: 24px; font-weight: bold; margin-bottom: 5px; }
        .subtitle { color: #666; font-size: 14px; margin-bottom: 20px; }
        .info-box { 
            background: #f8f9fa; 
            border: 2px solid #2c5aa0; 
            border-radius: 8px; 
            padding: 15px; 
            margin-bottom: 20px; 
        }
        .info-row { margin-bottom: 8px; }
        .label { font-weight: bold; color: #2c5aa0; }
        .value { color: #333; }
        .vaccines-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px;
            font-size: 12px;
        }
        .vaccines-table th { 
            background: #2c5aa0; 
            color: white; 
            padding: 12px 8px; 
            text-align: left; 
            font-weight: bold;
        }
        .vaccines-table td { 
            padding: 10px 8px; 
            border-bottom: 1px solid #ddd; 
        }
        .vaccines-table tr:nth-child(even) { background: #f8f9fa; }
        .vaccines-table tr:hover { background: #e8f4f8; }
        .status-complete { color: #28a745; font-weight: bold; }
        .status-pending { color: #ffc107; font-weight: bold; }
        .footer { 
            margin-top: 30px; 
            text-align: center; 
            font-size: 11px; 
            color: #666; 
        }
        .summary { 
            background: #e8f4f8; 
            border-left: 4px solid #2c5aa0; 
            padding: 10px; 
            margin: 15px 0; 
        }
        .veterinario-badge { 
            background: #28a745; 
            color: white; 
            padding: 2px 6px; 
            border-radius: 3px; 
            font-size: 10px; 
        }
        .no-vaccines { 
            text-align: center; 
            color: #666; 
            font-style: italic; 
            padding: 30px; 
        }
    </style>
    
    <div class="header">
        <div class="title"> CARNET DE VACUNAS</div>
        <div class="subtitle">Registro Oficial de Vacunación</div>
    </div>
    
    <div class="info-box">
        <div class="info-row">
            <span class="label"> Mascota:</span> 
            <span class="value">' . htmlspecialchars($mascota->nombre) . '</span>
        </div>
        <div class="info-row">
            <span class="label"> Edad:</span> 
            <span class="value">' . htmlspecialchars($mascota->edad) . '</span>
            &nbsp;&nbsp;&nbsp;
            <span class="label"> Sexo:</span> 
            <span class="value">' . htmlspecialchars($mascota->sexo) . '</span>
        </div>
        <div class="info-row">
            <span class="label"> Propietario:</span> 
            <span class="value">' . htmlspecialchars($dueño->nombre) . '</span>
        </div>
        <div class="info-row">
            <span class="label"> Documento:</span> 
            <span class="value">' . htmlspecialchars($dueño->documento) . '</span>
        </div>
    </div>
    
    <div class="summary">
        <strong> Resumen:</strong> Total de vacunas aplicadas: <strong>' . $totalVacunas . '</strong> | 
        Fecha de emisión: <strong>' . $fechaEmision . '</strong>
    </div>';

    if ($vacunas->count() > 0) {
      $html .= '
        <table class="vaccines-table">
            <thead>
                <tr>
                    <th width="25%"> Veterinario</th>
                    <th width="30%"> Vacuna Aplicada</th>
                    <th width="20%"> Fecha Aplicación</th>
                    <th width="25%"> Próxima Fecha</th>
                </tr>
            </thead>
            <tbody>';

      foreach ($vacunas as $index => $vacuna) {
        $veterinario = $vacuna->veterinario ? htmlspecialchars($vacuna->veterinario->name) : 'No especificado';
        $nombreVacuna = htmlspecialchars($vacuna->vacuna);
        $fechaAplicacion = htmlspecialchars($vacuna->fecha);

        // Formatear próxima fecha
        if ($vacuna->prox_fecha == 'Fin' || empty($vacuna->prox_fecha)) {
          $proxFecha = '<span class="status-complete"> Completada</span>';
        } else {
          $proxFechaValue = htmlspecialchars($vacuna->prox_fecha);
          $proxFecha = '<span class="status-pending"> ' . $proxFechaValue . '</span>';
        }

        $html .= '
                <tr>
                    <td><span class="veterinario-badge">Dr.</span> ' . $veterinario . '</td>
                    <td><strong>' . $nombreVacuna . '</strong></td>
                    <td>' . $fechaAplicacion . '</td>
                    <td>' . $proxFecha . '</td>
                </tr>';
      }

      $html .= '
            </tbody>
        </table>';
    } else {
      $html .= '
        <div class="no-vaccines">
            <p> No se han registrado vacunas para esta mascota.</p>
            <p>Consulte con su veterinario sobre el plan de vacunación recomendado.</p>
        </div>';
    }

    $html .= '
    <div class="footer">
        <p><strong>IMPORTANTE:</strong> Mantenga este carnet actualizado y preséntelo en cada consulta veterinaria.</p>
        <p>Documento generado el ' . $fechaEmision . ' por el Sistema Veterinario</p>
        <hr style="width:300px; margin: auto;" />
        <p style="font-size: 10px;">
            Este documento es válido como constancia oficial de vacunación. 
            Para consultas, contacte a su veterinario de confianza.
        </p>
    </div>';

    return $html;
  }



  private function sanitizarNombreArchivo($nombre)
  {
    // Remover caracteres especiales y espacios
    $nombre = preg_replace('/[^A-Za-z0-9\-]/', '', $nombre);
    return substr($nombre, 0, 50); // Limitar longitud
  }



  public function destroy($id_mascota)
  {
    $mascota = Mascotas::find($id_mascota);

    $exp  = explode('/', $mascota->foto);

    if (Storage::delete('public/' . $mascota->foto)) {

      Storage::deleteDirectory('public/' . $exp[0] . '/' . $exp[1] . '/' . $exp[2]);
    }

    Mascotas::destroy($id_mascota);

    Vacunas::where('id_mascota', $id_mascota)->delete();

    return redirect('Mascotas');
  }
}
