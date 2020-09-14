<?= $this->extend($_adminTemplate); ?>
<?= $this->section("MainLoad"); ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $page_title; ?></h4>
        <p class="card-text">Silahkan Tambahkan pelanggan atau edit data pelanggan!</p>
        <a href="<?= route_to("pelanggan") . "/tambah"; ?>" class="btn btn-primary">Tambah Pelanggan</a>

    </div>
    <div class="card-content">
        <!-- <div class="card-body">
            
        </div> -->

        <!-- Table with no outer spacing -->
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>No. Meteran</th>
                        <th>EMAIL</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = ($currentPage * $perPage) - $perPage + 1;
                    foreach ($pelanggans as $row => $val) : ?>
                        <tr>
                            <td class="text-bold-500"><?= $no++; ?></td>
                            <td class="text-bold-500"><?= $val['name']; ?></td>
                            <td class="text-bold-500"><?= $val['no_meteran']; ?></td>
                            <td><u><?= $val['email']; ?></u></td>
                            <td><?= $val['is_active'] == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Not active</span>'; ?></td>
                            <td class="text-bold-500">
                                <a href="<?= route_to("pelanggan") . "/edit/" . $val['id']; ?>" class="btn icon icon-left btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>Edit</a>
                                <a href="#delete" class="btn icon icon-left btn-danger" onclick="show_delete(<?= $val['id']; ?>)" data-toggle="modal" data-target="#backdrop"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                    </svg>Delete</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="container my-2">
        <?= $pager->links('users', "bootstrap_pagination") ?>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section("JSLoad"); ?>
<?= $this->endSection(); ?>