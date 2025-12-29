<?= $this->extend("layouts/nav") ?>
<?= $this->section("css") ?>
<link rel="stylesheet" href="<?= base_url()."css/app/create_post.css" ?>">
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
        <div class="ctn-img">
            <!-- <img src="<?= base_url()."img/modern-spanish-style-house.webp" ?>" alt=""> -->
        </div>
    </div>
    <form action="<?= base_url() ?>post/create" method="post" enctype="multipart/form-data">
        <div class="container-all-inputs">
            <div class="container-title-row">
                <h2>Datos del inmueble</h2>
            </div>
            <div class="container-section-1">
                <div class="container-col-1">
                    <label for="">
                        <span>Título *</span>
                        <input type="text" class="input" name="title" required>
                    </label>
                    <label for="">
                        <span>Descripción *</span>
                        <textarea class="textarea" placeholder="" name="description" required></textarea>
                    </label>
                </div>
                <div class="container-col-2">
                    <label for="">
                        <span>Tipo de propiedad *</span>
                        <div class="select">
                            <select name="type" required>
                                <option>Seleccione</option>
                                <?php foreach($type as $t){ ?>
                                    <option value="<?= $t["id"] ?>"><?= $t["name"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </label>
                    <label for="">                        
                        <span>Alquiler o venta *</span>
                        <div class="select">
                            <select name="category" required>
                                <option>Seleccione</option>
                                <?php foreach($category as $c){ ?>
                                    <option value="<?= $c["id"] ?>"><?= $c["name"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </label>
                    <label for="">
                        <span>m² Construidos (m²) *</span>
                        <input type="text" class="input" name="meters_built" required>            
                    </label>
                    <label for="">
                        <span>m² Útiles (m²)</span>
                        <input type="text" class="input" name="useful_meters">
                    </label>
                    <label for="">
                        <span>Planta</span>
                        <input type="text" class="input" name="plant">
                    </label>
                    <label for="">
                        <span>Precio *</span>
                        <input type="text" class="input" name="price" required>
                    </label>
                    <label for="">
                        <span>Año de construcción</span>
                        <input type="text" class="input" name="year_of_construction">
                    </label>
                    <label for="">
                        <span>Dormitorios *</span>
                        <input type="text" class="input" name="bedrooms" required>
                    </label>
                    <label for="">
                        <span>Baños *</span>
                        <input type="text" class="input" name="bathrooms" required>
                    </label>
                    <label for="">
                        <span>Parking</span>
                        <input type="text" class="input" name="parking">
                    </label>
                </div>
            </div>
            <div class="container-title-row">
                <h2>Características de la propiedad</h2>
                <button class="button is-dark is-small" type="button" onclick="openModal(document.getElementById('modal-create-feature'))">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="#ffffff" stroke-dasharray="16" stroke-dashoffset="16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M5 12h14"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="16;0"/></path><path d="M12 5v14"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.4s" values="16;0"/></path></g></svg>
                    Nueva característica
                </button>
            </div>
            <div class="container-section-2">
                <div class="checkboxes">
                    <?php foreach($feature as $f){ ?>
                        <label class="checkbox">
                            <input type="checkbox" value="<?= $f["id"] ?>" name="feature[]" />
                            <?= $f["name"] ?>
                        </label>
                    <?php } ?>
                </div>
            </div>
            <div class="container-title-row">
                <h2>Dirección del inmueble</h2>
            </div>
            <div class="container-section-3">
                <label for="">
                    <span>País *</span>
                    <div class="select">
                        <select name="country" required>
                            <option>Seleccione</option>
                            <?php foreach($country as $co){ ?>
                                <option value="<?= $co["id"] ?>"><?= $co["name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </label>
                <label for="">
                    <span>Ciudad *</span>
                    <div class="select">
                        <select name="city" required>
                            <option>Seleccione</option>
                            <?php foreach($city as $ci){ ?>
                                <option value="<?= $ci["id"] ?>"><?= $ci["name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </label>
                <label for="">
                    <span>Estado / Provincia *</span>
                    <div class="select">
                        <select name="province" required>
                            <option>Seleccione</option>
                            <?php foreach($province as $pr){ ?>
                                <option value="<?= $pr["id"] ?>"><?= $pr["name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </label>
                <label for="">
                    <span>Dirección de la calle *</span>
                    <input type="text" class="input" name="address" required>
                </label>
                <label for="">
                    <span>Cerca a</span>
                    <input type="text" class="input" name="close_to">
                </label>
                <label for="">
                    <span>ZIP/Código postal</span>
                    <input type="text" class="input" name="zip_code">
                </label>
            </div>
            <div class="container-title-row">
                <h2>Imágenes del inmueble</h2>
            </div>
            <div class="container-section-4">
                <div class="container-main-template-input-simple">
                    <span>Imagen de portada *</span>
                    <div class="container-image">
                        <img src="" alt="" id="preview_cover_image">
                    </div>
                    <label for="cover_image">
                        <div class="btn-upload-image">
                            Subir imagen
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48"><g fill="none"><path fill="#ffffff" d="M44 24a2 2 0 1 0-4 0zM24 8a2 2 0 1 0 0-4zm15 32H9v4h30zM8 39V9H4v30zm32-15v15h4V24zM9 8h15V4H9zm0 32a1 1 0 0 1-1-1H4a5 5 0 0 0 5 5zm30 4a5 5 0 0 0 5-5h-4a1 1 0 0 1-1 1zM8 9a1 1 0 0 1 1-1V4a5 5 0 0 0-5 5z"/><path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="m6 35l10.693-9.802a2 2 0 0 1 2.653-.044L32 36m-4-5l4.773-4.773a2 2 0 0 1 2.615-.186L42 31m-5-13V6m-5 5l5-5l5 5"/></g></svg>
                        </div>
                        <input type="file" name="cover_image" id="cover_image" class="input-simple-main-template" accept="image/*" required>
                    </label>
                </div>
                <div class="container-main-template-input-simple  container-main-template-input-simple-multiple">
                    <span>Mas imágenes *</span>
                    <div class="container-images" id="container-images">
                        
                    </div>
                    <label for="more_images">
                        <div class="btn-upload-image">
                            Subir imagen
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48"><g fill="none"><path fill="#ffffff" d="M44 24a2 2 0 1 0-4 0zM24 8a2 2 0 1 0 0-4zm15 32H9v4h30zM8 39V9H4v30zm32-15v15h4V24zM9 8h15V4H9zm0 32a1 1 0 0 1-1-1H4a5 5 0 0 0 5 5zm30 4a5 5 0 0 0 5-5h-4a1 1 0 0 1-1 1zM8 9a1 1 0 0 1 1-1V4a5 5 0 0 0-5 5z"/><path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="m6 35l10.693-9.802a2 2 0 0 1 2.653-.044L32 36m-4-5l4.773-4.773a2 2 0 0 1 2.615-.186L42 31m-5-13V6m-5 5l5-5l5 5"/></g></svg>
                        </div>
                        <input type="file" name="more_images[]" id="more_images" class="input-simple-main-template" accept="image/*" multiple required>
                    </label>
                </div>
            </div>
            <div class="container-btn-submit">
                <button class="button  is-info is-dark" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7M7 3v4a1 1 0 0 0 1 1h7"/></g></svg>
                    Guardar
                </button>
            </div>
        </div>
    </form>
</div>
<div class="modal" id="modal-create-feature">
    <div class="modal-background"></div>
    <div class="modal-content box is-small">
        <div>
            <h1>Agregar nueva característica</h1>
        </div>
        <form>
            <label for="">
                <span>Nueva característica</span>
                <input type="text" class="input" placeholder="">
            </label>
            <div class="container-buttons-modal">
                <button class="button is-danger">Cerrar</button>
                <button class="button is-primary">Agregar</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section("js") ?>
<script src="<?= base_url()."js/preview_image.js" ?>"></script>
<script>
    preview_image_auto("more_images", "container-images");
    preview_image("cover_image", "preview_cover_image");
</script>
<?= $this->endSection() ?>