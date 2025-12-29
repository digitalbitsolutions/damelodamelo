<?= $this->extend("layouts/page") ?>

<?= $this->section("nav_option") ?>
<a href="<?= site_url() ?>">
    <span>Ir al inicio</span>
</a>
<?= $this->endSection() ?>

<?= $this->section("css") ?>
    <link rel="stylesheet" href="<?= base_url()."css/page/article.css" ?>">
<?= $this->endSection() ?>

<?= $this->section("body") ?>
    <div class="container-main-all">
        <div class="container-article-page">
            <h1><?= $article["title"] ?></h1>
            <div class="container-image">
                <img src="<?= base_url($article["featured_image"]) ?>" alt="article image">
            </div>
            <h2><?= $article["summary"] ?></h2>
            <div class="content-app">
                <?= $article["content"] ?>
            </div>
        </div>
        <div class="container-rigth">

        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section("js") ?>

<?= $this->endSection() ?>
