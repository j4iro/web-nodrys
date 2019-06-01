 
 	function varlidarSoloLetra(e) {
 		let especiales=['á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ',' ']
		let key = window.Event ? e.which : e.keyCode
		
		return especiales.indexOf(this.event.key)>=0?true:(key>=65&&key<=90 || key>=97&&key<=122)
	}



