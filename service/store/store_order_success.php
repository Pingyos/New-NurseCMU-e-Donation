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
                                <div class="table-responsive">
                                    <div class="text-end md-3">
                                        <button class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" id="printButtonform1">
                                            <i class="ti ti-printer fs-5"></i>
                                        </button>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var table = document.getElementById("myTable");
                                                var checkboxes = table.querySelectorAll(".form-check-input");
                                                var printButtonform1 = document.getElementById("printButtonform1");

                                                checkboxes.forEach(function(checkbox) {
                                                    checkbox.addEventListener("change", function() {
                                                        handleCheckboxChange();
                                                    });
                                                });

                                                printButtonform1.addEventListener("click", function() {
                                                    handlePrintButtonClick();
                                                });
                                            });

                                            function handleCheckboxChange() {}

                                            function handlePrintButtonClick() {
                                                var selectedIds = [];
                                                var checkboxes = document.querySelectorAll(".form-check-input:checked");
                                                checkboxes.forEach(function(checkbox) {
                                                    selectedIds.push(checkbox.value);
                                                });

                                                if (selectedIds.length > 0) {
                                                    var printWindow = window.open("about:blank", '_blank');
                                                    printWindow.location.href = "order_invoice.php?selectedIds=" + selectedIds.join(",") + "&ACTION=VIEW";
                                                } else {
                                                    alert("กรุณาเลือกข้อมูลที่ต้องการ Print");
                                                }
                                            }
                                        </script>
                                    </div>
                                    <table id="myTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>ตัวเลือก</th>
                                                <th>หมายเลขออเดอร์</th>
                                                <th>ชื่อผู้รับ</th>
                                                <th>รายการ</th>
                                                <th>สถานะ</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once 'conf/connection.php';
                                            $check = isset($_GET['check']) ? $_GET['check'] : '';

                                            if ($check == 'success') {
                                                $stmt_receipt = $conn->prepare("SELECT store.*, storage.name 
                                    FROM store 
                                    INNER JOIN storage ON store.storage_id = storage.id 
                                    WHERE store.status_order = 'success'");
                                                $stmt_receipt->execute();
                                                $result = $stmt_receipt->fetchAll();
                                            } elseif ($check == 'cancel') {
                                                $stmt_receipt = $conn->prepare("SELECT store.*, storage.name 
                                    FROM store 
                                    INNER JOIN storage ON store.storage_id = storage.id 
                                    WHERE store.status_order = 'cancel'");
                                                $stmt_receipt->execute();
                                                $result = $stmt_receipt->fetchAll();
                                            }

                                            $countrow = 1;
                                            foreach ($result as $t1) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <h6><?= $countrow ?></h6>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="<?= $t1['receipt_id']; ?>" id="checkbox<?= $t1['receipt_id']; ?>">
                                                            <label class="form-check-label" for="checkbox<?= $countrow ?>"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 fw-normal"><?= $t1['order_ref1']; ?> </p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 fw-normal"><?= $t1['order_name']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 fw-normal"><?= $t1['order_set']; ?> (<?= $t1['name']; ?>)</p>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($t1['status_order'] == 'success') {
                                                            echo '<span class="mb-1 badge text-bg-success">จัดส่งแล้ว</span>';
                                                        } else {
                                                            echo '<span class="mb-1 badge text-bg-danger">ยกเลิกออเดอร์</span>';
                                                        }
                                                        ?>
                                                    </td>


                                                    <td>
                                                        <div class="dropdown dropstart">
                                                            <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ti ti-dots-vertical fs-6"></i>
                                                            </a>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item d-flex align-items-center gap-3 details-link" href="#" data-bs-toggle="modal" data-bs-target="#transferModal<?= $t1['receipt_id']; ?>" data-receipt-id="<?= $t1['receipt_id']; ?>">
                                                                    <i class="fs-4 ti ti-edit"></i>รายละเอียด
                                                                </a>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php
                                                $countrow++;
                                            }
                                            ?>
                                        </tbody>


                                        <tfoot>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>ตัวเลือก</th>
                                                <th>หมายเลขออเดอร์</th>
                                                <th>ชื่อผู้รับ</th>
                                                <th>รายการ</th>
                                                <th>สถานะ</th>
                                                <th>#</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <script>
        $(document).ready(function() {
            $("#myTable").DataTable();
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>