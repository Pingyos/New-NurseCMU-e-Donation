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
                                                <a class="nav-link d-flex active" data-bs-toggle="tab" href="#home2" role="tab" aria-selected="true">
                                                    <span><i class="ti ti-home-2 fs-4"></i></span>
                                                    <span class="d-none d-md-block ms-2">Home</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link d-flex" data-bs-toggle="tab" href="#profile2" role="tab" aria-selected="false" tabindex="-1">
                                                    <span><i class="ti ti-user fs-4"></i></span>
                                                    <span class="d-none d-md-block ms-2">Profile</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link d-flex" data-bs-toggle="tab" href="#messages2" role="tab" aria-selected="false" tabindex="-1">
                                                    <span><i class="ri-chat-4-line"></i></span>
                                                    <span class="d-none d-md-block ms-2">Messages</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- Tab content -->
                                        <div class="tab-content">
                                            <div class="tab-pane active show" id="home2" role="tabpanel">
                                                <div class="text-end">
                                                    <button class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" id="printButton">
                                                        <i class="ti ti-printer fs-5"></i>
                                                    </button>
                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function() {
                                                            var table = document.getElementById("myTable");
                                                            var checkboxes = table.querySelectorAll(".form-check-input");
                                                            var printButton = document.getElementById("printButton");

                                                            checkboxes.forEach(function(checkbox) {
                                                                checkbox.addEventListener("change", function() {
                                                                    handleCheckboxChange();
                                                                });
                                                            });

                                                            printButton.addEventListener("click", function() {
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
                                                                printWindow.location.href = "invoice_confirm.php?selectedIds=" + selectedIds.join(",") + "&ACTION=VIEW";
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
                                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="<?php echo ($t1['status_user'] == 'corporation') ? 'update_user_corporation.php?user_id=' . $t1['user_id'] : 'update_user_person.php?user_id=' . $t1['user_id']; ?>">
                                                                                <i class="fs-4 ti ti-edit"></i>อัพเดทข้อมูล
                                                                            </a>

                                                                            <li>
                                                                                <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0);" onclick="confirmcancel('<?= $t1['user_id']; ?>')"><i class="fs-4 ti ti-trash"></i>ลบข้อมูล</a>
                                                                            </li>
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
                                            <div class="tab-pane p-3" id="profile2" role="tabpanel">
                                                <!-- Content for Profile tab -->
                                                <h3>Clean Tab ever</h3>
                                                <h4>you can use it with the small code</h4>
                                                <p>
                                                    Donec pede justo, fringilla vel, aliquet nec,
                                                    vulputate eget, arcu. In enim justo, rhoncus ut,
                                                    imperdiet a.
                                                </p>
                                            </div>
                                            <div class="tab-pane p-3" id="messages2" role="tabpanel">
                                                <!-- Content for Messages tab -->
                                                <h3>Best Tab ever</h3>
                                                <h4>you can use it with the small code</h4>
                                                <p>
                                                    Donec pede justo, fringilla vel, aliquet nec,
                                                    vulputate eget, arcu. In enim justo, rhoncus ut,
                                                    imperdiet a.
                                                </p>
                                            </div>
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