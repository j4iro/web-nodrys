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
    @if (session('order'))
        @php
            $order=session('order');
        @endphp
        <h2 class="card-header">Ultima Orden confirmada</h2>
        <table class="table card-body">
            <tr>
                <td>Fecha:</td>
                <td>{{$order->date}}</td>
            </tr>
            <tr>
                <td>Hora:</td>
                <td>{{$order->hour}}</td>
            </tr>
            <tr>
                <td>N° Personas:</td>
                <td>{{$order->n_people}}</td>
            </tr>
            <tr>
                <td>Pago:</td>
                <td>{{$order->total}}</td>
            </tr>
            @if($order->paid=="no")
            <tr >
                <td colspan="2"> <div class="alert alert-warning">
                    Ahun no ha pagado
                </div></td>
               
            </tr>
            @endif
        </table>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
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
              order=e.split(",");
              console.log(order);
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
    </script>

@endsection
