<!DOCTYPE html>
<html>
<head>
    <title>Form Verilerini Yazdırma</title>
</head>
<body>
    <?php
    if (isset($_POST['submit'])) {
        // Form verilerini al
        $eleman1 = $_POST['eleman1'];
        $eleman2 = $_POST['eleman2'];
        $eleman3 = $_POST['eleman3'];
        
        // Alınan verileri yazdır
        echo "<h2>Form Verileri:</h2>";
        echo "<p>Eleman 1: " . $eleman1 . "</p>";
        echo "<p>Eleman 2: " . $eleman2 . "</p>";
        echo "<p>Eleman 3: " . $eleman3 . "</p>";
    }
    ?>
</body>
</html>
