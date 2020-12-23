<?php
  if(isset($msg)){ ?>
      <div class="alert alert-success"><?php echo $msg; ?></div>
  <?php }
 ?>
<div class="col-xs-6 col-md-4">
   <form method="get" action="" class="form-horizontal"  role="form">
          <fieldset>
            <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                      <input class="form-control" size="16" type="text" value="" id="tgl_masuk" name="tgl_masuk" readonly>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
          <input type="hidden" id="dtp_input2" value="" /><br/>
          </fieldset>

</div>
<div class="col-xs-6 col-md-4">

          <fieldset>
            <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                      <input class="form-control" size="16" type="text" value="" id="tgl_selesai" name="tgl_selesai" readonly>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
          <input type="hidden" id="dtp_input2" value="" /><br/>
          </fieldset>


</div>
<div class="col-xs-6 col-md-4">
  <div class="row">
<div class="col-md-6"><input class="form-control search-box" id="trans_nama" name="nama_vila" type="text" autocomplete="off" placeholder="Cari Nama Customer"  /><input type="text" name="cari" id="trans_id" style="display: none"><input type="text" id="trans_alamat" style="display: none"><input type="text" id="trans_tlp" style="display: none"></div>

<div class="col-md-6"><input type="submit" class="btn btn-primary" value="Cari"></div>
</div>
  </div>

</form>
