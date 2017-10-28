
$(document).ready(function(){

	// $.ajaxSetup({
 //    	headers: {
 //        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 //    	}
	// });

$('.history tbody').on('click', '.btn', function(e){
	e.preventDefault();

	_id = '';
	_bonus = '';
	_bonus_date = '';
	_isr = '';
	_isr_date = '';

	// Capturar los datos que pertenecen a la fila elegida.
	var currenteroww = $(this).closest('tr');
		_id = parseInt(currenteroww.find('td:eq(0)').text());
		_bonus = currenteroww.find('input[name^="bono"]').val();
		//_bonus_date = currenteroww.find('td:eq(2)').text();
		_isr = currenteroww.find('input[name^="isr"]').val();
		//_isr_date = currenteroww.find('td:eq(4)').text();

	// Validar _id, _bono, _isr antes de procesar actualziación.
	if( isNaN(_id) || _id == "")
	{    		
		$('.notificar').empty().show().html('<div class="alert alert-danger" role="alert">'+"Ha ocurrido un error. Actualice la página."+'</div>');
  	}else if( isNaN(_bonus) || _bonus == "")
  			{  				
  				$('.notificar').empty().show().html('<div class="alert alert-danger" role="alert">'+"Agregue la cantidad de bono."+'</div>');
  			}else if( isNaN(_isr) || _isr == "")
  					{
  						$('.notificar').empty().show().html('<div class="alert alert-danger" role="alert">'+"Agregue la cantidad de ISR."+'</div>');
  					}else{
							$('.notificar').empty().hide();								
								setRecordUpdate(_id, _bonus, _isr);
							}
});


/**
 * Función para actualizar datos de un id de historial especifico.
 */
	function setRecordUpdate(_id, _bono, _isr) 
	{
		var _emp_id = parseInt($('#emp_id').val());

	        $.ajax({
	            type: 'post',
	            url: '/dato/historial/record',
	            data: {
	                '_token': $('input[name=_token]').val(),
	                '_id': _id,
	                '_emp_id': _emp_id,
	                '_bono': _bono,
	                '_isr': _isr
	            },
	            success: function (result) {
					$('.notificar').empty().show().html('<div class="alert alert-success" role="alert">'+result.msg+'</div>');               
	                //location.reload();                
	            },
	            error: function (jqXHR, textStatus, errorThrown) {

	             if (jqXHR.status === 0) {
	             	$('.notificar').empty().show().html('<div class="alert alert-danger" role="alert">'+"Not connect: Verify Network."+'</div>');            		
			          } else if (jqXHR.status == 404) {		            
			            $('.notificar').empty().show().html('<div class="alert alert-danger" role="alert">'+"Requested page not found [404]."+'</div>');
			          } else if (jqXHR.status == 500) {		            
			            $('.notificar').empty().show().html('<div class="alert alert-danger" role="alert">'+"Internal Server Error [500]."+'</div>');
			          } else if (jqXHR.status == 422) {
			          	$('.notificar').empty().show().html('<div class="alert alert-danger" role="alert">'+"Ya existe el registro."+'</div>');		            
			          } else if (textStatus === 'parsererror') {		            
			            $('.notificar').empty().show().html('<div class="alert alert-danger" role="alert">'+"Requested JSON parse failed."+'</div>');
			          } else if (textStatus === 'timeout') {		            
			            $('.notificar').empty().show().html('<div class="alert alert-danger" role="alert">'+"Time out error."+'</div>');
			          } else if (textStatus === 'abort') {		            
			            $('.notificar').empty().show().html('<div class="alert alert-danger" role="alert">'+"TAjax request aborted."+'</div>');
			          } else {
			          	$('.notificar').empty().show().html('<div class="alert alert-danger" role="alert">'+"Uncaught Error: Página o metodo no encontrado."+'</div>');
			          	//window.location.href = "/error";		            
			          }
	            }
	        }); // fin ajax
	}// Fin funcion

});