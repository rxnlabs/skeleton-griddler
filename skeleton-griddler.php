<?php
/*
Plugin Name: Skeleton Griddler
Plugin URI: http://example.com/
Description: A WordPress plugin to increase development of columns
Version: 0.1
Author: De'Yonte W.
Author URI: http://example.com/
*/

/**
 * Copyright (c) `date "+%Y"` Your Name. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
require('shortcodes.php');

class SkeletonGriddler{

	public function __construct(){
		//initiate WordPress hooks
		add_action('media_buttons_context',array($this,'tinymce_media_button') );
		//include the admin scripts and stylesheets
		$this->admin_scripts();
	}

	public function admin_scripts(){

		//Enqueue JS
		wp_register_script('skgriddlier-dropdowns',plugins_url('js/bootstrap.dropdowns/js/bootstrap.dropdowns.js', __FILE__),array('jquery'),'2.3.1');
    wp_enqueue_script('skgriddlier-dropdowns');

    //Enqueue CSS
    wp_register_style('skgriddlier-dropdowns',plugins_url('js/bootstrap.dropdowns/css/bootstrap.dropdowns.css', __FILE__));
    wp_enqueue_style('skgriddlier-dropdowns');
	}

	public function tinymce_media_button($context){
			
		//add a facebook like button to the page
	  return $context.=__("
  	<div class='btn-group'>
	  	<a class='button btn dropdown-toggle' data-toggle='dropdown' href='#'' id='skgriddler_shortcodes' title='Add Facebook Like Button'>
	  	Add Grids/Columns
	  	<span class='caret'></span>
	  	</a>
	  	<ul class='dropdown-menu'>
	  		<li><a title='40px' data-skgrid='1'>Add 1 Grid</a></li>
	  		<li><a title='100px' data-skgrid='2'>Add 2 Grid</a></li>
	  		<li><a title='160px' data-skgrid='3'>Add 3 Grid</a></li>
	  		<li><a title='220px' data-skgrid='4'>Add 4 Grid</a></li>
	  		<li><a title='280px' data-skgrid='5'>Add 5 Grid</a></li>
	  		<li><a title='340px' data-skgrid='6'>Add 6 Grid</a></li>
	  		<li><a title='400px' data-skgrid='7'>Add 7 Grid</a></li>
	  		<li><a title='460px' data-skgrid='8'>Add 8 Grid</a></li>
	  		<li><a title='520px' data-skgrid='9'>Add 9 Grid</a></li>
	  		<li><a title='580px' data-skgrid='10'>Add 10 Grid</a></li>
	  		<li><a title='640px' data-skgrid='11'>Add 11 Grid</a></li>
	  		<li><a title='700px' data-skgrid='12'>Add 12 Grid</a></li>
	  		<li><a title='760px' data-skgrid='13'>Add 13 Grid</a></li>
	  		<li><a title='820px' data-skgrid='14'>Add 14 Grid</a></li>
	  		<li><a title='880px' data-skgrid='15'>Add 15 Grid</a></li>
	  		<li><a title='940px' data-skgrid='16'>Add 16 Grid</a></li>
	  		<li><a title='940px' data-skgrid='clear'>Clear Grid</a></li>
	  	</ul>
		</div>
		<script type='text/javascript'>
		  jQuery(document).ready(function(){
		    //add the unbind method to prevent the facebook like shortcode from appearing twice
		    //http://forum.jquery.com/topic/why-is-this-click-function-firing-twice
		    jQuery('a[data-skgrid]').unbind('click').click(function(e){
		      e.stopPropagation();
		      e.preventDefault();
		      var grid = jQuery(this).attr('data-skgrid');

					var selected_text = tinyMCE.activeEditor.selection.getContent();

		      if( grid != 'clear'){
			      var grid_shortcode = '[skgrid columns='+grid+']'+selected_text+'[/skgrid]';
			    }else if ( grid === 'clear'){
			    	var grid_shortcode = '[clear/]';
			    }

			    /*if( !tinyMCE.activeEditor || tinyMCE.activeEditor.isHidden()) {
		        jQuery('textarea#content').val(grid_shortcode);
		      } else {
		        tinyMCE.execCommand('mceInsertRawHTML', false, grid_shortcode);
		      }*/
		      
		      window.send_to_editor( grid_shortcode );
		      //close the dropdown
		      jQuery('.dropdown-toggle').dropdown('toggle');
		      
		      return false;
		    });
		  });
		  </script>");
	}


}

$skgriddler = new SkeletonGriddler();