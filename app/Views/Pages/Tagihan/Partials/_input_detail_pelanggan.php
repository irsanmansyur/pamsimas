<div class="form-group">
    <input type="text" name="id" hidden>
    <label for="no-meteran">No. Meteran</label>
    <input type="text" class="form-control <?= session("error.no_meteran") ? "is-invalid" : ''; ?>" id="no_meteran" name="no_meteran" placeholder="Masukkan No. Meteran/Nama Pengguna/No.Handphone" value="<?= $pelanggan['no_meteran'] ?? old('no_meteran'); ?>">
    <?= session("errors.no_meteran") ? view_error("_input_error", session('errors.no_meteran'))    : ''; ?>
</div>
<div class="form-group">
    <label for="Nama">Nama Pengguna</label>
    <input type="text" id="Nama" class="form-control <?= session("error.nama") ? "is-invalid" : ''; ?>" id="nama" name="nama" disabled placeholder="Nama Pengguna terisi Otomatis" value="<?= $pelanggan['nama'] ?? old('nama'); ?>">
    <?= session("errors.nama") ? view_error("_input_error", session('errors.nama'))    : ''; ?>
</div>
<div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea disabled class="form-control  <?= session('errors.address') ? "is-invalid" : ''; ?>" id="addres" rows="1" name="address"><?= $pelanggan['address'] ?? ''; ?></textarea>
    <?= view_error("_input_error", session('errors.address')) ?>
</div>
<div class="form-group">
    <label for="handphone">No. Hp</label>
    <input type="text" id="handphone" class="form-control <?= session("error.handphone") ? "is-invalid" : ''; ?>" id="handphone" name="handphone" disabled placeholder="No. Handphone terisi Otomatis" value="<?= $pelanggan['handphone'] ?? old('handphone'); ?>">
    <?= session("errors.handphone") ? view_error("_input_error", session('errors.handphone'))    : ''; ?>
</div>