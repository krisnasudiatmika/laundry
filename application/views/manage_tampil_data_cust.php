<table class="table">
  <thead>
    <tr>
      <th scope="col">Id Customer</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
      <th scope="col">Telepon</th>
      <th scope="col">Kota</th>
    </tr>
  </thead>
  <tbody>
<?php

  foreach ($query->result() as $key) {
    // code...
  ?>
  <tr>
  <td><?php echo $key->id_customer ;?></td>
  <td><?php echo $key->nama ;?></td>
  <td><?php echo $key->alamat; ?></td>
  <td><?php echo $key->telepon; ?></td>
  <td><?php echo $key->kota; ?></td>
  </tr>

  <?php
  }
 ?>
</tbody>
</table>
