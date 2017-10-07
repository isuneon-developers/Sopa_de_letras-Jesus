	$(document).ready(function() {
		
		$("input[name='columnas']").change(function(){ 
			if($("input[name='columnas']").val()<1){$("input[name='columnas']").val(1);}
			if($("input[name='columnas']").val()>100){$("input[name='columnas']").val(100);}
			});
			
		$("input[name='filas']").change(function(){ 
			if($("input[name='filas']").val()<1){$("input[name='filas']").val(1);}
			if($("input[name='filas']").val()>100){$("input[name='filas']").val(100);}
			});
		
		
		$("textarea[name='datos']").change(function(){
			var datos = $("textarea[name='datos']").val().replace(/(?:\r\n|\r|\n|\s)/g, '');
			if(datos.length < ($("input[name='columnas']").val())*($("input[name='filas']").val())){
				$(".data-err").html("");
				$(".data-err").append("Los valores introducidos son insuficientes");
				$(".data-err").show("slow");
			}
			
			if(datos.length > ($("input[name='columnas']").val())*($("input[name='filas']").val())){
				$(".data-err").html("");
				$(".data-err").append("Los valores introducidos exceden el límite");
				$(".data-err").show("slow");
			}
			
			if(datos.length == ($("input[name='columnas']").val())*($("input[name='filas']").val())){
				$(".data-err").html("");
				$(".data-err").hide("slow");
			}
			});
			
		
	    $(".btn-submit").click(function(e){
			
			if($("textarea[name='datos']").val().replace(/(?:\r\n|\r|\n|\s)/g, '').length == ($("input[name='columnas']").val())*($("input[name='filas']").val())){
				e.preventDefault();
				$(".col-md-6[name='table']").hide("slow");
				$(".errormsg").hide('slow');
				$(".data-err").hide('slow');
			
				var _token = $("input[name='_token']").val();
				var filas = $("input[name='filas']").val();
				var columnas = $("input[name='columnas']").val();
				var datos = $("textarea[name='datos']").val().replace(/(?:\s\r\n|\r|\n|\s)/g,'');
				var palabra = $("input[name='palabra']").val().replace(/(?:\r\n|\r|\n|\s)/g,'');
			
				$.ajax({
					url: "/ValidarSopa",
					type:'POST',
					data: {_token:_token, filas:filas, columnas:columnas, datos:datos, palabra:palabra},
					success: function(data) {
						if($.isEmptyObject(data.error)){
						
							datos=$("textarea[name='datos']").val().replace(/(?:\r\n|\r|\n|\s)/g, '');
							datos=datos.split("");
						
							//Reiniciando el diseño de la tabla
							$(".table").html("<thead><tr><td></td></tr></thead><tbody></tbody>");
						
							//Inicializando la tabla con todos los valores
							for(var i=0;i<columnas;i++){$(".table").find("thead").find("tr").append('<th>'+(i+1)+'</th>');}
							for(i=0;i<filas;i++)
							{
								$(".table").find("tbody").append('<tr name='+(i+1)+'><th>'+(i+1)+'</th>');
								for(var j=0;j<columnas;j++){$("table").find("tbody").find("tr[name="+(i+1)+"]").append("<td name="+i+"."+j+" style ='word-break:break-all;'>"+datos[j]+"</td>");}
								datos.splice(0,columnas);
								$(".table").find("tbody").find("td").append('</tr>');
							}
								
							$("p").find("strong").html("");
							
							if(data.success > 0){
								if(data.success==1){$("p").html("Se encontró <strong></strong> coincidencia");}
								else{$("p").html("Se encontraron <strong></strong> coincidencias");}
								$("p").find("strong").append(data.success);
							}else{
								$("p").html("No se encontraron coincidencias");
							}
							
							$("html, body").animate({ scrollTop: $(document).height() }, 1000);
							$(".errormsg").hide("slow");
							$(".col-md-6[name='table']").show("slow");
						}else{
							MensajeError(data.error);
						}
					}
				
				});
			}else{
				e.preventDefault();
			}
	    }); 
		

		
	    function MensajeError (msg) {
			$(".errormsg").find("ul").html('');
			$(".errormsg").show('slow');
			$.each( msg, function( key, value ) {
				$(".errormsg").find("ul").append('<li>'+value+'</li>');
			});
		}
	});