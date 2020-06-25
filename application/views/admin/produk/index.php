<?php $this->load->view("admin/includes/header") ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Tabel Produk</h4>

        <a href="<?php echo base_url("Produk/insert") ?>" class="btn btn-primary">Tambah</a>
      </div>

      <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped aso-datatable-scroll">
          <thead class=" text-primary">

            <th>
              ID
            </th>
            <th>
              Jenis
            </th>
            <th>
              Ukuran
            </th>
            <th>
              Stok
            </th>
            <th class="text-right">
              Action
            </th>
          </thead>
          <tbody>
            <?php foreach ($produk_data as $key => $value) : ?>
              <tr>
                <td>
                  <?php echo $key + 1; ?>
                </td>
                <td>
                  <?php echo $value->jenis ?>
                </td>
                <td>
                  <?php echo $value->ukuran ?>
                </td>
                <td>
                  <?php echo $value->stok ?>
                </td>
                <td class="text-right">
                  <a href="<?php echo base_url("Produk/update/" . $value->id) ?>" class="btn btn-primary">Edit</a>
                  <a href="<?php echo base_url("Produk/delete/" . $value->id) ?>" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>