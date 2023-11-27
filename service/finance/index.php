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
                    <?php
                    require_once 'conf/connection.php';
                    $stmt05 = $conn->prepare("SELECT COUNT(*) AS total_records05, SUM(amount) AS total_amount05 FROM receipt WHERE edo_pro_id = 121205 AND receipt_cc = 'confirm'");
                    $stmt05->execute();
                    $result05 = $stmt05->fetch();

                    $stmt06 = $conn->prepare("SELECT COUNT(*) AS total_records06, SUM(amount) AS total_amount06 FROM receipt WHERE edo_pro_id = 121206 AND receipt_cc = 'confirm'");
                    $stmt06->execute();
                    $result06 = $stmt06->fetch();

                    $stmt07 = $conn->prepare("SELECT COUNT(*) AS total_records07, SUM(amount) AS total_amount07 FROM receipt WHERE edo_pro_id = 121207 AND receipt_cc = 'confirm'");
                    $stmt07->execute();
                    $result07 = $stmt07->fetch();

                    $stmt08 = $conn->prepare("SELECT COUNT(*) AS total_records08, SUM(amount) AS total_amount08 FROM receipt WHERE edo_pro_id = 121208 AND receipt_cc = 'confirm'");
                    $stmt08->execute();
                    $result08 = $stmt08->fetch();

                    ?>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-8">
                                        <h5 class="card-title mb-12 fw-semibold"> บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษา </h5>
                                        <h6 class="fw-semibold mb-3"><?php echo number_format($result05['total_amount05'], 2); ?> บาท | <?php echo $result05['total_records05']; ?> ราย</h6>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            <div class="text-white bg-primary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-8">
                                        <h5 class="card-title mb-12 fw-semibold"> บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่ </h5>
                                        <h6 class="fw-semibold mb-3"><?php echo number_format($result06['total_amount06'], 2); ?> บาท | <?php echo $result06['total_records06']; ?> ราย</h6>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            <div class="text-white bg-dark rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-8">
                                        <h5 class="card-title mb-12 fw-semibold"> บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น </h5>
                                        <h6 class="fw-semibold mb-3"><?php echo number_format($result07['total_amount07'], 2); ?> บาท | <?php echo $result07['total_records07']; ?> ราย</h6>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            <div class="text-white bg-success rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-8">
                                        <h5 class="card-title mb-12 fw-semibold"> โครงการบริจาคเพิ่มเติม </h5>
                                        <h6 class="fw-semibold mb-3"><?php echo number_format($result08['total_amount08'], 2); ?> บาท | <?php echo $result08['total_records08']; ?> ราย</h6>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            <div class="text-white bg-warning rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $sqlRecordsoffline = "SELECT COUNT(*) AS total_records_offline FROM receipt WHERE status_donat = 'offline' AND receipt_cc = 'confirm'";
                    $stmtRecordsoffline = $conn->prepare($sqlRecordsoffline);
                    $stmtRecordsoffline->execute();
                    $resultRecordsoffline = $stmtRecordsoffline->fetch();

                    $sqlRecordsonline = "SELECT COUNT(*) AS total_records_online FROM receipt WHERE status_donat = 'online' AND receipt_cc = 'confirm'";
                    $stmtRecordsonline = $conn->prepare($sqlRecordsonline);
                    $stmtRecordsonline->execute();
                    $resultRecordsonline = $stmtRecordsonline->fetch();

                    $sqltotal_records = "SELECT COUNT(*) AS total_records FROM receipt WHERE receipt_cc = 'confirm'";
                    $stmttotal_records = $conn->prepare($sqltotal_records);
                    $stmttotal_records->execute();
                    $resulttotal_records = $stmttotal_records->fetch();

                    $sqltotal_amountsum = "SELECT SUM(amount) AS total_amountsum FROM receipt WHERE receipt_cc = 'confirm'";
                    $stmttotal_amountsum = $conn->prepare($sqltotal_amountsum);
                    $stmttotal_amountsum->execute();
                    $resulttotal_amountsum = $stmttotal_amountsum->fetch();
                    ?>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-8">
                                        <h5 class="card-title mb-12 fw-semibold"> บริจากผ่านช่องทางบุคลากร </h5>
                                        <h6 class="fw-semibold mb-3"><?php echo $resultRecordsoffline['total_records_offline']; ?> ราย</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-8">
                                        <h5 class="card-title mb-12 fw-semibold"> บริจากผ่านช่องทาง QE-Code </h5>
                                        <h6 class="fw-semibold mb-3"><?php echo $resultRecordsonline['total_records_online']; ?> ราย</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-8">
                                        <h5 class="card-title mb-12 fw-semibold"> รวมผู้บริจาคทั้งหมด </h5>
                                        <h6 class="fw-semibold mb-3"><?php echo $resulttotal_records['total_records']; ?> ราย</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-8">
                                        <h5 class="card-title mb-12 fw-semibold"> รวมยอดเงินทั้งหมด </h5>
                                        <h6 class="fw-semibold mb-3"><?php echo number_format($resulttotal_amountsum['total_amountsum'], 2); ?> บาท</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                    <div class="mb-3 mb-sm-0">
                                        <h5 class="card-title fw-semibold">กราฟแสดงยอดเงินแต่ละเดือน</h5>
                                    </div>
                                </div>
                                <div id="chart"></div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3" style="position: relative;">
                                            <div style="position: absolute; width: 12px; height: 12px; background-color: #5D87FF; border-radius: 50%; left: -18px; top: 50%; transform: translateY(-50%);"></div>
                                            <h6 class="mb-0 fw-normal" style="padding-left: 10px;">121205 บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3" style="position: relative;">
                                            <div style="position: absolute; width: 12px; height: 12px; background-color: #2A3547; border-radius: 50%; left: -18px; top: 50%; transform: translateY(-50%);"></div>
                                            <h6 class="mb-0 fw-normal" style="padding-left: 10px;">121206 บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3" style="position: relative;">
                                            <div style="position: absolute; width: 12px; height: 12px; background-color: #13DEB9; border-radius: 50%; left: -18px; top: 50%; transform: translateY(-50%);"></div>
                                            <h6 class="mb-0 fw-normal" style="padding-left: 10px;">121207 บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น ๆ</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3" style="position: relative;">
                                            <div style="position: absolute; width: 12px; height: 12px; background-color: #FA896B; border-radius: 50%; left: -18px; top: 50%; transform: translateY(-50%);"></div>
                                            <h6 class="mb-0 fw-normal" style="padding-left: 10px;">121208 โครงการบริจาคเพิ่มเติม</h6>
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