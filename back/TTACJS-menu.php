<?php

function TTACJS_render() {

	if(isset($_POST['TTACJS-save'])) {
		require 'TTACJS-save.php';
	}

	require 'TTACJS-render.php';
}

function cookie_register_options_page() {
  add_options_page('Gestion des cookies', 'Gestion des cookies', 'manage_options', 'ttacjs', 'TTACJS_render');
}
add_action('admin_menu', 'cookie_register_options_page');
