<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dámelo Dámelo</title>
    <link rel="shortcut icon" href="<?= base_url()."img/damelo_damelo_icon.webp" ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url()."css/libraries/bulma.css" ?>">
    <link rel="stylesheet" href="<?= base_url()."css/app/nav.css" ?>">
    <?= $this->renderSection("css") ?>
</head>
<body>
    <div class="nav__container-all">
        <div class="loader-container-type-classroom">
            <div class="loader-line-type-classroom"></div>
        </div>
        <div class="nav__container-main" id="container-main-nav-left">
            <button class="btn-close-nav">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16"><path fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.25 3.75L7.75 8l4.5 4.25m-5-8.5L2.75 8l4.5 4.25"/></svg>
            </button>
            <div class="nav__container-logo">
                <a href="<?= base_url() ?>">
                    <img src="<?= base_url(). "img/damelo_damelo.webp" ?>" alt="icon">
                </a>
            </div>
            <div class="nav__container-button-main">
                <?php if (session()->get("user_level_id") == 1 || session()->get("user_level_id") == 5){ ?>
                <a href="<?= site_url("post/index") ?>">
                    <button class="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="#ffffff" stroke-dasharray="16" stroke-dashoffset="16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M5 12h14"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="16;0"/></path><path d="M12 5v14"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.4s" values="16;0"/></path></g></svg>
                        Agregar propiedad
                    </button>
                </a>
                <?php }if (session()->get("user_level_id") == 1){ ?>
                <a href="<?= site_url("post/create_form/service"); ?>">
                    <button class="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="#ffffff" stroke-dasharray="16" stroke-dashoffset="16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M5 12h14"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="16;0"/></path><path d="M12 5v14"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.4s" values="16;0"/></path></g></svg>
                        Proveedor de servicios
                    </button>
                </a>
                <?php } ?>
            </div>
            <div class="nav__container-buttons">
                <a href="<?= site_url("home") ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a1 1 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13m7 7v-5h4v5zm2-15.586l6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586z"/></svg>
                    Home
                </a>
                <?php if (session()->get("user_level_id") == 1 || session()->get("user_level_id") == 5){ ?>
                    <a href="<?= site_url("post/my_posts") ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16"><path fill="" fill-rule="evenodd" d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm7.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5M10.5 5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM13 8h-2V6h2z"/></svg>
                        Propiedades
                    </a>    
                <?php }else if (session()->get("user_level_id") == 4){ ?>
                    <a href="<?= site_url("post/services") ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16"><path fill="" fill-rule="evenodd" d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm7.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5M10.5 5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM13 8h-2V6h2z"/></svg>
                        Mis servicios
                    </a>
                <?php } ?>
                <?php if (session()->get("user_level_id") == 1){ ?>
                <a href="<?= site_url("users") ."?ul=4"?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 64 64"><path d="M21.8 36.8c6.9 0 12.4-5.6 12.4-12.4S28.6 12 21.8 12S9.4 17.5 9.4 24.4S15 36.8 21.8 36.8m0-20.4c4.4 0 7.9 3.6 7.9 7.9s-3.6 7.9-7.9 7.9c-4.4 0-7.9-3.6-7.9-7.9s3.5-7.9 7.9-7.9m0 23.5c-7.2 0-14.1 2.9-19.4 8.3c-.9.9-.9 2.3 0 3.2c.4.4 1 .7 1.6.7s1.2-.2 1.6-.7c4.4-4.5 10.2-7 16.2-7c5.9 0 11.7 2.5 16.2 7c.9.9 2.3.9 3.2 0s.9-2.3 0-3.2c-5.3-5.3-12.2-8.3-19.4-8.3m25.5-3.1c4 0 7.3-3.3 7.3-7.3s-3.3-7.3-7.3-7.3s-7.3 3.3-7.3 7.3c-.1 4 3.2 7.3 7.3 7.3m0-10.2c1.6 0 2.8 1.3 2.8 2.8c0 1.6-1.3 2.8-2.8 2.8s-2.8-1.3-2.8-2.8c-.1-1.5 1.2-2.8 2.8-2.8m14.2 19c-5.3-4.9-12.6-6.9-19.9-5c-1.2.3-1.9 1.5-1.6 2.7s1.6 1.9 2.7 1.6c5.8-1.5 11.6 0 15.7 3.9c.4.4 1 .6 1.5.6c.6 0 1.2-.2 1.6-.7c1-.8.9-2.2 0-3.1"/></svg>
                    Proveedores de servicio
                </a>
                <a href="<?= site_url("users") ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 64 64"><path d="M21.8 36.8c6.9 0 12.4-5.6 12.4-12.4S28.6 12 21.8 12S9.4 17.5 9.4 24.4S15 36.8 21.8 36.8m0-20.4c4.4 0 7.9 3.6 7.9 7.9s-3.6 7.9-7.9 7.9c-4.4 0-7.9-3.6-7.9-7.9s3.5-7.9 7.9-7.9m0 23.5c-7.2 0-14.1 2.9-19.4 8.3c-.9.9-.9 2.3 0 3.2c.4.4 1 .7 1.6.7s1.2-.2 1.6-.7c4.4-4.5 10.2-7 16.2-7c5.9 0 11.7 2.5 16.2 7c.9.9 2.3.9 3.2 0s.9-2.3 0-3.2c-5.3-5.3-12.2-8.3-19.4-8.3m25.5-3.1c4 0 7.3-3.3 7.3-7.3s-3.3-7.3-7.3-7.3s-7.3 3.3-7.3 7.3c-.1 4 3.2 7.3 7.3 7.3m0-10.2c1.6 0 2.8 1.3 2.8 2.8c0 1.6-1.3 2.8-2.8 2.8s-2.8-1.3-2.8-2.8c-.1-1.5 1.2-2.8 2.8-2.8m14.2 19c-5.3-4.9-12.6-6.9-19.9-5c-1.2.3-1.9 1.5-1.6 2.7s1.6 1.9 2.7 1.6c5.8-1.5 11.6 0 15.7 3.9c.4.4 1 .6 1.5.6c.6 0 1.2-.2 1.6-.7c1-.8.9-2.2 0-3.1"/></svg>
                    Usuarios
                </a>
                <a href="<?= site_url("post/blogs") ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path d="M3 9.009a6.01 6.01 0 0 1 6.01-6.01H12a6.01 6.01 0 0 1 6.01 5.982h.943c1.15 0 2.047.896 2.047 2.047v3.962A6.01 6.01 0 0 1 14.99 21H9.01A6.01 6.01 0 0 1 3 14.99zm6.01-4.01A4.01 4.01 0 0 0 5 9.01v5.981A4.01 4.01 0 0 0 9.01 19h5.98A4.01 4.01 0 0 0 19 14.99V11h-1c-1.076 0-2-.924-2-2c0-2.214-1.786-4-4-4zM8 9a1 1 0 0 1 1-1h3.5a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1m1 5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2z"/></svg>
                    Artículos
                </a>
                <?php } ?>
                <a href="<?= site_url("user/update") ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="" fill-rule="evenodd" clip-rule="evenodd"><path d="M16 9a4 4 0 1 1-8 0a4 4 0 0 1 8 0m-2 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0"/><path d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1M3 12c0 2.09.713 4.014 1.908 5.542A8.99 8.99 0 0 1 12.065 14a8.98 8.98 0 0 1 7.092 3.458A9 9 0 1 0 3 12m9 9a8.96 8.96 0 0 1-5.672-2.012A6.99 6.99 0 0 1 12.065 16a6.99 6.99 0 0 1 5.689 2.92A8.96 8.96 0 0 1 12 21"/></g></svg>
                    Mis datos
                </a>
                <a href="<?= site_url("login/close_session") ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 1024 1024"><path fill="" d="M512 1024q-139 0-257-68.5T68.5 769T0 512q0-97 34.5-185T132 170q3-3 11.5-12t14-14.5t15-10.5t19.5-5q26 0 45 19t19 45q0 16-3.5 28t-7.5 16l-3 5q-54 53-84 123t-30 148q0 104 51.5 192.5t140 140T512 896t192.5-51.5t140-140T896 512q0-78-30-148.5T783 240q-15-15-15-48q0-26 19-45t45-19q7 0 13.5 2t10.5 4t10.5 8t8.5 8.5t9 10.5t8 9q63 69 97.5 157t34.5 185q0 104-40.5 199t-109 163.5t-163.5 109t-199 40.5m0-512q-27 0-45.5-18.5T448 448V64q0-27 19-45.5T512.5 0t45 18.5T576 64v384q0 27-18.5 45.5T512 512"/></svg>
                    Cerrar sessión
                </a>
            </div>
        </div>
        <div class="nav__container-body" id="nav__container-body">
            <div class="header-body-main-view-data-user">
                <h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="#ffffff" d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19M12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4"/></svg>    
                    <?= session()->get("user_first_name") ?><?= !empty(session()->get("user_last_name")) ? ", ".session()->get("user_last_name") : "" ?>
                </h2>
            </div>
            <button class="btn-open-nav">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 17l5-5l-5-5m7 10l5-5l-5-5"/></svg>
            </button>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="notification">
                    <button class="delete"></button>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="notification is-warning">
                    <button class="delete"></button>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <div class="nav__container-body__mask">
                <?= $this->renderSection("body") ?>        
            </div>
        </div>
    </div>
    <script src="<?= base_url()."js/libraries/bulma.modal.min.js" ?>"></script>
    <script src="<?= base_url()."js/nav_app.js" ?>"></script>
    <?= $this->renderSection("js") ?>
</body>
</html>