<?php
session_start();
require_once "Database.php";

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Giả sử select trả về mảng kết quả
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $db->select($sql);

    if ($result && count($result) > 0) {
        $user = $result[0];

        if ($password == $user["password"]) {

            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];

            header("Location: " . ($user["role"] == "admin" ? "admin.php" : "index.php"));
            exit();
        }
    }

    echo "Sai tài khoản hoặc mật khẩu!";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #25252b;
            font-family: Arial, sans-serif;
        }

        .container {
            position: relative;
            width: 750px;
            height: 450px;
            border: 2px solid #ff2770;
            box-shadow: 0 0 25px #ff2770;
            overflow: hidden;
        }

        /* Hình xéo */
        .curved-shape {
            position: absolute;
            right: 0;
            top: -5px;
            height: 600px;
            width: 850px;
            background: linear-gradient(45deg, #25252b, #ff2770);
            transform: rotate(10deg) skewY(40deg);
            transform-origin: bottom right;
            z-index: 1;
        }

        /* Form login */
        .form-box {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 40px;
            z-index: 2;
        }

        .form-box h2 {
            font-size: 32px;
            text-align: center;
            color: #fff;
        }

        .input-box {
            position: relative;
            width: 100%;
            max-width: 300px;
            margin: 20px 0;
            display: flex;
            align-items: center;
            border-bottom: 2px solid #fff;
        }

        .input-box input {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 16px;
            color: #fff;
            font-weight: 600;
            padding: 10px 10px 10px 35px;
            box-sizing: border-box;
        }

        .input-box label {
            position: absolute;
            left: 35px;
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            pointer-events: none;
            transition: 0.3s;
        }

        .input-box input:focus~label,
        .input-box input:valid~label {
            top: -10px;
            font-size: 12px;
            color: #ff2770;
        }

        .input-box i {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            font-size: 20px;
        }

        .btn {
            width: 100%;
            max-width: 300px;
            height: 45px;
            background: transparent;
            border-radius: 40px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            border: 2px solid #ff2770;
            color: #fff;
            margin-top: 20px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: "";
            position: absolute;
            height: 300%;
            width: 100%;
            background: linear-gradient(#25252b, #ff2770, #25252b, #ff2770);
            top: -100%;
            left: 0;
            transition: 0.5s;
            z-index: -1;
        }

        .btn:hover::before {
            top: 0;
        }

        .regi-link {
            font-size: 14px;
            text-align: center;
            margin: 20px 0 10px;
            color: #fff;
        }

        .regi-link a {
            text-decoration: none;
            color: #ff2770;
            font-weight: 600;
        }

        .regi-link a:hover {
            text-decoration: underline;
        }

        /* Chữ trên hình xéo nhưng bình thường */
        .info-content {
            position: absolute;
            top: 50px;
            /* đẩy lên cao */
            right: 50px;
            /* nằm bên trong shape xéo */
            width: 50%;
            height: auto;
            /* chiều cao tự động */
            display: flex;
            justify-content: flex-start;
            /* canh chữ về trên */
            align-items: flex-start;
            /* chữ căn lên trên */
            z-index: 2;
        }

        .info-content h2 {
            color: #fff;
            font-size: 36px;
            text-transform: uppercase;
            transform: none;
            margin-left: 60px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="curved-shape"></div>
        <div class="form-box Login">
            <h2>Login</h2>
            <form action="" method="post">
                <div class="input-box">
                    <i class='bx bx-user'></i>
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <i class='bx bx-lock'></i>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <button class="btn" type="submit">Login</button>
                <div class="regi-link">
                    <p>Don't have an account? <a href="#">Sign up</a></p>
                </div>
            </form>
        </div>
        <div class="info-content">
            <h2>WELCOME BACK!</h2>
        </div>
    </div>
</body>

</html>