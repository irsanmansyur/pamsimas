<?= $this->extend($_adminTemplate); ?>
<?= $this->section("MainLoad"); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tambah Tagihan</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <?= view("Pages\Tagihan\partials\\_input_detail_pelanggan"); ?>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="table-responsive">
                            <Table class="table">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Volume Pemakaian (m3)</th>
                                        <th>Harga/m3 (Rp)</th>
                                        <th>Total Bayar (Rp)</th>
                                    </tr>
                                    <tr>
                                        <td class="bulan">4</td>
                                        <td class="volume_pemakaian">4</td>
                                        <td class="harga_m3">15000</td>
                                        <td class="total_bayar">200.000</td>
                                    </tr>
                                </thead>
                            </Table>
                        </div>

                        <div class="form-group">
                            <label for="cash">Uang Bayar</label>
                            <input type="number" class="form-control <?= session("error.cash") ? "is-invalid" : ''; ?>" id="cash" name="cash" value="<?= $pelanggan['cash'] ?? old('cash'); ?>">
                            <?= session("errors.cash") ? view_error("_input_error", session('errors.cash'))    : ''; ?>
                        </div>
                        <div class="form-group">
                            <label for="Kembalian">Uang Kembalian</label>
                            <input type="number" class="form-control" id="kembalian" name="kembalian" disabled>

                        </div>
                        <hr>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section("JSLoad"); ?>
<?= $this->endSection(); ?>