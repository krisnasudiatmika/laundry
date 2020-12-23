<script>
$(function(){
  $('.text_comma').each(function(){
    $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
  });
});
</script>

<table id="table_he" class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td class="text_comma">2000</td>
      <td>4000</td>
      <td>4000</td>
    </tr>

  </tbody>
</table>
