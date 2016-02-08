<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Simple Countdown
 Description: Create and display a Simple Countdown element
 Class: TH_Countdown
 Category: content
 Level: 3
*/

/**
 * Class TH_Countdown
 *
 * Create and display a Simple Countdown element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.9
 */
class TH_Countdown extends ZnElements
{
	public static function getName(){
		return __( "Simple Countdown", 'zn_framework' );
	}

	public function scripts(){
		if(! wp_script_is('jquery', 'enqueued')) {
			wp_enqueue_script('jquery');
		}
		if(! wp_script_is('zn_event_countdown', 'enqueued')) {
			wp_enqueue_script( 'zn_event_countdown',
				THEME_BASE_URI . '/js/jquery.countdown.js', array( 'jquery' ), ZN_FW_VERSION, true );
		}
	}


	public function css(){
		$uid = $this->data['uid'];
		$css = '';

		$top_padding = $this->opt('top_padding');
		if($top_padding != '0'){
			$tpadding = $top_padding || $top_padding === '0' ? 'padding-top : '.$top_padding.'px;' : '';
			$css .= '.'.$uid.'{'.$tpadding.'}';
		}

		$bottom_padding = $this->opt('bottom_padding');
		if($bottom_padding != '20'){
			$bpadding = $bottom_padding || $bottom_padding === '0' ? 'padding-bottom:'.$bottom_padding.'px;' : '';
			$css .= '.'.$uid.'{'.$bpadding.'}';
		}

		$bgColor = $this->opt('background_color', '');
		if(! empty($bgColor)){
			$css .= ".{$uid} .th-counter li { background-color: $bgColor !important; }";
		}

		$fgColor = $this->opt('text_color', '');
		if(! empty($fgColor)){
			$css .= ".{$uid} .th-counter li { color: $fgColor !important; }";
		}


		return $css;
	}
	public function js()
	{
		// General Options
		$date = $this->opt( 'th_sc_date' );

		if(empty($date)){
			$date = array(
				'date' => date('Y-m-d'),
				'time' => '24:00',
			);
		}
		if(empty($date['date'])){
			$date['date'] = date('Y-m-d');
		}
		if(empty($date['time'])){
			$date['time'] = '24:00';
		}

		$str_date = strtotime(trim( $date['date']));
		$y = date('Y', $str_date);
		$mo = date('m', $str_date);
		$d = date('d', $str_date);
		$time = explode(':', $date['time']);
		$h = $time[0];
		$mi = $time[1];

		$years = __('years', 'zn_framework');
		$months = __('months', 'zn_framework');
		$weeks = __('weeks', 'zn_framework');
		$days = __('days', 'zn_framework');
		$hours = __('hours', 'zn_framework');
		$min = __('min', 'zn_framework');
		$sec = __('sec', 'zn_framework');

		$selector = '#'.$this->data['uid'].' .th-counter';

		$js = <<<JS_SCRIPT
var th_counterOptions = {
	layout: function ()
	{
		return '<li class="kl-counter-li">{dn}<span class="kl-counter-unit">{dl}</span></li>' +
			'<li class="kl-counter-li">{hn}<span class="kl-counter-unit">{hl}</span></li>' +
			'<li class="kl-counter-li">{mn}<span class="kl-counter-unit">{ml}</span></li>' +
			'<li class="kl-counter-li">{sn}<span class="kl-counter-unit">{sl}</span></li>';
	}
};

var years  = "{$years}",
	months = "{$months}",
	weeks  = "{$weeks}",
	days   = "{$days}",
	hours  = "{$hours}",
	min    = "{$min}",
	sec    = "{$sec}";

var y = {$y},
	mo = {$mo}-1,
	d = {$d},
	h = {$h},
	mi = {$mi},
	t = new Date(y, mo, d, h, mi, 0);

jQuery('{$selector}').countdown({
	until: t,
	layout: th_counterOptions.layout(),
	labels: [years, months, weeks, days, hours, min, sec],
	labels1: [years, months, weeks, days, hours, min, sec],
	format: 'DHMS'
});
JS_SCRIPT;

		return array( 'th_countdown'.$this->data['uid'] => $js );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$uid = $this->data['uid'];

		echo '<div id="'.$uid.'" class="ud_counter kl-counter kl-font-alt '.$uid.' '.$this->opt('css_class','').'">';
		?>
		<ul class="th-counter" class="kl-counter-list">
			<li class="kl-counter-li"><?php _e( '0', 'zn_framework' );?><span class="kl-counter-unit"><?php _e( 'day', 'zn_framework' );?></span></li>
			<li class="kl-counter-li"><?php _e( '00', 'zn_framework' );?><span class="kl-counter-unit"><?php _e( 'hours', 'zn_framework' );?></span></li>
			<li class="kl-counter-li"><?php _e( '00', 'zn_framework' );?><span class="kl-counter-unit"><?php _e( 'min', 'zn_framework' );?></span></li>
			<li class="kl-counter-li"><?php _e( '00', 'zn_framework' );?><span class="kl-counter-unit"><?php _e( 'sec', 'zn_framework' );?></span></li>
		</ul>
		<?php
		echo '</div>';
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => __('General', 'zn_framework'),
				'options' => array(
					array (
						"name"        => __( "Date", 'zn_framework' ),
						"description" => __( "Please specify the end date", 'zn_framework' ),
						"id"          => "th_sc_date",
						"std"         => date('Y-M-D'),
						"type"        => "date_picker",
					),
				)
			),
			'padding' => array(
				'title' => 'Padding options',
				'options' => array(

					array(
						'id'          => 'top_padding',
						'name'        => 'Top padding',
						'description' => 'Select the top padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '0',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '0',
							'max' => '400',
							'step' => '5'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'  => 'padding-top',
							'unit'      => 'px'
						)
					),
					array(
						'id'          => 'bottom_padding',
						'name'        => 'Bottom padding',
						'description' => 'Select the bottom padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '20',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '0',
							'max' => '400',
							'step' => '5'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$this->data['uid'],
							'css_rule'  => 'padding-bottom',
							'unit'      => 'px'
						)
					)
				)
			),

			'background' => array(
				'title' => __('Background & Styles Options', 'zn_framework'),
				'options' => array(
					array(
						'id'          => 'background_color',
						'name'        => 'Box color',
						'description' => 'Here you can specify the background color for the boxes.',
						'type'        => 'colorpicker',
						'std'         => '',
					),
					array(
						'id'          => 'text_color',
						'name'        => 'Text color',
						'description' => 'Here you can specify the text color for this element.',
						'type'        => 'colorpicker',
						'std'         => '',
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
				'video'   => 'http://support.hogash.com/kallyas-videos/#_ModlDp5ghI',
				'docs'    => 'http://support.hogash.com/documentation/text-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}