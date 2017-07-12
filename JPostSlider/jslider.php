<?
/*
Plugin Name: J Post Slider
Plugin URI: http://www.prodeveloper.org/j-post-slider-wordpress-plugin-jquery-post-animation-show.html
Description: Show your post in fancy jQuery box, rotating images, with show-up text box with post description. Mousover stop the animation, and user can click on post link anytime ;)I used Boban Karišik <a href="http://www.serie3.info/s3slider/index.php" target="_blank">s3Slider jQuery</a> scipt. Thanks Boban for nice jQuery script. I can't show you how much cool is this plugin, you just need to try it.
Version: 1.3.1
Author: Ivan Djurdjevac
Author URI: http://www.prodeveloper.org
*/
function js_add_pages() {
	$page = add_options_page("J Post Slider", "J Post Slider", 0, 'jslider', 'js_page');
	add_action('admin_head-'.$page,'js_admin_head');
}
add_action('admin_menu', 'js_add_pages');

function js_page() {
	if ($_POST['save']) {
		update_option('js_op_rotate', $_POST['op_rotate']);
		update_option('js_op_offset', $_POST['op_offset']);
		update_option('js_op_width', $_POST['op_width']);
		update_option('js_op_height', $_POST['op_height']);
		update_option('js_op_show_time', $_POST['op_show_time']);
		update_option('js_op_cats', $_POST['cats']);
		update_option('js_op_text_pos', $_POST['text_pos']);
		update_option('js_op_left_width', $_POST['left_width']);
		update_option('js_op_right_width', $_POST['right_width']);
		update_option('js_op_opacity', $_POST['opacity']);
		update_option('js_op_show_ex', $_POST['show_ex']);
	}
	?>
	<div class="wrap">
		<h2>J Post Slider Plugin</h2>
		<h4>Options</h4>
		<form name="js_setup" action="" method="POST">
			<table class="">
				<tr>
					<td>Number of post to rotate in J Post Slider Box:</td>
					<td><input type="text" name="op_rotate" value="<? echo get_option('js_op_rotate'); ?>" /><label> posts</label></td>
				</tr>
				<tr>
					<td>Post Offset (don't show (x) latest post)</td>
					<td><input type="text" name="op_offset" value="<? echo get_option('js_op_offset'); ?>" /><label> posts</label></td>
				</tr>
				<tr>
					<td>Image Width:</td>
					<td><input type="text" name="op_width" value="<? echo get_option('js_op_width'); ?>" /><label>px</label></td>					
				</tr>
				<tr>
					<td>Image Height:</td>
					<td><input type="text" name="op_height" value="<? echo get_option('js_op_height'); ?>" /><label>px</label></td>					
				</tr>				
				<tr>
				<tr>
					<td>Show time for one image:</td>
					<td><input type="text" name="op_show_time" value="<? echo get_option('js_op_show_time'); ?>" /><label> miliseconds</label></td>					
				</tr>	
				<tr>
					<td>Show post excerpt?</td>
					<td>
						<label>Yes</label><input type="radio" name="show_ex" value="true"<?if(get_option('js_op_show_ex') == 'true') echo " CHECKED"?>/><br/>
						<label>No</label><input type="radio" name="show_ex" value="false"<?if(get_option('js_op_show_ex')== 'false') echo " CHECKED"?>/>
					</td>
				</tr>
				<tr>
					<td>Show text box:</td>
					<td>
					<select name="text_pos">
						<option value="tb"<?if (get_option('js_op_text_pos')=='tb') echo " SELECTED"?>>Switch Top / Bottom</option>
						<option value="lr"<?if (get_option('js_op_text_pos')=='lr') echo " SELECTED"?>>Switch Left / Right</option>
						<option value="t"<?if (get_option('js_op_text_pos')=='t') echo " SELECTED"?>>Always Top</option>
						<option value="b"<?if (get_option('js_op_text_pos')=='b') echo " SELECTED"?>>Always Bottom</option>
						<option value="l"<?if (get_option('js_op_text_pos')=='l') echo " SELECTED"?>>Always Left</option>
						<option value="r"<?if (get_option('js_op_text_pos')=='r') echo " SELECTED"?>>Always Right</option>
						<option value="rand"<?if (get_option('js_op_text_pos')=='rand') echo " SELECTED"?>>Randomize</option>
					</select>
					</td>					
				</tr>				
				<tr>
					<td>Text box Width when float to Left</td>
					<td><input type="text" name="left_width" value="<?echo get_option('js_op_left_width');?>"/><label>px</label></td>
				</tr>				
				<tr>
					<td>Text box Width when sloat to Right</td>
					<td><input type="text" name="right_width" value="<?echo get_option('js_op_right_width');?>"/><label>px</label></td>
				</tr>
				<tr>
					<td>Set opacity</td>
					<td><input type="text" name="opacity" value="<?echo get_option('js_op_opacity'); ?>" /><label>%</label></td>
				</tr>								
				<tr>
					<td>Show post only from this categories</td>
					<td>
						<input type="checkbox" id="all" name="all" onchange="javascript:SelectDeselectAll(document.js_setup.cats)"/><label>Select/Diselect All</label><br/>
						<? listCats(); ?>
					</td>					
				</tr>
				<tr>				
					<td colspan="2"><input type="submit" name="save" value="Save" /></td>
				</tr>
			</table>
		</form>
	</div>
	<?
}

function listCats() {
	global $table_prefix, $wpdb;
	$SQL = "SELECT * FROM ".$table_prefix."terms;";
	$terms = $wpdb->get_results($SQL);
	foreach ($terms as $cat) {
		?>
		<input type="checkbox" id="cats" name="cats[]" value="<?echo$cat->term_id;?>"<?
        if (get_option('js_op_cats')!='') {
            if (in_array($cat->term_id,get_option('js_op_cats'))) echo" CHECKED";
        }
        ?>/><label><?echo$cat->name;?></label><br/>
		<?
	}
}

function js_head_include() {
?>
<link rel='stylesheet' href='<?echo get_bloginfo('url')?>/wp-content/plugins/JPostSlider/slider_style.css' type='text/css' media='all' />
<script src="<?echo get_bloginfo('url')?>/wp-content/plugins/JPostSlider/jquery.js" type="text/javascript"></script>  
<script src="<?echo get_bloginfo('url')?>/wp-content/plugins/JPostSlider/s3Slider.js" type="text/javascript"></script>  
<script type="text/javascript">

    $(document).ready(function() {
        $('#s3slider').s3Slider({
            timeOut: <?echo get_option('js_op_show_time');?>
        });
    });

</script>
<style type="text/css">
<!--
#s3slider {
   width: <?echo get_option('js_op_width');?>px; /* important to be same as image width */
   height: <?echo get_option('js_op_height');?>px; /* important to be same as image height */
}
#s3sliderContent {
   width: <?echo get_option('js_op_width');?>px; /* important to be same as image width or wider */
}
.s3sliderImage span {
   filter: alpha(opacity=<?echo get_option('js_op_opacity')?>); /* here you can set the opacity of box with text */
   -moz-opacity: <?echo round((get_option('js_op_opacity')/100),1);?>; /* here you can set the opacity of box with text */
   -khtml-opacity: <?echo round((get_option('js_op_opacity')/100),1);?>; /* here you can set the opacity of box with text */
   opacity: <?echo round((get_option('js_op_opacity')/100),1);?>; /* here you can set the opacity of box with text */
}
.s3sliderImage span.left {
	height:<?echo get_option('js_op_height')-20;?>px;
	width:<?echo get_option('js_op_left_width');?>px !important;
}
.s3sliderImage span.right {
	height:<?echo get_option('js_op_height')-10;?>px;
	width:<?echo get_option('js_op_right_width');?>px !important;
}
.s3sliderImage span.top {
	width: <?echo get_option('js_op_width')-26;?>px;	
}
.s3sliderImage span.bottom{
	width: <?echo get_option('js_op_width')-26;?>px;	
}
-->
</style>
<?	
}
add_action('wp_head', 'js_head_include', 30);

function isPostInAllowedCat($al_cats) {
	$ret = false;
    if (!is_array($al_cats)) return false;
	foreach ($al_cats as $cat) {
		if (in_category($cat)) {
			$ret = true;
			break;
		}
	}
	return $ret;
}

function js_show_images() {
	global $post;
	$offset = get_option('js_op_offset');
	if (isset($offset))
        $js_query = new WP_Query('offset='.$offset);
	else $js_query = new WP_Query();
	$show_images = get_option('js_op_rotate');
	$allowed_cats = get_option('js_op_cats');
	$text_pos = get_option('js_op_text_pos');
	switch ($text_pos) {
		case 'lr': $pos= array('left', 'right'); break;
		case 'tb': $pos= array('top', 'bottom'); break;
		case 't': $pos= array('top'); break;
		case 'b': $pos= array('bottom'); break;
		case 'l': $pos= array('left'); break;
		case 'r': $pos= array('right'); break;
		case 'rand' : $pos = array ('top', 'bottom', 'left', 'right'); break;
	}
    if (isPostInAllowedCat($allowed_cats)) {
	?>
	<div id="s3slider">
	   <ul id="s3sliderContent">	
	<?
	$class_switcher =0;
	while ($js_query->have_posts() and ($show_images > 0)) : $js_query->the_post();
		if ($img = get_post_meta($post->ID, 'jslider_image', true)) {	
				if (($text_pos =='lr') or ($text_pos=='tb')) {
					if ($class_switcher ==0) $class_switcher=1; else $class_switcher=0;
					//$class_switcher=1;
				} else if ($text_pos == 'rand') { $class_switcher = rand(0,3);}
				else $class_switcher = 0;
			?>
		      <li class="s3sliderImage">
		          <a href="<?echo get_permalink($post->ID);?>"><img src="<?echo$img;?>" />
		          <span class="<?echo$pos[$class_switcher];?>"><strong><?echo $post->post_title,"</strong>";
				  if (get_option('js_op_show_ex')=='true') { echo "<br/>"; the_excerpt(); }
				  echo "</span></a>";
				  ?>
		      </li>	
			<?
			--$show_images;
		}
	endwhile;
	?>
		<div class="clear s3sliderImage"></div>
		</ul>
	</div>
	<?
    }
}
function js_image_save($id) {
	$post_jslider_image = $_POST['jslider'];
	delete_post_meta($id, 'jslider_image');
	if ($post_jslider_image != '')
		update_post_meta($id, 'jslider_image', $post_jslider_image);
}
function js_media_button() {
	?>
	<div id="jsliderbox" class="postbox closed">	
	<h3>Select Image for J Post Slider Plugin Animation Box ;)</h3>
	<div class="inside">
		<p>Click ReLoad button to load all images, if you add some image in meantime.</p>
		<input type="button" name="ajaxrefresh" class="button" onclick="CallUpdateImageShow();" value="ReLoad (AJAX)"/><br/><br/>
		<div id="jslider_update">
		</div>
	</div>
	</div>
	<?
}

function js_media_button_ajax($postID) {
	//echo $_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php';
	//include "jslider.php";
	global $table_prefix, $wpdb;
	$html = '';
	$post_jslider_image = get_post_meta($postID, 'jslider_image', true);
	if (($post_jslider_image != 'NULL') and ($post_jslider_image != '')) 
		$html .= "Currently selected image is ".$post_jslider_image;
	$args = array(
		'post_type' => 'attachment',
		'numberposts' => -1,
		'post_status' => null,
		'post_parent' => $postID
		); 
	$attachments = get_posts($args);
	if ($attachments) {
	$html .='
	<table witth="100%" class="widefat">
		<tr>';
		$breake_table_at=3;
		$coll=1;
		$attachment_counter = 1;
		foreach ($attachments as $attachment) {
			//echo apply_filters('the_title', $attachment->post_title);
			$image = wp_get_attachment_image_src($attachment->ID,'full');
				$meta = wp_get_attachment_metadata($attachment->ID,true);
				if ((is_array($meta)) and ($post_jslider_image == $image[0])) {
				//echo "<pre>";
				//print_r($meta);
				//echo "</pre>";
					if (($meta['width'] != get_option('js_op_width')) or ($meta['height']) != get_option('js_op_height'))
					$html.= "<th colspan=\"".$breake_table_at."\">Selected image didn't fit J Post Slider options (Width: ".get_option('js_op_width').
						"px and Height: ".get_option('js_op_height')."px)<br/>We sugest you to select another image or set new sizes in Options >> J Post Slider</th></tr><tr>";
					else
					$html .= "<th colspan=\"".$breake_table_at."\">Selected image fits great in J Post Slider Box (Width: ".get_option('js_op_width').
						"px and Height: ".get_option('js_op_height')."px)</th></tr><tr>";
				}
				$html.='
					<td width="155" valign="bottom">'.wp_get_attachment_image( $attachment->ID, "thumbnail" ).'<br/>';
				$html .='<input type="radio" name="jslider" id="sl_rad_'.$coll.'" value="'. $image[0]. '"';
				if ($post_jslider_image == $image[0])$html.=" CHECKED";
				$html .='/>';
				if (is_array($meta)) $html .= '<label for="sl_rad_'.$coll.'">' . $meta["sizes"]["thumbnail"]["file"] .'</label>';
				else $html .='<label for="sl_rad_'.$coll.'">No image name :(</label>';				
				$html.='</td>';
				if (($coll%$breake_table_at)==0) $html.= "</tr><tr>";
				if (!isset($postID) and $attachment_counter > 9) break;
				$coll++;
				$attachment_counter++;
		}
		$html.='
			<td width="155" valign="bottom"><input type="radio" id="sl_rad_no" name="jslider" value="NULL"';
		if (!isset($post_jslider_image) or $post_jslider_image=='NULL')$html.=" CHECKED";
		$html.='/><label for="sl_rad_no">No image</label></td>
			</tr>
			</table>';
	}
	//echo $html;
	return $html;
	//return "KOJE SRANJE";
}

function js_admin_head() {
	?>
<SCRIPT LANGUAGE="JavaScript">
<!--
window.onload=init_form;
function SelectDeselectAll(field)
{
	if (document.js_setup.all.checked) {
		for (i = 0; i < field.length; i++)
			field[i].checked = true ;
	} else {
		for (i = 0; i < field.length; i++)
			field[i].checked = false ;
	}	
}
function init_form() {
	var field2 = document.js_setup.cats;
	var selected = true;
	for (i = 0; i < field2.length; i++) {
		if (field2[i].checked == false) {
			selected = false;
			break;
		}
	}
	if (selected)
		document.js_setup.all.checked = true;	
}
-->
</script>
	<?
}
add_action('edit_post', 'js_image_save');
add_action('edit_form_advanced', 'js_media_button');

function js_install() {
	update_option('js_op_rotate', '5');
	update_option('js_op_offset', '0');
	update_option('js_op_width', '250');
	update_option('js_op_height', '250');
	update_option('js_op_show_time', '4000');
    update_option('js_op_cats', '');
	update_option('js_op_text_pos', 't');
	update_option('js_op_left_width', '50');
	update_option('js_op_right_width', '50');
	update_option('js_op_opacity', '70');
	update_option('js_op_show_ex', 'true');	
}
register_activation_hook( __FILE__, 'js_install' );

function scriptaculousInclude() {
	?>
	<script src="<?echo get_bloginfo('url')?>/wp-includes/js/scriptaculous/prototype.js" type="text/javascript"></script>  
	<script src="<?echo get_bloginfo('url')?>/wp-includes/js/scriptaculous/scriptaculous.js" type="text/javascript"></script> 
	<script language="JavaScript">
	<!--
	function CallUpdateImageShow() {
		var myDiv = document.getElementById('jslider_update');
		myDiv.innerHTML = '<h3>Loading Images ...</h3>';		
		var url = "<?echo get_bloginfo('url')?>/wp-content/plugins/JPostSlider/phpcall.php"; // url to update_navigation.php
		var updateNavigation = new Ajax.Request(
				url,
				{
					method: 'get',
					<? global $post;
					if($post->ID) { ?>
					   parameters: "postid=" + <? global $post; echo $post->ID; ?>,
					<? 
					} 
					?>
					onComplete: updateImageShow
	
				});
		return true;		
	}
	function updateImageShow(originalRequest) {
		var myDiv = document.getElementById('jslider_update');
		myDiv.innerHTML = originalRequest.responseText;
	}
	window.onload = CallUpdateImageShow;
	-->
	</script> 
	<?
}
add_action('admin_head', 'scriptaculousInclude');
?>