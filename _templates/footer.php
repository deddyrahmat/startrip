<footer class="pt-3 pb-3 text-center bg-dark text-white">
  <div class="container">
    <span>Deddy Rahmat 2020</span>
  </div>
</footer>

<script src="_assets/js/jquery.min.js"></script>
<script src="_assets/js/bootstrap.min.js"></script>

<?php
    // jika variabel addscript sudah ditentukan
    if (isset($addscript)) {
      // jika variabel addscript tidak sama dengan null, tampilkan script tambahan
      if ($addscript != null) {
        echo $addscript;
      }
    }
  ?>
</body>
</html>