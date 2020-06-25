<?php $this->load->view("admin/includes/header") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Produk </h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('') ?>


                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Jenis</label>
                    <div class="col-md-10">
                        <input type="text" name="jenis" class="form-control" placeholder="jenis" value="<?php echo $produk_data->jenis ?>">
                        <?php echo form_error('jenis', '', '') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Ukuran</label>
                    <div class="col-md-10">
                        <input type="text" name="ukuran" class="form-control" placeholder="ukuran" value="<?php echo $produk_data->ukuran ?>">
                        <?php echo form_error('ukuran', '', '') ?>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Stok</label>
                    <div class="col-md-10">
                        <input type="text" name="stok" class="form-control" placeholder="stok" value="<?php echo $produk_data->stok ?>">
                        <?php echo form_error('stok', '', '') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-2 col-md-12">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>
<script>
    $(document).ready(function() {
        $('#input-file').change(function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        })
    });
</script>