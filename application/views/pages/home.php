<section>
	<div class="container">

		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Contoh Insert Batch</h2>
				<hr>
			</div>
		</div>
	
		<div class="row">
			<div class="col-sm-4">
				<b>*Nama</b>
				<input placeholder="masukkan nama" id="nama" class="form-control" type="text"><br>
				<b>*Kelas</b>
				<input placeholder="masukkan kelas" id="kelas" class="form-control" type="text"><br>
				<b>*NPM</b>
				<input placeholder="masukkan npm" id="npm" class="form-control" type="text"><br>
				<b>*Jam Daftar</b>
				<div id="viewjams"></div>
				<hr>
				<div align="center">
					<button class="btn btn-danger" onclick="removeList()">Hapus List</button>
					<button class="btn btn-info" onclick="addToList()">Tambah Ke List</button>
				</div>
			</div>
			
			<div class="col-sm-8">
				<form id="formMhs" name="formMhs" action="<?= base_url('pages/testing/insert_all') ?>" method="post">
					<div id="viewlist"></div>
				</form>
			</div>
		</div>

	</div>
</section>

<script type="text/javascript">
	
		$(document).ready(function(){
			jam_daftar();
		});

		var listMhs = [];
		
		function viewList()
		{
			var tmp = ''; $('#viewlist').html(null)
			if(listMhs.length > 0)
			{
				tmp += '<h2>List Sementara</h2><table class="table table-bordered table-responsive">';
				tmp += '<thead><tr><th>Nama</th><th>Kelas</th><th>NPM</th><th>Jam Daftar</th></tr></thead><tbody>';
				for(var i=0; i<listMhs.length; i++)
				{
					tmp += '<tr>';
						tmp += '<td><input type="text" class="form-control" name="nama[]" value="'+listMhs[i].nama+'" readonly></td>';
						tmp += '<td><input type="text" class="form-control" name="kelas[]" value="'+listMhs[i].kelas+'" readonly></td>';
						tmp += '<td><input type="text" class="form-control" name="npm[]" value="'+listMhs[i].npm+'" readonly></td>';
						tmp += '<td><input type="text" class="form-control" name="jam_daftar[]" value="'+listMhs[i].jam_daftar+'" readonly></td>';
					tmp += '</tr>'
				}
				tmp += '</tbody></table><div align="center"><input type="submit" class="btn btn-success" value="Simpan list ke database"></div>';
				$('#viewlist').html(tmp);
			}
		}

		function addToList(event)
		{
			// validasi nama, npm, kelas.. bersifat required..
			if(	$('#nama').val().length === 0 ||
				$('#kelas').val().length === 0 ||
				$('#npm').val().length === 0 ||
				$('#jam_daftar').val().length === 0
			)
			{
				alert('Semua field wajib diisi! \nTambah list dibatalkan.'); return false;
			}
			var mhs = {
				'nama' : $('#nama').val(),
				'kelas' : $('#kelas').val(),
				'npm' : $('#npm').val(),
				'jam_daftar' : $('#jam_daftar').val()
			};
			listMhs.push(mhs); viewList();
		}
		
		function removeList()
		{
			listMhs = []; viewList();
		}
		
		function toHourMin(n)
		{
			var n = Number(n); var h = Math.floor(n/3600); var m = Math.floor(n%3600/60);
			var hRes = (h > 0 ? h+(h == 1 ? '':'') : '') < 10 ? '0'+h : h; 
			var mRes = (m > 0 ? m+(m == 1 ? '':'') : '') < 10 ? '0'+m : m;
			var res = (hRes + ':' + mRes).toString();
			res = res === '24:00' ? '00:00' : res;
			return res;
		}
		
		function jam_daftar()
		{
			var tmp=''; var aDay = 86400; // 24H
			var halfH = 1800; // 0.5H
			
			tmp += '<select class="form-control jam_daftar" id="jam_daftar" name="jam_daftar[]">' 
			for(var i=0, k=0; i<aDay; i+= halfH)
			{
				let a = toHourMin(i); let b = toHourMin(i+1800);
				let c = a + '&nbsp;&nbsp;' + b;
				tmp += '<option value="'+c+'">'+c+'</option>';
			}
			tmp += '</select>';
			$('#viewjams').html(null).html(tmp);
		}
						
</script>