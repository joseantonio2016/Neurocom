
const divHoja = document.getElementById("hoja");
			const rem = 16;
		const sizeAlturaCeldaEm = 2;
		const altoNoHojaEm = 0.5;
		const defaultSizeCeldaEm = 8;
		const letra = ['ItemId','ItemTitle','ItemSubTitle','Category',
		'IDCatg','ItemURL','pictureURL','country','location','tipoListado',
		'CondicionId','CondicionName','PrecioActual','PrcActConvertido',
				'L','M','N','O','P','Q','R','S','T'];

		var sumaAncho = 0;
		var sumaAlto = 0;

		var maxColumna = 14;
		var maxFila = 25;//2		
		var res = '<div class="grupoDiv" id="gf0"><span id="f0c0" class="numeroFila"></span>'+
		'<span class="grilla" id="headHoja">';
			for (var m = 0; m<maxColumna;m++){
				res+='<input type="text" readonly="true" value="'+
				letra[m]+'" class="cabecera">';
			}
			res+='</<span></div>';
				for (var i = 1; i <= maxFila; i++) {
					res += '<div class="grupoDiv" id="gf'+i+
					'"><span id="f'+i+'c0" class="numeroFila">'+i+'</span>'+
					'<span class="grilla">';
					for (var j = 1; j <=maxColumna; j++) {
						res+=
		'<input type="text" class="celda" id="f'+i+'c'+j+'" value="">';
					}
					res+='</span></div>';
				}
				
		divHoja.innerHTML=res;

		function displayWindowSize(){
                var w = document.documentElement.clientWidth;
                var h = document.documentElement.clientHeight;
                sumaAncho = maxColumna*rem*defaultSizeCeldaEm*1.2;
                var anchoN = Math.ceil(sumaAncho*100/w)+'%';
                for (let i = 0; i <= maxFila; i++) {
                    document.getElementById('gf'+i)
                    .style.width = anchoN;
                }
                divHoja.style.height = (h-(altoNoHojaEm*rem))+'px';

            }

            window.addEventListener("resize", displayWindowSize);
			displayWindowSize();
			
			//https://www.geeksforgeeks.org/php-simplexmlelement-attributes-function/#:~:text=The%20SimpleXMLElement%3A%3Aattributes(),tag%20in%20a%20SimpleXML%20object.