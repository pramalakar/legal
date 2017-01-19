<?php
/**
 * 	Search Form
 *
 * 	@package Blitzo
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>"> 
    <div class="input-group">
		<input type="search" class="form-control"  value="<?php echo get_search_query() ?>" name="s" placeholder="Search for...">
		<span class="input-group-btn">
		<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		</span>
    </div><!-- /input-group -->
</form> 