<?php $this->load->view('admin/header'); ?>



<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">नेताओं की सूची</h1>
        <!-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol> -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">नेता जोड़ें</h5>
                    </div>

                    <div class="card-body">

                        <form method="post"
                            action="<?= base_url('Admin/saveLeader') ?>"
                            enctype="multipart/form-data">

                            <div class="row">

                                <div class="col-md-5 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text"
                                        name="leader_title"
                                        class="form-control"
                                        required>
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label class="form-label">Photo</label>
                                    <input type="file"
                                        name="leader_file"
                                        class="form-control"
                                        required>
                                </div>

                                <div class="col-md-2 mb-3 d-flex align-items-end">
                                    <button type="submit"
                                        class="btn btn-success w-100">
                                        Save
                                    </button>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold text-dark">
                    नेताओं की सूची
                </h3>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table id="datatablesSimple"
                        class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>क्र0 स0</th>
                                <th>Title</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php $i = 1;
                            foreach ($leaders as $row) { ?>

                                <tr>

                                    <td><?= $i++ ?></td>

                                    <td><?= $row->leader_title ?></td>

                                    <td>
                                        <img src="<?= base_url('assets/uploads/our_leaders/' . $row->leader_file) ?>"
                                            width="80"
                                            height="80"
                                            style="object-fit:cover;border-radius:5px;">
                                    </td>

                                    <td>

                                        <a href="javascript:void(0)"
                                            class="btn btn-primary btn-sm btn-edit-leader"
                                            data-id="<?= $row->id ?>"
                                            data-title="<?= $row->leader_title ?>">

                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="<?= base_url('Admin/deleteLeader/' . $row->id) ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this leader?')">

                                            <i class="fas fa-trash"></i>
                                        </a>

                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- <div class="modal fade" id="editMasterModal" tabindex="-1" aria-hidden="true"> -->
        <div class="modal fade"
            id="editLeaderModal"
            tabindex="-1"
            aria-hidden="true">

            <div class="modal-dialog">

                <form method="post"
                    action="<?= base_url('Admin/updateLeader'); ?>"
                    enctype="multipart/form-data">

                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">
                                नेता संपादित करें
                            </h5>

                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                            </button>
                        </div>

                        <div class="modal-body">

                            <input type="hidden"
                                name="id"
                                id="leader_edit_id">

                            <div class="mb-3">
                                <label class="form-label">Title</label>

                                <input type="text"
                                    name="leader_title"
                                    id="leader_edit_title"
                                    class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Photo</label>

                                <input type="file"
                                    name="leader_file"
                                    class="form-control">
                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="submit"
                                class="btn btn-success">
                                Update
                            </button>

                            <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                                Close
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>
    </div>
</main>


<script>
    $(document).on('click', '.btn-edit-leader', function() {

        $('#leader_edit_id').val($(this).data('id'));
        $('#leader_edit_title').val($(this).data('title'));

        const modal = new bootstrap.Modal(
            document.getElementById('editLeaderModal')
        );

        modal.show();
    });
</script>


<?php $this->load->view('admin/footer'); ?>