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
          "Authorization: Basic Zjl5bkpwYkdyQ3J0OnAzdXV3Wnlv",
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
          'Cookie: '.$this->auth()['Set-Cookie'],
          'Content-Type: application/json',
          "Content-Length: 0",
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
}
