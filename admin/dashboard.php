<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
    $monthlySalesQuery = "SELECT 
    MONTHNAME(OrderTime) as month,
    COUNT(*) as order_count,
    SUM(CASE WHEN Status = 'Delivered' THEN 1 ELSE 0 END) as completed_orders
    FROM tblorderaddresses 
    WHERE YEAR(OrderTime) = YEAR(CURRENT_DATE)
    GROUP BY MONTH(OrderTime)
    ORDER BY MONTH(OrderTime)
    LIMIT 5";
$monthlySalesResult = mysqli_query($con, $monthlySalesQuery);

$months = [];
$salesData = [];
while($row = mysqli_fetch_assoc($monthlySalesResult)) {
    $months[] = $row['month'];
    $salesData[] = $row['completed_orders'];
}

// Weekly Revenue Data
$weeklyRevenueQuery = "SELECT 
    DAYNAME(OrderTime) as day,
    COUNT(*) as daily_orders
    FROM tblorderaddresses 
    WHERE OrderTime >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    GROUP BY DAY(OrderTime)
    ORDER BY OrderTime";
$weeklyRevenueResult = mysqli_query($con, $weeklyRevenueQuery);

$days = [];
$revenueData = [];
while($row = mysqli_fetch_assoc($weeklyRevenueResult)) {
    $days[] = $row['day'];
    $revenueData[] = $row['daily_orders'];
}

// Order Status Distribution
$orderStatusQuery = "SELECT 
    Status,
    COUNT(*) as status_count
    FROM tblorderaddresses
    WHERE Status IS NOT NULL
    GROUP BY Status";
$orderStatusResult = mysqli_query($con, $orderStatusQuery);

$statusLabels = [];
$statusData = [];
while($row = mysqli_fetch_assoc($orderStatusResult)) {
    $statusLabels[] = $row['Status'];
    $statusData[] = $row['status_count'];
}

// Review Sentiment Distribution
$reviewSentimentQuery = "SELECT 
    Status as sentiment,
    COUNT(*) as sentiment_count
    FROM tblreview
    WHERE Status IS NOT NULL
    GROUP BY Status";
$reviewSentimentResult = mysqli_query($con, $reviewSentimentQuery);

$sentimentLabels = [];
$sentimentData = [];
while($row = mysqli_fetch_assoc($reviewSentimentResult)) {
    $sentimentLabels[] = $row['sentiment'];
    $sentimentData[] = $row['sentiment_count'];
}
// Product Category Distribution
$categoryQuery = "SELECT 
    c.categoryName,
    COUNT(p.id) as product_count
    FROM category c
    LEFT JOIN products p ON c.id = p.category
    GROUP BY c.id
    ORDER BY product_count DESC
    LIMIT 5";
$categoryResult = mysqli_query($con, $categoryQuery);

$categoryLabels = [];
$categoryData = [];
while($row = mysqli_fetch_assoc($categoryResult)) {
    $categoryLabels[] = $row['categoryName'];
    $categoryData[] = $row['product_count'];
}

// Monthly Revenue Trend
$revenueQuery = "SELECT 
    MONTHNAME(o.OrderTime) as month,
    SUM(p.productPrice) as revenue
    FROM tblorderaddresses o
    JOIN products p ON o.Ordernumber = p.id
    WHERE YEAR(o.OrderTime) = YEAR(CURRENT_DATE)
    GROUP BY MONTH(o.OrderTime)
    ORDER BY MONTH(o.OrderTime)
    LIMIT 6";
$revenueResult = mysqli_query($con, $revenueQuery);

$revenueMonths = [];
$revenueAmounts = [];
while($row = mysqli_fetch_assoc($revenueResult)) {
    $revenueMonths[] = $row['month'];
    $revenueAmounts[] = $row['revenue'];
}

// User Registration Trend
$userTrendQuery = "SELECT 
    DATE_FORMAT(regDate, '%Y-%m') as month,
    COUNT(*) as new_users
    FROM users
    GROUP BY DATE_FORMAT(regDate, '%Y-%m')
    ORDER BY month DESC
    LIMIT 6";
$userTrendResult = mysqli_query($con, $userTrendQuery);

$userMonths = [];
$userCounts = [];
while($row = mysqli_fetch_assoc($userTrendResult)) {
    $userMonths[] = date('M Y', strtotime($row['month']));
    $userCounts[] = $row['new_users'];
}

// Product Performance
$productPerformanceQuery = "SELECT 
    p.productName,
    COUNT(o.Ordernumber) as order_count
    FROM products p
    LEFT JOIN tblorderaddresses o ON p.id = o.Ordernumber
    GROUP BY p.id
    ORDER BY order_count DESC
    LIMIT 5";
$productPerformanceResult = mysqli_query($con, $productPerformanceQuery);

$productLabels = [];
$productData = [];
while($row = mysqli_fetch_assoc($productPerformanceResult)) {
    $productLabels[] = $row['productName'];
    $productData[] = $row['order_count'];
}   
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>Jewellery Shop Managemnt System | Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
.card {
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}

.card-header {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    font-weight: bold;
}

.card-bodyy {
    height: 350px;
    position: relative;
    padding: 1.5rem;
}

.chart-container {
    position: relative;
    height: 100%;
    width: 100%;
}

canvas {
    max-width: 100%;
}

.bg-gradient {
    background: linear-gradient(45deg, #4e73df, #224abe);
}

.card-header i {
    margin-right: 10px;
}
</style>
    </head>
    <body class="sb-nav-fixed">
   <?php include_once('includes/header.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <!-- Charts Section -->
                        <div class="row mt-4">
                            <div class="col-xl-6 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i> Sales Overview (Bar Chart)
                                    </div>
                                    <div class="card-bodyy">
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-chart-area me-1"></i> Product Category Distribution
            </div>
            <div class="card-bodyy">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-pie me-1"></i> Order Distribution (Pie Chart)
                                    </div>
                                    <div class="card-bodyy">
                                        <canvas id="pieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-doughnut me-1"></i> Customer Feedback (Doughnut Chart)
                                    </div>
                                    <div class="card-bodyy">
                                        <canvas id="doughnutChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Additional Charts Row 1 -->
<div class="row">
<div class="col-xl-6 col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-line me-1"></i> Revenue Trend (Line Chart)
                                    </div>
                                    <div class="card-bodyy">
                                        <canvas id="lineChart"></canvas>
                                    </div>
                                </div>
                            </div>
    <div class="col-xl-6 col-md-12">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <i class="fas fa-chart-line me-1"></i> Monthly Revenue Trend
            </div>
            <div class="card-bodyy">
                <canvas id="revenueTrendChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Additional Charts Row 2 -->
<div class="row">
    <div class="col-xl-6 col-md-12">
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <i class="fas fa-users me-1"></i> User Registration Trend
            </div>
            <div class="card-bodyy">
                <canvas id="userTrendChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-12">
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                <i class="fas fa-chart-bar me-1"></i> Top Performing Products
            </div>
            <div class="card-bodyy">
                <canvas id="productPerformanceChart"></canvas>
            </div>
        </div>
    </div>
</div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <?php $query1=mysqli_query($con,"Select * from users");
$totuser=mysqli_num_rows($query1);
?>
                                    <div class="card-body">Total Users(<?php echo $totuser;?>)</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="reg-users.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <?php $query2=mysqli_query($con,"Select * from  tblorderaddresses where Status is null");
$notconfirmedorder=mysqli_num_rows($query2);
?>
                                    <div class="card-body">New Order(<?php echo $notconfirmedorder;?>)</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="new-order.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <?php $query3=mysqli_query($con,"Select * from  tblorderaddresses where Status ='Order Confirmed'");
$conforder=mysqli_num_rows($query3);
?>
                                    <div class="card-body">Confirmed Order(<?php echo $conforder;?>)</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="confirm-order.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <?php $query4=mysqli_query($con,"Select * from  tblorderaddresses where Status ='Pickup'");
$pickuporder=mysqli_num_rows($query4);
?>
                                    <div class="card-body">Pickup Order(<?php echo $pickuporder;?>)</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="pickup-order.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <?php $query5=mysqli_query($con,"Select * from  tblorderaddresses where Status ='On the Way'");
$otworder=mysqli_num_rows($query5);
?>
                                    <div class="card-body">On the Way Orders(<?php echo $otworder;?>)</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="ontheway-order.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <?php $query6=mysqli_query($con,"Select * from  tblorderaddresses where Status ='Delivered'");
$delorder=mysqli_num_rows($query6);
?>
                                    <div class="card-body">Delivered Order(<?php echo $delorder;?>)</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="delivered-order.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <?php $query7=mysqli_query($con,"Select * from  tblorderaddresses where Status ='Order Cancelled'");
$canorder=mysqli_num_rows($query7);
?>
                                    <div class="card-body">Cancelled Order(<?php echo $canorder;?>)</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="cancelled-order.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <?php $query8=mysqli_query($con,"Select * from  tblreview where Status ='Review Accept'");
$accrev=mysqli_num_rows($query8);
?>
                                    <div class="card-body">Accepted Reviews(<?php echo $accrev;?>)</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="approved-reviews.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <?php $query9=mysqli_query($con,"Select * from  tblreview where Status ='Review Reject'");
$rejrev=mysqli_num_rows($query9);
?>
                                    <div class="card-body">Rejected Reviews(<?php echo $rejrev;?>)</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="unapproved-reviews.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <?php $query10=mysqli_query($con,"Select * from  tblreview where Status is null");
$newrev=mysqli_num_rows($query10);
?>
                                    <div class="card-body">New Review(<?php echo $newrev;?>)</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="new-reviews.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <?php $query11=mysqli_query($con,"Select * from  tblcontact where IsRead is null");
$unreadenq=mysqli_num_rows($query11);
?>
                                    <div class="card-body">Unread Enquery(<?php echo $unreadenq;?>)</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/unreadenq.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <?php $query12=mysqli_query($con,"Select * from  tblcontact where IsRead='1'");
$readenq=mysqli_num_rows($query12);
?>
                                    <div class="card-body">Read Enquiry(<?php echo $readenq;?>)</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="readenq.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
              <?php include_once('includes/footer.php');?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
// Bar Chart - Monthly Sales
const barChart = new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($months); ?>,
        datasets: [{
            label: 'Monthly Sales',
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
            data: <?php echo json_encode($salesData); ?>
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        responsive: true,
        maintainAspectRatio: false
    }
});

// Line Chart - Weekly Revenue
const lineChart = new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: <?php echo json_encode($days); ?>,
        datasets: [{
            label: 'Daily Orders',
            borderColor: '#36b9cc',
            data: <?php echo json_encode($revenueData); ?>,
            fill: false
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        responsive: true,
        maintainAspectRatio: false
    }
});

// Pie Chart - Order Status Distribution
const pieChart = new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($statusLabels); ?>,
        datasets: [{
            backgroundColor: ['#4e73df', '#1cc88a', '#e74a3b', '#f6c23e', '#36b9cc'],
            data: <?php echo json_encode($statusData); ?>
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

// Doughnut Chart - Review Sentiment
const doughnutChart = new Chart(document.getElementById('doughnutChart'), {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($sentimentLabels); ?>,
        datasets: [{
            backgroundColor: ['#1cc88a', '#e74a3b', '#f6c23e', '#4e73df', '#36b9cc'],
            data: <?php echo json_encode($sentimentData); ?>
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
// Category Distribution Chart
const categoryChart = new Chart(document.getElementById('categoryChart'), {
    type: 'polarArea',
    data: {
        labels: <?php echo json_encode($categoryLabels); ?>,
        datasets: [{
            data: <?php echo json_encode($categoryData); ?>,
            backgroundColor: [
                'rgba(78, 115, 223, 0.8)',
                'rgba(28, 200, 138, 0.8)',
                'rgba(54, 185, 204, 0.8)',
                'rgba(246, 194, 62, 0.8)',
                'rgba(231, 74, 59, 0.8)'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scale: {
            ticks: {
                beginAtZero: true
            }
        },
        animation: {
            animateRotate: true,
            animateScale: true
        }
    }
});

// Revenue Trend Chart
const revenueTrendChart = new Chart(document.getElementById('revenueTrendChart'), {
    type: 'line',
    data: {
        labels: <?php echo json_encode($revenueMonths); ?>,
        datasets: [{
            label: 'Monthly Revenue',
            data: <?php echo json_encode($revenueAmounts); ?>,
            borderColor: 'rgba(28, 200, 138, 1)',
            backgroundColor: 'rgba(28, 200, 138, 0.1)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    drawBorder: false
                }
            }
        },
        plugins: {
            legend: {
                display: true
            }
        }
    }
});

// User Registration Trend Chart
const userTrendChart = new Chart(document.getElementById('userTrendChart'), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($userMonths); ?>,
        datasets: [{
            label: 'New Users',
            data: <?php echo json_encode($userCounts); ?>,
            backgroundColor: 'rgba(54, 185, 204, 0.8)',
            borderRadius: 5
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: true
            }
        }
    }
});

// Product Performance Chart
const productPerformanceChart = new Chart(document.getElementById('productPerformanceChart'), {
    type: 'horizontalBar',
    data: {
        labels: <?php echo json_encode($productLabels); ?>,
        datasets: [{
            label: 'Orders',
            data: <?php echo json_encode($productData); ?>,
            backgroundColor: [
                'rgba(246, 194, 62, 0.8)',
                'rgba(246, 194, 62, 0.7)',
                'rgba(246, 194, 62, 0.6)',
                'rgba(246, 194, 62, 0.5)',
                'rgba(246, 194, 62, 0.4)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
    </body>
</html>
<?php } ?>