<?php
include "config.php";

if (isset($_GET["id"]) and isset($_GET["newStatus"])) {
    $conn = getConn();
    try {
        $stmt = $conn->prepare("UPDATE ideas SET status = ? WHERE id = ?");
        $stmt->bindParam(1, $_GET["newStatus"], PDO::PARAM_STR);
        $stmt->bindParam(2, $_GET["id"], PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        header("Location: error.php?msg=" . urlencode($e->getMessage()));
        exit();
    }
    header("Location: index.php");
    exit();
}
