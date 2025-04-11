<?php require "../include/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php

if (!isset($_SESSION["user_id"])) {
    echo "<script> alert('You must be logged in to book a table'); </script>";
    exit;
}

if (
    empty($_POST['first_name']) || empty($_POST['last_name'])
    || empty($_POST['date']) || empty($_POST['time']) || empty($_POST['phone']) || empty($_POST['message'])
) {
    echo "<script> alert('All fields are required'); </script>";
} else {
    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $date = $_POST["date"];
    $time = $_POST["time"];
    $phone = htmlspecialchars($_POST["phone"]);
    $message = htmlspecialchars($_POST["message"]);
    $user_id = $_SESSION["user_id"];

    // Validate date format
    if (DateTime::createFromFormat('d/m/Y', $date) && $date > date("Y-m-d")) {

        $insert = $conn->prepare("INSERT INTO bookings (first_name, last_name, date, time, phone, message, user_id) 
                                      VALUES (:first_name, :last_name, :date, :time, :phone, :message, :user_id)");

        $insert->execute([
            ":first_name" => $first_name,
            ":last_name" => $last_name,
            ":date" => $date,
            ":time" => $time,
            ":phone" => $phone,
            ":message" => $message,
            ":user_id" => $user_id
        ]);

        header("location:" . APPURL);
    } else {
        header("location:" . APPURL);
    }
}
?>
