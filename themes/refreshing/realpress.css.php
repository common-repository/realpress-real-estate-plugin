<?php
header('Content-type: text/css');

//@import "custom.css";

?>

#rp_text_contactname,#rp_text_contactemail,#rp_text_contactphone,#rp_text_contactsubject,#rp_text_contactmessage
{
	width:300px;
}
#rp_bottomContent {

	margin-top:15px;
	margin-right:2px;
	border: 8px solid #fafafa;
	background-color: #f5f5f5;
	/* !!! width: 610px; */
	width: 91%;
	padding: 15px;
	text-align:left;
	align:left;
}

#rp_bottomContent form {
	text-align:left;
	align:left;
}
#rp_bottomContent h2 
{
	padding: 4px 0 6px 40px;
	margin: 0;
	font-size: 16px;
	border-bottom: 1px solid #ccc;
	background: url(../../images/images.gif) no-repeat left top;
}


#rp_bottomContent h3 {
	margin: 5px 0 0;
	padding: 0;
	font-size: 12px;
}

/*********---------------------------------------******************/


/*
* jQuery UI CSS Framework
* Copyright (c) 2009 AUTHORS.txt (http://jqueryui.com/about)
* Dual licensed under the MIT (MIT-LICENSE.txt) and GPL (GPL-LICENSE.txt) licenses.
* To view and modify this theme, visit http://jqueryui.com/themeroller/
*/


/* Component containers
----------------------------------*/
.ui-widget { font-family: Verdana,Arial,sans-serif/*{ffDefault}*/; font-size: 1.1em/*{fsDefault}*/; }
.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button { font-family: Verdana,Arial,sans-serif/*{ffDefault}*/; font-size: 1em; }
.ui-widget-content { border: 1px solid #aaaaaa/*{borderColorContent}*/; background: #ffffff/*{bgColorContent}*/ url(images/ui-bg_flat_75_ffffff_40x100.png)/*{bgImgUrlContent}*/ 50%/*{bgContentXPos}*/ 50%/*{bgContentYPos}*/ repeat-x/*{bgContentRepeat}*/; color: #222222/*{fcContent}*/; }
.ui-widget-content a { color: #222222/*{fcContent}*/; }
.ui-widget-header { border: 1px solid #aaaaaa/*{borderColorHeader}*/; background: #cccccc/*{bgColorHeader}*/ url(images/ui-bg_highlight-soft_75_cccccc_1x100.png)/*{bgImgUrlHeader}*/ 50%/*{bgHeaderXPos}*/ 50%/*{bgHeaderYPos}*/ repeat-x/*{bgHeaderRepeat}*/; color: #222222/*{fcHeader}*/; font-weight: bold; }
.ui-widget-header a { color: #222222/*{fcHeader}*/; }

/* Interaction states
----------------------------------*/
.ui-state-default, .ui-widget-content .ui-state-default { border: 1px solid #d3d3d3/*{borderColorDefault}*/; background: #e6e6e6/*{bgColorDefault}*/ url(images/ui-bg_glass_75_e6e6e6_1x400.png)/*{bgImgUrlDefault}*/ 50%/*{bgDefaultXPos}*/ 50%/*{bgDefaultYPos}*/ repeat-x/*{bgDefaultRepeat}*/; font-weight: normal/*{fwDefault}*/; color: #555555/*{fcDefault}*/; outline: none; }
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited { color: #555555/*{fcDefault}*/; text-decoration: none; outline: none; }
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus { border: 1px solid #999999/*{borderColorHover}*/; background: #dadada/*{bgColorHover}*/ url(images/ui-bg_glass_75_dadada_1x400.png)/*{bgImgUrlHover}*/ 50%/*{bgHoverXPos}*/ 50%/*{bgHoverYPos}*/ repeat-x/*{bgHoverRepeat}*/; font-weight: normal/*{fwDefault}*/; color: #212121/*{fcHover}*/; outline: none; }
.ui-state-hover a, .ui-state-hover a:hover { color: #212121/*{fcHover}*/; text-decoration: none; outline: none; }
.ui-state-active, .ui-widget-content .ui-state-active { border: 1px solid #aaaaaa/*{borderColorActive}*/; background: #ffffff/*{bgColorActive}*/ url(images/ui-bg_glass_65_ffffff_1x400.png)/*{bgImgUrlActive}*/ 50%/*{bgActiveXPos}*/ 50%/*{bgActiveYPos}*/ repeat-x/*{bgActiveRepeat}*/; font-weight: normal/*{fwDefault}*/; color: #212121/*{fcActive}*/; outline: none; }
.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited { color: #212121/*{fcActive}*/; outline: none; text-decoration: none; }



/* Overlays */
.ui-widget-overlay { background: #aaaaaa/*{bgColorOverlay}*/ url(images/ui-bg_flat_0_aaaaaa_40x100.png)/*{bgImgUrlOverlay}*/ 50%/*{bgOverlayXPos}*/ 50%/*{bgOverlayYPos}*/ repeat-x/*{bgOverlayRepeat}*/; opacity: .3;filter:Alpha(Opacity=30)/*{opacityOverlay}*/; }
.ui-widget-shadow { margin: -8px/*{offsetTopShadow}*/ 0 0 -8px/*{offsetLeftShadow}*/; padding: 8px/*{thicknessShadow}*/; background: #aaaaaa/*{bgColorShadow}*/ url(images/ui-bg_flat_0_aaaaaa_40x100.png)/*{bgImgUrlShadow}*/ 50%/*{bgShadowXPos}*/ 50%/*{bgShadowYPos}*/ repeat-x/*{bgShadowRepeat}*/; opacity: .3;filter:Alpha(Opacity=30)/*{opacityShadow}*/; -moz-border-radius: 8px/*{cornerRadiusShadow}*/; -webkit-border-radius: 8px/*{cornerRadiusShadow}*/; }

/* Tabs
----------------------------------*/
.ui-tabs { padding: .2em; zoom: 1; }
.ui-tabs .ui-tabs-nav { list-style: none; position: relative; padding: .2em .2em 0; }
.ui-tabs .ui-tabs-nav li { position: relative; float: left; border-bottom-width: 0 !important; margin: 0 .2em -1px 0; padding: 0; }
.ui-tabs .ui-tabs-nav li a { float: left; text-decoration: none; padding: .5em 1em; }
.ui-tabs .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 1px; border-bottom-width: 0; }
.ui-tabs .ui-tabs-nav li.ui-tabs-selected a, .ui-tabs .ui-tabs-nav li.ui-state-disabled a, .ui-tabs .ui-tabs-nav li.ui-state-processing a { cursor: text; }
.ui-tabs .ui-tabs-nav li a, .ui-tabs.ui-tabs-collapsible .ui-tabs-nav li.ui-tabs-selected a { cursor: pointer; } /* first selector in group seems obsolete, but required to overcome bug in Opera applying cursor: text overall if defined elsewhere... */
.ui-tabs .ui-tabs-panel { padding: 1em 1.4em; display: block; border-width: 0; background: none; }
.ui-tabs .ui-tabs-hide { display: none !important; }


/*
* jQuery UI CSS Framework
* Copyright (c) 2009 AUTHORS.txt (http://jqueryui.com/about)
* Dual licensed under the MIT (MIT-LICENSE.txt) and GPL (GPL-LICENSE.txt) licenses.
*/

/* Layout helpers
----------------------------------*/
.ui-helper-hidden { display: none; }
.ui-helper-hidden-accessible { position: absolute; left: -99999999px; }
.ui-helper-reset { margin: 0; padding: 0; border: 0; outline: 0; line-height: 1.3; text-decoration: none; font-size: 100%; list-style: none; }
.ui-helper-clearfix:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }
.ui-helper-clearfix { display: inline-block; }
/* required comment for clearfix to work in Opera \*/
* html .ui-helper-clearfix { height:1%; }
.ui-helper-clearfix { display:block; }
/* end clearfix */
.ui-helper-zfix { width: 100%; height: 100%; top: 0; left: 0; position: absolute; opacity: 0; filter:Alpha(Opacity=0); }


/* Interaction Cues
----------------------------------*/
.ui-state-disabled { cursor: default !important; }


/* Icons
----------------------------------*/

/* states and images */
.ui-icon { display: block; text-indent: -99999px; overflow: hidden; background-repeat: no-repeat; }


/* Misc visuals
----------------------------------*/

/* Overlays */
.ui-widget-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }

#tabs ,#tabs ul,#tabs li,#tabs ul li
{
list-style: none !important;
}

#realpressMapCanvas
{
	margin:auto;
	padding:auto;
	height:400px;
	 /* !!! width:570px; */
	width:95%;
	border: 2px solid #fff;
}
/*
#realpressRightDescription
{

	float:right;
	width:50%
}
rp_GalleryArea
*/



#realpressLeftDescription
{

	width:100%
}

#realpressLeftDescription #rp_GalleryArea
{
	float:right;
	width:300px;
	height:300px;
	padding-top:15px;
}

#realpressLeftDescription #rp_desImageArea
{
	float:right;
	width:300px;
	height:300px;
	padding-top:15px;
}

//********* end new **********/
/*
#rp_wholeContent
{
	margin:30px auto;
	padding:30px auto;
	width: 580px;
}
*/
#rp_wholeContent li {
margin:0px;
padding:0px;
margin-right:2px;
float:left;
cursor:pointer;
font-size:14px;
padding:5px 2px;
border-top: 1px solid #97a5b0;
border-left: 1px solid #97a5b0;
border-right: 1px solid #97a5b0;
background: #f5f5fc;
}

#rp_wholeContent li a{
cursor:hand;
}
#rp_wholeContent a span {
    width: 80px; /* IE 6 treats width as min-width */
    min-width: 80px;
    height: 15px; /* IE 6 treats height as min-height */
    min-height: 15px;
    padding-top: 6px;
    padding-right: 0;
}


#rp_wholeContent a {
    position: relative;
    top: 1px;
    z-index: 2;
    padding-left: 0;
    color: #27537a;
    font-size: 12px;
    font-weight: bold;
    line-height: 1.2;
    text-align: center;
    text-decoration: none;
    white-space: nowrap; /* required in IE 6 */    
}

/* 
Theme Name: realpressform
Version: 0.05
*/

/**  need change this style from nextgen   **/
#rp_errorImage
{
	margin:5px 0 15px;
	background-color:#BDE5F8;
	border-color:#00529B;
	border-style:solid;
	border-width:1px;
	margin:5px 15px 2px;
	padding:0 0.6em;
}

#rp_firstImage
{
/*
	width:200px;
	height:150px;
	border:0px;
*/
}

#reallocale
{
	width:80px;
}

#rp_title
{
	padding-bottom:10px;
	border-bottom:1px solid gray;
	background-image:url("../../images/house10.jpg");
	background-position:95%;
	background-repeat:no-repeat;
}


#rp_descriptionTitle
{
	padding-bottom:10px;
/* 	border-bottom:1px solid gray; */
	background-image:url("../../images/house10.jpg");
	background-position:95%;
	background-repeat:no-repeat;
}

#realpressHouseDetails
{
	margin-top:30px;
	width: 100%;
	margin:20px auto;
	padding:20px auto;
}


#rp_spamBox
{
	margin-left:10px;
	border:gray solid 1px;
}

#realLayout
{
	padding: 20px;
	margin: 0px 0 0;
	/* width: 580px; */
	width: 100%;
	text-align: center;
}
/* begin for google box */
#realInputSE
{
	margin-top: 15px;
}
#realInputSE
{
	/* !!! width:570px; */
	width:95%;
	height:480px;
	padding: 20px auto;
	margin: 20px auto;	
}
#realInputSE h2 {
	padding: 0;
	margin: 0 0 10px;
	font-size: 16px;
	color: #3387b1;
	text-align: left;
}

#rp_showGallery h2
{
	padding: 0 30px;
	margin: 0 0 10px;
	font-size: 16px;
	color: #3387b1;
	text-align: left;
}

#rp_ImageArea h2
{
	padding: 2px 10px;
	margin: 0 0 10px;
	font-size: 16px;
	color: #3387b1;
	text-align: left;
	align: left;
}

#rp_googlecontent
{
	margin:auto;
	padding:auto;
	/* padding: 5px; */
	background: #F2EFEF;
	border: 1px solid #E5E5E5;
	text-align: center;
}

#realpressMapCanvas
{
	margin:auto;
	padding:auto;
	height:400px;
	 /* !!! width:570px; */
	width:95%;
	border: 2px solid #fff;
}

#realpressMapCanvas20
{
	margin:auto;
	padding:auto;
	height:400px;
	/* !!! width:570px; */
	width:95%;
	border: 2px solid #fff;
}

#rp_googledirection
{
	margin:10px auto;
}

#realDirections
{
	/* !!! width:570px; */
	width:98%;
	margin: 10px auto;
}

#rp_showImage {
	margin:5px auto;
	padding: 5px auto;
	text-align: center;
	background: #F2EFEF;
	border: 1px solid #E5E5E5;
	/* !!! width: 580px; */
	width: 98%;
}
#rp_showGallery {
	margin:0px auto;
	padding: 0px auto;
	text-align: center;
	background: #f8feff;
	border: 1px solid #fafeff;
	/* !!! width: 580px; */
	width: 98%;
}
#rp_GalleryArea
{
	margin:0px auto;
	padding: 0px auto;
}
#rp_GalleryArea a img, rp_GalleryArea img
{
	margin:0px auto;
	padding: 0px auto;
	/* !!! width: 580px; */
	width:98%;
	border: 1px solid #fafeff;
}

#rp_ImageArea,#rp_desImageArea
{
	margin:5px auto;
	padding: 5px auto;
}
#rp_ImageBig {
	padding-left:10px;
	text-align: middle;
}

#rp_ImageArea a img, #rp_ImageArea img,#rp_ImageDiv a img,#rp_ImageDiv img
{
	margin:5px auto;
	padding: 5px auto;
	/* !!! width: 580px; */
	width:98%;
	border: 1px solid #E5E5E5;
}
#rp_desImageArea a img, #rp_desImageArea img,#rp_desImageDiv a img,#rp_desImageDiv img
{
	margin:5px auto;
	padding: 5px auto;
	width: 250px;
	border: 1px solid #E5E5E5;
}

#rp_leftContent 
{
	text-align:left;
	align:left;
	margin: 10px 9px 10px 0px;
	border-right:1px dotted #B6B6B6;
	padding-right:14px;
	width:50%;
	float: left;
}

#rp_leftContent h2 {
	color: #f17903;
	font-size: 16px;
	padding: 0px;
	margin: 0px;
}

#rp_rightContent {
	float: right;
	margin-top:15px;
	margin-right:2px;
	border: 8px solid #fafafa;
	background-color: #f5f5f5;
	width: 35%;
	padding: 15px;
	text-align:left;
	align:left;
}

#rp_rightContent form {
	text-align:left;
	align:left;
}
#rp_rightContent h2 
{
	padding: 4px 0 6px 40px;
	margin: 0;
	font-size: 16px;
	border-bottom: 1px solid #ccc;
	background: url(../../images/images.gif) no-repeat left top;
}


#rp_rightContent h3 {
	margin: 5px 0 0;
	padding: 0;
	font-size: 12px;
}

#rp_before_featured
{
	background: url(../../images/bluebtn.gif) no-repeat left top;
	/* color:#bfbd28; */
	color:#eee;
	border:0px;
	padding:5px;
}

#rp_description
{
	margin:10px 2px;
}

#rp_description p
{
	margin-bottom:10px 2px;
}

#rp_frontendListingDetails
{
	color:#3387b1;
	font-weight:bold;
	font-size:16px;
	margin:10px 0px;
}

#rp_content_title
{
	font-weight:bold;
}

#rp_status,#rp_street,#rp_state,#rp_postcode,#rp_baths,#rp_sqft,#rp_yearbuild,#rp_propertyfeatures,#rp_currencyid,#rp_price_total,#rp_listdate,#rp_mls,#rp_propertytype
{

	background-color:#f7f7ff;
}
#rp_listingtype,#rp_city,#rp_country,#rp_beds,#rp_garages,#rp_acres,#rp_listingfeatures,#rp_neighborhood,#rp_price_sqft,#rp_saled_price,#rp_saledate,#rp_agentid,#rp_indetailtitle
{

		background-color:#fff;
}

*html #rp_status,#rp_street,#rp_state,#rp_postcode,#rp_baths,#rp_sqft,#rp_yearbuild,#rp_propertyfeatures,#rp_currencyid,#rp_price_total,#rp_listdate,#rp_mls,#rp_propertytype
{
	height:20px;
	line-height:20px;
	background-color:#f7f7ff;
}

*+html #rp_status,#rp_street,#rp_state,#rp_postcode,#rp_baths,#rp_sqft,#rp_yearbuild,#rp_propertyfeatures,#rp_currencyid,#rp_price_total,#rp_listdate,#rp_mls,#rp_propertytype
{
	background-color:#f7f7ff;
}
/*
*html #rp_status,#rp_street,#rp_state,#rp_postcode,#rp_baths,#rp_sqft,#rp_yearbuild,#rp_propertyfeatures,#rp_currencyid,#rp_price_total,#rp_listdate,#rp_agentid,#rp_propertytype
{
	height:20px;
	line-height:20px;
	background-color:#f7f7ff;
}

*+html #rp_status,#rp_street,#rp_state,#rp_postcode,#rp_baths,#rp_sqft,#rp_yearbuild,#rp_propertyfeatures,#rp_currencyid,#rp_price_total,#rp_listdate,#rp_agentid,#rp_propertytype
{
	background-color:#f7f7ff;
}
*/
#rp_title_status,#rp_title_listingtype,#rp_title_street,#rp_title_city,#rp_title_state,#rp_title_country,#rp_title_postcode,#rp_title_beds,#rp_title_baths,#rp_title_garages,#rp_title_sqft,#rp_title_acres,#rp_title_yearbuild,#rp_title_neighborhood,#rp_title_currencyid,#rp_title_price_sqft,#rp_title_price_total,#rp_title_saled_price,#rp_title_listdate,#rp_title_saledate,#rp_title_mls,#rp_title_agentid,#rp_title_indetailtitle,#rp_title_propertytype
{
	float : left;
	margin: 3px 5px;
	/* color:#f17903; 
	font-weight:bold; */
	color:black;
	width:40%;
	font-family:Verdana;
}

#rp_content_status,#rp_content_listingtype,#rp_content_street,#rp_content_city,#rp_content_state,#rp_content_country,#rp_content_postcode,#rp_content_beds,#rp_content_baths,#rp_content_garages,#rp_content_sqft,#rp_content_acres,#rp_content_yearbuild,#rp_content_neighborhood,#rp_content_currencyid,#rp_content_price_sqft,#rp_content_price_total,#rp_content_saled_price,#rp_content_listdate,#rp_content_saledate,#rp_content_mls,#rp_content_agentid,#rp_content_indetailtitle,#rp_content_propertytype
{
	float : left;
	margin: 3px 0px;
	font-weight:bold;
	
	/* 
	width:60%; 
	font-style:italic;
	*/
	text-align:left;

}


/*
#rp_contacttitle
{
	border:4px solid #3387b1;
	
}
*/
#rp_content_contacttitle
{
	text-align:left;
	align:left;
	padding: 4px 0px 10px 35px;
	margin: 0px 0px 4px 0px;
	font-size: 14px;
	border-bottom: 1px solid #ccc;
	background: url(../../images/connect.gif) no-repeat;
	background-position:6px;
	font-weight:bold;
}

#rp_content_contactname,#rp_content_contactemail,#rp_content_contactphone
,#rp_content_contactsubject,#rp_content_contactmessage
{
	padding:4px 0px;
	font-size: 12px;
	
}
#rp_content_contactcheck
{
	padding:3px 0px;
	font-size: 12px;
	color:#177010;
}

#rp_submitcontact
{
	margin-top:10px;
}



/* end for google box */

#rp_ImageBig a
{
 color:blue;
}
/*
#realpressLeftDescription #rp_ImageArea a img,#realpressLeftDescription #rp_ImageArea img,#realpressLeftDescription #rp_ImageDiv a img,#realpressLeftDescription #rp_ImageDiv img
{
	margin:5px auto;
	padding: 5px auto;
	width: 250px;
	border: 1px solid #E5E5E5;
}
*/
<?php
require_once("../../../../../wp-config.php");
$m_nowTitle = get_option('real_titlefontcolor');
$m_real_featuresfont = get_option('real_featuresfont');
$m_real_featuresfontcolor = get_option('real_featuresfontcolor');


$m_real_titlefont = get_option('real_titlefont');
$m_real_titlefontsize = get_option('real_titlefontsize');
$m_real_titlefontcolor = get_option('real_titlefontcolor');

$m_real_pricefont = get_option('real_pricefont');
$m_real_linkcolor = get_option('real_linkcolor');

if (empty($m_real_featuresfont))
{
	
	$m_real_featuresfont = 'Arial,Black';
}
if (empty($m_real_featuresfontcolor))
{
	
	$m_real_featuresfontcolor = 'black';
}
if (empty($m_real_titlefont))
{
	
	$m_real_titlefont = 'Arial,Black';
}
if (empty($m_real_titlefontsize))
{
	
	$m_real_titlefontsize = '16px';
}
if (empty($m_real_titlefontcolor))
{
	
	$m_real_titlefontcolor = 'black';
}

if (empty($m_real_pricefont))
{
	
	$m_real_pricefont = '16px';
}
if (empty($m_real_linkcolor))
{
	
	$m_real_linkcolor = 'blue';
}


echo <<<CSSNOW
#realpressHouseDetails a,#realpressLeftDescription a
{
color:$m_real_linkcolor;
}
#rp_content_price_total
{
font-size: $m_real_pricefont;
color:red;
}
#rp_title,#rp_descriptionTitle
{
font-family: $m_real_titlefont;
font-size:$m_real_titlefontsize;
color : $m_real_titlefontcolor;
}
#rp_title_propertyfeatures,#rp_title_listingfeatures
{
	float : left;
	margin: 3px 5px;
	/* color:#f17903; 
	font-weight:bold; */	
	color:black;
	font-family:Verdana;

}

#rp_content_propertyfeatures,#rp_content_listingfeatures
{
	float : left;
	margin: 3px 5px;
	font-weight:bold;
	color:$m_real_featuresfontcolor;
	font-style:italic;
	/* width:60%; */
	text-align:left;
	font-family:$m_real_featuresfont;
}
CSSNOW;

global $wpdb,$table_prefix,$wp_version,$userdata,$current_user, $user_ID,$post,$wp_rewrite;
get_currentuserinfo();
$m_realpressMapCanvas = '#realpressMapCanvas';
$m_realInputSE = '#realInputSE';
$m_realInputSEh2 = '#realInputSE h2';
$m_realDirections = '#realDirections';

$m_table = $table_prefix."posts";
$m_sql = "select `id` from `".$m_table."` where `post_status` = 'publish'";
$m_result = $wpdb->get_results($m_sql,ARRAY_A);
if (!empty($m_result))
{
	foreach ($m_result as $m_nowcss)
	{
		$m_realpressMapCanvas .= ',#realpressMapCanvas'.$m_nowcss['id'];
		$m_realInputSE .= ',#realInputSE'.$m_nowcss['id'];
		$m_realInputSEh2 .= ',#realInputSE'.$m_nowcss['id'].' h2';
		$m_realDirections .= ',#realDirections'.$m_nowcss['id'];
	}
}
$m_realpressMapCanvas .='{margin:auto;padding:auto;height:400px;/* !!! width:570px;*/ width:98%; border: 2px solid #fff;}';
$m_realInputSE .= '{margin-top:15px;/* width:570px;!!! */ width:98%; height:480px;padding: 20px auto;margin: 20px auto;}';
$m_realInputSEh2 .= '{padding: 0;margin: 0 0 10px;font-size: 16px;color: #3387b1;text-align: left;}';
$m_realDirections .='{/* !!! width:570px;*/ width:98%;margin: 10px auto;}';
echo $m_realpressMapCanvas;
echo $m_realInputSE;
echo $m_realInputSEh2;
echo $m_realDirections;
?>