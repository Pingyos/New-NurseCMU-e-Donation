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
                    $seta = $conn->prepare("SELECT items FROM storage WHERE name = 'Set A'");
                    $seta->execute();
                    $result = $seta->fetch();

                    $setb = $conn->prepare("SELECT items FROM storage WHERE name = 'Set B'");
                    $setb->execute();
                    $setb_result = $setb->fetch();

                    $setc = $conn->prepare("SELECT items FROM storage WHERE name = 'Set C'");
                    $setc->execute();
                    $setc_result = $setc->fetch();

                    $setd = $conn->prepare("SELECT items FROM storage WHERE name = 'Set D'");
                    $setd->execute();
                    $setd_result = $setd->fetch();
                    ?>
                    <div class="col-md-3">
                        <h5 class="card-title fw-semibold mb-4">Set A Griptok</h5>
                        <div class="card">
                            <img src="../assets/images/souvenir/setA.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $result['items'] ?> ชิ้น</h5>
                                <p class="card-text">บริจาค 1,000 บาทขั้นไป</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5 class="card-title fw-semibold mb-4">Set B จานรองแก้วเซรามิค</h5>
                        <div class="card">
                            <img src="../assets/images/souvenir/setB.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $setb_result['items'] ?> ชิ้น</h5>
                                <p class="card-text">บริจาค 3,000 บาทขั้นไป</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5 class="card-title fw-semibold mb-4">Set C ชุดเข็มกลัด</h5>
                        <div class="card">
                            <img src="../assets/images/souvenir/setC.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $setc_result['items'] ?> ชิ้น</h5>
                                <p class="card-text">บริจาค 100,000 บาทขั้นไป</p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-12 d-flex align-items-strech">
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
                    </div> -->

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