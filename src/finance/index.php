<!doctype html>
<html lang="en">
<?php
include('../conf/head.php');
?>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <?php
        include('../conf/aside.php');
        ?>
        <div class="body-wrapper">
            <?php
            include('../conf/header.php');
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <a href="" class="card-title fw-semibold mb-4 btn btn-info" style="color: white; font-size: 14px;">บุคคล</a>
                                <a href="" class="card-title fw-semibold mb-4 btn btn-info" style="color: white; font-size: 14px;">นิติบุคคล</a>
                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 align-middle">
                                        <thead class="text-dark fs-4">
                                            <tr>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">ลำดับ</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">ชื่อ-นามสกุล</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">โครงการ</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">จำนวนเงิน</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">รายละเอียด</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once '../conf/connection.php';
                                            $rowsPerPage = 10;
                                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $offset = ($page - 1) * $rowsPerPage;

                                            $stmt = $conn->prepare("SELECT * FROM receipt  ORDER BY receipt_id DESC LIMIT :offset, :rows");
                                            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                                            $stmt->bindParam(':rows', $rowsPerPage, PDO::PARAM_INT);
                                            $stmt->execute();
                                            $result = $stmt->fetchAll();

                                            $countStmt = $conn->prepare("SELECT COUNT(*) as count FROM receipt");
                                            $countStmt->execute();
                                            $totalRows = $countStmt->fetchColumn();
                                            $totalPages = ($totalRows > 0) ? ceil($totalRows / $rowsPerPage) : 1;

                                            $countrow = ($page - 1) * $rowsPerPage + 1;
                                            foreach ($result as $t1) {
                                            ?>
                                                <tr>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0"><?= $countrow ?></h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-1">
                                                            <?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?>
                                                            <?php if ($t1['status_donat'] == 'offline') { ?>
                                                                <span class="badge bg-info rounded-3 fw-semibold"><?= $t1['status_donat']; ?></span>
                                                            <?php } else { ?>
                                                                <span class="badge bg-danger rounded-3 fw-semibold"><?= $t1['status_donat']; ?></span>
                                                            <?php } ?>
                                                        </h6>
                                                        <span class="fw-normal"><?= $t1['rec_date_out']; ?> | <?= $t1['id_receipt']; ?></span>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"><?= $t1['edo_name']; ?><?= $t1['other_description']; ?></p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-1"><?= number_format($t1['amount'], 2, '.', ','); ?></h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item">
                                                                    <i class="bx bx-file-pdf me-1"></i> PDF
                                                                </a>
                                                                <a class="dropdown-item" href="paycheck.php?receipt_id=<?= $t1['receipt_id']; ?>?ref1=<?= $t1['ref1']; ?>">
                                                                    <i class="bx bx-show me-1"></i> รายละเอียดการโอน
                                                                </a>
                                                                <a class="dropdown-item">
                                                                    <i class="bx bx-show me-1"></i> แก้ไขข้อมูล
                                                                </a>
                                                                <a class="dropdown-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="cancel" href="javascript:void(0);" onclick="confirmcancel('<?= $t1['receipt_id']; ?>')">
                                                                    <i class=" bx bx-show me-1 "></i> ลบข้อมูล
                                                                    <script src=" https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                                                    <script>
                                                                        function confirmcancel(receipt_id) {
                                                                            swal({
                                                                                    title: "คำเตือน",
                                                                                    text: "เมื่อคุณกด 'ยืนยันการยกเลิก' ระบบจะทำงานยกเลิกใบเสร็จรับเงิน และจะไม่สามารถนำกลับมาได้อีก",
                                                                                    type: "warning",
                                                                                    showCancelButton: true,
                                                                                    confirmButtonColor: "#DD6B55",
                                                                                    confirmButtonText: "ยืนยันการยกเลิก",
                                                                                    cancelButtonText: "เลิกทำ",
                                                                                    closeOnConfirm: false
                                                                                },
                                                                                function(isConfirm) {
                                                                                    if (isConfirm) {
                                                                                        window.location = "receipt_cancel.php?receipt_id=" + receipt_id;
                                                                                    }
                                                                                });
                                                                        }
                                                                    </script>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php $countrow++;
                                            } ?>
                                        </tbody>
                                    </table>
                                    <div class="text-center mt-4">
                                        <ul class="pagination justify-content-center">
                                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php
                include('../conf/footer.php');
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