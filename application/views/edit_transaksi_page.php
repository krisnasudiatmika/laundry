<form method="post" action="<?php echo base_url('manage/simpan_edit_tgl'); ?>">
<?php

foreach ($query as $row) {
  // code...
?>
<div class="col-xs-6 col-md-4">

          <fieldset>
            <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                      <input class="form-control" size="16" type="text" value="<?php echo $row->newdate ?>" id="tgl_selesai" name="tanggal" readonly>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
          <input type="hidden" name="id" value="<?php echo $row->id ?>" /><br/>
          </fieldset>


</div>

<?php
}
?>



<div class="row">
<div class="col-md-6"><input type="submit" class="btn btn-primary" value="Simpan"></div>
</div>
</div>

</form>
