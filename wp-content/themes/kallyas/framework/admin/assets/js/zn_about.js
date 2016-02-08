(function ($) {
	$.ZnAboutJs = function () {
		this.scope = $(document);
		this.zinit();
		this.zn_dummy_step = 0;
		this.failed = 0;
	};

	$.ZnAboutJs.prototype = {
		zinit : function() {
			var fw = this;

			fw.init_tabs();
			// Init theme registration form
			fw.init_theme_registration();
			// Init dummy data install
			fw.init_dummy_install();
			// Init misc
			fw.init_misc();
			// Init tooltips
			fw.init_tooltips();
		},

		init_tooltips : function(){
			$( '.zn-server-status-column-icon' ).tooltip({
				position : { my: 'center bottom', at: 'center top-10' }
			});
		},

		init_tabs : function(){

			var nav_li = $('.zn-about-navigation > li'),
				actions_area = $('#zn-about-actions');

			// Check if first or last to show next/prev or both
			var doNextprev = function(index){
				if( index == 0 ){
					actions_area.addClass('is-first').removeClass('is-last');
				}
				else if( index == (nav_li.length - 1 ) ){
					actions_area.addClass('is-last').removeClass('is-first');
				}
				else {
					actions_area.removeClass('is-first is-last');
				}
			}

			nav_li.click(function(e){
				e.preventDefault();

				// Activate the menu
				$(e.currentTarget).addClass('active');
				$(e.currentTarget).siblings('li').removeClass('active');

				// Activate the current tab
				var tabs = $(this).closest('.zn-about-tabs-wrapper').find('.zn-about-tabs > .zn-about-tab'),
					current_tab = $( $('a', e.currentTarget).attr('href') );
				tabs.removeClass('active');
				current_tab.addClass('active');

				doNextprev( nav_li.filter('.active').index() );
			});

			// Init next and prev buttons
			$( '.zn-about-action-nav' ).click(function(){
				var tabs = $('.zn-about-tabs-wrapper').find('.zn-about-tabs > .zn-about-tab'),
					current_tab = tabs.filter('.active'),
					to = $(this).attr('data-to');

				// Change menu
				$('.zn-about-navigation > li').removeClass('active');
				$('.zn-about-navigation > li a[href="#'+current_tab.attr('id')+'"]').parent()[to]().addClass('active')
				// theparent;

				// Change tab
				tabs.removeClass('active');
				current_tab[to]().addClass('active');

				doNextprev( nav_li.filter('.active').index() );

			});
		},

		init_theme_registration : function(){
			$('.zn-about-register-form').submit(function(e){
				e.preventDefault();

				var username = $('.zn-about-register-form-username', this).val(),
					api_key  = $('.zn-about-register-form-api', this).val(),
					nonce = $('#zn_nonce', this).val(),
					form = $(this),
					button = form.find( '.zn-about-register-form-submit' ),
					is_submit = false;

				if( is_submit === true ){
					return;
				}

				// Don't do anything if we don't have the values filled
				if( ! username.length || ! api_key.length || ! nonce.length ){
					$(this).addClass('zn-about-register-form--error');
					return;
				}

				var data = {
					'action': 'zn_theme_registration',
					'username': username,
					'api_key': api_key,
					'zn_nonce': nonce,
				};

				$(this).addClass('zn-submitting');

				// Perform the Ajax call
				jQuery.post(ajaxurl, data, function(response) {
					is_submit = true;
					form.removeClass('zn-submitting');
					button.val('Saved !');
					setTimeout(function(){
						button.val('REGISTER');
						is_submit = false;
					}, 1000);
				});

			});
		},

		init_dummy_install : function(){
			var fw = this;

			$('.zn-about-dummy-install').click(function(e){
				e.preventDefault();

				var $t = $(this);

				// Prevent multiple clicks
				if ( $( '.zn-about-dummy-install').hasClass('zn-submitting') ){
					return false;
				}

				var nonce = $(this).closest('.zn-about-dummy-container').data('znnonce'),
					install_folder = $(this).data('install_folder');

				var data = {
					'action': 'zn_dummy_install',
					'install_folder': install_folder,
					'zn_nonce': nonce,
				};

				$( '.zn-about-dummy-install').addClass('zn-submitting');
				$t.addClass('zn-installing');
				$( '.zn-dummy-import-block').show();


				fw.process_dummy_install(data, function(){
					$( '.zn-about-dummy-install').removeClass('zn-submitting');
					$t.removeClass('zn-installing');
					$( '.zn-dummy-import-block').hide();
				});

				// Perform the Ajax call
				// jQuery.post(ajaxurl, data, function(response) {
				// 	$( '.zn-about-dummy-install').removeClass('zn-submitting');
				// 	$( '.zn-dummy-import-block').hide();
				// 	// We should show a success message

				// });

			});

		},

		process_dummy_install : function( data, callback ) {

			var fw = this,
				message_container = $('.zn_import_msg_container'),
				percent_bar = $('.zn_import_bar');

			jQuery.post( ajaxurl, data, function(response,textStatus, jqXHR  ) {

				if( textStatus.status == '500' || typeof response === 'undefined' || ! response ){
					setTimeout(function(){
						fw.failed += 1;

						if( fw.failed <= 3 ){
							fw.process_dummy_install(data,callback);
						}
						else{
							alert('The dummy data could not be imported. Your server blocks the process.');
						}

					}, 3000);
					return false;
				}

				// GET ONLY THE AJAX RESPONSE
				var source = $('<div>' + response + '</div>');
				response = source.find(".zn_json_response").html();
				response = $.parseJSON( response );

				console.log( data );

				if( response.status == 'ok' ) {

					if ( response.percent ){
						percent_bar.width(response.percent+'%');

					}
					fw.process_dummy_install(data,callback);

				}
				else if( response.status == 'done' ){
					percent_bar.width('100%');
					callback();

					alert( 'Sample-data installed!' );
				}
				else{
					fw.zn_dummy_step = 0;
				}
				//console.log(response);
			}, 'html').fail(function(){
				setTimeout(function(){
					fw.failed += 1;

					if( fw.failed <= 3 ){
						fw.process_dummy_install(data,callback);
					}
					else{
						alert('The dummy data could not be imported. Your server blocks the process.');
					}
				}, 3000);
			});

		},



		init_misc : function(){
			$('#tf_username').on('keyup change', function(event) {
				var tfusername = $(this).val(),
					genlink = $(this).closest('.zn-about-register-form').find('.js-zn-label-tfusername-link');
				if(tfusername != ''){
					genlink.attr('href','http://themeforest.net/user/'+ tfusername +'/api_keys/edit').removeClass('tfusername-link--nope').addClass('tfusername-link--ok');
				} else {
					genlink.addClass('tfusername-link--nope').removeClass('tfusername-link--ok');
				}
			}).trigger('change');
		}
	}

	$(document).ready(function() {
		// Call this on document ready
		$.ZnAboutJs = new $.ZnAboutJs();
	});

})(jQuery)