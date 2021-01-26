        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Sparepart</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                            <li class="active">Sparepart</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success btn-sm btn-show-add" data-toggle="modal" data-target="#compose"><i class="fa fa-plus"></i> Tambah Sparepart</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width:20%">Nama Sparepart</th>
                                    <th style="width:20%">Motor</th>
                                    <th style="width:20%">Kode Part</th>
                                    <th style="width:10%">Type</th>
                                    <th style="width:15%">Harga</th>
                                    <th>Stok</th>
                                    <th style="width:20%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="compose" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Tambah Sparepart</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="compose-form">
                            <div class="form-group">
                                <label>Nama Sparepart</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Motor</label>
                                <input type="text" name="motor" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Kode Part</label>
                                <input type="text" name="kodepart" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select name="jenisbarang" class="form-control">
                                    <option>-- Pilih Type --</option>
                                    <option value="Biasa">Biasa</option>
                                    <option value="Original">Original</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Harga Sparepart</label>
                                <input type="number" name="price" class="form-control" id="price" value="0">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-submit">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Konfirmasi?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-del-confirm">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(".btn-show-add").on("click", function() {
                jQuery("input[name=name]").val("");
                jQuery("input[name=motor]").val("");
                jQuery("input[name=kodepart]").val("");
                jQuery("select[name=jenisbarang]").val("");
                jQuery("input[name=price]").val("");
                jQuery("#compose .modal-title").html("Tambah Sparepart");
                jQuery("#compose-form").attr("action", "<?= base_url("sparepart/insert"); ?>");
            });

            $("#data").DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url("sparepart/json"); ?>"
                }
            });


            $('.btn-submit').on("click", function() {
                var form = {
                    "name": jQuery("input[name=name]").val(),
                    "motor": jQuery("input[name=motor]").val(),
                    "kodepart": jQuery("input[name=kodepart]").val(),
                    "jenisbarang": jQuery("select[name=jenisbarang]").val(),
                    "price": jQuery("input[name=price]").val()
                }

                var action = jQuery("#compose-form").attr("action");

                jQuery.ajax({
                    url: action,
                    method: "POST",
                    data: form,
                    dataType: "json",
                    success: function(data) {
                        if (data.status) {
                            jQuery("input[name=name]").val("");
                            jQuery("input[name=motor]").val("");
                            jQuery("input[name=kodepart]").val("");
                            jQuery("select[name=jenisbarang]").val("");
                            jQuery("input[name=price]").val("");
                            jQuery("#compose").modal('toggle');
                            jQuery("#data").DataTable().ajax.reload(null, true);

                            Swal.fire(
                                'Berhasil',
                                data.msg,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Gagal',
                                data.msg,
                                'error'
                            )
                        }
                    }
                });
            });

            $('body').on("click", ".btn-delete", function() {
                var id = jQuery(this).attr("data-id");
                var name = jQuery(this).attr("data-name");
                jQuery("#delete .modal-body").html("Anda yakin ingin menghapus <b>" + name + "</b>");
                jQuery("#delete").modal("toggle");

                jQuery("#delete .btn-del-confirm").attr("onclick", "deleteData(" + id + ")");
            })

            function deleteData(id) {
                jQuery.getJSON("<?= base_url(); ?>sparepart/delete/" + id, function(data) {
                    if (data.status) {
                        jQuery("#delete").modal("toggle");
                        jQuery("#data").DataTable().ajax.reload(null, true);
                        Swal.fire(
                            'Berhasil',
                            data.msg,
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Berhasil',
                            data.msg,
                            'success'
                        )
                    }
                })
            }

            $("body").on("click", ".btn-edit", function() {
                var id = jQuery(this).attr("data-id");
                var name = jQuery(this).attr("data-name");
                var motor = jQuery(this).attr("data-motor");
                var kodepart = jQuery(this).attr("data-kodepart");
                var jenisbarang = jQuery(this).attr("data-jenisbarang");
                var price = jQuery(this).attr("data-price");

                jQuery("#compose .modal-title").html("Edit Sparepart");
                jQuery("#compose-form").attr("action", "<?= base_url(); ?>sparepart/update/" + id);
                jQuery("input[name=name]").val(name);
                jQuery("input[name=motor]").val(motor);
                jQuery("input[name=kodepart]").val(kodepart);
                jQuery("select[name=jenisbarang]").val(jenisbarang);
                jQuery("input[name=price]").val(price);

                jQuery("#compose").modal("toggle");
            });
        </script>