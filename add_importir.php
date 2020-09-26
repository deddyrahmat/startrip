<?php
    $title = "Add Importir";
    require_once "_templates/header.php";
?>

    <section id="main">
        <div class="container my-5">
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Importir</li>
                        </ol>
                    </nav>
                    <div class="card shadow">
                        <div class="card-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="name_importir" class="col-sm-3 col-form-label">Name Importir</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name_importir" id="name_importir" placeholder="Name Importir" required autocomplete="off" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" required autocomplete="off" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required autocomplete="off" >
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right" name="save_importir"> Simpan</button>
                            <a href="index.php" class="btn btn-warning text-white"> Kembali</a>
                        </div>
                        </form>
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
            window.location = "importir.php";
            </script>';                     
        }
        else{
            echo '<script>
            alert("Data Gagal Diupload")
            window.location = "add_importir.php";
            </script>';  
        }
    }
?>