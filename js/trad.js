$(function() {
	var trad = {
		lang: [],
		type: false,
		modal: false,
		init: function() {
			// List languages
			$('th img').each(function() {
				trad.lang.push($(this).attr('alt'));
			});
			
			// Define type
			trad.type = $('h1').first().text().replace('Translate lang.', '').replace('.xml', '');
			
			// Popup
			$('td .icon-ok').popover({
				trigger: 'hover',
				placement: 'top',
				html: true,
				title: function() {
					var td    = $(this).parent().parent();
					var tr    = td.parent();
					var title = tr.find('td').first().text();
					var flag  = td.attr('data-lang');
					
					return '<img src="/img/flags/'+flag+'.png" /> '+title;
				},
				content: function() {
					return $(this).parent().parent().attr('data-content');
				}
			});
			
			// Action to edit
			trad.modal = $('#tradForm').modal({
				show: false
			});
			
			// Instance the trad form
			trad.modal.on('show', function(e) {
				var id        = $(this).data('id');
				var parent    = $(this).data('parent');
				var variables;
												
				if($(this).data('var') === "") {
					variables = new Array();
				} else if(typeof $(this).data('var') == "object") {
					variables = false;
				} else {
					 variables = $(this).data('var').split('|');
				}

				if(!variables) {
					$('#tradFormVar').html('<li>[]</li>');
				} else if(variables.length == 0) {
					$('#tradFormVar').html('<li>No variable</li>');
				} else {
					$('#tradFormVar').empty();
					for(var i in variables) {
						$('#tradFormVar').append('<li>'+variables[i]+'</li>');
					}
				}
								
				$("#tradFormTitle i").text(id);
				for(var i in trad.lang) {
					var lang = parent.find('td[data-lang="'+trad.lang[i]+'"]').attr('data-content');
					if(lang != "false") {
						$("textarea#tradForm-"+trad.lang[i]).val(lang);
					}
				}
			});
			
			trad.modal.on('hide', function() {
				$("textarea").val("");
			});
			
			// save the trad form
			$('#saveTradForm').live('click', function() {
				var id   = $("#tradFormTitle i").text();
				var data = {};
				
				for(var i in trad.lang) {
					var lang = $("textarea#tradForm-"+trad.lang[i]).val();
					
					// If translation have been made
					if(lang != "") {
						// Adding the line to the data to save
						data[trad.lang[i]] = lang;
						
						// Change td
						var td = trad.modal.data('parent').find('td[data-lang="'+trad.lang[i]+'"]')
							td.removeClass('error');
							td.addClass('success');
							td.html('<center><i class="icon-ok"></i></center>');
							td.attr('data-content', lang);
					} else {
						data[trad.lang[i]] = '['+id+']';
						
						// Change td
						var td = trad.modal.data('parent').find('td[data-lang="'+trad.lang[i]+'"]')
							td.removeClass('success');
							td.addClass('error');
							td.html('<center><i class="icon-remove"></i></center>');
							td.attr('data-content', false);
					}
					
				}
				
				// Refresh popup
				$('td .icon-ok').popover({
					trigger: 'hover',
					placement: 'top',
					html: true,
					title: function() {
						var td    = $(this).parent().parent();
						var tr    = td.parent();
						var title = tr.find('td').first().text();
						var flag  = td.attr('data-lang');
						
						return '<img src="/img/flags/'+flag+'.png" /> '+title;
					},
					content: function() {
						return $(this).parent().parent().attr('data-content');
					}
				});
				
				// Save change
				$.post('/ajax/trad.php', {
					data: data,
					type: trad.type,
					id: id
					
				}, function() {
					// Close modal
					trad.modal.modal('hide');
				});

			});
			
			$('a.edit').live('click', function(){
				var id = $(this).parent().parent().find('td:first').text();
				trad.modal.data('id', id)
						  .data('parent', $(this).parent().parent())
						  .data('var',    $(this).parent().parent().data('var'))
						  .modal('show');
				return false;
			});
			
		},
		edit: function(id) {
		}
	}
	
	trad.init();
});
