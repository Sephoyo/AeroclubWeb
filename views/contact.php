<div class="wrapper">
	<div class="container">
		<h1>Nous contacter :</h1>
	</div>
</div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2531.3588126215964!2d2.6478587929481754!3d50.62045090195364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47dd2059d2292b0f%3A0xa424e5d78a8c381d!2sA%C3%A9roclub%20de%20la%20Lys%20et%20de%20l&#39;Artois!5e0!3m2!1sfr!2sfr!4v1710699708398!5m2!1sfr!2sfr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<div class="contenu">
	<h2>Contact :</h2><br>
	<?php
	if (isset($_POST['msg'])) {
		// En-têtes de l'email
		$entete  = 'MIME-Version: 1.0' . "\r\n";
		$entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$entete .= 'From: webmaster@monsite.fr' . "\r\n";
		$entete .= 'Reply-to: ' . $_POST['email'];

		// Corps de l'email
		$message = '<h1>Message envoyé depuis la page Contact de monsite.fr</h1>';
		$message .= '<p><b>Email : </b>' . $_POST['email'] . '<br>';
		$message .= '<b>Objet : </b>' . htmlspecialchars($_POST['objet']) . '<br>';
		$message .= '<b>Message : </b>' . htmlspecialchars($_POST['msg']) . '</p>';

		// Envoi de l'email
		$retour = mail('baertjoseph8@gmail.com', 'Envoi depuis page Contact', $message, $entete);
		if ($retour) {
			echo '<p>Votre message a bien été envoyé.</p>';
		} else {
			echo '<p>Erreur lors de l\'envoi du message.</p>';
		}
	} else {
		// Afficher le formulaire si aucune donnée de formulaire n'a été soumise
	?>
		<form id="contactForm" action="" method="POST">
			<div class="input-field">
				<i class="fa-solid fa-at"></i>
				<input type="email" placeholder="Votre email" name="email" required>
			</div>
			<div class="input-field">
				<i class="fa-solid fa-magnifying-glass"></i>
				<input type="text" placeholder="Objet" name="objet" required>
			</div>
			<div class="textarea-field">
				<i class="fa-solid fa-message"></i>
				<textarea type="text" placeholder="Votre message" name="msg" required></textarea>
			</div>
			<button type="submit" class="btn">Envoyer</button>
		</form>
	<?php } ?>
	<div class="info">
	<p>00-00-00-00-00</p><br>
	<p>contact@aeroclub.fr</p><br>
	<p>1 rue de l'aeroclub</p><br><br><br>
</div>
</div>
<script src="/js/contact.js"></script>