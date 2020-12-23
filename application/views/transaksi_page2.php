
<style >
	.kredit {
		font-size: 12px;
	}
	</style>

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
	   var id = "";
	   var data_json ="";
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
        $('#trans_tel').val( ui.item.telepon );
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
  
   
    $(document).ready(function(){
	    
	    $('#select_cust').click(function() {
		    $('#trans_nama').attr('disabled', true);
		    
		       $.ajax({
			   url:"http://localhost/laundry/transaksi/get_data_member/",
			   method:"POST",
			   data:{id:id},
			   success:function(data){
			   data_json = jQuery.parseJSON(data);
			   console.log(data);
			   }
			  });

	    });
	    
	     $('#first-disabled').on('change', function() {
		    
		     var value = "";
		     var price ="";
			var select_data = $('#first-disabled').val();
			console.log(data_json);
			var as=$(data_json).filter(function (i,n){return n.id_item===select_data});
			if (as.length == 0){
				alert('Maaf Data Yang Anda Cari Tidak Ditemukan');
				$('#qty').attr('disabled',true);
			}else {
				$('#qty').removeAttr('disabled'); 
				for (var i=0;i<as.length;i++)
					{
					    value = as[i].item_name;
					    price = as[i].new_price;
					    
					}
				$('#select_val').val(value);
				$('#price_val').val(price);
			}
		});
    });

  $(document).ready(function(){
   $( "#tgl_masuk" ).datepicker({dateFormat:"yy-mm-dd"}).datepicker("setDate",new Date()); 
   $( "#tgl_selesai" ).datepicker({dateFormat:"dd MM yy"}).datepicker("setDate",new Date()); 
   var tgl_masuk = $('#tgl_masuk').val();
   var tgl_selesai = $('#tgl_selesai').val();
   $('#span_tglmasuk').html(tgl_selesai);
  

});
  
  
  </script>
    
  <script>
	 $(document).ready(function(){
		$("#table_item").on('click','.item_price',function(){
        $(this).parent().parent().remove();
        addDataTable();
        totalQty();
    });
		$('#add_data_table').click(function() {
			var item_name = $("#first-disabled").val();
			var nama_item = $('#select_val').val();
			var cust_price = $('#price_val').val();
			var qty = $('#qty').val();
			if(qty.length == '' || qty.length == 0){
			alert('pastikan Data terisi');	
			}else {
			if(!qty){
				qty = 1;
				} 
			var price = $('#price_val').val();
			var total = qty*price;
				$('#table_item').append("<tr>" + "<td class='item_name action'>" + item_name + "</td>" + "<td class=''>" + nama_item + "</td>" + "<td class='item_qty'>" + qty + "</td>" + "<td id='price_sum' class='item_price'>" + cust_price + "</td>" + "<td id='price_sum' class='item_price'>" + total + "</td>" +"<td class='action'> <button type='submit' class='btn btn-danger item_price' id='remove_data_table'><i class='glyphicon glyphicon-remove'></i></button></div></td>"+ "</tr>");
		$('#select_val').val('');
		$('#price_val').val('');
		$('#qty').val('');
			}
		
		
			
		}) ;
		
		
	 });
	  </script>

  <script>
	  
	  function addDataTable(){
		  
		var table = document.getElementById("table_item"), total = 0;
	  for(var i = 1; i < table.rows.length; i++){
		  total = total + parseInt(table.rows[i].cells[4].innerHTML);
	  }
	  $('#total_price').val(total);
	  $('#grand_total').val(total);
	  
	  }
	  function totalQty(){
		  
		var table = document.getElementById("table_item"), result = 0;
	  for(var i = 1; i < table.rows.length; i++){
		  result = result + parseInt(table.rows[i].cells[2].innerHTML);
	  }
	 $('#qty_total').val(result);

	  }
	  
	  
	  function grandTotal(){
		   
		  var tax = $('#trans_tax').val();
		  var spotting = $('#trans_spot').val();
		  var express = $('#trans_expres').val();
		  var total = $('#total_price').val();
		 
		 
		  
		  
		  var gt =((parseInt(tax) / 100) * parseInt(total))  + ((parseInt(spotting) / 100) * parseInt(total)) +((parseInt(express) / 100) * parseInt(total)) + parseInt(total);
		  $('#grand_total').val(gt);
		  
		  
	  }
	  $(document).ready(function(){
		
		  $(function(){
			 $('#trans_tax').val('0');
			  $('#trans_spot').val('0');
			  $('#trans_expres').val('0'); 
		  });
		  $('#trans_tax').keypress(function() {
			 totalQty();
			  grandTotal();
			  
			});  
		  $('#trans_spot').keypress(function() {
			  totalQty();
			  grandTotal();
			});  
		  $('#trans_expres').keypress(function() {
			  totalQty();
			  grandTotal();
			});  
		  $('#add_data_table').click(function() {
			 
			  addDataTable();
			  count = count + 1;
			  alert(count);
	  });	  

	  
		
		$('#save').click(function(){
			totalQty();

			var cust_id = $('#trans_id').val();
			var sub_total = $('#total_price').val(); 
			var tgl_masuk = $('#tgl_masuk').val(); 
			var grand_total = $('#grand_total').val(); 
			var catatan = $('#cust_cat').val(); 
			var no_nota = $('#no_nota').val();
			var qty = $('#qty_total').val();
			var trans_id = $('#trans_id').val();
			if (trans_id == "" || sub_total == 0){
				alert('Pastikan Seluruh Data Terisi');
			}else {
			 
			  $.ajax({
			   url:"http://localhost/laundry/transaksi/save_transaksi",
			   method:"POST",
			   data:{cust_id:cust_id,sub_total:sub_total,tgl_masuk:tgl_masuk,grand_total:grand_total,catatan:catatan,no_nota:no_nota,qty:qty},
			   success:function(data){
			    alert('Data Telah Di Tambahkan Database');
			   nWin();
			   location.reload(true);
			   }
			  });
			  }
 			});
 			
 		$('#regist_cust').click(function(){
			  var nama = $('#cust_nama').val();
			  var alamat = $('#cust_alamat').val();
			  var tlp = $('#cust_tlp').val();
			  var kota = $('#cust_kota').val();
	
			  $.ajax({
			   url:"http://localhost/laundry/transaksi/save_db",
			   method:"POST",
			   data:{nama:nama,alamat:alamat,telepon:tlp,kota:kota},
			   success:function(data){
			  var sukses = "<div class = 'alert alert-success'>sukses</div>";
			  $('.submit_cust').hide();
			  $('#sukses').html(sukses);
			  $('#myModal').modal('hide');
			  
			   }
			  });
 			});
 			
 		$(function(){
	 		  $.ajax({
			   url:"http://localhost/laundry/transaksi/get_no_nota",
			   
			   success:function(data){
				 var nota = data.trim();
			  $('#no_nota').val(nota);
			    
			  $('#no_nota2').html(nota);
			  
			   }
			  });
			 
			 
 		});
 		
 		
 		$('#cetak').click(function(){
	var express = document.getElementById('trans_expres').value;
	var spot = document.getElementById('trans_spot').value;
	var tax = document.getElementById('trans_tax').value;
	var prtContent = document.getElementById('data-item');
	var nota = document.getElementById('no_nota').value;
	var grandTotal = document.getElementById('grand_total').value;
	var tanggal = document.getElementById('tgl_selesai').value;
	var customer = document.getElementById('trans_nama').value;
	var cat = document.getElementById('cust_cat').value;
	var subTotal = document.getElementById('total_price').value;
	var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
     WinPrint.document.write('<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/print.css');?>">');
  	// To keep styling
    /*var file = WinPrint.document.createElement("link");
    file.setAttribute("rel", "stylesheet");
    file.setAttribute("type", "text/css");
    file.setAttribute("href", 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    WinPrint.document.head.appendChild(file);*/
	
   WinPrint.document.write('Nomor Nota \t: ');
   WinPrint.document.write(nota) ;
   WinPrint.document.write("<br>");
   WinPrint.document.write('Tanggal Terima \t: ');
   WinPrint.document.write(tanggal);
   WinPrint.document.write("<br>");
   WinPrint.document.write('Nama Customer \t:');
   WinPrint.document.write(customer);
   WinPrint.document.write("<br>");
    WinPrint.document.write("<br>");
     WinPrint.document.write("<br>");
      WinPrint.document.write("<br>");
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.write("<br>");
    WinPrint.document.write("Sub-Total : ");
    WinPrint.document.write(subTotal);
    WinPrint.document.write("<br>");
     WinPrint.document.write("Tax : ");
    WinPrint.document.write(tax);
     WinPrint.document.write("%");
    WinPrint.document.write("<br>");
     WinPrint.document.write("Spotting : ");
    WinPrint.document.write(spot);
     WinPrint.document.write("%");
    WinPrint.document.write("<br>");
     WinPrint.document.write("Express : ");
    WinPrint.document.write(express);
     WinPrint.document.write("%");
    WinPrint.document.write("<br>");
     WinPrint.document.write("Grand-Total : ");
    WinPrint.document.write(grandTotal);
    WinPrint.document.write("<br>");
     WinPrint.document.write('Remark : ');
   WinPrint.document.write(cat) ;
   
    
    WinPrint.document.write("<br>");
    WinPrint.document.close();
    WinPrint.setTimeout(function(){
      WinPrint.focus();
      WinPrint.print();
      
    }, 1000);
 		});
 		
 		
	 		function nWin() {
var tgl = $('#tgl_masuk').val();
var no_nota = $('#no_nota').val();
var nama = $('#trans_nama').val();
var sub_total = $('#total_price').val();
var grand_total = $('#grand_total').val();
var catatan = $('#cust_cat').val();
var tax = $('#trans_tax').val();
var spot = $('#trans_spot').val();
var expres = $('#trans_expres').val();
var alamat = $('#trans_alamat').val();
  var w = window.open();
  var css = '<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/print.css');?>">';
  var header = '<table class="table_header"><tr><td>Nomor Nota</td><td>:'+no_nota+'</td></tr><tr><td>Tanggal Terima</td><td>: '+tgl+'</td></tr><tr><td>Customer</td><td>: '+nama+'</td></tr><tr><td></td><td>'+alamat+'</td></tr></table><br>';
  var large = '<tr><td></td><td></td><td><b>Sub Total</b></td><td><b>'+sub_total+'</b></td></tr>'; 
  var grand_total = '<tr><td></td><td></td><td><b>Grand Total</b></td><td><b>'+grand_total+'</b></td></tr>';

  var footer = '<br><div class="text_kecil">Penerima</div> <br><br><br>';
  var remark = '<div class="text_kecil">Remark : </div>'+catatan+'';
  var tax_text = '<tr><td></td><td></td><td><b>Tax</b></td><td><b>'+tax+'%</b></td></tr>';
  var spot_text = '<tr><td></td><td></td><td><b>Spotting</b></td><td><b>'+spot+'%</b></td></tr>';
  var expres_text = '<tr><td></td><td></td><td><b>Express</b></td><td><b>'+expres+'%</b></td></tr>';
 
  
  $("#toNewWindow").append(css);
  $("#toNewWindow").append(header);
  
  
  
  $('#footer_nota').append(footer);
  $('#remark').append(remark);
  var nota = $("#toNewWindow").html();

   
    $('#table_item').append(large);
      
  var footer_print = $("#footer_nota").html();
    var remark_print = $("#remark").html();
    if(tax > 0){
	    $('#table_item').append(tax_text);
    } 
    if (spot > 0){
	     $('#table_item').append(spot_text);
    } 
     if (expres > 0){
	     $('#table_item').append(expres_text);
    } 
  
     $('#table_item').append(grand_total);
    var html = $("#data-item").html();
     $(w.document.body).html(nota + html  + footer_print +  remark);
    
     
     
}

$(function() {

$('#first-disabled').empty();
        $('#first-disabled').append($('<option>').text("Select"));
		 $.ajax({
			   url:"http://localhost/laundry/manage/get_item_id",
			   success:function(data){
			   
			    json_data = jQuery.parseJSON(data);
			    console.log(json_data);
			    
			     $.each(json_data,function(index,json){
				     $('#first-disabled').append($("<option></option>").attr("value", json.id_item).text(json.item_name));
				    }); 
			 
			   }
			  });
});


});
 		
 	
	  </script>
</head>
<body>
	<div id="toNewWindow"></div>
	<div id="footer_nota"></div>
	<div id="remark"></div>
	
    



	
	<div class="row">
  <div class="col-xs-6">
  <h2>Nomor Invoice</h2><input type="hidden" id="no_nota" class="form-control"  disabled="true">
  <label id="no_nota2"></label>
  </div>
  <div class="col-xs-6">
  <h2>Tanggal</h2>
	  <label style="font-size: 18px" id="span_tglmasuk"></label>
  </div>
</div>
	
<hr/>
	<div class="row">
	  <div class="col-md-4">
		 	<input type="text" class="form-control" id="trans_nama" aria-describedby="emailHelp" placeholder="Nama Customer" name='trans_nama'>
		    <input type="hidden" id="select_val" >
		    <input type="number" id="price_val" style="display: none">
	  </div>
	  <div class="col-md-4"><button class="btn btn-primary" type="submit" id="select_cust"><i class="glyphicon glyphicon-search"></i></button></div>
	 
	</div>
	<hr/>
	<div class="row">
		  <div class="col-md-3">
				
				   <select id="first-disabled" class="selectpicker" data-hide-disabled="true" data-live-search="true">
				    <option value="0" selected>Pilih Item</option>
				   
				</select>
				
		  </div>
		  <div class="col-md-1">
			  	<input type="number" class="form-control" id="qty" aria-describedby="emailHelp" placeholder="Qty" name='qty' disabled>
		  </div>
		  <div class="col-md-4"><button type="submit" class="btn btn-primary" id="add_data_table">Add</button></div>
	</div>

	 
	
<div class="row">
  <div class="col-xs-6 col-md-4">
	   	<div class="form-group">
		    
		    <input id="trans_alamat" type="hidden">
		    <input id="trans_id" type="hidden">
		    <input  id="trans_tel" type="hidden">
    	</div>
  </div>
  
  <div class="col-xs-6 col-md-4"></div>

 <hr/>
 
 <div class="container">
	<div id="data-item">
  <table class="table" id="table_item">
  <thead>
    <tr>
     <th scope="col" class="action">Kode Item</th>
      <th scope="col">Nama Item</th>
      <th scope="col">QTY</th>
       <th scope="col">Price</th>
      <th scope="col">Total</th>
      <th scope="col" class="action">Action</th>
      <div id="print_grand_total"></div>
    </tr>
  </thead>
  
  <tbody>
  
  </tbody>
</table>
</div>
	
 </div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-4">
		    <input type="hidden" id="tgl_masuk" class="form-control"> 
  </div>
  <div class="col-xs-6 col-md-1">
	  <input type="hidden" id="tgl_selesai" class="form-control">
  </div>
  <div class="col-xs-6 col-md-5 pull-right" style="width: 440px;">
	<label>Sub-Total</label>  <input type="number" class="form-control" id="total_price" disabled>
	  
  </div>
</div>
<hr>
   
    
<input type="text" id="qty_total" style="display: none">
<hr/>
<div class="row">
  <div class="col-xs-6"></div>
  <div class="col-xs-6">
	  <div class="row">
		  <div class="col-xs-6 col-md-3 pull-right">
			  <label for="price" class="kredit">Tax (%)</label>
    <input type="number" class="form-control" id="trans_tax" aria-describedby="emailHelp"  name='item_price' placeholder="0">
		  </div>
		  <div class="col-xs-6 col-md-3 pull-right">
			   <label for="price" class="kredit">Spotting (%)</label>
    <input type="number" class="form-control" id="trans_spot" aria-describedby="emailHelp"  name='item_price' placeholder="0">
		  </div>
		  <div class="col-xs-6 col-md-3 pull-right">
			   <label for="price" class="kredit">Express (%)</label>
    <input type="number" class="form-control" id="trans_expres" aria-describedby="emailHelp"  name='item_price' placeholder="0">
		  </div>
		</div>

  </div>
</div>
<hr/>

<div class="row">
  <div class="col-xs-6 col-md-4">
	   
    <input type="text" class="form-control" id="cust_cat" aria-describedby="emailHelp" placeholder="Catatan" name='cust_cat'>
  </div>
  <div class="col-xs-6 col-md-1"></div>
  <div class="col-xs-6 col-md-5 pull-right" style="width: 440px"><label>Grand Total</label>
	  <input type="number" class="form-control" id="grand_total" disabled> 
  </div>
</div>
<hr/>
<div class="row">
	 <div class="col-xs-6 col-md-4"><button type="button" id="save" class="btn btn-primary">Cetak Transaksi</button>
 


	  
	  
	
	  
	  




</body>
</html>