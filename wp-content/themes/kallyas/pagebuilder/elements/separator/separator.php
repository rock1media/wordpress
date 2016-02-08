<?php
/*
	Name: Separator
	Description: This element will generate a separator line
	Class: ZnSeparator
	Category: Content, Fullwidth
	Level: 3
*/

class ZnSeparator extends ZnElements {

	function options() {

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array(
						'id'          => 'top_margin',
						'name'        => 'Top margin',
						'description' => 'Select the top margin (in pixels).',
						'type'        => 'slider',
						'std'		  => '0',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '500',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'margin-top',
							'unit'		=> 'px'
						)
					),
					array(
						'id'          => 'bottom_margin',
						'name'        => 'Bottom margin',
						'description' => 'Select the bottom margin (in pixels).',
						'type'        => 'slider',
						'std'		  => '35',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '500',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'margin-bottom',
							'unit'		=> 'px'
						)
					),
	                array(
						'id'          => 'color',
						'name'        => 'Separator color',
						'description' => 'Select the color for separator line.',
						'type'        => 'colorpicker',
						'std'		  => '', // zget_option( 'default_text_color' , 'style_options' ),
	                    'live' => array(
	                        'type'		=> 'css',
	                        'css_class' => '.'.$this->data['uid'],
	                        'css_rule'	=> 'border-top-color',
	                        'unit'		=> ''
	                    )
					),
	                array(
						'id'          => 'height',
						'name'        => 'Separator height',
						'description' => 'Select the separator line height (in pixels).',
						'type'        => 'slider',
						'std'		  => '1',
						'class'		  => 'zn_full',
						'helpers'	  => array(
							'min' => '0',
							'max' => '15',
							'step' => '1'
						),
						'live' => array(
							'type'		=> 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'	=> 'border-top-width',
							'unit'		=> 'px'
						)
					),
				),
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#D_3o10kKikk',
				'copy'    => $uid,
				'general' => true,
			)),

		);

		return $options;

	}

	/**
	 * Output the element
	 * IMPORTANT : The UID needs to be set on the top parent container
	 */
	function element() {
		?>
			<div class="zn_separator clearfix <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>"></div>
		<?php
	}


	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		$tmargin = $this->opt('top_margin')  || $this->opt('top_margin') === '0' ? 'margin-top : '.$this->opt('top_margin').'px;' : '';
		$bmargin = $this->opt('bottom_margin') || $this->opt('bottom_margin') === '0' ? 'margin-bottom:'.$this->opt('bottom_margin').'px;' : 'margin-bottom:35px;';
		$height = $this->opt('height') || $this->opt('height') === '0' ? 'border-top-width:'.$this->opt('height').'px;' : 'border-top-width:1px;';
        $color = $this->opt('color') ? 'border-top-color:'.$this->opt('color').';' : 'border-top-color:transparent;';
		$uid = $this->data['uid'];

		$css = ".$uid {
				$tmargin
				$bmargin
                $height
                $color
		}";

		return $css;
	}

}

?>