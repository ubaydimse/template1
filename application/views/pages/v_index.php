<body>	

	<div class="container-fluid">
	
		<div class="row">
			<div class="col-md-12">
				<h4 class="blockmaroon" style="margin-top:-1%">
					Testing Batch Insert
				</h4>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">
				<b>*Nama</b>
				<input placeholder="masukkan nama" id="nama" class="form-control" type="text"><br>
				<b>*Kelas</b>
				<input placeholder="masukkan kelas" id="kelas" class="form-control" type="text"><br>
				<b>*NPM</b>
				<input placeholder="masukkan npm" id="npm" class="form-control" type="text"><br>
				<hr>
				<button class="btn btn-danger" onclick="removeList()">Hapus List</button>
				<button class="btn btn-info" onclick="addToList()">Tambah Ke List</button>
			</div>
			
			<div class="col-md-8">
				<form id="formMhs" name="formMhs" action="<?= base_url('user/testing/insert_all') ?>" method="post">
					<div id="viewlist"></div>
					<div id="viewjams"></div>
				</form>
			</div>
		</div>
		
	</div>

	<script type="text/javascript">
	
		$(document).ready(function(){
			jams();
		});

		var listMhs = [];
		
		function viewList()
		{
			var tmp = ''; $('#viewlist').html(null)
			if(listMhs.length > 0)
			{
				tmp += '<h2>List Sementara</h2><table class="table table-bordered table-responsive"><thead><tr><th>Nama</th><th>Kelas</th><th>NPM</th></tr></thead><tbody>';
				for(var i=0; i<listMhs.length; i++)
				{
					tmp += '<tr>';
						tmp += '<td><input type="text" class="form-control" name="nama[]" value="'+listMhs[i].nama+'" readonly></td>';
						tmp += '<td><input type="text" class="form-control" name="kelas[]" value="'+listMhs[i].kelas+'" readonly></td>';
						tmp += '<td><input type="text" class="form-control" name="npm[]" value="'+listMhs[i].npm+'" readonly></td>';
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
				$('#npm').val().length === 0
			)
			{
				alert('Semua field wajib diisi! \nTambah list dibatalkan.'); return false;
			}
			var mhs = {
				'nama' : $('#nama').val(),
				'kelas' : $('#kelas').val(),
				'npm' : $('#npm').val()
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
		
		function jams()
		{
			var tmp=''; var aDay = 86400; // 24H
			var halfH = 1800; // 0.5H
			
			tmp += '<select class="form-control jams" id="jams" name="jams[]">' 
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

</body>	