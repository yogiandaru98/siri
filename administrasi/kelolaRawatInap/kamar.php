<?php
		include("../../db/func.php");

		$pdo = pdo_connect_mysql();
		// session_start();
		$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

		$records_per_page = 999999999;



		$stmt = $pdo->prepare('SELECT * FROM kamar ORDER BY status LIMIT :current_page, :record_per_page');
		$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
		$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
		$stmt->execute();

		$kamars = $stmt->fetchAll(PDO::FETCH_ASSOC);



		$num_kamars = $pdo->query('SELECT COUNT(*) FROM kamar')->fetchColumn();
		?>

		<div class="content read">
			<h2>Data Kamar</h2>
			<table>
				<thead>
					<tr>
						<td>NO KAMAR</td>
						<td>KELAS</td>
						<td>HARGA</td>
						<td>KETERSEDIAAN</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($kamars as $kamar) : ?>
						<tr>
							<td><?= $kamar['no_kamar'] ?></td>
							<td><?= $kamar['kelas_kamar'] ?></td>
							<td><?= rupiah($kamar['harga_kamar']) ?></td>
							<td><?= $kamar['status'] ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="pagination">
				<?php if ($page > 1) : ?>
					<a href="read.php?page=<?= $page - 1 ?>"> <i class="fas fa-angle-double-left fa-sm"></i></a>
				<?php endif; ?>
				<?php if ($page * $records_per_page < $num_kamars) : ?>
					<a href="read.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
				<?php endif; ?>
			</div>
		</div>