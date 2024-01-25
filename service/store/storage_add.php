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
                                <a class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" href="#" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-playlist-add" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M19 8h-14" />
                                        <path d="M5 12h9" />
                                        <path d="M11 16h-6" />
                                        <path d="M15 16h6" />
                                        <path d="M18 13v6" />
                                    </svg>เพิ่ม</i>
                                </a>

                                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addModalLabel">
                                                    เพิ่มของที่ระลึก</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="card-body">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อ</th>
                                            <th>จำนวน</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once 'conf/connection.php';
                                        $stmt = $conn->prepare("SELECT * FROM `storage`;
                                            ");
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
                                                    <p class="mb-0 fw-normal"><?= $t1['name']; ?></p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal"><?= $t1['items']; ?></p>
                                                </td>
                                                <td>
                                                    <div class="dropdown dropstart">
                                                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ti ti-dots-vertical fs-6"></i>
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item d-flex align-items-center gap-3 details-link" href="#" data-bs-toggle="modal" data-bs-target="#transferModal<?= $t1['id']; ?>" data-receipt-id="<?= $t1['id']; ?>">
                                                                <i class="fs-4 ti ti-edit"></i>อัพเดทสต๊อก
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
                                            <th>ชื่อ-สกุล</th>
                                            <th>ที่อยู่</th>
                                            <th>#</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <?php foreach ($result as $t1) { ?>
                                    <div class="modal fade" id="transferModal<?= $t1['id']; ?>" tabindex="-1" aria-labelledby="transferModalLabel<?= $t1['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="transferModalLabel<?= $t1['id']; ?>">
                                                        อัพเดทสต๊อก</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="card-body">
                                                    <form id="formadd" method="post" onsubmit="return confirmBeforeSubmit()">
                                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                                            <div class=" d-flex align-items-center justify-content-center" style="width: 210px; height: 210px;">
                                                                <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden" style="width: 200px; height: 200px;">
                                                                    <img src="../assets/images/souvenir/<?= $t1['img_file']; ?>" class="custom-block-image img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control" id="name" name="name" value="<?= $t1['name']; ?>">
                                                                    <label for="name">ชื่อของที่ระลึง</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating mb-3">
                                                                    <input type="number" class="form-control" id="items" name="items" value="<?= $t1['items']; ?>">
                                                                    <label for="items">จำนวนคงเหลือ</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating mb-3">
                                                                    <input type="number" class="form-control" id="min" name="min" value="<?= $t1['min']; ?>">
                                                                    <label for="min">บริจาค เริ่มต้น</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-floating mb-3">
                                                                    <input type="number" class="form-control" id="max" name="max" value="<?= $t1['max']; ?>">
                                                                    <label for="max">บริจาค มากสุด</label>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="items_set" id="items_set" value="<?= $t1['items_set']; ?>">
                                                            <input type="hidden" name="img_file" id="img_file" value="<?= $t1['img_file']; ?>">
                                                            <input type="hidden" name="dateCreate" id="dateCreate" value="<?= date('Y-m-d H:i:s'); ?>">
                                                            <input type="hidden" name="id" id="id" value="<?= $t1['id']; ?>">

                                                            <div class="col-12">
                                                                <div class="d-md-flex align-items-center">
                                                                    <div class="ms-auto mt-3 mt-md-0">
                                                                        <button type="button" class="btn btn-primary font-medium rounded-pill px-4" onclick="confirmBeforeSubmit()">
                                                                            <div class="d-flex align-items-center">
                                                                                บันทึกการอัพเดท
                                                                            </div>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

                                                    <script>
                                                        function confirmBeforeSubmit() {
                                                            swal({
                                                                    title: "คำเตือน",
                                                                    text: "คุณแน่ใจที่จะบันทึกการอัพเดทหรือไม่?",
                                                                    type: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#5d87ff",
                                                                    confirmButtonText: "ยืนยันการ",
                                                                    cancelButtonText: "เลิกทำ",
                                                                    closeOnConfirm: false
                                                                },
                                                                function(isConfirm) {
                                                                    if (isConfirm) {
                                                                        // Perform AJAX request to update data
                                                                        updateData();
                                                                    }
                                                                });
                                                        }

                                                        function updateData() {
                                                            // Extract data from the form
                                                            var formData = $("#formadd").serialize();
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "store_add.php",
                                                                data: formData,
                                                                dataType: "json",
                                                                success: function(response) {
                                                                    if (response.status === "success") {
                                                                        swal("สำเร็จ!", "บันทึกการอัพเดทเรียบร้อยแล้ว", "success");
                                                                    } else {
                                                                        swal("ผิดพลาด!", "เกิดข้อผิดพลาดในการอัพเดท: " + response.message, "error");
                                                                    }
                                                                },
                                                                error: function() {
                                                                    swal("ผิดพลาด!", "เกิดข้อผิดพลาดในการส่งคำขอ", "error");
                                                                }
                                                            });
                                                        }
                                                    </script>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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