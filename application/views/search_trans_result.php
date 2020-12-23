<script>
var price_total = 0;
var totalsub ="";
var totalgrand ="";

function nWin() {
var tgl = $('#tgl_masuk').val();
var no_nota = $('#nomor_nota').val();
var nama = $('#trans_nama').val();
var sub_total = $('#total_sub').val().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ;
var grand_total = $('#total_grand').val().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ;
var catatan = $('#cust_cat').val();
var tax = $('#trans_tax').val();
var spot = $('#trans_spot').val();
var expres = $('#trans_expres').val();
var alamat = $('#trans_alamat').val();
var w = window.open();

var css = '<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/print.css');?>">';
var header = '<div class="table_header"><hr><br><table class="table_atas"><tr><td>NOMOR NOTA</td><td>: '+no_nota+'</td></tr><tr><td>TGL TERIMA</td><td>: '+tgl+'</td></tr><tr><td>CUSTOMER</td><td>: '+nama+'</td></tr><tr><td></td><td>'+alamat+'</td></tr></table></div><br>';
var large = '<tr class="hide_one"><td></td><td></td><td><b>SUB TOTAL</b></td><td class="right"><b>'+sub_total+'</b></td></tr>';
$('#table_item').append(large);
var grand_total = '<tr class="hide_one"><td></td><td></td><td><b>GRAND TOTAL</b></td><td  class="right"><b>'+grand_total+'</b></td></tr>';

var footer = '<br><div class="text_penerima">PENERIMA</div> <br><br><br>';
var remark = '<div class="text_kecil">REMARKS : '+catatan+'</div>';
var tax_text = '<tr><td></td><td></td><td><b>TAX</b></td><td class="right"><b>'+tax+'%</b></td></tr>';
var spot_text = '<tr><td></td><td></td><td><b>SPOTTING</b></td><td  class="right"><b>'+spot+'%</b></td></tr>';
var expres_text = '<tr><td></td><td></td><td><b>EXPRESS</b></td><td  class="right"><b>'+expres+'%</b></td></tr>';

if(tax > 0){
  $('#table_item').append(tax_text);
}
if (spot > 0){
   $('#table_item').append(spot_text);
}
 if (expres > 0){
   $('#table_item').append(expres_text);
}
$('#footer_nota').append(footer);
$('#remark').append(remark);
var footer_print = $('#footer_nota').html();
var remark_print = $('#remark').html();
$('#table_item').append(grand_total);
table_body = $('#data-item').html();
$(w.document.body).html(css + header + table_body + footer_print + remark_print);

}

</script>

<?php
$customer = "";
$id_trans ="";
$tgl="";
$alamat="";
$remark="";
$sub_total = "";
$grand_total = "";
foreach ($query->result() as $row ) {
  // code...
  $customer = $row->nama;
  $id_trans = $row->id_transaksi;
  $tgl = $row->tanggal_masuk;
  $alamat = $row->alamat;
  $remark = $row->catatan;
  $sub_total = $row->sub_total;
  $grand_total = $row->grand_total;
  $id_customer = $row->id_customer;
  $expres = $row->express;
  $spotting = $row->spotting;
  $tax = $row->tax;


}


 ?>




<div class="row">
 <div class="col-md-6">
   <div class="row">
     <div class="col-md-6">
       <div class="form-group">
       <label for="">Nomor Nota</label>
       <input type="text" id="nomor_nota" class="form-control" value="<?php echo $id_trans; ?>" disabled>
        <label for="">Nama</label>
        <input type="text" id="trans_nama" class="form-control" value="<?php echo $customer; ?>" disabled>
        <label for="">Id Customer</label>
        <input type="text" id="cust_id" class="form-control" value="<?php echo $id_customer; ?>" disabled>
        <label for="">Tanggal</label>
        <input type="text" id="tgl_masuk" class="form-control" value="<?php echo $tgl; ?>" disabled>
        <label for="">Alamat</label>
        <input type="text" id="trans_alamat" class="form-control" value="<?php echo $alamat; ?>" disabled>
        <label for="">Remark</label>
        <input type="text" id="cust_cat" class="form-control" value="<?php echo $remark; ?>" disabled>
        <label for="">Subtotal</label>
        <input type="text" id="total_sub" class="form-control" value="" disabled>
        <label for="">Tax</label>
        <input type="text" id="trans_tax" class="form-control" value="<?php echo $tax; ?>" disabled>
        <label for="">Express</label>
        <input type="text" id="trans_expres" class="form-control" value="<?php echo $expres; ?>" disabled>
        <label for="">Spotting</label>
        <input type="text" id="trans_spot" class="form-control" value="<?php echo $spotting; ?>" disabled>
        <label for="">Grand Total</label>
        <input type="text" id="total_grand" class="form-control" value="" disabled>
    </div>
  </div>

   </div>
</div>
 <div class="col-md-6">
  <div id="data-item">
   <table class="table" id="table_item">
  <thead>
    <tr class="hide_one">
      <th scope="col">ITEM BARANG</th>
      <th scope="col">QTY</th>
      <th scope="col" style="text-align: center;">HARGA</th>
      <th scope="col" class="right">JUMLAH</th>
      <th scope="col" class="action">ACTION</th>

    </tr>
  </thead>
  <tbody>
    <?php $number = 0; ?>
    <script>var semua=0;</script>
    <?php foreach ($query->result() as $row ) {
      ?>
      <script>

      $(function(){

        var item_id = $('#item_kode_val<?php echo $number ?>').val();
        var cust_id = $('#cust_id').val();
        var item_qty = $('#item_qty_val<?php echo $number ?>').val();
        $.ajax({
         url:"http://localhost/laundry/transaksi/get_new_price",
         method:"POST",
         data:{item_id:item_id,cust_id:cust_id},
         success:function(data){

        $('#harga_item<?php echo $number ?>').text(data);
          var harga_comma = $('#harga_item<?php echo $number ?>').text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
          $('#harga_item<?php echo $number ?>').text(harga_comma);
          var total = data * item_qty;
        $('#total_item<?php echo $number ?>').text(total);

        semua =semua + total;
        $('#total_sub').val(semua);

        totalsub = $('#total_sub').val();

        var tax = $('#trans_tax').val();
        var expres = $('#trans_expres').val();
        var spot = $('#trans_spot').val();
         var gt =((parseInt(tax) / 100) * parseInt(totalsub))  + ((parseInt(spot) / 100) * parseInt(totalsub)) +((parseInt(expres) / 100) * parseInt(totalsub)) + parseInt(totalsub);
         $('#total_grand').val(gt);
        totalgrand = $('#total_grand').val();
        var total_comma = $('#total_item<?php echo $number ?>').text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        $('#total_item<?php echo $number ?>').text(total_comma);


         }
         });
      });

      </script>
      <tr>

      <td><?php echo $row->item_name ?></td>
      <td><?php echo $row->item_qty ?></td>
      <td class="sub_comma tengah" style="text-align: center;"> <div class="sub_ss" id="harga_item<?php echo $number ?>"></div></td>
      <td class="right"><div  id="total_item<?php echo $number ?>"></div></td>
      <td class="action"><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $number ?>">Edit</button></td>
      </tr>
      <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade action" id="exampleModal<?php echo $number ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="">QTY</label>
        <input type="text" id="item_qty_val<?php echo $number ?>" class="form-control" value="<?php echo $row->item_qty ?>">
        <input type="text" id="item_kode_val<?php echo $number ?>" class="form-control" value="<?php echo $row->item_kode ?>" style="visibility: hidden">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save_item" data-id="<?php echo $number ?>">Save changes</button>
      </div>
    </div>
  </div>
</div>
      <?php
      $number = $number + 1;
    }
       ?>


  </tbody>
</table>
</div>
 </div>
</div>
<div class="form-group">
<button id="save" class="btn btn-primary">Simpan dan Cetak</button>
</div>

<div id="footer_nota"></div>
<div id="remark"></div>
<script>
$(document).ready(function(){

  $(document).on('click', '#save_item', function(){
    var id = $(this).data('id');
    var nota = $('#nomor_nota').val();
    var item_kode = $('#item_kode_val'+id).val();
    var item_qty = $('#item_qty_val'+id).val();
    var total_sub = $('#total_sub').val();
    console.log(item_kode);

    $.ajax({
     url:"http://localhost/laundry/manage/update_item_qty",
     method:"POST",
     data:{nota:nota,item_kode:item_kode,item_qty:item_qty},
     success:function(data){
      alert('QTY telah di Update');

      location.reload();


     }
     });

  });
});

$(function(){
  $('#save').click(function(){
    nWin();
    var nota = $('#nomor_nota').val();
    console.log(nota);
    console.log(totalsub);
    console.log(totalgrand);

    $.ajax({
     url:"http://localhost/laundry/manage/update_subtotal",
     method:"POST",
     data:{nota:nota,totalsub:totalsub,totalgrand:totalgrand},
     success:function(data){
       alert('sukses');
     }
     });
    location.reload(true);


  });

});

</script>
