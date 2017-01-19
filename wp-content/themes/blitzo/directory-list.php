<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Blitzo
 */

get_header(); ?>

<?php
global $wpdb;
$my_state = $_GET['state'];
$directories = $wpdb->get_results(
	$wpdb->prepare("
	SELECT * FROM wp_directory where state = %s",
	$my_state
	)
);

echo "<table>";
foreach($directories as $directory){
echo "<tr>";
echo "<td>".$directory->business_name."</td>";
echo "<td>".$directory->state."</td>";
echo "<td>".$directory->category."</td>";
echo "<td>".$directory->phone."</td>";
echo "</tr>";
}
echo "</table>";

?>

<?php 
get_footer();