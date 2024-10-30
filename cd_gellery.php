<?php  
/* 
Plugin Name: CD gallery
Plugin URI: http://wordpress.org/extend/plugins/cd-gellery/
Description: ギャラリーをCDケースの画像に置き換えて表示するプラグインです。   Changes gallery thumbneils to CD jacket image. 
Version: 1.0
Author: のひな (nohina)
Author URI: http://island-blog.net
*/


add_shortcode('cd_gallery', 'cd_gallery_shortcode');


function cd_gallery_shortcode($attr, $content = null) {
	global $post;

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'display_style'   => ''
	), $attr));

	$id = intval($id);
	$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $id => $attachment )
			$output .= wp_get_attachment_link($id, $size, true) . "\n";
		return $output;
	}

	$output = apply_filters('cd_gallery_style', "
		<style media='screen,projection'>
			ul.cd_gallery{
				list-style:none;
				border:0;
				text-decoration:none;
			}
			ul.cd_gallery li{
				margin:0;
				padding:0;
				list-style:none;
				border:0;
				text-decoration:none;
				width:100px;
				height:100px;
			}
			ul.cd_gallery li a,
			ul.cd_gallery li img{
				margin:0;
				padding:0;
				list-style:none;
				border:0;
				text-decoration:none;
			}
			ul.cd_gallery li{
				margin:15px 15px 15px 0;
				float:left;
				position:relative;
			}
			ul.cd_gallery li a{
				display:block;
				position:relative;
				float:left;	
				width:80px;
				height:80px;
				text-indent:-1000em;
				overflow:hidden;
				z-index:1;						
			}
			ul.cd_gallery li img{
				position:absolute;
				width:80px;
				height:80px;
				border:0;
			}
			
			/* Jewel Case */
			ul.cd_gallery li.jewel img{
				width:72px;
				height:72px;
				top:3px;
				left:12px;
			}			
			ul.cd_gallery li.jewel a{
				background:url(wp-content/plugins/cd_gallery/img/jewel.png) 0 0 no-repeat;
				width:90px;
				height:82px;							
			}
			ul.cd_gallery li.jewel{
				background:url(wp-content/plugins/cd_gallery/img/blank_insert.gif) 12px 3px no-repeat;							
			}
			
			
			/* Vinyl Sleeve */
			ul.cd_gallery li.vinyl img{
				width:72px;
				height:72px;
				left:2px;
				top:1px;
			}			
			ul.cd_gallery li.vinyl a{
				background:url(wp-content/plugins/cd_gallery/img/vinyl.png) 0 0 no-repeat;
				width:96px;
				height:76px;							
			}
			ul.cd_gallery li.vinyl{
				background:url(wp-content/plugins/cd_gallery/img/vinyl_insert.gif) 2px 1px no-repeat;							
			}
			
			
			/* Compact Disc */
			ul.cd_gallery li.cd img,
			ul.cd_gallery li.cd a{
				width:82px;
				height:82px;
				top:0;
				left:0;
			}			
			ul.cd_gallery li.cd a{
				background:url(wp-content/plugins/cd_gallery/img/cd.png) 0 0 no-repeat;			
				height:86px;
			}
			ul.cd_gallery li.cd{
				background:url(wp-content/plugins/cd_gallery/img/blank_cd.jpg) 0 0 no-repeat;							
			}
			
		</style>
		<ul class='cd_gallery'>"
		);

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
		$link = ereg_replace("</a>","",$link);
		$link = preg_replace('|<a([^>]*)>|i', "<a$1 /></a>", $link);


		if($display_style=='jewel'){
			$output .= "<li class='jewel'>$link</li>\n";
		}else if($display_style=='vinyl'){
			$output .= "<li class='vinyl'>$link</li>\n";
		}else if($display_style=='cd'){
			$output .= "<li class='cd'>$link</li>\n";
		}else {
			$rnd = rand(1,3);
			if($rnd==1){
				$output .= "<li class='jewel'>$link</li>\n";
			} else if($rnd==2) {
				$output .= "<li class='vinyl'>$link</li>\n";
			} else {
				$output .= "<li class='cd'>$link</li>\n";
			}
		}
	}

	$output .= "
		</ul>\n";

	return $output;
}

?>


