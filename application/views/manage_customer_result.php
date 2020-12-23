<table class="table">
  <thead>
    <tr>
      <th scope="col">ID Customer</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
      <th scope="col">Telepon</th>
      <th scope="col">Kota</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php

foreach ($query as $row) {
  // code...
  ?>

      <tr>

        <td><?php echo $row->id_customer ?></td>
        <td><?php echo $row->nama ?></td>
        <td><?php echo $row->alamat ?></td>
        <td><?php echo $row->telepon ?></td>
        <td><?php echo $row->kota ?></td>
        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $row->id_customer ?>">
          Option
        </button></td>

      </tr>
      <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="<?php echo $row->id_customer ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="">Nama</label>
        <input class="form-control" id="nama<?php echo $row->id_customer ?>" value="<?php echo $row->nama ?>">
        <label for="">Alamat</label>
        <input class="form-control" id="alamat<?php echo $row->id_customer ?>" value="<?php echo $row->alamat ?>">
        <label for="">Telepon</label>
        <input class="form-control" id="tlp<?php echo $row->id_customer ?>" value="<?php echo $row->telepon ?>">
        <label for="">Kota</label>
        <input class="form-control" id="kota<?php echo $row->id_customer ?>" value="<?php echo $row->kota ?>">
      </div>
      <div class="modal-footer">
        <button type="button" id="hapus<?php echo $row->id_customer ?>" data-id="<?php echo $row->id_customer ?>" class="btn btn-danger" data-dismiss="modal">Hapus Customer</button>
        <button type="button" id="simpan<?php echo $row->id_customer ?>" data-id="<?php echo $row->id_customer ?>" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $('#hapus<?php echo $row->id_customer ?>').click(function(){
    if(confirm('Anda Yakin Menghapus Data ? ')){
    var id = $(this).data('id');
    $.ajax({
     url:"http://localhost/laundry/manage/hapuscustomer",
     method:"POST",
     data:{id:id},
     success:function(data){
      alert('Transaksi Berhasil Dihapus');
      location.reload(true);

     }
     });

   }else{
     return false;
   }
  });

  $('#simpan<?php echo $row->id_customer ?>').click(function(){
    if(confirm('Simpan Data ? ')){
    var id = $(this).data('id');
    var nama= $('#nama'+id).val();
    var alamat= $('#alamat'+id).val();
    var tlp= $('#tlp'+id).val();
    var kota= $('#kota'+id).val();
    console.log(id);
    $.ajax({
     url:"http://localhost/laundry/manage/updatecustomer",
     method:"POST",
     data:{id:id,nama:nama,alamat:alamat,tlp:tlp,kota:kota},
     success:function(data){
      alert('Data Berhasil Disimpan');
      location.reload(true);

     }
     });

   }else{
     return false;
   }
  });

  });


</script>



<?php
}
 ?>
</tbody>
</table>
