
$(document).ready(function(){

	$('.wait').remove();

    /* ----------- OBTENER TASA DEL DIA DOLARTODAY -------------------------------------- */

	function getDolarJSON () {
		$.getJSON("https://s3.amazonaws.com/dolartoday/data.json", function(data) {
			$('#getdolar').html("<b>Tasa del día vía @dolartoday<br/>Tasa:</b> "+new Intl.NumberFormat().format(data.USD.transferencia)+" Bs/$<br/><b>Fecha: </b>"+data._timestamp.fecha+"<br/><button id='getdolarRefresh' class='btn button-green' href='#'>Actualizar <i class='fas fa-redo'></i></button><br/>").removeClass('text-md-center').addClass('text-md-left');
		}).fail(function(data) {
			$('#getdolar').html(`Error al obtener tasa del día <br/><button class='btn button-green' id='getdolarRefresh' href='#'>Reintentar <i class='fas fa-redo'></i></button>`).addClass('text-md-center');
		});

		/* $.ajax({
			url: 'https://monitordolarvenezuela.com/historico/bcv-banco-central-de-venezuela',
			method: 'GET',
			crossDomain: true,
			success: function(response){
				console.log(response)
			},
			error: function(response) {
				console.log('Error')
			}
		}) */
	}

	getDolarJSON();


	$(document).on('click', '#getdolarRefresh', function() {
		$('#getdolar').html('Obteniendo tasa del día...<div class="spinner"></div>');
		getDolarJSON();
	});


	$(document).on('click', '.mayor', function() {
		$('.toggle').toggle(function(){

			if ( $(this).parent().find('i').hasClass("fas fa-angle-down") ) {
				$(this).parent().find('i').removeClass("fas fa-angle-down").addClass("fas fa-angle-up");
				$('.mayor').css('background-color', '#d6d6d6');
			} else {
				$(this).parent().find('i').removeClass("fas fa-angle-up").addClass("fas fa-angle-down");
				$('.mayor').removeAttr('style');
			}

		});
	});


	$(document).on('submit', '.form-delete', function(e) {
		e.preventDefault();
		let s = confirm('¿Seguro quieres eliminar este registro?');
		if (s) {
			e.target.submit();
		}
	});


	$(document).on('click', '#gallery_open', function() {
		$('.gallery_full').show();
		$('#modalViewProduct .container-fluid').hide();
	});
	$(document).on('click', '.close_gallery', function() {
		$('.gallery_full').hide();
		$('#modalViewProduct .container-fluid').show();
	});
	
})

