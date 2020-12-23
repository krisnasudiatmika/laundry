

<table class="table" id="table_item">
  <thead>
    <tr>
      <th scope="col">Item Name</th>
      <th scope="col">Cust Price</th>
      <th scope="col">Master Price</th>
      <th scope="col">Action</th>
    </tr>
   
  </thead>
  
  <?php 
	  foreach($query -> result() as $row){
		 ?>
		  <script>
	$(document).ready(function(){	
		$('#save_price-<?php echo $row->id;?>').click(function(){
			var id_cust = $('#id_cust_val-<?php echo $row->id;?>').val();
			var id_item = $('#id_item_val-<?php echo $row->id;?>').val();
			var new_price = $('#price_val-<?php echo $row->id;?>').val();
			  $.ajax({
			   url:"http://localhost/laundry/manage/update_price_cust",
			   method:"POST",
			   data:{id_cust:id_cust,id_item:id_item,new_price:new_price},
			   success:function(data){
			    alert('Harga telah dirubah');
			   
			   }
			  });
		});
	});
</script>
		  
		   <?php
	  echo "<tr>";
	  echo "<td>".$row -> item_name ."</td>";
	  echo "<td>".$row -> new_price ."</td>";
	  echo "<td>".$row -> price ."</td>";
	  echo "<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal".$row->id."'>Edit</button></td>";
	  echo "</tr>";
	  ?>
	    <!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $row->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Merubah Harga Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	      <label>Customer Price</label>
	      <input type="text" class="form-control" id="price_val-<?php echo $row->id;?>" value="<?php echo $row->new_price;?>" >
	      <input type="text" id="id_item_val-<?php echo $row->id;?>" value="<?php echo $row->id_item;?>"  style="display: none;">
	      <input type="text" id="id_cust_val-<?php echo $row->id;?>" value="<?php echo $id_cust;?>" style="display: none;">
	      
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="save_price-<?php echo $row->id;?>" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
	  <?php
  }
	  
	  
  ?> 
  
