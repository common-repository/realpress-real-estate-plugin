<?php
/**
 *  CUSTOM   ----   RSS2 Feed Template for Google Base
 *
 * @package WordPress
 *
 * feel free to customize, but check the Google Base feed API if
 * you intend to make any XML structure changes!
 *
 * NOTE: this feed only contains AVAILABLE properties
 *  
 * check for available options 
 * http://wpestate.rhinoda.com/feed/feed-googlebase/ 
 * http://base.google.com/base/basicsettings 
 * http://base.google.com/support/bin/answer.py?answer=66779&hl=en 
 */

header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);

$siteurl = get_option('siteurl');
$max_pics = 10;

if (!function_exists('realpressAvailableListings')) {
	return;
}

$data = realpressAvailableListings();
//var_dump($data);
$rss_values=realpressGetRSSOptions();

?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<rss version="2.0" 
xmlns:g="http://base.google.com/ns/1.0">
<channel>
<title><?=$rss_values["feed_title"]; ?></title>
<description><?=$rss_values["description"]; ?></description>
	<link><?=get_option('home'); ?></link>
<?php if ($data): ?>
<?php foreach ($data as $post):
 
 	$address = $post->addressnumber;
 	$city = $post->city;
	$state = $post->state;
	$zip = $post->postcode;
	$propstatus = $post->status;
	//description <10000 chars
	
	//locatioin
	//Addresses should be formatted as: street, city, state, postal code, country.
	//if ($address && $city && $state && $zip && $propstatus) 
  { 
  ?>
<item>
<g:location><?=($address.", ".$city.", ".$state.", ".$zip.", ".$post->country); ?></g:location>
<g:listing_status>active</g:listing_status>
<g:listing_type>for sale</g:listing_type>
<g:price><?=number_format($post->price_total); ?></g:price>
<link><?=$siteurl."?p=".$post->postid; ?></link>
<g:mls_listing_id><?=$post->mls; ?></g:mls_listing_id>
<g:id><?=$post->mls; ?></g:id>
<g:mls_name><?=$rss_values["mls_name"]; ?></g:mls_name>
<title><![CDATA[<?=$post->post_title; ?>]]></title>
<description><![CDATA[<?=substr($post->description,0,10000); ?>]]></description>
<g:bedrooms><?=$post->beds; ?></g:bedrooms>
<g:bathrooms><?=$post->baths; ?></g:bathrooms>
<g:parking><?=$post->garages; ?></g:parking>
<g:area><?=$post->sqft . " square ft."; ?></g:area>
<g:lot_size><?=$post->acres . " acres"; ?></g:lot_size>
<?php 
if (function_exists(realpress_get_post_images)) { 
	$piclist = realpress_get_post_images($post->postid,$max_pics);; 
	if (!empty($piclist)) { 
		foreach ($piclist as $picture) { 
				?><g:image_link><?=$picture; ?></g:image_link>
<?php
			}
		}
	}
?>
	<g:agent><?=$post->agentid; ?></g:agent>
	<g:agent><?=$rss_values["agent_name"];  ?></g:agent>
	<g:broker><?=$rss_values["brokerage_name"];  ?></g:broker>

<g:provider_class>agent</g:provider_class>
</item>
<?php } ?>
<?php endforeach; ?>
<?php endif; ?>
</channel>
</rss>