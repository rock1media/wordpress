<?php
/*
	Name: Anchor Point
	Description: This element will generate an empty element with an unique ID that can be used as an achor point
	Class: ZnAnchorPoint
	Category: content
	Level: 3

*/

	class ZnAnchorPoint extends ZnElements {

	function options() {

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						'id'          => 'id',
						'name'        => 'ID',
						'description' => 'Please enter an id for this anchor point. You can use this #id for an anchor href.',
						'std'         => $this->data['uid'],
						'type'        => 'text'
					),

				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#GAiAelvoOg4',
				'docs'    => 'http://support.hogash.com/documentation/anchor-point-element/',
				'copy'    => $uid,
				'general' => true,
			)),

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

		);

		return $options;

	}

	function element(){
		 $element_id = $this->opt('id') ? $this->opt('id') : $this->data['uid'];
			echo '<div id="'.esc_attr( $element_id ).'" class="zn_anchor_point '.$this->opt('css_class','').'"></div>';
	}


	function element_edit() {

		$element_id = $this->opt('id') ? $this->opt('id') : $this->data['uid'];
		echo '<div id="'.esc_attr( $element_id ).'" class="zn_anchor_point '.$this->opt('css_class','').'">'.$element_id.'</div>';

	}
	}

?>