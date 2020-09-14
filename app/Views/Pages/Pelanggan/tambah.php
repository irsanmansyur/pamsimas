<?= $this->extend($_adminTemplate); ?>
<?= $this->section("MainLoad"); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $page_title; ?></h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-horizontal" action="<?= route_to("pelanggan") . "/tambah" ?>" method="post">
                <?= view("Pages\Pelanggan\partials\\form_input"); ?>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section("JSLoad"); ?>
<?= $this->endSection(); ?>