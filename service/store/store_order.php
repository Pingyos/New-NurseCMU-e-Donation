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
                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link d-flex active" data-bs-toggle="tab" href="#showall" role="tab" aria-selected="true">
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                                                            <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                                                            <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                                                            <path d="M11 6l9 0" />
                                                            <path d="M11 12l9 0" />
                                                            <path d="M11 18l9 0" />
                                                        </svg></span>
                                                    <span class="d-none d-md-block ms-2">ทั้งหมด</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link d-flex" data-bs-toggle="tab" href="#warning" role="tab" aria-selected="false" tabindex="-1">
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-exclamation-mark" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 19v.01" />
                                                            <path d="M12 15v-10" />
                                                        </svg></span>
                                                    <span class="d-none d-md-block ms-2">รอส่ง</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link d-flex" data-bs-toggle="tab" href="#success" role="tab" aria-selected="false" tabindex="-1">
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M5 12l5 5l10 -10" />
                                                        </svg></span>
                                                    <span class="d-none d-md-block ms-2">สำเร็จ</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link d-flex" data-bs-toggle="tab" href="#danger" role="tab" aria-selected="false" tabindex="-1">
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M18 6l-12 12" />
                                                            <path d="M6 6l12 12" />
                                                        </svg></span>
                                                    <span class="d-none d-md-block ms-2">ยกเลิก</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- Tab content -->
                                        <div class="tab-content">
                                            <div class="tab-pane active show" id="showall" role="tabpanel">
                                                <div class="text-end md-3">
                                                    <button class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" id="printButtonform1">
                                                        <i class="ti ti-printer fs-5"></i>
                                                    </button>
                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function() {
                                                            var table = document.getElementById("myTable1");
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

                                                        function handleCheckboxChange() {
                                                            // Add any necessary logic for checkbox change
                                                        }

                                                        function handlePrintButtonClick() {
                                                            var selectedIds = [];
                                                            var checkboxes = document.querySelectorAll(".form-check-input:checked");
                                                            checkboxes.forEach(function(checkbox) {
                                                                selectedIds.push(checkbox.value);
                                                            });

                                                            if (selectedIds.length > 0) {
                                                                var printWindow = window.open("about:blank", '_blank');
                                                                printWindow.location.href = "order_confirm.php?selectedIds=" + selectedIds.join(",") + "&ACTION=VIEW";
                                                            } else {
                                                                alert("กรุณาเลือกข้อมูลที่ต้องการ Print");
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                                <table id="myTable1" class="table table-striped" style="width:100%">
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
                                                        $stmt = $conn->prepare("SELECT * FROM `store` WHERE status_receipt = 'yes' AND resDesc = 'success' AND receipt_cc = 'confirm'AND amount > 999.99 ORDER BY ref1 ASC;");
                                                        $stmt->execute();
                                                        $result = $stmt->fetchAll();
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
                                                                    <p class="mb-0 fw-normal"><?= $t1['id_receipt']; ?> </p>
                                                                </td>
                                                                <td>
                                                                    <p class="mb-0 fw-normal"><?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?></p>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <?php
                                                                        $profileImage = '';
                                                                        switch ($t1['items_set']) {
                                                                            case 'A':
                                                                                $profileImage = 'setA.png';
                                                                                break;
                                                                            case 'B':
                                                                                $profileImage = 'setB.png';
                                                                                break;
                                                                            case 'C':
                                                                                $profileImage = 'setC.png';
                                                                                break;
                                                                            default:
                                                                                $profileImage = 'setA.png';
                                                                                break;
                                                                        }
                                                                        ?>
                                                                        <img src="../assets/images/souvenir/<?= $profileImage ?>" class="rounded-circle" width="40" height="40">
                                                                        <div class="ms-3">
                                                                            <h6 class="fs-4 fw-semibold mb-0"><?= $t1['items_set']; ?></h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="mb-0 fw-normal">
                                                                    <?php
                                                                    if ($t1['items'] == 1) {
                                                                        echo '<span class="badge text-bg-info fs-2 rounded-4 py-1 px-2">รอดำเนินการ</span>';
                                                                    } elseif ($t1['items'] == 2) {
                                                                        echo '<span class="badge text-bg-success fs-2 rounded-4 py-1 px-2">จัดส่งแล้ว</span>';
                                                                    } elseif ($t1['items'] == 3) {
                                                                        echo '<span class="badge text-bg-danger fs-2 rounded-4 py-1 px-2">ยกเลิกการจัดส่ง</span>';
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
                                                        } ?>
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

                                            <div class="tab-pane show" id="warning" role="tabpanel">
                                                <div class="text-end md-3">
                                                    <button class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" id="printButtonform2">
                                                        <i class="ti ti-printer fs-5"></i>
                                                    </button>
                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function() {
                                                            var table = document.getElementById("myTable2");
                                                            var checkboxes = table.querySelectorAll(".form-check-input");
                                                            var printButtonform2 = document.getElementById("printButtonform2");

                                                            checkboxes.forEach(function(checkbox) {
                                                                checkbox.addEventListener("change", function() {
                                                                    handleCheckboxChange();
                                                                });
                                                            });

                                                            printButtonform2.addEventListener("click", function() {
                                                                handlePrintButtonClick();
                                                            });
                                                        });

                                                        function handleCheckboxChange() {
                                                            // Add any necessary logic for checkbox change
                                                        }

                                                        function handlePrintButtonClick() {
                                                            var selectedIds = [];
                                                            var checkboxes = document.querySelectorAll(".form-check-input:checked");
                                                            checkboxes.forEach(function(checkbox) {
                                                                selectedIds.push(checkbox.value);
                                                            });

                                                            if (selectedIds.length > 0) {
                                                                var printWindow = window.open("about:blank", '_blank');
                                                                printWindow.location.href = "order_confirm.php?selectedIds=" + selectedIds.join(",") + "&ACTION=VIEW";
                                                            } else {
                                                                alert("กรุณาเลือกข้อมูลที่ต้องการ Print");
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                                <table id="myTable2" class="table table-striped" style="width:100%">
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
                                                        $stmt = $conn->prepare("SELECT * FROM `store` WHERE status_receipt = 'yes' AND resDesc = 'success' AND receipt_cc = 'confirm'AND items = '1' AND amount > 999.99 ORDER BY ref1 ASC;");
                                                        $stmt->execute();
                                                        $result = $stmt->fetchAll();
                                                        $countrow = 1;
                                                        foreach ($result as $t1) {
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <h6 class="fw-semibold mb-0"><?= $countrow ?></h6>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="<?= $t1['receipt_id']; ?>" id="checkbox<?= $t1['receipt_id']; ?>">
                                                                        <label class="form-check-label" for="checkbox<?= $countrow ?>"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p class="mb-0 fw-normal"><?= $t1['id_receipt']; ?> </p>
                                                                </td>
                                                                <td>
                                                                    <p class="mb-0 fw-normal"><?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?></p>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <?php
                                                                        $profileImage = '';
                                                                        switch ($t1['items_set']) {
                                                                            case 'A':
                                                                                $profileImage = 'setA.png';
                                                                                break;
                                                                            case 'B':
                                                                                $profileImage = 'setB.png';
                                                                                break;
                                                                            case 'C':
                                                                                $profileImage = 'setC.png';
                                                                                break;
                                                                            default:
                                                                                $profileImage = 'setA.png';
                                                                                break;
                                                                        }
                                                                        ?>
                                                                        <img src="../assets/images/souvenir/<?= $profileImage ?>" class="rounded-circle" width="40" height="40">
                                                                        <div class="ms-3">
                                                                            <h6 class="fs-4 fw-semibold mb-0"><?= $t1['items_set']; ?></h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="mb-0 fw-normal">
                                                                    <?php
                                                                    if ($t1['items'] == 1) {
                                                                        echo '<span class="badge text-bg-info fs-2 rounded-4 py-1 px-2">รอดำเนินการ</span>';
                                                                    } elseif ($t1['items'] == 2) {
                                                                        echo '<span class="badge text-bg-success fs-2 rounded-4 py-1 px-2">จัดส่งแล้ว</span>';
                                                                    } elseif ($t1['items'] == 3) {
                                                                        echo '<span class="badge text-bg-danger fs-2 rounded-4 py-1 px-2">ยกเลิกการจัดส่ง</span>';
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
                                                        } ?>
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

                                            <div class="tab-pane show" id="success" role="tabpanel">
                                                <div class="text-end md-3">
                                                    <button class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" id="printButtonform2">
                                                        <i class="ti ti-printer fs-5"></i>
                                                    </button>
                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function() {
                                                            var table = document.getElementById("myTable3");
                                                            var checkboxes = table.querySelectorAll(".form-check-input");
                                                            var printButtonform3 = document.getElementById("printButtonform3");

                                                            checkboxes.forEach(function(checkbox) {
                                                                checkbox.addEventListener("change", function() {
                                                                    handleCheckboxChange();
                                                                });
                                                            });

                                                            printButtonform3.addEventListener("click", function() {
                                                                handlePrintButtonClick();
                                                            });
                                                        });

                                                        function handleCheckboxChange() {
                                                            // Add any necessary logic for checkbox change
                                                        }

                                                        function handlePrintButtonClick() {
                                                            var selectedIds = [];
                                                            var checkboxes = document.querySelectorAll(".form-check-input:checked");
                                                            checkboxes.forEach(function(checkbox) {
                                                                selectedIds.push(checkbox.value);
                                                            });

                                                            if (selectedIds.length > 0) {
                                                                var printWindow = window.open("about:blank", '_blank');
                                                                printWindow.location.href = "order_confirm.php?selectedIds=" + selectedIds.join(",") + "&ACTION=VIEW";
                                                            } else {
                                                                alert("กรุณาเลือกข้อมูลที่ต้องการ Print");
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                                <table id="myTable3" class="table table-striped" style="width:100%">
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
                                                        $stmt = $conn->prepare("SELECT * FROM `store` WHERE status_receipt = 'yes' AND resDesc = 'success' AND receipt_cc = 'confirm'AND items = '2' AND amount > 999.99 ORDER BY ref1 ASC;");
                                                        $stmt->execute();
                                                        $result = $stmt->fetchAll();
                                                        $countrow = 1;
                                                        foreach ($result as $t1) {
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <h6 class="fw-semibold mb-0"><?= $countrow ?></h6>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="<?= $t1['receipt_id']; ?>" id="checkbox<?= $t1['receipt_id']; ?>">
                                                                        <label class="form-check-label" for="checkbox<?= $countrow ?>"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p class="mb-0 fw-normal"><?= $t1['id_receipt']; ?> </p>
                                                                </td>
                                                                <td>
                                                                    <p class="mb-0 fw-normal"><?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?></p>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <?php
                                                                        $profileImage = '';
                                                                        switch ($t1['items_set']) {
                                                                            case 'A':
                                                                                $profileImage = 'setA.png';
                                                                                break;
                                                                            case 'B':
                                                                                $profileImage = 'setB.png';
                                                                                break;
                                                                            case 'C':
                                                                                $profileImage = 'setC.png';
                                                                                break;
                                                                            default:
                                                                                $profileImage = 'setA.png';
                                                                                break;
                                                                        }
                                                                        ?>
                                                                        <img src="../assets/images/souvenir/<?= $profileImage ?>" class="rounded-circle" width="40" height="40">
                                                                        <div class="ms-3">
                                                                            <h6 class="fs-4 fw-semibold mb-0"><?= $t1['items_set']; ?></h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="mb-0 fw-normal">
                                                                    <?php
                                                                    if ($t1['items'] == 1) {
                                                                        echo '<span class="badge text-bg-info fs-2 rounded-4 py-1 px-2">รอดำเนินการ</span>';
                                                                    } elseif ($t1['items'] == 2) {
                                                                        echo '<span class="badge text-bg-success fs-2 rounded-4 py-1 px-2">จัดส่งแล้ว</span>';
                                                                    } elseif ($t1['items'] == 3) {
                                                                        echo '<span class="badge text-bg-danger fs-2 rounded-4 py-1 px-2">ยกเลิกการจัดส่ง</span>';
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
                                                        } ?>
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

                                            <div class="tab-pane show" id="danger" role="tabpanel">
                                                <div class="text-end md-3">
                                                    <button class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" id="printButtonform4">
                                                        <i class="ti ti-printer fs-5"></i>
                                                    </button>
                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function() {
                                                            var table = document.getElementById("myTable4");
                                                            var checkboxes = table.querySelectorAll(".form-check-input");
                                                            var printButtonform4 = document.getElementById("printButtonform4");

                                                            checkboxes.forEach(function(checkbox) {
                                                                checkbox.addEventListener("change", function() {
                                                                    handleCheckboxChange();
                                                                });
                                                            });

                                                            printButtonform4.addEventListener("click", function() {
                                                                handlePrintButtonClick();
                                                            });
                                                        });

                                                        function handleCheckboxChange() {
                                                            // Add any necessary logic for checkbox change
                                                        }

                                                        function handlePrintButtonClick() {
                                                            var selectedIds = [];
                                                            var checkboxes = document.querySelectorAll(".form-check-input:checked");
                                                            checkboxes.forEach(function(checkbox) {
                                                                selectedIds.push(checkbox.value);
                                                            });

                                                            if (selectedIds.length > 0) {
                                                                var printWindow = window.open("about:blank", '_blank');
                                                                printWindow.location.href = "order_confirm.php?selectedIds=" + selectedIds.join(",") + "&ACTION=VIEW";
                                                            } else {
                                                                alert("กรุณาเลือกข้อมูลที่ต้องการ Print");
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                                <table id="myTable4" class="table table-striped" style="width:100%">
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
                                                        $stmt = $conn->prepare("SELECT * FROM `store` WHERE status_receipt = 'yes' AND resDesc = 'success' AND receipt_cc = 'confirm'AND items = '3' AND amount > 999.99 ORDER BY ref1 ASC;");
                                                        $stmt->execute();
                                                        $result = $stmt->fetchAll();
                                                        $countrow = 1;
                                                        foreach ($result as $t1) {
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <h6 class="fw-semibold mb-0"><?= $countrow ?></h6>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="<?= $t1['receipt_id']; ?>" id="checkbox<?= $t1['receipt_id']; ?>">
                                                                        <label class="form-check-label" for="checkbox<?= $countrow ?>"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p class="mb-0 fw-normal"><?= $t1['id_receipt']; ?> </p>
                                                                </td>
                                                                <td>
                                                                    <p class="mb-0 fw-normal"><?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?></p>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <?php
                                                                        $profileImage = '';
                                                                        switch ($t1['items_set']) {
                                                                            case 'A':
                                                                                $profileImage = 'setA.png';
                                                                                break;
                                                                            case 'B':
                                                                                $profileImage = 'setB.png';
                                                                                break;
                                                                            case 'C':
                                                                                $profileImage = 'setC.png';
                                                                                break;
                                                                            default:
                                                                                $profileImage = 'setA.png';
                                                                                break;
                                                                        }
                                                                        ?>
                                                                        <img src="../assets/images/souvenir/<?= $profileImage ?>" class="rounded-circle" width="40" height="40">
                                                                        <div class="ms-3">
                                                                            <h6 class="fs-4 fw-semibold mb-0"><?= $t1['items_set']; ?></h6>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="mb-0 fw-normal">
                                                                    <?php
                                                                    if ($t1['items'] == 1) {
                                                                        echo '<span class="badge text-bg-info fs-2 rounded-4 py-1 px-2">รอดำเนินการ</span>';
                                                                    } elseif ($t1['items'] == 2) {
                                                                        echo '<span class="badge text-bg-success fs-2 rounded-4 py-1 px-2">จัดส่งแล้ว</span>';
                                                                    } elseif ($t1['items'] == 3) {
                                                                        echo '<span class="badge text-bg-danger fs-2 rounded-4 py-1 px-2">ยกเลิกการจัดส่ง</span>';
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
                                                        } ?>
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

                                        <?php foreach ($result as $t1) { ?>
                                            <div class="modal fade" id="transferModal<?= $t1['receipt_id']; ?>" tabindex="-1" aria-labelledby="transferModalLabel<?= $t1['receipt_id']; ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="transferModalLabel<?= $t1['receipt_id']; ?>">
                                                                รายละเอียดการจัดส่ง</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var detailsLinks = document.querySelectorAll('.details-link');

                                                detailsLinks.forEach(function(link) {
                                                    link.addEventListener('click', function() {
                                                        var receiptId = link.getAttribute('data-receipt-id');
                                                        var modalBody = document.querySelector('#transferModal' + receiptId + ' .modal-body');

                                                        // ดึงข้อมูลจาก data_order.php โดยใช้ AJAX
                                                        var xhr = new XMLHttpRequest();
                                                        xhr.open('GET', 'data_order.php?receipt_id=' + receiptId, true);

                                                        xhr.onreadystatechange = function() {
                                                            if (xhr.readyState === 4 && xhr.status === 200) {
                                                                // นำข้อมูลที่ได้มาแสดงใน modal
                                                                modalBody.innerHTML = xhr.responseText;
                                                            }
                                                        };

                                                        xhr.send();
                                                    });
                                                });
                                            });
                                        </script>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var tabs = document.querySelectorAll('.nav-link');
                                                tabs.forEach(function(tab) {
                                                    tab.addEventListener('click', function() {
                                                        clearFormCheckInputs();
                                                    });
                                                });

                                                function clearFormCheckInputs() {
                                                    var checkboxes = document.querySelectorAll('.form-check-input');
                                                    checkboxes.forEach(function(checkbox) {
                                                        checkbox.checked = false;
                                                    });
                                                }
                                            });
                                        </script>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <script>
        $(document).ready(function() {
            $("#myTable1").DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#myTable2").DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#myTable3").DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#myTable4").DataTable();
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