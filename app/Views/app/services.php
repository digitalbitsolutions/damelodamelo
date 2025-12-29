<?= $this->extend("layouts/nav") ?>

<?= $this->section("css") ?>
<link rel="stylesheet" href="<?= base_url()."css/app/forms.css" ?>">
<link rel="stylesheet" href="<?= base_url()."css/ui/input_text.css" ?>">
<link rel="stylesheet" href="<?= base_url()."css/ui/input_radio.css" ?>">
<link rel="stylesheet" href="<?= base_url()."css/ui/input_checkbox.css" ?>">
<link rel="stylesheet" href="<?= base_url()."css/app/my_posts.css" ?>">
<?= $this->endSection() ?>

<?= $this->section("body") ?>
<div class="container-main">
    <div class="container-title">
        <!-- <h2>Mis publicaciones</h2> -->
    </div>
    <!-- <?php if (session()->get("user_level_id") == 1){ ?>
    <div class="tabs is-right">
        <ul>
            <li><a href="<?= site_url("post/my_posts") ?>">Propiedades</a></li>
            <li class="is-active"><a>Servicios</a></li>
        </ul>
    </div>
    <?php } ?> -->
    <?php if ($services){ foreach ($services as $pr){ ?>
    <div class="card-grid">
        <div class="card container-block-card-<?= $pr["id"] ?>">
            <div class="card-image">
                <img src="<?= base_url()."img/uploads/".$pr["cover_image"]["url"] ?>" alt="">
            </div>
            <div class="badge-container">
                
            </div>
            <div class="ctn-detils-p-m">
                
            </div>
            <div class="card-content">
                <h3><?= $pr["title"] ?></h3>
                
                <div class="card-details">
                    <span class="container-description-short" style="font-weight: bold;"><?= $user["first_name"] ?><?= !empty($user["last_name"]) ? ", ".$user["last_name"] : "" ?></span>
                </div>
                <div class="card-details">
                    <span class="container-description-short"><?= $pr["description"] ?></span>
                </div>
                <div class="card-footer">
                    <button class="button btn-redirect-update-form" data-id="<?= $pr["id"] ?>">Editar</button>
                    <button class="button btn-delete-pr-action" data-id="<?= $pr["id"] ?>">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <?php }} else{ ?>
        <h2 style="font-weight: bold;font-size: 1.2rem;width:100%;text-align:center;">Crear servicio</h2>
        <form action="<?= base_url() ?>post/create_service" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="container-main">
                <div class="container-row-form box">
                    <label for="" class="label-col-100">
                        <span class="title-label">Disponibilidad *</span>
                        <input type="text" class="input" name="availability" required>
                    </label>
                    <label for="">
                        <span class="title-label">Sitio web</span>
                        <input type="text" class="input" placeholder="(Servicio Premium)" disabled name="page_url">
                    </label>
                </div>
                <div class="container-row-form-col-1 box">
                    <div class="div-col-1">
                        <label for="">
                            <span class="title-label">Descripción *</span>
                            <textarea class="textarea" name="description" required maxlength="300"></textarea>
                        </label>
                    </div>
                </div>
                <h2 class="title-main-row-section">Tipo de servicio</h2>
                <div class="container-row-form-col-1 box">
                    <div class="div-col-3">
                        <!-- <span class="title-label">Tipo de servicio *</span> -->
                        <?php foreach($serviceType as $st){ ?>
                        <label class="radio label-radio-checkbox-col-100">
                            <input type="checkbox" class="checkbox-input-ui" hidden="" name="service_type[]" value="<?= $st["id"] ?>" />
                            <span class="checkmark-checkbox-input-ui"></span>
                            <?= $st["name"] ?>
                        </label>
                        <?php } ?>
                    </div>
                </div>


                <h2 class="title-main-row-section">Fotos y vídeos </h2>
                <div class="container-row-form-images box">
                    <div class="container-main-template-input-simple">
                        <div class="container-image">
                            <img src="<?= base_url("img/image-icon-1280x960.png") ?>" alt="Placeholder image" id="preview_cover_image">
                        </div>
                        <label for="cover_image">
                            <div class="btn-upload-image">
                                Subir imagen de portada *
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48"><g fill="none"><path fill="#ffffff" d="M44 24a2 2 0 1 0-4 0zM24 8a2 2 0 1 0 0-4zm15 32H9v4h30zM8 39V9H4v30zm32-15v15h4V24zM9 8h15V4H9zm0 32a1 1 0 0 1-1-1H4a5 5 0 0 0 5 5zm30 4a5 5 0 0 0 5-5h-4a1 1 0 0 1-1 1zM8 9a1 1 0 0 1 1-1V4a5 5 0 0 0-5 5z"/><path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="m6 35l10.693-9.802a2 2 0 0 1 2.653-.044L32 36m-4-5l4.773-4.773a2 2 0 0 1 2.615-.186L42 31m-5-13V6m-5 5l5-5l5 5"/></g></svg>
                            </div>
                            <input type="file" name="cover_image" id="cover_image" class="input-simple-main-template" accept="image/png, image/jpeg, image/jpg, image/webp" required>
                        </label>
                    </div>
                    
                    <div class="container-main-template-input-simple">
                        <div class="container-images" id="container-images">
                            <img src="<?= base_url("img/image-icon-1280x960.png") ?>" alt="Placeholder image" />
                            <img src="<?= base_url("img/image-icon-1280x960.png") ?>" alt="Placeholder image" />
                            <img src="<?= base_url("img/image-icon-1280x960.png") ?>" alt="Placeholder image" />
                        </div>
                        <label for="more_images">
                            <div class="btn-upload-image">
                                Subir imágenes (opcional)
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48"><g fill="none"><path fill="#ffffff" d="M44 24a2 2 0 1 0-4 0zM24 8a2 2 0 1 0 0-4zm15 32H9v4h30zM8 39V9H4v30zm32-15v15h4V24zM9 8h15V4H9zm0 32a1 1 0 0 1-1-1H4a5 5 0 0 0 5 5zm30 4a5 5 0 0 0 5-5h-4a1 1 0 0 1-1 1zM8 9a1 1 0 0 1 1-1V4a5 5 0 0 0-5 5z"/><path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="m6 35l10.693-9.802a2 2 0 0 1 2.653-.044L32 36m-4-5l4.773-4.773a2 2 0 0 1 2.615-.186L42 31m-5-13V6m-5 5l5-5l5 5"/></g></svg>
                            </div>
                            <input type="file" name="more_images[]" id="more_images" class="input-simple-main-template" accept="image/png, image/jpeg, image/jpg, image/webp" multiple>
                        </label>    
                    </div>

                    <div class="container-main-template-input-simple">
                        <div class="container-video" id="container-video">
                            <img src="<?= base_url("img/play-button-circle-icon.webp") ?>" alt="video" />
                            <video id="preview_video" width="500" controls style="display: none;"></video>
                        </div>
                        <label for="video">
                            <div class="btn-upload-image">
                                Subir video (max: 50MB)
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48"><g fill="none"><path fill="#ffffff" d="M44 24a2 2 0 1 0-4 0zM24 8a2 2 0 1 0 0-4zm15 32H9v4h30zM8 39V9H4v30zm32-15v15h4V24zM9 8h15V4H9zm0 32a1 1 0 0 1-1-1H4a5 5 0 0 0 5 5zm30 4a5 5 0 0 0 5-5h-4a1 1 0 0 1-1 1zM8 9a1 1 0 0 1 1-1V4a5 5 0 0 0-5 5z"/><path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="m6 35l10.693-9.802a2 2 0 0 1 2.653-.044L32 36m-4-5l4.773-4.773a2 2 0 0 1 2.615-.186L42 31m-5-13V6m-5 5l5-5l5 5"/></g></svg>
                            </div>
                            <input type="file" name="video" id="video" class="input-simple-main-template" accept="video/*">
                        </label>    
                    </div>
                </div>
                
                
                <div class="box">
                    <button class="button container-button-save" type="submit">Guardar y publicar servicio</button>
                </div>
            </div>
        </form>
    <?php } ?>
    <div class="modal" id="modal-delete-property">
        <div class="modal-background"></div>
        <div class="modal-content box">
            <h2>¿Estas seguro de eliminar?</h2>
            <button class="button btn-confirm-delete">Eliminar</button>
        </div>
        <button class="button modal-close"></button>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("js") ?>   
    <?php if (empty($services)){ ?>
        <script src="<?= base_url()."js/preview_image.js" ?>"></script>
        <script>
            preview_image_auto("more_images", "container-images");
            preview_image("cover_image", "preview_cover_image");
            preview_video("video", "preview_video");
        </script>
    <?php } ?>

    <script>
        const btns_confirm_delete = document.querySelectorAll(".btn-confirm-delete");
        const btns_delete = document.querySelectorAll(".btn-delete-pr-action");
        let id_delete = null;
        btns_delete.forEach((btn)=>{
            btn.addEventListener("click", ()=>{
                id_delete = btn.dataset.id;
                openModal(document.getElementById("modal-delete-property"));
            });
        });
        btns_confirm_delete.forEach(btn =>{
            btn.addEventListener("click", async()=>{
                btn.disabled = true;
                btn.textContent = "Eliminando...";
                await fetch("<?= site_url("post/services/delete") ?>?id="+String(id_delete)).then(res => res.json()).then(data =>{
                    closeModal(document.getElementById("modal-delete-property"));
                    btn.removeAttribute("disabled");
                    btn.textContent = "Eliminar";
                    document.querySelector(".container-block-card-"+String(id_delete)).classList.add("scale-out-center");
                    setTimeout(()=>{
                        document.querySelector(".container-block-card-"+String(id_delete)).remove();
                    }, 500);
                });
            })
        })
        const btns_redirect = document.querySelectorAll(".btn-redirect-update-form");
        btns_redirect.forEach((btn)=>{
            btn.addEventListener("click", ()=>{
                location.href = "<?= site_url("post/services/update_form/") ?>" + String(btn.dataset.id);
            });
        })
    </script>
<?= $this->endSection() ?>
