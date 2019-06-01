
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
    var txtCode=document.querySelector('#txtCode');
    var btnConfirma=document.querySelector('#btnConfirma');

    // aqui iria lo que falta que se cargue

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
