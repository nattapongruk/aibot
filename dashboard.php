<?php
session_start();
if (!isset($_SESSION["portnumber"])) {
    header("location: login.php");
    exit();
}

include('connect.php'); // เชื่อมต่อกับฐานข้อมูล

// ตรวจสอบ role ของผู้ใช้จากฐานข้อมูล
$portnumber = $_SESSION["portnumber"];
$sql = "SELECT role FROM infouser WHERE portnumber = '$portnumber'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // ถ้าพบข้อมูลผู้ใช้
    $row = $result->fetch_assoc();
    $role = $row["role"];
    
    // ตรวจสอบว่า role เป็น admin หรือไม่
    if ($role !== "admin") {
        header("location: login.php");
        exit();
    }
} else {
    // ถ้าไม่พบข้อมูลผู้ใช้
    header("location: login.php");
    exit();
}

?>
<?php
include('connect.php');

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$portnumber = $_SESSION['portnumber'];
$sql = "SELECT profit_date, equity, balance FROM profit WHERE portnumber = '$portnumber'";
$result = $conn->query($sql);

// สร้างอาร์เรย์สำหรับเก็บข้อมูลที่ดึงมา
$chartData = array();
while ($row = $result->fetch_assoc()) {
    $chartData[] = array(
        'profit_date' => $row['profit_date'],
        'equity' => $row['equity'],
        'balance' => $row['balance']
    );
}
$sql = "SELECT portnumber, permission FROM infouser WHERE portnumber = '" . $_SESSION["portnumber"] . "'";
$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลในฐานข้อมูลหรือไม่
if ($result->num_rows > 0) {
    // วนลูปเพื่อดึงข้อมูลแต่ละแถว
    while($row = $result->fetch_assoc()) {
        $portnumber = $row["portnumber"];
        $permission = $row["permission"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@100..700&family=IBM+Plex+Sans+Thai&family=Prompt&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300&family=Prompt:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <script>
       window.addEventListener('scroll', function() {
    var sidebar = document.querySelector('.sidebar');
    var currentPosition = window.scrollY;
    if (currentPosition > 10) { // 100 เป็นค่าที่คุณสามารถปรับเปลี่ยนได้ตามความต้องการ
        sidebar.classList.add('hidden-sidebar');
    } else {
        sidebar.classList.remove('hidden-sidebar');
    }
});
    </script>
</head>
<body>
              
<div class="sidebar">
           

           <ul>    
           <li><a href="#"> <img src="img/logo3.png" alt="">   </a></li>
           <li> <a href="admin.php"><span> Admin</span></a></li>
           <li> <a href="dashboard.php"><span> Dashboard</span></a></li>
           
           </ul>

           <div class="account-info">
               <div class="profile-pic">
                       <img src="img/1.png" alt="Profile picture">
               </div>
                   
               <div class="user-details">
                               <p class="port-number">Port: <?php echo $portnumber; ?></p>
                               <?php
                               // ตรวจสอบค่าของ $permission เพื่อแสดงข้อความและสีตามเงื่อนไข
                               if ($permission == "ALLOW") {
                                   echo '<p class="status" style="color: #00FF00;">มีสิทธิเข้าใช้งาน</p>';
                               } elseif ($permission == "pending") {
                                   echo '<p class="status" style="color: #E1A12B;">รออนุมัติ</p>';
                               } elseif ($permission == "not allow") {
                                   echo '<p class="status" style="color: red;">ไม่มีสิทธิเข้าใช้งาน</p>';
                               } else {
                                   echo '<p class="status" style="color: white;">ไม่ทราบสถานะ</p>';
                               }
                               ?>
               </div>
               <div class="logoutbut">
                   <a href="logout.php" ><i class="fa-solid fa-arrow-right-from-bracket"></i> </a>
               </div>
           </div>
          
   </div>
   <div class="mobile_sidebar">
          

          <ul>    
           <li><a href="port.php"><span><i class="fa-solid fa-square-poll-vertical" style="color: #d17842;"></i></span></a></li>
           <li><a href="status.php"><span> <i class="fa-solid fa-square-check" style="color: #52555A;"></i></span></a></li>
           <li> <a href="homepage.php"><span> <i class="fa-solid fa-house" style="color: #52555A"></i></span></a></li>
           <li><a href="download.php"><span class="dl"><i class="fa-solid fa-circle-down" style="color: #52555A;"></i></span></i></a></li>
           <li><a href="payment.php"><span><i class="fa-solid fa-file-invoice-dollar" style="color: #52555A;"></i></span></i></a></li>
          </ul>

          
         
  </div>
   <div class="content">
       <div class="mobile_mode">
          <a href=""><img src="img/logo3.png" alt=""></a> 
           <div class="account-info">
               <div class="profile-pic">
                       <img src="img/1.png" alt="Profile picture">
               </div>
                   
               <div class="user-details">
                               <p class="port-number">Port: <?php echo $portnumber; ?></p>
                               <?php
                               // ตรวจสอบค่าของ $permission เพื่อแสดงข้อความและสีตามเงื่อนไข
                               if ($permission == "ALLOW") {
                                   echo '<p class="status" style="color: #00FF00;">มีสิทธิเข้าใช้งาน</p>';
                               } elseif ($permission == "pending") {
                                   echo '<p class="status" style="color: #E1A12B;">รออนุมัติ</p>';
                               } elseif ($permission == "not allow") {
                                   echo '<p class="status" style="color: red;">ไม่มีสิทธิเข้าใช้งาน</p>';
                               } else {
                                   echo '<p class="status" style="color: white;">ไม่ทราบสถานะ</p>';
                               }
                               ?>
               </div>
               <div class="logoutbut">
                   <a href="logout.php" ><i class="fa-solid fa-arrow-right-from-bracket"></i> </a>
               </div>
          </div>
      
       </div>
   

           




<!-- Page Wrapper -->

    <!-- Sidebar -->
   
    <!-- End of Sidebar -->

  
   

        <!-- Main Content -->
        <div id="content">  
           
            <div class="box">

        
                <div class="container-fluid">

                    <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="abc">Dashboard</h1>
                    
                </div>

                    <!-- Content Row -->
                    

                <div class="row">


                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                       
                                                <div class="col mr-2">
                                                    
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Earnings (Monthly)</div>
                                                    <div class="font-info1">
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
                                                        Earnings Total</div>
                                                    <div class="font-info1">
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
                                                            <div class="font-info1">
                                                                <?php
                                                                    // เชื่อมต่อฐานข้อมูล
                                                                    include('connect.php'); 


                                                                    $sql = "SELECT count(portnumber) AS total_users FROM infouser WHERE portnumber ";
                                                                    $result = $conn->query($sql);

                                                                    if ($result->num_rows > 0) {
                                                                        while($row = $result->fetch_assoc()) {
                                                                            $total_users  = $row["total_users"];
                                                                            // แสดงผลลัพธ์
                                                                            echo number_format($total_users ).' users';
                                                                        }
                                                                    } else {
                                                                        echo "0";
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
                              
                </div class="row">
               
                <div class="graph1">
               
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

                        <div class="chart1">
                       
                            <div class="card shadow mb-4">
                            
                                <!-- Card Body -->
                                
                                    <div class="chart-area">
                                        <canvas id="myAreaChart1"></canvas>
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
                                        borderColor: "#D17842 ",
                                        pointRadius: 3,
                                        pointBackgroundColor: "#D17842 ",
                                        pointBorderColor: "#D17842 ",
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
                        
                            $backgroundColors = ['grey', '#D17842 ', '#EDB977']; // สีพื้นหลังของ Pie Chart
                            $hoverBackgroundColors = ['#252A32', '#252A32 ', '#252A32']; // สีเมื่อโฮเวอร์
                            ?>

                    
                                 <div>
                                    <!-- Card Header - Dropdown -->
                                  
                                    <!-- Card Body -->
                                    <div class="body-pie">
                                   
                                        <div class="pie-chart">
                            
                                            <!-- สร้าง Canvas สำหรับ Pie Chart -->
                                            <canvas id="myPieChart1"></canvas>
                                        </div>
                                    
                                            <!-- แสดงข้อมูลสัดส่วนแต่ละส่วน -->
                                         
                                        <div class="text-info">
                                            
                                            <!-- แสดงข้อมูลสัดส่วนและตัวเลขแต่ละส่วน -->
                                            <?php foreach ($labels as $index => $label): ?>
                                                  

    

                                                <span class="mr-2">
                                                    <i class="fas fa-circle" style="color: <?php echo $backgroundColors[$index]; ?>"></i>
                                                    <?php echo   $label; ?>: <?php echo round($data[$index]*$total/100, 2); ?> bills 
                                                </span>
                                            <?php endforeach; ?>
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
                    
                
                
                </div class="graph1">
                </div>
            <!-- Topbar -->
          
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            
            </div>
        </div>         <!-- Content Column -->
                    

                        <!-- Project Card Example -->
                       
                        <!-- Color System -->
                       

                    

                   

                   

                        <!-- Approach -->
                  

                  
                

            
            <!-- /.container-fluid -->

        <!-- End of Main Content -->

        <!-- Footer -->
     
        <!-- End of Footer -->

    <!-- End of Content Wrapper -->


<!-- End of Page Wrapper -->



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


</div>
</body>
</html>