<?php
global $wpdb;
$my_state = "QLD";
$my_state = 'state';
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

<h1>Blitzo Studio</h1>
<form method="GET" id="searchform" name="searchform" action="">
<p>
<label>Category:</label> <input type="text" name="category" id="category" value="" />
</p>
<p>
<label>State:</label> <input type="text" name="state" id="state" value="QLD" />
</p>
<input type="submit" id="searchsubmit" value="GO" />
</form>