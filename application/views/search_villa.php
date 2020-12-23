
<script>
function nWin() {
  var w = window.open();
  var tgl_masuk = $('#tgl_masuk').val();
  var tgl_selesai = $('#tgl_selesai').val();
  var id_cust = $('#id_cust').val();
  var nama_cust = $('#nama_cust').val();
  var html = $("#toNewWindow").html();
  var lib = "<link rel='stylesheet' href='<?php echo base_url('theme/print/cetak.css');?>' />";
  var header = "<div class='header_top'>"+
  "<div class='logo'><img src='<?php echo base_url('theme/image/ss.png');?>' ></div>" +
  "<div class='laundry'>Jayanata Laundry<br>Jl. Kayu Aya, Gg. Lebah No.5<br>Oberoi - Kuta</div>" +
  "<div class='text_kanan'>INVOICE<br>"+nama_cust+"<br>PERIODE "+tgl_masuk+" S/D "+tgl_selesai+"</div></div>"
  var css = "<style type='text/css'>.hilang{display:none;}</style>"

    $(w.document.body).html(lib + css+ header + html);

}

$(function() {
    $("a#print").click(nWin);
});
</script>

<input type="hidden" id="tgl_masuk" value="<?php echo $tgl_masuk; ?>">
<input type="hidden" id="tgl_selesai" value="<?php echo $tgl_selesai; ?>">
<input type="hidden" id="id_cust" value="<?php echo $cari; ?>">
<input type="hidden" id="nama_cust" value="<?php echo $nama; ?>">
<div id="toNewWindow">
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="kiri">Nomor Nota</th>
      <th scope="col">Tanggal Masuk</th>
      <th scope="col">Catatan</th>
      <th scope="col" class="kanan">Grand Total</th>
      <th scope="col" class="hilang">Action</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result as $row) {
  // code...
?>

    <tr>
    <td class="kiri"><?php echo $row->id_transaksi; ?></td>
    <td><?php echo $row->tanggal_masuk; ?></td>
    <td><?php echo $row->catatan; ?></td>
    <td class="kanan"><?php echo number_format($row->grand_total); ?></td>
    <td class="hilang"><a href="<?php echo base_url('manage/edit_transaksi/'.$row->id); ?>"><button class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></a>
    <a href="<?php echo base_url('manage/hapus_transaksi/'.$row->id); ?>"><button onclick="javascript:return confirm('Anda Yakin Menghapus Transaksi?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></a></td>

    </tr>



<?php } ?>
<tr class="grand">
  <td class="kiri"><b>Grand Total<b></td>
  <td></td>
  <td></td>
  <td class="kanan"><b>Rp. <?php echo number_format($total_invoice); ?></b></td>
<tr>
</tbody>
</table>
</div>







<a href="javascript:;" id="print"><button class="btn btn-primary">Cetak</button></a>
