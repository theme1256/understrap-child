<?php
class UnderStrapChild_Color_Scheme
{
	public $options = array(
		'header_background_color',
		'header_text_color',
		'link_color',
		'button_background_color',
		'button_hover_background_color',
		'section_dark_background_color',
		'footer_background_color',
		'footer_hero_background_color',
		'footer_text_color',
	);
	public function __construct()
	{
		add_action('customize_register', array($this, 'customizer_register'));
		add_action('customize_controls_enqueue_scripts', array($this, 'customize_js'));
		add_action('customize_controls_print_footer_scripts', array($this, 'color_scheme_template'));
		add_action('customize_preview_init', array($this, 'customize_preview_js'));
		add_action('wp_enqueue_scripts', array($this, 'output_css'));
	}

	public function customizer_register(WP_Customize_Manager $wp_customize)
	{
		$wp_customize->add_section('colors', array(
			'title' => __('Colors', 'ts-bootstrap'),
		));
		$wp_customize->add_setting('color_scheme', array(
			'default' => 'default',
			'transport' => 'postMessage',
		));
		$color_schemes = $this->get_color_schemes();
		$choices = array();
		foreach ($color_schemes as $color_scheme => $value) {
			$choices[$color_scheme] = $value['label'];
		}
		$wp_customize->add_control('color_scheme', array(
			'label'   => __('Color scheme', 'ts-bootstrap'),
			'section' => 'colors',
			'type'    => 'select',
			'choices' => $choices,
		));
		$options = array(
			'header_background_color' => __('Header background color', 'ts-bootstrap'),
			'header_text_color' => __('Header text color', 'ts-bootstrap'),
			'link_color' => __('Link color', 'ts-bootstrap'),
			'button_background_color' => __('Button background color', 'ts-bootstrap'),
			'button_hover_background_color' => __('Button hover background color', 'ts-bootstrap'),
			'section_dark_background_color' => __('Section dark background color', 'ts-bootstrap'),
			'footer_background_color' => __('Footer background color', 'ts-bootstrap'),
			'footer_hero_background_color' => __('Footer Hero background color', 'ts-bootstrap'),
			'footer_text_color' => __('Footer text color', 'ts-bootstrap'),
		);
		foreach ($options as $key => $label) {
			$wp_customize->add_setting($key, array(
				'sanitize_callback' => 'sanitize_hex_color',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $key, array(
				'label' => $label,
				'section' => 'colors',
			)));
		}
	}
	public function customize_js()
	{
		wp_enqueue_script('ts-bootstrap-color-scheme', get_stylesheet_directory_uri() . '/js/color-scheme.js', array('customize-controls', 'iris', 'underscore', 'wp-util'), '', true);
		wp_localize_script('ts-bootstrap-color-scheme', 'UnderStrapChildColorScheme', $this->get_color_schemes());
	}
	public function customize_preview_js()
	{
		wp_enqueue_script('induspress-color-scheme-preview', get_stylesheet_directory_uri() . '/js/color-scheme-preview.js', array('customize-preview'), '', true);
	}
	public function output_css()
	{
		$colors = $this->get_color_scheme();
		if ($this->is_custom) {
			wp_add_inline_style('style', $this->get_css($colors));
		}
	}
	public function get_css($colors)
	{
		$t = \array_keys($colors);
		$keys = [
			'header_background_color' => $t[0],
			'header_text_color' => $t[1],
			'link_color' => $t[2],
			'button_background_color' => $t[3],
			'button_hover_background_color' => $t[4],
			'section_dark_background_color' => $t[5],
			'footer_background_color' => $t[6],
			'footer_hero_background_color' => $t[7],
			'footer_text_color' => $t[8],
		];
		$css = '
		.navbar { background-color: '.$colors[$keys["header_background_color"]].'; }
		.widget_big_footer_menu_widget .nav-link,
		.widget_big_footer_menu_widget .nav-link:hover,
		.widget_big_footer_menu_widget .nav-link:hover .nav-link { color: '.$colors[$keys["link_color"]].'; }
		#wrapper-footer-hero { background-color: '.$colors[$keys["footer_hero_background_color"]].'; }
		#wrapper-footer-hero h2 { color: '.$colors[$keys["footer_text_color"]].'; }
		#wrapper-footer-full { background-color: '.$colors[$keys["footer_background_color"]].'; color: '.$colors[$keys["footer_text_color"]].'; }
		#wrapper-footer { background-color: '.$colors[$keys["footer_background_color"]].'; }
		#wrapper-footer a { color: '.$colors[$keys["footer_text_color"]].'; }
		.btn.btn-hero { background-color: '.$colors[$keys["button_background_color"]].'; border-color: '.$colors[$keys["button_background_color"]].'; }
		.btn.btn-hero:hover, .btn.btn-hero:focus { background-color: '.$colors[$keys["button_hover_background_color"]].'; border-color: '.$colors[$keys["button_hover_background_color"]].'; }
		h2, h3 { color: '.$colors[$keys["link_color"]].'; }
		.entry-content .wp-block-button__link { background-color: '.$colors[$keys["button_background_color"]].'; }
		.entry-content .wp-block-button__link:hover { background-color: '.$colors[$keys["button_hover_background_color"]].'; }
		';
		return $css;
	}
	public function color_scheme_template()
	{
		$colors = array(
			'header_background_color'		=> '{{ data.header_background_color }}',		// 1
			'header_text_color'				=> '{{ data.header_text_color }}',				// 2
			'link_color'					=> '{{ data.link_color }}',						// 3
			'button_background_color'		=> '{{ data.button_background_color }}',		// 4
			'button_hover_background_color'	=> '{{ data.button_hover_background_color }}',	// 5
			'section_dark_background_color'	=> '{{ data.section_dark_background_color }}',	// 6
			'footer_background_color'		=> '{{ data.footer_background_color }}',		// 7
			'footer_hero_background_color'	=> '{{ data.footer_hero_background_color }}',	// 8
			'footer_text_color'				=> '{{ data.footer_text_color }}',				// 9
		);
?>
		<script type="text/html" id="tmpl-ts-bootstrap-color-scheme">
			<?= $this->get_css($colors); ?>
		</script>
<?php
	}
	public function get_color_schemes()
	{
		return array(
			'default' => array(
				'label'  => __('TempusServa', 'ts-bootstrap'),
				'colors' => array(
					'#465676', // header_background_color
					'#fefefe', // header_text_color
					'#2aa09b', // link_color
					'#2AA09B', // button_background_color
					'#3EECE5', // button_hover_background_color
					'#FCFCFC', // section_dark_background_color
					'#ebebeb', // footer_background_color
					'#292D52', // footer_hero_background_color
					'#b5f44a', // footer_text_color
				),
			),
			'hundetraening' => array(
				'label'  => __('Hundetræning.nu', 'ts-bootstrap'),
				'colors' => array(
					'#dd8500',
					'#1d5d8e',
					'#dd8500',
					'#1d5d8e',
					'#00508e',
					'#aa6600',
					'#9d5f00',
					'#dd8500',
					'#dd8500',
				),
			),
			// Other color schemes
		);
	}
	public $is_custom = false;
	public function get_color_scheme()
	{
		$color_schemes = $this->get_color_schemes();
		$color_scheme  = get_theme_mod('color_scheme');
		$color_scheme  = isset($color_schemes[$color_scheme]) ? $color_scheme : 'default';

		if ('default' != $color_scheme) {
			$this->is_custom = true;
		}

		$colors = array_map('strtolower', $color_schemes[$color_scheme]['colors']);

		foreach ($this->options as $k => $option) {
			$color = get_theme_mod($option);
			if ($color && strtolower($color) != $colors[$k]) {
				$colors[$k] = $color;
				$this->is_custom = true;
			}
		}
		return $colors;
	}
}
?>