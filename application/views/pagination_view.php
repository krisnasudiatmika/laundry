<!doctype html>
<html>
    <head>
        <title>Demo for CodeIgniter Pagination :: Demo cho việc phân trang trong CodeIgniter</title>
        <meta charset="utf-8" />
        <style>
            td{
                text-align: center;
            }
            td{
                border-top: 1px solid #ccc;
            }
            table{
                margin: 1em;
            }
        </style>
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
    <script type="text/javascript">
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



  });
    </script>
    </head>
    <body>





        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nomor Nota</th>
              <th scope="col">Tanggal Masuk</th>
              <th scope="col">Sub Total</th>
              <th scope="col">Grand Total</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
        <?php

        // generate the table


        foreach ($datatable as $row) {
          // code...
          ?>

                <tr>
                  <td><?php echo $row['id_transaksi']; ?></td>
                  <td><?php echo $row['newdate']; ?></td>
                  <td><?php echo number_format($row['sub_total']); ?></td>
                  <td>Rp. <?php echo number_format($row['grand_total']); ?></td>
                  <td ><a href="<?php echo base_url('manage/edit_transaksi/'.$row['id']); ?>"><button class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></a>
                  <a href="<?php echo base_url('manage/hapus_transaksi/'.$row['id']); ?>"><button onclick="javascript:return confirm('Anda Yakin Menghapus Transaksi?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></a></td>
                </tr>
          <?php

        }
        ?>
      </tbody>
    </table>
        <?php
        // generate the page navigation

        echo $this->pagination->create_links();
        ?>
    </body>

    <script>
 $( function() {
   $( "#datepicker,#datepicker2" ).datepicker();
 } );
 </script>
</html>
