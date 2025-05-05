<?php
$apiUrl = "https://script.google.com/macros/s/AKfycby4DtgL_j0VjvAAzlNt_8in5irfKytdQ7VUEjISGZpbpPEwAilW8Fg4X1QFOzs-TRHF/exec"; // เปลี่ยนตรงนี้

$response = file_get_contents($apiUrl);
if ($response === FALSE) {
    die("ไม่สามารถดึงข้อมูลจาก Google Sheets ได้");
}

$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ตารางเวรแพทย์ ER</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #999;
      padding: 8px;
      text-align: center;
    }
    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <h1>ตารางเวรแพทย์ ER</h1>

  <table>
    <tr>
      <th>วันที่</th>
      <th>วัน</th>
      <th>เช้า</th>
      <th>เย็น</th>
      <th>ดึก</th>
    </tr>
    <?php
    foreach ($data as $i => $row) {
        if ($i == 0) continue; // ข้ามหัวตาราง
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
    }
    ?>
  </table>
</body>
</html>
