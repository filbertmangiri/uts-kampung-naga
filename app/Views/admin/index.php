<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container">
	<div class="row">
		<div class="col">
			<button class="btn btn-primary mb-5" onclick="window.location.href = '<?= base_url('admin/insert'); ?>'">Tambah Artikel</button>
			<table id="articlesTable" class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Judul</th>
						<th>Kategori</th>
						<th>Penulis</th>
						<th>Tanggal Publikasi</th>
						<th>Thumbnail</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($articles as $key) : ?>
						<tr>
							<td><?= $key['id']; ?></td>
							<td><?= $key['title']; ?></td>
							<td><?= $key['category']; ?></td>
							<td><?= $key['author']; ?></td>
							<td><?= $key['created_at']; ?></td>
							<td>
								<img src="<?= base_url('images/thumbnails/' . $key['thumbnail']); ?>" alt="<?= $key['title_slug']; ?>" class="img-fluid">
							</td>
							<td>
								<a href="<?= base_url('admin/edit/' . $key['id']); ?>"><i class="fas fa-edit"></i></a>
								<a onclick="articleDelete(<?= $key['id']; ?>);"><i class="fas fa-trash"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('modals'); ?>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteModalLabel">Hapus Artikel</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Apakah anda yakin ingin menghapus artikel dengan judul : <br>
				<div id="articleTitle"></div>
			</div>
			<div class="modal-footer">
				<form id="deleteForm">
					<button type="submit" class="btn btn-danger">Hapus</button>
				</form>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#deleteModal').modal('hide');

		$('#articlesTable').DataTable();
	});

	function articleDelete(id) {
		$('#deleteForm').attr('onsubmit', '_articleDelete(' + id + ')');
		$('#deleteModal').modal('show');
	}

	function _articleDelete(id) {
		if (id < 1) return;

		$.ajax({
			url: '<?= base_url('admin/delete') ?>',
			type: 'post',
			data: {
				'articleID': id
			}
		});

		$('#deleteModal').modal('hide');
	}
</script>
<?= $this->endSection(); ?>