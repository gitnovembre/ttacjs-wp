<?php

$cookie_trackers = $_POST['ttacjs_code'];
$cookie_domain = $_POST['ttacjs_domain'];
$position = $_POST['ttacjs_pos'];
$show = $_POST['ttacjs_show'];
$hash = $_POST['ttacjs_hash'];
$title = $_POST['ttacjs_title'];
$image = $_POST['ttacjs_image'];
$explanation = $_POST['ttacjs_explanation'];
$color = $_POST['ttacjs_color'];
$textColor = $_POST['ttacjs_textColor'];
$buttonText = $_POST['ttacjs_buttonText'];



update_option( 'ttacjs_code', stripslashes($cookie_trackers) );
update_option( 'ttacjs_domain', stripslashes($cookie_domain) );
update_option( 'ttacjs_show', stripslashes($show) );
update_option( 'ttacjs_pos', stripslashes($position) );
update_option( 'ttacjs_hash', stripslashes($hash) );
update_option( 'ttacjs_image', stripslashes($image) );
update_option( 'ttacjs_title', stripslashes($title) );
update_option( 'ttacjs_explanation', stripslashes($explanation) );
update_option( 'ttacjs_color', stripslashes($color) );
update_option( 'ttacjs_textColor', stripslashes($textColor) );
update_option( 'ttacjs_buttonText', stripslashes($buttonText) );
