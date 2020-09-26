<?php
    $title = "Importir";
    require_once "_templates/header.php";
?>

    <section id="main">
        <div class="container my-5">
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Importir</li>
                        </ol>
                    </nav>
                    <div class="card shadow">
                        <div class="card-body">
                            <a href="add_importir.php" class="nav-link btn btn-primary text-white">Add Importir</a>
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Importir</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $data_importir = query('SELECT * FROM importir_tb');
                                            foreach ($data_importir as $item_importir) :
                                        ?>
                                        <tr>
                                            <td><?= ucwords($item_importir['name']) ?></td>
                                            <td><?= ucwords($item_importir['address']) ?></td>
                                            <td><?= ucwords($item_importir['phone']) ?></td>
                                            <td>
                                                <a href="edit_importir.php?id=<?= $item_importir['id'] ?>" class="btn btn-warning text-white">Edit</a>
                                                <a href="?del&id=<?= $item_importir['id'] ?>" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
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
        $id = $_GET['id'];
        $delete=mysqli_query($koneksi,"DELETE FROM importir_tb WHERE id = '$id'");
        if($delete) { 
            echo '<script>
            alert("Data Berhasil Dihapus")
            window.location = "importir.php";
            </script>';                     
        }
        else{
            echo '<script>
            alert("Data Gagal Dihapus")
            window.location = "importir.php";
            </script>';  
        }
    }
?>