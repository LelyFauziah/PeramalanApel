<?php $this->load->view("admin/includes/header") ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Pasar</h4>

        <a href="<?php echo base_url("Pasar/insert") ?>" class="btn btn-primary">Tambah</a>
      </div>
      <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped aso-datatable-scroll">
          <thead class=" text-primary">
            <th>
              ID
            </th>
            <th>
              Nama
            </th>
            <th>
              Alamat
            </th>
            <th class="text-right">
              Action
            </th>
          </thead>
          <tbody>
            <?php foreach ($pasar_data as $key => $value) : ?>
              <tr>
                <td>
                  <?php echo $key + 1; ?>
                </td>
                <td>
                  <?php echo $value->nama ?>
                </td>
                <td>
                  <?php echo $value->alamat ?>
                </td>
                <td class="text-right">
                  <a href="<?php echo base_url("Pasar/update/" . $value->id) ?>" class="btn btn-primary">Edit</a>
                  <a href="<?php echo base_url("Pasar/delete/" . $value->id) ?>" class="btn btn-danger">Hapus</a>
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