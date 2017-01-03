$.fn.editable.defaults.mode='inline';
$.fn.editable.defaults.ajaxOptions={type:'PUT'};
$(document).ready(function(){
	$('.set-guide-number').editable();
	$('.select-status').editable({
		source:[
			{value:'creado',text:'Creado'},
			{value:'enviado',text:'Enviado'},
			{value:'recibido',text:'Recibido'}
		]
	});
	$('.add-to-cart').on('submit',function(ev){
		ev.preventDefault();
		var $form=$(this);
		var $button=$form.find('[type="submit"]'); // se detiene el submite del form 
		$.ajax({
			url:$form.attr('action'),
			beforeSend:function(){
				$button.val('Cargando...')
			},
			method:$form.attr('method'),
			data:$form.serialize(),
			dataType:'json',
			success:function(resp)
			{
				console.log(resp);
				$(".circle-shopping-cart").html(resp.products_count).addClass('highlight');
				$button.css('background-color','#00c853').val('Agregado');
				setTimeout(function(){
					restarButton($button);
				},2000);
			},
			error:function(error){
				console.log("Error: "+error);
				$button.css('background-color','#d50000').val('Hubo un error');
				setTimeout(function(){
					restarButton($button);
				},2000);
			}
		});
		return false;
	});
	function restarButton(button)
	{	
		$(".circle-shopping-cart").removeClass('highlight');
		button.attr('style','').val('Agregar al carrito');
	}
}); 