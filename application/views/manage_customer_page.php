<script>
	
	$(document).ready(function(){
		$('.delete').click(function(){
			  var nama = $(this).val();
			  
			  
			 
			  
			  $.ajax({
			   url:"http://localhost/laundry/manage/delete_customer",
			   method:"POST",
			   data:{id_customer:nama},
			   success:function(data){
			  alert('sukses');
			  
			   }
			  });
 			});
 			
 		$('#save_update').click(function(){
			  var id = $('#id_update').val();
			  var nama = $('#nama_update').val();
			  var alamat = $('#alamat_update').val();
			  var tlp = $('#tlp_update').val();
			  var kota = $('#kota_update').val();
			  
			 
			  
			  $.ajax({
			   url:"http://localhost/laundry/manage/update_customer",
			   method:"POST",
			   data:{id_customer:id,nama:nama,alamat:alamat,telepon:tlp,kota:kota},
			   success:function(data){
			   var sukses = "<div class = 'alert alert-success'>sukses</div>";
			  alert('sukses');
			  
			   }
			  });
 			});

	});
</script>

<div id="container">
<table class="table" id="table_item">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
<?php
	foreach ($result as $row){
		?>
		<tr>
		<td><?php echo($row->id_customer)?></td>
		<td><?php echo($row->nama)?></td>
		<td><?php echo($row->alamat)?></td>
		<td><?php echo($row->telepon)?></td>
		<td><?php echo($row->kota)?></td>
		<td><button class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $row->id_customer; ?>"><span class = "glyphicon glyphicon-pencil"></span> Edit</button></td>
		<td><button class="btn btn-danger delete" value="<?php echo $row->id_customer; ?>"><span class = "glyphicon glyphicon-trash"></span> Delete</button></td>
		</tr>
		
					<!-- Modal -->
<div class="modal fade" id="edit<?php echo $row->id_customer?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	      <input type="hidden" value="<?php echo $row->id_customer;?>" id="id_update">
	      <label>Nama</label>
        <input type="text" class="form-control" value="<?php echo($row->nama); ?>" id="nama_update">
        <label>Alamat</label>
        <input type="text"class="form-control" value="<?php echo($row->alamat); ?>" id="alamat_update">
        <label>Telepon</label>
        <input type="text" class="form-control" value="<?php echo($row->telepon); ?>" id="tlp_update">
        <label>Kota</label>
        <input type="text" class="form-control" value="<?php echo($row->kota); ?>" id="kota_update">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save_update">Save changes</button>
      </div>
    </div>
  </div>
</div>
		<?php
	}
	
	
	?>
  </tbody>
</table>

</div>