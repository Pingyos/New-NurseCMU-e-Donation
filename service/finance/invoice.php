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
                                <div class="row">
                                    <div class="col-lg-4 d-flex align-items-stretch">
                                        <div class="card w-100">
                                            <div class="card-body p-4">
                                                <div class="table-responsive">
                                                    <?php
                                                    require_once 'conf/connection.php';
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
                                                        <ul class="invoice-users">
                                                            <li>
                                                                <a href="javascript:void(0);" onclick="openDetails('<?= $t1['receipt_id']; ?>', '<?= $t1['ref1']; ?>')" class="p-3 bg-hover-light-black border-bottom d-flex align-items-start invoice-user listing-user">
                                                                    <?php
                                                                    if ($t1['status_donat'] === "offline") {
                                                                    ?>
                                                                        <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                                            </svg>
                                                                        </div>
                                                                    <?php
                                                                    } elseif ($t1['status_donat'] === "online") {
                                                                    ?>
                                                                        <div class="text-white bg-danger rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-app-window" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                                <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                                                                <path d="M6 8h.01" />
                                                                                <path d="M9 8h.01" />
                                                                            </svg>
                                                                        </div>
                                                                    <?php
                                                                    } else {
                                                                        echo "Invalid status_donat value";
                                                                    }
                                                                    ?>
                                                                    <div class="ms-3 d-inline-block w-75">
                                                                        <h6 class="mb-0 invoice-customer"><?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?></h6>
                                                                        <span class="fs-3 invoice-id text-truncate text-body-color d-block w-85"><?= $t1['id_receipt']; ?></span>
                                                                        <span class="fs-3 invoice-date text-nowrap text-body-color d-block"><?= thai_date($t1['rec_date_out']); ?></span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    <?php } ?>
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

                                    <div class="col-lg-8 d-flex align-items-stretch">
                                        <div class="card w-100">
                                            <div class="card-body p-4">
                                                <div class="table-responsive">
                                                    <div class="invoice-header d-flex align-items-center border-bottom p-3">
                                                        <h4 class="font-medium text-uppercase mb-0">รายละเอียดใบเสร็จ</h4>
                                                    </div>
                                                    <?php foreach ($result as $t1) { ?>
                                                        <div class="modal fade" id="transferModal<?= $t1['receipt_id']; ?>" tabindex="-1" aria-labelledby="transferModalLabel<?= $t1['receipt_id']; ?>" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="transferModalLabel<?= $t1['receipt_id']; ?>">รายละเอียดการโอน</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body"></div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div id="pdfViewer">
                                                        <?php
                                                        if (isset($_GET['receipt_id'])) {
                                                            $receipt_id = $_GET['receipt_id'];
                                                            $pdf_path = "path/to/pdf/{$receipt_id}.pdf";
                                                            if (file_exists($pdf_path)) {
                                                        ?>
                                                                <iframe src="<?= $pdf_path; ?>" width="100%" height="600" style="border: none;"></iframe>
                                                        <?php
                                                            } else {
                                                                echo "ไม่พบไฟล์ PDF";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php
                                function thai_date($date)
                                {
                                    $months = [
                                        'ม.ค', 'ก.พ', 'มี.ค', 'เม.ย', 'พ.ค', 'มิ.ย',
                                        'ก.ค', 'ส.ค', 'ก.ย', 'ต.ค', 'พ.ย', 'ธ.ค'
                                    ];

                                    $timestamp = strtotime($date);
                                    $thai_year = date(' Y', $timestamp) + 543;
                                    $thai_date = date('j ', $timestamp) . $months[date('n', $timestamp) - 1] . ' ' . $thai_year;

                                    return $thai_date;
                                }

                                ?>
                                <script>
                                    function openDetails(receiptId, ref1) {
                                        openPDF(receiptId);
                                    }

                                    function openPDF(receiptId) {
                                        var pdfURL = "invoice_confirm.php?receipt_id=" + receiptId + "&ACTION=VIEW";
                                        var pdfViewer = document.getElementById("pdfViewer");
                                        console.log(pdfViewer);
                                        var iframe = document.createElement("iframe");
                                        iframe.src = pdfURL;
                                        iframe.width = "100%";
                                        iframe.height = "1000";
                                        iframe.style.border = "none";
                                        pdfViewer.innerHTML = "";
                                        pdfViewer.appendChild(iframe);
                                        var statusDonatURL = 'get_status_donat.php?receipt_id=' + receiptId;
                                        fetch(statusDonatURL)
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.status_donat === 'online') {
                                                    var transferButton = document.createElement("button");
                                                    transferButton.className = "btn btn-danger";
                                                    transferButton.textContent = "รายละเอียดการโอน";
                                                    transferButton.onclick = function() {
                                                        openTransferModal(receiptId);
                                                    };

                                                    var textEndDiv = document.createElement("div");
                                                    textEndDiv.className = "text-end";
                                                    textEndDiv.appendChild(transferButton);
                                                    pdfViewer.appendChild(textEndDiv);
                                                } else {
                                                    console.log('Status_donat is not "online".');
                                                }
                                            })
                                            .catch(error => console.error('Error:', error));
                                    }

                                    function openTransferModal(receiptId) {
                                        $('#transferModal' + receiptId).modal('show');
                                        var modalBody = document.querySelector('#transferModal' + receiptId + ' .modal-body');
                                        var transferURL = 'paycheck.php?receipt_id=' + receiptId;
                                        fetch(transferURL)
                                            .then(response => response.text())
                                            .then(data => {
                                                modalBody.innerHTML = data;
                                            })
                                            .catch(error => console.error('Error:', error));
                                    }
                                </script>

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