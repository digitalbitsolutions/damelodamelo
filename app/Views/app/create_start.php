<?= $this->extend("layouts/nav") ?>
<?= $this->section("css") ?>
<link rel="stylesheet" href="<?= base_url()."css/app/create_start.css" ?>">
<?= $this->endSection() ?>

<?= $this->section("body") ?>

<div class="container-main">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="notification is-link">
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
    <div class="container-message">
        <div class="ctn-text">
            <h1>Publica Tu Propiedad en Minutos</h1>
            <h2>Completa los detalles para que tu propiedad destaque y llegue a los interesados.</h2>
        </div>
        <div class="options-container">
            <a href="<?= site_url("post/create_form/1"); ?>" class="ctn-img card">
                <div class="container-main-img">
                    <img src="<?= base_url()."img/casa-1.webp" ?>" alt="">
                </div>
                <footer class="card-footer">
                    <span class="card-footer-item">Casa o chalet</span>
                </footer>
            </a>
            <a href="<?= site_url("post/create_form/15"); ?>" class="ctn-img card">
                <div class="container-main-img">
                    <img src="<?= base_url()."img/casa-rustica.png" ?>" alt="">
                </div>
                <footer class="card-footer">
                    <span class="card-footer-item">Casa rústica</span>
                </footer>
            </a>
            <a href="<?= site_url("post/create_form/13"); ?>" class="ctn-img card">
                <div class="container-main-img">
                    <img src="<?= base_url()."img/piso-icon.png" ?>" alt="">
                </div>
                <footer class="card-footer">
                    <span class="card-footer-item">Piso</span>
                </footer>
            </a>
            <a href="<?= site_url("post/create_form/4"); ?>" class="ctn-img card">
                <div class="container-main-img">
                    <img src="<?= base_url()."img/nave-local-icon.avif" ?>" alt="">
                </div>
                <footer class="card-footer">
                    <span class="card-footer-item">Local o nave</span>
                </footer>
            </a>
            <a href="<?= site_url("post/create_form/14"); ?>" class="ctn-img card">
                <div class="container-main-img">
                    <img src="<?= base_url()."img/garaje-icon.png" ?>" alt="">
                </div>
                <footer class="card-footer">
                    <span class="card-footer-item">Garaje</span>
                </footer>
            </a>
            <a href="<?= site_url("post/create_form/9"); ?>" class="ctn-img card">
                <div class="container-main-img">
                    <img src="<?= base_url()."img/pueblo-terreno_1.avif" ?>" alt="">
                </div>
                <footer class="card-footer">
                    <span class="card-footer-item">Terreno</span>
                </footer>
            </a>
            
            <!-- <a href="<?= site_url("post/create_form/service"); ?>" class="ctn-img card">
                <div class="container-main-img">
                    <img src="<?= base_url()."img/servicio-de-servicio-de-casa.jpg" ?>" alt="">
                </div>
                <footer class="card-footer">
                    <span class="card-footer-item">Servicios</span>
                </footer>
            </a> -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("js") ?>
<?= $this->endSection() ?>