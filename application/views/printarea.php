
<script>
	

		(function($) {
			// fungsi dijalankan setelah seluruh dokumen ditampilkan
			$(document).ready(function(e) {
				$('#cetak').click(function(){
					   var prtContent = document.getElementById(i);
    var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    
    WinPrint.document.write('<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');
    
  	// To keep styling
    /*var file = WinPrint.document.createElement("link");
    file.setAttribute("rel", "stylesheet");
    file.setAttribute("type", "text/css");
    file.setAttribute("href", 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    WinPrint.document.head.appendChild(file);*/

    
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.setTimeout(function(){
      WinPrint.focus();
      WinPrint.print();
      WinPrint.close();
    }, 1000);
				});
				// aksi ketika tombol cetak ditekan
				
			});
		}) (jQuery);
	</script>
	
	<body>

<div class="navbar navbar-static-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="http://umsida.ac.id"><div id="data-mahasiswa">Univ. Muhammadiyah Sidoarjo</div></a>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		
		
		<h3>
			Daftar Mahasiswa
			<button id="cetak" onclick="print_this('data-mahasiswa')" class="btn pull-right">Cetak</button>
		</h3>
		
	
		<!-- tampilkan ketika dalam mode print -->
		<div class="title">
			<center>
				DAFTAR MAHASISWA<br/>
				FAKULTAS TEKNIK<br/>
				UNIVERSITAS MUHAMMADIYAH SIDOARJO
			</center>
		</div>
		
		<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
			<thead>
			<tr>
				<th width="2%">#</th>
				<th width="12%">NIM</th>
				<th width="20%">Nama</th>
				<th>Alamat</th>
				<th width="12%">Kelas</th>
				<th width="12%">Status</th>
				<th width="9%" class="action"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1. </td>
				<td>08.10802.00234</td>
				<td>Ari Effendi</td>
				<td>Gedangan</td>
				<td>E Sore</td>
				<td>Aktif</td>
				<!-- sembunyikan ketika dalam mode print -->
				<td class="action">
					<a href="#" class="btn btn-mini">Ubah</a>
					<a href="#" class="btn btn-mini">Hapus</a>
				</td>
			</tr>
		</tbody>
		</table>		
		
		</div>
	</div>
</div>

</body>