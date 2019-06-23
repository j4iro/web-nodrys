		var READY_STATE_COMPLETE=4;
		var peticion_http=null;

		function inicializa_xhr() {
			if (window.XMLHttpRequest) {
				return new XMLHttpRequest();
			}else if(window.ActiveXObject){
				return new ActiveXObject("Microsoft.XMLHTTP");
			}
		}

		function crea_query_string(){
			var categoria=document.getElementById('btnCategoria');

			return encodeURIComponent(categoria.value);
		}

		function mostrar(){

			peticion_http=inicializa_xhr();
			if (peticion_http) {
				peticion_http.onreadystatechange=procesaRespuesta;
				peticion_http.open("GET","filtroXcategoria/"+crea_query_string(),true);

				//peticion_http.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				//var query_string=crea_query_string();
				peticion_http.send(null);

			}

        }

		function mostrar_distrito(){

			peticion_http=inicializa_xhr();
			if (peticion_http) {
				peticion_http.onreadystatechange=procesaRespuestaDistrito;
				peticion_http.open("GET","filtroXdistrito/"+document.getElementById('cboDistrito').value,true);

				//peticion_http.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				//var query_string=crea_query_string();
				peticion_http.send(null);

			}

		}

		function procesaRespuesta(){
			if (peticion_http.readyState==READY_STATE_COMPLETE) {
				if (peticion_http.status==200) {
					document.getElementById("ajaxResultados").innerHTML=peticion_http.responseText;
				}
			}
		}
		function procesaRespuestaDistrito(){
			if (peticion_http.readyState==READY_STATE_COMPLETE) {
				if (peticion_http.status==200) {
					document.getElementById("ajaxResultados").innerHTML=peticion_http.responseText;
				}
			}
		}
		/**Activar desactivar**/
		function actualizar_estado_plato(id){
			let estado=document.getElementById(id).checked?1:0;
			peticion_http1=inicializa_xhr();
			if (peticion_http1) {
				peticion_http1.onreadystatechange=respuesta_estado_plato;
				peticion_http1.open("GET","update_state_dish/"+id+"/"+estado,true);

				//peticion_http1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				//var query_string=crea_query_string();
				peticion_http1.send(null);

			}
		}

		var respuesta_estado_plato=()=>{
			if (peticion_http1.readyState==READY_STATE_COMPLETE) {
				if (peticion_http1.status==200) {
					//document.getElementById("ajaxResultados").innerHTML=peticion_http1.responseText;
				}
			}
		}

		/*********************************************************************/

		function pagarComision(id){
		let valor= confirm('ESTAS SEGURO DE QUE ESTE RESTAURANTE YA PAGÓ LA COMISIÓN?');
			if (valor)
			{
					peticion_http2=inicializa_xhr();
					if (peticion_http2)
					 {
						peticion_http2.onreadystatechange=respuesta_monto;
						peticion_http2.open("GET","pagarComision/"+id,true);

						//peticion_http2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						//var query_string=crea_query_string();
						peticion_http2.send(null);

					}
			}
			location.reload();
		}

		var respuesta_monto=()=>{
			if (peticion_http2.readyState==READY_STATE_COMPLETE) {
				if (peticion_http2.status==200) {
					//document.getElementById("ajaxResultadosMonto").innerHTML=peticion_http2.responseText;
				}
			}
		}
        /***************************************************************/

        function mostrardia(dia,id){

            document.getElementById('domingo').classList.remove('btn-primary');
            document.getElementById('domingo').classList.remove('text-white');
            document.getElementById('lunes').classList.remove('btn-primary');
            document.getElementById('lunes').classList.remove('text-white');
            document.getElementById('martes').classList.remove('btn-primary');
            document.getElementById('martes').classList.remove('text-white');
            document.getElementById('miércoles').classList.remove('btn-primary');
            document.getElementById('miércoles').classList.remove('text-white');
            document.getElementById('jueves').classList.remove('btn-primary');
            document.getElementById('jueves').classList.remove('text-white');
            document.getElementById('viernes').classList.remove('btn-primary');
            document.getElementById('viernes').classList.remove('text-white');
            document.getElementById('sábado').classList.remove('btn-primary');
            document.getElementById('sábado').classList.remove('text-white');

            document.querySelector('#'+dia).classList.toggle('btn-primary');
            document.querySelector('#'+dia).classList.toggle('text-white');

            peticion_http3=inicializa_xhr();
            if (peticion_http3)
            {
                peticion_http3.onreadystatechange=rpta_platos;
                peticion_http3.open("GET","platosxdia/"+dia+"/"+id,true);

                //peticion_http3.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                //var query_string=crea_query_string();
                peticion_http3.send(null);

            }

            }

            var rpta_platos=()=>{
                if (peticion_http3.readyState==READY_STATE_COMPLETE) {
                    if (peticion_http3.status==200) {
                        document.getElementById("rpta_platos").innerHTML=peticion_http3.responseText;
                    }
                }
            }

