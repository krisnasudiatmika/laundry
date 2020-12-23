<script>

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

    $( function() {
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

        id = $('#trans_id').val();



        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.nama + "<br>" + item.alamat + "</div>" )
        .appendTo( ul );
    };



  } );
	 $( function() {
    $( ".tanggal" ).datepicker();

  } );
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
 		$('#').click(function(){
			  var tgl_masuk = $('#update_tgl_masuk').val();
			  var tgl_selesai = $('#update_tgl_selesai').val();
			  var id = $('#update_id_customer').val();


			  $.ajax({
			   url:"http://localhost/laundry/manage/update_manage",
			   method:"POST",
			   data:{id_customer:id,tgl_masuk:tgl_masuk,tgl_selesai:tgl_selesai},
			   success:function(data){
			  alert('sukses');

			   }
			  });
 			});

	});
</script>
<script type="text/javascript">
	$(function ()
  {

    $.ajax({
      url: '<?php echo base_url('manage/all_result');?>',
      method:"POST",                  //the script to call to get data
                           //you can insert url argumnets here to pass to api.ph                              //for examp               //data format
      success: function(data)          //on recieve of reply
      {

       $('#result').html(data);
      }
    });
  });
$(document).ready(function(){

    $('#filter_btn').on("click", function(){

	    var nama = $('#trans_nama').val();
	    if(nama == "" || nama == 0){
		    alert('Pastikan Nama Tersedia Pada Kotak Pencarian');
	    }else {
	    $('#trans_nama').attr('disabled',true);
	    $('.tampil').removeAttr('style');
        var inputVal = $('.search-box').val();
        var tgl_masuk = $('#tgl_masuk').val();
        var tgl_selesai = $('#tgl_selesai').val();

        if(inputVal.length){
            $.get("<?php echo base_url('manage/filter_result');?>", {term: inputVal,tgl_masuk:tgl_masuk,tgl_selesai:tgl_selesai}).done(function(data){
                $('#result').html(data);
                $('#total_price_filter').val('');
            });
        } else{
            $.get("<?php echo base_url('manage/all_result');?>", {term: dropdown_status}).done(function(data){
                $('#result').html(data);
                $('#total_price_filter').val('');
            });
        }
        }
    });



});
</script>
</head>
<body>




<div id="container">

	<div class="row">
  <div class="col-xs-6 col-md-4">
	   <form action="" class="form-horizontal"  role="form">
		        <fieldset>
		        	<div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
		                    <input class="form-control" size="16" type="text" value="" id="tgl_masuk" readonly>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		                </div>
						<input type="hidden" id="dtp_input2" value="" /><br/>
		        </fieldset>
		    </form>
  </div>
  <div class="col-xs-6 col-md-4">
	   <form action="" class="form-horizontal"  role="form">
		        <fieldset>
		        	<div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
		                    <input class="form-control" size="16" type="text" value="" id="tgl_selesai" readonly>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		                </div>
						<input type="hidden" id="dtp_input2" value="" /><br/>
		        </fieldset>
		    </form>

  </div>
  <div class="col-xs-6 col-md-4">
	  <div class="row">
  <div class="col-md-6"><input class="form-control search-box" id="trans_nama" type="text" autocomplete="off" placeholder="Cari Nama Customer" /><input type="text" id="trans_id" style="display: none"><input type="text" id="trans_alamat" style="display: none"><input type="text" id="trans_tlp" style="display: none"></div>
	

	</div>
	<div class="col-md-6"><button id="filter_btn" class="btn btn-react btn-success">Filter</button></div>
</div>
	  </div>


</div>


	  <div id="result"></div>
<?php
	foreach ($result as $row){
		?>




		<?php

			?>





			<?php
	}


	?>


</div>


  <script>
	  function addDataTable(){

		var table = document.getElementById("table_item"), total = 0;
	  for(var i = 1; i < table.rows.length; i++){
		  total = total + parseInt(table.rows[i].cells[6].innerHTML);
	  }


	  $('#total_price_filter').val(total);
	  }

	  $(document).ready(function(){

		 $('#total_result').click(function() {

			  addDataTable();


	  });
});
	  </script>
<div class="row">

<div class="col-md-8 tampil" style="display: none"><button class="btn btn-primary" type="button" id="cetak" >Print</button> | <button class="btn btn-primary" type="button" id="total_result" >Calculate</button></div>
 <div class="col-md-4">
	 <label>Grand Total</label>
	 <input class="form-control" id="total_price_filter" type="text"></div>

</div>
