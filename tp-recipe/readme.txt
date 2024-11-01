=== TP Recipe ===
Contributors: themepalace
Tags: Restaurant, Recipe, Ingredients, Ingredient quantity,
Donate link: http://themepalace.com
Requires at least: 4.5
Tested up to: 5.2
Stable tag: 1.1.3
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Allow user to add recipe and its ingredients with its quantity.


== Description ==
This Recipe provides you Recipe and Ingredient Post type with its essential fields. This Plugin provides you an Food Item Recipe and it's ingredients forms to uplift your Restaurant Website with your prominent item recipes. Recipe and Ingredients will be added in Dashboard Menu.

= Steps =
 1. Create Ingredients
 	* Title
 	* Featured Image
 2. Create Recipe
 	* Title
 	* Description
 	* Featured Image
 	* Recipe Details
 	* Ingredients Details

 = Hooks =
 	do_action( 'tp_recipe_prep_time_action' ); // Display Recipe Preparation Time
 	do_action( 'tp_recipe_cook_time_action' ); // Display Recipe Cooking Time
 	do_action( 'tp_recipe_ready_time_action' ); // Display Recipe Ready Time
 	do_action( 'tp_recipe_shop_link_action' ); // Display Recipe Shop Page Link
 	do_action( 'tp_recipe_ingredients_action' ); // Display Recipe Ingredients and its Quantity

= Customization and Flexibility =
TP Recipe offers you hooks that helps you to customize the output structure as your need.
Template Overwrite Method:
1. Create tp-recipe folder in root folder
2. Create tp-archive-recipe.php file to create recipe archive page
3. Create tp-single-recipe.php file to create recipe single page


== Installation ==
= Using The WordPress Dashboard =
* Navigate to the 'Add New' in the plugins dashboard
* Search for TP Recipe
* Click Install Now
* Activate the plugin on the Plugin dashboard
= Uploading in WordPress Dashboard =
* Navigate to the 'Add New' in the plugins dashboard
* Navigate to the 'Upload' area
* Select tp-recipe.zip from your computer
* Click 'Install Now'
* Activate the plugin in the Plugin dashboard
= Using FTP =
* Download tp-recipe.zip
* Extract the tp-recipe directory to your computer
* Upload the tp-recipe directory to the /wp-content/plugins/directory
* Activate the plugin in the Plugin dashboard


 == Documentation ==

== Screenshots ==

1. Recipe Details.
2. Recipe Ingrdients List.
3. Recipe Ingredients.

== Frequently Asked Questions ==
= There is something cool you could add... =


== Changelog ==

= 1.1.3 =
* Tested upto 5.2

= 1.1.2 =
* Tested upto 4.9.8
* Resolved Ingredients issue in Recipe page

= 1.1.1 =
* Tested upto 4.9.4

= 1.1 =
* added target attribute in anchor tag for buy now button in single page

= 1.0 =
* Initial release.


== Upgrade Notice ==

= 1.0 =
* Initial release.
