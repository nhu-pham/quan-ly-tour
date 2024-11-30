<?php
require_once "./mvc/core/redirect.php";
$redirect = new redirect();
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

?>
<!DOCTYPE html>
<html lang="en"> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <meta http-equiv="content-security-policy|content-type|default-style|refresh">
    <link rel="stylesheet" href="/quan-ly-tour/public/assets/css/user/info.css">
</head>

<body class="info-body">
    <section class="info-container">
        <?php if (isset($_SESSION['sucess'])) { ?>
            <div class="message success">
                <p class="text-success"><?= $redirect->setFlash('sucess');  ?></p>
            </div>
        <?php } ?>

        <?php if (isset($_SESSION['error'])) { ?>
            <div class="message error">
                <p class="text-error"><?= $redirect->setFlash('error');  ?></p>
            </div>
        <?php } ?>

        <div class="info-content">
            <?php require_once './mvc/views/user/info/' . $page . '.php'; ?>
        </div>

    </section>
    <script>
        function previewImage(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function() {
                var image = document.getElementById('imagePreview');
                image.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file); 
            }
        }
    </script>
</body>

</html>

<?php unset($_SESSION['errors']) ?>