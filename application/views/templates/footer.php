<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Diskominfosan <?= date('Y') ?></span>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" di bawah jika Anda yakin ingin keluar dari aplikasi.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

<!-- js datepicker -->
<script src="<?php echo base_url() ?>/assets/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>

<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>

<!-- looping form -->
<script>
    $(document).ready(function() {
        for (B = 1; B <= 1; B++) {
            Barisbaru();
        }
        $('#BarisBaru').click(function(e) {
            e.preventDefault();
            Barisbaru();
        });

        $("tableLoop tbody").find('input[type=text]').filter(':visible:first').focus();
    });

    function Barisbaru() {
        $(document).ready(function() {
            $("[data-toggle='tooltip']").tooltip();
        });
        var Nomor = $("#tableLoop tbody tr").length + 1;
        var Baris = '<tr>';
        Baris += '<td>';
        Baris += '<input type="text" name="full_name[]" class="form-control first_name" placeholder="Nama lengkap..." required="">';
        Baris += '</td>';
        Baris += '<td>';
        Baris += '<input type="text" name="nim[]" class="form-control last_name" placeholder="NIM..." required="">';
        Baris += '</td>';
        Baris += '<td class="text-center">';
        Baris += '<a class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Baris" id="HapusBaris"><i class="fa fa-times"></i></a>';
        Baris += '</td>';
        Baris += '</tr>';

        $("#tableLoop tbody").append(Baris);
        $("#tableLoop tbody tr").each(function() {
            $(this).find('td:nth-child(2) input').focus();
        });

    }

    $(document).on('click', '#HapusBaris', function(e) {
        e.preventDefault();
        var Nomor = 1;
        $(this).parent().parent().remove();
        $('tableLoop tbody tr').each(function() {
            $(this).find('td:nth-child(1)').html(Nomor);
            Nomor++;
        });
    });

    $(document).ready(function() {
        $('#SimpanData').submit(function(e) {
            e.preventDefault();
            biodata();
        });
    });

    function biodata() {
        $.ajax({
            url: $("#SimpanData").attr('action'),
            type: 'post',
            cache: false,
            dataType: "json",
            data: $("#SimpanData").serialize(),
            success: function(data) {
                if (data.success == true) {
                    $('.full_name').val('');
                    $('.nim').val('');
                    $('#notif').fadeIn(800, function() {
                        $("#notif").html(data.notif).fadeOut(5000).delay(800);
                    });
                } else {
                    $('#notif').html('<div class="alert alert-danger">Data Gagal Disimpan</div>')
                }
            },

            error: function(error) {
                alert(error);
            }

        });
    }
</script>

<script>
    function showHideForm() {
        if (document.getElementById('tipe').checked) {
            document.getElementById('tableLoop').style.display = 'block';
        } else {
            document.getElementById('tableLoop').style.display = 'none';
        }
    }
</script>
</body>

</html>