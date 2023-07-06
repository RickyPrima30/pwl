<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
if(session()->getFlashData('success')){
?> 
<div class="alert alert-info alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('success') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<?php
if(session()->getFlashData('failed')){
?> 
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('failed') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>

<!-- Table with stripped rows -->
<table class="table datatable">
<thead>
	<tr>
	<th scope="col">#</th>
	<th scope="col">Nama Customer</th>
    <th scope="col">Alamat</th>
    <th scope="col">Ongkir</th>
	<th scope="col">Total Harga</th> 
	<th scope="col">Tanggal Order</th> 
	<th scope="col">Status</th>
	<th scope="col">Aksi</th> 
	</tr>
</thead>
<tbody>
	<?php foreach($transaksis as $index=>$transaksi): ?>
	<tr>
	<th scope="row"><?php echo $index+1?></th>
	<td><?php echo $transaksi['username'] ?></td> 
	<td><?php echo $transaksi['alamat'] ?></td> 
	<td><?php echo $transaksi['ongkir'] ?></td> 
	<td><?php echo $transaksi['total_harga'] ?></td> 
	<td><?php echo $transaksi['created_date'] ?></td> 
	<td>
		<?php if($transaksi['status']==0) {echo "diproses";} 
	else if($transaksi['status']==1){echo "dikirim";}
	else if($transaksi['status']==2){echo "selesai";}
	?>

</td> 
	<td>
		<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $transaksi['id'] ?>">
			Ubah
		</button>
		<a href="<?= base_url('pesanan/delete/'.$transaksi['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
			Hapus
		</a>
	</td>
	</tr>
	<!-- Edit Modal Begin -->
	<div class="modal fade" id="editModal-<?= $transaksi['id'] ?>" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url('pesanan/edit/'.$transaksi['id']) ?>" method="post" enctype="multipart/form-data">
			<?= csrf_field(); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="name">Username</label>
					<input type="text" name="username" class="form-control" id="username" value="<?= $transaksi['username'] ?>" placeholder="username" required>
				</div>
				<div class="form-group">
					<label for="name">Alamat</label>
					<input type="text" name="alamat" class="form-control" id="alamat" value="<?= $transaksi['alamat'] ?>" placeholder="alamat" required>
				</div>
				<div class="form-group">
					<label for="name">Ongkir</label>
					<input type="text" name="ongkir" class="form-control" id="ongkir" value="<?= $transaksi['ongkir'] ?>" placeholder="ongkir" required>
				</div>
				<div class="form-group">
					<label for="name">Total Harga</label>
					<input type="text" name="total_harga" class="form-control" id="total_harga" value="<?= $transaksi['total_harga'] ?>" placeholder="total harga" required>
				</div>
				<div class="form-group">
					<label for="name">Tanggal Order</label>
					<input type="text" name="created_date" class="form-control" id="created_date" value="<?= $transaksi['created_date'] ?>" placeholder="tanggal order" required>
				</div>
				<div class="form-grup">
					<label for="name">Status</label>
					<select name="status" id="status">
						<?php if($transaksi['status']==0):?>
						<option value="0" selected>Diproses</option>
						<option value="1" >Dikirim</option>
						<option value="2" >Selesai</option>
						<?php endif;
						if(($transaksi['status']==1)):?>
						<option value="0" >Diproses</option>
						<option value="1" selected>Dikirim</option>
						<option value="2" >Selesai</option>
						<?php endif;
						if(($transaksi['status']==2)):?>
						<option value="0" >Diproses</option>
						<option value="1" >Dikirim</option>
						<option value="2" elected>Selesai</option>
						<?php endif; ?>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
			</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal End -->
	<?php endforeach ?>   
</tbody>
</table>
<!-- End Table with stripped rows -->
<?= $this->endSection() ?>