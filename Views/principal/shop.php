<!DOCTYPE html>
<html lang="en">

<?php include_once 'Views/template-principal/header.php';?>

    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-inline shop-top-menu pb-3 pt-1">
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none mr-3" href="#">Todos</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none mr-3" href="#">Men's</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none" href="#">Women's</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($data['productos'] as $producto) { ?>
                    <div class="col-md-3">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="<?php echo $producto['imagen']; ?>">
                                <div
                                    class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-util text-white" href="shop-single.html"><i
                                                    class="fa fa-heart"></i></a></li>
                                        <li><a class="btn btn-util text-white mt-2" href="shop-single.html"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a class="btn btn-util text-white mt-2" href="shop-single.html"><i
                                                    class="fa fa-cart-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="shop-single.html" class="h3 text-decoration-none"><?php echo $producto['nombre']; ?></a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    
                                    <li class="pt-2">
                                        <span
                                            class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span
                                            class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span
                                            class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span
                                            class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span
                                            class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul>
                                <p class="text-center mb-0"><?php echo $producto['precio'] . ' ' . MONEDA; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div div="row">
                        <ul class="pagination pagination-lg justify-content-end">
                        <?php 
                        $anterior= $data['pagina'] -1;
                        $siguiente= $data['pagina'] +1;
                        if ($data['pagina'] > 1) {
                            echo '<li class="page-item">
                                <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="'.$anterior.'"
                                tabindex="-1">Anterior</a>
                                </li>';
                        }
                        if ($data['total']>=$siguiente) {
                            echo '<li class="page-item">
                            <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-white"
                            href="'.$siguiente.'">Siguiente</a>
                            </li>';
                        }
                        ?>
                    </ul>

                </div>
            </div>

        </div>
    </div>
    <!-- End Content -->

    <?php include_once 'Views/template-principal/footer.php';?>
    </body>
    
    </html>