<!-- Perubahan script coding untuk bisa menampilkan SID Home dalam bentuk tampilan bootstrap (AdminLTE)  -->
<div class="content-wrapper">
	<section class='content-header'>
		<h1>Tentang OpenSID</h1>
		<ol class='breadcrumb'>
			<li><a href='<?site_url()?>'><i class='fa fa-home'></i> Home</a></li>
			<li class='active'>Tentang OpenSID</li>
		</ol>
	</section>
	<section class='content' id="maincontent">
		<div class='row'>
			<div class='col-md-6'>
				<div class='box box-info'>
				 	<div class='box-body'>
						<div class="col-lg-6 col-xs-6">
							<div class="small-box bg-purple">
								<div class="inner">
									<?php foreach ($dusun as $data): ?>
										<h3><?=$data['jumlah']?></h3>
									<?php endforeach; ?>
									<p>Wilayah Dusun</p>
								</div>
								<div class="icon">
									<i class="ion ion-location"></i>
								</div>
								<a href="<?=site_url('sid_core')?>" class="small-box-footer">Lihat Detail  <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-xs-6">
							<div class="small-box bg-aqua">
								<div class="inner">
									<?php foreach ($penduduk as $data): ?>
										<h3><?=$data['jumlah']?></h3>
									<?php endforeach; ?>
									<p>Penduduk</p>
								</div>
								<div class="icon">
									<i class="ion ion-person"></i>
								</div>
								<a href="<?=site_url('penduduk/clear')?>" class="small-box-footer">Lihat Detail  <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-xs-6">
							<div class="small-box bg-green">
								<div class="inner">
									<?php foreach ($keluarga as $data): ?>
										<h3><?=$data['jumlah']?></h3>
									<?php endforeach; ?>
									<p>Keluarga</p>
								</div>
								<div class="icon">
									<i class="ion ion-ios-people"></i>
								</div>
								<a href="<?=site_url('keluarga/clear')?>" class="small-box-footer">Lihat Detail  <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-xs-6">
							<div class="small-box bg-gray">
								<div class="inner">
									<?php foreach ($rtm as $data): ?>
										<h3><?=$data['jumlah']?></h3>
									<?php endforeach; ?>
									<p>Rumah Tangga</p>
								</div>
								<div class="icon">
									<i class="ion ion-ios-home"></i>
								</div>
								<a href="<?=site_url('rtm/clear')?>" class="small-box-footer">Lihat Detail  <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-xs-6">
							<div class="small-box bg-yellow">
								<div class="inner">
									<?php foreach ($miskin as $data): ?>
										<h3><?=$data['jumlah']?></h3>
									<?php endforeach; ?>
									<p>Raskin</p>
								</div>
								<div class="icon">
									<i class="ion ion-ios-pie"></i>
								</div>
								<a href="<?=site_url()?>statistik/index/501" class="small-box-footer">Lihat Detail  <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-xs-6">
							<div class="small-box bg-red">
								<div class="inner">
									<?php foreach ($kelompok as $data): ?>
										<h3><?=$data['jumlah']?></h3>
									<?php endforeach; ?>
									<p>Kelompok</p>
								</div>
								<div class="icon">
									<i class="ion ion-android-people"></i>
								</div>
								<a href="<?=site_url('kelompok/clear')?>" class="small-box-footer">Lihat Detail  <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class='col-md-6'>
				<div class='box box-info'>
					<?php $this->load->view('home/about.php');?>
				</div>
			</div>
		</div>
	</section>
</div>



