@extends('layouts.app-r')
@section('content')
<div class="row">
    <div class="col-7">
        <div class="preview-container">
            <video id="preview"></video>
                <div class="cameras">
                    <h4>Cameras</h4>
                    <div id="camerasList">
                    </div>
                </div>
            <div class="scans">
                <div id="scans">
                    <h4>Scans</h4>

                </div>
            </div>
            <div id="line" class="line"></div>
        </div>



</div>
<div class="col-3 card">

        <h2 class="card-header">Ultima Orden confirmada</h2>
        <table class="table card-body">
            <tr>
                <td>Fecha:</td>
                <td id="fecha"></td>
            </tr>
            <tr>
                <td>Hora:</td>
                <td id="hora"></td>
            </tr>
            <tr>
                <td>N° Personas:</td>
                <td id="personas"></td>
            </tr>
            <tr>
                <td>Pago:</td>
                <td id="pago"></td>
            </tr>

            <tr >
                <td colspan="2">
                    <div id="estado" class="alert">-----</div>
                </td>
            </tr>

        </table>


</div>

</div>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/webcam/instascan.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/webcam/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-3.4.0.min.js')}}"></script>
    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            let  ordersPath={!!json_encode(route('adminRestaurant.pedidos.confirmation'))!!};
           var order=content.split(",");

           //la confirmacion se aproduce aquí
         $.get(ordersPath,{
            orderData:content
         },function(e){
                console.log(e);
                if(e=="confirmada"){
                    alert("Esta orden ya se ha confirmado");
                }else if(e=="vencida"){
                    alert("Esta orden ya se ha vencido");
                }else{
                    order=e.split(",");
                    fecha.innerHTML=order[1];
                    hora.innerHTML=order[2];
                    personas.innerHTML=order[3];
                    pago.innerHTML=order[6];
                    if(order[7]=="no"){
                      estado.innerHTML="Orden no cancelada !!!";
                      if(estado.classList.contains('alert-success')){
                          estado.classList.remove('alert-success');
                      }
                      estado.classList.add("alert-danger");
                    }else{
                      estado.innerHTML="Esta orden ya ha sido pagada"
                      if(estado.classList.contains('alert-danger')){
                          estado.classList.remove('alert-danger');
                      }
                      estado.classList.add("alert-success");

                    }
                }

              //console.log(order);
            });

        });

        Instascan.Camera.getCameras().then(function (cameras) {
       	  // console.log(cameras);
          cams=cameras;
          printCameras(cameras);

         if(cameras.length > 0){

             selectCamera(cameras[0]);
         }
         else
         {
             console.error('No cameras found.')
         }


        }).catch(function (e) {
          console.error(e);
        });


        // PARTE QUE MUEVE LA LINEA
           var num=0,op=0;
           var linea=document.getElementById('line');
           var i=setInterval(function () {

            if (num==100) {op=1;}
            if (num==0) {op=0;}
            // console.log(num);

              linea.style.top=num+"%";
              op==1?num--:num++;

            }, 10);
    </script>

@endsection
