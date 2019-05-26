function seleccionar(id){
    var estado=document.getElementById(id).checked;
    var cont=document.getElementById(id+'c');
    var imgPlatos=document.getElementById(id+'i');
    if (estado==true) {
        cont.style="background-color:rgba(2,65,95,1);color:white";
        imgPlatos.style="filter: grayscale(70%);";
    }else{
        cont.style="";
        imgPlatos.style="";
    }
}
