<?php

class LupercaliaSettingsPage {

	private $options;

  
	public function __construct() {
	
		add_action( 'admin_menu', array( $this, 'lupercalia_add_menu') );
		add_action( 'admin_init', array( $this, 'lupercalia_page_init') );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_css' ) );

	}
	
/* ------------------------------------------------------------------------- */
/* Callback function to the admin_head
/* Load admin header
/* ------------------------------------------------------------------------- */
	
	function admin_css() {
		wp_enqueue_style('style', get_template_directory_uri().'/theme_options/styleadmin.css', false, '1.0', 'screen');
		wp_enqueue_script('script', get_template_directory_uri().'/theme_options/scriptadmin.js', array('jquery'), '', true);
		wp_enqueue_media();
	}	
	
/* ------------------------------------------------------------------------- /*
/* Callback function to the admin_menu
/* Display theme option menu
/* @params: page name, menu UI name, permission, slug, callback function 
/* ------------------------------------------------------------------------- */
	
	function lupercalia_add_menu() {
		add_theme_page('Lupercalia Theme', esc_html__('Theme Option', 'lupercalia'), 'edit_theme_options', 'lupercalia_options_page', array( $this, 'lupercalia_options_page'));
	}
	
/* ------------------------------------------------------------------------- */
/* Callback function to the add_theme_page
/* Display the theme options page
/* ------------------------------------------------------------------------- */ 
	
	function lupercalia_options_page() {
	
        $this->options = get_option( 'lupercalia_options' );
		
		if( $this->options['reset_to_default'] == 'yes' ) delete_option( "lupercalia_options");
		
		if (!get_option('lupercalia_options')) {
		
			$this->options = array (
				"reset_to_default" => 'no',
				"general_logo_field" => '',
				"general_breadcrumb_field" => 'no',
				"general_csscolor_field" => 'deeppink',
				"home_slider_field" => array (
					"home_slider_hide_field" => 'no',
					"home_slider_category_field" => 0,
					"home_slider_offset_field" => 0,
					"home_slider_numposts_field" => 5,
					"home_slider_visibleitems_field" => 1,
					"home_slider_mobileitems_field" => 1,
					"home_slider_autoplay_field" => 'true',
					"home_slider_random_field" => 'ASC',
				),
				"frontpage_slider_field" => array (
					"frontpage_slider_hide_field" => 'no',
					"frontpage_slider_category_field" => 0,
					"frontpage_slider_offset_field" => 0,
					"frontpage_slider_numposts_field" => 5,
					"frontpage_slider_visibleitems_field" => 3,
					"frontpage_slider_mobileitems_field" => 2,
					"frontpage_slider_autoplay_field" => 'false',
					"frontpage_slider_random_field" => 'ASC',
				),
				"relatedposts_slider_field" => array (
					"relatedposts_slider_hide_field" => 'no',
					"relatedposts_slider_numposts_field" => 5,
					"relatedposts_slider_visibleitems_field" => 3,
					"relatedposts_slider_mobileitems_field" => 2,
					"relatedposts_slider_autoplay_field" => 'false',
					"relatedposts_slider_random_field" => 'rand',
				),				
				"sidebar_home_field" => 'right',
				"sidebar_single_field" => 'right',
				"sidebar_page_field" => 'right',
				"sidebar_search_field" => 'right',
				"sidebar_archive_field" => 'right',
				"contact_facebook_field" => '',
				"contact_flickr_field" => '',
				"contact_googleplus_field" => '',
				"contact_instagram_field" => '',
				"contact_linkedin_field" => '',
				"contact_pinterest_field" => '',
				"contact_twitter_field" => '',
				"contact_vimeo_field" => '',
				"contact_youtube_field" => '',
				"frontpage_branding_field" => array (
					"slider_image" => array(
						0 => get_template_directory_uri().'/imgs/slider-sample.png', 
						1 => get_template_directory_uri().'/imgs/slider-sample.png', 
						2 => get_template_directory_uri().'/imgs/slider-sample.png',
					),
					"slider_title" =>  array(
						0 => 'Slider 0 Title', 
						1 => 'Slider 1 Title', 
						2 => 'Slider 2 Title',
					),
					"slider_desc" => array(
						0 => 'Slider 0 Description', 
						1 => 'Slider 1 Description', 
						2 => 'Slider 2 Description',
					),
				
				),
				
			);
		}
		
        ?>
        <div class="wrap lupercaliaadmin">
			
            <?php echo '<h2>' . __('Lupercalia Settings', 'lupercalia') . '</h2>'; ?>
			
			<div class="update-nag">
				
				<form style="float:right; margin:8px 0 0 8px;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="4ZJGBSXVS93Y4">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
				</form>
				
				<p style="float:left;"><?php _e('If you appreciated my work and want to give any contribution, just link on the button.', 'lupercalia'); ?></p>
	
			</div> <!-- .update-nag -->
			
            <form method="post" action="options.php">
		
            <?php
                settings_fields( 'lupercalia_sidebar_group' );   
                do_settings_sections( 'lupercalia_options_page' );				
				submit_button(); 
            ?>		
			
			<input type="checkbox" name="lupercalia_options[reset_to_default]" value="yes" /> <?php esc_html_e('Reset to Default?', 'lupercalia'); ?>
			
        </div> <!-- .wrap .lupercaliaadmin -->
        <?php		
	}

/* ------------------------------------------------------------------------- */		
/* REGISTER SETTINGS, SECTIONS & FIELDS
/* ------------------------------------------------------------------------- */	

	function lupercalia_page_init() {

		/* GENERAL SETTINGS GROUP
		/* ------------------------------------------------------------------------- */		

		register_setting ('lupercalia_general_group', 'lupercalia_options', array( $this, 'lupercalia_sanitize'));
		
		add_settings_section ('lupercalia_general_section', esc_html__('General Settings', 'lupercalia'), array ( $this, 'lupercalia_general_section_callback'), 'lupercalia_options_page');
		
		add_settings_field('general_logo_field', esc_html__('Logo URL', 'lupercalia'), array( $this, 'general_logo_field_callback'), 'lupercalia_options_page', 'lupercalia_general_section');
		
		add_settings_field('general_breadcrumb_field', esc_html__('Breadcumb', 'lupercalia'), array( $this, 'general_breadcrumb_field_callback' ), 'lupercalia_options_page', 'lupercalia_general_section');
		
		add_settings_field('general_csscolor_field', esc_html__('Color Scheme', 'lupercalia'), array( $this, 'general_csscolor_field_callback' ), 'lupercalia_options_page', 'lupercalia_general_section');
		
		add_settings_field('blog_slider_field', esc_html__('Blog featured slider', 'lupercalia'), array( $this, 'blog_slider_field_callback' ), 'lupercalia_options_page', 'lupercalia_general_section');
		
		/* FRONT PAGE SETTINGS GROUP
		/* ------------------------------------------------------------------------- */
		
		register_setting ('lupercalia_frontpage_group', 'lupercalia_options', array ( $this, 'lupercalia_sanitize'));
		
		add_settings_section ('lupercalia_frontpage_section', esc_html__('Front Page Settings', 'lupercalia'), array ( $this, 'lupercalia_frontpage_section_callback'), 'lupercalia_options_page');
		
		add_settings_field('frontpage_slider_field', esc_html__('Bottom Slider Section', 'lupercalia'), array ( $this, 'frontpage_slider_field_callback' ), 'lupercalia_options_page', 'lupercalia_frontpage_section' );
		
		add_settings_field('frontpage_branding_field', esc_html__('Front Page Branding Slider', 'lupercalia'), array ( $this, 'frontpage_branding_field_callback' ), 'lupercalia_options_page', 'lupercalia_frontpage_section' );
		
		/* BLOG SINGLE PAGE SETTINGS GROUP
		/* ------------------------------------------------------------------------- */
		
		register_setting ('lupercalia_single_blog_group', 'lupercalia_options', array ( $this, 'lupercalia_sanitize' ));
		
		add_settings_section ('lupercalia_single_blog_section', esc_html__('Single blog page settings', 'lupercalia'), array ( $this, 'lupercalia_single_blog_section_callback' ), 'lupercalia_options_page' );
		
		add_settings_field('relatedposts_slider_field', esc_html__('Related Posts', 'lupercalia'), array ( $this, 'relatedposts_slider_field_callback' ), 'lupercalia_options_page', 'lupercalia_single_blog_section' );		
		
		// SIDEBAR SETTINGS GROUP
		/* ------------------------------------------------------------------------- */
		
		register_setting ('lupercalia_sidebar_group', 'lupercalia_options', array( $this, 'lupercalia_sanitize'));
		
		add_settings_section ('lupercalia_sidebar_section', esc_html__('Sidebar Settings', 'lupercalia'), array( $this, 'lupercalia_sidebar_section_callback'), 'lupercalia_options_page' );
		
		add_settings_field ('sidebar_home_field', esc_html__('Sidebar home page position', 'lupercalia'), array ( $this, 'sidebar_home_field_callback'), 'lupercalia_options_page', 'lupercalia_sidebar_section');
		
		add_settings_field ('sidebar_single_field', esc_html__('Sidebar posts position', 'lupercalia'), array ( $this, 'sidebar_single_field_callback'), 'lupercalia_options_page', 'lupercalia_sidebar_section');
		
		add_settings_field ('sidebar_page_field', esc_html__('Sidebar pages position', 'lupercalia'), array ( $this, 'sidebar_page_field_callback'), 'lupercalia_options_page', 'lupercalia_sidebar_section');
		
		add_settings_field ('sidebar_search_field', esc_html__('Sidebar search position', 'lupercalia'), array( $this, 'sidebar_search_field_callback'), 'lupercalia_options_page', 'lupercalia_sidebar_section');
		
		add_settings_field ('sidebar_archive_field', esc_html__('Sidebar archive position', 'lupercalia'), array( $this, 'sidebar_archive_field_callback' ), 'lupercalia_options_page', 'lupercalia_sidebar_section');

		// CONTACT SETTINGS GROUP
		/* ------------------------------------------------------------------------- */
		
		register_setting ('lupercalia_contact_group', 'lupercalia_options', array( $this, 'lupercalia_sanitize'));
		
		add_settings_section ('lupercalia_contact_section', esc_html__('Contact Settings', 'lupercalia'), array( $this, 'lupercalia_contact_section_callback'), 'lupercalia_options_page' );
		
		add_settings_field ('contact_facebook_field', esc_html__('Facebook URL', 'lupercalia'), array( $this, 'contact_facebook_field_callback' ), 'lupercalia_options_page', 'lupercalia_contact_section');
		
		add_settings_field ('contact_flickr_field', esc_html__('Flickr URL', 'lupercalia'), array( $this, 'contact_flickr_field_callback' ), 'lupercalia_options_page', 'lupercalia_contact_section');
		
		add_settings_field ('contact_googleplus_field', esc_html__('Google Plus URL', 'lupercalia'), array( $this, 'contact_googleplus_field_callback' ), 'lupercalia_options_page', 'lupercalia_contact_section');
		
		add_settings_field ('contact_instagram_field', esc_html__('Instagram URL', 'lupercalia'), array( $this, 'contact_instagram_field_callback' ), 'lupercalia_options_page', 'lupercalia_contact_section');	
		
		add_settings_field ('contact_linkedin_field', esc_html__('Linkedin URL', 'lupercalia'), array( $this, 'contact_linkedin_field_callback' ), 'lupercalia_options_page', 'lupercalia_contact_section');
		
		add_settings_field ('contact_pinterest_field', esc_html__('Pinterest URL', 'lupercalia'), array( $this, 'contact_pinterest_field_callback' ), 'lupercalia_options_page', 'lupercalia_contact_section');
		
		add_settings_field ('contact_twitter_field', esc_html__('Twitter URL', 'lupercalia'), array( $this, 'contact_twitter_field_callback' ), 'lupercalia_options_page', 'lupercalia_contact_section');
		
		add_settings_field ('contact_vimeo_field', esc_html__('Vimeo URL', 'lupercalia'), array( $this, 'contact_vimeo_field_callback' ), 'lupercalia_options_page', 'lupercalia_contact_section');
		
		add_settings_field ('contact_youtube_field', esc_html__('YouTube URL', 'lupercalia'), array( $this, 'contact_youtube_field_callback' ), 'lupercalia_options_page', 'lupercalia_contact_section');
		
	}
	
/* ------------------------------------------------------------------------- */		
/* SANATIZE FIELDS
/* ------------------------------------------------------------------------- */	
	
   public function lupercalia_sanitize( $input ) {
   
        $new_input = array();
		
		$new_input['reset_to_default'] = $input['reset_to_default'];
		
		// GENERAL SETTINGS GROUP
		/* ------------------------------------------------------------------------- */
		
        $new_input['general_logo_field'] = esc_url_raw( $input['general_logo_field'] );	
		
        $new_input['general_breadcrumb_field'] = $input['general_breadcrumb_field'];
		
		$new_input['general_csscolor_field'] = $input['general_csscolor_field'];
		
        $new_input['home_slider_field']['home_slider_hide_field'] = $input['home_slider_field']['home_slider_hide_field'];

		$new_input['home_slider_field']['home_slider_category_field'] = ($input['home_slider_field']['home_slider_category_field']) ? absint( $input['home_slider_field']['home_slider_category_field'] ) : '';

		$new_input['home_slider_field']['home_slider_offset_field'] = absint($input['home_slider_field']['home_slider_offset_field']) ? $input['home_slider_field']['home_slider_offset_field'] : '0';
		
		$new_input['home_slider_field']['home_slider_numposts_field'] = absint($input['home_slider_field']['home_slider_numposts_field']) ? $input['home_slider_field']['home_slider_numposts_field'] : '5';
		
		$new_input['home_slider_field']['home_slider_visibleitems_field'] = absint($input['home_slider_field']['home_slider_visibleitems_field']) ? $input['home_slider_field']['home_slider_visibleitems_field'] : '1';

		$new_input['home_slider_field']['home_slider_mobileitems_field'] = absint($input['home_slider_field']['home_slider_mobileitems_field']) ? $input['home_slider_field']['home_slider_mobileitems_field'] : '1';	
		
		$new_input['home_slider_field']['home_slider_autoplay_field'] = ( $input['home_slider_field']['home_slider_autoplay_field'] ) ? $input['home_slider_field']['home_slider_autoplay_field'] : 'false';
		
		$new_input['home_slider_field']['home_slider_random_field'] = ( $input['home_slider_field']['home_slider_random_field'] ) ? $input['home_slider_field']['home_slider_random_field'] : 'ASC';
		
		
		// FRONT PAGE GROUP
		/* ------------------------------------------------------------------------- */
		
        $new_input['frontpage_slider_field']['frontpage_slider_hide_field'] = $input['frontpage_slider_field']['frontpage_slider_hide_field'];

		$new_input['frontpage_slider_field']['frontpage_slider_category_field'] = ($input['frontpage_slider_field']['frontpage_slider_category_field']) ? absint( $input['frontpage_slider_field']['frontpage_slider_category_field'] ) : '';

		$new_input['frontpage_slider_field']['frontpage_slider_offset_field'] = absint($input['frontpage_slider_field']['frontpage_slider_offset_field']) ? $input['frontpage_slider_field']['frontpage_slider_offset_field'] : '0';
		
		$new_input['frontpage_slider_field']['frontpage_slider_numposts_field'] = absint($input['frontpage_slider_field']['frontpage_slider_numposts_field']) ? $input['frontpage_slider_field']['frontpage_slider_numposts_field'] : '5';
		
		$new_input['frontpage_slider_field']['frontpage_slider_visibleitems_field'] = absint($input['frontpage_slider_field']['frontpage_slider_visibleitems_field']) ? $input['frontpage_slider_field']['frontpage_slider_visibleitems_field'] : '3';

		$new_input['frontpage_slider_field']['frontpage_slider_mobileitems_field'] = absint($input['frontpage_slider_field']['frontpage_slider_mobileitems_field']) ? $input['frontpage_slider_field']['frontpage_slider_mobileitems_field'] : '2';
		
		$new_input['frontpage_slider_field']['frontpage_slider_autoplay_field'] = ( $input['frontpage_slider_field']['frontpage_slider_autoplay_field'] ) ? $input['frontpage_slider_field']['frontpage_slider_autoplay_field'] : 'false';
		
		$new_input['frontpage_slider_field']['frontpage_slider_random_field'] = ( $input['frontpage_slider_field']['frontpage_slider_random_field'] ) ? $input['frontpage_slider_field']['frontpage_slider_random_field'] : 'ASC';
		
		/* SLIDER MULTIPLE FIELDS
		/* ------------------------------------------------------------------------- */
		
		foreach ( $input['frontpage_branding_field']['slider_image'] as $image ) :
		
			$new_input['frontpage_branding_field']['slider_image'][] = esc_url_raw($image); 
		
		endforeach;
		
		foreach ( $input['frontpage_branding_field']['slider_title'] as $title ) :
		
			$new_input['frontpage_branding_field']['slider_title'][] = $title; 
		
		endforeach;
		
		foreach ( $input['frontpage_branding_field']['slider_desc'] as $desc ) :
		
			$new_input['frontpage_branding_field']['slider_desc'][] = $desc; 
		
		endforeach;		

		/* SINGLE BLOG PAGE GROUP
		/* ------------------------------------------------------------------------- */

        $new_input['relatedposts_slider_field']['relatedposts_slider_hide_field'] = $input['relatedposts_slider_field']['relatedposts_slider_hide_field'];
		
		$new_input['relatedposts_slider_field']['relatedposts_slider_numposts_field'] = absint($input['relatedposts_slider_field']['relatedposts_slider_numposts_field']) ? $input['relatedposts_slider_field']['relatedposts_slider_numposts_field'] : '5';
		
		$new_input['relatedposts_slider_field']['relatedposts_slider_visibleitems_field'] = absint($input['relatedposts_slider_field']['relatedposts_slider_visibleitems_field']) ? $input['relatedposts_slider_field']['relatedposts_slider_visibleitems_field'] : '3';

		$new_input['relatedposts_slider_field']['relatedposts_slider_mobileitems_field'] = absint($input['relatedposts_slider_field']['relatedposts_slider_mobileitems_field']) ? $input['relatedposts_slider_field']['relatedposts_slider_mobileitems_field'] : '2';	
		
		$new_input['relatedposts_slider_field']['relatedposts_slider_autoplay_field'] = ( $input['relatedposts_slider_field']['relatedposts_slider_autoplay_field'] ) ? $input['relatedposts_slider_field']['relatedposts_slider_autoplay_field'] : 'false';
		
		$new_input['relatedposts_slider_field']['relatedposts_slider_random_field'] = ( $input['relatedposts_slider_field']['relatedposts_slider_random_field'] ) ? $input['relatedposts_slider_field']['relatedposts_slider_random_field'] : 'ASC';			

		/* SIDEBAR GROUP
		/* ------------------------------------------------------------------------- */	

        $new_input['sidebar_home_field'] = $input['sidebar_home_field'];

		$new_input['sidebar_single_field'] = $input['sidebar_single_field'];

		$new_input['sidebar_page_field'] = $input['sidebar_page_field'];

		$new_input['sidebar_search_field'] = $input['sidebar_search_field'];
		
		$new_input['sidebar_archive_field'] = $input['sidebar_archive_field'];

		/* CONTACT GROUP
		/* ------------------------------------------------------------------------- */
		
		$new_input['contact_facebook_field'] = ($input['contact_facebook_field']) ? esc_url_raw($input['contact_facebook_field']) : '';
		
		$new_input['contact_flickr_field'] = ($input['contact_flickr_field']) ? esc_url_raw($input['contact_flickr_field']) : '';

		$new_input['contact_googleplus_field'] = ($input['contact_googleplus_field']) ? esc_url_raw($input['contact_googleplus_field']) : '';

		$new_input['contact_instagram_field'] = ($input['contact_instagram_field']) ? esc_url_raw($input['contact_instagram_field']) : '';
		
		$new_input['contact_linkedin_field'] = ($input['contact_linkedin_field']) ? esc_url_raw($input['contact_linkedin_field']) : '';
		
		$new_input['contact_pinterest_field'] = ($input['contact_pinterest_field']) ? esc_url_raw($input['contact_pinterest_field']) : '';

		$new_input['contact_twitter_field'] = ($input['contact_twitter_field']) ? esc_url_raw($input['contact_twitter_field']) : '';
		
		$new_input['contact_vimeo_field'] = ($input['contact_vimeo_field']) ? esc_url_raw($input['contact_vimeo_field']) : '';	
		
		$new_input['contact_youtube_field'] = ($input['contact_youtube_field']) ? esc_url_raw($input['contact_youtube_field']) : '';
        
		return $new_input;
		
    }	

/* ------------------------------------------------------------------------- */		
/* GROUP FIELDS CALLBACKS: GENERAL SETTINGS
/* ------------------------------------------------------------------------- */	
	
	function lupercalia_general_section_callback() {
		echo "<p class='description'>" . esc_html__('Manage your general settings.', 'lupercalia') . "</p>"; 
	}
	
	function general_logo_field_callback() {

        printf(
            '<input type="text" name="lupercalia_options[general_logo_field]" size="80" class="logo_image" value="%s" placeholder="Click on Upload Logo button to upload your logo" />',
            isset( $this->options['general_logo_field'] ) ? stripslashes(( $this->options['general_logo_field'])) : ''
        );	
	?>
		<input type="submit" class="image_button button" value="<?php esc_attr_e('Upload Logo', 'lupercalia'); ?>" />
	<?php
	}
	
	function general_breadcrumb_field_callback() { ?>
	
		<input name="lupercalia_options[general_breadcrumb_field]" type="checkbox" value="yes" <?php checked('yes', $this->options['general_breadcrumb_field']); ?> />
		<?php esc_html_e('Hide', 'lupercalia'); ?>
	
	<?php } 
	
	function general_csscolor_field_callback() { ?>
	
		<select name="lupercalia_options[general_csscolor_field]" id="lupercalia_options[general_csscolor_field]">
			<option class="level-0" value="cadetblue" <?php selected($this->options['general_csscolor_field'], 'cadetblue' ); ?>>Cadet Blue</option>
			<option class="level-0" value="cornflowerblue" <?php selected($this->options['general_csscolor_field'], 'cornflowerblue' ); ?>>Cornflower Blue</option>
			<option class="level-0" value="crimson" <?php selected($this->options['general_csscolor_field'], 'crimson' ); ?>>Crimson</option>
			<option class="level-0" value="darkcyan" <?php selected($this->options['general_csscolor_field'], 'darkcyan' ); ?>>Dark Cyan</option>
			<option class="level-0" value="darkviolet" <?php selected($this->options['general_csscolor_field'], 'darkviolet' ); ?>>Dark Violet</option>
			<option class="level-0" value="deeppink" <?php selected($this->options['general_csscolor_field'], 'deeppink' ); ?>>Deep Pink</option>
			<option class="level-0" value="forestgreen" <?php selected($this->options['general_csscolor_field'], 'forestgreen' ); ?>>Forest Green</option>
			<option class="level-0" value="goldenrod" <?php selected($this->options['general_csscolor_field'], 'goldenrod' ); ?>>Golden Rod</option>
			<option class="level-0" value="olivedrab" <?php selected($this->options['general_csscolor_field'], 'olivedrab' ); ?>>Olive Drab</option>
			<option class="level-0" value="orangered" <?php selected($this->options['general_csscolor_field'], 'orangered' ); ?>>Orange Red</option>
			<option class="level-0" value="orchid" <?php selected($this->options['general_csscolor_field'], 'orchid' ); ?>>Orchid</option>
			<option class="level-0" value="turquoise" <?php selected($this->options['general_csscolor_field'], 'turquoise'  ); ?>>Turquoise</option>
			<option class="level-0" value="yellowgreen" <?php selected($this->options['general_csscolor_field'], 'yellowgreen'  ); ?>>Yellow Green</option>
		</select> 
	
	<?php } 	
	
	function blog_slider_field_callback() { ?>
	
	<table class="table-inner">
	
		<tr>
			<td>
				<input type="checkbox" name="lupercalia_options[home_slider_field][home_slider_hide_field]" value="yes" <?php checked('yes', $this->options['home_slider_field']['home_slider_hide_field'] ); ?> /> 
				<?php esc_html_e('Hide it', 'lupercalia'); ?>
			</td>
			
			<td>
				<?php esc_html_e('Enable/Disable featured posts from blog page.', 'lupercalia'); ?>
			</td>	
		</tr>
		
		<tr>
			<td>
				<?php wp_dropdown_categories('show_option_all='.esc_html__('All categories', 'lupercalia').'&hierarchical=1&orderby=name&selected='.$this->options['home_slider_field']['home_slider_category_field'].'&name='.'lupercalia_options[home_slider_field][home_slider_category_field]'.'&class=widefat'); ?>			
			</td>
			
			<td>
				<?php esc_html_e('Choose which category will be displayed.', 'lupercalia'); ?>
			</td>			
		</tr>		
		
		<tr>			
			<td>			
				<?php printf(
					'<input type="text" name="lupercalia_options[home_slider_field][home_slider_offset_field]" size="1" maxlength="1" value="%s" />',
					isset( $this->options['home_slider_field']['home_slider_offset_field'] ) ? esc_attr( $this->options['home_slider_field']['home_slider_offset_field'] ) : ''
				); ?>
				<?php esc_html_e('Post(s) offset', 'lupercalia'); ?>
			</td>
			
			<td>
				<?php esc_html_e('Choose how many posts should be skipped.', 'lupercalia'); ?>
			</td>	
		</tr>
		
		<tr>
			<td>
				<select name="lupercalia_options[home_slider_field][home_slider_numposts_field]" id="lupercalia_options[home_slider_field][home_slider_numposts_field]">
					<option class="level-0" value="1" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 1 ); ?>>1</option>
					<option class="level-0" value="2" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 2 ); ?>>2</option>
					<option class="level-0" value="3" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 3 ); ?>>3</option>
					<option class="level-0" value="4" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 4 ); ?>>4</option>
					<option class="level-0" value="5" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 5 ); ?>>5</option>
					<option class="level-0" value="6" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 6 ); ?>>6</option>
					<option class="level-0" value="7" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 7 ); ?>>7</option>
					<option class="level-0" value="8" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 8 ); ?>>8</option>
					<option class="level-0" value="9" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 9 ); ?>>9</option>
					<option class="level-0" value="10" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 10 ); ?>>10</option>
					<option class="level-0" value="11" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 11 ); ?>>11</option>
					<option class="level-0" value="12" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 12 ); ?>>12</option>
					<option class="level-0" value="13" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 13 ); ?>>13</option>
					<option class="level-0" value="14" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 14 ); ?>>14</option>
					<option class="level-0" value="15" <?php selected($this->options['home_slider_field']['home_slider_numposts_field'], 15 ); ?>>15</option>
				</select> <?php esc_html_e('Total of posts', 'lupercalia');	?>
			</td>
			
			<td>
				<?php esc_html_e('No. total of post to be displayed.', 'lupercalia'); ?>
			</td>
		</tr>
		
		<tr>			
			<td>
				<?php printf(
					'<input type="text" name="lupercalia_options[home_slider_field][home_slider_visibleitems_field]" size="1" maxlength="1" value="%s" />',
					isset( $this->options['home_slider_field']['home_slider_visibleitems_field'] ) ? esc_attr( $this->options['home_slider_field']['home_slider_visibleitems_field'] ) : ''
				); ?>
				<?php esc_html_e('Computer Visible item', 'lupercalia'); ?>
			</td>
			
			<td>
				<?php esc_html_e('Pick a number of how many posts will be display by page (computer mode).', 'lupercalia'); ?>
			</td>			
		</tr>
		
		<tr>			
			<td>
				<?php printf(
					'<input type="text" name="lupercalia_options[home_slider_field][home_slider_mobileitems_field]" size="1" maxlength="1" value="%s" />',
					isset( $this->options['home_slider_field']['home_slider_mobileitems_field'] ) ? esc_attr( $this->options['home_slider_field']['home_slider_mobileitems_field'] ) : ''
				); ?>			
				<?php esc_html_e('Mobile visible item', 'lupercalia'); ?>
			</td>
			
			<td>
				<?php esc_html_e('Pick a number of how many posts will be display by page (mobile mode).', 'lupercalia'); ?>
			</td>
		</tr>
		
		<tr>
			<td>
				<input type="checkbox" name="lupercalia_options[home_slider_field][home_slider_autoplay_field]" value="true" <?php checked('true', $this->options['home_slider_field']['home_slider_autoplay_field'] ); ?> /> 
				<?php esc_html_e('Auto play', 'lupercalia'); ?>	
			</td>
			
			<td>
				<?php esc_html_e('Enable/Disable slider auto-play.', 'lupercalia'); ?>
			</td>			
		</tr>
		
		<tr>
			<td>
				<input type="checkbox" name="lupercalia_options[home_slider_field][home_slider_random_field]" value="rand" <?php checked('rand', $this->options['home_slider_field']['home_slider_random_field'] ); ?> /> 
				<?php esc_html_e('Random Mode', 'lupercalia'); ?>
			</td>
			
			<td>
				<?php esc_html_e('Enable/Disable random featured posts.', 'lupercalia'); ?>
			</td>			
		</tr>
		
	</table>		
	
	<?php }
	
/* ------------------------------------------------------------------------- */		
/* GROUP FIELDS CALLBACKS: FRONT PAGE
/* ------------------------------------------------------------------------- */	
	
	function lupercalia_frontpage_section_callback() {
		echo "<p class='description'>" . esc_html__('Manage your front page settings.', 'lupercalia') . "</p>"; 
	}
	
	function frontpage_slider_field_callback () { ?>
	
	<table class="table-inner">
	
		<tr>
			<td>
				<input type="checkbox" name="lupercalia_options[frontpage_slider_field][frontpage_slider_hide_field]" value="yes" <?php checked('yes', $this->options['frontpage_slider_field']['frontpage_slider_hide_field'] ); ?> /> 
				<?php esc_html_e('Hide it', 'lupercalia'); ?>
			</td>
			
			<td>
				<?php esc_html_e('Enable/Disable featured posts from Front Page Bottom Section.', 'lupercalia'); ?>
			</td>	
		</tr>
		
		<tr>
			<td>
				<?php wp_dropdown_categories('show_option_all='.esc_html__('All categories', 'lupercalia').'&hierarchical=1&orderby=name&selected='.$this->options['frontpage_slider_field']['frontpage_slider_category_field'].'&name='.'lupercalia_options[frontpage_slider_field][frontpage_slider_category_field]'.'&class=widefat'); ?>			
			</td>
			
			<td>
				<?php esc_html_e('Choose which category will be displayed.', 'lupercalia'); ?>
			</td>
		</tr>		
		
		<tr>			
			<td>
				<?php printf(
					'<input type="text" name="lupercalia_options[frontpage_slider_field][frontpage_slider_offset_field]" size="1" maxlength="1" value="%s" />',
					isset( $this->options['frontpage_slider_field']['frontpage_slider_offset_field'] ) ? esc_attr( $this->options['frontpage_slider_field']['frontpage_slider_offset_field'] ) : ''
				); ?>
				<?php esc_html_e('Post(s) offset', 'lupercalia'); ?>
			</td>
			
			<td>
				<?php esc_html_e('Choose how many posts should be skipped.', 'lupercalia'); ?>
			</td>
		</tr>
		
		<tr>
			<td>
				<select name="lupercalia_options[frontpage_slider_field][frontpage_slider_numposts_field]" id="lupercalia_options[frontpage_slider_field][frontpage_slider_numposts_field]">
					<option class="level-0" value="1" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 1 ); ?>>1</option>
					<option class="level-0" value="2" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 2 ); ?>>2</option>
					<option class="level-0" value="3" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 3 ); ?>>3</option>
					<option class="level-0" value="4" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 4 ); ?>>4</option>
					<option class="level-0" value="5" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 5 ); ?>>5</option>
					<option class="level-0" value="6" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 6 ); ?>>6</option>
					<option class="level-0" value="7" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 7 ); ?>>7</option>
					<option class="level-0" value="8" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 8 ); ?>>8</option>
					<option class="level-0" value="9" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 9 ); ?>>9</option>
					<option class="level-0" value="10" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 10 ); ?>>10</option>
					<option class="level-0" value="11" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 11 ); ?>>11</option>
					<option class="level-0" value="12" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 12 ); ?>>12</option>
					<option class="level-0" value="13" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 13 ); ?>>13</option>
					<option class="level-0" value="14" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 14 ); ?>>14</option>
					<option class="level-0" value="15" <?php selected($this->options['frontpage_slider_field']['frontpage_slider_numposts_field'], 15 ); ?>>15</option>
				</select> <?php esc_html_e('Total of posts', 'lupercalia');	?>
			</td>
			
			<td>
				<?php esc_html_e('No. total of post to be displayed.', 'lupercalia'); ?>
			</td>
		</tr>			

		<tr>			
			<td>
				<?php printf(
					'<input type="text" name="lupercalia_options[frontpage_slider_field][frontpage_slider_visibleitems_field]" size="1" maxlength="1" value="%s" />',
					isset( $this->options['frontpage_slider_field']['frontpage_slider_visibleitems_field'] ) ? esc_attr( $this->options['frontpage_slider_field']['frontpage_slider_visibleitems_field'] ) : ''
				); ?>
				<?php esc_html_e('Computer Visible item', 'lupercalia'); ?>
			</td>
			
			<td>
				<?php esc_html_e('Pick a number of how many posts will be display by page (computer mode).', 'lupercalia'); ?>
			</td>			
		</tr>
		
		<tr>			
			<td>
				<?php printf(
					'<input type="text" name="lupercalia_options[frontpage_slider_field][frontpage_slider_mobileitems_field]" size="1" maxlength="1" value="%s" />',
					isset( $this->options['frontpage_slider_field']['frontpage_slider_mobileitems_field'] ) ? esc_attr( $this->options['frontpage_slider_field']['frontpage_slider_mobileitems_field'] ) : ''
				); ?>			
				<?php esc_html_e('Mobile visible item', 'lupercalia'); ?>
			</td>
			
			<td>
				<?php esc_html_e('Pick a number of how many posts will be display by page (mobile mode).', 'lupercalia'); ?>
			</td>
		</tr>
		
		<tr>
			<td>
				<input type="checkbox" name="lupercalia_options[frontpage_slider_field][frontpage_slider_autoplay_field]" value="true" <?php checked('true', $this->options['frontpage_slider_field']['frontpage_slider_autoplay_field'] ); ?> /> 
				<?php esc_html_e('Auto play', 'lupercalia'); ?>	
			</td>
			
			<td>
				<?php esc_html_e('Enable/Disable slider auto-play.', 'lupercalia'); ?>
			</td>			
		</tr>
		
		<tr>
			<td>
				<input type="checkbox" name="lupercalia_options[frontpage_slider_field][frontpage_slider_random_field]" value="rand" <?php checked('rand', $this->options['frontpage_slider_field']['frontpage_slider_random_field'] ); ?> /> 
				<?php esc_html_e('Random Mode', 'lupercalia'); ?>
			</td>
			
			<td>
				<?php esc_html_e('Enable/Disable random featured posts.', 'lupercalia'); ?>
			</td>			
		</tr>
	</table>
	
	<?php }
	
	
	function frontpage_branding_field_callback() { ?>
	
		<a href="#" id="addScnt"><?php esc_html_e('Add Slider Item', 'lupercalia'); ?></a>

		<div id="p_scents">
		
		<?php $arrayimg = count($this->options['frontpage_branding_field']['slider_image']); ?>
		
		<?php for ($i = 0; $i < $arrayimg; $i++) : ?>
		
			<p>
				<label for="p_scnts"><input type="text" id="p_scnt" size="80" name="lupercalia_options[frontpage_branding_field][slider_image][<?php echo $i ?>]" value="<?php echo $this->options['frontpage_branding_field']['slider_image'][$i] ?>" placeholder="Input Value" class="slider_image_<?php echo $i ?>" /> <input type="submit" class="button sliderbutton" id="<?php echo $i ?>" value="<?php esc_attr_e('Upload Image', 'lupercalia'); ?>" /></label>
			
			<br />
			
				<label for="p_scnts"><input type="text" id="p_scnt" size="80" name="lupercalia_options[frontpage_branding_field][slider_title][<?php echo $i ?>]" value="<?php echo $this->options['frontpage_branding_field']['slider_title'][$i] ?>" placeholder="Input Value" /></label>
				
			<br />
			
				<label for="p_scnts"><input type="text" id="p_scnt" size="80" name="lupercalia_options[frontpage_branding_field][slider_desc][<?php echo $i ?>]" value="<?php echo $this->options['frontpage_branding_field']['slider_desc'][$i] ?>" placeholder="Input Value" /></label> <a href="#" id="remScnt"><?php esc_html_e('Remove item', 'lupercalia'); ?></a>
			</p>		
		
		<?php endfor; ?>
		
	</div>
	
	<?php }
	
/* ------------------------------------------------------------------------- */		
/* GROUP FIELDS CALLBACKS: SINGLE BLOG PAGE
/* ------------------------------------------------------------------------- */	

	function lupercalia_single_blog_section_callback() {
		echo "<p class='description'>" . esc_html__('Manage your single blog page settings.', 'lupercalia') . "</p>"; 
	}
	
	function relatedposts_slider_field_callback () { ?>
	
		<table class="table-inner">
			<tr>
				<td>
					<input type="checkbox" name="lupercalia_options[relatedposts_slider_field][relatedposts_slider_hide_field]" value="yes" <?php checked('yes', $this->options['relatedposts_slider_field']['relatedposts_slider_hide_field'] ); ?> /> 
					<?php esc_html_e('Hide it', 'lupercalia'); ?>
				</td>
				
				<td>
					<?php esc_html_e('Enable/Disable featured posts from Front Page Bottom Section.', 'lupercalia'); ?>
				</td>
			</tr>
			
			<tr>
				<td>
					<select name="lupercalia_options[relatedposts_slider_field][relatedposts_slider_numposts_field]" id="lupercalia_options[relatedposts_slider_field][relatedposts_slider_numposts_field]">
						<option class="level-0" value="1" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 1 ); ?>>1</option>
						<option class="level-0" value="2" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 2 ); ?>>2</option>
						<option class="level-0" value="3" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 3 ); ?>>3</option>
						<option class="level-0" value="4" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 4 ); ?>>4</option>
						<option class="level-0" value="5" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 5 ); ?>>5</option>
						<option class="level-0" value="6" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 6 ); ?>>6</option>
						<option class="level-0" value="7" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 7 ); ?>>7</option>
						<option class="level-0" value="8" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 8 ); ?>>8</option>
						<option class="level-0" value="9" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 9 ); ?>>9</option>
						<option class="level-0" value="10" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 10 ); ?>>10</option>
						<option class="level-0" value="11" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 11 ); ?>>11</option>
						<option class="level-0" value="12" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 12 ); ?>>12</option>
						<option class="level-0" value="13" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 13 ); ?>>13</option>
						<option class="level-0" value="14" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 14 ); ?>>14</option>
						<option class="level-0" value="15" <?php selected($this->options['relatedposts_slider_field']['relatedposts_slider_numposts_field'], 15 ); ?>>15</option>
					</select> <?php esc_html_e('Total of posts', 'lupercalia');	?>
				</td>
				
				<td>
					<?php esc_html_e('No. total of post to be displayed.', 'lupercalia'); ?>
				</td>
			</tr>			
			
			<tr>			
				<td>
					<?php printf(
						'<input type="text" name="lupercalia_options[relatedposts_slider_field][relatedposts_slider_visibleitems_field]" size="1" maxlength="1" value="%s" />',
						isset( $this->options['relatedposts_slider_field']['relatedposts_slider_visibleitems_field'] ) ? esc_attr( $this->options['relatedposts_slider_field']['relatedposts_slider_visibleitems_field'] ) : ''
					); ?>
					<?php esc_html_e('Computer Visible item', 'lupercalia'); ?>
				</td>
				
				<td>
					<?php esc_html_e('Pick a number of how many posts will be display by page (computer mode).', 'lupercalia'); ?>
				</td>			
			</tr>
			
			<tr>			
				<td>
					<?php printf(
						'<input type="text" name="lupercalia_options[relatedposts_slider_field][relatedposts_slider_mobileitems_field]" size="1" maxlength="1" value="%s" />',
						isset( $this->options['relatedposts_slider_field']['relatedposts_slider_mobileitems_field'] ) ? esc_attr( $this->options['relatedposts_slider_field']['relatedposts_slider_mobileitems_field'] ) : ''
					); ?>			
					<?php esc_html_e('Mobile visible item', 'lupercalia'); ?>
				</td>
				
				<td>
					<?php esc_html_e('Pick a number of how many posts will be display by page (mobile mode).', 'lupercalia'); ?>
				</td>
			</tr>
			
			<tr>
				<td>
					<input type="checkbox" name="lupercalia_options[relatedposts_slider_field][relatedposts_slider_autoplay_field]" value="true" <?php checked('true', $this->options['relatedposts_slider_field']['relatedposts_slider_autoplay_field'] ); ?> /> 
					<?php esc_html_e('Auto play', 'lupercalia'); ?>	
				</td>
				
				<td>
					<?php esc_html_e('Enable/Disable slider auto-play.', 'lupercalia'); ?>
				</td>			
			</tr>
			
			<tr>
				<td>
					<input type="checkbox" name="lupercalia_options[relatedposts_slider_field][relatedposts_slider_random_field]" value="rand" <?php checked('rand', $this->options['relatedposts_slider_field']['relatedposts_slider_random_field'] ); ?> /> 
					<?php esc_html_e('Random Mode', 'lupercalia'); ?>
				</td>
				
				<td>
					<?php esc_html_e('Enable/Disable random featured posts.', 'lupercalia'); ?>
				</td>			
			</tr>
		</table>
	
	<?php }	

/* ------------------------------------------------------------------------- */		
/* GROUP FIELDS CALLBACKS: SIDEBARS
/* ------------------------------------------------------------------------- */	
	
	function lupercalia_sidebar_section_callback() {
		echo "<p class='description'>" . esc_html__('Manage your sidebars settings.', 'lupercalia') . "</p>"; 
	}
	
	function lupercalia_sidebar_show_options () {
	
		$sidebar_show_option = array(
			'yes' => array (
				'value' => 'left',
				'label' => __('Left', 'lupercalia')
			),
			'no' => array (
				'value' => 'right',
				'label' => __('Right', 'lupercalia')
			)
		);
		return $sidebar_show_option;	
	}
	
	function sidebar_home_field_callback() {
	
		foreach ($this->lupercalia_sidebar_show_options() as $radio) { ?>
		
			<input type="radio" name="lupercalia_options[sidebar_home_field]" value="<?php echo $radio['value']; ?>" <?php if (isset($this->options['sidebar_home_field']) and $this->options['sidebar_home_field'] == $radio['value']) echo 'checked="checked"'; ?> />			
		<?php echo " " . $radio['label'] . " " ;
		
		}
		
	}
	function sidebar_single_field_callback() {
		foreach ($this->lupercalia_sidebar_show_options() as $radio) { ?>
		
			<input type="radio" name="lupercalia_options[sidebar_single_field]" value="<?php echo $radio['value']; ?>" <?php if (isset($this->options['sidebar_single_field']) and $this->options['sidebar_single_field'] == $radio['value']) echo 'checked="checked"'; ?> />
		
		<?php echo " " . $radio['label'] . " ";
		
		}
	}
	
	function sidebar_page_field_callback() {
		foreach ($this->lupercalia_sidebar_show_options() as $radio) { ?>
		
			<input type="radio" name="lupercalia_options[sidebar_page_field]" value="<?php echo $radio['value']; ?>" <?php if (isset($this->options['sidebar_page_field']) and $this->options['sidebar_page_field'] == $radio['value']) echo 'checked="checked"'; ?> />
		
		<?php echo " " . $radio['label'] . " ";
		
		}
	}
	
	function sidebar_search_field_callback() {
		foreach ($this->lupercalia_sidebar_show_options() as $radio) { ?>
		
			<input type="radio" name="lupercalia_options[sidebar_search_field]" value="<?php echo $radio['value']; ?>" <?php if (isset($this->options['sidebar_search_field']) and $this->options['sidebar_search_field'] == $radio['value']) echo 'checked="checked"'; ?> />
		
		<?php echo " " . $radio['label'] . " ";
		
		}
	}
	
	function sidebar_archive_field_callback() {
		foreach ($this->lupercalia_sidebar_show_options() as $radio) { ?>
		
			<input type="radio" name="lupercalia_options[sidebar_archive_field]" value="<?php echo $radio['value']; ?>" <?php if (isset($this->options['sidebar_archive_field']) and $this->options['sidebar_archive_field'] == $radio['value']) echo 'checked="checked"'; ?> />
		<?php echo " " . $radio['label'] . " ";
		
		}	
	}

/* ------------------------------------------------------------------------- */		
/* GROUP FIELDS CALLBACKS: CONTACT
/* ------------------------------------------------------------------------- */	
	
	function lupercalia_contact_section_callback() {
		echo "<p class='description'>" . esc_html__('Manage your contacts settings.', 'lupercalia') . "</p>"; 
	}
	function contact_facebook_field_callback() {
        printf(
            '<input type="text" name="lupercalia_options[contact_facebook_field]" size="80" placeholder="www.facebook.com/username-or-page" value="%s" />',
            isset( $this->options['contact_facebook_field'] ) ? esc_attr( $this->options['contact_facebook_field']) : ''
        );		
	}
	function contact_flickr_field_callback() {
        printf(
            '<input type="text" name="lupercalia_options[contact_flickr_field]" size="80" placeholder="www.flickr.com/photos/username" value="%s" />',
            isset( $this->options['contact_flickr_field'] ) ? esc_attr( $this->options['contact_flickr_field']) : ''
        );		
	}
	function contact_googleplus_field_callback() {
        printf(
            '<input type="text" name="lupercalia_options[contact_googleplus_field]" size="80" placeholder="www.plus.google.com/user-number" value="%s" />',
            isset( $this->options['contact_googleplus_field'] ) ? esc_attr( $this->options['contact_googleplus_field']) : ''
        );		
	}
	function contact_instagram_field_callback() {
        printf(
            '<input type="text" name="lupercalia_options[contact_instagram_field]" size="80" placeholder="www.instagram.com/username" value="%s" />',
            isset( $this->options['contact_instagram_field'] ) ? esc_attr( $this->options['contact_instagram_field']) : ''
        );		
	}
	function contact_linkedin_field_callback() {
        printf(
            '<input type="text" name="lupercalia_options[contact_linkedin_field]" size="80" placeholder="www.linkedin.com/profile/view?id=id-number" value="%s" />',
            isset( $this->options['contact_linkedin_field'] ) ? esc_attr( $this->options['contact_linkedin_field']) : ''
        );		
	}	
	function contact_pinterest_field_callback() {
        printf(
            '<input type="text" name="lupercalia_options[contact_pinterest_field]" size="80" placeholder="www.pinterest.com/username" value="%s" />',
            isset( $this->options['contact_pinterest_field'] ) ? esc_attr( $this->options['contact_pinterest_field']) : ''
        );		
	}	
	function contact_twitter_field_callback() {
        printf(
            '<input type="text" name="lupercalia_options[contact_twitter_field]" size="80" placeholder="www.twitter.com/username" value="%s" />',
            isset( $this->options['contact_twitter_field'] ) ? esc_attr( $this->options['contact_twitter_field']) : ''
        );		
	}	
	function contact_vimeo_field_callback() {
        printf(
            '<input type="text" name="lupercalia_options[contact_vimeo_field]" size="80" placeholder="www.vimeo.com/user-number" value="%s" />',
            isset( $this->options['contact_vimeo_field'] ) ? esc_attr( $this->options['contact_vimeo_field']) : ''
        );		
	}
	function contact_youtube_field_callback() {
        printf(
            '<input type="text" name="lupercalia_options[contact_youtube_field]" size="80" placeholder="www.youtube.com/user/username" value="%s" />',
            isset( $this->options['contact_youtube_field'] ) ? esc_attr( $this->options['contact_youtube_field']) : ''
        );		
	}	
}

$my_lupercalia_theme_options = new LupercaliaSettingsPage();	

?>