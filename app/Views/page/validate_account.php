<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verificación de Código</title>
  <link rel="stylesheet" href="<?= base_url(). "css/libraries/bulma.css" ?>">
  <link rel="shortcut icon" href="<?= base_url()."img/icon-app-main-1.min.png" ?>" type="image/x-icon">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .message{
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 100%;
        max-width: calc(100% - 2rem);
        z-index: 200; 
        box-sizing: border-box;
        max-width: 18rem;
    }
    body {
      margin: 0;
      padding: 0;
      background: #f0f4f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container-code-verify {
      background: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 400px;
      width: 100%;
    }

    .container-code-verify h1 {
      margin-bottom: 10px;
      color: #333;
      font-weight: bold;
    }

    .container-code-verify p {
      color: #666;
      margin-bottom: 30px;
    }

    .code-inputs {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin-bottom: 30px;
    }

    .code-inputs input {
      width: 60px;
      height: 60px;
      font-size: 24px;
      text-align: center;
      border: 2px solid #ddd;
      border-radius: 10px;
      transition: border-color 0.3s;
    }

    .code-inputs input:focus {
      border-color: #007BFF;
      outline: none;
    }

    .btn {
      background: #007BFF;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #0056b3;
    }

    @media (max-width: 420px) {
      .code-inputs input {
        width: 50px;
        height: 50px;
        font-size: 20px;
      }
    }
  </style>
</head>
<body>
    <?php if (session('error')){ ?>
	  <article class="message is-info">
		<div class="message-body">
		  <?= session('error') ?>
		</div>
	  </article>
	<?php }?>
    <div class="container-code-verify">
        <h1>¡Código Enviado!</h1>
        <p>Te hemos enviado un código de verificación a tu correo electrónico.</p>

        <form id="codeForm" method="post" action="/validate_code">
            <div class="code-inputs">
                <input type="text" name="code_1" maxlength="1" required>
                <input type="text" name="code_2" maxlength="1" required>
                <input type="text" name="code_3" maxlength="1" required>
                <input type="text" name="code_4" maxlength="1" required>
            </div>
            <button type="submit" class="btn">Verificar</button>
        </form>
    </div>

  <script>
    const inputs = document.querySelectorAll('.code-inputs input');
    inputs.forEach((input, index) => {
      input.addEventListener('input', () => {
        if (input.value.length === 1 && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
      });

      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && input.value === '' && index > 0) {
          inputs[index - 1].focus();
        }
      });
    });
  </script>
</body>
</html>
