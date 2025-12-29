<?= $this->extend("layouts/nav") ?>

<?= $this->section("css") ?>
<link rel="stylesheet" href="<?= base_url()."css/app/user_view.css" ?>">
<link rel="stylesheet" href="<?= base_url()."css/app/my_posts.css" ?>">
<?= $this->endSection() ?>

<?= $this->section("body") ?>
<div class="container-main">
    
    <div class="card-info-user-page box">
        <div class="container-main-profile-col">
            <div class="card-image">
                <!-- <figure class="image is-4by3"> -->
                <?php if(!empty($user[0]["photo"])){ ?>
                    <img src="<?= base_url("img/photo_profile/").$user[0]["photo"] ?>" id="view-photo" alt="">
                <?php }else{ ?>
                    <img src="<?= base_url("img/default-avatar-profile-icon.webp") ?>" id="view-photo" alt="">
                <?php } ?>
                <!-- </figure> -->
            </div>
        </div>
        <div class="card-content">            
            <div class="media">
                <div class="media-left">
                    <!-- <figure class="image is-48x48">
                        <img src="https://bulma.io/assets/images/placeholders/96x96.png" alt="Placeholder image" />
                    </figure> -->
                </div>
                <div class="media-content">
                    <p class="title"><?= $user[0]["first_name"] ?><?= !empty($user[0]["last_name"]) ? ", ".$user[0]["last_name"] : "" ?></p>
                    <p class="p-text-normal"><?= $user[0]["user_level_name"] ?></p>
                    <p class="p-date">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 36 36"><path fill="#666666" d="M32.25 6H29v2h3v22H4V8h3V6H3.75A1.78 1.78 0 0 0 2 7.81v22.38A1.78 1.78 0 0 0 3.75 32h28.5A1.78 1.78 0 0 0 34 30.19V7.81A1.78 1.78 0 0 0 32.25 6" class="clr-i-outline clr-i-outline-path-1"/><path fill="#666666" d="M8 14h2v2H8z" class="clr-i-outline clr-i-outline-path-2"/><path fill="#666666" d="M14 14h2v2h-2z" class="clr-i-outline clr-i-outline-path-3"/><path fill="#666666" d="M20 14h2v2h-2z" class="clr-i-outline clr-i-outline-path-4"/><path fill="#666666" d="M26 14h2v2h-2z" class="clr-i-outline clr-i-outline-path-5"/><path fill="#666666" d="M8 19h2v2H8z" class="clr-i-outline clr-i-outline-path-6"/><path fill="#666666" d="M14 19h2v2h-2z" class="clr-i-outline clr-i-outline-path-7"/><path fill="#666666" d="M20 19h2v2h-2z" class="clr-i-outline clr-i-outline-path-8"/><path fill="#666666" d="M26 19h2v2h-2z" class="clr-i-outline clr-i-outline-path-9"/><path fill="#666666" d="M8 24h2v2H8z" class="clr-i-outline clr-i-outline-path-10"/><path fill="#666666" d="M14 24h2v2h-2z" class="clr-i-outline clr-i-outline-path-11"/><path fill="#666666" d="M20 24h2v2h-2z" class="clr-i-outline clr-i-outline-path-12"/><path fill="#666666" d="M26 24h2v2h-2z" class="clr-i-outline clr-i-outline-path-13"/><path fill="#666666" d="M10 10a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1" class="clr-i-outline clr-i-outline-path-14"/><path fill="#666666" d="M26 10a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1" class="clr-i-outline clr-i-outline-path-15"/><path fill="#666666" d="M13 6h10v2H13z" class="clr-i-outline clr-i-outline-path-16"/><path fill="none" d="M0 0h36v36H0z"/></svg>
                        <?= $user[0]["created_at_text"] ?>
                    </p>
                </div>
            </div>
            <div class="content">
                <div class="container-details">        
                    <div class="row-info">
                        <span class="title">E-mail:</span>
                        <span><?= $user[0]["email"] ?></span>
                    </div>
                    <div class="row-info">
                        <span class="title">Teléfono:</span>
                        <span><?= $user[0]["phone"] ?></span>
                    </div>
                    <div class="row-info">
                        <span class="title">Teléfono fijo:</span>
                        <span><?= $user[0]["landline_phone"] ?></span>
                    </div>
                    <div class="row-info">
                        <span class="title">Tipo de documento:</span>
                        <span><?= $user[0]["document_type"] ?></span>
                    </div>
                    <div class="row-info">
                        <span class="title">Número de documento:</span>
                        <span><?= $user[0]["document_number"] ?></span>
                    </div>
                    <div class="row-info">
                        <span class="title">Dirección:</span>
                        <span><?= $user[0]["address"] ?></span>
                    </div>
                    <div class="row-info">
                        <span class="title">N° de publicaciones:</span>
                        <span><?= $user[0]["quantity_post"] ?></span>
                    </div>

                </div>
                <!-- <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time> -->
            </div>
            <?php if (!empty($property[0]["service_type"])){ ?>
                <div class="container-services-details">
                    <h2>Servicios</h2>
                    <ul>
                    <?php 
                        foreach($property[0]["service_type"] as $st){
                            echo "<li>".$st["name"]."</li>";
                        }
                    ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="card-grid">
        <?php if ($property){ foreach ($property as $pr){ ?>
        <div class="card container-block-card-<?= $pr["id"] ?>">
            <div class="card-image">
                <img src="<?= base_url()."img/uploads/".$pr["cover_image"]["url"] ?>" alt="">
            </div>
            <div class="badge-container">
                <?php if($user[0]["user_level_id"] == 5){ ?>
                    <span class="badge"><?= $pr["type_name"] ?></span>
                    <span class="badge"><?= $pr["category_name"] ?></span>
                <?php } ?>
            </div>
            <div class="ctn-detils-p-m">
                <?php if($user[0]["user_level_id"] == 5){ ?>
                    <span><?= $pr["meters_built"] ?>m² - € <?= !empty($pr["sale_price"]) ? $pr["sale_price"] :  (!empty($pr["rental_price"]) ? $pr["rental_price"] : "") ?></span>
                <?php } ?>
            </div>
            <div class="card-content">
                <h3><?= $pr["title"] ?></h3>
                <div class="ctn-location">
                    <?php if($user[0]["user_level_id"] == 5){ ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#666666" d="M12 3a7 7 0 0 0-7 7c0 2.862 1.782 5.623 3.738 7.762A26 26 0 0 0 12 20.758q.262-.201.615-.49a26 26 0 0 0 2.647-2.504C17.218 15.623 19 12.863 19 10a7 7 0 0 0-7-7m0 20.214l-.567-.39l-.003-.002l-.006-.005l-.02-.014l-.075-.053l-.27-.197a28 28 0 0 1-3.797-3.44C5.218 16.875 3 13.636 3 9.999a9 9 0 0 1 18 0c0 3.637-2.218 6.877-4.262 9.112a28 28 0 0 1-3.796 3.44a17 17 0 0 1-.345.251l-.021.014l-.006.005l-.002.001zM12 8a2 2 0 1 0 0 4a2 2 0 0 0 0-4m-4 2a4 4 0 1 1 8 0a4 4 0 0 1-8 0"/></svg>
                        <span><?= $pr["address"] ?></span>
                    <?php } ?>
                </div>
                <div class="card-details">
                    <div class="ctn-icons-footer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><g fill="none" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="#666666"><path d="M2 12c0-4.243 0-6.364 1.464-7.682C4.93 3 7.286 3 12 3s7.071 0 8.535 1.318S22 7.758 22 12s0 6.364-1.465 7.682C19.072 21 16.714 21 12 21s-7.071 0-8.536-1.318S2 16.242 2 12"/><path d="M8.4 8h-.8c-.754 0-1.131 0-1.366.234C6 8.47 6 8.846 6 9.6v.8c0 .754 0 1.131.234 1.366C6.47 12 6.846 12 7.6 12h.8c.754 0 1.131 0 1.366-.234C10 11.53 10 11.154 10 10.4v-.8c0-.754 0-1.131-.234-1.366C9.53 8 9.154 8 8.4 8M6 16h4m4-8h4m-4 4h4m-4 4h4"/></g></svg>
                        <span><?= $user[0]["user_name"] ?></span>
                    </div>
                    <div class="ctn-icons-footer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 36 36"><path fill="#666666" d="M32.25 6H29v2h3v22H4V8h3V6H3.75A1.78 1.78 0 0 0 2 7.81v22.38A1.78 1.78 0 0 0 3.75 32h28.5A1.78 1.78 0 0 0 34 30.19V7.81A1.78 1.78 0 0 0 32.25 6" class="clr-i-outline clr-i-outline-path-1"/><path fill="#666666" d="M8 14h2v2H8z" class="clr-i-outline clr-i-outline-path-2"/><path fill="#666666" d="M14 14h2v2h-2z" class="clr-i-outline clr-i-outline-path-3"/><path fill="#666666" d="M20 14h2v2h-2z" class="clr-i-outline clr-i-outline-path-4"/><path fill="#666666" d="M26 14h2v2h-2z" class="clr-i-outline clr-i-outline-path-5"/><path fill="#666666" d="M8 19h2v2H8z" class="clr-i-outline clr-i-outline-path-6"/><path fill="#666666" d="M14 19h2v2h-2z" class="clr-i-outline clr-i-outline-path-7"/><path fill="#666666" d="M20 19h2v2h-2z" class="clr-i-outline clr-i-outline-path-8"/><path fill="#666666" d="M26 19h2v2h-2z" class="clr-i-outline clr-i-outline-path-9"/><path fill="#666666" d="M8 24h2v2H8z" class="clr-i-outline clr-i-outline-path-10"/><path fill="#666666" d="M14 24h2v2h-2z" class="clr-i-outline clr-i-outline-path-11"/><path fill="#666666" d="M20 24h2v2h-2z" class="clr-i-outline clr-i-outline-path-12"/><path fill="#666666" d="M26 24h2v2h-2z" class="clr-i-outline clr-i-outline-path-13"/><path fill="#666666" d="M10 10a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1" class="clr-i-outline clr-i-outline-path-14"/><path fill="#666666" d="M26 10a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1" class="clr-i-outline clr-i-outline-path-15"/><path fill="#666666" d="M13 6h10v2H13z" class="clr-i-outline clr-i-outline-path-16"/><path fill="none" d="M0 0h36v36H0z"/></svg>
                        <span><?= $pr["updated_at_text"] ?></span>
                    </div>
                </div>
                <div class="card-footer">
                    <!-- <button class="button btn-redirect-update-form" data-id="<?= $pr["id"] ?>">Editar</button> -->
                    <?php if ($user[0]["user_level_id"] == 4){ ?>
                        <a href="<?= site_url("result_service/").$pr["id"] ?>" target="_blank">
                    <?php }else if ($user[0]["user_level_id"] == 5){ ?>
                        <a href="<?= site_url("result/").$pr["id"] ?>" target="_blank">
                    <?php }else{ ?>
                        <a href="#">
                    <?php } ?>
                        <button class="button">Ver</button>
                    </a>
                    <button class="button btn-delete-pr-action" data-id="<?= $pr["id"] ?>">Desactivar</button>
                </div>
            </div>
        </div>
        <?php }} else{ ?>
            <h2>No hay publicaciones</h2>
        <?php } ?>

    </div>
    
</div>
<?= $this->endSection() ?>

<?= $this->section("js") ?>

<?= $this->endSection() ?>