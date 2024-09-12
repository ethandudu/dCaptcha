<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'captcha.php';
$captcha = new Captcha();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($captcha->checkCaptcha($_POST['captcha'])) {
        echo 'Captcha is correct';
    } else {
        echo 'Captcha is incorrect';
    }
}

if (isset($_GET['showCaptcha'])) {
    header('Content-Type: image/jpeg');
    $captcha->generateCaptcha();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>dCaptcha example</title>
</head>
<body>
    <form action="example.php" method="post">
        <div>
            <img src="example.php?showCaptcha"  alt="captcha"/><button type="button" onclick="regenCaptcha()" >Regenerate</button>
        </div>
        <div>
            <label>
                Captcha:
                <input type="text" name="captcha" />
            </label>
        </div>
        <input type="submit" value="Submit" />
    </form>
<script>
    function regenCaptcha() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'example.php?showCaptcha', true);
        xhr.responseType = 'blob';
        xhr.onload = function() {
            if (this.status === 200) {
                var blob = new Blob([this.response], {type: 'image/jpeg'});
                document.querySelector('img').src = URL.createObjectURL(blob);
            }
        };
        xhr.send();
    }
</script>
</body>
</html>