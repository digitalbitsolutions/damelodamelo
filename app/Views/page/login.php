<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="<?= base_url(). "css/libraries/bulma.css" ?>">
	<link rel="stylesheet" href="<?= base_url(). "css/page/login.css?v=001" ?>">
	<title>Login &raquo; Dámelo Dámelo </title>
	<link rel="shortcut icon" href="<?= base_url()."img/damelo_damelo_icon.webp" ?>" type="image/x-icon">
</head>
<body>
	<?php if (session('error')){ ?>
	  <article class="message is-info">
		<div class="message-body">
		  <?= session('error') ?>
		</div>
	  </article>
	<?php }?>
	<div class="container-main" id="container">
		<div class="form-container sign-up-container">
			<form action="<?= site_url("signup") ?>" method="post" class="form-create-user-app">
				<input type="hidden" name="city" id="city">
				<input type="hidden" name="postal_code" id="postal_code">
				<input type="hidden" name="province" id="province">
				<input type="hidden" name="country" id="country">
				<input type="hidden" name="latitude" id="latitude">
				<input type="hidden" name="longitude" id="longitude">
				
				<input type="hidden" name="recaptcha-response" id="recaptcha-response-2">
				<h1 class="title-main-section">Crea tu Cuenta</h1>
				<label for="">
					<span>Tipo de usuario *</span>
					<select name="user_level" required>
						<option value="" selected disabled>Seleccione</option>
						<option value="5">Proveedor de propiedades</option>
						<option value="4">Proveedor de servicios</option>
					</select>
				</label>
				<div class="container-two-col">
					<label for="">
						<span>Tipo de documento *</span>
						<select name="document_type" id="document_type" required>
							<option value="" selected disabled>Seleccione</option>
							<option value="dni">DNI</option>
							<option value="nie">NIE</option>
							<option value="passport">Pasaporte</option>
							<option value="cif">CIF</option>
							<option value="other">Otro</option>
						</select>
					</label>
					<label for="">
						<span>Número de documento *</span>
						<input type="text" name="document_number" placeholder="" autocomplete="off" />
					</label>
				</div>
				<div class="container-two-col">
					<label for="">
						<span>Nombre *</span>
						<input type="text" name="first_name" placeholder="" required autocomplete="off"/>
					</label>
					<label for="" class="container-label-last_name">
						<span>Apellido *</span>
						<input type="text" name="last_name" placeholder="" required autocomplete="off"/>
					</label>
				</div>
				<div class="container-two-col">
					<label for="">
						<span>Móvil (WhatsApp)*</span>
						<input type="tel" name="phone" placeholder="" required autocomplete="off"/>
					</label>
					<label for="">
						<span>Teléfono fijo</span>
						<input type="tel" name="landline_phone" placeholder="" autocomplete="off"/>
					</label>
				</div>
				<label for="">
					<span>Dirección *</span>
					<input type="text" name="address" id="address" placeholder="" required autocomplete="off"/>
				</label>
				<label for="">
					<span>E-mail *</span>
					<input type="email" name="email" placeholder="" required autocomplete="off"/>
				</label>
				<div class="container-two-col">
					<label for="">
						<span>Contraseña *</span>
						<input type="password" name="password" id="password_1" placeholder="" required autocomplete="off"/>
					</label>
					<label for="">
						<span>Repita la contraseña *</span>
						<input type="password" placeholder="" id="password_2" required autocomplete="off"/>
					</label>
				</div>
				<button id="lila" type="submit" disabled="true">Registrar</button>
				<span id="link-sign-in" class="span-redirect-page">Iniciar session</span>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="<?= site_url("login/validate") ?>" method="post">
				<input type="hidden" name="recaptcha-response" id="recaptcha-response-1">
				<div class="container-logo-image-dml-redirect-start">
					<a href="<?= site_url() ?>">
						<img src="<?= base_url("img/damelo_damelo_icon.webp") ?>" alt="">
					</a>
				</div>
				<h1 class="title-main-section">Iniciar Sesión</h1>
				<label for="">
					<span>E-mail</span>
					<input type="email" name="email" placeholder="Email" />
				</label>
				<label for="">
					<span>Contraseña</span>
					<input type="password" name="password" placeholder="Password" />
				</label>
				<label for="remember_session" class="container-checkbox-remember-session">
					<input type="checkbox" value="yes" name="remember_session" id="remember_session">
					<span>Recordar sessión</span>
				</label>
				<button type="submit">Iniciar sesión</button>
				<span id="link-sign-up" class="span-redirect-page">Registrarse</span>
				<a href="#">Olvidaste tu contraseña?</a>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>¡Bienvenido!</h1>
					<p>Inicia sesión con tu cuenta</p>
					<button class="ghost" id="signIn">Inicia sesión</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hola!!!</h1>
					<p>Crear tu cuenta</p>
					<button class="ghost" id="signUp">Registrar</button>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		document.addEventListener("DOMContentLoaded", ()=>{
			setTimeout(()=>{
				
				document.querySelector(".form-create-user-app").querySelectorAll("input[type='text'], input[type='email'], input[type='password']").forEach(el =>{
					el.value = "";
				})
			}, 1600);
		})

		const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');
		const linkSignUp = document.getElementById("link-sign-up");
		const linkSignIn = document.getElementById("link-sign-in");

		signUpButton.addEventListener('click', () =>
			container.classList.add('right-panel-active')
		);
		signInButton.addEventListener('click', () =>
			container.classList.remove('right-panel-active')
		);
		linkSignIn.addEventListener("click", ()=>{
		  document.querySelector(".sign-in-container").style.zIndex = 3;
		  document.querySelector(".sign-up-container").style.zIndex = 1;
		})
		linkSignUp.addEventListener("click", ()=>{
		  document.querySelector(".sign-up-container").style.zIndex = 3;
		  document.querySelector(".sign-in-container").style.zIndex = 1;
		})
	
		const document_type = document.getElementById("document_type");
		document_type.addEventListener("change", ()=>{
			if (document_type.value === "cif"){
				document.querySelector(".container-label-last_name").querySelector("span").textContent = "Apellido";
				document.querySelector(".container-label-last_name").querySelector("span").style.textDecoration = "line-through";
				document.querySelector(".container-label-last_name").querySelector("input").removeAttribute("required");
				document.querySelector(".container-label-last_name").querySelector("input").value = "";
				document.querySelector(".container-label-last_name").querySelector("input").setAttribute("readonly", true);
			}else{
				document.querySelector(".container-label-last_name").querySelector("span").textContent = "Apellido *";
				document.querySelector(".container-label-last_name").querySelector("span").removeAttribute("style");
				document.querySelector(".container-label-last_name").querySelector("input").setAttribute("required", true);
				document.querySelector(".container-label-last_name").querySelector("input").removeAttribute("readonly");
			}
		})
		const password_1 = document.getElementById("password_1");
		const password_2 = document.getElementById("password_2");
		password_2.addEventListener("input", ()=>{
			if (password_1.value === password_2.value){
				document.getElementById("lila").removeAttribute("disabled");
				password_2.removeAttribute("style");
			}else{
				document.getElementById("lila").setAttribute("disabled", true);
				password_2.style.outline = "2px solid red";
			}
		})
	</script>

	<script src="https://www.google.com/recaptcha/api.js?render=6LfyzOgqAAAAACJ17UZKM5hjWSyRo6fOmvXbR_F6"></script>
	<script>
		grecaptcha.ready(function() {
			grecaptcha.execute('6LfyzOgqAAAAACJ17UZKM5hjWSyRo6fOmvXbR_F6', {action: 'submit'}).then(function(token) {
				document.getElementById('recaptcha-response-1').value = token;
				document.getElementById('recaptcha-response-2').value = token;
			});
		});
	</script>
	<script src="<?= base_url("js/autocomplet.js") ?>"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ9aTmLYmJ84QUaEplrc5K5txuYWN9DpI&libraries=places&callback=initAutocomplete"></script>
  </body>
</html>