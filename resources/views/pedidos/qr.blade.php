{{-- @extends('layouts.app-r') --}}

{{-- @section('content') --}}

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <section>

        <div class="container">
            <div class="menu">
                <div class="cameras">
                     <h2>Camaras</h2>
                     <div id="camerasList">
    
                     </div>
                </div>
            </div>
    
            <center>
            <h2>Muestre su codigo para confirmar pedido</h2>
            <div class="preview-container">
                <video id="preview"></video>
                <div id="line" class="line"></div>
            </div>
            </center>
    
            <div class="scans">
                <div id="scans">
                    <h2>Scans</h2>
                </div>
            </div>
    
        </div>
    
    </section>

    <script src="{{ asset('js/instascan.min.js') }}" ></script>
    <script src="{{ asset('js/app_webcam.js') }}" ></script>
</body>
</html>


{{-- @endsection --}}

{{-- SCRIPTS JS PARA LA WEBCAM --}}




