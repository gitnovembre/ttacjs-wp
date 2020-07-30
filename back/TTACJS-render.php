<?php
$cookie_trackers = get_option('ttacjs_code');

?>
<div class="wrap">
	<h2>Gestion des cookies</h2>
	<br>
	<p>Le module utilise tarteaucitron.js, pour ajouter des outils de tracking, il faut suivre la documentaion du script : <a target="_blank" href="https://opt-out.ferank.eu/fr/install/">tarteaucitron.js</a>
	<br>
	<form action="" method="post">
		<h3>Configuration :</h3>
		<label for="ttacjs_show_hash">Hash du site</label><br/>
		<input type="text" id="ttacjs_hash" style="margin-top: 0px;margin-bottom: 0px;width: 600px;" name="ttacjs_hash" placeholder="#cookies" value="<?php echo get_option('ttacjs_hash'); ?>" />
		<br/><br/>

		<div>Afficher le bandeau</div><br/>
		<input type="radio" id="ttacjs_show_true" name="ttacjs_show" value="1"
			<?php
				if ( get_option('ttacjs_show') == '1') {
					echo 'checked';
				}
			?>
		/>
		<label for="ttacjs_show_true">Oui</label><br/>
		<input type="radio" id="ttacjs_show_false" name="ttacjs_show" value="0" 
			<?php
				if ( get_option('ttacjs_show') == '0') {
					echo 'checked';
				}
			?>
		/>
		<label for="ttacjs_show_false">Non</label><br/>
		<br/><br/>

		<label for="ttacjs_pos">Position du bandeau</label><br/>
		<select name="ttacjs_pos" id="ttacjs_pos">
			<option 
				value="bottom"
				<?php
					if ( get_option('ttacjs_pos') == 'bottom') {
						echo 'selected';
					}
					?>
			>
				En bas
			</option>
			<option 
				value="top"
				<?php
					if ( get_option('ttacjs_pos') == 'top') {
						echo 'selected';
					}
					?>
			>
				En haut
			</option>
		</select>
		<br /><br />
		<h3>Image du bandeau :</h3>
		<?php include('TTACJS-image.php'); ?>
		<h3>Couleur du bouton :</h3>
		<input type="text" id="ttacjs_color" name="ttacjs_color" 
			placeholder="" value="<?php echo get_option('ttacjs_color'); ?>"/>
		<br /><br />
		<h3>Couleur du texte :</h3>
		<input type="text" id="ttacjs_textColor" name="ttacjs_textColor" 
			placeholder="" value="<?php echo get_option('ttacjs_textColor'); ?>"/>
		<br /><br />
		<h3>Titre du bandeau :</h3>
		<input type="text" id="ttacjs_title" name="ttacjs_title" 
			placeholder="" value="<?php echo get_option('ttacjs_title'); ?>"/>
		<br /><br />

		<h3>Texte du bandeau :</h3>
		<textarea type="text" id="ttacjs_explanation" style="margin-top: 0px;margin-bottom: 0px;height: 300px;width: 600px;" name="ttacjs_explanation" 
			placeholder="" /><?php echo get_option('ttacjs_explanation'); ?></textarea>
		<br /><br />

		<h3>Texte du bouton pour tout accepter:</h3>
		<input type="text" id="ttacjs_buttonTextAccept" name="ttacjs_buttonTextAccept" 
			placeholder="" value="<?php echo get_option('ttacjs_buttonTextAccept'); ?>"/>
		<br /><br />

		<h3>Texte du bouton pour tout refuser:</h3>
		<input type="text" id="ttacjs_buttonTextRefuse" name="ttacjs_buttonTextRefuse" 
			placeholder="" value="<?php echo get_option('ttacjs_buttonTextRefuse'); ?>"/>
		<br /><br />

		<h3>Texte du bouton pour personnaliser:</h3>
		<input type="text" id="ttacjs_buttonTextPersonnalize" name="ttacjs_buttonTextPersonnalize" 
			placeholder="" value="<?php echo get_option('ttacjs_buttonTextPersonnalize'); ?>"/>
		<br /><br />

		<!-- <label for="ttacjs_pos">Position du bandeau</label><br/>
		<input type="text" id="ttacjs_pos" style="margin-top: 0px;margin-bottom: 0px;width: 600px;" name="ttacjs_pos" placeholder="top ou bottom" value="<?=  get_option('ttacjs_pos'); ?>" />
		<br/><br/> -->
		<h3>Ajouter des services :</h3>
		<textarea type="text" id="ttacjs_code" style="margin-top: 0px;margin-bottom: 0px;height: 300px;width: 600px;" name="ttacjs_code" 
			placeholder="tarteaucitron.user.googletagmanagerId = 'GTM-XXXXX';
(tarteaucitron.job = tarteaucitron.job || []).push('googletagmanager');" /><?php echo get_option('ttacjs_code'); ?></textarea>
		<br /><br />
		<label for="ttacjs_domain">Domaine du site (optionnel)</label><br/>
		<input type="text" id="ttacjs_domain" style="margin-top: 0px;margin-bottom: 0px;width: 600px;" name="ttacjs_domain" placeholder="www.exemple.com" value="<?php echo get_option('ttacjs_domain'); ?>" />
		<br/><br/>
		<input type="submit" value="Sauvegarder" name="TTACJS-save" class="button button-primary">
	</form>
</div>
