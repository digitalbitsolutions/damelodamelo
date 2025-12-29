<?= $this->extend("layouts/nav") ?>

<?= $this->section("css") ?>
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
            <li class="is-active"><a>Propiedades</a></li>
            <li><a href="<?= site_url("post/services") ?>">Servicios</a></li>
        </ul>
    </div>
    <?php } ?> -->
    <br>
    <form action="" method="get">
        <div class="container-inputs-form">
            <label for="ds">
                Fecha de inicio
                <input type="date" name="ds" id="ds" class="input">
            </label>
            <label for="de">
                Fecha de Final
                <input type="date" name="de" id="de" class="input">
            </label>
        </div>
        <div class="container-button-submit">
            <button class="button">Buscar</button>
        </div>
    </form>
    <div class="card-grid">
        <?php if ($property){ foreach ($property as $pr){ ?>
        <div class="card container-block-card-<?= $pr["id"] ?>">
            <div class="card-image">
                <img src="<?= base_url()."img/uploads/".$pr["cover_image"]["url"] ?>" alt="">
            </div>
            <div class="badge-container">
                <span class="badge"><?= $pr["type_name"] ?></span>
                <span class="badge"><?= $pr["category_name"] ?></span>
            </div>
            <div class="ctn-detils-p-m">
                <span><span class="meters-span"><?= $pr["meters_built"] ?></span> m² - <span class="price-span"><?= !empty($pr["sale_price"]) ? $pr["sale_price"] :  (!empty($pr["rental_price"]) ? $pr["rental_price"] : "") ?></span> €</span>
            </div>
            <div class="card-content">
                <h3><?= $pr["title"] ?></h3>
                <div class="ctn-location">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#666666" d="M12 3a7 7 0 0 0-7 7c0 2.862 1.782 5.623 3.738 7.762A26 26 0 0 0 12 20.758q.262-.201.615-.49a26 26 0 0 0 2.647-2.504C17.218 15.623 19 12.863 19 10a7 7 0 0 0-7-7m0 20.214l-.567-.39l-.003-.002l-.006-.005l-.02-.014l-.075-.053l-.27-.197a28 28 0 0 1-3.797-3.44C5.218 16.875 3 13.636 3 9.999a9 9 0 0 1 18 0c0 3.637-2.218 6.877-4.262 9.112a28 28 0 0 1-3.796 3.44a17 17 0 0 1-.345.251l-.021.014l-.006.005l-.002.001zM12 8a2 2 0 1 0 0 4a2 2 0 0 0 0-4m-4 2a4 4 0 1 1 8 0a4 4 0 0 1-8 0"/></svg>
                    <span><?= $pr["address"] ?></span>
                </div>
                <div class="card-details">
                    <!-- <div >
                        <span>Dormitorios</span>
                        <div class="ctn-icons-row">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><g fill="none" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="#666666"><path d="M22 17.5H2M22 21v-5c0-1.886 0-2.828-.586-3.414S19.886 12 18 12H6c-1.886 0-2.828 0-3.414.586S2 14.114 2 16v5m14-9v-1.382c0-.508-.091-.677-.56-.877C14.463 9.324 13.278 9 12 9s-2.463.324-3.44.74c-.468.2-.56.37-.56.878V12"/><path d="M20 12V7.36c0-.691 0-1.037-.17-1.363c-.172-.327-.415-.496-.902-.834A12.1 12.1 0 0 0 12 3c-2.577 0-4.966.8-6.928 2.163c-.487.338-.73.507-.901.834S4 6.669 4 7.36V12"/></g></svg>
                            <span><?= $pr["bedrooms"] ?></span>
                        </div>
                    </div>
                    <div>
                        <span>Baños</span>
                        <div class="ctn-icons-row">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><g fill="none" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="#666666"><path d="M14.4 14c.972-.912 1.6-2.364 1.6-4c0-2.761-1.79-5-4-5s-4 2.239-4 5c0 1.636.628 3.088 1.6 4m-1.493 0h7.786c.586 0 1.107.414 1.107 1c0 1.51-.67 3.09-1.729 4.126c-.525.514-1.036 1.046-.4 1.743c.095.104.206.195.299.303c.328.376-.024.828-.447.828H9.277c-.423 0-.775-.452-.447-.828c.093-.108.204-.199.3-.303c.635-.697.123-1.23-.401-1.743C7.669 18.09 7 16.51 7 15c0-.586.521-1 1.107-1"/><path d="M18.29 12c.594 0 1.093-.43 1.152-.994l.367-3.504c.214-2.033.32-3.05-.076-3.818c-.987-1.912-3.3-1.675-5.139-1.675H9.406c-1.84 0-4.152-.237-5.139 1.675c-.396.768-.29 1.785-.077 3.818l.368 3.504c.06.564.558.994 1.153.994"/></g></svg>
                            <span><?= $pr["bathrooms"] ?></span>
                        </div>
                    </div>
                    <div>
                        <span>Parking</span>
                        <div class="ctn-icons-row">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><path fill="#666666" d="M448 255.454h-.511L407.067 164.5A48.04 48.04 0 0 0 363.2 136H148.8a48.04 48.04 0 0 0-43.863 28.5l-40.426 90.954H64a32.036 32.036 0 0 0-32 32v112a32.036 32.036 0 0 0 32 32V472a24.03 24.03 0 0 0 24 24h56a24.03 24.03 0 0 0 24-24v-40.546h176V472a24.03 24.03 0 0 0 24 24h56a24.03 24.03 0 0 0 24-24v-40.546a32.036 32.036 0 0 0 32-32v-112a32.036 32.036 0 0 0-32-32M134.175 177.5A16.01 16.01 0 0 1 148.8 168h214.4a16.01 16.01 0 0 1 14.621 9.5l34.646 77.953H99.529ZM136 464H96v-32.546h40Zm280 0h-40v-32.546h40Zm32-64.546H64v-112h384Z"/><path fill="#666666" d="M96 328h80v32H96zm240 0h80v32h-80zM256 14.758L16 111.121v34.483l240-96.362l240 96.362v-34.483z"/></svg>
                            <span><?= $pr["parking"] ?></span>
                        </div>
                    </div> -->
                </div>
                <div class="card-footer">
                    <button class="button btn-redirect-update-form tooltip" data-tooltip="Editar" data-id="<?= $pr["id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="#8c76e1ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m5 16l-1 4l4-1L19.586 7.414a2 2 0 0 0 0-2.828l-.172-.172a2 2 0 0 0-2.828 0zM15 6l3 3m-5 11h8"/></svg></button>
                    <button class="button btn-disabled-pr-action <?= $pr["state_id"] == 5 ? "" : "btn-disabled-style-app" ?> tooltip" data-tooltip="<?= $pr["state_id"] == 5 ? "Habilitar" :"Deshabilitar" ?>" data-id="<?= $pr["id"] ?>">
                        <?php if ($pr["state_id"] == 5){ ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 15 15"><path fill="#0891b2" fill-rule="evenodd" d="M13.354 2.354a.5.5 0 0 0-.708-.708L10.683 3.61A8.5 8.5 0 0 0 7.5 3C4.308 3 1.656 4.706.076 7.235a.5.5 0 0 0 0 .53c.827 1.323 1.947 2.421 3.285 3.167l-1.715 1.714a.5.5 0 0 0 .708.708l1.963-1.964c.976.393 2.045.61 3.183.61c3.192 0 5.844-1.706 7.424-4.235a.5.5 0 0 0 0-.53c-.827-1.323-1.947-2.421-3.285-3.167zm-3.45 2.035A7.5 7.5 0 0 0 7.5 4C4.803 4 2.53 5.378 1.096 7.5c.777 1.15 1.8 2.081 3.004 2.693zM5.096 10.61L10.9 4.807c1.204.612 2.227 1.543 3.004 2.693C12.47 9.622 10.197 11 7.5 11a7.5 7.5 0 0 1-2.404-.389" clip-rule="evenodd"/></svg>
                        <?php } else { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 13"><path fill="#7c3aed" d="M8 11.5c-1.56 0-3.07-.61-4.5-1.8c-1.17-.99-1.99-2.13-2.37-2.73a.87.87 0 0 1 0-.93c.38-.6 1.2-1.75 2.37-2.73c2.84-2.39 6.15-2.39 8.99 0c1.17.99 1.99 2.13 2.37 2.73c.18.29.18.64 0 .93c-.38.6-1.2 1.75-2.37 2.73c-1.42 1.2-2.93 1.8-4.5 1.8Zm-5.97-5c.37.57 1.1 1.57 2.12 2.43c2.47 2.08 5.23 2.08 7.7 0c1.02-.86 1.75-1.87 2.12-2.43c-.37-.57-1.1-1.57-2.12-2.43c-2.47-2.08-5.23-2.08-7.7 0c-1.02.86-1.75 1.87-2.12 2.43"/><path fill="#7c3aed" d="M8 9a2.5 2.5 0 0 1 0-5a2.5 2.5 0 0 1 0 5m0-4c-.83 0-1.5.67-1.5 1.5S7.17 8 8 8s1.5-.67 1.5-1.5S8.83 5 8 5"/></svg>
                        <?php } ?>
                    </button>
                    <button class="button btn-delete-pr-action tooltip" data-tooltip="Eliminar" data-id="<?= $pr["id"] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="#e53131ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19.5 5.5l-.62 10.025c-.158 2.561-.237 3.842-.88 4.763a4 4 0 0 1-1.2 1.128c-.957.584-2.24.584-4.806.584c-2.57 0-3.855 0-4.814-.585a4 4 0 0 1-1.2-1.13c-.642-.922-.72-2.205-.874-4.77L4.5 5.5M3 5.5h18m-4.944 0l-.683-1.408c-.453-.936-.68-1.403-1.071-1.695a2 2 0 0 0-.275-.172C13.594 2 13.074 2 12.035 2c-1.066 0-1.599 0-2.04.234a2 2 0 0 0-.278.18c-.395.303-.616.788-1.058 1.757L8.053 5.5m1.447 11v-6m5 6v-6" color="#666666"/></svg></button>
                    <button class="button btn-share-open tooltip" data-tooltip="Compartir" data-title="<?= $pr["title"] ?>" data-price="<?= !empty($pr["rental_price"]) ? $pr["rental_price"] : $pr["sale_price"] ?>" data-reference="<?= $pr["reference"] ?>" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><path fill="#caa6ffff" d="M19.719 5.281L18.28 6.72L24.563 13H11c-3.855 0-7 3.145-7 7s3.145 7 7 7v-2c-2.773 0-5-2.227-5-5s2.227-5 5-5h13.563l-6.282 6.281l1.438 1.438l8-8l.687-.719l-.687-.719z"/></svg></button>
                    <a href="<?= base_url("post/details")."/".$pr["reference"] ?>" class="button tooltip" data-tooltip="Estadística"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16"><path fill="#7c3aed" fill-rule="evenodd" d="M0 4.13v1.428a.5.5 0 0 0 .725.446l.886-.446l.377-.19L2 5.362l1.404-.708l.07-.036l.662-.333l.603-.304a.5.5 0 0 0 0-.893l-.603-.305l-.662-.333l-.07-.036L2 1.706l-.012-.005l-.377-.19l-.886-.447A.5.5 0 0 0 0 1.51zM7.25 2a.75.75 0 0 0 0 1.5h7a.25.25 0 0 1 .25.25v8.5a.25.25 0 0 1-.25.25h-9.5a.25.25 0 0 1-.25-.25V6.754a.75.75 0 0 0-1.5 0v5.496c0 .966.784 1.75 1.75 1.75h9.5A1.75 1.75 0 0 0 16 12.25v-8.5A1.75 1.75 0 0 0 14.25 2zm-.5 4a.75.75 0 0 0 0 1.5h5.5a.75.75 0 0 0 0-1.5zM6 9.25a.75.75 0 0 1 .75-.75h3.5a.75.75 0 0 1 0 1.5h-3.5A.75.75 0 0 1 6 9.25" clip-rule="evenodd"/></svg></a>
                    <!-- <button class="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16"><path fill="#7c3aed" fill-rule="evenodd" d="M0 4.13v1.428a.5.5 0 0 0 .725.446l.886-.446l.377-.19L2 5.362l1.404-.708l.07-.036l.662-.333l.603-.304a.5.5 0 0 0 0-.893l-.603-.305l-.662-.333l-.07-.036L2 1.706l-.012-.005l-.377-.19l-.886-.447A.5.5 0 0 0 0 1.51zM7.25 2a.75.75 0 0 0 0 1.5h7a.25.25 0 0 1 .25.25v8.5a.25.25 0 0 1-.25.25h-9.5a.25.25 0 0 1-.25-.25V6.754a.75.75 0 0 0-1.5 0v5.496c0 .966.784 1.75 1.75 1.75h9.5A1.75 1.75 0 0 0 16 12.25v-8.5A1.75 1.75 0 0 0 14.25 2zm-.5 4a.75.75 0 0 0 0 1.5h5.5a.75.75 0 0 0 0-1.5zM6 9.25a.75.75 0 0 1 .75-.75h3.5a.75.75 0 0 1 0 1.5h-3.5A.75.75 0 0 1 6 9.25" clip-rule="evenodd"/></svg></button> -->
                    <!-- <div class="ctn-icons-footer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><g fill="none" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="#666666"><path d="M2 12c0-4.243 0-6.364 1.464-7.682C4.93 3 7.286 3 12 3s7.071 0 8.535 1.318S22 7.758 22 12s0 6.364-1.465 7.682C19.072 21 16.714 21 12 21s-7.071 0-8.536-1.318S2 16.242 2 12"/><path d="M8.4 8h-.8c-.754 0-1.131 0-1.366.234C6 8.47 6 8.846 6 9.6v.8c0 .754 0 1.131.234 1.366C6.47 12 6.846 12 7.6 12h.8c.754 0 1.131 0 1.366-.234C10 11.53 10 11.154 10 10.4v-.8c0-.754 0-1.131-.234-1.366C9.53 8 9.154 8 8.4 8M6 16h4m4-8h4m-4 4h4m-4 4h4"/></g></svg>
                        <span>BCNHouse</span>
                    </div>
                    <div class="ctn-icons-footer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 36 36"><path fill="#666666" d="M32.25 6H29v2h3v22H4V8h3V6H3.75A1.78 1.78 0 0 0 2 7.81v22.38A1.78 1.78 0 0 0 3.75 32h28.5A1.78 1.78 0 0 0 34 30.19V7.81A1.78 1.78 0 0 0 32.25 6" class="clr-i-outline clr-i-outline-path-1"/><path fill="#666666" d="M8 14h2v2H8z" class="clr-i-outline clr-i-outline-path-2"/><path fill="#666666" d="M14 14h2v2h-2z" class="clr-i-outline clr-i-outline-path-3"/><path fill="#666666" d="M20 14h2v2h-2z" class="clr-i-outline clr-i-outline-path-4"/><path fill="#666666" d="M26 14h2v2h-2z" class="clr-i-outline clr-i-outline-path-5"/><path fill="#666666" d="M8 19h2v2H8z" class="clr-i-outline clr-i-outline-path-6"/><path fill="#666666" d="M14 19h2v2h-2z" class="clr-i-outline clr-i-outline-path-7"/><path fill="#666666" d="M20 19h2v2h-2z" class="clr-i-outline clr-i-outline-path-8"/><path fill="#666666" d="M26 19h2v2h-2z" class="clr-i-outline clr-i-outline-path-9"/><path fill="#666666" d="M8 24h2v2H8z" class="clr-i-outline clr-i-outline-path-10"/><path fill="#666666" d="M14 24h2v2h-2z" class="clr-i-outline clr-i-outline-path-11"/><path fill="#666666" d="M20 24h2v2h-2z" class="clr-i-outline clr-i-outline-path-12"/><path fill="#666666" d="M26 24h2v2h-2z" class="clr-i-outline clr-i-outline-path-13"/><path fill="#666666" d="M10 10a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1" class="clr-i-outline clr-i-outline-path-14"/><path fill="#666666" d="M26 10a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1" class="clr-i-outline clr-i-outline-path-15"/><path fill="#666666" d="M13 6h10v2H13z" class="clr-i-outline clr-i-outline-path-16"/><path fill="none" d="M0 0h36v36H0z"/></svg>
                        <span><?= $pr["updated_at_text"] ?></span>
                    </div> -->
                </div>
            </div>
        </div>
        <?php }} else{ ?>
            <h2>No hay publicaciones</h2>
        <?php } ?>
    </div>
    <nav class="pagination" role="navigation" aria-label="pagination">
        <a href="<?= (!empty($index) && $index != 1) ? "?i=".$index - 1 : "" ?>" class="pagination-previous <?= (!empty($index) && $index != 1) ?  "" : "is-disabled" ?>" <?= (!empty($index) && $index != 1) ?  "" : "disabled" ?> title="This is the first page">Atrás</a>
        <a href="<?= "?i=".$index + 1 ?>" <?= ceil($number_of_properties/9) == $index ? "disabled" : "" ?> class="pagination-next">Siguiente</a>
        <ul class="pagination-list">
            <li>
                <?php for($i=1; $i <= ceil($number_of_properties/9); $i++ ){ ?>
                    <a href="<?= "?i=".$i ?>" class="pagination-link" <?= $i == $index ? "style='background-color:white;color:var(--color-main-1);border:1px solid var(--color-main-1);'" : "" ?> aria-label="Page 1" aria-current="page" ><?= $i ?></a>
                <?php } ?>
            </li>
        </ul>
    </nav>
</div>
<div class="modal" id="modal-delete-property">
    <div class="modal-background"></div>
    <div class="modal-content box">
        <h2>¿Estas seguro de eliminar?</h2>
        <button class="button btn-confirm-delete">Eliminar</button>
    </div>
    <button class="button modal-close"></button>
</div>
<div class="modal" id="modal-share">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="box p-5"> <!-- Aumentado el padding con p-5 -->
            <!-- Sección de cabecera con título y botón de cierre -->
            <div class="is-clearfix"> <!-- Aumentado el margen inferior -->
                <h3 class="title is-4 is-pulled-left has-text-grey-darker">Compartir anuncio</h3> <!-- Color de texto más oscuro -->
                <!-- El botón de eliminar es típicamente manejado por el componente padre del modal,
                    pero se incluye aquí para la completitud visual como se ve en la imagen. -->
                <button class="delete is-large is-pulled-right" onclick="closeModal(document.getElementById('modal-share'))" aria-label="close"></button>
            </div>
            <p class="subtitle is-6 mb-2 has-text-grey" id="m-property-title"></p> <!-- Color de texto gris -->
            <p class="subtitle is-6 has-text-weight-bold has-text-primary" id="m-property-price">00 €
            </p> <!-- Precio en negrita y color primario -->

            <hr class="has-background-light"> <!-- Línea divisoria más clara -->

            <!-- Sección de Compartir por Mensajería -->
            <div class="field mb-5">
                <label class="label has-text-grey-dark">Compartir por redes sociales</label> <!-- Color de texto más oscuro -->
                <div class="control">
                    <a class="button is-success is-outlined is-fullwidth is-rounded" id="m-whatsapp-a" href="" target="_blank">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 256 258"><defs><linearGradient id="IconifyId197f08f4662e3cf2b2" x1="50%" x2="50%" y1="100%" y2="0%"><stop offset="0%" stop-color="#1FAF38"/><stop offset="100%" stop-color="#60D669"/></linearGradient><linearGradient id="IconifyId197f08f4662e3cf2b3" x1="50%" x2="50%" y1="100%" y2="0%"><stop offset="0%" stop-color="#F9F9F9"/><stop offset="100%" stop-color="#FFF"/></linearGradient></defs><path fill="url(#IconifyId197f08f4662e3cf2b2)" d="M5.463 127.456c-.006 21.677 5.658 42.843 16.428 61.499L4.433 252.697l65.232-17.104a123 123 0 0 0 58.8 14.97h.054c67.815 0 123.018-55.183 123.047-123.01c.013-32.867-12.775-63.773-36.009-87.025c-23.23-23.25-54.125-36.061-87.043-36.076c-67.823 0-123.022 55.18-123.05 123.004"/><path fill="url(#IconifyId197f08f4662e3cf2b3)" d="M1.07 127.416c-.007 22.457 5.86 44.38 17.014 63.704L0 257.147l67.571-17.717c18.618 10.151 39.58 15.503 60.91 15.511h.055c70.248 0 127.434-57.168 127.464-127.423c.012-34.048-13.236-66.065-37.3-90.15C194.633 13.286 162.633.014 128.536 0C58.276 0 1.099 57.16 1.071 127.416m40.24 60.376l-2.523-4.005c-10.606-16.864-16.204-36.352-16.196-56.363C22.614 69.029 70.138 21.52 128.576 21.52c28.3.012 54.896 11.044 74.9 31.06c20.003 20.018 31.01 46.628 31.003 74.93c-.026 58.395-47.551 105.91-105.943 105.91h-.042c-19.013-.01-37.66-5.116-53.922-14.765l-3.87-2.295l-40.098 10.513z"/><path fill="#FFF" d="M96.678 74.148c-2.386-5.303-4.897-5.41-7.166-5.503c-1.858-.08-3.982-.074-6.104-.074c-2.124 0-5.575.799-8.492 3.984c-2.92 3.188-11.148 10.892-11.148 26.561s11.413 30.813 13.004 32.94c1.593 2.123 22.033 35.307 54.405 48.073c26.904 10.609 32.379 8.499 38.218 7.967c5.84-.53 18.844-7.702 21.497-15.139c2.655-7.436 2.655-13.81 1.859-15.142c-.796-1.327-2.92-2.124-6.105-3.716s-18.844-9.298-21.763-10.361c-2.92-1.062-5.043-1.592-7.167 1.597c-2.124 3.184-8.223 10.356-10.082 12.48c-1.857 2.129-3.716 2.394-6.9.801c-3.187-1.598-13.444-4.957-25.613-15.806c-9.468-8.442-15.86-18.867-17.718-22.056c-1.858-3.184-.199-4.91 1.398-6.497c1.431-1.427 3.186-3.719 4.78-5.578c1.588-1.86 2.118-3.187 3.18-5.311c1.063-2.126.531-3.986-.264-5.579c-.798-1.593-6.987-17.343-9.819-23.64"/></svg>
                        </span>
                        <span>Enviar por Whatsapp</span>
                    </a>
                </div>
                <!-- <label class="label has-text-grey-dark">Compartir por mensajería</label> -->
                <div class="control mt-3">
                    <button class="button is-success is-outlined is-fullwidth is-rounded" id="btn-share-facebook" data-url="">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 256 256"><path fill="#1877F2" d="M256 128C256 57.308 198.692 0 128 0S0 57.308 0 128c0 63.888 46.808 116.843 108 126.445V165H75.5v-37H108V99.8c0-32.08 19.11-49.8 48.348-49.8C170.352 50 185 52.5 185 52.5V84h-16.14C152.959 84 148 93.867 148 103.99V128h35.5l-5.675 37H148v89.445c61.192-9.602 108-62.556 108-126.445"/><path fill="#FFF" d="m177.825 165l5.675-37H148v-24.01C148 93.866 152.959 84 168.86 84H185V52.5S170.352 50 156.347 50C127.11 50 108 67.72 108 99.8V128H75.5v37H108v89.445A129 129 0 0 0 128 256a129 129 0 0 0 20-1.555V165z"/></svg>
                        </span>
                        <span>Publicar en facebook</span>
                    </button>
                </div>
            </div>

            <hr class="has-background-light">

            <!-- Sección de Copiar Enlace -->
            <div class="field mb-5">
                <label class="label has-text-grey-dark">Copiar enlace</label>
                <div class="field has-addons">
                    <div class="control is-expanded">
                        <input class="input is-rounded" id="link-reference" type="text" value="<?= base_url("result/"). "" ?>" readonly> <!-- Input redondeado -->
                    </div>
                    <div class="control">
                        <button class="button is-info is-rounded" id="copyLinkButton">Copiar</button> <!-- Botón redondeado -->
                    </div>
                </div>
            </div>

            <hr class="has-background-light">

            <!-- Sección de Compartir por Email -->
            <div class="field mb-5">
                <label class="label has-text-grey-dark">Compartir por email</label>
                <div class="control">
                    <input class="input is-rounded" type="email" placeholder="Email de tus amigos" id="input-email-share"> <!-- Input redondeado -->
                </div>
                <p class="help has-text-grey-light">Si son varios sepáralos con una coma (,)</p> <!-- Texto de ayuda más claro -->
            </div>

            <!-- Botón de Enviar -->
            <div class="field is-grouped is-grouped-right">
                <div class="control">
                    <button class="button is-primary is-rounded" id="send-share-to-emails">Enviar</button> <!-- Botón redondeado -->
                </div>
            </div>
        </div>
    </div>
    <button class="button modal-close"></button>
</div>
<?= $this->endSection() ?>

<?= $this->section("js") ?>   
<script src="<?= base_url("js/format_input.js") ?>"></script>
<script>
    const btns_share = document.querySelectorAll(".btn-share-open");
    btns_share.forEach((btn)=>{
        btn.addEventListener("click", ()=>{
            const price = btn.dataset.price;
            const title = btn.dataset.title;
            const reference = btn.dataset.reference;
            const url = "https://damelodamelo.com/result/";
            const whatsappUrl = "https://wa.me/?text=Estimado/a, comparto con usted los detalles de una propiedad que podría resultar de interés. " + url + reference;
            document.getElementById("m-property-title").textContent = title;
            document.getElementById("m-property-price").textContent = price + " €";
            document.getElementById("m-whatsapp-a").href = whatsappUrl;
            document.getElementById("btn-share-facebook").dataset.url = url + reference;
            document.getElementById("link-reference").value = url + reference;
            openModal(document.getElementById("modal-share"));
        });
    });


    const sendShareToEmails = document.getElementById("send-share-to-emails");
    const inputEmailShare = document.getElementById("input-email-share");
    const propertyLink = document.getElementById("link-reference");
    sendShareToEmails.addEventListener("click", async()=>{
        if (inputEmailShare.value.trim() !== ""){
            sendShareToEmails.textContent = "Enviando...";
            sendShareToEmails.setAttribute("disabled", true);
            await fetch("/api/send/message/email_share?user_emails="+inputEmailShare.value+"&property_link="+propertyLink.value).then(res => res.json()).then(data => {
                inputEmailShare.value = "";
                closeModal(document.getElementById("modal-share"));
                sendShareToEmails.textContent = "Enviar";
                sendShareToEmails.removeAttribute("disabled");
            })
        }
    });
    const btn_share_facebook = document.getElementById("btn-share-facebook");
    btn_share_facebook.addEventListener("click", ()=>{
        const url = btn_share_facebook.dataset.url;
        const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
        window.open(facebookUrl, '_blank');
    })
    document.getElementById('copyLinkButton').addEventListener('click', function() {
        const linkInput = this.closest('.field').querySelector('input');
        linkInput.select();
        linkInput.setSelectionRange(0, 99999); // Para dispositivos móviles
        document.execCommand("copy");

        // Proporcionar feedback visual al usuario (solo cambio de texto)
        const originalText = this.textContent;
        this.textContent = '¡Copiado!';
        setTimeout(() => {
            this.textContent = originalText;
        }, 2000);
    });
    // para arriba funcion de compartir


    const formatter_tags_1 = document.querySelectorAll(".meters-span");
    const formatter_tags_2 = document.querySelectorAll(".price-span");
    formatter_tags_1.forEach((tag)=>{
        format_1(tag, "element");
    })
    formatter_tags_2.forEach((tag)=>{
        format_1(tag, "element");
    })
    
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
            await fetch("<?= site_url("post/delete") ?>?id="+String(id_delete)).then(res => res.json()).then(data =>{
                closeModal(document.getElementById("modal-delete-property"));
                btn.removeAttribute("disabled");
                btn.textContent = "Eliminar";
                document.querySelector(".container-block-card-"+String(id_delete)).classList.add("scale-out-center");
                setTimeout(()=>{
                    document.querySelector(".container-block-card-"+String(id_delete)).remove();
                }, 500)
            });
        })
    })

    const btns_disabledenabled = document.querySelectorAll(".btn-disabled-pr-action");
    btns_disabledenabled.forEach(btn =>{
        btn.addEventListener("click", async()=>{
            btn.disabled = true;
            btn.textContent = "Espere...";
            await fetch("/post/disabledenabled?id="+String(btn.dataset.id)).then(res => res.json()).then(data =>{
                console.log(data);
                // btn.textContent = data.text_state;
                btn.removeAttribute("disabled");
                
                if (data.state_id === 5){
                    btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 15 15"><path fill="#0891b2" fill-rule="evenodd" d="M13.354 2.354a.5.5 0 0 0-.708-.708L10.683 3.61A8.5 8.5 0 0 0 7.5 3C4.308 3 1.656 4.706.076 7.235a.5.5 0 0 0 0 .53c.827 1.323 1.947 2.421 3.285 3.167l-1.715 1.714a.5.5 0 0 0 .708.708l1.963-1.964c.976.393 2.045.61 3.183.61c3.192 0 5.844-1.706 7.424-4.235a.5.5 0 0 0 0-.53c-.827-1.323-1.947-2.421-3.285-3.167zm-3.45 2.035A7.5 7.5 0 0 0 7.5 4C4.803 4 2.53 5.378 1.096 7.5c.777 1.15 1.8 2.081 3.004 2.693zM5.096 10.61L10.9 4.807c1.204.612 2.227 1.543 3.004 2.693C12.47 9.622 10.197 11 7.5 11a7.5 7.5 0 0 1-2.404-.389" clip-rule="evenodd"/></svg>';
                    btn.dataset.tooltip = "Habilitar";
                    btn.classList.remove("btn-disabled-style-app");
                }else{
                    btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 13"><path fill="#7c3aed" d="M8 11.5c-1.56 0-3.07-.61-4.5-1.8c-1.17-.99-1.99-2.13-2.37-2.73a.87.87 0 0 1 0-.93c.38-.6 1.2-1.75 2.37-2.73c2.84-2.39 6.15-2.39 8.99 0c1.17.99 1.99 2.13 2.37 2.73c.18.29.18.64 0 .93c-.38.6-1.2 1.75-2.37 2.73c-1.42 1.2-2.93 1.8-4.5 1.8Zm-5.97-5c.37.57 1.1 1.57 2.12 2.43c2.47 2.08 5.23 2.08 7.7 0c1.02-.86 1.75-1.87 2.12-2.43c-.37-.57-1.1-1.57-2.12-2.43c-2.47-2.08-5.23-2.08-7.7 0c-1.02.86-1.75 1.87-2.12 2.43"/><path fill="#7c3aed" d="M8 9a2.5 2.5 0 0 1 0-5a2.5 2.5 0 0 1 0 5m0-4c-.83 0-1.5.67-1.5 1.5S7.17 8 8 8s1.5-.67 1.5-1.5S8.83 5 8 5"/></svg>';
                    btn.dataset.tooltip = "Deshabilitar";
                    btn.classList.add("btn-disabled-style-app")
                }
            })
        })
    })
    
    const btns_redirect = document.querySelectorAll(".btn-redirect-update-form");
    btns_redirect.forEach((btn)=>{
        btn.addEventListener("click", ()=>{
            location.href = "<?= site_url("post/update_form/") ?>" + String(btn.dataset.id);
        });
    })
</script>
<?= $this->endSection() ?>
