<?php
    $title = "Edit Product";
    require_once "_templates/header.php";
    $id = $_GET['id'];
    $item = query("SELECT * FROM produk_tb WHERE id = '$id'")[0];
?>

    <section id="main">
        <div class="container my-5">
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="detail_product.php?id=<?= $id ?>">Detail Produk</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                        </ol>
                    </nav>
                    <div class="card shadow">
                        <div class="card-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="name_product" class="col-sm-3 col-form-label">Name Product</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name_product" id="name_product" placeholder="Name Product" required autocomplete="off" value="<?= $item['name'] ?>" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="importir_id" class="col-sm-3 col-form-label">Name Importir</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="importir_id" id="importir_id" required autocomplete="off">
                                            <?php
                                                $data_importir = query('SELECT * FROM importir_tb');
                                                foreach ($data_importir as $data) :
                                            ?>
                                            <option value="<?= $data['id'] ?>" <?= $data['id']==$item['importir_id'] ? 'selected' : null ?> ><?= $data['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="photo" class="col-sm-3 col-form-label">Photo</label>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="photo">
                                            <label class="custom-file-label" for="customFile">Tentukan file</label>
                                        </div>
                                        <span class="text-info">* Maksimal Ukuran File 1 MB</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="qty" class="col-sm-3 col-form-label">QTY</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="qty" value="<?= $item['qty'] ?>" id="qty" placeholder="QTY" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price" class="col-sm-3 col-form-label">Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="price" id="price" value="<?= $item['price'] ?>" placeholder="Rp. " required autocomplete="off">
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right" name="edit_product"> Simpan</button>
                            <a href="detail_product.php?id=<?= $id ?>" class="btn btn-warning text-white"> Kembali</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

     // menambahkan script khusus untuk halaman ini saja
    $addscript = '
        <script>
        $(document).on("change", ".custom-file-input", function (event) {
            $(this).next(".custom-file-label").html(event.target.files[0].name);
            })    
        </script>
    ';

    require_once "_templates/footer.php";

    if (isset($_POST['edit_product'])) {
        $name_product = htmlspecialchars( $_POST['name_product']);
        $importir_id = htmlspecialchars( $_POST['importir_id']);
        $qty = htmlspecialchars( $_POST['qty']);
        $price = htmlspecialchars( $_POST['price']);

        if ($_FILES['photo']['name'] == '') {
            $update =mysqli_query($koneksi,"UPDATE produk_tb SET name='$name_product', importir_id='$importir_id',qty = '$qty',price = '$price' WHERE id = '$id'");
            if($update) { 
                echo '<script>
                alert("Data Berhasil Diperbarui")
                window.location = "detail_product.php?id='.$id.'";
                </script>';                     
            }
            else{
                echo '<script>
                alert("Data Gagal Diperbarui")
                window.location = "edit_product.php?id='.$id.'";
                </script>';  
            }
        }elseif ($_FILES['photo']['name'] != '') {
            $ekstensi  = ['png','jpeg','jpg'];
            $namaFile    = strtolower($_FILES['photo']['name']);
            $tipe   = pathinfo($namaFile, PATHINFO_EXTENSION);
            $ukuranFile    = $_FILES['photo']['size'];
            $sumber   = $_FILES['photo']['tmp_name'];
            $photo = uniqid();
            $photo .= '.';
            $photo .= $tipe;

            if(in_array($tipe, $ekstensi) === true)
            {
                if($ukuranFile < 1048576) {//1 mb
                    // hapus foto lama sebelum upload foto baru
                    unlink("_assets/img/".$item['photo']);

                    $lokasi = "_assets/img/".$photo;
                    mysqli_query($koneksi,"UPDATE produk_tb SET name='$name_product', importir_id='$importir_id',photo='$photo',qty = '$qty',price = '$price' WHERE id = '$id'");
                    $upload=move_uploaded_file($sumber, $lokasi);
                        if($upload) { 
                            echo '<script>
                            alert("Data Berhasil Diperbarui")
                            window.location = "detail_product.php?id='.$id.'";
                            </script>';                     
                        }
                        else{
                            echo '<script>
                            alert("Data Gagal Diperbarui")
                            window.location = "edit_product.php?id='.$id.'";
                            </script>';  
                        }
                } else{
                    echo '<script>alert("Maaf Ukuran File Terlalu Besar")
                            window.location = "edit_product.php?id='.$id.'";
                            </script>';  
                    }
            }
            else
            {
                echo '<script>alert("Maaf Jenis File Tidak Diizinkan")
                    window.location = "edit_product.php?id='.$id.'";
                    </script>';  
            }
        }

        
    }
?>