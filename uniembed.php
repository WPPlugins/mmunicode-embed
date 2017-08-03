<?php
/**
 * @package MMUnicode Embed
 * @version 1.4
 */
/*
Plugin Name: MMUnicode Embed
Plugin URI: http://wordpress.org/extend/plugins/mmunicode-embed/
Description: MMUnicode Embed
Author: saturngod
Version: 1.4
Author URI: http://www.saturngod.net
*/

function addembed()
{
	$plugin_url= get_option('siteurl').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
	
	if(!is_admin())
	{
	
	?>
	
	<?php
	}
		//for convert zawgyi to unicode comment
		if(is_single())
		{
			if (get_option('uniemd_init') =="")
			{
				//init
				update_option('uniemd_init',1);
				update_option('uniemd_converter',1);
				update_option('uniemd_forceCSS',0);
				update_option('uniembed_font','yunghkio');
			}
			
			
			if (get_option('uniemd_converter') ==1)
			{
	?>
			<script  data-cfasync="false" type="text/javascript" src="<?php echo $plugin_url ?>/zgcomment_convert.js"></script>
	<?php
			}


		}
	if(!is_admin())
	{
		if(get_option('uniembed_font')=="") update_option('uniembed_font','yunghkio');

		

	?>
	
		<link rel='stylesheet' href='http://mmwebfonts.comquas.com/fonts/?font=<?php echo get_option('uniembed_font'); ?>'/>
	
<?php
	}
}
add_action('wp_head', 'addembed');
add_action('wp_footer','footercss');
add_filter('the_content', 'unicode_rss');

//footer for add css
function footercss()
{

	$plugin_url= get_option('siteurl').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

	if (get_option('uniemd_forceCSS') ==1 && !is_admin())
		{
?>
		<style>
		body,html,p,code,*,table,td,tr,span,div,a,ul,li,input,textarea {

			<?php

			if(get_option('uniembed_font')=="") update_option('uniembed_font','yunghkio');
			$font= get_option('uniembed_font');

			if($font=="mon3")
			{
				echo "font-family:'MON3 Anonta 1' !important;";
			}
			else if($font=="yunghkio")
			{
				echo "font-family:Yunghkio,Myanmar3,'Masterpiece Uni Sans' !important;";
			}
			else if($font=="myanmar3")
			{
				echo "font-family:Myanmar3,Yunghkio,'Masterpiece Uni Sans' !important;";
			}
			else if($font=="padauk")
			{
				echo "font-family:padauk,Yunghkio,Myanmar3,'Masterpiece Uni Sans' !important;";
			}
			else if($font=="mymyanmar")
			{
				echo "font-family:'MyMyanmar Universal',Myanmar3,Yunghkio,'Masterpiece Uni Sans' !important;";
			}

			?>
		}
		</style>
<?php
		}

}

//for rss
function unicode_rss($content) {
	
	if(is_feed())
	{
		$content="<span style=\"font-family:'MON3 Anonta 1','Masterpiece Uni Sans',Yunghkio,Myanmar3, Parabaik, Padauk, 'WinUni Innwa', 'Win Uni Innwa', 'MyMyanmar Unicode',Myanmar2;\">".$content."</span>";
	}
	return $content;
}

require 'adminpanel.php';

?>