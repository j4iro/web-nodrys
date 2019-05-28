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

		function procesaRespuesta(){
			if (peticion_http.readyState==READY_STATE_COMPLETE) {
				if (peticion_http.status==200) {
					document.getElementById("ajaxResultados").innerHTML=peticion_http.responseText;
				}
			}
		}