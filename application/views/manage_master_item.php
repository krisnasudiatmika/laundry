<div class="row">
  <div class="col-md-4">
	  <div class="form-group">
	  <label>Nama Item</label>
	  <input type="text" id="new_item" class="form-control">
	  </div>
  </div>
  <div class="col-md-4">
	  <div class="form-group">
	  <label>Harga Item</label>
	  <input type="number" id="new_price" class="form-control">
	  </div>
  </div>
  <div class="col-md-4">
	  
  </div>
</div>

<div class="form-group">
<input type="submit" class="btn btn-primary" id="save_item" value="Add Item">
</div>

<table class="table" id="table_item">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
<?php 
	
	foreach($data -> result() as $row){
		echo '<tr>';
		echo '<td>'.$row->No.'</td>';
		echo '<td>'.$row->item_name.'</td>';
		echo '<td>'.$row->price.'</td>';
		echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal'.$row->No.'"><i class="glyphicon glyphicon-pencil"></i></button> | <button type="button" class="btn btn-danger list_item'.$row->No.'" ><i class="glyphicon glyphicon-remove"></i></button> </td>';
		echo '</tr>';
		?>
		<!-- Modal -->
		<div class="modal fade" id="exampleModal<?php echo $row->No?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
			       <input type="text" id="item_id<?php echo $row->No?>" class="form-control" value="<?php echo $row->No;?>">
			    <label>Item Name</label>
		       <input type="text" id="item_name<?php echo $row->No?>" class="form-control" value="<?php echo $row->item_name;?>">
		       <label>Price</label>
		       <input type="text" id="item_price<?php echo $row->No?>" class="form-control" value="<?php echo $row->price;?>">
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" id="edit_item<?php echo $row->No?>" class="btn btn-primary">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>
			<script>
			$(document).ready(function(){
				var id = $('#item_id<?php echo $row->No ;?>').val();
				$('#edit_item<?php echo $row->No ;?>').click(function(){
					
					var item_price = $('#item_price<?php echo $row->No ;?>').val();
					var item_name = $('#item_name<?php echo $row->No ;?>').val();
					   $.ajax({
						   url:"http://localhost/laundry/manage/update_master_item/",
						   method:"POST",
						   data:{id:id,item_price:item_price,item_name:item_name},
						   success:function(data){
						   alert('sukses');
						   }
						  });
				});	
				$("#table_item").on('click','.list_item<?php echo $row->No;?>',function(){
					 var confirmText = "Anda Yakin Menghapus Item?";
					 if(confirm(confirmText)){
					$.ajax({
						   url:"http://localhost/laundry/manage/delete_master_item/",
						   method:"POST",
						   data:{id:id},
						   success:function(data){
						   
						   
						   }
						  });
					$(this).parent().parent().remove();
					}	 
				
				});	
				
				return false;
				
			
			});
	</script>
		<?php
	}
?>

</tbody>
</table>

<script>
	$(document).ready(function(){
		$('#save_item').click(function(){
					var item_name = $('#new_item').val();
					var item_price = $('#new_price').val();
					
					if (item_name == "" || item_price == 0){
						alert('Pastikan Data Terisi');
					}else {
					
					$.ajax({
						   url:"http://localhost/laundry/manage/add_master_item/",
						   method:"POST",
						   data:{item_name:item_name,item_price:item_price},
						   success:function(data){
						   alert('sukses');
						   location.reload(true);
						   }
						  });
						  }
				});
	});
	
		
	
	</script>




