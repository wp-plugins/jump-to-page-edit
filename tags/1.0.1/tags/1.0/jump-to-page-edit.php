<?php
/*
Plugin Name: Jump to - Page Edit
Plugin URI: http://www.runwalkweb.com/wp/?page_id=28
Description: Adds an option to the "Edit Page" screen, allowing the user to easily choose another page to edit without leaving the "Edit Page" screen.
Version: 1.0
Author: zach_rww
Author URI: http://www.runwalkweb.com
License: GPL2
*/

/*  Copyright 2012  zach_rww  (email : zach@runwalkweb.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('admin_menu', 'jump_to_page_edit_box');

function jump_to_page_edit_box() {
add_meta_box('post_info', 'Jump to - Page Edit', 'jump_to_page_edit_info', 'page', 'side', 'high');
}

//Adds the actual option box
function jump_to_page_edit_info() {
global $page;
?>
<fieldset id="jump_to_page_edit-div">
<div>
<p>

<label for="jump_to_page_edit">Choose Page:</label><br />
<select name="jump_to_page_edit"
 onchange='document.location.href=this.options[this.selectedIndex].value;'> 
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option> 
 <?php
  $pages = get_pages( array( 'post_status' => 'publish,private,draft' ) ); 
  $blog_home = home_url();
  foreach ( $pages as $page ) {
	$page_title_value = substr($page->post_title,0,26).'...';
  	$option = '<option value="' . $blog_home . '/wp-admin/post.php?post=' . $page->ID . '&action=edit">';
if ( $page->post_status == 'publish' ) {
	$option .= '&#10003; ';
}
else {
	$option .= '[' . $page->post_status . '] ';
}
	$option .= $page_title_value;
	$option .= '</option>';
	echo $option;
  }
 ?>
</select><br />

</p>
</div>
</fieldset>
<?php
}