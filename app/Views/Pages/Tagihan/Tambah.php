<?= $this->extend($_adminTemplate); ?>
<?= $this->section("MainLoad"); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tambah Tagihan</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form" method="POST">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <?= view("Pages\Tagihan\partials\\_input_detail_pelanggan"); ?>

                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="country-floating">Pemakaian Untuk Bulan & Tahun</label>
                            <input type="date" id="bulan_tahun" class="form-control <?= session("error.handphone") ? "is-invalid" : ''; ?>" name="bulan_tahun" value="<?= $pelanggan['bulan_tahun'] ?? ""; ?>">
                            <?= session("errors.bulan_tahun") ? view_error("_input_error", session('errors.bulan_tahun'))    : ''; ?>
                        </div>
                        <div class="form-group">
                            <label for="mtr_lama">Mtr. Lama</label>
                            <input type="number" readonly="readonly" id="mtr_lama" class="form-control" name="mtr_lama" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="mtr_baru">Mtr. Baru</label>
                            <input type="number" id="mtr_baru" class="form-control<?= session("errors.mtr_baru") ? " is-invalid" : ''; ?>" name="mtr_baru" value="0">
                            <?= view_error("_input_error", session('errors.baru')) ?>

                        </div>
                        <div class="form-group">
                            <label for="volume_air">Volume</label>
                            <input type="number" id="volume_air" name="volume_air" readonly="readonly" class="form-control<?= session("errors.volume") ? " is-invalid" : ''; ?>">
                            <?= view_error("_input_error", session('errors.volume')) ?>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12  justify-content-center">
                        <div class="table-responsive">
                            <h1 class="text-center">Detail</h1>
                            <Table class="table">
                                <thead>
                                    <tr>
                                        <th>Volume Pemakaian</th>
                                        <th>Harga/m3 (Rp)</th>
                                        <th>Jumlah (Rp)</th>
                                    </tr>
                                    <tr>
                                        <td class="volume_pemakaian">4</td>
                                        <td>Rp <span class="harga_m3">1000</span></td>
                                        <td class="total_bayar">200.000</td>
                                    </tr>
                                </thead>
                            </Table>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mr-1 mb-1">Tambahkan</button>
                        <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section("Styleload"); ?>
<link rel="stylesheet" href="\vendor\jquery-ui-1.12.1\jquery-ui.min.css">
<?= $this->endSection(); ?>
<?= $this->section("JSLoad"); ?>
<script src="\vendor\jquery-3.5.1.min.js"></script>
<script src="\vendor\jquery-ui-1.12.1\jquery-ui.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#no_meteran').autocomplete({
            source: "<?php echo site_url('admin/pelanggan/get_autocomplete'); ?>",
            focus: function(event, ui) {
                $("#no_meteran").val(ui.item.no_meteran);
                return false;
            },
            select: function(event, ui) {
                $("#no_meteran").val(ui.item.no_meteran);
                $('[name="nama"]').val(ui.item.name);
                $('[name="id"]').val(ui.item.id);
                $('[name="address"]').html(ui.item.address);
                $('[name="handphone"]').val(ui.item.handphone);
                $('[name="mtr_lama"]').val(ui.item.mtr_baru || 0);
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                .append("<div>" + item.name + "<br>" + item.no_meteran + "</div>")
                .appendTo(ul);
        };
    });
    const inputMtrBaru = document.querySelector("[name='mtr_baru']");
    const inputMtrLama = document.querySelector('[name="mtr_lama"]');
    inputMtrBaru.addEventListener('input', updateValue);

    function updateValue(e) {
        let nilaiVolume = inputMtrBaru.value - inputMtrLama.value;
        document.querySelector("td.volume_pemakaian").innerHTML = nilaiVolume;
        let hrg_m3 = parseInt(document.querySelector('span.harga_m3').innerHTML);
        document.querySelector("td.total_bayar").innerHTML = "Rp." + (hrg_m3 * nilaiVolume);
        document.querySelector('[name="volume_air"]').value = nilaiVolume;
    }
</script>
<?= $this->endSection(); ?>