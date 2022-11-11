<div class="row">
  <?php foreach ($data as $key) { ?>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3><?= $key->nama ?></h3>
        </div>
        <div class="icon">
          <i class="fa fa-fw fa-barcode"></i>
        </div>
        <a href="<?= base_url() ?>/dashboard/inputso?toko=<?= $key->id ?>" class="small-box-footer">INPUT SO <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  <?php } ?>
</div>
<!-- /.row -->