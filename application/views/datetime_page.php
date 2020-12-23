<script>
	
	 $( function() {
	 	$( ".tanggal" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );

	</script>

<table class="table" id="table_item">
		  <thead>
		    <tr>
			  <th scope="col">Id Transaksi</th>
		      <th scope="col">Id Customer</th>
		      <th scope="col">Tanggal Masuk</th>
		      <th scope="col">QTY</th>
		      <th scope="col">Sub Total</th>
		      <th scope="col">Grand Total</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
	</div>	
		<?php
		foreach($query ->result() as $row){
			?>
			<script>
				$(document).ready(function(){
				$('#save_manage<?php echo $row->id; ?>').click(function(){
					var id_transaksi = $('#id_transaksi<?php echo $row->id;?>').val();
					var tgl_masuk = $('#update_tgl_masuk<?php echo $row->id;?>').val();
					
			  $.ajax({
			   url:"http://localhost/laundry/manage/delete_transaksi",
			   method:"POST",
			   data:{trans_id:id_transaksi,tgl_masuk:tgl_masuk},
			   success:function(data){
			    alert('Tanggal Telah Di Update');
			    location.reload(true);
			  
			   }
			   });
 				});
 				
 				$('#delete_transaksi<?php echo $row->id; ?>').click(function(){
	 				var trans_id = escape($('#update_tgl_masuk<?php echo $row->id;?>').val());
	 				var trim_id = $.trim(trans_id);
	 				 $.ajax({
			   url:"http://localhost/laundry/manage/delete_transaksi",
			   method:"POST",
			   data:{trans_id:trim_id},
			   success:function(data){
			    console.log(trim_id);
			    console.log(data);
			
			   }
			   });
 				});
	 				
 				
				});
			
				</script>
			<?php
			?>
				<tr>
				<td><?php echo($row->id)?></td>
				<td><?php echo($row->id_transaksi)?></td>
				<td><?php echo($row->nama)?></td>
				<td><?php echo($row->tanggal_masuk)?></td>
				<td><?php echo($row->qty)?></td>
				<td><?php echo($row->sub_total)?></td>
				<td><?php echo($row->grand_total)?></td>
			
			
				<td class="action"><button class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $row->id; ?>"><span class = "glyphicon glyphicon-pencil"></span> Edit</button>
				<button class="btn btn-danger" id="delete_transaksi<?php echo $row->id; ?>"><span class = "glyphicon glyphicon-trash"></span> Delete</button></td>
				</tr>
						<!-- Modal -->
<div class="modal fade" id="edit<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Tanggal Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
		<input class="form-control tanggal" id="update_tgl_masuk<?php echo $row->id; ?>" type="text" value="<?php echo($row->tanggal_masuk); ?>" >
		<input class="form-control" id="id_transaksi<?php echo $row->id; ?>" type="text" value="<?php echo($row->id_transaksi);?>" > 
		


        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save_manage<?php echo $row->id; ?>">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php			
	
}
?>



<script>
	$(document).ready(function(){
		$('#delete').click(function(){
	 				var trans_id = escape($('#testing').val());
	 				var trim_id = trans_id.replace(/\r\n|\r|\n/g,"\n");
	 				 $.ajax({
			   url:"http://localhost/laundry/manage/delete_transaksi",
			   method:"POST",
			   data:{trans_id:trim_id},
			   success:function(data){
			    console.log(trim_id);
			    console.log(data);
			
			   }
			   });
			     });
	});
	
	</script>
