<table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
					<th>No</th>
					<th>NIM</th>
					<th>Email</th>
					<th>Nama</th>
					<th>Username</th>
					<th>Telp</th>
                	<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
	
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM mahasiswa ORDER BY nim ASC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nim']; ?></td>
			<td><?php echo $r['email']; ?></td>
			<td><?php echo $r['nama']; ?></td>
			<td><?php echo $r['username']; ?></td>
			<td><?php echo $r['telp']; ?></td>
			<td><a class="btn teal modal-trigger" href="#mas_edit?nim=<?php echo $r['nim'] ?>">Edit</a> <a onclick="return confirm('Anda Yakin Ingin Menghapus Akun?')" class="btn red" href="index.php?p=mas_hapus&nim=<?php echo $r['nim'] ?>">Hapus</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="mas_edit?nim=<?php echo $r['nim'] ?>" class="modal">
          <div class="modal-content">
            <h4>Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nim">NIM</label>
					<input id="nim" type="number" name="nim" style="color: #000;" value="<?php echo $r['nim']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="email">Email</label>		
					<input id="email" type="text" name="email" style="color: #000;" value="<?php echo $r['email']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input id="nama" type="text" name="nama" style="color: #000;" value="<?php echo $r['nama']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" style="color: #000;" value="<?php echo $r['username']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp" style="color: #000;" value="<?php echo $r['telp']; ?>">
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					$update=mysqli_query($koneksi,"UPDATE mahasiswa SET nim='".$_POST['nim']."',email='".$_POST['email']."',nama='".$_POST['nama']."',username='".$_POST['username']."',telp='".$_POST['telp']."' WHERE nim='".$_POST['nim']."' ");
					if($update){
						echo "<script>alert('Data Berhasil di Update')</script>";
						echo "<script>location='index.php?p=mas'</script>";
						echo "<script>location.reload()</script>";
					}
				}
			?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        
