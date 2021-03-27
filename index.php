<?php
	//Koneksi Database
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "pwe";

	$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

	session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			//Data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE tmhs set
											 	kd_mkul = '$_POST[tkd_mkul]',
											 	nama_mkul = '$_POST[tnama_mkul]',
												kd_dosen = '$_POST[tkd_dosen]',
											 	jam = '$_POST[tjam]',
												ruang_kelas = '$_POST[truang_kelas]',
												jumlah_mhs = '$_POST[tjumlah_mhs]',
												tanggal_mulai = '$_POST[ttanggal_mulai]'
											 WHERE id_tmhs = '$_GET[id]'
										   ");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data suksess!');
						document.location='index.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!!');
						document.location='index.php';
				     </script>";
			}
		}
		else
		{
			//Data akan disimpan Baru
			$simpan = mysqli_query($koneksi, "INSERT INTO tmhs (kd_mkul, nama_mkul, kd_dosen, jam, ruang_kelas,jumlah_mhs,tanggal_mulai)
										  VALUES ('$_POST[tkd_mkul]', 
										  		 '$_POST[tnama_mkul]', 
										  		 '$_POST[tkd_dosen]', 
										  		 '$_POST[tjam]',
												 '$_POST[truang_kelas]',
												 '$_POST[tjumlah_mhs]',
												 '$_POST[ttanggal_mulai]'
												  )
										 ");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data suksess!');
						document.location='index.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='index.php';
				     </script>";
			}
		}


		
	}


	//Pengujian jika tombol Edit / Hapus di klik
	if(isset($_GET['hal']))
	{
		//Pengujian jika edit Data
		if($_GET['hal'] == "edit")
		{
			//Tampilkan Data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE id_tmhs = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$vkd_mkul = $data['kd_mkul'];
				$vnama_mkul = $data['nama_mkul'];
				$vkd_dosen = $data['kd_dosen'];
				$vjam = $data['jam'];
				$vruang_kelas = $data['ruang_kelas'];
				$vjumlah_mhs = $data['jumlah_mhs'];
				$vtanggal_mulai = $data['tanggal_mulai'];
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM tmhs WHERE id_tmhs = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='index.php';
				     </script>";
			}
		}
	}

?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv = "x-UA-Compatible" content="IE=edge, chrome=1">
    <meta name = "HandleFriendly" content = "true">
	<title>SISTEM INFORMASI AKADEMIK</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="css/datepicker.css">
</head>
<body>
<div class="container">

	<h1 class="text-center">SISTEM INFORMASI AKADEMIK</h1>
	

	<!-- Awal Card Form -->
	<div class="card mt-3">
	  <div class="card-header bg-primary text-white">
	    Form Input Jadwal Mata Kuliah
	  </div>
	  <div class="card-body">
	    <form method="post" action="">
	    	<div class="form-group">
	    		<label>Kode Matkul</label>
	    		<input type="text" name="tkd_mkul" value="<?=@$vkd_mkul?>" class="form-control" placeholder="Kode Matkul" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Mata Kuliah</label>
	    		<input type="text" name="tnama_mkul" value="<?=@$vnama_mkul?>" class="form-control" placeholder="Mata Kuliah" required>
	    	</div>
	    	<div class="form-group">
	    		<label>KD Dosen</label>
	    		<textarea class="form-control" name="tkd_dosen"  placeholder="DOsen"><?=@$vkd_dosen?></textarea>
	    	</div>
	    	<div class="form-group">
	    		<label>Jam</label>
	    		<textarea class="form-control" name="tjam"  placeholder="Jam"><?=@$vjam?></textarea>
	    	</div>
			<div class="form-group">
	    		<label>Ruang Kelas</label>
	    		<textarea class="form-control" name="truang_kelas"  placeholder="Ruang Kelas"><?=@$vruang_kelas?></textarea>
	    	</div>
			<div class="form-group">
	    		<label>Jumlah Mahasiswa</label>
	    		<textarea class="form-control" name="tjumlah_mhs"  placeholder="Input Jumlah Mahasiswa"><?=@$vjumlah_mhs?></textarea>
	    	</div>
			
			<div class="form-group">
	    		<label>Tanggal Mulai</label>
	    		<textarea type="text" class="form-control datepicker" name="ttanggal_mulai" require><?=@$vtanggal_mulai?></textarea>
	    	</div>

			
			<script type="text/javascript">
        	$(function(){
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            	});
        	});
    		</script>

	    	<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
	    	<button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>

	    </form>
	  </div>
	</div>
	<!-- Akhir Card Form -->

	<!-- Awal Card Tabel -->
	<div class="card mt-3">
	  <div class="card-header bg-success text-white">
	    Daftar Mata Kuliah
	  </div>
	  <div class="card-body">
	    
	    <table class="table table-bordered table-striped">
	    	<tr>
	    		<th>No.</th>
	    		<th>Kode Matkul</th>
	    		<th>Mata Kuliah</th>
	    		<th>KD Dosen</th>
	    		<th>Jam</th>
				<th>Ruang Kelas</th>
				<th>Jumlah Mahasiswa</th>
				<th>Tanggal Mulai</th>
	    		<th>Aksi</th>
	    	</tr>
	    	<?php
	    		$no = 1;
	    		$tampil = mysqli_query($koneksi, "SELECT * from tmhs order by id_tmhs desc");
	    		while($data = mysqli_fetch_array($tampil)) :

	    	?>
	    	<tr>
	    		<td><?=$no++;?></td>
	    		<td><?=$data['kd_mkul']?></td>
	    		<td><?=$data['nama_mkul']?></td>
	    		<td><?=$data['kd_dosen']?></td>
	    		<td><?=$data['jam']?></td>
				<td><?=$data['ruang_kelas']?></td>
				<td><?=$data['jumlah_mhs']?></td>
				<td><?=$data['tanggal_mulai']?></td>
	    		<td>
	    			<a href="index.php?hal=edit&id=<?=$data['id_tmhs']?>" class="btn btn-warning"> Update </a>
	    			<a href="index.php?hal=hapus&id=<?=$data['id_tmhs']?>" 
	    			   onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
	    		</td>
	    	</tr>
	    <?php endwhile; //penutup perulangan while ?>
	    </table>

	  </div>
	</div>
	<!-- Akhir Card Tabel -->
	
	<br />
	<center>
	<button type = "logout" class="btn btn-danger"><a style = "text-decoration:none; color:white;" href="logout.php"</a>Logout</button>
	</center>

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>