<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeticionesController extends Controller
{

    public function respuesta_pasarela(){
        

       try {
            require 'culqi/vendor/autoload.php';

           // require 'culqi/lib/culqi.php';
              $SECRET_KEY = "sk_test_gYZ3pH0EKWrIw0Ao";
              $culqi = new \Culqi\Culqi(array('api_key' => $SECRET_KEY));

            // Creando Cargo a una tarjeta
            $charge = $culqi->Charges->create(
                array(
                  "amount" => $_GET['precio'],
                  "capture" => true,
                  "currency_code" => "PEN",
                  "description" => $_GET['producto'],
                  "installments" => 0,
                  "email" => $_GET['email'],
                  "metadata" => array("test"=>"test"),
                  "source_id" => $_GET['token']
                )
            );
            // Respuesta
            echo json_encode($charge);

            } catch (Exception $e) {
            echo json_encode($e->getMessage());
            }
 
     }

     public function respuestaRuc(Request $request){

         if ($request->ajax()) {
            $texto = file_get_contents("https://api.sunat.cloud/ruc/{$request->ruc}");
            $texto=json_decode($texto);
            $data=array('dataProcess'=>$texto);
            echo json_encode($data);
          }
     }


     public function respuestaDni(Request $request){

          if ($request->ajax()) {
                $streamContext = stream_context_create([
                    'ssl' => [
                        'verify_peer'      => false,
                        'verify_peer_name' => false
                    ]
                ]);
                $data = file_get_contents("https://api.reniec.cloud/dni/{$request->dni}", false, $streamContext);
                $data=json_decode($data);
                $data=array('dataProcess'=>$data);
                echo json_encode($data);

           }
     }
     
}
