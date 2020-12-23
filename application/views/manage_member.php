
<script>
	var id = "";
	var data_json ="";
    $( function() {
	    <?php foreach($data_cust_json as $row){
			$data[] = array(
				'label' => $row->nama,
				'id_customer' => $row->id_customer,
				'nama' => $row->nama,
				'alamat' => $row->alamat,
				'telepon' => $row->telepon,
				'kota' => $row->kota
			);

			$data_result = json_encode($data);

		}?>
  var data_customer = <?php echo($data_result);?>




    $( "#trans_nama" ).autocomplete({
      source: data_customer,
      focus: function( event, ui ) {
        $( "#trans_nama" ).val( ui.item.nama );
        return false;
      },
      select: function( event, ui ) {
	     $( "#trans_nama" ).val( ui.item.nama );
        $( "#trans_id" ).val( ui.item.id_customer );
        $('#trans_tlp').val( ui.item.telepon );
        $('#trans_alamat').val( ui.item.alamat );
        $('#trans_kota').val( ui.item.kota );
        id = $('#trans_id').val();
        $('#add_item_modal').removeAttr('style');



        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.nama + "<br>" + item.alamat + "</div>" )
        .appendTo( ul );
    };



  } );
 $(document).ready(function(){
	$('#get_data_table').click(function(){
		var id = $('#trans_id').val();
	 		  $.ajax({
			   url:"http://localhost/laundry/manage/get_cust_item",
			   method:"POST",
			   data: {id:id},
			   success:function(data){
			$('#show_table').html(data);
			   }
			  });
 		});
 	$('#simpan').click(function(){
	 	var alamat = $('#trans_alamat').val();
	 	var id = $('#trans_id').val();
	 	var nama = $('#trans_nama').val();
	 	var tlp = $('#trans_tlp').val();
	 	var kota = $('#trans_kota').val();
	 	if(id == ""){
	 		 $('#berhasil').html('<div class="alert alert-danger"><strong>Error!</strong> Data Customer Tidak tersedia dalam Database</div>');
	 	}else {
	 	 $.ajax({
			   url:"http://localhost/laundry/manage/simpan_cust_data",
			   method:"POST",
			   data: {id:id,alamat:alamat,nama:nama,tlp:tlp,kota:kota},
			   success:function(data){
			   $('#berhasil').html('<div class="alert alert-success"><strong>Berhasil!</strong> Data Customer Telah Diperbaharui</div>');

			   }
			  });
	 	}
 	});
	$('#item_price').keypress(function(event){
		if(event.which == 13){
	 	var id = $('#trans_id').val();
	 	var item_name = $('#first-disabled').val();
	 	var item_price = $('#item_price').val();

	 	if(item_name == 0 || item_price == 0 || item_price == ""){
		 	$('#sukses').html('<div class="alert alert-warning" role="alert">Pastikan Data Terisi</div>');
	 	}else {
	 	  $.ajax({
			   url:"http://localhost/laundry/manage/add_cust_item",
			   method:"POST",
			   data: {id:id,item_name:item_name,item_price:item_price},
			   success:function(data){
			   if(data == 0 ){
				   $('#sukses').html('<div class="alert alert-danger" role="alert">Error ! Item Yang Sama Telah Ditambahkan</div>');
			   }else {
				   $('#sukses').html('<div class="alert alert-success" role="alert">Item Ditambahkan</div>');
				   $('#first-disabled').val('0');
				   $('#item_price').val("");
			   }


			   }
			  });
		}
	}
 	});
 	$('#add_item').click(function(){
	 	var id = $('#trans_id').val();
	 	var item_name = $('#first-disabled').val();
	 	var item_price = $('#item_price').val();

	 	if(item_name == 0 || item_price == 0 || item_price == ""){
		 	$('#sukses').html('<div class="alert alert-warning" role="alert">Pastikan Data Terisi</div>');
	 	}else {
	 	  $.ajax({
			   url:"http://localhost/laundry/manage/add_cust_item",
			   method:"POST",
			   data: {id:id,item_name:item_name,item_price:item_price},
			   success:function(data){
			   if(data == 0 ){
				   $('#sukses').html('<div class="alert alert-danger" role="alert">Error ! Item Yang Sama Telah Ditambahkan</div>');
			   }else {
				   $('#sukses').html('<div class="alert alert-success" role="alert">Item Ditambahkan</div>');
				   $('#first-disabled').val('0');
				   $('#item_price').val("");
			   }


			   }
			  });
		}
 	});
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
$('#tampil_data').click(function(){
	$.ajax({
			url:"http://localhost/laundry/manage/show_customer",
			success:function(data){
				$('#tampilkan_data').html(data);
			}
		 });
});
 });

	</script>

<!-- Modal -->
<!-- Modal -->





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Item Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	      <div id="sukses"></div>



<div class="row">
  <div class="col-md-6">
	   <label>Nama Item</label>
	  <br>
				   <select id="first-disabled">

				</select>

  </div>
  <div class="col-md-6">
	  <label>Item Price</label>
<input type="number" class="form-control" id="item_price"></div>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <input type="button" class="btn btn-primary" id="add_item" value="Add Data Item">
      </div>
    </div>
  </div>
</div>

<hr/>
<div id="exTab1">
<ul  class="nav nav-pills">
			<li class="active">
				<a  href="#1a" data-toggle="tab">Edit Customer Data</a>
			</li>
				<li><a href="#2a" data-toggle="tab">Edit Customer Item</a>
			</li>
			</li>



		</ul>

			<div class="tab-content clearfix">
			  <div class="tab-pane active" id="1a">

					<div class="row">
					  <div class="col-md-4">
					    <label for="">Masukkan Nama Customer</label>
					    <input class="form-control" type="text" id="search_nama">
					  </div>

					</div>


					<div id="result"></div>

					<script>
					$(document).ready(function(){
					  $('#search_nama').keyup(function(){
					    var nama = $(this).val();
					    $.ajax({
					     url:"http://localhost/laundry/manage/get_data_customer",
					     method:"POST",
					     data:{id_cust:nama},
					     success:function(data){
					      $('#result').html(data);

					     }
					     });
					  });
					});

					</script>

				</div>
				<div class="tab-pane" id="2a">
					<div id="berhasil"></div>
					<label>Masukkan Nama Customer</label>

					<div class="row">
					  <div class="col-md-4"><input type="text" id="trans_nama" class="form-control">
					<input type="text" id="trans_id" class="form-control" disabled="true" style="display: none;"></div>
					  <div class="col-md-4"></div>
					</div>
					<hr>
					<button id="get_data_table" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i></button>

					<!-- Button trigger modal -->
					<button style="display: none;" type="button" class="btn btn-primary" id="add_item_modal" data-toggle="modal" data-target="#exampleModal">
					  Tambah Data
					</button>
					<hr>

					<div id="show_table"></div>
				</div>

			</div>
  </div>
