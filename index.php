<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
        <meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		
	</head>
    <body>
		<div class="wrapper">
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form class="register" action="register.php" method="POST">
						<h3>Registrierung</h3>
						<div class="column">
							<div>
								<label>Vorname:</label>
								<input type="textho" name="firstname" require="true"/>
								<span class="error">Fehler!</span>
							</div>
							<div>
								<label>Nachname:</label>
								<input type="text" name="name" require="true" />
								<span class="error">Fehler!</span>
							</div>
							<div>
								<label>Passwort:</label>
								<input type="password" name="password" require="true" />
								<span class="error">Fehler!</span>
							</div>
							</div>
						<div class="column">
							<div>
								<label>Username:</label>
								<input type="text" name="username" require="true"/>
								<span class="error">Fehler!</span>
							</div>
							<div>
								<label>Email:</label>
								<input type="email" name="mail" require="true" />
								<span class="error">Fehler!</span>
							</div>
							<div>
								<label>Passwort wiederholen:</label>
								<input type="password" name="password2" require="true" />
								<span class="error">Fehler!</span>
							</div>
						</div>
						<div class="bottom">
							<input type="submit" rel="sorry" value="Registrieren" />
							<a href="index.php" rel="login" class="linkform">Account vorhanden? Log dich hier ein!</a>
							<div class="clear"></div>
						</div>
					</form>
					<form class="login active" method="POST" action="login.php">
						<h3>Login</h3>
						<div>
							<label>Username:</label>
							<input type="text" name="username" />
							<span class="error">Fehler!</span>
						</div>
						<div>
							<label>Passwort: <a href="index.php" rel="forgot_password" class="forgot linkform">Passwort vergessen?</a></label>
							<input type="password" name="password" />
							<span class="error">Fehler!</span>
						</div>
						<div class="bottom">
							<div class="remember"><input type="checkbox" /><span>Angemeldet bleiben</span></div>
							<input type="submit" value="Einloggen"></input>
							<a href="index.php" rel="register" class="linkform">Keinen Account? Hier entlang!</a>
							<div class="clear"></div>
						</div>
					</form>
					<form class="forgot_password">
						<h3>Passwort vergessen</h3>
						<div>
							<label>Username oder Email:</label>
							<input type="text" />
							<span class="error">Fehler!</span>
						</div>
						<div class="bottom">
							<input type="submit" value="Senden"></input>
							<a href="index.php" rel="login" class="linkform">Zurück zum Login</a>
							<a href="index.php" rel="register" class="linkform">Keinen Account? Hier entlang!</a>
							<div class="clear"></div>
						</div>
					</form>
									</div>
				<div class="clear"></div>
			</div>
			
		</div>
		

		<!-- The JavaScript -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(function() {
					//the form wrapper (includes all forms)
				var $form_wrapper	= $('#form_wrapper'),
					//the current form is the one with class active
					$currentForm	= $form_wrapper.children('form.active'),
					//the change form links
					$linkform		= $form_wrapper.find('.linkform');
						
				//get width and height of each form and store them for later						
				$form_wrapper.children('form').each(function(i){
					var $theForm	= $(this);
					//solve the inline display none problem when using fadeIn fadeOut
					if(!$theForm.hasClass('active'))
						$theForm.hide();
					$theForm.data({
						width	: $theForm.width(),
						height	: $theForm.height()
					});
				});
				
				//set width and height of wrapper (same of current form)
				setWrapperWidth();
				
				/*
				clicking a link (change form event) in the form
				makes the current form hide.
				The wrapper animates its width and height to the 
				width and height of the new current form.
				After the animation, the new form is shown
				*/
				$linkform.bind('click',function(e){
					var $link	= $(this);
					var target	= $link.attr('rel');
					$currentForm.fadeOut(400,function(){
						//remove class active from current form
						$currentForm.removeClass('active');
						//new current form
						$currentForm= $form_wrapper.children('form.'+target);
						//animate the wrapper
						$form_wrapper.stop()
									 .animate({
										width	: $currentForm.data('width') + 'px',
										height	: $currentForm.data('height') + 'px'
									 },500,function(){
										//new form gets class active
										$currentForm.addClass('active');
										//show the new form
										$currentForm.fadeIn(400);
									 });
					});
					e.preventDefault();
				});
				
				function setWrapperWidth(){
					$form_wrapper.css({
						width	: $currentForm.data('width') + 'px',
						height	: $currentForm.data('height') + 'px'
					});
				}
});
        </script>
    </body>
</html>


