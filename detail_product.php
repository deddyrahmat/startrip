<?php
    $title = "Detail Product";
    require_once "_templates/header.php";

    $id=$_GET['id'];
    $data = query("SELECT produk_tb.id, produk_tb.name as name_product, importir_tb.name as name_importir, photo, qty, price FROM produk_tb INNER JOIN importir_tb ON produk_tb.importir_id=importir_tb.id WHERE produk_tb.id='$id'")[0];
?>

    <section id="main">
        <div class="container my-5">
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Product</li>
                        </ol>
                    </nav>
                    <div class="card shadow">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card shadow mb-4 border-left-primary">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="_assets/img/<?= $data['photo'] ?>" class="img-fluid shadow" alt="Photo">
                                            <h2 class="mt-3"><?= ucwords($data['name_product']) ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card shadow mb-4 border-bottom-primary">
                                    <div class="card-body">
                                        <div class="table-responsive mt-3">
                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Importir</th>
                                                        <th>QTY</th>
                                                        <th>Harga</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?= ucwords($data['name_importir']) ?></td>
                                                        <td><?= ucwords($data['qty']) ?></td>
                                                        <td>Rp. <?= ucwords($data['price']) ?></td>
                                                        <td>
                                                            <a href="edit_product.php?id=<?= $data['id'] ?>" class="btn btn-warning text-white">Edit</a>
                                                            <a href="?del&id=<?= $data['id'] ?>" class="btn btn-danger">Hapus</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="card-footer">
                            <a href="index.php" class="btn btn-warning text-white"> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
    require_once "_templates/footer.php";

    if (isset($_POST['save_importir'])) {
        $name_importir = htmlspecialchars( $_POST['name_importir']);
        $address = htmlspecialchars( $_POST['address']);
        $phone = htmlspecialchars( $_POST['phone']);

        $insert = mysqli_query($koneksi,"INSERT INTO importir_tb VALUES(NULL, '$name_importir','$address','$phone')");
        if($insert) { 
            echo '<script>
            alert("Data Berhasil Ditambah")
            window.location = "index.php";
            </script>';                     
        }
        else{
            echo '<script>
            alert("Data Gagal Diupload")
            window.location = "add_importir.php";
            </script>';  
        }
    }elseif (isset($_GET['del'])) {
        // hapus foto lama sebelum upload foto baru
        unlink("_assets/img/".$data['photo']);

        $delete=mysqli_query($koneksi,"DELETE FROM produk_tb WHERE id = '$id'");
        if($delete) { 
            echo '<script>
            alert("Data Berhasil Dihapus")
            window.location = "index.php";
            </script>';                     
        }
        else{
            echo '<script>
            alert("Data Gagal Dihapus")
            window.location = "detail_product.php?id='.$id.'";
            </script>';  
        }
    }
?>