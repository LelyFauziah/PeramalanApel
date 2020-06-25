<?php $this->load->view("admin/includes/header") ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">User</h4>

        <a href="<?php echo base_url("Users/insert") ?>" class="btn btn-primary">Tambah</a>
      </div>
      <div class="card-body table-full-width table-responsive">
        <table class="table table-hover table-striped aso-datatable-scroll">
          <thead>
            <th>
              #
            </th>
            <th>
              Nama
            </th>
            <th>
              Username
            </th>
            <th>
              Level
            </th>
            <th>
              Gambar
            </th>
            <th class="text-right">
              Action
            </th>
          </thead>
          <tbody>
            <?php foreach ($users_data as $key => $value) : ?>
              <tr>
                <td>
                  <?php echo $key + 1; ?>
                </td>
                <td>
                  <?php echo $value->nama ?>
                </td>
                <td>
                  <?php echo $value->username ?>
                </td>
                <td>
                  <?php switch ($value->level) {
                    case 1:
                      echo '<span class="badge badge-primary">Admin</span>';
                      break;
                    case 2:
                      echo '<span class="badge badge-success">Karyawan</span>';
                      break;
                    case 3:
                      echo '<span class="badge badge-info">Supplier</span>';
                      break;
                  } ?>
                </td>
                <td>
                  <img src="<?php echo base_url("storage/users/" . $value->gambar) ?>" alt="" width="100px">
                </td>
                <td class="text-right">
                  <a href="<?php echo base_url("Users/update/" . $value->id) ?>" class="btn btn-primary">Edit</a>
                  <a href="<?php echo base_url("Users/delete/" . $value->id) ?>" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
            <?php endforeach ?>


          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>