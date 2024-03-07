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