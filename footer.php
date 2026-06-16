</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-light border-top">
    <div class="container my-auto">
        <div class="text-center py-4">

            <h5 class="mb-2 font-weight-bold text-primary">
                © 2026 नगर पंचायत प्रबंधन प्रणाली
            </h5>

            <p class="mb-0" style="font-size:17px;">
                डिज़ाइन एवं विकसित :
                <span class="font-weight-bold text-dark">
                    <a href="https://itacademics.co.in/">IT ACADEMICS (P) LTD</a>
                </span>
            </p>

        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">क्या आप सत्र समाप्त करना चाहते हैं?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">यदि आप अपना वर्तमान सत्र (Session) समाप्त करना चाहते हैं, तो नीचे दिए गए "Logout" बटन पर क्लिक करें।</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="Home">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="assets/vendor/chart.js/Chart.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- Page level custom scripts -->
<script src="assets/js/demo/chart-area-demo.js"></script>
<script src="assets/js/demo/chart-pie-demo.js"></script>
<script src="assets/js/demo/datatables-demo.js"></script>

<script>
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();

        let url = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "This record will be deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>

<?php if ($this->session->flashdata('success')) { ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?= $this->session->flashdata('success'); ?>',
            timer: 2500,
            showConfirmButton: false
        });
    </script>
<?php } ?>

<?php if ($this->session->flashdata('error')) { ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?= $this->session->flashdata('error'); ?>',
            timer: 2500,
            showConfirmButton: false
        });
    </script>
<?php } ?>

<?php if ($this->session->flashdata('warning')) { ?>
    <script>
        Swal.fire({
            icon: 'warning',
            text: '<?= $this->session->flashdata('warning'); ?>'
        });
    </script>
<?php } ?>

<?php if ($this->session->flashdata('info')) { ?>
    <script>
        Swal.fire({
            icon: 'info',
            text: '<?= $this->session->flashdata('info'); ?>'
        });
    </script>
<?php } ?>

<script>
    $(document).on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        $('#edit_id').val(id);
        $('#edit_name').val(name);

        $('#editMasterModal').modal('show');
    });
</script>



</body>

</html>