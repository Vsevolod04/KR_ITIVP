<?php
include "config.php";

if (isset($_GET["id"])) {
    $conn = getConn();
    try {
        $stmt = $conn->prepare("DELETE FROM ideas WHERE id = ?");
        $stmt->bindParam(1, $_GET["id"], PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        header("Location: error.php?error={$e->getMessage()}");
        exit();
    }
    header("Location: index.php");
    exit();
}
