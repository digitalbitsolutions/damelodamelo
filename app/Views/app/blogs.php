<?= $this->extend("layouts/nav") ?>
<?= $this->section("css") ?>
    <link rel="stylesheet" href="<?= base_url()."css/app/blogs.css" ?>">
<?= $this->endSection() ?>

<?= $this->section("body") ?>
    <div class="">
        <a href="<?= base_url("post/blogs/create") ?>" class="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="#666666" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z"/></svg>
            Crear nuevo artículo
        </a>
    </div>
    <div class="container-all-blogs">
        <?php foreach($data as $d): ?>
        <div class="property-listing-card">
            <div class="image-gallery">
                <div class="main-image-container">
                    <img id="main-property-image" src="<?= base_url($d["featured_image"]) ?>" alt="Imagen principal de la propiedad">
                </div>
            </div>
    
            <div class="property-details">
                <div class="property-info-top">
                    <h1 class="property-title truncate-3-lines"><?= $d["title"] ?></h1>
                </div>
    
                <p class="property-description truncate-3-lines"><?= $d["summary"] ?></p>
                <div class="action-buttons-bottom">
                    <a href="<?= base_url("blogs/").$d["slug"] ?>" target="_blank" class="icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="none" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-4m-8-2l8-8m0 0v5m0-5h-5"/></svg>
                    </a>
                    <button class="icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#666666" d="M12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3s3-1.358 3-3s-1.359-3-3-3"/><path fill="#666666" d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316l-.105-.316C21.927 11.617 19.633 5 12 5m0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5c-.504 1.158-2.578 5-7.926 5"/></svg>
                    </button>
                    <button class="icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#666666" d="M5 19h1.425L16.2 9.225L14.775 7.8L5 17.575zm-2 2v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM19 6.4L17.6 5zm-3.525 2.125l-.7-.725L16.2 9.225z"/></svg>
                    </button>
                    <button class="icon-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#666666" d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1"/></svg></button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?= $this->endSection() ?>

<?= $this->section("js") ?>
<?= $this->endSection() ?>