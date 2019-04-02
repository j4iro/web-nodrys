
window.onload=function()
{
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
}

    var app={
        activeCameraId: null
    };
    var cams=null;

    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
       	 // aqui seria donde pondriamos insertar
          // alert(content);
          // console.log(content);
          var scansList=document.querySelector('#scans');
          var li=document.createElement('li');
          li.innerHTML=content;
          scansList.appendChild(li);
          // clearInterval(i);
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



    function selectCamera(camera){

        console.log(camera.name);
        scanner.start(camera);
    }

    function printCameras(arrayCameras){
        for (var i = 0; i < arrayCameras.length; i++) {
            var camerasList=document.querySelector('#camerasList');

            var li=document.createElement('button');
            li.id=arrayCameras[i].id;
            li.innerHTML=arrayCameras[i].name==null?"Desconocido":arrayCameras[i].name;
            li.className="btnCamera"
            li.setAttribute('onClick','hello(this.id)')
            camerasList.appendChild(li);
        }
    }


var arraybrns=document.getElementsByClassName('btnCamera');
    function hello(id){

        for (var i = 0; i < arraybrns.length; i++) {
            if(id==cams[i].id){
                selectCamera(cams[i]);
            }
        }

    }
