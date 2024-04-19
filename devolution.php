<?php
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);
include("conection.php");
$sql = "update film set available = ? where idfilm = ?";
$stm = $conn->prepare($sql);
$value = 1;
$stm->bindParam(1, $value);
$stm->bindParam(2, $data["idfilm"]);
$stm->execute();
$sql = "update rent set realdevolution = ? where idfilm = ? and realdevolution = null";
$stmt = $conn->prepare($sql);
$date = date("Y-m-d H:i:s");
$stmt -> bindParam(2,$data["idfilm"]);
$stmt -> bindParam(1,$date );
$stmt->execute();
$datos = array("idfilm" => $data["idfilm"]);
header('Content-Type: application/json');
echo json_encode($datos);
