<?php $this->load->view("admin/includes/header") ?>
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Nama Karyawan</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="<?php echo $this->session->userdata('userlogin')['nama'] ?>" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Tanggal</label>
                    <div class="col-md-8">
                        <input type="datetime-local" name="tanggal" class="form-control form-tanggal" value="<?php echo date('Y-m-d\TH:i:s') ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Petani</label>
                    <div class="col-md-8">
                        <input class="form-control form-petani" list="list_petani">
                        <datalist id="list_petani">
                            <?php foreach ($this->db->group_by('petani')->get('pembelian')->result() as $key => $value) : ?>
                                <option value="<?php echo $value->petani ?>"><?php echo $value->petani ?></option>
                            <?php endforeach ?>
                        </datalist>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php echo form_open('', ['id' => 'form-produk']); ?>
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">produk</label>
                    <div class="col-md-8">
                        <select name="fk_produk" class="form-control">
                            <?php foreach ($this->db->get('produk')->result() as $key => $value) : ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->jenis . " " . $value->ukuran ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Jumlah</label>
                    <div class="col-md-8">
                        <input type="number" name="jumlah" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-4 col-md-8">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        Nama produk
                    </div>
                    <div class="col-md-5">
                        Jumlah
                    </div>
                    <div class="col-md-2">
                        Action
                    </div>
                </div>

                <?php echo form_open('', ['id' => 'form-persediaan']); ?>
                <input type="hidden" name="petani" id="petani">
                <input type="hidden" name="tanggal" id="tanggal">
                <div class="container-produk">

                </div>
                <input type="submit">

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="alert-container">

    </div>

</div>
<div id="sample-produk" style="display:none">
    <div class="row mt-3 produk">
        <div class="col-md-5">
            <select name="fk_produk" class="form-control fk_produk">
                <?php foreach ($this->db->get('produk')->result() as $key => $value) : ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->jenis . " " . $value->ukuran ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-5">
            <input type="number" name="jumlah" class="form-control jumlah">
        </div>
        <div class="col-md-2">
            <button class="btn btn-sm btn-danger m-0" onclick="$(this).parents('.produk').remove()">Delete</button>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>
<script>
    var cname_url = "<?php echo base_url('Pembelian') ?>";
    var index = 0;

    $(document).ready(function() {
        $('#form-produk').submit(function(e) {
            e.preventDefault();

            let elementForm = $(this);

            let fk_produk = elementForm.find('[name="fk_produk"]').val();
            let jumlah = elementForm.find('[name="jumlah"]').val();

            let is_already_exist = false;
            $('.container-produk').find('.fk_produk').each(function(i, obj) {
                if ($(obj).val() == fk_produk) {
                    is_already_exist = true;
                    let jum = $(obj).parents(".produk").find('.jumlah').val();
                    let sum = parseInt(jum) + parseInt(jumlah);
                    $(obj).parents(".produk").find('.jumlah').val(sum);
                }
            });
            if (!is_already_exist) {

                let old_html = $('#sample-produk').html();
                $('#sample-produk').find('[name="fk_produk"]').prop('name', "produk[" + index + "][fk_produk]");
                $('#sample-produk').find('[name="jumlah"]').prop('name', "produk[" + index + "][jumlah]");

                let html = $('#sample-produk').html();
                $('.container-produk').append(html);

                $('.container-produk').find('.produk').last().find('.fk_produk').val(fk_produk);
                $('.container-produk').find('.produk').last().find('.jumlah').val(jumlah);

                $('#sample-produk').html(old_html);
                index++;
            }
        });

        $('#form-persediaan').submit(function(e) {
            e.preventDefault();


            let petani = $(".form-petani").val();

            if (petani == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please fill petani',
                })
                return;
            }

            let elementForm = $(this);
            let submitForm = elementForm.find('button[type="submit"]');

            let formData = new FormData(this);

            $.ajax({
                    url: cname_url + "/add_pembelian",
                    type: 'POST',
                    data: formData,
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: () => {
                        submitForm.addClass('disabled');
                    }
                })
                .done((data) => {
                    $('.container-produk').html("");
                    $('.form-petani').val("");

                    Swal.fire({
                        icon: data.type,
                        title: data.title,
                        text: data.text,
                    })

                    let alert_html = "";
                    alert_html += '<a href="'+data.detail_url+'">';
                    alert_html += '<div class="alert alert-primary">';
                    alert_html += 'Berhasil melakukan tambah pembelian klik untuk melakukan confirm pembelian';
                    alert_html += '</div>';
                    alert_html += '</a>';

                    $('#alert-container').append(alert_html);

                    submitForm.removeClass('disabled');
                });

        });

        $('.form-petani,.form-tanggal').change(function() {
            let petani = $('.form-petani').val();
            $('#petani').val(petani);
            let tanggal = $('.form-tanggal').val();
            $('#tanggal').val(tanggal);
        })
    });
</script>