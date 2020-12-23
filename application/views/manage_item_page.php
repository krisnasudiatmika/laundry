<script>
	
	var data_json ="";
	
	$(function(){
		 $.ajax({
			   url:"http://localhost/laundry/transaksi/save_db",
			   success:function(data){
			    $('#id_cust').val(data);
			   }
			  });
	});
	
	$(function(){
		 $.ajax({
			   url:"http://localhost/laundry/manage/get_item_id",
			   success:function(data){
			   
			    data_json = jQuery.parseJSON(data);
			    console.log(data_json);
			    var select = $("<select></select>").attr("id", "cities").attr("name", "cities");
			     $.each(data_json,function(index,json){
				     select.append($("<option></option>").attr("value", json.id_item).text(json.item_name));
				    }); 
			  $("#sukses").html(select);
			   }
			  });
		 $('#first-disabled').on('change', function() {
		     var value = "";
		     var item_name ="";
			var select_data = $('#first-disabled').val();
			var as=$(data_json).filter(function (i,n){return n.id_item===select_data});
			if (as.length == 0){
				alert('Maaf Data Yang Anda Cari Tidak Ditemukan');
				
			}else {
				for (var i=0;i<as.length;i++)
					{
					    
					    item_name = as[i].item_name;
					    
					}
				$('#item_name').val(item_name);
				
			}
		});
	});
	
	
	
	 $(document).ready(function(){
		$("#table_item").on('click','.item_button',function(){
        $(this).parent().parent().remove();
       
    });
		$('#add_data_table').click(function() {
			var item_name = $("#item_name").val();
			var id = $("#first-disabled").val();
			var price = $('#price_val').val();
			
			if(price == 0 || price == "" || id == 0){
				alert('pastikan anda memilih item dan mengisi harga');
			}else {
			
				$('#table_item').append("<tr>" + "<td class='id_item'>" + id + "</td>"+"<td class='item_name'>" + item_name + "</td>" + "<td id='price_sum' class='item_price'>" + price + "</td>" +"<td > <button type='submit' class='btn btn-danger item_button' id='remove_data_table'><i class='glyphicon glyphicon-trash'></i></button></div></td>"+ "</tr>");
		$('#select_val').val('');
		$('#price_val').val('');
		}
		}) ;
		
			
		
				$('#save_item').click(function(){
				
				var item_id = [];		
			  var item_name = [];
			  var price_item = [];
			  var id_cust = $('#id_cust').val();
			  var nama_cust = $('#nama_cust').val();
			  var alamat_cust = $('#alamat_cust').val();
			  var tlp_cust =$('#tlp_cust').val();
			  var kota = $('#kota_cust').val(); 
			  
			  $('.id_item').each(function(){
			   item_id.push($(this).text());
			  });
			  $('.item_price').each(function(){
			   price_item.push($(this).text());
			  });
			  $('.item_name').each(function(){
			   item_name.push($(this).text());
			  });
			  
			  if (nama_cust == "" || alamat_cust =="" || tlp_cust == "" || kota == "" ){
				  alert('Pastikan Melengkapi Data Customer');
			  }else if (item_id.length == 0) {
				  alert('Pastikan Anda Mengisi Item');
			  }else {
			  
			  $.ajax({
			   url:"http://localhost/laundry/manage/add_data_item",
			   method:"POST",
			   data:{item_name:item_name,price_item:price_item,id_cust:id_cust,item_id:item_id,nama_cust:nama_cust,alamat_cust:alamat_cust,tlp_cust:tlp_cust,kota:kota},
			   success:function(data){
			    console.log(data);
			   $('#table_item td').remove();
			   $('#berhasil').html('<div class="alert alert-success" role="alert">Data Ditambahkan</div>');
			   setTimeout(function() { window.location=window.location;},1000);
			  
			   }
			  });
			  }
			  
 			});
		
		
	 });
	 

	  
	  function addDataTable(){
		  
		var table = document.getElementById("table_item"), total = 0;
	  for(var i = 1; i < table.rows.length; i++){
		  total = total + parseInt(table.rows[i].cells[2].innerHTML);
	  }
	  $('#total_price').val(total);

	  }
	  
	
$(function() {
	
 
		 $.ajax({
			   url:"http://localhost/laundry/manage/get_item_id",
			   success:function(data){
			   var toAppend = '';
			    json_data = jQuery.parseJSON(data);
			    console.log(json_data);
			    
			     $.each(json_data,function(index,json){
				     toAppend += '<option value= '+json.id_item+'>'+json.item_name+'</option>';
				    }); 
			 $('#first-disabled').append(toAppend);
			   }
			  });
});


	
	
	</script>
	



<div id="exTab1">	
	<div id="berhasil"></div>
<ul  class="nav nav-pills">
			<li class="active">
				<a  href="#1a" data-toggle="tab">Tambah Data Customer</a>
			</li>
				<li><a href="#2a" data-toggle="tab">Tambah Item Customer</a>
			</li>
			
		</ul>

			<div class="tab-content clearfix">
			  <div class="tab-pane active" id="1a">
					<label>Kode Customer</label>
				  	<input type="text" class="form-control" placeholder="Customer ID" id="id_cust" disabled="true">
				  	<label>Nama</label>
					<input type="text" class="form-control" placeholder="Nama" id="nama_cust">
					<label>Alamat</label>
					<input type="text" class="form-control" placeholder="Alamat" id="alamat_cust">
					<label>Telepon</label>
					<input type="number" class="form-control" placeholder="telepon" id="tlp_cust">
					<label>Kota</label>
					<input type="text" class="form-control" placeholder="Kota" id="kota_cust">

				</div>
				<div class="tab-pane" id="2a">
				<input type="text" class="form-control" id="item_name" style="visibility: hidden;">
					<div class="row">
						  <div class="col-md-4">
							    <select id="first-disabled" >
								    <optgroup>
								      <option value = "0" selected>Pilih Item</option>
								    </optgroup>
								   
								</select>
						  </div>
						  <div class="col-md-4">
							  	
							  	<input type="number" class="form-control" id="price_val" aria-describedby="emailHelp" placeholder="Price" name='qty' >
						  </div>
						  <div class="col-md-4"><button type="submit" class="btn btn-primary" id="add_data_table">Tambah</button></div>
					</div>
				<div class="row">
				  <div class="col-xs-6 col-md-4">
					   	<div class="form-group">
						    
						    
						    <input id="trans_id" type="hidden">
						    <input  id="trans_tel" type="hidden">
				    	</div>
				  </div>
				  	 <div class="container">
				  <table class="table" id="table_item">
				  <thead>
				    
				     
				      <th scope="col">ID Item</th>
				      <th scope="col">Nama Item</th>
				      <th scope="col">Harga</th>
				      <th scope="col">Action</th>
				      
				    
				  </thead>
				  <tbody>
				  
				  </tbody>
				</table>
				
				
<button id="save_item" class="btn btn-primary" type="submit">Simpan</button>
				 </div>
				  <div class="col-xs-6 col-md-4"></div>
				

				</div>
      
			</div>
  </div>

