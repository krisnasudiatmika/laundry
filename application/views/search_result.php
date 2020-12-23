<script>

	function nWin() {
	var tgl_masuk = $('#tgl_masuk').val();
    var tgl_selesai = $('#tgl_selesai').val();
    var total = $('#total_price_filter').val().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    var nama = $('#trans_nama').val();
    var alamat = $('#trans_alamat').val();
  var w = window.open();
  var css = '<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/lebar.css');?>">';

$('#invoice').append('INVOICE<br>');

var total_print = $('#table_item').append('<tr class="hide_one" style="margin-top: 20px;"><td class="grand_size"><b>GRAND TOTAL </b></td><td></td><td></td><td class="grand_size right"><b>'+total + '</b></td></tr>');
$('body').attr('onload','window.print()');
var nota = $("#item_print").html();
var total_cetak = $('#grand_total').html();
var tanggal_print = $('#print_tanggal').html();
var nama_print = $('#trans_nama').html();
var alamat_print = $('#trans_alamat').html();
var top = '<div class="tempat_logo"><div class="logo"><img src="<?php echo base_url('theme/image/ss.png');?>"></div><div class="text"><span class="jn_enter">JAYANATA LAUNDRY<span><span class="jn_enter">Jl. Kayu Aya, Gg. Lebah No.5</span><span class="jn_enter">Oberoi - Kuta</span></div></div><div class="tempat_logo right">INVOICE<span class="jn_enter">'+nama + " "+ alamat+'</span><span class="jn_enter">Periode '+tgl_masuk+ ' s/d '+ tgl_selesai+'</span></div>';
     $(w.document.body).html(css+ top +   nota + total_cetak);

     $('#invoice').empty();
      $('#print_tanggal').empty();
       $('#nama_cust').empty();
        $('#alamat_cust').empty();
        $('.hide_one').empty();
}
	$(document).ready(function(){
		$('#cetak').click(function(){
			var calculate = $('#total_price_filter').val();
			if (calculate == 0 || calculate == ""){
				alert("Pastikan menekan Tombol Calculate");
			}else {
				nWin();
			location.reload(true);
			}


		});
	})	;
	 $( function() {
	 	$( ".tanggal" ).datepicker({dateFormat: 'dd-mm-yy'});
		$('.sub_comma,.jml_comma').each(function(){
	    $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
	  });
  } );

	</script>
<div id="item_print">
<table class="table" id="table_item">
		  <thead>
		    <tr class="border_bawah">
			  <th scope="col" class="kiri">NOMOR NOTA</th>
		      <th scope="col" class="action">NAMA</th>
		      <th scope="col">TGL MASUK</th>
		      <th scope="col">REMARKS</th>
		      <th scope="col" class="action">SUB TOTAL</th>
		      <th scope="col" class="right">JUMLAH</th>
					<th scope="col" class="right"></th>
		      <th scope="col" class="action">Action</th>
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
			   url:"http://localhost/laundry/manage/save_tanggal",
			   method:"POST",
			   data:{trans_id:id_transaksi,tgl_masuk:tgl_masuk},
			   success:function(data){
			    alert('Tanggal Telah Di Update');
			    location.reload(true);

			   }
			   });
 				});




				});

				</script>
			<?php
			?>
				<tr>

				<td ><?php echo($row->id_transaksi)?></td>
				<td class="action"><?php echo($row->nama)?></td>
				<td class="tengah"><?php echo($row->tanggal_masuk)?></td>
				<td class="tengah"><?php echo($row->catatan)?></td>
				<td class="action right jml_comma "><?php echo($row->sub_total)?></td>
				<td class="right sub_comma"><?php echo($row->grand_total)?></td>
				<td class="action right" style="visibility:hidden;"><?php echo($row->grand_total)?></td>

				</div>
				<td class="action"><button class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $row->id; ?>"><span class = "glyphicon glyphicon-pencil"></span> Edit</button>
				<button class="btn btn-danger delete" name="delete" id="<?php echo $row->id; ?>" data-id="<?php echo $row->id; ?>"><span class = "glyphicon glyphicon-trash"></span> Delete</button></td>
				</tr>
						<!-- Modal -->
<div class="modal fade action" id="edit<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
		<input class="form-control" id="id_transaksi<?php echo $row->id; ?>" type="text" value="<?php echo($row->id_transaksi);?>" style="display:none;">





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save_manage<?php echo $row->id; ?>">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(document).ready(function(){
		$('#<?php echo $row->id; ?>').click(function(){
			if(confirm('Anda Yakin Menghapus Data ? ')){
			var id = $(this).data('id');
			console.log(id);
			var transaksi = $('#id_transaksi'+id).val();
			$.ajax({
			 url:"http://localhost/laundry/manage/hapus_trx",
			 method:"POST",
			 data:{nota:transaksi},
			 success:function(data){
				alert('Transaksi Berhasil Dihapus');
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







		<div id="grand_total"></div>
