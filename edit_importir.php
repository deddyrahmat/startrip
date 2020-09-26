<?php
    $title = "Edit Importir";
    require_once "_templates/header.php";
    $id = $_GET['id'];
    $item = query("SELECT * FROM importir_tb WHERE id = '$id'")[0];
?>

    <section id="main">
        <div class="container my-5">
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="importir.php">Importir</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Importir</li>
                        </ol>
                    </nav>
                    <div class="card shadow">
                        <div class="card-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="name_importir" class="col-sm-3 col-form-label">Name Importir</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name_importir" value="<?= $item['name'] ?>" id="name_importir" placeholder="Name Importir" required autocomplete="off" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?= $item['address'] ?>" required autocomplete="off" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?= $item['phone'] ?>" name="phone" id="phone" placeholder="Phone" required autocomplete="off" >
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right" name="edit_importir"> Simpan</button>
                            <a href="importir.php" class="btn btn-warning text-white"> Kembali</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
    require_once "_templates/footer.php";

    if (isset($_POST['edit_importir'])) {
        $name_importir = htmlspecialchars( $_POST['name_importir']);
        $address = htmlspecialchars( $_POST['address']);
        $phone = htmlspecialchars( $_POST['phone']);

        $update = mysqli_query($koneksi,"UPDATE importir_tb SET name='$name_importir', address='$address', phone='$phone' WHERE id = '$id'");
        if($update) { 
            echo '<script>
            alert("Data Berhasil Diperbarui")
            window.location = "importir.php";
            </script>';                     
        }
        else{
            echo '<script>
            alert("Data Gagal Diperbarui")
            window.location = "edit_importir.php?id='.$id.'";
            </script>';  
        }
    }
?>