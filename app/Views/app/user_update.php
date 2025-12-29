<?= $this->extend("layouts/nav") ?>

<?= $this->section("css") ?>
<link rel="stylesheet" href="<?= base_url()."css/app/user_update.css" ?>">
<link rel="stylesheet" href="<?= base_url()."css/ui/input_file.css" ?>">
<link rel="stylesheet" href="<?= base_url()."css/app/map_address.css" ?>">
<?= $this->endSection() ?>

<?= $this->section("body") ?>

<div class="container-main">
    <div class="container-title">
        <h2 class="title is-2">Actualice sus datos</h2>
    </div>
    <form action="<?= site_url("user/update/save") ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="city" value="<?= !empty($userAddress) ? $userAddress[0]["city"] : "" ?>" id="city">
        <input type="hidden" name="postal_code" value="<?= !empty($userAddress) ? $userAddress[0]["postal_code"] : "" ?>" id="postal_code">
        <input type="hidden" name="province" value="<?= !empty($userAddress) ? $userAddress[0]["province"] : "" ?>" id="province">
        <input type="hidden" name="country" value="<?= !empty($userAddress) ? $userAddress[0]["country"] : "" ?>" id="country">
        <input type="hidden" name="latitude" value="<?= !empty($userAddress) ? $userAddress[0]["latitude"] : "" ?>" id="latitude">
        <input type="hidden" name="longitude" value="<?= !empty($userAddress) ? $userAddress[0]["longitude"] : "" ?>" id="longitude">
        
        <div class="container-labels">
            <label for="">
                <span>Nombre *</span>
                <input type="text" name="first_name" value="<?= $user["first_name"] ?>" class="input" required autocomplete="off">
            </label>
            <label for="" class="container-label-last_name">
                <span>Apellido *</span>
                <input type="text" name="last_name" value="<?= $user["last_name"] ?>" class="input" required autocomplete="off">
            </label>
            <label for="">
                <span>E-mail *</span>
                <input type="email" name="email" value="<?= $user["email"] ?>" class="input" required autocomplete="off">
            </label>
            <label for="">
                <span>Teléfono *</span>
                <input type="tel" name="phone" value="<?= $user["phone"] ?>" class="input" required autocomplete="off">
            </label>
            <label for="">
                <span>Teléfono fijo</span>
                <input type="tel" name="landline_phone" value="<?= $user["landline_phone"] ?>" class="input" autocomplete="off">
            </label>
            <label for="">
                <span>Documento</span>
                <div class="container-input-select">
                    <div class="select">
                        <select name="document_type" id="document_type" required>
                            <option value="dni" <?= $user["document_type"] == "dni" ? "selected" : ""  ?>>DNI</option>
                            <option value="nie" <?= $user["document_type"] == "nie" ? "selected" : ""  ?>>NIE</option>
                            <option value="cif" <?= $user["document_type"] == "cif" ? "selected" : ""  ?>>CIF</option>
                            <option value="passport" <?= $user["document_type"] == "passport" ? "selected" : ""  ?>>Pasaporte</option>
                            <option value="other" <?= $user["document_type"] == "other" ? "selected" : ""  ?>>Otros</option>
                        </select>
                    </div>
                    <input type="text" name="document_number" value="<?= $user["document_number"] ?>" class="input" required autocomplete="off">
                </div>
            </label>
            <label for="" class="label-col-100">
                <span class="title-label">Direccion *</span>
                <div class="container-google-maps-required-tags">
                    <input type="text" class="input" value="<?= $user["address"] ?>" id="address" name="address" required autocomplete="off">
                    <button class="button" type="button" id="button-open-map-google"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><g fill="none" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="#666666"><path d="M15.129 13.747a.906.906 0 0 1-1.258 0c-1.544-1.497-3.613-3.168-2.604-5.595A3.53 3.53 0 0 1 14.5 6c1.378 0 2.688.84 3.233 2.152c1.008 2.424-1.056 4.104-2.604 5.595M14.5 9.5h.009"/><path d="M2.5 12c0-4.478 0-6.718 1.391-8.109S7.521 2.5 12 2.5c4.478 0 6.718 0 8.109 1.391S21.5 7.521 21.5 12c0 4.478 0 6.718-1.391 8.109S16.479 21.5 12 21.5c-4.478 0-6.718 0-8.109-1.391S2.5 16.479 2.5 12M17 21L3 7m7 7l-6 6"/></g></svg></button>
                </div>
            </label>
            <label for="">
                <span>Nombre de usuario</span>
                <input type="text" name="user_name" value="<?= $user["user_name"] ?>" class="input" autocomplete="off" <?= empty($user["user_name"]) ? "" : "readonly" ?>>
            </label>
            <label for="">
                <span>Nueva contraseña</span>
                <input type="password" name="password" value="" class="input" autocomplete="off">
            </label>
        </div>
        <label class="container-input-image">

            <div class="container-ui-file" for="file"> 
                <div class="header-ui"> 
                    <?php if(!empty($user["photo"])){ ?>
                        <img src="<?= base_url("img/photo_profile/").$user["photo"] ?>" id="view-photo" alt="">
                    <?php }else{ ?>
                        <img src="" id="view-photo" alt="">
                        <svg class="temp-d" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><g fill="none" stroke="#0284c7" stroke-linecap="round" stroke-width="1.5"><path stroke-linejoin="round" d="M21.25 13V8.5a5 5 0 0 0-5-5h-8.5a5 5 0 0 0-5 5v7a5 5 0 0 0 5 5h6.26"/><path stroke-linejoin="round" d="m3.01 17l2.74-3.2a2.2 2.2 0 0 1 2.77-.27a2.2 2.2 0 0 0 2.77-.27l2.33-2.33a4 4 0 0 1 5.16-.43l2.47 1.91M8.01 10.17a1.66 1.66 0 1 0-.02-3.32a1.66 1.66 0 0 0 .02 3.32"/><path stroke-miterlimit="10" d="M18.707 15v5"/><path stroke-linejoin="round" d="m21 17.105l-1.967-1.967a.46.46 0 0 0-.652 0l-1.967 1.967"/></g></svg>
                        <p class="temp-d">Buscar logo para cargar</p>
                    <?php } ?>
                </div> 
                <div class="footer-ui"> 
                    <svg fill="#000000" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M15.331 6H8.5v20h15V14.154h-8.169z"></path><path d="M18.153 6h-.009v5.342H23.5v-.002z"></path></g></svg> 
                    <p class="name-image-text">
                        <?= !empty($user["photo"]) ? "Tienes un logo" : "Imagen no seleccionado" ?>
                    </p> 
                </div> 
                <input id="file-photo" class="input-file-ui" name="photo" type="file" accept="image/*"> 
            </div>
        </label>

        <div class="container-button">
            <button class="button" type="submit">Guardar cambios</button>
        </div>
    </form>
</div>
<div class="modal" id="modal-view-map-select">
    <div class="modal-background"></div>
    <div class="modal-content box">
        <div class="message-title-map">
            <h3>Seleccione ubicación</h3>
            <p>Arrastre el marcador a la ubicación exacta de la propiedad.</p>
        </div>
        <div class="container-map-google">
            <div id="map"></div>
        </div>
        <div class="container-details-map">
            <div class="container-row-value">
                <span class="name-attr">Calle:</span>
                <span class="value-attr" id="route-map"></span>
            </div>
            <div class="container-row-value">
                <span class="name-attr">Ciudad:</span>
                <span class="value-attr" id="city-map"></span>
            </div>
            <div class="container-row-value">
                <span class="name-attr">Provincia:</span>
                <span class="value-attr" id="state-map"></span>
            </div>
            <div class="container-row-value">
                <span class="name-attr">Pais: </span>
                <span class="value-attr" id="country-map"></span>
            </div>
        </div>
        <div class="container-controls-map">
            <button class="button" onclick="closeModal(document.getElementById('modal-view-map-select'))">Cerrar</button>
            <button class="button" id="my-location">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="#666666" d="M12 2c-4.4 0-8 3.6-8 8c0 5.4 7 11.5 7.3 11.8c.2.1.5.2.7.2s.5-.1.7-.2C13 21.5 20 15.4 20 10c0-4.4-3.6-8-8-8m0 17.7c-2.1-2-6-6.3-6-9.7c0-3.3 2.7-6 6-6s6 2.7 6 6s-3.9 7.7-6 9.7M12 6c-2.2 0-4 1.8-4 4s1.8 4 4 4s4-1.8 4-4s-1.8-4-4-4m0 6c-1.1 0-2-.9-2-2s.9-2 2-2s2 .9 2 2s-.9 2-2 2"/></svg>  
                Mi ubicación
            </button>
        </div>
    </div>
    <button class="button modal-close"></button>
</div>
<?= $this->endSection() ?>

<?= $this->section("js") ?>
<script src="<?= base_url()."js/preview_image.js" ?>"></script>
<script>
    preview_image("file-photo", "view-photo");
    const file_photo = document.getElementById("file-photo");
    file_photo.addEventListener("change", ()=>{
        console.log(file_photo.files[0]);
        document.querySelectorAll(".temp-d").forEach(e=>{
            e.remove();
        });
        document.querySelector(".name-image-text").textContent = "Seleccionado 1 foto";

    });
    const document_type = document.getElementById("document_type");
    const input_update = ()=>{
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
    }
    document_type.addEventListener("change", ()=>{
        input_update();
    })
    input_update();
    
    const open_modal_addres = document.getElementById("button-open-map-google");
    open_modal_addres.addEventListener("click", ()=>{
        openModal(document.getElementById('modal-view-map-select'))
    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ9aTmLYmJ84QUaEplrc5K5txuYWN9DpI&libraries=places"></script>
<script src="<?= base_url("js/google_maps.js") ?>"></script>

<?= $this->endSection() ?>