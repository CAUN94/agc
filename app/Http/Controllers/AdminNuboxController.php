<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNuboxController extends Controller
{
    public function auth(){
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_HEADER, 1);
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.nubox.com/Nubox.API.cert/autenticar",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
          "Authorization: Basic eWFBQTRzU0FPQ3J0OkNsTUNtVDdF",
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

    public function comprobante(){
      $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.nubox.com/Nubox.API.cert/contabilidad/Partner%20API/1/comprobante',
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
        CURLOPT_URL => 'https://api.nubox.com/Nubox.API.cert/factura/comunas',
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

    public function emit(){
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nubox.com/Nubox.API.cert/factura/documento/76914578-8/1/rutFuncionario/1/emitir/ventaExtendido?rutFuncionario=18018579-8&emitir=true',
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
              "fecha": "2022-09-14",
              "afecto": "NO",
              "producto": "ATENCION KINESIOLOGICA INTEGRAL.RUT: 16608122-k Daniella Vivallo Vera",
              "descripcion": null,
              "cantidad": 10,
              "comunaContraparte": "Las Condes",
              "direccionContraparte": "Av Vitacura 3110",
              "precio": 70000,
              "valor": 70000,
              "ponderacionDescuento": 0,
              "emailContraparte": "mail@ejemplo.com",
              "tipoDeServicio": "",
              "fechaPeriodoDesde": "2022-09-14",
              "fechaPeriodoHasta": "2022-09-14",
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
            "fechaDocumentoReferenciado": "2022-09-14T00:00:00.8751996-04:00",
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

    public function cliente(){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nubox.com/Nubox.API.cert/factura/76914578-8/1/clientes',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'[
        {
          "Rut": "18783405-8",
          "RazonSocial": "Juan Cliente",
          "Giro": "EMPRESA DE SERVICIOS DE INFORMATICA",
          "Acteco": "ACTIVIDADES DE ASESORAMIENTO EMPRESARIAL Y EN MATERIA DE GESTION",
          "DireccionLegal": "Orinoco 90",
          "ComunaLegalNombre": "Las Condes",
          "Contacto": "Juan Contador",
          "Email": "juan.contador@ejemplo.com",
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
        CURLOPT_URL => 'https://api.nubox.com/Nubox.API.cert/factura/documento/76914578-8/1/18018579-8/1/39/dte/extendido',
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
              "fechaEmision": "2023-01-30",
              "folio": 2,
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
              "fechaVencimiento": "2020-06-16T08:36:14.4221255-04:00",
              "codigoSIITipoDeServicio": "1",
              "fechaPeriodoDesde": "2020-06-16T08:36:14.4221255-04:00",
              "fechaPeriodoHasta": "2020-06-16T08:36:14.4221255-04:00",
              "observacion": "Observación"
            }
          ],
          "documentoReferenciado": {
            "tipo": 0,
            "folio": 2,
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
}
