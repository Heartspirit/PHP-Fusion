<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2013 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: upgrade.php
| Author: Nick Jones (Digitanium)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../maincore.php";

if (!checkrights("U") || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

require_once THEMES."templates/admin_header.php";
if (file_exists(LOCALE.LOCALESET."admin/upgrade.php")) {
	include LOCALE.LOCALESET."admin/upgrade.php";
} else {
	include LOCALE."English/admin/upgrade.php";
}

opentable($locale['400']);
echo "<div style='text-align:center'><br />\n";
echo "<form name='upgradeform' method='post' action='".FUSION_SELF.$aidlink."'>\n";

if (str_replace(".", "", $settings['version']) < "80000") {
	if (!isset($_POST['stage'])) {
		echo sprintf($locale['500'], $locale['504'])."<br />\n".$locale['501']."<br /><br />\n";
		echo "<input type='hidden' name='stage' value='2'>\n";
		echo "<input type='submit' name='upgrade' value='".$locale['400']."' class='button'><br /><br />\n";
	} elseif (isset($_POST['upgrade']) && isset($_POST['stage']) && $_POST['stage'] == 2) {

	//Check files from earlier installations
	echo "<div style='width:550px; margin:15px auto;' class='tbl'>\n";
	echo "File check, please save and remove according to list.<br />\n";
	echo "<div class='tbl-border' style='margin-top:10px; padding: 5px; text-align:left;'>";

	if (file_exists(ADMIN."settings_links.php")) { echo "<span style='color:red;'>administration/settings_links.php </span> need to be deleted<br />"; }
	if (file_exists(ADMIN."shoutbox.php")) { echo "<span style='color:red;'>administration/shoutbox.php </span> need to be deleted<br />"; }
	if (file_exists(ADMIN."updateuser.php")) { echo "<span style='color:red;'>administration/updateuser.php </span> need to be deleted<br />"; }
	if (file_exists(IMAGES."edit.gif")) { echo "<span style='color:red;'>images/edit.gif </span> need to be deleted<br />"; }
	if (file_exists(IMAGES."star.gif")) { echo "<span style='color:red;'>images/star.gif </span> need to be deleted<br />"; }
	if (file_exists(IMAGES."tick.gif")) { echo "<span style='color:red;'>images/tick.gif </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."jscripts/tiny_mce/langs/hu.js")) { echo "<span style='color:red;'>includes/jscripts/tiny_mce/langs/hu.js </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."jscripts/tiny_mce/plugins/compat2x/editor_plugin.js")) { echo "<span style='color:red;'>includes/jscripts/tiny_mce/plugins/compat2x/editor_plugin.js </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."jscripts/tiny_mce/plugins/compat2x/editor_plugin_src.js")) { echo "<span style='color:red;'>includes/jscripts/tiny_mce/plugins/compat2x/editor_plugin_src.js </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."jscripts/tiny_mce/plugins/paste/css/blank.css")) { echo "<span style='color:red;'>includes/jscripts/tiny_mce/plugins/paste/css/blank.css </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."jscripts/tiny_mce/plugins/paste/css/pasteword.css")) { echo "<span style='color:red;'>includes/jscripts/tiny_mce/plugins/paste/css/pasteword.css </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."jscripts/tiny_mce/plugins/paste/blank.htm")) { echo "<span style='color:red;'>includes/jscripts/tiny_mce/plugins/paste/blank.htm </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."jscripts/tiny_mce/plugins/safari/blank.htm")) { echo "<span style='color:red;'>includes/jscripts/tiny_mce/plugins/safari/blank.htm </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."jscripts/tiny_mce/plugins/safari/editor_plugin.js")) { echo "<span style='color:red;'>includes/jscripts/tiny_mce/plugins/safari/editor_plugin.js </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."jscripts/tiny_mce/plugins/safari/editor_plugin_src.js")) { echo "<span style='color:red;'>includes/jscripts/tiny_mce/plugins/safari/editor_plugin_src.js </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."jscripts/tiny_mce/plugins/xhtmlxtras/css/xhtmlxtras.css")) { echo "<span style='color:red;'>includes/jscripts/tiny_mce/plugins/xhtmlxtras/css/xhtmlxtras.css </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."jscripts/tiny_mce/utils/mclayer.js")) { echo "<span style='color:red;'>includes/jscripts/tiny_mce/utils/mclayer.js </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."securimage/index.php")) { echo "<span style='color:red;'>The folder includes/securimage and it´s content </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."captcha_include.php")) { echo "<span style='color:red;'>includes/captcha_include.php </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."jquery.js")) { echo "<span style='color:red;'>includes/jquery.js </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."phpmailer_include.php")) { echo "<span style='color:red;'>includes/phpmailer_include.php </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."smtp_include.php")) { echo "<span style='color:red;'>includes/smtp_include.php </span> need to be deleted<br />"; }
	if (file_exists(INCLUDES."update_profile_include.php")) { echo "<span style='color:red;'>includes/update_profile_include.php </span> need to be deleted<br />"; }
	if (file_exists(INFUSIONS."navigation_panel/index.php")) { echo "<span style='color:red;'>The folder infusions/navigation_panel </span> need to be deleted <br /> (<STRONG>Check so you use the new one before!</STRONG>)<br />"; }
	if (file_exists(LOCALE."English/admin/shoutbox.php")) { echo "<span style='color:red;'>locale/English/admin/shoutbox.php </span> need to be deleted<br />"; }
	if (file_exists(LOCALE."English/edit_profile.php")) { echo "<span style='color:red;'>locale/English/edit_profile.php </span> need to be deleted<br />"; }
	if (file_exists(LOCALE."English/register.php")) { echo "<span style='color:red;'>locale/English/register.php </span> need to be deleted<br />"; }
	if (file_exists(LOCALE."English/view_profile.php")) { echo "<span style='color:red;'>locale/English/view_profile.php </span> need to be deleted<br />"; }

	echo "</div></div>";

		$result = dbquery("UPDATE ".DB_SETTINGS." SET settings_value='8.00.00' WHERE settings_name='version'");
		$result = dbquery("INSERT INTO ".$db_prefix."settings (settings_name, settings_value) VALUES ('login_method', '0')"); // New: Login method feature
		// Email templates
		$result = dbquery("INSERT INTO ".DB_ADMIN." (admin_rights, admin_image, admin_title, admin_link, admin_page) VALUES ('MAIL', 'email.gif', '".$locale['T001']."', 'email.php', '1')");
		if ($result) {
			$result = dbquery("SELECT user_id, user_rights FROM ".DB_USERS." WHERE user_level='103'");
			while ($data = dbarray($result)) {
				$result2 = dbquery("UPDATE ".DB_USERS." SET user_rights='".$data['user_rights'].".MAIL' WHERE user_id='".$data['user_id']."'");
			}
		}

		$result = dbquery("CREATE TABLE ".DB_PREFIX."email_templates (
			template_id MEDIUMINT(8) UNSIGNED NOT NULL,
			template_key VARCHAR(10) NOT NULL,
			template_format VARCHAR(10) NOT NULL,
			template_active TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
			template_name VARCHAR(300) NOT NULL,
			template_subject TEXT NOT NULL,
			template_content TEXT NOT NULL,
			template_sender_name VARCHAR(30) NOT NULL,
			template_sender_email VARCHAR(100) NOT NULL,
			PRIMARY KEY (template_id)
		) ENGINE=MyISAM;");

		if ($result) {
			$result = dbquery("INSERT INTO ".DB_PREFIX."email_templates (template_id, template_key, template_format, template_active, template_name, template_subject, template_content, template_sender_name, template_sender_email) VALUES ('1', 'PM', 'html', '0', '".$locale['T101']."', '".$locale['T102']."', '".$locale['T103']."', '".$settings['siteusername']."', '".$settings['siteemail']."')");
			$result = dbquery("INSERT INTO ".DB_PREFIX."email_templates (template_id, template_key, template_format, template_active, template_name, template_subject, template_content, template_sender_name, template_sender_email) VALUES ('2', 'POST', 'html', '0', '".$locale['T201']."', '".$locale['T202']."', '".$locale['T203']."', '".$settings['siteusername']."', '".$settings['siteemail']."')");
			$result = dbquery("INSERT INTO ".DB_PREFIX."email_templates (template_id, template_key, template_format, template_active, template_name, template_subject, template_content, template_sender_name, template_sender_email) VALUES ('3', 'CONTACT', 'html', '0', '".$locale['T301']."', '".$locale['T302']."', '".$locale['T303']."', '".$settings['siteusername']."', '".$settings['siteemail']."')");
		}
		// Forum's items per page
		$result = dbquery("INSERT INTO ".$db_prefix."settings (settings_name, settings_value) VALUES ('posts_per_page', '20')");
		$result = dbquery("INSERT INTO ".$db_prefix."settings (settings_name, settings_value) VALUES ('threads_per_page', '20')");

		echo $locale['502']."<br /><br />\n";
	}
} else {
	echo $locale['401']."<br /><br />\n";
}

echo "</form>\n</div>\n";
closetable();

require_once THEMES."templates/footer.php";
?>