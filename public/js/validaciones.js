function validarNumero(e){
    var key=window.Event?e.which:e.keyCode
    return (key>=48 && key<=57);
}
function validarLetras(e){
    var letras='áéíóúñ ';
    var key=window.Event?e.code:e.code;
    return (key==('Key'+e.key.toUpperCase()) || letras.indexOf(e.key.toLowerCase())!=-1);

}
