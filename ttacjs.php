<?php
/**
 * Plugin Name: Législation sur les cookies & RGPD
 * Version: 1.0.1
 * Description: Mise en conformité des cookies avec la RGPD. Utilise le script : tarteaucitron.js
 * Author: Novembre
 * Author URI: https://www.novembre.com/
 * Text Domain: ttacjs
 * Domain Path: /lang/
 * License: GPL v3
 */

// Back office
require('back/TTACJS-menu.php');

// Front Office

function ttacjs_head() {
	$show = get_option('ttacjs_show') == 1 ? 'true' : 'false';
	$imageID = get_option('ttacjs_image');
    $title = get_option('ttacjs_title');
    $explanation = get_option('ttacjs_explanation');
    $color = get_option('ttacjs_color') ? get_option('ttacjs_color') : '#000000';
    $textColor = get_option('ttacjs_textColor') ? get_option('ttacjs_textColor') : '#ffffff';
    $buttonText = get_option('ttacjs_buttonText') ? get_option('ttacjs_buttonText') : "J'ACCEPTE";
	?>
	<script src="<?php echo plugin_dir_url(__FILE__) . 'dist/tarteaucitronjs/tarteaucitron.js'; ?>"></script>
	<script src="<?php echo plugin_dir_url(__FILE__) . 'dist/ttacjs-wp.js'; ?>"></script>
	<script type="text/javascript">
	var tarteaucitronForceLanguage = 'fr';
	tarteaucitron.init({
			"hashtag": "<?php echo get_option('ttacjs_hash') ?>", /* Ouverture automatique du panel avec le hashtag */
			"highPrivacy": false, /* désactiver le consentement implicite (en naviguant) ? */
			"orientation": "<?php echo get_option('ttacjs_pos') ?>", /* le bandeau doit être en haut (top) ou en bas (bottom) ? */
			// "orientation": "bottom",
			"adblocker": false, /* Afficher un message si un adblocker est détecté */
			"showAlertSmall": <?php echo $show ?>, /* afficher le petit bandeau en bas à droite ? */
			// "showAlertSmall": <?php //if (get_option('ttacjs_show') == '1') { echo true; } else { echo false; } ?>, /* afficher le petit bandeau en bas à droite ? */
			"cookieslist": true, /* Afficher la liste des cookies installés ? */
			"removeCredit": true, /* supprimer le lien vers la source ? */
			"cookieDomain": "<?php echo get_option('ttacjs_domain') ?>" /* Nom de domaine sur lequel sera posé le cookie pour les sous-domaines */
	});

	function replaceOldTtacjs() {
        mutationObserver.disconnect();
        var oldttacjs = document.getElementById("tarteaucitronAlertBig");
        if (oldttacjs && getComputedStyle(oldttacjs).display !== "none") {
            // oldttacjs.classList.remove("tarteaucitronAlertBigBottom");
            if(oldttacjs.style.display === "block") {
                oldttacjs.style.display = "flex";
            }
            oldttacjs.classList.add("ttacjs");
            oldttacjs.innerHTML = '' +
                '<div id="tarteaucitronDisclaimerAlert">' +
                    '<?php echo wp_get_attachment_image($imageID,"large", "", ["class" => "ttacjs__logo"]); ?>' +
                '<p class="ttacjs__title">' +
                    "<?php echo htmlspecialchars($title) ?>"+
                '</p>' +
                '<p class="ttacjs__text"> '+
                    "<?php echo htmlspecialchars($explanation) ?>" +
                '</p>' +
                '</div>' +
                '<div class="ttacjs__buttons">' +
                '<style>#tarteaucitronPersonalize { color: <?php echo $color; ?> !important; } #tarteaucitronCloseAlert { background-color: <?php echo $color; ?> !important; border-color: <?php echo $color; ?> !important; color: <?php echo $textColor; ?> !important; } #tarteaucitronCloseAlert:hover { background-color: <?php echo $textColor; ?> !important; border-color: <?php echo $color; ?> !important; color: <?php echo $color; ?> !important; }</style>' +
                    '<a id="tarteaucitronPersonalize" class="ttacjs__personnalize" onclick="tarteaucitron.userInterface.openPanel();">MODIFIER MES PRÉFÉRENCES' + 
                    '<svg width="12" height="12" style="margin-left: 5px" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg"  version="1.1" x="0px" y="0px" viewBox="0 0 100 100"><g transform="translate(0,-952.36218)"><path style="text-indent:0;text-transform:none;direction:ltr;block-progression:tb;baseline-shift:baseline;color:<?php echo $color ?>;enable-background:accumulate;" d="m 50.000045,1024.5809 3.34371,-2.9688 38,-33.99999 -6.6875,-7.4687 -34.65621,30.99999 -34.6563,-30.99999 -6.6875,7.4687 38,33.99999 3.3438,2.9688 z" fill="<?php echo $color; ?>" fill-opacity="1" stroke="none" marker="none" visibility="visible" display="inline" overflow="visible"></path></g></svg>' +
                    '</a>' +
                    '<button id="tarteaucitronCloseAlert" class="ttacjs__accept" onclick="tarteaucitron.userInterface.respondAll(true);" style="<?php echo 'background-color: '.$color.'; border-color: '. $color ?>"><?php echo addslashes($buttonText); ?></button>' +
                '</div>';

            if(oldttacjs.style.display !== "none") {
                var overlay = document.createElement('div');
                overlay.classList.add('ttacjs__overlay');
                document.body.appendChild(overlay);
                var tarteaucitronCloseAlert = oldttacjs.querySelector('#tarteaucitronCloseAlert');
                tarteaucitronCloseAlert.addEventListener('click', function() {
                    overlay.remove();
                })
                var tarteaucitronClosePanel = document.querySelector('#tarteaucitronClosePanel');
                tarteaucitronClosePanel.addEventListener('click', function() {
                    overlay.remove();
                })
            }
        }
    }
    /** Listen when ttacjs is add to the DOM */
    var mutationObserver = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if(mutation.target.getAttribute('id') === "tarteaucitronRoot") {
                replaceOldTtacjs();
            }
        });
    });
    mutationObserver.observe(document.documentElement, {
        childList: true,
        subtree: true,
    });

	</script>
<?php
}

add_action('wp_head', 'ttacjs_head', 0);

function ttacjs_footer() {
	echo '<script type="text/javascript">' . get_option('ttacjs_code') . '</script>';
}

add_action('wp_footer', 'ttacjs_footer', 0);


// Activation
function ARC_activate() {

	update_option( 'ttacjs_domain', '' );
	update_option( 'ttacjs_code', '' );
	update_option( 'ttacjs_pos', 'bottom' );
	update_option( 'ttacjs_show', false );
	update_option( 'ttacjs_hash', '' );

}
register_activation_hook( __FILE__, 'ARC_activate' );
