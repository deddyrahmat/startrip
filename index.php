<?php
    $title = "Home";
    require_once "_templates/header.php";
?>
    <section id="nav-bar">
        <!-- navbar -->
        <div class="container">
            <nav class="row navbar navbar-expand-lg navbar-light bg-white">
                <a href="#" class="navbar-brand">
                    <span class="font-weight-bold">StarTrip</span>
                </a>
                <button class="navbar-toggler navbar-toggler-right" data-target="#navb" type="button" data-toggle="collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navb">
                    <ul class="navbar-nav ml-auto mr-3 my-1">
                        <li class="nav-item mx-md-2">
                            <a href="importir.php" class="nav-link btn btn-info text-white">Importir</a>
                        </li>
                        <li class="nav-item mx-md-2">
                            <a href="add_product.php" class="nav-link  btn btn-success text-white">Add Product</a>
                        </li>
                    </ul>

                </div>

            </nav>
        </div>
    </section>

    <section id="content" class="mt-5 mb-5">
        <div class="container">
            <div class="row">
                <?php
                    $data = query("SELECT produk_tb.name as name_product, importir_tb.name as name_importir,photo, price, qty, produk_tb.id FROM produk_tb INNER JOIN importir_tb ON produk_tb.importir_id=importir_tb.id");
                    foreach ($data as $item) :
                ?>
                <div class="col-md-3 mt-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <img src="_assets/img/<?= $item['photo'] ?>" alt="Picture" class="img-fluid mb-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6 class="font-weight-bold"><?= $item['name_product'] ?></h6>
                                </div>
                                <div class="col-lg-6">
                                    <span class="font-weight-light text-muted float-right text-truncate"><?= $item['name_importir'] ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <span class="font-weight-bold text-danger">Rp. <?= $item['price'] ?></span>
                                </div>
                                <div class="col-md-4">
                                    <span class="font-weight-light text-muted">Stok <?= $item['qty'] ?></span>
                                </div>
                            </div>
                            <a href="detail_product.php?id=<?= $item['id'] ?>" class="btn btn-danger text-white btn-block mt-3">Detail</a>
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                ?>
            </div>
        </div>
    </section>

<?php
    require_once "_templates/footer.php";
?>