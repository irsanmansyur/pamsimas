<div class="form-body">
    <div class="row">
        <div class="col-md-4">
            <label>Nomor Meteran</label>
        </div>
        <div class="col-md-8 form-group">
            <input type="text" class="form-control <?= session("errors.no_meteran") ? "is-invalid" : ''; ?>" id="no_meteran" name="no_meteran" placeholder="Masukkan No. Meteran" value="<?= $pelanggan['no_meteran'] ?? old('no_meteran'); ?>">
            <?= view_error("_input_error", session('errors.no_meteran')) ?>
        </div>
        <div class="col-md-4">
            <label>Nama Pelanggan</label>
        </div>
        <div class="col-md-8 form-group">
            <input type="text" class="form-control  <?= session("errors.name") ? "is-invalid" : ''; ?>" id="name" name="name" placeholder="Enter Valid Name" value="<?= $pelanggan['name'] ??  old('name'); ?>">
            <?= view_error("_input_error", session('errors.name')) ?>
        </div>
        <div class="col-md-4">
            <label>Username</label>
        </div>
        <div class="col-md-8 form-group">
            <input type="text" class="form-control <?= session("errors.username") ? "is-invalid" : ''; ?>" id="username" name="username" placeholder="Enter Valid Username" value="<?= $pelanggan['username'] ??  old("username"); ?>">
            <?= view_error("_input_error", session('errors.username')) ?>
        </div>
        <div class="col-md-4">
            <label>Email</label>
        </div>
        <div class="col-md-8 form-group">
            <input type="email" class="form-control  <?= session("errors.email") ? "is-invalid" : ''; ?>" id="email" name="email" placeholder="Enter Valid Email" value="<?= $pelanggan['email'] ??  old("email"); ?>">
            <?= view_error("_input_error", session('email')) ?>

        </div>
        <div class="col-md-4">
            <label>Handphone</label>
        </div>
        <div class="col-md-8 form-group">
            <input class="form-control <?= session('errors.handphone') ? "is-invalid" : ''; ?>" id="handphone" name="handphone" placeholder="Enter Valid handphone" value="<?= $pelanggan['handphone'] ??  old("handphone"); ?>">
            <?= view_error("_input_error", session('errors.handphone')) ?>
        </div>
        <div class="col-md-4">
            <label>password</label>
        </div>

        <div class="col-md-8 form-group">
            <input class="form-control <?= session('errors.password') ? "is-invalid" : ''; ?>" id="password" name="password" placeholder="Enter Valid password" value="" type="password">
            <?= view_error("_input_error", session('errors.password')) ?>
        </div>
        <div class="col-md-4">
            <label>Alamat</label>
        </div>
        <div class="col-md-8 form-group">
            <div class="form-group with-title mb-3">
                <textarea class="form-control  <?= session('errors.address') ? "is-invalid" : ''; ?>" id="addres" rows="3" name="address"><?= $pelanggan['address'] ??  old("address"); ?></textarea>
                <?= view_error("_input_error", session('errors.address')) ?>

            </div>
        </div>
        <div class="col-md-4">
            <label>Status User</label>
        </div>
        <div class="col-md-8 form-group">
            <div class="checkbox">
                <input type="checkbox" id="checkbox1" value="1" class="form-check-input" <?= isset($pelanggan['is_active']) ?  ($pelanggan['is_active'] || old('is_active') == 1 ? "checked='checked'" : '') : (old('is_active') == 1 ? "checked='checked'" : ''); ?> name="is_active">
                <label for="checkbox1">Active</label>
            </div>
        </div>
        <div class="col-sm-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
            <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
        </div>
    </div>
</div>