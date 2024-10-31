<?php
/**
 * @package Scroll Tool
 */
/*
Plugin Name: Scroll Tool
Plugin URI: https://wordpress.org/plugins/scroll-tool/
Description: Allows to create scroll tool (button or sidebar) for your blog.
Author: fractal512
Version: 1.3
Author URI: https://profiles.wordpress.org/fractal512/
*/

// namespace "lloo" will be used for this plugin
// scroll-tool admin's panel

function lloo_echo_interface(){
if(isset($_POST['scroll_tool'])){
$lloo_op = lloo_get_options($_POST['scroll_tool']);
$lloo_updated = update_option('lloo_options', serialize($lloo_op));
}
else
{
$lloo_op = unserialize(get_option('lloo_options'));
}
foreach($lloo_op as $key => $value){
$lloo_op[$key] = stripslashes(htmlspecialchars($value, ENT_QUOTES));
}
?>
<h2>Scroll tool</h2>
<?php
if (isset($lloo_updated) && $lloo_updated == true) {
?>
<div class="updated settings-error" id="setting-error-settings_updated"> 
<p><strong>Settings saved.</strong></p></div><br />
<?php } ?>
<form method="post" name="lloo_form">
<?php
if (function_exists ('wp_nonce_field') )
	{
		wp_nonce_field('lloo_setup_form', 'lloo_wpnonce');
	}
?>
<table class="lloo-form-table">
  <tr>
    <th scope="row">Type:</th>
    <td><input type="radio" id="scroll-button" class="scroll-type" name="scroll_tool[type]" value="button" <?php checked( $lloo_op['type'], 'button' ); ?> /> Button</td>
    <td><input type="radio" id="scroll-sidebar" class="scroll-type" name="scroll_tool[type]" value="sidebar" <?php checked( $lloo_op['type'], 'sidebar' ); ?> /> Sidebar</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Size:</th>
    <td>Width:<input type="button" value="-" class="qtyminus" field="scroll-width" /><input type="text" id="scroll-width" name="scroll_tool[width]" value="<?php echo $lloo_op['width']; ?>" size="2" maxlength="2" /><input type="button" value="+" class="qtyplus" field="scroll-width" />px.</td>
    <td>Height:<input type="button" value="-" class="qtyminus scroll-height" field="scroll-height" /><input type="text" id="scroll-height" name="scroll_tool[height]" class="scroll-height" value="<?php echo $lloo_op['height']; ?>" size="2" maxlength="2" /><input type="button" value="+" class="qtyplus scroll-height" field="scroll-height" />px.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Position:</th>
    <td><input type="radio" id="scroll-left" class="scroll-button-position" name="scroll_tool[button_position]" value="left" <?php checked( $lloo_op['button_position'], 'left' ); ?> /> Left<br /><br /><input type="radio" id="scroll-right" class="scroll-button-position" name="scroll_tool[button_position]" value="right" <?php checked( $lloo_op['button_position'], 'right' ); ?> /> Right</td>
    <td><input type="radio" id="scroll-leftbottom" class="scroll-button-position" name="scroll_tool[button_position]" value="leftbottom" <?php checked( $lloo_op['button_position'], 'leftbottom' ); ?> /> Left Bottom<br /><br /><input type="radio" id="scroll-middlebottom" class="scroll-button-position" name="scroll_tool[button_position]" value="middlebottom" <?php checked( $lloo_op['button_position'], 'middlebottom' ); ?> /> Middle Bottom<br /><br /><input type="radio" id="scroll-rightbottom" class="scroll-button-position" name="scroll_tool[button_position]" value="rightbottom" <?php checked( $lloo_op['button_position'], 'rightbottom' ); ?> /> Right Bottom</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Indents:</th>
    <td>Left:<input type="button" value="-" class="qtyminus scroll-left-indent" field="scroll-left-indent" /><input type="text" id="scroll-left-indent" class="scroll-left-indent" name="scroll_tool[left_indent]" value="<?php echo $lloo_op['left_indent']; ?>" size="2" maxlength="2" /><input type="button" value="+" class="qtyplus scroll-left-indent" field="scroll-left-indent" />px.</td>
    <td>Bottom:<input type="button" value="-" class="qtyminus scroll-bottom-indent" field="scroll-bottom-indent" /><input type="text" id="scroll-bottom-indent" class="scroll-bottom-indent" name="scroll_tool[bottom_indent]" value="<?php echo $lloo_op['bottom_indent']; ?>" size="2" maxlength="2" /><input type="button" value="+" class="qtyplus scroll-bottom-indent" field="scroll-bottom-indent" />px.</td>
    <td>Right:<input type="button" value="-" class="qtyminus scroll-right-indent" field="scroll-right-indent" /><input type="text" id="scroll-right-indent" class="scroll-right-indent" name="scroll_tool[right_indent]" value="<?php echo $lloo_op['right_indent']; ?>" size="2" maxlength="2" /><input type="button" value="+" class="qtyplus scroll-right-indent" field="scroll-right-indent" />px.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Arrows (PNG):</th>
    <td colspan="4" class="arrows">
						<div class="arrow-couple">
						<img src="<?php $pluginUrl = plugin_dir_url( __FILE__ ); echo $pluginUrl; ?>img/up-1.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="1" <?php checked( $lloo_op['button_arrow'], '1' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-2.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="2" <?php checked( $lloo_op['button_arrow'], '2' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-3.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="3" <?php checked( $lloo_op['button_arrow'], '3' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-4.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="4" <?php checked( $lloo_op['button_arrow'], '4' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-5.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="5" <?php checked( $lloo_op['button_arrow'], '5' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-6.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="6" <?php checked( $lloo_op['button_arrow'], '6' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-7.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="7" <?php checked( $lloo_op['button_arrow'], '7' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-8.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="8" <?php checked( $lloo_op['button_arrow'], '8' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-9.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="9" <?php checked( $lloo_op['button_arrow'], '9' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-10.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="10" <?php checked( $lloo_op['button_arrow'], '10' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-11.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="11" <?php checked( $lloo_op['button_arrow'], '11' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-12.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="12" <?php checked( $lloo_op['button_arrow'], '12' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-13.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="13" <?php checked( $lloo_op['button_arrow'], '13' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-14.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="14" <?php checked( $lloo_op['button_arrow'], '14' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-15.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="15" <?php checked( $lloo_op['button_arrow'], '15' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-16.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="16" <?php checked( $lloo_op['button_arrow'], '16' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-17.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="17" <?php checked( $lloo_op['button_arrow'], '17' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-18.png" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="18" <?php checked( $lloo_op['button_arrow'], '18' ); ?> />
						</div></td>
  </tr>
  <tr>
    <th scope="row">Arrows (SVG):</th>
    <td colspan="4" class="arrows">
						<div class="arrow-couple">
						<img src="<?php $pluginUrl = plugin_dir_url( __FILE__ ); echo $pluginUrl; ?>img/up-19.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="19" <?php checked( $lloo_op['button_arrow'], '19' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-20.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="20" <?php checked( $lloo_op['button_arrow'], '20' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-21.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="21" <?php checked( $lloo_op['button_arrow'], '21' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-22.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="22" <?php checked( $lloo_op['button_arrow'], '22' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-23.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="23" <?php checked( $lloo_op['button_arrow'], '23' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-24.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="24" <?php checked( $lloo_op['button_arrow'], '24' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-25.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="25" <?php checked( $lloo_op['button_arrow'], '25' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-26.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="26" <?php checked( $lloo_op['button_arrow'], '26' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-27.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="27" <?php checked( $lloo_op['button_arrow'], '27' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-28.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="28" <?php checked( $lloo_op['button_arrow'], '28' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-29.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="29" <?php checked( $lloo_op['button_arrow'], '29' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-30.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="30" <?php checked( $lloo_op['button_arrow'], '30' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-31.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="31" <?php checked( $lloo_op['button_arrow'], '31' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-32.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="32" <?php checked( $lloo_op['button_arrow'], '32' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-33.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="33" <?php checked( $lloo_op['button_arrow'], '33' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-34.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="34" <?php checked( $lloo_op['button_arrow'], '34' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-35.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="35" <?php checked( $lloo_op['button_arrow'], '35' ); ?> />
						</div>
						<div class="arrow-couple">
						<img src="<?php echo $pluginUrl; ?>img/up-36.svg" />
						<input type="radio" class="scroll-button-arrow" name="scroll_tool[button_arrow]" value="36" <?php checked( $lloo_op['button_arrow'], '36' ); ?> />
						</div></td>
  </tr>
  <tr>
    <th scope="row">Labels:</th>
    <td><input type="checkbox" id="scroll-display-labels" name="scroll_tool[display_labels]" value="1" <?php checked( $lloo_op['display_labels'], '1' ); ?> /> display labels</td>
    <td>Text&nbsp;&quot;Up&quot;:<input type="text" id="scroll-text-up" name="scroll_tool[up]" value="<?php echo $lloo_op['up']; ?>" size="7" /></td>
    <td>Text&nbsp;&quot;Down&quot;:<input type="text" id="scroll-text-down" name="scroll_tool[down]" value="<?php echo $lloo_op['down']; ?>" size="7" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Font:</th>
    <td>Size:<select name="scroll_tool[text_size]" id="scroll-text-size" style="width:80px;">
												<option value="8" <?php selected($lloo_op['text_size'], '8'); ?>>8</option>
												<option value="10" <?php selected($lloo_op['text_size'], '10'); ?>>10</option>
												<option value="12" <?php selected($lloo_op['text_size'], '12'); ?>>12</option>
												<option value="14" <?php selected($lloo_op['text_size'], '14'); ?>>14</option>
												<option value="16" <?php selected($lloo_op['text_size'], '16'); ?>>16</option>
												<option value="18" <?php selected($lloo_op['text_size'], '18'); ?>>18</option>
												<option value="20" <?php selected($lloo_op['text_size'], '20'); ?>>20</option>
												<option value="22" <?php selected($lloo_op['text_size'], '22'); ?>>22</option>
												<option value="24" <?php selected($lloo_op['text_size'], '24'); ?>>24</option>
												<option value="26" <?php selected($lloo_op['text_size'], '26'); ?>>26</option>
												<option value="28" <?php selected($lloo_op['text_size'], '28'); ?>>28</option>
												<option value="30" <?php selected($lloo_op['text_size'], '30'); ?>>30</option>
												<option value="32" <?php selected($lloo_op['text_size'], '32'); ?>>32</option>
												<option value="34" <?php selected($lloo_op['text_size'], '34'); ?>>34</option>
												<option value="36" <?php selected($lloo_op['text_size'], '36'); ?>>36</option>
												<option value="38" <?php selected($lloo_op['text_size'], '38'); ?>>38</option>
												<option value="40" <?php selected($lloo_op['text_size'], '40'); ?>>40</option>
												<option value="42" <?php selected($lloo_op['text_size'], '42'); ?>>42</option>
												<option value="44" <?php selected($lloo_op['text_size'], '44'); ?>>44</option>
												<option value="46" <?php selected($lloo_op['text_size'], '46'); ?>>46</option>
												<option value="48" <?php selected($lloo_op['text_size'], '48'); ?>>48</option>
								</select>px.</td>
    <td>Font:<select name="scroll_tool[text_font]" id="scroll-text-font" style="width:120px;">
												<option value="0" <?php selected($lloo_op['text_font'], '0'); ?>>Default</option>
												<option value="1" <?php selected($lloo_op['text_font'], '1'); ?>>Georgia, serif</option>
												<option value="2" <?php selected($lloo_op['text_font'], '2'); ?>>"Palatino Linotype", "Book Antiqua", Palatino, serif</option>
												<option value="3" <?php selected($lloo_op['text_font'], '3'); ?>>"Times New Roman", Times, serif</option>
												<option value="4" <?php selected($lloo_op['text_font'], '4'); ?>>Arial, Helvetica, sans-serif</option>
												<option value="5" <?php selected($lloo_op['text_font'], '5'); ?>>"Arial Black", Gadget, sans-serif</option>
												<option value="6" <?php selected($lloo_op['text_font'], '6'); ?>>"Comic Sans MS", cursive, sans-serif</option>
												<option value="7" <?php selected($lloo_op['text_font'], '7'); ?>>Impact, Charcoal, sans-serif</option>
												<option value="8" <?php selected($lloo_op['text_font'], '8'); ?>>"Lucida Sans Unicode", "Lucida Grande", sans-serif</option>
												<option value="9" <?php selected($lloo_op['text_font'], '9'); ?>>Tahoma, Geneva, sans-serif</option>
												<option value="10" <?php selected($lloo_op['text_font'], '10'); ?>>"Trebuchet MS", Helvetica, sans-serif</option>
												<option value="11" <?php selected($lloo_op['text_font'], '11'); ?>>Verdana, Geneva, sans-serif</option>
												<option value="12" <?php selected($lloo_op['text_font'], '12'); ?>>"Courier New", Courier, monospace</option>
												<option value="13" <?php selected($lloo_op['text_font'], '13'); ?>>"Lucida Console", Monaco, monospace</option>
								</select></td>
    <td>Color:<input type="text" id="scroll-text-color" name="scroll_tool[text_color]" value="<?php echo $lloo_op['text_color']; ?>" size="7" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Background:</th>
	<td><input type="checkbox" id="scroll-transparent-bg" name="scroll_tool[transparent_bg]" value="1" <?php checked( $lloo_op['transparent_bg'], '1' ); ?> /> transparent</td>
    <td>Color:<input type="text" id="scroll-background-color" name="scroll_tool[background_color]" value="<?php echo $lloo_op['background_color']; ?>" size="7" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Border:</th>
    <td>Thickness:<input type="button" value="-" class="qtyminus" field="scroll-border-thickness" /><input type="text" id="scroll-border-thickness" name="scroll_tool[border_thickness]" value="<?php echo $lloo_op['border_thickness']; ?>" size="2" maxlength="2" /><input type="button" value="+" class="qtyplus" field="scroll-border-thickness" />px.</td>
    <td>Color:<input type="text" id="scroll-border-color" name="scroll_tool[border_color]" value="<?php echo $lloo_op['border_color']; ?>" size="7" /></td>
    <td>Shape:<select id="scroll-border-shape" name="scroll_tool[border_shape]">
												<option value="solid" <?php selected($lloo_op['border_shape'], 'solid'); ?>>solid</option>
												<option value="dashed" <?php selected($lloo_op['border_shape'], 'dashed'); ?>>dashed</option>
												<option value="dotted" <?php selected($lloo_op['border_shape'], 'dotted'); ?>>dotted</option>
												<option value="double" <?php selected($lloo_op['border_shape'], 'double'); ?>>double</option>
												<option value="groove" <?php selected($lloo_op['border_shape'], 'groove'); ?>>groove</option>
												<option value="ridge" <?php selected($lloo_op['border_shape'], 'ridge'); ?>>ridge</option>
												<option value="inset" <?php selected($lloo_op['border_shape'], 'inset'); ?>>inset</option>
												<option value="outset" <?php selected($lloo_op['border_shape'], 'outset'); ?>>outset</option>
								</select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Corners:</th>
	<td>&nbsp;&nbsp;&nbsp;Radius:&nbsp;&nbsp;&nbsp;<input type="button" value="-" class="qtyminus" field="scroll-corners-radius" /><input type="text" id="scroll-corners-radius" name="scroll_tool[corners_radius]" value="<?php echo $lloo_op['corners_radius']; ?>" size="2" maxlength="2" /><input type="button" value="+" class="qtyplus" field="scroll-corners-radius" />px.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Shadow:</th>
    <td>Thickness:<input type="button" value="-" class="qtyminus" field="scroll-shadow-thickness" /><input type="text" id="scroll-shadow-thickness" name="scroll_tool[shadow_thickness]" value="<?php echo $lloo_op['shadow_thickness']; ?>" size="2" maxlength="2" /><input type="button" value="+" class="qtyplus" field="scroll-shadow-thickness" />px.</td>
    <td>Color:<input type="text" id="scroll-shadow-color" name="scroll_tool[shadow_color]" value="<?php echo $lloo_op['shadow_color']; ?>" size="7" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Other:</th>
    <td><input type="checkbox" id="scroll-hide-for-mobile" name="scroll_tool[hide_for_mobile]" value="1" <?php checked( $lloo_op['hide_for_mobile'], '1' ); ?> /> hide for mobile</td>
    <td><input type="checkbox" id="scroll-appearance" name="scroll_tool[animated_scroll]" value="1" <?php checked( $lloo_op['animated_scroll'], '1' ); ?> /> translucency</td>
    <td><input type="checkbox" id="scroll-motion" name="scroll_tool[animated_motion]" value="1" <?php checked( $lloo_op['animated_motion'], '1' ); ?> /> animated scroll motion</td>
    <td><input type="checkbox" id="scroll-disable-down" name="scroll_tool[disable_down]" value="1" <?php checked( $lloo_op['disable_down'], '1' ); ?> /> disable down</td>
  </tr>
</table>
<p style="text-indent:20px;"><input id="submit" class="button button-primary" type="submit" value="Save" /></p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
}

function lloo_get_options($options){
$defaults = array(
				'type' => 'button',
				'width' => '50',
				'height' => '50',
				'button_position' => 'leftbottom',
				'left_indent' => '20',
				'bottom_indent' => '20',
				'right_indent' => '20',
				'button_arrow' => '1',
				'display_labels' => '0',
				'up' => 'Up',
				'down' => 'Down',
				'text_size' => '18',
				'text_font' => '4',
				'text_color' => '#333333',
				'background_color' => '#CCCCCC',
				'transparent_bg' => '0',
				'border_thickness' => '1',
				'border_color' => '#666666',
				'border_shape' => 'solid',
				'corners_radius' => '6',
				'shadow_thickness' => '6',
				'shadow_color' => '#999999',
				'hide_for_mobile' => '0',
				'animated_scroll' => '1',
				'animated_motion' => '1',
				'disable_down' => '0'
				);
if(!empty($options)){
$defaults['animated_scroll'] = '0';
$defaults['animated_motion'] = '0';
}
$options = wp_parse_args( $options, $defaults );
return $options;
}

// add css stylesheets and js-scripts to the admin's front-end

function lloo_css_js(){
	if(isset($_GET['page']) && $_GET['page'] == 'scroll-tool'){
		$myStyleUrl = plugin_dir_url( __FILE__ ).'css/scroll-tool-styles.css';
		$colorpickerStyle = plugin_dir_url( __FILE__ ).'css/scroll-tool-colorpicker.css';
		wp_register_style('lloo-colorpicker-style', $colorpickerStyle, array(), false, 'screen');
		wp_enqueue_style( 'lloo-admin-style', $myStyleUrl, array('lloo-colorpicker-style'), false, 'screen');
		$myScriptUrl = plugin_dir_url( __FILE__ ).'js/scroll-tool-colorpicker.js';
		wp_register_script('lloo-colorpicker-script', $myScriptUrl);
		wp_enqueue_script('lloo-admin-script', plugin_dir_url( __FILE__ ).'js/scroll-tool-admin.js', array('jquery', 'lloo-colorpicker-script'));
		}
}

// add css stylesheet and js-script to the front-end
// this is only one place in the current php-script where html will be added to the user's front-end page

function lloo_frontend_css_js(){
$myStyleUrl = plugin_dir_url( __FILE__ ).'css/scroll-tool.css';
wp_register_style('lloo-frontend-style', $myStyleUrl);
wp_enqueue_style( 'lloo-frontend-style');
wp_enqueue_script('lloo-frontend-script', plugin_dir_url( __FILE__ ).'js/scroll-tool.js', array('jquery'), false, true);
$params = lloo_get_scroll_tool_params();
wp_localize_script( 'lloo-frontend-script', 'scrollToolParams', $params );
}

// display scroll-tool admin's panel

function lloo_admin_menu() {
	
// this way only for the administrator with the manage options privilege

    add_theme_page('Scroll Tool', 'Scroll Tool', 'manage_options', 'scroll-tool', 'lloo_echo_interface');

}

// get scroll-tool parameters from the database and prepare it for the front-end js-script

function lloo_get_scroll_tool_params() {

$lloo_op = unserialize(get_option('lloo_options'));
$tplOptions = $lloo_op;
$styles = array();
$pluginUrl = plugin_dir_url( __FILE__ );

$imgExt = ".png";
if($lloo_op['button_arrow'] > 18){
	$imgExt = ".svg";
}

if($lloo_op['type'] == 'button'){
		$class = 'scroll_button';
		$styles['width'] = $lloo_op['width'].'px';
		$styles['height'] = $lloo_op['height'].'px';
			if($lloo_op['button_position'] == 'leftbottom'){
			$styles['left'] = $lloo_op['left_indent'].'px';
			$styles['bottom'] = $lloo_op['bottom_indent'].'px';
			}
			if($lloo_op['button_position'] == 'middlebottom'){
			$styles['margin-left'] = '-'.(int)($lloo_op['width']/2).'px';
			$styles['left'] = '50%';
			$styles['bottom'] = $lloo_op['bottom_indent'].'px';
			}
			if($lloo_op['button_position'] == 'rightbottom'){
			$styles['right'] = $lloo_op['right_indent'].'px';
			$styles['bottom'] = $lloo_op['bottom_indent'].'px';
			}
			$paddingTop = (int)($lloo_op['height']/2-$lloo_op['text_size']/2);
			$topBg = (int)($lloo_op['height']/2-16/2);
				if($lloo_op['display_labels'] == 1){
				$paddingLeft = 'left';
				}
				else
				{
				$paddingLeft = ((int)($lloo_op['width']/2-16/2)).'px';
				}
			if($lloo_op['transparent_bg'] == 1){
			$styles['background'] = 'transparent url('.$pluginUrl.'img/up-'.$lloo_op['button_arrow'].$imgExt.') no-repeat '.$paddingLeft.' '.$topBg.'px';
			$tplOptions['upBg'] = $styles['background'];
			$tplOptions['downBg'] = 'transparent url('.$pluginUrl.'img/down-'.$lloo_op['button_arrow'].$imgExt.') no-repeat '.$paddingLeft.' '.$topBg.'px';
			}
			else
			{
			$styles['background'] = $lloo_op['background_color'].' url('.$pluginUrl.'img/up-'.$lloo_op['button_arrow'].$imgExt.') no-repeat '.$paddingLeft.' '.$topBg.'px';
			$tplOptions['upBg'] = $styles['background'];
			$tplOptions['downBg'] = $lloo_op['background_color'].' url('.$pluginUrl.'img/down-'.$lloo_op['button_arrow'].$imgExt.') no-repeat '.$paddingLeft.' '.$topBg.'px';
			}
			if($lloo_op['border_thickness'] > 0){
			$styles['border'] = $lloo_op['border_thickness'].'px '.$lloo_op['border_color'].' '.$lloo_op['border_shape'];
			}
			if($lloo_op['corners_radius'] > 0){
			$styles['border-radius'] = $lloo_op['corners_radius'].'px';
			}
		}
		else
		{
		$class = 'scroll_sidebar';
		$styles['width'] = $lloo_op['width'].'px';
			if($lloo_op['button_position'] == 'left'){
			$styles['left'] = '0';
			}
			if($lloo_op['button_position'] == 'right'){
			$styles['right'] = '0';
			}
			$paddingTop = (int)($lloo_op['text_size']/2);
			$topBg = (int)($paddingTop+($paddingTop-16/2)/2);
				if($lloo_op['display_labels'] == 1){
				$paddingLeft = 'left';
				}
				else
				{
				$paddingLeft = ((int)($lloo_op['width']/2-16/2)).'px';
				}
			if($lloo_op['transparent_bg'] == 1){
			$styles['background'] = 'transparent url('.$pluginUrl.'img/up-'.$lloo_op['button_arrow'].$imgExt.') no-repeat '.$paddingLeft.' '.$topBg.'px';
			$tplOptions['upBg'] = $styles['background'];
			$tplOptions['downBg'] = 'transparent url('.$pluginUrl.'img/down-'.$lloo_op['button_arrow'].$imgExt.') no-repeat '.$paddingLeft.' '.$topBg.'px';
			}
			else
			{
			$styles['background'] = $lloo_op['background_color'].' url('.$pluginUrl.'img/up-'.$lloo_op['button_arrow'].$imgExt.') no-repeat '.$paddingLeft.' '.$topBg.'px';
			$tplOptions['upBg'] = $styles['background'];
			$tplOptions['downBg'] = $lloo_op['background_color'].' url('.$pluginUrl.'img/down-'.$lloo_op['button_arrow'].$imgExt.') no-repeat '.$paddingLeft.' '.$topBg.'px';
			}
			if($lloo_op['border_thickness'] > 0){
				if($lloo_op['button_position'] == 'left'){
					$styles['border-right'] = $lloo_op['border_thickness'].'px '.$lloo_op['border_color'].' '.$lloo_op['border_shape'];
				}
				else
				{
					$styles['border-left'] = $lloo_op['border_thickness'].'px '.$lloo_op['border_color'].' '.$lloo_op['border_shape'];
				}
			}
			if($lloo_op['corners_radius'] > 0){
				if($lloo_op['button_position'] == 'left'){
					$styles['border-radius'] = '0px '.$lloo_op['corners_radius'].'px '.$lloo_op['corners_radius'].'px 0px';
				}
				else
				{
					$styles['border-radius'] = $lloo_op['corners_radius'].'px 0px 0px '.$lloo_op['corners_radius'].'px';
				}
			}
		}
		
		if($lloo_op['shadow_thickness'] > 0){
			$styles['box-shadow'] = '0px 0px '.$lloo_op['shadow_thickness'].'px '.$lloo_op['shadow_color'];
		}
		
		$fonts = array(
					 "inherit",
					 "Georgia, serif",
					 "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
					 "'Times New Roman', Times, serif",
					 "Arial, Helvetica, sans-serif",
					 "'Arial Black', Gadget, sans-serif",
					 "'Comic Sans MS', cursive, sans-serif",
					 "Impact, Charcoal, sans-serif",
					 "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
					 "Tahoma, Geneva, sans-serif",
					 "'Trebuchet MS', Helvetica, sans-serif",
					 "Verdana, Geneva, sans-serif",
					 "'Courier New', Courier, monospace",
					 "'Lucida Console', Monaco, monospace"
					 );
		$fontFamily = $lloo_op['text_font'];
		if($lloo_op['display_labels'] == 1){
		$button_label = '<div id="label-up" style="margin:'.$paddingTop.'px 0 0 16px; font-size:'.$lloo_op['text_size'].'px; color:'.$lloo_op['text_color'].'; font-family:\'+"'.$fonts[$fontFamily].'"+\';">'.stripslashes(htmlspecialchars($lloo_op['up'], ENT_QUOTES)).'</div><div id="label-down" style="margin:'.$paddingTop.'px 0 0 16px; font-size:'.$lloo_op['text_size'].'px; color:'.$lloo_op['text_color'].'; font-family:\'+"'.$fonts[$fontFamily].'"+\';">'.stripslashes(htmlspecialchars($lloo_op['down'], ENT_QUOTES)).'</div>';
}
$style = '';
$amount = count($styles);
$i = 1;
foreach ($styles as $key => $value){
$style .= $key.':'.$value;
if ($i < $amount) $style .= '; ';
$i++;
}

// redefine variables for last 4 checkboxes in the admin panel

if ($tplOptions['hide_for_mobile'] == 1)
$tplOptions['hide_for_mobile'] = true;
else
$tplOptions['hide_for_mobile'] = false;
if ($tplOptions['animated_scroll'] == 1)
$tplOptions['animated_scroll'] = true;
else
$tplOptions['animated_scroll'] = false;
if ($tplOptions['animated_motion'] == 1)
$tplOptions['animated_motion'] = true;
else
$tplOptions['animated_motion'] = false;
if ($tplOptions['disable_down'] == 1)
$tplOptions['disable_down'] = true;
else
$tplOptions['disable_down'] = false;

// check for button text presense

if (!isset($button_label)) $button_label = '';

// initialize associative array with button custom settings that created by user

$params = array(
'scrollToolClass' => $class,
'scrollToolStyle' => $style,
'scrollToolLabel' => $button_label,
'scrollToolOptions' => $tplOptions
);

// return parameters to wp-function wp_localize_script() that will localize it for static js-script placed at js/scroll-tool.js

return $params;

}// end of lloo_get_scroll_tool_params()


// write defaults to the database instantly after plugin activation

function lloo_install()
{

	$defaults = serialize(lloo_get_options(array()));
	add_option('lloo_options', $defaults);

}

// delete options from the database when plugin deactivated

function lloo_uninstall()
{

    delete_option('lloo_options');

}

// activation/deactivation hooks

register_activation_hook( __FILE__, 'lloo_install');
register_deactivation_hook( __FILE__, 'lloo_uninstall');

// front-end & admin panel hooks

add_action('wp_enqueue_scripts', 'lloo_frontend_css_js');
add_action('admin_enqueue_scripts', 'lloo_css_js');
add_action('admin_menu', 'lloo_admin_menu');
?>