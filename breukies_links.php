<?php
/*
Plugin Name: Breukie's Links Widget
Description: Breukie's Links Widget is a wordPress links widget, to replace the standard links widget by Automattic. This widget displays links using the wp_list_bookmarks function, utilizes most available parameters. You can also set up to 9 intances of this widget in your sidebar(s). Only for WP 2.1 and higher.
Author: Arnold Breukhoven
Version: 2.5
Author URI: http://www.arnoldbreukhoven.nl
Plugin URI: http://www.arnoldbreukhoven.nl/2007/02/breukies-links-widget-for-wordpress
*/

function widget_breukieslinks_init()
{
	// Check for the required API functions
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
		return;

function widget_breukieslinks($args, $number = 1) {
	extract($args);
	$options = get_option('widget_breukieslinks');
	$title = $options[$number]['title'];
	$orderby = $options[$number]['orderby'];
	$order = $options[$number]['order'];
	$limit = $options[$number]['limit'];
	$category_single = $options[$number]['category_single'];
	$category_kies = $options[$number]['category_kies'];
	$category_name = $options[$number]['category_name'];
	$hide_invisible = $options[$number]['hide_invisible'];
	$show_updated = $options[$number]['show_updated'];
	$categorize = $options[$number]['categorize'];
	$title_li = $options[$number]['title_li'];
	$title_before = $options[$number]['title_before'];
	$title_after = $options[$number]['title_after'];
	$category_orderby = $options[$number]['category_orderby'];
	$category_order = $options[$number]['category_order'];
	$between = $options[$number]['between'];
	$category_before = $options[$number]['category_before'];
	$category_after = $options[$number]['category_after'];
	$show_rating = $options[$number]['show_rating'];
	$show_images = $options[$number]['show_images'];
	$show_description = $options[$number]['show_description'];
	$include = $options[$number]['include'];
	$exclude = $options[$number]['exclude'];
?>
		<?php echo $before_widget; ?>
			<?php $title ? print($before_title . $title . $after_title) : null; ?>
			<div class="breukieslinkswidget">
<?php echo $category?>
<?php
// Check of ze gevuld zijn
	$title = $title != '' ? $title : '';
	$orderby = $orderby != '' ? $orderby : 'name';
	$order = $order != '' ? $order : 'ASC';
	$limit = $limit != '' ? $limit : -1;
	$category_kies = $category_kies != '' ? $category_kies : ( $category_single != -1 ? $category_single : '');
	$category_name = $category_name != '' ? $category_name : '';
	$hide_invisible = $hide_invisible != '' ? $hide_invisible : '1';
	$show_updated = $show_updated != '' ? $show_updated : '0';
	$categorize = $categorize != '' ? $categorize : '1';
	$title_li = $title_li != '' ? $title_li : __('Bookmarks');
	$title_before = $title_before != '' ? $title_before : '<h2>';
	$title_after = $title_after != '' ? $title_after : '</h2>';
	$between = $between != '' ? $between : '<br>';
	$category_orderby = $category_orderby != '' ? $category_orderby : 'name';
	$category_order = $category_order != '' ? $category_order : 'ASC';
	$category_before = $category_before != '' ? $category_before : '<li>';
	$category_after = $category_after != '' ? $category_after : '</li>';
	$show_rating = $show_rating != '' ? $show_rating : '0';
	$show_images = $show_images != '' ? $show_images : '1';
	$show_description = $show_description != '' ? $show_description : '0';
	$include = $include != '' ? $include : '';
	$exclude = $exclude != '' ? $exclude : '';

// Pak de links.
		wp_list_bookmarks(array('orderby' => '' . $orderby . '', 'order' => '' . $order . '', 'limit' => $limit, 'category' => '' . $category_kies . '',
'category_name' => '' . $category_name . '', 'hide_invisible' => $hide_invisible, 'show_updated' => $show_updated,
'categorize' => $categorize, 'title_li' => $title_li, 'title_before' => '' . $title_before . '', 'title_after' => '' . $title_after . '',
'category_orderby' => '' . $category_orderby . '', 'category_order' => '' . $category_order . '', 'between' => '' . $between . '',
'category_before' => '' . $category_before . '', 'category_after' => '' . $category_after . '', 'show_rating' => '' . $show_rating . '', 'show_images' => '' . $show_images . '', 'show_description' => '' . $show_description . '', 'include' => '' . $include . '', 'exclude' => '' . $exclude . ''));
?>
			</div>
		<?php echo $after_widget; ?>
<?php
}

function widget_breukieslinks_control($number) {
	global $wpdb;
	$options = $newoptions = get_option('widget_breukieslinks');
	if ( $_POST["breukieslinks-submit-$number"] ) {
		$newoptions[$number]['title'] = strip_tags(stripslashes($_POST["breukieslinks-title-$number"]));
		$newoptions[$number]['orderby'] = stripslashes($_POST["breukieslinks-orderby-$number"]);
		$newoptions[$number]['order'] = stripslashes($_POST["breukieslinks-order-$number"]);
		$newoptions[$number]['limit'] = stripslashes($_POST["breukieslinks-limit-$number"]);
		$newoptions[$number]['category_single'] = stripslashes($_POST["breukieslinks-category_single-$number"]);
		$newoptions[$number]['category_kies'] = stripslashes($_POST["breukieslinks-category_kies-$number"]);
		$newoptions[$number]['category_name'] = stripslashes($_POST["breukieslinks-category_name-$number"]);
		$newoptions[$number]['hide_invisible'] = stripslashes($_POST["breukieslinks-hide_invisible-$number"]);
		$newoptions[$number]['show_updated'] = stripslashes($_POST["breukieslinks-show_updated-$number"]);
		$newoptions[$number]['categorize'] = stripslashes($_POST["breukieslinks-categorize-$number"]);
		$newoptions[$number]['title_li'] = stripslashes($_POST["breukieslinks-title_li-$number"]);
		$newoptions[$number]['title_before'] = stripslashes($_POST["breukieslinks-title_before-$number"]);
		$newoptions[$number]['title_after'] = stripslashes($_POST["breukieslinks-title_after-$number"]);
		$newoptions[$number]['category_orderby'] = stripslashes($_POST["breukieslinks-category_orderby-$number"]);
		$newoptions[$number]['category_order'] = stripslashes($_POST["breukieslinks-category_order-$number"]);
		$newoptions[$number]['between'] = stripslashes($_POST["breukieslinks-between-$number"]);
		$newoptions[$number]['category_before'] = stripslashes($_POST["breukieslinks-category_before-$number"]);
		$newoptions[$number]['category_after'] = stripslashes($_POST["breukieslinks-category_after-$number"]);
		$newoptions[$number]['show_rating'] = stripslashes($_POST["breukieslinks-show_rating-$number"]);
		$newoptions[$number]['show_images'] = stripslashes($_POST["breukieslinks-show_images-$number"]);
		$newoptions[$number]['show_description'] = stripslashes($_POST["breukieslinks-show_description-$number"]);
		$newoptions[$number]['include'] = stripslashes($_POST["breukieslinks-include-$number"]);
		$newoptions[$number]['exclude'] = stripslashes($_POST["breukieslinks-exclude-$number"]);

	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_breukieslinks', $options);
	}
	$title = htmlspecialchars($options[$number]['title'], ENT_QUOTES);
	$orderby = htmlspecialchars($options[$number]['orderby'], ENT_QUOTES);
	$order = htmlspecialchars($options[$number]['order'], ENT_QUOTES);
	$limit = htmlspecialchars($options[$number]['limit'], ENT_QUOTES);
	$category_single = htmlspecialchars($options[$number]['category_single'], ENT_QUOTES);
	$category_kies = htmlspecialchars($options[$number]['category_kies'], ENT_QUOTES);
	$category_name = htmlspecialchars($options[$number]['category_name'], ENT_QUOTES);
	$hide_invisible = htmlspecialchars($options[$number]['hide_invisible'], ENT_QUOTES);
	$show_updated = htmlspecialchars($options[$number]['show_updated'], ENT_QUOTES);
	$categorize = htmlspecialchars($options[$number]['categorize'], ENT_QUOTES);
	$title_li = htmlspecialchars($options[$number]['title_li'], ENT_QUOTES);
	$title_before = htmlspecialchars($options[$number]['title_before'], ENT_QUOTES);
	$title_after = htmlspecialchars($options[$number]['title_after'], ENT_QUOTES);
	$category_orderby = htmlspecialchars($options[$number]['category_orderby'], ENT_QUOTES);
	$category_order = htmlspecialchars($options[$number]['category_order'], ENT_QUOTES);
	$between = htmlspecialchars($options[$number]['between'], ENT_QUOTES);
	$category_before = htmlspecialchars($options[$number]['category_before'], ENT_QUOTES);
	$category_after = htmlspecialchars($options[$number]['category_after'], ENT_QUOTES);
	$show_rating = htmlspecialchars($options[$number]['show_rating'], ENT_QUOTES);
	$show_images = htmlspecialchars($options[$number]['show_images'], ENT_QUOTES);
	$show_description = htmlspecialchars($options[$number]['show_description'], ENT_QUOTES);
	$include = htmlspecialchars($options[$number]['include'], ENT_QUOTES);
	$exclude = htmlspecialchars($options[$number]['exclude'], ENT_QUOTES);

?>
<center>Check <a href="http://codex.wordpress.org/wp_list_bookmarks" target="_blank">wp_list_bookmarks</a> for help with parameters.</center>
<table align="center" cellpadding="1" cellspacing="1" width="400">
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Title Widget:
</td>
<td align="left" valign="middle">
<input style="width: 300px;" id="breukieslinks-title-<?php echo "$number"; ?>" name="breukieslinks-title-<?php echo "$number"; ?>" type="breukieslinks" value="<?php echo $title; ?>" />
</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Order By:
</td>
<td align="left" valign="middle" nowrap="nowrap">
<select id="breukieslinks-orderby-<?php echo "$number"; ?>" name="breukieslinks-orderby-<?php echo "$number"; ?>" value="<?php echo $options[$number]['orderby']; ?>">
<?php echo "<option value=\"\">Select</option>"; ?>
<?php echo "<option value=\"id\"" . ($options[$number]['orderby']=='id' ? " selected='selected'" : '') .">ID</option>"; ?>
<?php echo "<option value=\"url\"" . ($options[$number]['orderby']=='url' ? " selected='selected'" : '') .">Url</option>"; ?>
<?php echo "<option value=\"target\"" . ($options[$number]['orderby']=='target' ? " selected='selected'" : '') .">Target</option>"; ?>
<?php echo "<option value=\"description\"" . ($options[$number]['orderby']=='description' ? " selected='selected'" : '') .">Description</option>"; ?>
<?php echo "<option value=\"owner\"" . ($options[$number]['orderby']=='owner' ? " selected='selected'" : '') .">Owner</option>"; ?>
<?php echo "<option value=\"rating\"" . ($options[$number]['orderby']=='rating' ? " selected='selected'" : '') .">Rating</option>"; ?>
<?php echo "<option value=\"updated\"" . ($options[$number]['orderby']=='updated' ? " selected='selected'" : '') .">Updated</option>"; ?>
<?php echo "<option value=\"rel\"" . ($options[$number]['orderby']=='rel' ? " selected='selected'" : '') .">Rel</option>"; ?>
<?php echo "<option value=\"notes\"" . ($options[$number]['orderby']=='notes' ? " selected='selected'" : '') .">Notes</option>"; ?>
<?php echo "<option value=\"rss\"" . ($options[$number]['orderby']=='rss' ? " selected='selected'" : '') .">RSS</option>"; ?>
<?php echo "<option value=\"length\"" . ($options[$number]['orderby']=='length' ? " selected='selected'" : '') .">Length</option>"; ?>
<?php echo "<option value=\"rand\"" . ($options[$number]['orderby']=='rand' ? " selected='selected'" : '') .">Random</option>"; ?>
</select>&nbsp; <select id="breukieslinks-order-<?php echo "$number"; ?>" name="breukieslinks-order-<?php echo "$number"; ?>" value="<?php echo $options[$number]['order']; ?>">
<?php echo "<option value=\"\">Select</option>"; ?>
<?php echo "<option value=\"ASC\"" . ($options[$number]['order']=='ASC' ? " selected='selected'" : '') .">ASC</option>"; ?>
<?php echo "<option value=\"DESC\"" . ($options[$number]['order']=='DESC' ? " selected='selected'" : '') .">DESC</option>"; ?>
</select>&nbsp; Limit: <input style="width: 30px;" id="breukieslinks-limit-<?php echo "$number"; ?>" name="breukieslinks-limit-<?php echo "$number"; ?>" type="breukieslinks" value="<?php echo $limit; ?>" />
</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Categorize:
</td>
<td align="left" valign="middle">
<select id="breukieslinks-categorize-<?php echo "$number"; ?>" name="breukieslinks-categorize-<?php echo "$number"; ?>" value="<?php echo $options[$number]['categorize']; ?>">
<?php echo "<option value=\"\">Select</option>"; ?>
<?php echo "<option value=\"1\"" . ($options[$number]['categorize']=='1' ? " selected='selected'" : '') .">Yes</option>"; ?>
<?php echo "<option value=\"0\"" . ($options[$number]['categorize']=='0' ? " selected='selected'" : '') .">No</option>"; ?>
</select>
</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Single Category:
</td>
<td align="left" valign="middle" nowrap="nowrap">
<select id="breukieslinks-category_single-<?php echo "$number"; ?>" name="breukieslinks-category_single-<?php echo "$number"; ?>" value="<?php echo $options[$number]['category_single']; ?>">
<?php
$cat_id = -1;
echo "<option value=\"-1\">Select</option>";
$results = $wpdb->get_results( "SELECT cat_ID, cat_name FROM $wpdb->categories" );
	if( $results )
	{
		foreach ( $results as $result )
		{
			$cat_id = $result->cat_ID;
			$cat_name = $result->cat_name;
			echo "<option value=\"$cat_id\"" . ($options[$number]['category_single']==$cat_id ? " selected='selected'" : '') .">$cat_name</option>";
		}
	}
?>
			</select>

</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Category ID('s):
</td>
<td align="left" valign="middle">
<input style="width: 300px;" id="breukieslinks-category_kies-<?php echo "$number"; ?>" name="breukieslinks-category_kies-<?php echo "$number"; ?>" type="breukieslinks" value="<?php echo $category_kies; ?>" />
</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Category Name:
</td>
<td align="left" valign="middle">
<input style="width: 300px;" id="breukieslinks-category_name-<?php echo "$number"; ?>" name="breukieslinks-category_name-<?php echo "$number"; ?>" type="breukieslinks" value="<?php echo $category_name; ?>" />
</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Category Order By:
</td>
<td align="left" valign="middle" nowrap="nowrap">
<select id="breukieslinks-category_orderby-<?php echo "$number"; ?>" name="breukieslinks-category_orderby-<?php echo "$number"; ?>" value="<?php echo $options[$number]['category_orderby']; ?>">
<?php echo "<option value=\"\">Select</option>"; ?>
<?php echo "<option value=\"name\"" . ($options[$number]['category_orderby']=='name' ? " selected='selected'" : '') .">Name</option>"; ?>
<?php echo "<option value=\"id\"" . ($options[$number]['category_orderby']=='id' ? " selected='selected'" : '') .">ID</option>"; ?>
</select>&nbsp; <select id="breukieslinks-category_order-<?php echo "$number"; ?>" name="breukieslinks-category_order-<?php echo "$number"; ?>" value="<?php echo $options[$number]['category_order']; ?>">
<?php echo "<option value=\"\">Select</option>"; ?>
<?php echo "<option value=\"ASC\"" . ($options[$number]['category_order']=='ASC' ? " selected='selected'" : '') .">ASC</option>"; ?>
<?php echo "<option value=\"DESC\"" . ($options[$number]['category_order']=='DESC' ? " selected='selected'" : '') .">DESC</option>"; ?>
</select></td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Include:
</td>
<td align="left" valign="middle">
<input style="width: 80px;" id="breukieslinks-include-<?php echo "$number"; ?>" name="breukieslinks-include-<?php echo "$number"; ?>" type="breukieslinks" value="<?php echo $include; ?>" />&nbsp; Exclude: <input style="width: 80px;" id="breukieslinks-exclude-<?php echo "$number"; ?>" name="breukieslinks-exclude-<?php echo "$number"; ?>" type="breukieslinks" value="<?php echo $exclude; ?>" />
</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Category Before:
</td>
<td align="left" valign="middle">
<input style="width: 80px;" id="breukieslinks-category_before-<?php echo "$number"; ?>" name="breukieslinks-category_before-<?php echo "$number"; ?>" type="breukieslinks" value="<?php echo $category_before; ?>" />&nbsp; Category After: <input style="width: 80px;" id="breukieslinks-category_after-<?php echo "$number"; ?>" name="breukieslinks-category_after-<?php echo "$number"; ?>" type="breukieslinks" value="<?php echo $category_after; ?>" />
</td>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Title Li:
</td>
<td align="left" valign="middle">
<input style="width: 300px;" id="breukieslinks-title_li-<?php echo "$number"; ?>" name="breukieslinks-title_li-<?php echo "$number"; ?>" type="breukieslinks" value="<?php echo $title_li; ?>" />
</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Title Before:
</td>
<td align="left" valign="middle">
<input style="width: 80px;" id="breukieslinks-title_before-<?php echo "$number"; ?>" name="breukieslinks-title_before-<?php echo "$number"; ?>" type="breukieslinks" value="<?php echo $title_before; ?>" />&nbsp; Title After: <input style="width: 80px;" id="breukieslinks-title_after-<?php echo "$number"; ?>" name="breukieslinks-title_after-<?php echo "$number"; ?>" type="breukieslinks" value="<?php echo $title_after; ?>" /></td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Between:
</td>
<td align="left" valign="middle">
<input style="width: 300px;" id="breukieslinks-between-<?php echo "$number"; ?>" name="breukieslinks-between-<?php echo "$number"; ?>" type="breukieslinks" value="<?php echo $between; ?>" />
</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Hide Invincible:
</td>
<td align="left" valign="middle">
<select id="breukieslinks-hide_invisible-<?php echo "$number"; ?>" name="breukieslinks-hide_invisible-<?php echo "$number"; ?>" value="<?php echo $options[$number]['hide_invisible']; ?>">
<?php echo "<option value=\"\">Select</option>"; ?>
<?php echo "<option value=\"1\"" . ($options[$number]['hide_invisible']=='1' ? " selected='selected'" : '') .">Yes</option>"; ?>
<?php echo "<option value=\"0\"" . ($options[$number]['hide_invisible']=='0' ? " selected='selected'" : '') .">No</option>"; ?>
</select>
</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Description:
</td>
<td align="left" valign="middle">
<select id="breukieslinks-show_description-<?php echo "$number"; ?>" name="breukieslinks-show_description-<?php echo "$number"; ?>" value="<?php echo $options[$number]['show_description']; ?>">
<?php echo "<option value=\"\">Select</option>"; ?>
<?php echo "<option value=\"1\"" . ($options[$number]['show_description']=='1' ? " selected='selected'" : '') .">Yes</option>"; ?>
<?php echo "<option value=\"0\"" . ($options[$number]['show_description']=='0' ? " selected='selected'" : '') .">No</option>"; ?>
</select>
</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Images:
</td>
<td align="left" valign="middle">
<select id="breukieslinks-show_images-<?php echo "$number"; ?>" name="breukieslinks-show_images-<?php echo "$number"; ?>" value="<?php echo $options[$number]['show_images']; ?>">
<?php echo "<option value=\"\">Select</option>"; ?>
<?php echo "<option value=\"1\"" . ($options[$number]['show_images']=='1' ? " selected='selected'" : '') .">Yes</option>"; ?>
<?php echo "<option value=\"0\"" . ($options[$number]['show_images']=='0' ? " selected='selected'" : '') .">No</option>"; ?>
</select>
</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Rating:
</td>
<td align="left" valign="middle">
<select id="breukieslinks-show_rating-<?php echo "$number"; ?>" name="breukieslinks-show_rating-<?php echo "$number"; ?>" value="<?php echo $options[$number]['show_rating']; ?>">
<?php echo "<option value=\"\">Select</option>"; ?>
<?php echo "<option value=\"1\"" . ($options[$number]['show_rating']=='1' ? " selected='selected'" : '') .">Yes</option>"; ?>
<?php echo "<option value=\"0\"" . ($options[$number]['show_rating']=='0' ? " selected='selected'" : '') .">No</option>"; ?>
</select>
</td>
</tr>
<tr>
<td align="left" valign="middle" width="90" nowrap="nowrap">
Updated:
</td>
<td align="left" valign="middle">
<select id="breukieslinks-show_updated-<?php echo "$number"; ?>" name="breukieslinks-show_updated-<?php echo "$number"; ?>" value="<?php echo $options[$number]['show_updated']; ?>">
<?php echo "<option value=\"\">Select</option>"; ?>
<?php echo "<option value=\"1\"" . ($options[$number]['show_updated']=='1' ? " selected='selected'" : '') .">Yes</option>"; ?>
<?php echo "<option value=\"0\"" . ($options[$number]['show_updated']=='0' ? " selected='selected'" : '') .">No</option>"; ?>
</select>
</td>
</tr>
</table>
<center>Breukie's Links Widget is made by: <a href="http://www.arnoldbreukhoven.nl" target="_blank">Arnold Breukhoven</a>.</center>
			<input type="hidden" id="breukieslinks-submit-<?php echo "$number"; ?>" name="breukieslinks-submit-<?php echo "$number"; ?>" value="1" />
<?php
}

function widget_breukieslinks_setup() {
	$options = $newoptions = get_option('widget_breukieslinks');
	if ( isset($_POST['breukieslinks-number-submit']) ) {
		$number = (int) $_POST['breukieslinks-number'];
		if ( $number > 9 ) $number = 9;
		if ( $number < 1 ) $number = 1;
		$newoptions['number'] = $number;
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_breukieslinks', $options);
		widget_breukieslinks_register($options['number']);
	}
}

function widget_breukieslinks_page() {
	$options = $newoptions = get_option('widget_breukieslinks');
?>
	<div class="wrap">
		<form method="POST">
			<h2>Breukie's Links Widgets</h2>
			<p style="line-height: 30px;"><?php _e('How many Breukie\'s Links widgets would you like?'); ?>
			<select id="breukieslinks-number" name="breukieslinks-number" value="<?php echo $options['number']; ?>">
<?php for ( $i = 1; $i < 10; ++$i ) echo "<option value='$i' ".($options['number']==$i ? "selected='selected'" : '').">$i</option>"; ?>
			</select>
			<span class="submit"><input type="submit" name="breukieslinks-number-submit" id="breukieslinks-number-submit" value="<?php _e('Save'); ?>" /></span></p>
		</form>
	</div>
<?php
}

function widget_breukieslinks_register() {
	$options = get_option('widget_breukieslinks');
	$number = $options['number'];
	if ( $number < 1 ) $number = 1;
	if ( $number > 9 ) $number = 9;
	for ($i = 1; $i <= 9; $i++) {
		$name = array('Breukie\'s Links %s', null, $i);
		register_sidebar_widget($name, $i <= $number ? 'widget_breukieslinks' : /* unregister */ '', '', $i);
		register_widget_control($name, $i <= $number ? 'widget_breukieslinks_control' : /* unregister */ '', 460, 580, $i);
	}
	add_action('sidebar_admin_setup', 'widget_breukieslinks_setup');
	add_action('sidebar_admin_page', 'widget_breukieslinks_page');
}
// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
widget_breukieslinks_register();
}

// Tell Dynamic Sidebar about our new widget and its control
add_action('plugins_loaded', 'widget_breukieslinks_init');

?>
