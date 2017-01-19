<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$social_media_tag = '';
$have_social_media = FALSE;

$rmd_social_media_facebook_link = get_option('rmd_social_media_facebook_link');
if(!empty($rmd_social_media_facebook_link)) {
	$social_media_tag .= '<a target="_blank" href="'.$rmd_social_media_facebook_link.'" ><div class="social-media"><i class="fa fa-facebook" aria-hidden="true"></i></div></a>';
	$have_social_media = TRUE;
}

$rmd_social_media_youtube_link = get_option('rmd_social_media_youtube_link');
if(!empty($rmd_social_media_youtube_link)) {
	$social_media_tag .= '<a target="_blank" href="'.$rmd_social_media_youtube_link.'" ><div class="social-media"><i class="fa fa-youtube-play" aria-hidden="true"></i></div></a>';
	$have_social_media = TRUE;
}

$rmd_social_media_twitter_link = get_option('rmd_social_media_twitter_link'); 
if(!empty($rmd_social_media_twitter_link)) {
	$social_media_tag .= '<a target="_blank" href="'.$rmd_social_media_twitter_link.'" ><div class="social-media"><i class="fa fa-twitter" aria-hidden="true"></i></div></a>';
	$have_social_media = TRUE;
}

$rmd_social_media_linkedin_link = get_option('rmd_social_media_linkedin_link');
if(!empty($rmd_social_media_linkedin_link)) {
	$social_media_tag .= '<a target="_blank" href="'.$rmd_social_media_linkedin_link.'" ><div class="social-media"><i class="fa fa-linkedin" aria-hidden="true"></i></div></a>';
	$have_social_media = TRUE;
}
 
$rmd_social_media_pinterest_link = get_option('rmd_social_media_pinterest_link'); 
if(!empty($rmd_social_media_pinterest_link)) {
	$social_media_tag .= '<a target="_blank" href="'.$rmd_social_media_pinterest_link.'" ><div class="social-media"><i class="fa fa-pinterest-p" aria-hidden="true"></i></div></a>';
	$have_social_media = TRUE;
}

$rmd_social_media_google_plus_link = get_option('rmd_social_media_google_plus_link'); 
if(!empty($rmd_social_media_google_plus_link)) {
	$social_media_tag .= '<a target="_blank" href="'.$rmd_social_media_google_plus_link.'" ><div class="social-media"><i class="fa fa-google-plus" aria-hidden="true"></i></div></a>';
	$have_social_media = TRUE;
}

$rmd_social_media_instagram_link = get_option('rmd_social_media_instagram_link'); 
if(!empty($rmd_social_media_instagram_link)) {
	$social_media_tag .= '<a target="_blank" href="'.$rmd_social_media_instagram_link.'" ><div class="social-media"><i class="fa fa-instagram" aria-hidden="true"></i></div></a>';
	$have_social_media = TRUE;
}

?>
<?php if($have_social_media): ?>
<div class="social-media-container" >
	<?php echo $social_media_tag; ?>
</div>
<?php endif; ?>










