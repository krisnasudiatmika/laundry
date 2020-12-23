<script>
  $(document).ready(function(){

    $('#trans_btn').click(function(){
      var cust_id = $('#trans_id').val();
      $(location).attr('href','<?php echo base_url('/transaksi/search_trans_result/') ?>'+cust_id);
    });
  });
</script>


<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="">Masukkan Nomor Nota</label>
     <input type="text" id="trans_id" class="form-control">
    </div>
    <div class="form-group">
     <input type="submit" id="trans_btn" class="btn btn-primary" value="Cari">
    </div>
  </div>
  <div class="col-md-8"></div>

</div>
<div id="sukses"></div>
