<!doctype html>
<html lang="en">
<?php
include('conf/head.php');
?>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <?php
        include('conf/aside.php');
        ?>
        <div class="body-wrapper">
            <?php
            include('conf/header.php');
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-semibold mb-4"></h5>
                                <div class="card">
                                    <div class="card-body">
                                        <?php
                                        require_once 'conf/connection.php';

                                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                            // รับข้อมูลจากฟอร์ม
                                            $id = $_POST['id'];

                                            // เลือกข้อมูลจากตาราง receipt ด้วย ID ที่ระบุ
                                            $stmt_select = $conn->prepare("SELECT * FROM receipt WHERE id = :id");
                                            $stmt_select->bindParam(':id', $id);
                                            $stmt_select->execute();
                                            $result = $stmt_select->fetch(PDO::FETCH_ASSOC);

                                            // ตรวจสอบว่ามีข้อมูลหรือไม่
                                            if ($result) {
                                                // ตรวจสอบว่ามี id และ order_ref1 ซ้ำกันหรือไม่
                                                $stmt_check_duplicate = $conn->prepare("SELECT * FROM store WHERE id = :id AND order_ref1 = :order_ref1");
                                                $stmt_check_duplicate->bindParam(':id', $result['id']);
                                                $stmt_check_duplicate->bindParam(':order_ref1', $result['ref1']);
                                                $stmt_check_duplicate->execute();
                                                $duplicate_exists = $stmt_check_duplicate->fetch(PDO::FETCH_ASSOC);

                                                if ($duplicate_exists) {
                                                    echo '
                                                        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                                        <script>
                                                            $(document).ready(function(){
                                                                swal({
                                                                    title: "ออเดอร์นี้มีการจัดส่งแล้ว",
                                                                    text: "กรุณาตรวจสอบออเดอร์",
                                                                    type: "error",
                                                                    timer: 2100,
                                                                    showConfirmButton: false
                                                                }, function(){
                                                                    window.location.href = "order_check.php";
                                                                });
                                                            });
                                                        </script>';
                                                } else {
                                                    // เพิ่มข้อมูลลงในตาราง store
                                                    $stmt_insert = $conn->prepare("INSERT INTO store (id, order_ref1, order_receipt, order_tel, order_email, order_description, order_name, order_address, order_set, status_order) VALUES (:id, :order_ref1, :order_receipt, :order_tel, :order_email, :order_description, :order_name, :order_address, :order_set, :status_order)");

                                                    $stmt_insert->bindParam(':id', $result['id']);
                                                    $stmt_insert->bindParam(':order_ref1', $result['ref1']);
                                                    $stmt_insert->bindParam(':order_receipt', $result['id_receipt']);
                                                    $stmt_insert->bindParam(':order_tel', $result['rec_tel']);
                                                    $stmt_insert->bindParam(':order_email', $result['rec_email']);
                                                    $stmt_insert->bindParam(':order_description', $result['edo_description']);

                                                    // ตัวแปร order_name, order_address ไม่สามารถใช้ bindParam ได้
                                                    $order_name = $result['name_title'] . ' ' . $result['rec_name'] . ' ' . $result['rec_surname'];
                                                    $order_address = $result['address'] . ' ' . $result['road'] . ' ' . $result['districts'] . ' ' . $result['amphures'] . ' ' . $result['provinces'] . ' ' . $result['zip_code'];

                                                    $stmt_insert->bindParam(':order_name', $order_name);
                                                    $stmt_insert->bindParam(':order_address', $order_address);

                                                    // เพิ่มเงื่อนไขตาม order_amount
                                                    $order_amount = $result['amount'];
                                                    if ($order_amount >= 1 && $order_amount <= 999.99) {
                                                        $order_set = 'not order';
                                                    } elseif ($order_amount >= 1000.00 && $order_amount <= 3000.00) {
                                                        $order_set = 'order a';
                                                    } elseif ($order_amount >= 3001.00 && $order_amount <= 99999.99) {
                                                        $order_set = 'order b';
                                                    } elseif ($order_amount >= 100000.00 && $order_amount <= 199999.00) {
                                                        $order_set = 'order c';
                                                    } else {
                                                        $order_set = 'unknown';
                                                    }

                                                    $stmt_insert->bindParam(':order_set', $order_set);
                                                    $stmt_insert->bindParam(':status_order', $_POST['status_order']);

                                                    if ($stmt_insert->execute()) {
                                                        // ถ้า INSERT สำเร็จ
                                                        echo '
                                                        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                                        <script>
                                                            $(document).ready(function(){
                                                                swal({
                                                                    title: "บันทึกการจัดส่งสำเร็จ",
                                                                    text: "กรุณารอสักครู่",
                                                                    type: "success",
                                                                    timer: 2100,
                                                                    showConfirmButton: false
                                                                }, function(){
                                                                    window.location.href = "order_check.php";
                                                                });
                                                            });
                                                        </script>';
                                                    } else {
                                                        // ถ้า INSERT ไม่สำเร็จ
                                                        echo '
                                                    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                                    <script>
                                                        $(document).ready(function(){
                                                            swal({
                                                                title: "บันทึกการจัดส่งไม่สำเร็จ",
                                                                text: "กรุณารอสักครู่",
                                                                type: "error",
                                                                timer: 2500,
                                                                showConfirmButton: false
                                                            }, function(){
                                                                window.location.href = "order_check.php";
                                                            });
                                                        });
                                                    </script>';
                                                    }
                                                }
                                            } else {
                                                echo '
                                            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                            <script>
                                                $(document).ready(function(){
                                                    swal({
                                                        title: "หมายเลขออเดอร์ไม่มีในระบบ",
                                                        text: "กรุณารอตรวจสอบหมายเลขออเดอร์ใหม่",
                                                        type: "error",
                                                        timer: 3000,
                                                        showConfirmButton: false
                                                    }, function(){
                                                        window.location.href = "order_check.php";
                                                    });
                                                });
                                            </script>';
                                            }
                                        }
                                        ?>

                                        <div class="col-md-12">
                                            <form method="post">
                                                <div class="mb-3">
                                                    <label for="order_id" class="form-label">กรอกหมายเลขออเดอร์</label>
                                                    <input type="text" class="form-control" name="id" id="id" required>
                                                </div>
                                                <input type="hidden" name="status_order" id="status_order" value="success">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary" id="saveButton">ยันยืนการจัดส่ง</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php
                include('conf/footer.php');
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>