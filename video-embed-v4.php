<?php

class acf_video_embed extends acf_field
{
	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options
		
		
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function __construct()
	{
		// vars
		$this->name = 'video';
		$this->label = __('Video');
		$this->category = __("Content",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
			// add default here to merge into your field. 
			// This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
			//'preview_size' => 'thumbnail'
		);
		
		
		// do not delete!
    	parent::__construct();
    	
    	
    	// settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.0.0'
		);

	}
	
	
	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
	function create_options( $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		
		$field['character_number'] = isset($field['character_number']) ? $field['character_number'] : '';
		
		?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Number of characters",'acf'); ?></label>
			</td>
			<td>
				<?php 
				
				
				if($field['character_number'] == ""){
					
					$field['character_number'] = 150;
					
				}
			
				do_action('acf/create_field', array(
							'type'	=>	'text',
							'name'	=>	'fields['.$field['name'].'][character_number]',
							'value'	=>	$field['character_number']
				));
		

				
				
				?>
			</td>
		</tr>

<!--
		<tr class="field_option field_option_file">
			<td class="label">
				<label>Choice</label>
			</td>
			<td>
				<ul class="radio_list radio horizontal"><li><label><input id="acf-field_5_save_format-object" type="radio" name="fields[field_5][save_format]" value="object">File Object</label></li><li><label><input id="acf-field_5_save_format-url" type="radio" name="fields[field_5][save_format]" value="url">File URL</label></li><li><label><input id="acf-field_5_save_format-id" type="radio" name="fields[field_5][save_format]" value="id" checked="checked" data-checked="checked">File ID</label></li></ul>			</td>
		</tr>	
-->	
		
		<?php
		
		

		

		
	}
	
	
	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function create_field( $field )
	{
		
		//useable code
/*
		$field['value'] = str_replace('<br />','',$field['value']);
		echo '<textarea id="' . $field['id'] . '" class="limiterField" data-characterlimit="'.$field['character_number'].'" rows="4" class="' . $field['class'] . '" name="' . $field['name'] . '" >' . $field['value'] . '</textarea>';
		
		echo('<div id="progressbar-'.$field['id'].'" class="progressBar"></div>');
*/


		?>
		
		<div class="acf-vf">
			<form class='videoSearchForm' action="#">
				<input class="input videoSearchBox" />
				<input type="submit" value="Submit" class="input videoSearchSubmit">
			</form>
			<div class="acf-vf-navigation">
				<a href='#' class="acf-vf-ContentSelect" data-pane-select="youTubeSearch">YouTube tag
					<img src="<?php echo $this->settings['dir'] ?>/images/youTube.png" />
					
				</a> 
				<a href='#' class="acf-vf-ContentSelect" data-pane-select="youTubeSearch2">YouTube Search
					<img src="<?php echo $this->settings['dir'] ?>/images/vimeo.png" />
					
				</a> -
	<!-- 			<a href='#' class="acf-vf-ContentSelect" data-pane-select="youTubeSearch">Vimeo Search</a> -  -->
				<a href='#' class="acf-vf-ContentSelect" data-pane-select="youTubeSearch3">Youtube Embed</a> - 
	<!-- 			<a href='#' class="acf-vf-ContentSelect" data-pane-select="youTubeSearch">Vimeo Embed</a> -  -->
			</div>
			<div class="acf-vf-container">
				<div class="acf-vf-ContentPane youTubeSearch acf-vf-active" style='background:blue'>
				

					Search Term: <input type="text" size="30" class="search_field" value="soccer">
					<input type="button" value="Search" class="youtubesearch" onclick=""> &nbsp; &nbsp; 
					<input type="button" value="Hide" onclick="document.getElementById(&quot;videos&quot;).innerHTML = &quot;&quot;;">
					
					<div id="videos"></div>
					<p></p>
				</div>
				<div class="acf-vf-ContentPane youTubeSearch2" style='background:red'>
					Another pane
				</div>
			</div>
		</div>
		<div class="acf-vf-results">

		</div>
		
		<?
/*
		$(postbox).find('.field_type-tab').each(function(){
			
			// vars
			var field = $(this),
				tab = field.find('.acf-tab'),
				id = tab.attr('data-id'),
				label = tab.html(),
				postbox = field.closest('.acf_postbox'),
				inside = postbox.children('.inside');
			

			
			// only run once for each tab
			if( tab.hasClass('acf-tab-added') )
			{
				return;
			}
			tab.addClass('acf-tab-added');
			
			
			// create tab group if it doesnt exist
			if( ! inside.children('.acf-tab-group').exists() )
			{
				inside.children('.field_type-tab:first').before('<ul class="hl clearfix acf-tab-group"></ul>');
			}
			
			
			// add tab
			inside.children('.acf-tab-group').append('<li class="field_key-' + id + '" data-field_key="' + id + '"><a class="acf-tab-button" href="#" data-id="' + id + '">' + label + '</a></li>');
			
			
		});
		
*/
				
		
	}
	
	
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add css + javascript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts()
	{
		
	wp_enqueue_script('jquery');
		// register acf scripts
		
		
		//jquery-ui-progressbar
		
		
		// scripts


		
		
		
		
		//jquery-ui-progressbar
		//wp_enqueue_script( 'jquery-ui-tabs');
		
				wp_register_script( 'acf-video', $this->settings['dir'] . 'js/video-embed.js', array('jquery'), $this->settings['version'] );


		// styles
		
		wp_register_style( 'video-field', $this->settings['dir'] . 'css/video-field.css', array('acf-input'), $this->settings['version'] ); 
	
		wp_enqueue_style(array(
			'video-field'
		));
		
		
		
		wp_enqueue_script(array(
			'acf-video',	
		));
		
		
	}
	
	
	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add css and javascript to assist your create_field() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_head()
	{
		// Note: This function can be removed if not used

		
		
	}
	
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add css + javascript to assist your create_field_options() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used
	}

	
	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add css and javascript to assist your create_field_options() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_head()
	{
		// Note: This function can be removed if not used
	}


	/*
	*  load_value()
	*
	*  This filter is appied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value found in the database
	*  @param	$post_id - the $post_id from which the value was loaded from
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the value to be saved in te database
	*/
	
	function load_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  update_value()
	*
	*  This filter is appied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$post_id - the $post_id of which the value will be saved
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the modified value
	*/
	
	function update_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed to the create_field action
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value( $value, $post_id, $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		// perhaps use $field['preview_size'] to alter the $value?
		
		
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  format_value_for_api()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed back to the api functions such as the_field
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value_for_api( $value, $post_id, $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		// perhaps use $field['preview_size'] to alter the $value?
		
		
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  load_field()
	*
	*  This filter is appied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$field - the field array holding all the field options
	*/
	
	function load_field( $field )
	{
		// Note: This function can be removed if not used
		return $field;
	}
	
	
	/*
	*  update_field()
	*
	*  This filter is appied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the field group ID (post_type = acf)
	*
	*  @return	$field - the modified field
	*/

	function update_field( $field, $post_id )
	{
		// Note: This function can be removed if not used
		return $field;
	}

	
}


// create field
new acf_video_embed();

?>