(function( $ ) {
	'use strict';

	 $( window ).load(function() {
		/**
		 * TABS
		 */
		$('.create-new-config').click(function(ev) {
			ev.preventDefault();
			$("#new_form").submit();
			return false;
		});
		$('.nav-tab').click(function(ev) {
			ev.preventDefault();
			$(".nav-tab-active").removeClass("nav-tab-active");
			$(this).addClass("nav-tab-active");
			
			
			$(".tab-pane-active").removeClass("tab-pane-active");
			var pos = $(this).attr("data-pos");
			$(".tab-pane-"+pos).addClass("tab-pane-active");
			return false;
		});

		$(".delete-shortcode").click(function(ev){
			ev.preventDefault();
			if(!confirm("¿Deseas eliminar?")) return;

			var pos = $(this).attr("data-pos");
			$("#delete_form_"+pos).submit();
			return false;
		});

		/**
		 * EVENT CONTENT FORM
		 */
		$('.form_agenda_content_control').change(function(ev) {
			var val = $(this).val();

			$(this).closest("form").find('.form_content_row').hide();
			if(val === 'multiple_events') {
				$(this).closest("form").find(".form_agenda_type_row").show();
				$(this).closest("form").find(".form_agenda_content_temp_row").show();
				$(this).closest("form").find(".events-template-option").show();
				$(this).closest("form").find(".single-event-template-option").hide();
				$(this).closest("form").find(".form_events_qt_row").show();
				$(this).closest("form").find(".form_events_path_row").show();
				$(this).closest("form").find(".form_agenda_template_row select").val("three-cols");
			}
			else if(val === 'single_event') {
				$(this).closest("form").find(".form_agenda_event_row").show();	
				$(this).closest("form").find(".form_agenda_content_temp_row").hide();
				$(this).closest("form").find(".events-template-option").hide();
				$(this).closest("form").find(".single-event-template-option").show();
				$(this).closest("form").find(".form_events_qt_row").hide();
				$(this).closest("form").find(".form_events_path_row").hide();
				$(this).closest("form").find(".form_agenda_template_row select").val("grid");
			}
		});

		var agenda_prev_value;
		$('.form_agenda_type_control').change(function(ev) {
			var val = $(this).val();
			
			$(this).closest("form").find(".form_agenda_row").hide();
			if(val === 'artists') {
				$(this).closest("form").find(".form_agenda_artists_row").show();
				$(this).closest("form").find("#section-config-ticketing").show();
			}
			else if(val === 'venues') {
				$(this).closest("form").find(".form_agenda_venues_row").show();	
				$(this).closest("form").find("#section-config-ticketing").show();
			}
			else if(val === 'organizations') {
				$(this).closest("form").find(".form_agenda_organizations_row").show();	
				$(this).closest("form").find("#section-config-ticketing").show();
			}
			else if(val === 'channels') {
				$(this).closest("form").find(".form_agenda_channels_row").show();
				$(this).closest("form").find("#section-config-ticketing").hide();
			}
			else if(val === 'users') {
				$(this).closest("form").find(".form_agenda_users_row").show();	
				$(this).closest("form").find("#section-config-ticketing").show();
			}

			// Borrar el valor del input relacionado para facilitar la vida al usuario
			if(agenda_prev_value != val) {
				if(val === 'artists') {
					$(this).closest("form").find(".form_agenda_artists_row input").val("");
				}
				else if(val === 'venues') {
					$(this).closest("form").find(".form_agenda_venues_row input").val("");
				}
				else if(val === 'organizations') {
					$(this).closest("form").find(".form_agenda_organizations_row input").val("");
				}
				else if(val === 'channels') {
					$(this).closest("form").find(".form_agenda_channels_row input").val("");
				}
				else if(val === 'users') {
					$(this).closest("form").find(".form_agenda_users_row input").val("");
				}
			}

			agenda_prev_value = val;
		});


		/**
		 * TEMPLATES
		 */
		$(".file-edit-group label").click(function(ev) {
			$(this).parent().toggleClass("active");

			return false;
		});

		$(".restore-file-button").click(function(ev) {
			if(!confirm("¿Estás seguro? Se elimianrá el contenido del fichero..."))
				return;
				
			var id = $(this).attr("id");
			var $form = $("#form_restore");
			if(id.indexOf("restore-") != -1) {
				var value = id.replace("restore-", "");
				$form.find("input[name=template_to_restore]").val(value);
				$form.submit();
			}
		});

		if($('.file-edit-control').length > 0) {
			wp.codeEditor.initialize($('.file-edit-control'), {});
		}
	 });


	

})( jQuery );