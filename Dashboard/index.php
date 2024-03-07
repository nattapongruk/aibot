<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
              
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                       
                    </div>

                    <!-- Content Row -->
                    

                    <div class="row">

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Earnings (Monthly)</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        // เชื่อมต่อฐานข้อมูล
                                                        include('connect.php'); 

                                                        $month = date("m");
                                                        $year = date("Y");
                                    
                                                        $sql = "SELECT SUM(total) AS total_earnings FROM payment WHERE MONTH(payment_date) = $month AND YEAR(payment_date) = $year AND status = 'paid'";
                                                        $result = $conn->query($sql);

                                                        if ($result->num_rows > 0) {
                                                            while($row = $result->fetch_assoc()) {
                                                                $total_earnings = $row["total_earnings"];
                                                                // แสดงผลลัพธ์
                                                                echo '$' . number_format($total_earnings);
                                                            }
                                                        } else {
                                                            echo "$0";
                                                        }
                                                        $conn->close();
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Earnings (Annual)</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        // เชื่อมต่อฐานข้อมูล
                                                        include('connect.php'); 

                                                        // ดึงข้อมูล total ที่ status = paid ของปีปัจจุบัน ที่ตาราง payment
                                                        $year = date("Y");

                                                        $sql = "SELECT SUM(total) AS total_earnings FROM payment WHERE YEAR(payment_date) = $year AND status = 'paid'";
                                                        $result = $conn->query($sql);

                                                        if ($result->num_rows > 0) {
                                                            while($row = $result->fetch_assoc()) {
                                                                $total_earnings = $row["total_earnings"];
                                                                // แสดงผลลัพธ์
                                                                echo '$' . number_format($total_earnings);
                                                            }
                                                        } else {
                                                            echo "$0";
                                                        }
                                                        $conn->close();
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Number of members
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                <?php
                                                                    // เชื่อมต่อฐานข้อมูล
                                                                    include('connect.php'); 


                                                                    $sql = "SELECT count(portnumber) AS total_users FROM infouser WHERE portnumber ";
                                                                    $result = $conn->query($sql);

                                                                    if ($result->num_rows > 0) {
                                                                        while($row = $result->fetch_assoc()) {
                                                                            $total_users  = $row["total_users"];
                                                                            // แสดงผลลัพธ์
                                                                            echo number_format($total_users );
                                                                        }
                                                                    } else {
                                                                        echo "0 คน";
                                                                    }
                                                                    $conn->close();
                                                                    ?>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col">
                                                            <div class="progress progress-sm mr-2">
                                                                <div class="progress-bar bg-info" role="progressbar"
                                                                    style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <!-- <div class="col-auto">
                                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <?php
                        include('connect.php'); 

                        $sql = "SELECT MONTH(payment_date) AS month, SUM(total) AS total_earnings 
                                FROM payment 
                                WHERE status = 'paid' 
                                GROUP BY MONTH(payment_date)";
                        $result = $conn->query($sql);

                        $months = [];
                        $earnings = [];
                        while ($row = $result->fetch_assoc()) {
                            $months[] = date('M', mktime(0, 0, 0, $row['month'], 1));
                            $earnings[] = $row['total_earnings'];
                        }
                        ?>

                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart1"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>                           

                        <script>
                            // Area Chart Example
                            var ctx = document.getElementById("myAreaChart1");
                            var myLineChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: <?php echo json_encode($months); ?>,
                                    datasets: [{
                                        label: "Earnings",
                                        lineTension: 0.3,
                                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                                        borderColor: "rgba(78, 115, 223, 1)",
                                        pointRadius: 3,
                                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                        pointBorderColor: "rgba(78, 115, 223, 1)",
                                        pointHoverRadius: 3,
                                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                        pointHitRadius: 10,
                                        pointBorderWidth: 2,
                                        data: <?php echo json_encode($earnings); ?>,
                                    }],
                                },
                                options: {
                                    maintainAspectRatio: false,
                                    layout: {
                                        padding: {
                                            left: 10,
                                            right: 25,
                                            top: 25,
                                            bottom: 0
                                        }
                                    },
                                    scales: {
                                        xAxes: [{
                                            time: {
                                                unit: 'date'
                                            },
                                            gridLines: {
                                                display: false,
                                                drawBorder: false
                                            },
                                            ticks: {
                                                maxTicksLimit: 7
                                            }
                                        }],
                                        yAxes: [{
                                            ticks: {
                                                maxTicksLimit: 5,
                                                padding: 10,
                                                // Include a dollar sign in the ticks
                                                callback: function(value, index, values) {
                                                    return '$' + number_format(value);
                                                }
                                            },
                                            gridLines: {
                                                color: "rgb(234, 236, 244)",
                                                zeroLineColor: "rgb(234, 236, 244)",
                                                drawBorder: false,
                                                borderDash: [2],
                                                zeroLineBorderDash: [2]
                                            }
                                        }],
                                    },
                                    legend: {
                                        display: false
                                    },
                                    tooltips: {
                                        backgroundColor: "rgb(255,255,255)",
                                        bodyFontColor: "#858796",
                                        titleMarginBottom: 10,
                                        titleFontColor: '#6e707e',
                                        titleFontSize: 14,
                                        borderColor: '#dddfeb',
                                        borderWidth: 1,
                                        xPadding: 15,
                                        yPadding: 15,
                                        displayColors: false,
                                        intersect: false,
                                        mode: 'index',
                                        caretPadding: 10,
                                        callbacks: {
                                            label: function(tooltipItem, chart) {
                                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                                return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                                            }
                                        }
                                    }
                                }
                            });
                        </script>

                        <?php
                        // Close MySQL database connection
                        $conn->close();
                        ?>

                        <?php
                            include('connect.php'); 

                            $sql = "SELECT status, COUNT(payment_id) AS count FROM payment GROUP BY status";
                            $result = $conn->query($sql);

                            $status_counts = [];
                            while ($row = $result->fetch_assoc()) {
                                $status_counts[$row['status']] = $row['count'];
                            }

                            // คำนวณเปอร์เซ็นต์ของสถานะการชำระเงิน
                            $total = array_sum($status_counts);
                            $percentages = [];
                            foreach ($status_counts as $status => $count) {
                                $percentages[$status] = ($count / $total) * 100;
                            }

                            // สร้างข้อมูลสำหรับ Pie Chart
                            $labels = array_keys($percentages);
                            $data = array_values($percentages);
                           
                            $backgroundColors = ['grey', '#1cc88a', 'orange']; // สีพื้นหลังของ Pie Chart
                            $hoverBackgroundColors = ['#2e59d9', '#17a673', '#2c9faf']; // สีเมื่อโฮเวอร์
                            ?>

                            <div class="col-xl-4 col-lg-5">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Payment status</h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">Dropdown Header:</div>
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-pie pt-4 pb-2">
                                            <!-- สร้าง Canvas สำหรับ Pie Chart -->
                                            <canvas id="myPieChart1"></canvas>
                                        </div>
                                        <div class="mt-4 text-center small">
                                            <!-- แสดงข้อมูลสัดส่วนแต่ละส่วน -->
                                           
                                            <div class="mt-4 text-center small">
                                            <!-- แสดงข้อมูลสัดส่วนและตัวเลขแต่ละส่วน -->
                                            <?php foreach ($labels as $index => $label): ?>
                                                <span class="mr-2">
                                                    <i class="fas fa-circle" style="color: <?php echo $backgroundColors[$index]; ?>"></i>
                                                    <?php echo $label; ?>: <?php echo round($data[$index], 2); ?>%
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>                           
                            <script>
                                // สร้าง Pie Chart โดยใช้ JavaScript
                                var ctx = document.getElementById("myPieChart1").getContext('2d');
                                var myPieChart = new Chart(ctx, {
                                    type: 'doughnut',
                                    data: {
                                        labels: <?php echo json_encode($labels); ?>,
                                        datasets: [{
                                            data: <?php echo json_encode($data); ?>,
                                            backgroundColor: <?php echo json_encode($backgroundColors); ?>,
                                            hoverBackgroundColor: <?php echo json_encode($hoverBackgroundColors); ?>,
                                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                                        }],
                                    },
                                    options: {
                                        maintainAspectRatio: false,
                                        tooltips: {
                                            backgroundColor: "rgb(255,255,255)",
                                            bodyFontColor: "#858796",
                                            borderColor: '#dddfeb',
                                            borderWidth: 1,
                                            xPadding: 15,
                                            yPadding: 15,
                                            displayColors: false,
                                            caretPadding: 10,
                                        },
                                        legend: {
                                            display: false
                                        },
                                        cutoutPercentage: 80,
                                    },
                                });
                            </script>

                            <?php
                            // ปิดการเชื่อมต่อฐานข้อมูล MySQL
                            $conn->close();
                            ?>
                        <!-- Pie Chart -->
                      
                  
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                           
                            <!-- Color System -->
                           

                        </div>

                        <div class="col-lg-6 mb-4">

                       

                            <!-- Approach -->
                      

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
         
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
   

</body>

</html>