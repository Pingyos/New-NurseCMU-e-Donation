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
                                                    <h6 class="fw-semibold mb-0">ที่อยู่</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">สถานะ</h6>
                                                </th>
                                                <th class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">รายละเอียด</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once 'conf/connection.php';

                                            $rowsPerPage = 10;
                                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $offset = ($page - 1) * $rowsPerPage;

                                            $stmt = $conn->prepare("SELECT * FROM store WHERE status_receipt = 'yes' AND resDesc = 'success' AND receipt_cc = 'confirm' AND amount > 999.99 ORDER BY items ASC LIMIT :offset, :rows");
                                            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                                            $stmt->bindParam(':rows', $rowsPerPage, PDO::PARAM_INT);
                                            $stmt->execute();
                                            $result = $stmt->fetchAll();

                                            $countStmt = $conn->prepare("SELECT COUNT(*) as count FROM store WHERE status_receipt = 'yes' AND resDesc = 'success' AND receipt_cc = 'confirm' AND amount > 999.99");
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

                                                        <h6 class="fw-semibold mb-1 <?= ($t1['receipt_cc'] == 'cancel') ? ' text-decoration-line-through' : ''; ?>">
                                                            <?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?>
                                                            <span class="badge bg-info rounded-3 fw-semibold"><?= $t1['items_set']; ?></span>
                                                        </h6>
                                                        <span class="fw-normal<?= ($t1['receipt_cc'] == 'cancel') ? ' text-decoration-line-through' : ''; ?>">
                                                            <?= $t1['rec_tel']; ?> | <?= number_format($t1['amount'], 2, '.', ','); ?>
                                                        </span>

                                                        <h6 class="fw-semibold mb-1">
                                                        </h6>
                                                        <?php
                                                        $htmlDate = $t1['rec_date_out'];
                                                        $dateTime = new DateTime($htmlDate);
                                                        $dateTime->modify('+543 years');
                                                        $formattedDate = $dateTime->format('d-m-Y');
                                                        ?>
                                                        <span class="fw-normal<?= ($t1['receipt_cc'] == 'cancel') ? ' text-decoration-line-through' : ''; ?>">
                                                            <?= $formattedDate; ?> | <?= $t1['id_receipt']; ?>
                                                        </span>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal <?= ($t1['receipt_cc'] == 'cancel') ? ' text-decoration-line-through' : ''; ?>"><?= $t1['edo_name']; ?><?= $t1['other_description']; ?></p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <?php
                                                        if ($t1['items'] == 1) {
                                                            echo '<span class="btn btn-warning m-1 d-inline-block text-truncate" style="width: 120px;">รอดำเนินการ</span>';
                                                        } elseif ($t1['items'] == 2) {
                                                            echo '<span class="btn btn-success m-1 d-inline-block text-truncate" style="width: 120px;">จัดส่งแล้ว</span>';
                                                        } elseif ($t1['items'] == 3) {
                                                            echo '<span class="btn btn-danger m-1 d-inline-block text-truncate" style="width: 120px;">ยกเลิก</span>';
                                                        }
                                                        ?>

                                                        <?php if ($t1['items'] != 2) { ?>
                                                            |
                                                            <a class="card-title btn-info " data-toggle="tooltip" data-placement="top" title="" data-original-title="cancel" href="javascript:void(0);" onclick="confirmCheck('<?= $t1['receipt_id']; ?>')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-location-check" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path d="M11.512 17.023l-1.512 -3.023l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5l-4.45 12.324" />
                                                                    <path d="M15 19l2 2l4 -4" />
                                                                </svg>
                                                            </a>
                                                        <?php } ?>
                                                        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                                        <script>
                                                            function confirmCheck(receipt_id) {
                                                                swal({
                                                                        title: "ยืนยันการส่งของที่ระลึง",
                                                                        text: "กรุณากดยืนยันเพื่อจัดส่งของที่ระลึก",
                                                                        type: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: "#5D87FF",
                                                                        confirmButtonText: "ยืนยัน",
                                                                        cancelButtonText: "ยกเลิก",
                                                                        closeOnConfirm: false
                                                                    },
                                                                    function(isConfirm) {
                                                                        if (isConfirm) {
                                                                            window.location = "order_check.php?receipt_id=" + receipt_id;
                                                                        }
                                                                    });
                                                            }
                                                        </script>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="">
                                                                    <i class="bx bx-show me-1"></i> รายละเอียด
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
                                                    <a class="page-link" href="?page=<?= $i; ?>&offset=<?= $offset; ?>&rows=<?= $rowsPerPage; ?>"><?= $i; ?></a>
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