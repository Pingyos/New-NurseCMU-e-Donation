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
                                <a class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" href="storage_add.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-playlist-add" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M19 8h-14" />
                                        <path d="M5 12h9" />
                                        <path d="M11 16h-6" />
                                        <path d="M15 16h6" />
                                        <path d="M18 13v6" />
                                    </svg> เพิ่ม</i>
                                </a>
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
                                                        <p class="mb-0 fw-normal"><?= $t1['name']; ?> </p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 fw-normal"><?= $t1['items']; ?> </p>
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
                                                <th>ชื่อ-สกุล</th>
                                                <th>ที่อยู่</th>
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