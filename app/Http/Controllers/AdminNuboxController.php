<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Professional;
use App\Models\Pack;
use App\Models\SelledPack;

class AdminNuboxController extends Controller
{
    
    private $token;
    // construct just intranet users
    public function __construct()
    {
        $this->middleware('intranet');
        $this->token = config('app.medilink');
    }

    //index
    public function index(){
      
      $professionals = Professional::with('user')->orderby('description')->get();
      $packs = Pack::orderby('name')->get();
      $client = new \GuzzleHttp\Client();
      $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/';

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      $alPatients = [];
      $patients = json_decode($response->getBody());
      $alPatients[] = $patients->data;

      while(isset($patients->links->next)){
          $response = $client->request('GET', $patients->links->next, [
              'headers'  => [
                  'Authorization' => 'Token ' . $this->token
              ]
          ]);
          $patients = json_decode($response->getBody());
          $alPatients[] = $patients->data;

      }
      $patients = array_merge(...$alPatients);
      array_multisort( array_column($patients, "nombre"), SORT_ASC, $patients );
      return view('admin.nubox.index',compact('professionals','packs','patients'));
    }

    public function auth(){
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_HEADER, 1);
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.nubox.com/".config('app.nubox_env')."/autenticar",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
          "Authorization: Basic ".config('app.nubox'), 
          "Content-Length: 0",
        ),
      ));
      $response = curl_exec($curl);

      $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
      $headers = substr($response, 0, $header_size);
      $body = substr($response, $header_size);

      // Define the $response_headers array for later use
      $response_headers = [];

      // Get the first line (The Status Code)
      $line = strtok($headers, "\r\n");
      $status_code = trim($line);

      // Parse the string, saving it into an array instead
      while (($line = strtok("\r\n")) !== false) {
          if(false !== ($matches = explode(':', $line, 2))) {
            $response_headers["{$matches[0]}"] = trim($matches[1]);
          }
      }
      return $response_headers;
    }

    public function emit(Request $request){
      $pack = Pack::find($request->pack);
      $professional = Professional::where('id',$request->professional)->with('user')->first();
      $client = new \GuzzleHttp\Client();
      $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/'.$request->patient;

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      $patient = json_decode($response->getBody());


      if($request->alliance == 'true'){
        $price = $pack->alliance_price;
      } else {
        $price = $pack->price;
      }
      for($i=0; $i<1; $i++){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.nubox.com/".config('app.nubox_env')."/factura/documento/76914578-8/1/rutFuncionario/1/emitir/ventaExtendido?rutFuncionario=18018579-8&emitir=".getenv('NUBOX_EMIT'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "productos": [
              {
                "rutContraparte": "'.$patient->data->rut.'",
                "razonSocialContraparte": "'.$patient->data->nombre.' '.$patient->data->apellidos.'",
                "giroContraparte": "Paciente",
                "tipo": 41,
                "folio": 478,
                "secuencia": 1,
                "fecha": "'.Carbon::now()->format("Y-m-d").'",
                "afecto": "NO",
                "producto": "ATENCION KINESIOLOGICA INTEGRAL",
                "descripcion": "RUT PROFESIONAL: '.$professional->user->rut.' '.$professional->user->name.' '.$professional->user->lastnames.'",
                "cantidad": "'.$pack->count.'",
                "comunaContraparte": "Las Condes",
                "direccionContraparte": "San Pascual 736",
                "precio": "'.$price.'",
                "valor": "'.$price.'",
                "ponderacionDescuento": 0,
                "emailContraparte": "",
                "tipoDeServicio": "3",
                "fechaPeriodoDesde": "",
                "fechaPeriodoHasta": "",
                "fechaVencimiento": "",
                "codigoSucursal": "1",
                "vendedor": "",
                "codigoItem": "",
                "unidadMedida": "",
                "codigoIMP": "",
                "montoIMP": 0,
                "indicadorDeTraslado": "1",
                "formaDePago": "",
                "medioDePago": "",
                "terminosDePagoDias": "",
                "terminosDePagoCodigo": "",
                "comunaDestino": "",
                "rutSolicitanteFactura": "",
                "productoCambioSujeto": "",
                "cantidadMontoCambioSujeto": 0,
                "tipoGlobalAfecto": "",
                "valorGlobalAfecto": 0,
                "tipoGlobalExento": "",
                "valorGlobalExento": 0,
                "precioCambioSujeto": 0,
                "descuentoMonto": 0,
                "rutTransportista": "",
                "rutChofer": "",
                "patente": "",
                "nombreChofer": "",
                "direccionDestino": "",
                "ciudadDestino": "",
                "tipoDeDespacho": "",
                "nombreDeContacto": "",
                "observacion": ""
              }
            ],
            "documentoReferenciado": {
              "tipo": 0,
              "folio": 478,
              "secuencia": 0,
              "tipoDocumentoReferenciado": 0,
              "folioDocumentoReferenciado": 34,
              "fechaDocumentoReferenciado":  "'.Carbon::now().'",
              "motivoReferencia": 0,
              "glosa": "Glosa"
            }
          }',
          CURLOPT_HTTPHEADER => array(
            'token: '.$this->auth()['Token'],
            'Content-Type: application/json',
            'Cookie: '.$this->auth()['Set-Cookie'],
          ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
      }
      $emit = json_decode($response, true);

      $selled_pack = new SelledPack;
      $selled_pack->patient_id = $request->patient;
      $selled_pack->user_name = $patient->data->nombre.' '.$patient->data->apellidos;
      $selled_pack->professional_id = $request->professional;
      $selled_pack->professional_name = $professional->user->name.' '.$professional->user->lastnames;
      $selled_pack->pack_id = $request->pack;
      $selled_pack->pack_name = $pack->name;
      $selled_pack->save();

      // return $emit;
      return view('admin.nubox.show',compact('emit'));
    }

    public function emit_f(){
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.nubox.com/Nubox.API/factura/documento/76914578-8/1/rutFuncionario/1/emitir/ventaExtendido?rutFuncionario=18018579-8&emitir=".getenv('NUBOX_EMIT'),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
          "productos": [
            {
              "rutContraparte": "18783405-8",
              "razonSocialContraparte": "venta23",
              "giroContraparte": "venta23",
              "tipo": 34,
              "folio": 478,
              "secuencia": 1,
              "fecha": "2022-12-03",
              "afecto": "NO",
              "producto": "ATENCION KINESIOLOGICA INTEGRAL.RUT: 16608122-k Daniella Vivallo Vera",
              "descripcion": null,
              "cantidad": 10,
              "comunaContraparte": "Las Condes",
              "direccionContraparte": "Av Vitacura 3110",
              "precio": 60200,
              "valor": 60200,
              "ponderacionDescuento": 0,
              "emailContraparte": "mail@ejemplo.com",
              "tipoDeServicio": "",
              "fechaPeriodoDesde": "2022-12-03",
              "fechaPeriodoHasta": "2022-12-03",
              "fechaVencimiento": "",
              "codigoSucursal": "Cod 0001",
              "vendedor": "Pedro Sanchez",
              "codigoItem": "01",
              "unidadMedida": "UNID",
              "codigoIMP": "",
              "montoIMP": 0,
              "indicadorDeTraslado": "1",
              "formaDePago": "1",
              "medioDePago": "EF",
              "terminosDePagoDias": "",
              "terminosDePagoCodigo": "",
              "comunaDestino": "Santiago",
              "rutSolicitanteFactura": "18783405-8",
              "productoCambioSujeto": "",
              "cantidadMontoCambioSujeto": 0,
              "tipoGlobalAfecto": "",
              "valorGlobalAfecto": 0,
              "tipoGlobalExento": "",
              "valorGlobalExento": 0,
              "precioCambioSujeto": 0,
              "descuentoMonto": 0,
              "rutTransportista": "18783405-8",
              "rutChofer": "18783405-8",
              "patente": "SVFV02",
              "nombreChofer": "Juan Pereira",
              "direccionDestino": "Santa Rosa 215",
              "ciudadDestino": "Santiago",
              "tipoDeDespacho": "",
              "nombreDeContacto": "Lorena Álvarez",
              "observacion": "Observación."
            }
          ],
          "documentoReferenciado": {
            "tipo": 0,
            "folio": 478,
            "secuencia": 0,
            "tipoDocumentoReferenciado": 0,
            "folioDocumentoReferenciado": 34,
            "fechaDocumentoReferenciado": "2022-12-03T00:00:00.8751996-04:00",
            "motivoReferencia": 0,
            "glosa": "Glosa"
          }
        }',
        CURLOPT_HTTPHEADER => array(
          'token: '.$this->auth()['Token'],
          'Content-Type: application/json',
          'Cookie: '.$this->auth()['Set-Cookie'],
        ),
      ));
      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
    }

    public function comprobante(){
      $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.nubox.com/Nubox.API/contabilidad/Partner%20API/1/comprobante',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "Descripcion": "comprobante ingresado por partner",
        "Periodo": "2020-04-15T15:23:22.9470207-04:00",
        "NumeroAsiento": 12,
        "FechaIngreso": "2020-04-15T15:23:22.9470207-04:00",
        "ValorTotal": 3000,
        "TipoAsiento": 2,
        "EstadoAsiento": 4,
        "MovimientosContables": [
          {
            "Descripcion": "desde API - debe",
            "CodigoCuenta": "1101-02",
            "EsDebito": true,
            "Valor": 1500,
            "CodigoCentroDeCosto": "",
            "CodigoSucursal": "",
            "MovimientosAuxiliares": [],
            "MovimientosBancarios": [],
            "BoletasDeHonorarios": []
          },
          {
            "Descripcion": "movimiento insertado desde API",
            "CodigoCuenta": "1103-01",
            "EsDebito": false,
            "Valor": 1500,
            "CodigoCentroDeCosto": "",
            "CodigoSucursal": "",
            "MovimientosAuxiliares": [],
            "MovimientosBancarios": [
              {
                "EsDebito": false,
                "Fecha": "2020-04-15T15:41:50.8812359-04:00",
                "Valor": 1500,
                "Folio": 123456,
                "TipoMovimientoBancario": "COBRO CHEQUE"
              }
            ],
            "BoletasDeHonorarios": []
          }
        ]
      }',
      CURLOPT_HTTPHEADER => array(
        'token: '.$this->auth()['Token'],
        'Content-Type: application/json',
        'Cookie: '.$this->auth()['Set-Cookie'],
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
    }

    public function comuna(){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nubox.com/Nubox.API/factura/comunas',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'token: '.$this->auth()['Token'],
          'Cookie: '.$this->auth()['Set-Cookie'],
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
    }

    public function cliente(){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.nubox.com/".config('app.nubox_env')."/factura/76914578-8/1/clientes",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'[
        {
          "Rut": "15829796-5",
          "RazonSocial": "Franciscos Sepulveda Vejar",
          "Giro": "Paciente",
          "Acteco": "",
          "DireccionLegal": "San Pascual 736",
          "ComunaLegalNombre": "Las Condes",
          "Contacto": "You Just Better",
          "Email": "cristobalugarte6@gmail.com",
          "seEnviaPDF": 1
        }
      ]',
        CURLOPT_HTTPHEADER => array(
          'token: '.$this->auth()['Token'],
          'Content-Type: application/json',
          'Cookie: '.$this->auth()['Set-Cookie'],
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
    }

    public function boleta(){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.nubox.com/Nubox.API/factura/documento/76914578-8/1/18018579-8/1/39/dte/extendido&emitir=".getenv('NUBOX_EMIT'),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
          "productos": [
            {
              "fechaEmision": "2023-01-02",
              "folio": 337,
              "rutContraparte": "18783405-8",
              "razonSocialContraparte": "venta23",
              "giroContraparte": "Servicios",
              "comunaContraparte": "Vitacura",
              "direccionContraparte": "Candelaria Goyenechea 3820, Vitacura",
              "emailContraparte": "mail@ejemplo.com",
              "codigoSucursal": "123",
              "secuencia": 1,
              "afecto": "SI",
              "producto": "Privado",
              "descripcion": "Servicio",
              "cantidad": 1,
              "precio": 150000,
              "valor": 150000,
              "codigoItem": "01",
              "unidadMedida": "UNID",
              "fechaVencimiento": "2023-01-02T08:36:14.4221255-04:00",
              "codigoSIITipoDeServicio": "1",
              "fechaPeriodoDesde": "2023-01-02T08:36:14.4221255-04:00",
              "fechaPeriodoHasta": "2023-01-02T08:36:14.4221255-04:00",
              "observacion": "Observación"
            }
          ],
          "documentoReferenciado": {
            "tipo": 0,
            "folio": 337,
            "secuencia": 1,
            "tipoDocumentoReferenciado": 39,
            "folioDocumentoReferenciado": 654321,
            "fechaDocumentoReferenciado": "2020-06-16T08:36:14.4221255-04:00",
            "motivoReferencia": 1000,
            "glosa": "Glosa"
          }
        }',
        CURLOPT_HTTPHEADER => array(
          'token: '.$this->auth()['Token'],
          'Content-Type: application/json',
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
    }

    public function documentos(){
      $curl = curl_init();
 
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.nubox.com/Nubox.API/factura/documento/76914578-8/venta/2023-02-06/BOL-EE/12596/1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          'token: '.$this->auth()['Token'],
          'Content-Type: application/json',
        ),
      ));
      
      $response = curl_exec($curl);
      // convert to xml to json
      return $response;
      //xml to json
      $xml = simplexml_load_string($response);
      curl_close($curl);
      echo $xml;
    }

}
