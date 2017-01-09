$(document).ready(function(){

	$('.date').daterangepicker({
	    "singleDatePicker": true,
	    "autoApply": true,
	    "locale": {
	        "format": "YYYY-MM-DD",
	        "separator": " - ",
	        "applyLabel": "Apply",
	        "cancelLabel": "Cancel",
	        "fromLabel": "From",
	        "toLabel": "To",
	        "customRangeLabel": "Custom",
	        "daysOfWeek": [
	            "Do",
	            "Lu",
	            "Ma",
	            "Mi",
	            "Ju",
	            "Vi",
	            "Sa"
	        ],
	        "monthNames": [
	            "Enero",
	            "Febrero",
	            "Marzo",
	            "Abril",
	            "Mayo",
	            "Junio",
	            "Julio",
	            "Agosto",
	            "Septiembre",
	            "Octubre",
	            "Noviembre",
	            "Diciembre"
	        ],
	        "firstDay": 1
	    },
	    "parentEl": "body",				   
	    "opens": "center"
	}, function(start, end, label) {
	  	
	});

	$(".perfil").click(function(){
		$("form").submit();
	});

	$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

	$("#add_forma").click(function(){

		var id = $("#forma option:selected").val();
		var tx = $("#forma option:selected").text();

		if($.isNumeric(id)){

			if( id != '' ){
				$("#formas").append('<tr>' + 
					'<td><input type="hidden" name="id_pago[]" value="' + id + '"><input type="text" class="form-control" name="detalle_pago[]" value="' + tx + ' "></td>' + 
					'<td width="25%" ><input type="text" class="form-control monto_pago text-right" autocomplete="off" name="monto_pago[]" maxlength="6" ></td>' +
					'<td width="5%" align="center"><button type="button" class="btn btn-danger btn-xs delete_pago"><i class="fa fa-minus-square"></i></button></td>' +
					'</tr>');
			}

		}

	});

	$("#formas").delegate(".delete_pago","click",function(){
		$(this).parent().parent().fadeOut('fast',function(){
			$(this).remove();
			var sum = 0;	
			$(".monto_pago").each(function(){			
				if( $.isNumeric($.trim($(this).val())) ){
					sum += parseInt($.trim($(this).val()));
				}
			});

			$("#abonado").val(sum);
		});
	});

	$("#formas").delegate(".monto_pago","change",function(){
		var sum = 0;	
		$(".monto_pago").each(function(){			
			if( $.isNumeric($.trim($(this).val())) ){
				sum += parseInt($.trim($(this).val()));
			}
		});

		$("#abonado").val(sum);
	});

	$("#plan").change(function(){

		var id = $("#plan option:selected").val();

		if(isNaN(id)){
			$("#a_pagar").val('');
		}else{
			$.ajax({

				url : $("#site").val() + "ajax/valor_plan" ,
				data : { p : id } ,
				cache : false ,
				type : 'POST' ,
				dataType : 'html' ,
				beforeSend : function(){
					$("#container button").attr("disabled",true);
					$("#sizing-addon1").html('<center><i class="fa fa-cog fa-spin text-primary"></i></center>');				
				},
				success : function(data){					
					$("#sizing-addon1").html('$');
					$("#a_pagar").val(data);									
				},
				error : function(error){					
					$("#sizing-addon1").html('$');
					$("#container button").removeAttr("disabled");
				}
			});	
		}

	}).trigger("change");

	$('[data-toggle="tooltip"]').tooltip();

	$('#myModal,#myModal2,#myModal4').on('show.bs.modal', function (e) {

		var button = $(e.relatedTarget);
		var modal = $(this);
		modal.find('.modal-title').html(button.data('title'));
		
		$.ajax({

			url : button.data('url') ,
			cache : false ,			
			dataType : 'html' ,
			beforeSend : function(){
				modal.find("#save,#save_file").attr("disabled",true);
				modal.find('.modal-body').html('<center><i class="fa fa-cog fa-3x fa-spin text-primary"></i></center>');				
			},
			success : function(data){
				modal.find("#save,#save_file").removeAttr("disabled");
				modal.find('.modal-body').html(data);
				$("#pais").trigger("change");
				$('.date').daterangepicker({
				    "singleDatePicker": true,
				    "autoApply": true,
				    "locale": {
				        "format": "YYYY-MM-DD",
				        "separator": " - ",
				        "applyLabel": "Apply",
				        "cancelLabel": "Cancel",
				        "fromLabel": "From",
				        "toLabel": "To",
				        "customRangeLabel": "Custom",
				        "daysOfWeek": [
				            "Do",
				            "Lu",
				            "Ma",
				            "Mi",
				            "Ju",
				            "Vi",
				            "Sa"
				        ],
				        "monthNames": [
				            "Enero",
				            "Febrero",
				            "Marzo",
				            "Abril",
				            "Mayo",
				            "Junio",
				            "Julio",
				            "Agosto",
				            "Septiembre",
				            "Octubre",
				            "Noviembre",
				            "Diciembre"
				        ],
				        "firstDay": 1
				    },
				    "parentEl": "body",				   
				    "opens": "center"
				}, function(start, end, label) {
				  	
				});				
								
			},
			error : function(error){
				modal.find("#save,#save_file").removeAttr("disabled");
				modal.find('.modal-body').html(error.responseText);
			}
		});		
		
	});

	$('#myModal3').on('show.bs.modal', function (e) {

		var button = $(e.relatedTarget);
		var modal = $(this);
		modal.find('.modal-title').html(button.data('title'));		
		modal.find('.modal-body').html('<img src="' + button.data('url') + '" class="img-responsive">');	
		
	});


	$("#pais").change(function(){		

		var $this = $(this);
		var selec = $("#region").data("selected");
		$.ajax({
			url : $("#site").val() + "ajax/regiones/" + $this.val() ,
			data : {s:selec},			
			cache : false ,
			type : 'POST' ,
			dataType : 'html' ,
			beforeSend : function(){
				$this.attr("disabled",true);
				$("#region optgroup,#comuna optgroup").html('');				
			},
			success : function(data){
				$this.removeAttr("disabled");
				$("#region optgroup").html(data);				
			},
			error : function(error){
				$this.removeAttr("disabled");				
			}
		});

	}).trigger("change");	

	$("#region").change(function(){		

		var $this = $(this);
		var selec1 = $this.data("selected");
		if($.isNumeric($this.val())){
			region = $this.val();
		}else{
			region = selec1;
		}
		var selec = $("#comuna").data("selected");
		$.ajax({
			url : $("#site").val() + "ajax/comunas/" + region ,
			data : {s:selec},			
			cache : false ,
			type : 'POST' ,
			dataType : 'html' ,
			beforeSend : function(){
				$this.attr("disabled",true);
				$("#comuna optgroup").html('');				
			},
			success : function(data){
				
				$this.removeAttr("disabled");				
				$("#comuna optgroup").html(data);
			},
			error : function(error){
				$this.removeAttr("disabled");				
			}
		});

	}).trigger("change");	

	$("input:text").attr("autocomplete","off");

	$("#save").click(function(){

		var href = $(this).parent().parent().find(".modal-body form");
		var body = $(this).parent().parent();
		var $this = $(this);
		
		if(href.attr("action")){
			$.ajax({
				url : href.attr("action") ,
				data : href.serialize() ,
				cache : false ,
				type : 'POST' ,
				dataType : 'html' ,
				beforeSend : function(){
					$this.attr("disabled",true);
					//body.find('.modal-body').html('<center><i class="fa fa-cog fa-2x fa-spin"></i></center>');
				},
				success : function(data){
					$this.removeAttr("disabled");
					body.find('.modal-body').html(data);
					$("#pais").trigger("change");
					$('.date').daterangepicker({
					    "singleDatePicker": true,
					    "autoApply": true,
					    "locale": {
					        "format": "YYYY-MM-DD",
					        "separator": " - ",
					        "applyLabel": "Apply",
					        "cancelLabel": "Cancel",
					        "fromLabel": "From",
					        "toLabel": "To",
					        "customRangeLabel": "Custom",
					        "daysOfWeek": [
					            "Do",
					            "Lu",
					            "Ma",
					            "Mi",
					            "Ju",
					            "Vi",
					            "Sa"
					        ],
					        "monthNames": [
					            "Enero",
					            "Febrero",
					            "Marzo",
					            "Abril",
					            "Mayo",
					            "Junio",
					            "Julio",
					            "Agosto",
					            "Septiembre",
					            "Octubre",
					            "Noviembre",
					            "Diciembre"
					        ],
					        "firstDay": 1
					    },
					    "parentEl": "body",				   
					    "opens": "center"
					}, function(start, end, label) {
					  	
					});
				},
				error : function(error){
					$this.removeAttr("disabled");
					body.find('.modal-body').html(error.responseText);
				}
			});
		}	

	});

	$("#save_file").click(function(){

		var href = $(this).parent().parent().find(".modal-body form");
		var body = $(this).parent().parent();
		var $this = $(this);		
		
		if(href.attr("action")){

			var formData = new FormData($("#form1")[0]);			
			
			$.ajax({
				url : href.attr("action") ,
				data : formData ,
				cache : false ,
				type : 'POST' ,				
				processData:false ,
				contentType:false ,
				beforeSend : function(){
					$this.attr("disabled",true);
					body.find('.modal-body').html('<center><i class="fa fa-cog fa-3x fa-spin text-primary"></i></center>');
				},
				success : function(data){					
					$this.removeAttr("disabled");
					body.find('.modal-body').html(data);
					
				},
				error : function(error){
					$this.removeAttr("disabled");
					body.find('.modal-body').html(error.responseText);
				}
			});
		}	

	});


});