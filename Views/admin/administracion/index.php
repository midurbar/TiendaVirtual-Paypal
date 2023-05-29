
<?php include_once 'Views/template/header-admin.php';?>

                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <br>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <p class="mb-0 text-secondary text-white">Pedidos Pendientes</p> 
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h4 class="my-1 text-white"><?php echo $data['pendientes']['total']; ?></h4>
                                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fas fa-exclamation-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <p class="mb-0 text-secondary text-white">Pedidos en Proceso</p> 
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h4 class="my-1 text-white"><?php echo $data['procesos']['total']; ?></h4>
                                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fas fa-spinner"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <p class="mb-0 text-secondary text-white">Pedidos Finalizados</p> 
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h4 class="my-1 text-white"><?php echo $data['finalizados']['total']; ?></h4>
                                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fas fa-check-circle"></i></div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                <p class="mb-0 text-secondary text-white">Total Productos</p> 
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h4 class="my-1 text-white"><?php echo $data['productos']['total']; ?></h4>
                                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fas fa-user"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Productos
                                    </div>
                                    <div class="card-body"><canvas id="doughnutChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Productos con Stock Mínimo
                                    </div>
                                    <div class="card-body"><canvas id="pieChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Productos mas Vendidos
                                    </div>
                                    <div class="card-body"><canvas id="newChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php include_once 'Views/template/footer-admin.php';?>
                <script>
                    //doughnut
                    var ctxD = document.getElementById("doughnutChart").getContext('2d');
                    var myLineChart = new Chart(ctxD, {
                        type: 'doughnut',
                        data: {
                            labels: ["Finalizados", "En Proceso", "Pendientes"],
                            datasets: [{
                                data: [<?php echo $data['finalizados']['total']; ?>, <?php echo $data['procesos']['total']; ?>, <?php echo $data['pendientes']['total']; ?>],
                                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
                                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
                            }]
                        },
                        options: {
                            responsive: true
                        }
                    });
                </script>
                <script src="<?php echo BASE_URL; ?>assets/js/index.js"></script>
                </body>
</html>
            
