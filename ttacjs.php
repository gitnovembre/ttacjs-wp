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
    $color = get_option('ttacjs_color') ? get_option('ttacjs_color') : '#fc631f';
	?>
    <link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url(__FILE__) . 'ttacjs.css' ?>">
	<script src="<?php echo plugin_dir_url(__FILE__) . 'node_modules/tarteaucitronjs/tarteaucitron.js'; ?>"></script>
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

	replaceOldTtacjs = () => {
        mutationObserver.disconnect();
        const oldttacjs = document.getElementById("tarteaucitronAlertBig");
        if (oldttacjs && getComputedStyle(oldttacjs).display !== "none") {
            // oldttacjs.classList.remove("tarteaucitronAlertBigBottom");
            if(oldttacjs.style.display === "block") {
                oldttacjs.style.display = "flex";
            }
            oldttacjs.classList.add("ttacjs");
            oldttacjs.innerHTML = `
                <div id="tarteaucitronDisclaimerAlert">
                    <?php echo wp_get_attachment_image($imageID,"large", "", ["class" => "ttacjs__logo"]); ?>
                <p class="ttacjs__title">
                    <?php echo $title ?>
                </p>
                <p class="ttacjs__text">
                    <?php echo $explanation ?>
                </p>
                </div>
                <div class="ttacjs__buttons">
                    <button id="tarteaucitronCloseAlert" class="ttacjs__accept" onclick="tarteaucitron.userInterface.respondAll(true);" style="<?php echo 'background-color: '.$color.'; border-color: '. $color ?>">OK j'accepte</button>
                    <a id="tarteaucitronPersonalize" class="ttacjs__personnalize" onclick="tarteaucitron.userInterface.openPanel();" style="<?php echo 'color: '. $color ?>">Je veux en savoir plus et paramétrer les cookies</a>
                </div>
            `;
            if(oldttacjs.style.display !== "none") {
                const overlay = document.createElement('div');
                overlay.classList.add('ttacjs__overlay');
                document.body.appendChild(overlay);
                const tarteaucitronCloseAlert = oldttacjs.querySelector('#tarteaucitronCloseAlert');
                tarteaucitronCloseAlert.addEventListener('click', () => {
                    overlay.remove();
                })
                const tarteaucitronClosePanel = document.querySelector('#tarteaucitronClosePanel');
                tarteaucitronClosePanel.addEventListener('click', () => {
                    overlay.remove();
                })
            }
        }
    }
    /** Listen when ttacjs is add to the DOM */
    const mutationObserver = new MutationObserver(mutations => {
        mutations.forEach((mutation) => {
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
