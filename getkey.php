<?php
// getkey.php
// Chuỗi bí mật này phải giống hệt biến SECRET_SALT trong Android Studio/AIDE
$SECRET_SALT = "FAKELAGVIP_2026"; 

// Lấy Device ID từ đường dẫn (URL)
if (isset($_GET['id'])) {
    $deviceId = $_GET['id'];
    
    // Lấy ngày hiện tại (Định dạng: Ngày_Tháng_Năm)
    // Việc này giúp Key tự động đổi sau 24h
    $date = date("d_m_Y"); 
    
    // Công thức tạo Key (Giống hệt logic trong App)
    $rawString = $deviceId . $date . $SECRET_SALT;
    $hash = md5($rawString);
    
    // Lấy 8 ký tự đầu và viết hoa để làm mã Key
    $finalKey = strtoupper(substr($hash, 0, 8));

    // --- GIAO DIỆN WEB HIỂN THỊ ---
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HỆ THỐNG LẤY KEY VIP</title>
        <style>
            body { background: #0a0a0c; color: white; font-family: sans-serif; text-align: center; padding: 50px 20px; }
            .container { border: 2px solid #ff1744; border-radius: 15px; padding: 30px; display: inline-block; background: #121214; }
            h1 { color: #ff1744; margin-bottom: 10px; }
            .key-box { background: #26262b; padding: 15px; font-size: 28px; font-weight: bold; color: #ff1744; border: 1px dashed #ff1744; margin: 20px 0; cursor: pointer; }
            .info { color: #808080; font-size: 14px; }
            .btn-copy { background: #ff1744; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>GET KEY THÀNH CÔNG</h1>
            <p>ID Thiết bị: <strong><?php echo htmlspecialchars($deviceId); ?></strong></p>
            
            <div class="key-box" id="keyText"><?php echo $finalKey; ?></div>
            
            <button class="btn-copy" onclick="copyKey()">SAO CHÉP KEY</button>
            
            <p class="info">Key này có hiệu lực đến hết ngày hôm nay.<br>Sau 24h vui lòng quay lại lấy Key mới.</p>
        </div>

        <script>
            function copyKey() {
                var text = document.getElementById("keyText").innerText;
                navigator.clipboard.writeText(text);
                alert("Đã sao chép Key: " + text);
            }
        </script>
    </body>
    </html>
    <?php
} else {
    echo "<h1>LỖI: THIẾU ID THIẾT BỊ!</h1><p>Vui lòng lấy key từ trong App.</p>";
}
?>
