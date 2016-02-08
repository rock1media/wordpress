<?php
/*
	Name: Contact Form
	Description: This element will generate a contact form
	Class: ZnContactForm
	Category: content
	Level: 3
	Styles: true
*/

class ZnContactForm extends ZnElements {

	// Will allow multiple forms on a single page. It will be incremented on each form created
	static $form_id = 1;

	var $submit = true;

	var $form_fields;
	var $error_messages = array();

	function options() {

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
						array(
							'id'          => 'description',
							'name'        => 'Description',
							'description' => 'Please enter a description for this element',
							'type'        => 'visual_editor',
							'class'		=> 'zn_full',
							'std'		=> ''
						),
						array(
							'id'          => 'email',
							'name'        => 'Email address',
							'description' => 'Please enter the email address where you want the form submissions to
							be sent. Note that you can enter multiple recipients separated by comma(,).',
							'type'        => 'text'
						),
						array(
							'id'          => 'cf_from',
							'name'        => 'Default reply address',
							'description' => 'Select which email address should be added as reply method.',
							'type'        => 'select',
							'std'		=> 'noreply',
							'options'	  => array(
								'noreply' => 'No Reply ( noreply@your_domain )',
								'dynamic' => 'Dynamic (sender\'s email address)'
							)
						),
						array(
							'id'          => 'redirect_url',
							'name'        => 'Redirect url',
							'description' => 'Using this option you can redirect the user after the form is succesfully submitted',
							'std' 		  => '',
							'placeholder' => 'http://hogash.com',
							'type'        => 'text'
						),
						array(
							'id'          => 'submit_label',
							'name'        => 'Submit button label',
							'description' => 'Enter a text for the submit button label.',
							'std' 		  => 'Send message',
							'type'        => 'text'
						),
						array(
							'id'          => 'email_subject',
							'name'        => 'Email subject text',
							'description' => 'Please enter your desired text that will appear as the subject of the received email',
							'std' 		  => 'New form submission',
							'type'        => 'text'
						),
						array(
							'id'          => 'sent_message',
							'name'        => 'Mail sent message',
							'description' => 'Please enter your desired text that will appear after the form is successfully sent',
							'std' 		  => 'Thank you for contacting us',
							'type'        => 'text'
						),
						array(
							'id'          => 'captcha',
							'name'        => 'Show captcha',
							'description' => 'Select yes if you want to add a captcha field.',
							'type'        => 'select',
							'std'        => '0',
							'options'	  => array( '0' => 'No' , '1' => 'Yes' )
						),
						array(
							'id'          => 'captcha_lang',
							'name'        => 'Captcha language',
							'description' => 'Enter the desired captcha language code ( <a href="'.esc_url('https://developers.google.com/recaptcha/docs/language').'" target="_blank">you can get it from here</a> ).',
							'type'        => 'text',
							'placeholder' => 'en',
							'dependency'  => array( 'element' => 'captcha' , 'value' => array( '1' ) )
						),
						array(
							'id'          => 'cf_labels_pl',
							'name'        => 'Labels or Placeholders?',
							'description' => 'Choose what to display, ',
							'type'        => 'select',
							'std'        => '1',
							'options'	  => array( '1' => 'Labels' , '2' => 'Placeholders' , '3' => 'Both' )
						),

						array(
							'id'          => 'element_scheme',
							'name'        => 'Element Color Scheme',
							'description' => 'Select the color scheme of this element',
							'type'        => 'select',
							'std'         => '',
							'options'        => array(
								'' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
								'light' => 'Light (default)',
								'dark' => 'Dark'
							),
							'live'        => array(
								'multiple' => array(
									array(
										'type'      => 'class',
										'css_class' => '.'.$uid,
										'val_prepend'  => 'cf--',
									),
									array(
										'type'      => 'class',
										'css_class' => '.'.$uid,
										'val_prepend'  => 'element-scheme--',
									),
									array(
										'type'      => 'class',
										'css_class' => '.'.$uid.' .form-control',
										'val_prepend'  => 'form-control--',
									),
								)
							)
						),

						array(
							'id'          => 'cf_debug',
							'name'        => 'Enable debugging?',
							'description' => 'If you have problems with the contact form, this option will help debug the problem by showing some errors into the response field.',
							'type'        => 'toggle2',
							'std'        => '',
							'value'        => '1',
						),
				)
			),
			'fields' => array(
				'title' => 'Fields',
				'options' => array(
					array(
						'id'         	=> 'fields',
						'name'       	=> 'Add your own, custom fields:',
						'description' 	=> 'Here you can create your contact form fields',
						'type'        	=> 'group',
						'sortable'	  	=> true,
						'element_title' => 'name',
						'subelements' 	=> array(
							array(
								'id'          => 'name',
								'name'        => 'Field name',
								'description' => 'Please enter a name for this field',
								'type'        => 'text'
							),
							array(
								'id'          => 'type',
								'name'        => 'Field type',
								'description' => 'Please select the field type',
								'type'        => 'select',
								'options'	  => array( 'text' => 'Text' , 'textarea' => 'Textarea', 'select' => 'Select', 'checkbox' => 'Checkbox', 'dynamic' => 'Dynamic Field' )
							),
							array(
								'id'          => 'select_option',
								'name'        => 'Select option',
								'description' => 'Please add your values for the select options in the following format :
								value:option name, value2:option name 2. For example "house:House, car:Car, piano:Piano"',
								'type'        => 'text',
								'dependency' => array(
									'element' => 'type' ,
									'value'=> array('select')
								)
							),
							array(
								'id'          => 'placeholder',
								'name'        => 'Placeholder',
								'description' => 'Please enter the placeholder value for this field',
								'type'        => 'text',
								'dependency' => array(
									'element' => 'type' ,
									'value'=> array('text', 'textarea')
								)
							),
							array(
								'id'          => 'width',
								'name'        => 'Field width',
								'description' => 'Please select the field width',
								'type'        => 'select',
								'options'	  => array( 'col-sm-12' => 'Full width' , 'col-sm-6' => 'Half width' )
							),
							array(
								'id'          => 'validation',
								'name'        => 'Field validation',
								'description' => 'Please select the field validation',
								'type'        => 'select',
								'std'		  => 'not_empty',
								'options'	  => array( 'none' => 'No validation' , 'not_empty' => 'Value not empty' , 'is_email' => 'Value is email')
							),
							array(
								'id'          => 'is_email_field',
								'name'        => 'Is email field ?',
								'description' => 'Select yes if this is the email field. If yes, this email will be used as the Reply to when receiving an email from this form.',
								'type'        => 'select',
								'std'		  => '0',
								'options'	  => array( '0' => 'No' , '1' => 'Yes' )
							),
						)
					)
				)
			),
			'other' => array(
				'title' => 'Other Options',
				'options' => array(

					array(
						'id'          => 'css_class',
						'name'        => 'CSS class',
						'description' => 'Enter a css class that will be applied to this element. You can than edit the custom css, either in the Page builder\'s CUSTOM CSS (which is loaded only into that particular page), or in Kallyas options > Advanced > Custom CSS which will load the css into the entire website.',
						'type'        => 'text',
						'std'         => '',
					),

				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#foPoTLB3Q5k',
				'docs'    => 'http://support.hogash.com/documentation/contact-form/',
				'copy'    => $uid,
				'general' => true,
			)),

		);


		return $options;

	}

	function element() {
		$description = $this->opt('description')  ? $this->opt('description') : '';

		$submit_label = ( $this->opt('submit_label') ) ? $this->opt('submit_label') : 'Send message';
		$button_style = $this->opt('button_style', 'zn_btn_3d');

		$fields = ( $this->opt('fields') ) ? $this->opt('fields') : '';
		$captcha = ( $this->opt('captcha') ) ? $this->opt('captcha') : '';
		$sent_message = ( $this->opt('sent_message') ) ? $this->opt('sent_message') : __( 'New Contact Form submission', 'zn_framework' );

		$response = '';


		if ( empty( $fields ) ) {
			echo '<div class="zn-pb-notification">Please configure the element options and add your contact fields.</div>';
			return;
		}

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = $this->opt('css_class','');

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'cf--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

	?>

		<div class="zn_contact_form_container contactForm cf-elm <?php echo implode(' ', $elm_classes); ?>">
			<?php if (!empty($description)) { ?>
				<div class="zn_description"><?php echo wpautop($description); ?></div>
			<?php } ?>
			<?php
			if ( $fields ) {

				$label_mod = $this->opt('cf_labels_pl', '1') == '2' ? 'cf--placeholders':'';
				$redirect_url = $this->opt( 'redirect_url', false );

				echo '<form action="" method="post" class="zn_contact_form contact_form cf-elm-form row '.$label_mod.'" data-redirect="'.esc_attr( esc_url( $redirect_url ) ).'">';

					if ( $captcha ) {
						$fields[] = array( 'name' => 'zn_captcha' , 'type' => 'captcha' , 'validation' => 'captcha' , 'width' => 'col-sm-12' );
					}
					$fields[] = array( 'name' => 'zn_pb_form_submit_'.self::$form_id ,'validation' => 'none', 'type' => 'hidden', 'width' => 'col-sm-12' );

					$this->form_fields = $fields;

					// PRINT OUT THE FORM FIELDS
					echo $this->create_form_elements();

					echo '<div class="col-sm-12">';

						if( ! isset( $_POST['zn_pb_form_submit_'.self::$form_id] ) ){
							// do nothing if we the form wasn't submitted
						}
						elseif( ! empty( $this->error_messages ) ){
							$response = '<div class="alert alert-danger alert-dismissible zn_cf_response" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>';
							foreach ( $this->error_messages as $key => $value) {
								$response .= $value;
							}
							$response .= '</div>';
						}
						elseif ( $this->submit && $this->form_send() ){
							$response = '<div class="alert alert-success alert-dismissible zn_cf_response" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$sent_message;
							if( $this->opt('cf_debug','') == 1 ) {
								$response .= '<pre>'.$this->form_send().'</pre>';
							}
							$response .= '</div>';
						}
						elseif( isset( $_POST['zn_pb_form_submit_'.self::$form_id] ) ){
							$response = '<div class="alert alert-danger alert-dismissible zn_cf_response" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>';
							$response .= __( 'There was a problem submiting your message. Please try again.', 'zn_framework' );
							if( $this->opt('cf_debug','') == 1 ) {
								$response .= '<pre>'.$this->form_send().'</pre>';
							}
							$response .= '</div>';
						}

					echo '<div class="zn_contact_ajax_response titleColor" id="zn_form_id'.self::$form_id.'" >'.$response.'</div>';

					echo' <span class="zn_submit_container"><button class="zn_contact_submit btn btn-fullcolor" type="submit">'.$submit_label.'</button></span></div>';

				echo '</form>';

			}
			?>

		</div>

	<?php
		self::$form_id++;
	}


	function scripts() {
		$captcha_lang = $this->opt( 'captcha_lang' ) ? '&hl='. $this->opt( 'captcha_lang' ) : '' ;
		wp_enqueue_script( 'zn_recaptcha', 'https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'.$captcha_lang , array('jquery'), ZN_FW_VERSION, true );
		wp_localize_script( 'zn_recaptcha', 'zn_contact_form', array(
			'captcha_not_filled' => __( 'Please complete the Captcha validation', 'zn_framework' ),
		));
	}

	function create_form_elements() {

		// THIS WILL BE INCREMENTED IF THE GENERATED ID IS NOT OK
		$i = 0;

		foreach( $this->form_fields as $key => $field )
		{
			if( isset($field['type']) && method_exists($this, $field['type']))
			{
				$value = $validation_class = '';

				// SET THE FIELD ID FROM NAME AND FALLBACK TO THE INCREMENTED ID
				$id = zn_sanitize_string( $field['name'] , false , true );
				if( $field['type'] != 'hidden' ) {
					$id = 'zn_form_field_'.$id.$i;
				}
				$i++;

				//$validation_class = $field['validation'] != 'none' ? $field['validation'] : '';

				// ADD THE VALUE IF IT'S SET
				if ( !empty( $_POST[$id] ) ) $value = $_POST[$id];

				// PERFORM THE VALUE VALIDATION
				if ( $field['validation'] != 'none' && isset( $_POST[$id] ) ) {
					$validation_class .= ' '.$this->validate_field( $field , $id , $value );
				}

				if( $field['validation'] == 'captcha' && isset( $_POST[ 'g-recaptcha-response' ] ) ){
					$validation_class .= ' '.$this->validate_field( $field , $id , $_POST[ 'g-recaptcha-response' ] );
				}

				echo '<p class="'.$field['width'].' '.$validation_class.' kl-fancy-form zn_form_field zn_'.$field['type'].'">';
				/*
				 * Some servers are not allowing this type of function call:
				 * 		$this->$field['type']( $field , $id , $value );
				 */
				call_user_func(array($this, $field['type']), $field , $id , $value);
				echo '</p>';

			}
		}

	}


/* WILL OUTPUT A TEXT FIELD */
	function text( $field , $id , $value )
	{
		$phType = $this->opt('cf_labels_pl', '1');

		$label = '';
		$placeholder = '';

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );

		if('2' == $phType){
			$placeholder = 'placeholder="'.esc_attr($field['placeholder']).'"';
		}
		elseif('3' == $phType){
			$label = '<label for="'.$id.'" class="control-label kl-font-alt kl-fancy-form-label">'.esc_attr($field['name']).'</label>';
			$placeholder = 'placeholder="'.$field['placeholder'].'"';
		}
		// 1
		else { $label = '<label for="'.$id.'" class="control-label kl-font-alt kl-fancy-form-label">'.esc_attr($field['name']).'</label>'; }

		echo '<input type="text" name="'.$id.'" id="'.$id.'" '.$placeholder.' value="'.esc_attr($value).'"
				class="zn_form_input zn-field-'.$field['type'].' form-control form-control--'.$color_scheme.' kl-fancy-form-input zn_validate_'.$field['validation'].'"/>';
		if(! empty($label)){
			echo $label;
		}
	}


/*
 * WILL OUTPUT A DYNAMIC FIELD
 * Displays a value that is passed through a custom link (eg: Modal Inline Dynamic link)
 */
	function dynamic( $field , $id , $value )
	{
		$this->text( $field , $id , $value);
	}

/* WILL OUTPUT A TEXT FIELD */
	function hidden( $field , $id , $value ) {
		echo '<input type="hidden" name="'.$id.'" id="'.$id.'" value="'.esc_attr($value).'" class="zn_form_input zn_validate_'.$field['validation'].'" />';
	}

/* Will output a checkbox */
	function checkbox( $field , $id , $value ){

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );

		$checked = true === $value ? 'checked="checked"' : '';

		echo '<input '.$checked.' type="checkbox" name="'.$id.'" class="zn_form_input form-control form-control--'.$color_scheme.' zn_validate_'.$field['validation'].'" id="'.$id.'" value="true"/>';
		echo '<label class="control-label" for="'.$id.'">'.$field['name'].'</label>';
	}

/* WILL OUTPUT A TEXT FIELD */
	function select( $field , $id , $value ) {

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );

		$select_options = explode(',',$field['select_option']);
		echo '<label class="control-label kl-font-alt kl-fancy-form-label">'.esc_attr($field['name']).'</label>';
		if( is_array($select_options) ) {
			echo '<select name="'.$id.'" id="'.$id.'" class="zn_form_input form-control form-control--'.$color_scheme.' kl-fancy-form-select zn_validate_'.$field['validation'].'">';
				//if ( !empty( $field['name'] ) ) { echo '<option value="">'.$field['name'].'</option>'; }
				foreach ($select_options as $key => $value) {
					$options = explode( ':',$value );
					if ( is_array($options) ) {
						$select_key = trim($options[0]);
						$select_value = trim($options[1]);

						$selected = $select_key == $value ? 'selected="selected"' : '';

						echo '<option value="'.esc_attr($select_key).'" '.$selected.'>'.$select_value.'</option>';
					}

				}
			echo '</select>';
		}

	}

/* WILL OUTPUT A CAPTCHA FIELD */
	function captcha( $field , $id , $value ) {

		$siteKey = zget_option('rec_pub_key', 'general_options');
		$pvKey = zget_option('rec_priv_key', 'general_options');

		if(empty($siteKey) || empty($pvKey)){
			_e( 'Please enter the reCaptcha public and private keys inside the admin panel!', 'zn_framework' );
			return;
		}

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		echo '<span class="zn-recaptcha" data-colorscheme="'.$color_scheme.'" data-sitekey="'.$siteKey.'" id="zn_recaptcha_'.self::$form_id.'"></span>';

	}

/* WILL OUTPUT A TEXTAREA FIELD */
	function textarea( $field , $id , $value ) {
		$phType = $this->opt('cf_labels_pl', '1');

		$label = '';
		$placeholder = '';

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );

		if('2' == $phType){
			$placeholder = 'placeholder="'.esc_attr($field['placeholder']).'"';
		}
		elseif('3' == $phType){
			$label = '<label for="'.$id.'" class="control-label kl-font-alt kl-fancy-form-label">'.esc_attr($field['name']).'</label>';
			$placeholder = 'placeholder="'.$field['placeholder'].'"';
		}
		// 1
		else { $label = '<label for="'.$id.'" class="control-label kl-font-alt kl-fancy-form-label">'.esc_attr($field['name']).'</label>'; }

		echo '<textarea name="'.$id.'" class="zn_form_input form-control form-control--'.$color_scheme.' kl-fancy-form-textarea zn_validate_'.$field['validation'].'"
		id="'.$id.'" '.$placeholder.' cols="40" rows="6">'.$value.'</textarea>';

		if(! empty($label)){
			echo $label;
		}
	}

	function validate_field( $field, $id , $value ){

		if( ! isset( $_POST['zn_pb_form_submit_'.self::$form_id] ) ){
			// do nothing if we the current form wasn't submitted
			return;
		}

		switch ( $field['validation'] )
		{
			case 'not_empty':

				if( !empty( $value ) ) return "zn_field_valid";

			break;

			case 'is_email':

				if( is_email( $value ) ) return "zn_field_valid";

			break;

			case 'captcha':


				$captcha_val = $_POST['g-recaptcha-response'];
				$pvKey = zget_option('rec_priv_key', 'general_options');

				$response = wp_remote_request("https://www.google.com/recaptcha/api/siteverify?secret=".$pvKey."&response=".$captcha_val);
				if( empty( $response['body'] ) ){
					$this->error_messages[] = __( 'Got empty response from server.', 'zn_framework' );
					continue;
				}

				$response = json_decode( $response['body'], true);

				if( $response["success"] !== true ){
					if( !empty( $response['error-codes'] ) && is_array( $response['error-codes'] ) ){
						foreach ( $response['error-codes'] as $key => $value) {
							if( $value == 'missing-input-secret' ){
								$this->error_messages[] = __( 'The secret parameter is missing.', 'zn_framework' );
							}
							elseif ( $value == 'invalid-input-secret' ) {
								$this->error_messages[] = __( 'The secret parameter is invalid or malformed.', 'zn_framework' );
							}
							elseif ( $value == 'missing-input-response' ) {
								$this->error_messages[] = __( 'Please complete the captcha validation', 'zn_framework' );
							}
							elseif ( $value == 'invalid-input-response' ) {
								$this->error_messages[] = __( 'The response parameter is invalid or malformed.', 'zn_framework' );
							}
						}
					}
				}
				else{
					return "zn_field_valid";
				}

			break;

		}

		$this->submit = false;
		return 'zn_field_not_valid';

	}

	function form_send() {

		$to = $this->opt('email') ? trim($this->opt('email')) : '';
		if(false !== ($pos = strpos($to, ','))){
			// trim out multiple spaces
			$to = preg_replace('/\s+/',' ', $to);
			$to = explode(',',$to);
		}
		$subject = $this->opt('email_subject') ? $this->opt('email_subject') : __('New form submission','zn_framework');
		$message = '';
		$attachments = '';

		$i = 0;


		$dynamic_email = '';

		// DEFAULT FROM
		$from = 'no-reply@your-domain.com';
		$default_from = parse_url(home_url());
		if ( !empty($default_from['host']) )
		{
			$from = "no-reply@".str_replace('www.', '', $default_from['host']);
		}

		foreach ( $this->form_fields as $field ) {

			// SET THE FIELD ID FROM NAME AND FALLBACK TO THE INCREMENTED ID
			$id = zn_sanitize_string( $field['name'] , false , true );
			if( $field['type'] != 'hidden' ) {
				$id = 'zn_form_field_'.$id.$i;
			}
			$i++;

			if ( isset( $_POST[$id] ) ) {
				if($field['type'] != 'hidden' && $field['type'] != 'captcha')
				{
					$message .= $field['name'] .' : '.nl2br( $_POST[$id] ) .'<br/>';
				}
				// Check if form has email field
				if( isset($field['is_email_field']) && $field['is_email_field'] == 1 )
				{
					$dynamic_email = nl2br( $_POST[$id] );
				}
			}
		}

		// DYNAMIC FROM
		$dfrom = $this->opt('cf_from', 'noreply');
		if($dfrom == 'dynamic')
		{
			if( is_email( $dynamic_email ) )
			{
				$from = $dynamic_email;
			}
		}

		// GENERATE THE FINAL HEADER AND SEND THE FORM
		$headers = array(
			'From: '.$from.' <'.$from.'>',
			'Content-Type: text/html; charset=UTF-8'
		);

		$result = wp_mail( $to, $subject, $message, $headers );

		/**
		 * DEBUG: to uncomment if needed
		 */
		if( $this->opt('cf_debug','') == 1 ) {
			if (!$result) {
				global $ts_mail_errors;
				global $phpmailer;
				if (!isset($ts_mail_errors)) $ts_mail_errors = array();
				if (isset($phpmailer)) {
					$ts_mail_errors[] = $phpmailer->ErrorInfo;
				}
				$result = 'Errors:<br>';
				$result .= implode('<br>', $ts_mail_errors);
			}
		}

		return $result;

	}

}
