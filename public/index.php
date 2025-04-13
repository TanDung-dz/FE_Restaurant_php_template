<?php
require_once 'session.php';
$user = getCurrentUser();

// Thêm dòng này ở đây, trước khi xử lý bất kỳ route nào
require_once __DIR__ . '/../app/config/api.php';

$uri = $_SERVER['REQUEST_URI'];
$base_path = '/restaurant-website/public';

$parsed_url = parse_url($uri);
$path = str_replace($base_path, '', $parsed_url['path']);

// DEBUG:
echo "Debug: URI = $uri<br>";
echo "Debug: PATH = $path<br>";
echo "DEBUG: ID = " . ($_GET['id'] ?? 'không có');
// Xử lý các route
switch ($path) {
    case '':
    case '/':
    require_once __DIR__ . '/../app/config/api.php';
    case '/index.php':
        // Trang chủ (giữ nguyên nội dung HTML hiện tại)
        break;
    case '/login':
        require __DIR__ . '/../views/auth/login.php';
        exit; // Dừng thực thi để không hiển thị nội dung trang chủ
    case '/register':
        require __DIR__ . '/../views/auth/register.php';
        exit;
    case '/logout':
        require __DIR__ . '/../views/auth/logout.php';
        exit;
    case '/datban':
        require __DIR__ . '/../views/datban/datban.php';
        exit;
    case '/menu':
        require __DIR__ . '/../views/restaurant/menu.php';
        exit;

    case '/profile':
        if (isLoggedIn()) {
            require __DIR__ . '/../views/user/profile.php';
        } else {
            header('Location: /restaurant-website/public/login?redirect=profile');
            exit;
        }
        exit;

    case '/user/profile':
        if (isLoggedIn()) {
            require __DIR__ . '/../views/user/profile.php';
        } else {
            header('Location: /restaurant-website/public/login?redirect=user/profile');
            exit;
        }
        exit;

    case '/profile':
            if (isLoggedIn()) {
                require __DIR__ . '/../views/user/profile.php';
            } else {
                header('Location: /restaurant-website/public/login?redirect=profile');
                exit;
            }
            exit;

    case '/booking/my-bookings':
        if (isLoggedIn()) {
            require __DIR__ . '/../views/booking/my-bookings.php';
        } else {
            header('Location: /restaurant-website/public/login?redirect=booking/my-bookings');
            exit;
        }
        exit;

    case '/notifications':
        if (isLoggedIn()) {
            require __DIR__ . '/../views/user/notifications.php';
        } else {
            header('Location: /restaurant-website/public/login?redirect=notifications');
            exit;
        }
        exit;

    case '/booking/booking-detail':
        if (isLoggedIn()) {
            require __DIR__ . '/../views/booking/booking-detail.php';
        } else {
                header('Location: /restaurant-website/public/login?redirect=booking/booking-detail');
                exit;
        }
        exit;
    case '/user/order-food':  // Thay đổi thành /user/order-food
        if (isLoggedIn()) {
            require __DIR__ . '/../views/user/order-food.php';
        } else {
            header('Location: /restaurant-website/public/login?redirect=user/order-food');
            exit;
        }
        exit;
    // Thanh toán đơn đặt bàn
    case '/payment':
        if (isLoggedIn()) {
            require __DIR__ . '/../views/payment/payment.php';
        } else {
            header('Location: /restaurant-website/public/login?redirect=payment');
            exit;
        }
        exit;

    // Chuyển hướng thanh toán MoMo
    case '/payment/momo-redirect':
        if (isLoggedIn()) {
            require __DIR__ . '/../views/payment/momo-redirect.php';
        } else {
            header('Location: /restaurant-website/public/login');
            exit;
        }
        exit;

    // Xác nhận thanh toán thành công
    case '/payment/payment-success':
        if (isLoggedIn()) {
            require __DIR__ . '/../views/payment/payment-success.php';
        } else {
            header('Location: /restaurant-website/public/login');
            exit;
        }
        exit;
        // Admin Dashboard
    case '/admin/dashboard':
        if (isAdmin()) {
            require __DIR__ . '/../views/admin/index.php';
        } else {
            header('Location: /restaurant-website/public?error=noPermission');
            exit;
        }
        exit;

    // Quản lý người dùng
    case '/admin/users':
        if (isAdmin()) {
            require __DIR__ . '/../views/admin/users.php';
        } else {
            header('Location: /restaurant-website/public?error=noPermission');
            exit;
        }
        exit;

    // Quản lý nhà hàng
    case '/admin/restaurants':
        if (isAdmin()) {
            require __DIR__ . '/../views/admin/restaurants.php';
        } else {
            header('Location: /restaurant-website/public?error=noPermission');
            exit;
        }
        exit;

    // Quản lý đặt bàn
    case '/admin/bookings':
        if (isAdmin()) {
            require __DIR__ . '/../views/admin/bookings.php';
        } else {
            header('Location: /restaurant-website/public?error=noPermission');
            exit;
        }
        exit;

    // Quản lý món ăn
    case '/admin/food':
        if (isAdmin()) {
            require __DIR__ . '/../views/admin/food.php';
        } else {
            header('Location: /restaurant-website/public?error=noPermission');
            exit;
        }
        exit;

    // Quản lý danh mục
    case '/admin/categories':
        if (isAdmin()) {
            require __DIR__ . '/../views/admin/categories.php';
        } else {
            header('Location: /restaurant-website/public?error=noPermission');
            exit;
        }
        exit;

    // Quản lý đánh giá
    case '/admin/reviews':
        if (isAdmin()) {
            require __DIR__ . '/../views/admin/reviews.php';
        } else {
            header('Location: /restaurant-website/public?error=noPermission');
            exit;
        }
        exit;

    // Quản lý thanh toán
    case '/admin/payment':
        if (isAdmin()) {
            require __DIR__ . '/../views/admin/payment.php';
        } else {
            header('Location: /restaurant-website/public?error=noPermission');
            exit;
        }
        exit;
    //Quản lý user
    case '/admin/user-form':
        if (isAdmin()) {
            require __DIR__ . '/../views/admin/user-form.php';
        } else {
            header('Location: /restaurant-website/public?error=noPermission');
            exit;
        }
        exit;
    // Quản lý thông báo 
    case '/admin/notifications':
        if (isAdmin()) {
            require __DIR__ . '/../views/admin/notifications.php';
        } else {
            header('Location: /restaurant-website/public?error=noPermission');
            exit;
        }
        exit;
    // Quản lý thanh toán 
    case '/admin/payment':
        if (isAdmin()) {
            require __DIR__ . '/../views/admin/payment.php';
        } else {
            header('Location: /restaurant-website/public?error=noPermission');
            exit;
        }
        exit;
    // Quản lý đánh giá
    case '/admin/reviews':
        if (isAdmin()) {
            require __DIR__ . '/../views/admin/payment.php';
        } else {
            header('Location: /restaurant-website/public?error=noPermission');
            exit;
        }
        exit;


    case '/food/food-detail.php':
        if (isset($_GET['id'])) {
            require __DIR__ . '/../views/food/food-detail.php';
        } else {
             header('Location: /restaurant-website/public/menu.php');
        }
        exit;

        

    case '/booking/booking-confirmation.php':
    case '/booking/booking-confirmation':
        if (isset($_GET['id'])) {
             require __DIR__ . '/../views/booking/booking-confirmation.php';
            } else {
                header('Location: /restaurant-website/public/datban');
            }
        exit;

    case '/menu':
        require __DIR__ . '/../views/restaurant/menu.php';
        exit;
            
        // Nếu bạn cũng muốn hỗ trợ đường dẫn cũ
    case '/menu.php':
        require __DIR__ . '/../views/restaurant/menu.php';
        exit;

        case '/payment/momo-redirect':
            if (isLoggedIn()) {
                require __DIR__ . '/../views/payment/momo-redirect.php';
            } else {
                header('Location: /restaurant-website/public/login?redirect=payment/momo-redirect');
                exit;
            }
            exit;

        
    
// Thêm vào phần switch case của index.php
case '/payment/momo-qr':
    if (isLoggedIn()) {
        require __DIR__ . '/../views/payment/momo-qr.php';
    } else {
        header('Location: /restaurant-website/public/login?redirect=payment/momo-qr');
        exit;
    }
    exit;
            
    default:
        // Trang lỗi 404 nếu không tìm thấy route
        http_response_code(404);
        require __DIR__ . '/../views/error.php';
        exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <!-- ========== Meta Tags ========== -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="modinatheme">
        <meta name="description" content="Foodking - Fast Food Restaurant PHP Template">
        <!-- ======== Page title ============ -->
        <title>Foodking - Fast Food Restaurant PHP Template</title>
        <!--<< Favcion >>-->
        <link rel="shortcut icon" href="assets/img/logo/favicon.svg">
        <!--<< Bootstrap min.css >>-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!--<< Font Awesome.css >>-->
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <!--<< Animate.css >>-->
        <link rel="stylesheet" href="assets/css/animate.css">
        <!--<< Magnific Popup.css >>-->
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <!--<< MeanMenu.css >>-->
        <link rel="stylesheet" href="assets/css/meanmenu.css">
        <!--<< Swiper Bundle.css >>-->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
        <!--<< Nice Select.css >>-->
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <!--<< Main.css >>-->
        <link rel="stylesheet" href="assets/css/main.css">
        <!--<< Style.css >>-->
        <link rel="stylesheet" href="style.css">
            </head>    <body>
        <!-- Preloader Start -->
        
<div id="preloader" class="preloader">
    <div class="animation-preloader">
        <div class="spinner">                
        </div>
        <div class="txt-loading">
            <span data-text-preloader="F" class="letters-loading">
            F
            </span>
            <span data-text-preloader="O" class="letters-loading">
            O
            </span>
            <span data-text-preloader="0" class="letters-loading">
            O
            </span>
            <span data-text-preloader="D" class="letters-loading">
            D
            </span>
            <span data-text-preloader="K" class="letters-loading">
            K
            </span>
            <span data-text-preloader="I" class="letters-loading">
            I
            </span>
            <span data-text-preloader="N" class="letters-loading">
            N
            </span>
            <span data-text-preloader="G" class="letters-loading">
            G
            </span>
        </div>
        <p class="text-center">Loading</p>
    </div>
    <div class="loader">
        <div class="row">
            <div class="col-3 loader-section section-left">
                <div class="bg"></div>
            </div>
            <div class="col-3 loader-section section-left">
                <div class="bg"></div>
            </div>
            <div class="col-3 loader-section section-right">
                <div class="bg"></div>
            </div>
            <div class="col-3 loader-section section-right">
                <div class="bg"></div>
            </div>
        </div>
    </div>
</div>
        <!-- Offcanvas Area Start -->
        
<div class="fix-area">
    <div class="offcanvas__info">
        <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
                <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                    <div class="offcanvas__logo">
                        <a href="index.php">
                        <img src="assets/img/logo/logo.svg" alt="logo-img">
                        </a>
                    </div>
                    <div class="offcanvas__close">
                        <button>
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <p class="text d-none d-lg-block">
                    This involves interactions between a business and its customers. It's about meeting customers' needs and resolving their problems. Effective customer service is crucial.
                </p>
                <div class="offcanvas-gallery-area d-none d-lg-block">
                    <div class="offcanvas-gallery-items">
                        <a href="assets/img/header/01.jpg" class="offcanvas-image img-popup">
                        <img src="assets/img/header/01.jpg" alt="gallery-img">
                        </a>
                        <a href="assets/img/header/02.jpg" class="offcanvas-image img-popup">
                        <img src="assets/img/header/02.jpg" alt="gallery-img">
                        </a>
                        <a href="assets/img/header/03.jpg" class="offcanvas-image img-popup">
                        <img src="assets/img/header/03.jpg" alt="gallery-img">
                        </a>
                    </div>
                    <div class="offcanvas-gallery-items">
                        <a href="assets/img/header/04.jpg" class="offcanvas-image img-popup">
                        <img src="assets/img/header/04.jpg" alt="gallery-img">
                        </a>
                        <a href="assets/img/header/05.jpg" class="offcanvas-image img-popup">
                        <img src="assets/img/header/05.jpg" alt="gallery-img">
                        </a>
                        <a href="assets/img/header/06.jpg" class="offcanvas-image img-popup">
                        <img src="assets/img/header/06.jpg" alt="gallery-img">
                        </a>
                    </div>
                </div>
                <div class="mobile-menu fix mb-3"></div>
                <div class="offcanvas__contact">
                    <h4>Contact Info</h4>
                    <ul>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a target="_blank" href="#">Main Street, Melbourne, Australia</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a href="tel:+013-003-003-9993"><span class="mailto:info@enofik.com">info@foodking.com</span></a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="fal fa-clock"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a target="_blank" href="#">Mod-friday, 09am -05pm</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="far fa-phone"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a href="tel:+11002345909">+11002345909</a>
                            </div>
                        </li>
                    </ul>
                    <div class="header-button mt-4">
                        <a href="shop-single.html" class="theme-btn">
                        <span class="button-content-wrapper d-flex align-items-center justify-content-center">
                        <span class="button-icon"><i class="flaticon-delivery"></i></span>
                        <span class="button-text">order now</span>
                        </span>
                        </a>
                    </div>
                    <div class="social-icon d-flex align-items-center">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas__overlay"></div>
        <!-- Header Section Start -->
        
<header class="section-bg">
    <div class="header-top">
        <div class="container">
            <div class="header-top-wrapper">
                <ul>
                    <li><span>100%</span> Secure delivery without contacting the courier</li>
                    <li><i class="fas fa-truck"></i>Track Your Order</li>
                </ul>
                <div class="top-right">
                    <div class="search-wrp">
                        <button><i class="far fa-search"></i></button>
                        <input placeholder="Search" aria-label="Search">
                    </div>
                    <div class="social-icon d-flex align-items-center">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-vimeo-v"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- navbar -->
    <div id="header-sticky" class="header-1">
        <div class="container">
            <div class="mega-menu-wrapper">
                <div class="header-main">
                    <div class="logo">
                        <a href="index-2.html" class="header-logo">
                        <img src="assets/img/logo/logo.svg" alt="logo-img">
                        </a>
                    </div>
                    <div class="header-left">
                        <div class="mean__menu-wrapper d-none d-lg-block">
                            <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li class="has-dropdown active">
                                        <a href="/restaurant-website/public/">
                                            Home Page
                                        </a>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="/restaurant-website/public/menu">
                                            Thực Đơn
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/restaurant-website/public/datban">
                                            Đặt Bàn
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                                <!-- for wp -->
                            </div>
                        </div>
                    </div>
                    <div class="header-right d-flex justify-content-end align-items-center">                       
                        <div class="header-button">
                            <?php if (isLoggedIn()): ?>
                                <div class="dropdown">
                                <button class="theme-btn bg-red-2 dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $user['HoVaTen']; ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <?php if (isAdmin()): ?>
                                        <a class="dropdown-item" href="/restaurant-website/public/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Admin Dashboard</a>
                                        <li><hr class="dropdown-divider"></li>
                                    <?php endif; ?>
                                    
                                    <!-- Các mục chung cho cả admin và user -->
                                    <li><a class="dropdown-item" href="/restaurant-website/public/profile"><i class="fas fa-user"></i> Tài khoản</a></li>
                                    <li><a class="dropdown-item" href="/restaurant-website/public/booking/my-bookings"><i class="fas fa-calendar-check"></i> Đặt bàn của tôi</a></li>
                                    
                                    <!-- Thông báo cho tất cả người dùng -->
                                    <li><a class="dropdown-item" href="/restaurant-website/public/notifications"><i class="fas fa-bell"></i> Thông báo</a></li>
                                    
                                    <!-- Các mục đơn giản không cần ID cụ thể -->
                                    <?php if (isLoggedIn() && !isAdmin()): ?>
                                        <!-- Có thể thêm các mục khác ở đây nếu cần -->
                                        <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>                            
                                    <!-- Mục đăng xuất chung -->
                                    <li><a class="dropdown-item" href="/restaurant-website/public/logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                                </ul>
                             </div>
                                </div>
                                <?php else: ?>
                                    <a href="/restaurant-website/public/login" class="theme-btn bg-red-2">Đăng Nhập</a>
                                <?php endif; ?>
                    </div>

                        <div class="header__hamburger d-xl-block my-auto">
                            <div class="sidebar__toggle">
                                <div class="header-bar">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>        
        <!-- Hero Section Start -->
        <section class="hero-section">
            <div class="swiper hero-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="hero-1 bg-cover" style="background-image: url('assets/img/hero/hero-bg.jpg');">
                            <div class="chilii-shape" data-animation="fadeInUp" data-delay="2.1s">
                                <img src="assets/img/hero/chilli-shape.png" alt="shape-img">
                            </div>
                            <div class="fire-shape" data-animation="fadeInUp" data-delay="2.4s">
                                <img src="assets/img/hero/fire-shape.png" alt="shape-img">
                            </div>
                            <div class="chilii-shape-2" data-animation="fadeInUp" data-delay="2.7s">
                                <img src="assets/img/hero/chilli-shape-2.png" alt="shape-img">
                            </div>
                            <div class="chilii-shape-3" data-animation="fadeInUp" data-delay="3s">
                                <img src="assets/img/hero/chilli-shape-3.png" alt="shape-img">
                            </div>
                            <div class="offer-shape"  data-animation="fadeInUp" data-delay="2.1s">
                                <img src="assets/img/hero/offer-shape.png" alt="shape-img">
                            </div>
                            <h2 class="hero-back-title"  data-animation="fadeInRight" data-delay="2.5s">fast food</h2>
                            <div class="container">
                                <div class="row justify-content-between">
                                    <div class="col-xl-5 col-lg-7">
                                        <div class="hero-content">
                                            <p data-animation="fadeInUp">crispy, every bite taste</p>
                                            <h1  data-animation="fadeInUp" data-delay="0.5s">
                                                delicious
                                                <span>fried</span>
                                                chiken
                                            </h1>
                                            <div class="hero-button">
                                                <a href="shop-single.html" class="theme-btn" data-animation="fadeInUp" data-delay="0.9s">
                                                <span class="button-content-wrapper d-flex align-items-center">
                                                <span class="button-icon"><i class="flaticon-delivery"></i></span>
                                                <span class="button-text">order now</span>
                                                </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-5 mt-5 mt-lg-0">
                                        <div class="chiken-image" data-animation="fadeInUp" data-delay="1.4s">
                                            <img src="assets/img/hero/chiken.png" alt="chiken-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="hero-1 bg-cover" style="background-image: url('assets/img/hero/hero-bg.jpg');">
                            <div class="chilii-shape" data-animation="fadeInUp" data-delay="2.1s">
                                <img src="assets/img/hero/chilli-shape.png" alt="shape-img">
                            </div>
                            <div class="fire-shape" data-animation="fadeInUp" data-delay="2.4s">
                                <img src="assets/img/hero/fire-shape.png" alt="shape-img">
                            </div>
                            <div class="chilii-shape-2" data-animation="fadeInUp" data-delay="2.7s">
                                <img src="assets/img/hero/chilli-shape-2.png" alt="shape-img">
                            </div>
                            <div class="chilii-shape-3" data-animation="fadeInUp" data-delay="3s">
                                <img src="assets/img/hero/chilli-shape-3.png" alt="shape-img">
                            </div>
                            <div class="offer-shape"  data-animation="fadeInUp" data-delay="2.1s">
                                <img src="assets/img/hero/offer-shape.png" alt="shape-img">
                            </div>
                            <h2 class="hero-back-title"  data-animation="fadeInRight" data-delay="2.5s">fast food</h2>
                            <div class="container">
                                <div class="row justify-content-between">
                                    <div class="col-xl-5 col-lg-7">
                                        <div class="hero-content">
                                            <p data-animation="fadeInUp">crispy, every bite taste</p>
                                            <h1  data-animation="fadeInUp" data-delay="0.5s">
                                                Awesome
                                                <span>fried</span>
                                                chiken
                                            </h1>
                                            <div class="hero-button">
                                                <a href="shop-single.html" class="theme-btn" data-animation="fadeInUp" data-delay="0.9s">
                                                <span class="button-content-wrapper d-flex align-items-center">
                                                <span class="button-icon"><i class="flaticon-delivery"></i></span>
                                                <span class="button-text">order now</span>
                                                </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-5 mt-5 mt-lg-0">
                                        <div class="chiken-image" data-animation="fadeInUp" data-delay="1.4s">
                                            <img src="assets/img/hero/chiken.png" alt="chiken-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="hero-1 bg-cover" style="background-image: url('assets/img/hero/hero-bg.jpg');">
                            <div class="chilii-shape" data-animation="fadeInUp" data-delay="2.1s">
                                <img src="assets/img/hero/chilli-shape.png" alt="shape-img">
                            </div>
                            <div class="fire-shape" data-animation="fadeInUp" data-delay="2.4s">
                                <img src="assets/img/hero/fire-shape.png" alt="shape-img">
                            </div>
                            <div class="chilii-shape-2" data-animation="fadeInUp" data-delay="2.7s">
                                <img src="assets/img/hero/chilli-shape-2.png" alt="shape-img">
                            </div>
                            <div class="chilii-shape-3" data-animation="fadeInUp" data-delay="3s">
                                <img src="assets/img/hero/chilli-shape-3.png" alt="shape-img">
                            </div>
                            <div class="offer-shape"  data-animation="fadeInUp" data-delay="2.1s">
                                <img src="assets/img/hero/offer-shape.png" alt="shape-img">
                            </div>
                            <h2 class="hero-back-title"  data-animation="fadeInRight" data-delay="2.5s">fast food</h2>
                            <div class="container">
                                <div class="row justify-content-between">
                                    <div class="col-xl-5 col-lg-7">
                                        <div class="hero-content">
                                            <p data-animation="fadeInUp">crispy, every bite taste</p>
                                            <h1  data-animation="fadeInUp" data-delay="0.5s">
                                                Favorite
                                                <span>fried</span>
                                                chiken
                                            </h1>
                                            <div class="hero-button">
                                                <a href="shop-single.html" class="theme-btn" data-animation="fadeInUp" data-delay="0.9s">
                                                <span class="button-content-wrapper d-flex align-items-center">
                                                <span class="button-icon"><i class="flaticon-delivery"></i></span>
                                                <span class="button-text">order now</span>
                                                </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-5 mt-5 mt-lg-0">
                                        <div class="chiken-image" data-animation="fadeInUp" data-delay="1.4s">
                                            <img src="assets/img/hero/chiken.png" alt="chiken-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="hero-1 bg-cover" style="background-image: url('assets/img/hero/hero-bg.jpg');">
                            <div class="chilii-shape" data-animation="fadeInUp" data-delay="2.1s">
                                <img src="assets/img/hero/chilli-shape.png" alt="shape-img">
                            </div>
                            <div class="fire-shape" data-animation="fadeInUp" data-delay="2.4s">
                                <img src="assets/img/hero/fire-shape.png" alt="shape-img">
                            </div>
                            <div class="chilii-shape-2" data-animation="fadeInUp" data-delay="2.7s">
                                <img src="assets/img/hero/chilli-shape-2.png" alt="shape-img">
                            </div>
                            <div class="chilii-shape-3" data-animation="fadeInUp" data-delay="3s">
                                <img src="assets/img/hero/chilli-shape-3.png" alt="shape-img">
                            </div>
                            <div class="offer-shape"  data-animation="fadeInUp" data-delay="2.1s">
                                <img src="assets/img/hero/offer-shape.png" alt="shape-img">
                            </div>
                            <h2 class="hero-back-title"  data-animation="fadeInRight" data-delay="2.5s">fast food</h2>
                            <div class="container">
                                <div class="row justify-content-between">
                                    <div class="col-xl-5 col-lg-7">
                                        <div class="hero-content">
                                            <p data-animation="fadeInUp">crispy, every bite taste</p>
                                            <h1  data-animation="fadeInUp" data-delay="0.5s">
                                                delicious
                                                <span>fried</span>
                                                chiken
                                            </h1>
                                            <div class="hero-button">
                                                <a href="shop-single.html" class="theme-btn" data-animation="fadeInUp" data-delay="0.9s">
                                                <span class="button-content-wrapper d-flex align-items-center">
                                                <span class="button-icon"><i class="flaticon-delivery"></i></span>
                                                <span class="button-text">order now</span>
                                                </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-5 mt-5 mt-lg-0">
                                        <div class="chiken-image" data-animation="fadeInUp" data-delay="1.4s">
                                            <img src="assets/img/hero/chiken.png" alt="chiken-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-dot text-center pt-5">
                <div class="dot"></div>
            </div>
        </section>

        <!-- Food Catagory Section Start -->
        <section class="food-category-section fix section-padding section-bg">
            <div class="tomato-shape">
                <img src="assets/img/shape/tomato-shape.png" alt="shape-img">
            </div>
            <div class="burger-shape-2">
                <img src="assets/img/shape/burger-shape-2.png" alt="shape-img">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-9">
                        <div class="section-title">
                            <span class="wow fadeInUp">crispy, every bite taste</span>
                            <h2 class="wow fadeInUp" data-wow-delay=".3s">Popular Food Items</h2>
                        </div>
                    </div>
                    <div class="col-md-5 ps-0 col-3 text-end wow fadeInUp" data-wow-delay=".5s">
                        <div class="array-button">
                            <button class="array-prev"><i class="far fa-long-arrow-left"></i></button>
                            <button class="array-next"><i class="far fa-long-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="swiper food-catagory-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="catagory-product-card bg-cover" style="background-image: url('assets/img/shape/catagory-card-shape.jpg');">
                                <h5>5 products</h5>
                                <div class="catagory-product-image text-center">
                                    <a href="shop.html">
                                        <img src="assets/img/food/pizza.png" alt="product-img">
                                        <div class="decor-leaf">
                                            <img src="assets/img/shape/decor-leaf.svg" alt="shape-img">
                                        </div>
                                        <div class="decor-leaf-2">
                                            <img src="assets/img/shape/decor-leaf-2.svg" alt="shape-img">
                                        </div>
                                        <div class="burger-shape">
                                            <img src="assets/img/shape/burger-shape.png" alt="shape-img">
                                        </div>
                                    </a>
                                </div>
                                <div class="catagory-product-content text-center">
                                    <div class="catagory-product-icon">
                                        <img src="assets/img/shape/food-shape.svg" alt="shape-text">
                                    </div>
                                    <h3>
                                        <a href="shop-single.html">
                                        pro pizza
                                        </a>
                                    </h3>
                                    <p>5 products</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="catagory-product-card bg-cover" style="background-image: url('assets/img/shape/catagory-card-shape.jpg');">
                                <h5>5 products</h5>
                                <div class="catagory-product-image text-center">
                                    <a href="shop.html">
                                        <img src="assets/img/food/pasta.png" alt="product-img">
                                        <div class="decor-leaf">
                                            <img src="assets/img/shape/decor-leaf.svg" alt="shape-img">
                                        </div>
                                        <div class="decor-leaf-2">
                                            <img src="assets/img/shape/decor-leaf-2.svg" alt="shape-img">
                                        </div>
                                        <div class="burger-shape">
                                            <img src="assets/img/shape/burger-shape.png" alt="shape-img">
                                        </div>
                                    </a>
                                </div>
                                <div class="catagory-product-content text-center">
                                    <div class="catagory-product-icon">
                                        <img src="assets/img/shape/food-shape.svg" alt="shape-text">
                                    </div>
                                    <h3>
                                        <a href="shop-single.html">
                                        pro pizza
                                        </a>
                                    </h3>
                                    <p>5 products</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="catagory-product-card bg-cover" style="background-image: url('assets/img/shape/catagory-card-shape.jpg');">
                                <h5>5 products</h5>
                                <div class="catagory-product-image text-center">
                                    <a href="shop.html">
                                        <img src="assets/img/food/burger.png" alt="product-img">
                                        <div class="decor-leaf">
                                            <img src="assets/img/shape/decor-leaf.svg" alt="shape-img">
                                        </div>
                                        <div class="decor-leaf-2">
                                            <img src="assets/img/shape/decor-leaf-2.svg" alt="shape-img">
                                        </div>
                                        <div class="burger-shape">
                                            <img src="assets/img/shape/burger-shape.png" alt="shape-img">
                                        </div>
                                    </a>
                                </div>
                                <div class="catagory-product-content text-center">
                                    <div class="catagory-product-icon">
                                        <img src="assets/img/shape/food-shape.svg" alt="shape-text">
                                    </div>
                                    <h3>
                                        <a href="shop-single.html">
                                        pro pizza
                                        </a>
                                    </h3>
                                    <p>5 products</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="catagory-product-card bg-cover" style="background-image: url('assets/img/shape/catagory-card-shape.jpg');">
                                <h5>5 products</h5>
                                <div class="catagory-product-image text-center">
                                    <a href="shop.html">
                                        <img src="assets/img/food/french-fry.png" alt="product-img">
                                        <div class="decor-leaf">
                                            <img src="assets/img/shape/decor-leaf.svg" alt="shape-img">
                                        </div>
                                        <div class="decor-leaf-2">
                                            <img src="assets/img/shape/decor-leaf-2.svg" alt="shape-img">
                                        </div>
                                        <div class="burger-shape">
                                            <img src="assets/img/shape/burger-shape.png" alt="shape-img">
                                        </div>
                                    </a>
                                </div>
                                <div class="catagory-product-content text-center">
                                    <div class="catagory-product-icon">
                                        <img src="assets/img/shape/food-shape.svg" alt="shape-text">
                                    </div>
                                    <h3>
                                        <a href="shop-single.html">
                                        pro pizza
                                        </a>
                                    </h3>
                                    <p>5 products</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Food Banner Section Start -->
        <section class="food-banner-section section-padding fix section-bg pt-0">
            <div class="chili-shape">
                <img src="assets/img/shape/chili-shape.png" alt="shape-img">
            </div>
            <div class="fry-shape">
                <img src="assets/img/shape/fry-shape.png" alt="shape-img">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 wow fadeInUp" data-wow-delay=".3s">
                        <div class="single-offer-items bg-cover" style="background-image: url('assets/img/banner/offer-bg.png');">
                            <div class="offer-content">
                                <h5>crispy, every bite taste</h5>
                                <h3>
                                    SUPER <br>
                                    DELICIOUS 
                                </h3>
                            </div>
                            <div class="offer-image">
                                <img src="assets/img/offer/50percent-off.png" alt="offer-img">
                            </div>
                            <div class="burger-text">
                                <img src="assets/img/shape/burger-text.png" alt="shape-img">
                            </div>
                            <div class="main-food">
                                <img src="assets/img/food/main-food.png" alt="food-img">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 mt-5 mt-xl-0 wow fadeInUp" data-wow-delay=".5s">
                        <div class="pizza-banner-items bg-cover" style="background-image: url(assets/img/banner/pizza-bg.png);">
                            <div class="pizza-text">
                                <img src="assets/img/shape/pizza-text.png" alt="shape-img">
                            </div>
                            <div class="pizza-text-2">
                                <img src="assets/img/shape/pizza-text-2.png" alt="shape-img">
                            </div>
                            <div class="pizza-image">
                                <img src="assets/img/food/pizza-2.png" alt="pizza-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Brand Section Start -->
        <section class="brand-shape section-padding fix section-bg pt-0">
            <div class="container">
                <div class="brand-wrapper">
                    <div class="brand-title">
                        <h4>
                            Global <span>5K+</span> Happy Sponsors With us
                        </h4>
                    </div>
                    <div class="swiper brand-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="brand-image">
                                    <img src="assets/img/brand/01.svg" alt="brand-img">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand-image">
                                    <img src="assets/img/brand/02.svg" alt="brand-img">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand-image">
                                    <img src="assets/img/brand/03.svg" alt="brand-img">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand-image">
                                    <img src="assets/img/brand/04.svg" alt="brand-img">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand-image">
                                    <img src="assets/img/brand/05.svg" alt="brand-img">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand-image">
                                    <img src="assets/img/brand/06.svg" alt="brand-img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Grilled Banner Section Start -->
        <section class="grilled-banner fix section-padding bg-cover" style="background-image: url('assets/img/banner/main-bg.jpg');">
            <div class="patato-shape">
                <img src="assets/img/shape/patato-shape.png" alt="shape-img">
            </div>
            <div class="offer-shape float-bob-y">
                <img src="assets/img/offer/50percent-off-2.png" alt="shape-img">
            </div>
            <div class="text-shape">
                <img src="assets/img/shape/pizza-text-2.png" alt="shape-img">
            </div>
            <div class="spicy-shape">
                <img src="assets/img/shape/spicy.png" alt="shape-img">
            </div>
            <div class="tomato-shape">
                <img src="assets/img/shape/tomato-shape-2.png" alt="shape-img">
            </div>
            <div class="container">
                <div class="grilled-wrapper">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6">
                            <div class="grilled-content">
                                <h4 class="wow fadeInUp">
                                    save 20%
                                </h4>
                                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                    tODAY'S <span>ASTACKIN</span> DAY
                                </h2>
                                <h3 class="wow fadeInUp" data-wow-delay=".5s">
                                    <a href="shop.html">
                                    grilled <span class="text-1">chiken</span>
                                    </a>
                                    <span class="text-2">$59,00</span>
                                </h3>
                                <div class="grilled-button wow fadeInUp" data-wow-delay=".7s">
                                    <a href="shop-single.html" class="theme-btn">
                                    <span class="button-content-wrapper d-flex align-items-center">
                                    <span class="button-icon"><i class="flaticon-delivery"></i></span>
                                    <span class="button-text">order now</span>
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mt-5 mt-lg-0 wow fadeInUp" data-wow-delay=".4s">
                            <div class="grilled-image">
                                <img src="assets/img/food/grilled.png" alt="grilled-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Food Catagory Section Start -->
        <section class="food-category-section fix section-padding section-bg">
            <div class="container">
                <div class="section-title text-center">
                    <span class="wow fadeInUp">crispy, every bite taste</span>
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">Popular Food Items</h2>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="catagory-product-card-2 text-center">
                            <div class="icon">
                                <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="catagory-product-image">
                                <img src="assets/img/food/beef-ruti.png" alt="product-img">
                            </div>
                            <div class="catagory-product-content">
                                <div class="catagory-button">
                                    <a href="shop-cart.html" class="theme-btn-2"><i class="far fa-shopping-basket"></i>Add To Cart</a>
                                </div>
                                <div class="info-price d-flex align-items-center justify-content-center">
                                    <p>-5%</p>
                                    <h6>$30.52</h6>
                                    <span>$28.52</span>
                                </div>
                                <h4>
                                    <a href="shop-single.html">ruti with beef slice</a>
                                </h4>
                                <div class="star">
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star text-white"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                        <div class="catagory-product-card-2 active text-center">
                            <div class="icon">
                                <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="catagory-product-image">
                                <img src="assets/img/food/burger-2.png" alt="product-img">
                            </div>
                            <div class="catagory-product-content">
                                <div class="catagory-button">
                                    <a href="shop-cart.html" class="theme-btn-2"><i class="far fa-shopping-basket"></i>Add To Cart</a>
                                </div>
                                <div class="info-price d-flex align-items-center justify-content-center">
                                    <p>-5%</p>
                                    <h6>$30.52</h6>
                                    <span>$28.52</span>
                                </div>
                                <h4>
                                    <a href="shop-single.html">Whopper Burger King</a>
                                </h4>
                                <div class="star">
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star text-white"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                        <div class="catagory-product-card-2 text-center">
                            <div class="icon">
                                <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="catagory-product-image">
                                <img src="assets/img/food/pasta-2.png" alt="product-img">
                            </div>
                            <div class="catagory-product-content">
                                <div class="catagory-button">
                                    <a href="shop-cart.html" class="theme-btn-2"><i class="far fa-shopping-basket"></i>Add To Cart</a>
                                </div>
                                <div class="info-price d-flex align-items-center justify-content-center">
                                    <p>-5%</p>
                                    <h6>$30.52</h6>
                                    <span>$28.52</span>
                                </div>
                                <h4>
                                    <a href="shop-single.html">Chiness pasta</a>
                                </h4>
                                <div class="star">
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star text-white"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                        <div class="catagory-product-card-2 text-center">
                            <div class="icon">
                                <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="catagory-product-image">
                                <img src="assets/img/food/pizza-3.png" alt="product-img">
                            </div>
                            <div class="catagory-product-content">
                                <div class="catagory-button">
                                    <a href="shop-cart.html" class="theme-btn-2"><i class="far fa-shopping-basket"></i>Add To Cart</a>
                                </div>
                                <div class="info-price d-flex align-items-center justify-content-center">
                                    <p>-5%</p>
                                    <h6>$30.52</h6>
                                    <span>$28.52</span>
                                </div>
                                <h4>
                                    <a href="shop-single.html">delicious burger</a>
                                </h4>
                                <div class="star">
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star text-white"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="catagory-product-card-2 text-center">
                            <div class="icon">
                                <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="catagory-product-image">
                                <img src="assets/img/food/main-food-2.png" alt="product-img">
                            </div>
                            <div class="catagory-product-content">
                                <div class="catagory-button">
                                    <a href="shop-cart.html" class="theme-btn-2"><i class="far fa-shopping-basket"></i>Add To Cart</a>
                                </div>
                                <div class="info-price d-flex align-items-center justify-content-center">
                                    <p>-5%</p>
                                    <h6>$30.52</h6>
                                    <span>$28.52</span>
                                </div>
                                <h4>
                                    <a href="shop-single.html">fast food combo</a>
                                </h4>
                                <div class="star">
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star text-white"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                        <div class="catagory-product-card-2 text-center">
                            <div class="icon">
                                <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="catagory-product-image">
                                <img src="assets/img/food/ruti.png" alt="product-img">
                            </div>
                            <div class="catagory-product-content">
                                <div class="catagory-button">
                                    <a href="shop-cart.html" class="theme-btn-2"><i class="far fa-shopping-basket"></i>Add To Cart</a>
                                </div>
                                <div class="info-price d-flex align-items-center justify-content-center">
                                    <p>-5%</p>
                                    <h6>$30.52</h6>
                                    <span>$28.52</span>
                                </div>
                                <h4>
                                    <a href="shop-single.html">ruti with chiken</a>
                                </h4>
                                <div class="star">
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star text-white"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                        <div class="catagory-product-card-2 text-center">
                            <div class="icon">
                                <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="catagory-product-image">
                                <img src="assets/img/food/grilled-2.png" alt="product-img">
                            </div>
                            <div class="catagory-product-content">
                                <div class="catagory-button">
                                    <a href="shop-cart.html" class="theme-btn-2"><i class="far fa-shopping-basket"></i>Add To Cart</a>
                                </div>
                                <div class="info-price d-flex align-items-center justify-content-center">
                                    <p>-5%</p>
                                    <h6>$30.52</h6>
                                    <span>$28.52</span>
                                </div>
                                <h4>
                                    <a href="shop-single.html">grilled chiken</a>
                                </h4>
                                <div class="star">
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star text-white"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                        <div class="catagory-product-card-2 text-center">
                            <div class="icon">
                                <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                            </div>
                            <div class="catagory-product-image">
                                <img src="assets/img/food/delicious-burger.png" alt="product-img">
                            </div>
                            <div class="catagory-product-content">
                                <div class="catagory-button">
                                    <a href="shop-cart.html" class="theme-btn-2"><i class="far fa-shopping-basket"></i>Add To Cart</a>
                                </div>
                                <div class="info-price d-flex align-items-center justify-content-center">
                                    <p>-5%</p>
                                    <h6>$30.52</h6>
                                    <span>$28.52</span>
                                </div>
                                <h4>
                                    <a href="shop-single.html">delicious burger</a>
                                </h4>
                                <div class="star">
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star text-white"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="catagory-button text-center pt-4 wow fadeInUp" data-wow-delay=".3s">
                    <a href="shop.html" class="theme-btn">
                    <span class="button-content-wrapper d-flex align-items-center">
                    <span class="button-icon"><i class="flaticon-delivery"></i></span>
                    <span class="button-text">view more</span>
                    </span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Food Comboo Section Start -->
        <section class="food-comboo-section fix bg-cover section-padding" style="background-image: url('assets/img/bg-image/bg.jpg');">
            <div class="drinks-shape">
                <img src="assets/img/shape/drinks.png" alt="shape-img">
            </div>
            <div class="container">
                <div class="comboo-wrapper">
                    <div class="row align-items-center">
                        <div class="col-xl-6">
                            <div class="food-comboo-content">
                                <div class="section-title">
                                    <span class="wow fadeInUp">crispy, every bite taste</span>
                                    <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                        trending Food combo
                                        offer less <span>20%</span>
                                    </h2>
                                </div>
                                <p class="wow fadeInUp" data-wow-delay=".5s">
                                    A team of dreamers and doers building unique interactive music and art festivals.
                                </p>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link wow fadeInUp" data-wow-delay=".3s" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                    <span class="food-comboo-list">
                                    <span class="offer-image">
                                    <img src="assets/img/offer/chicken.png" alt="img">
                                    </span>
                                    <span class="comboo-title">
                                    30% off 4pcs hot crispy & 8 pcs wing
                                    </span>
                                    </span>
                                    </button>
                                    <button class="nav-link active wow fadeInUp" data-wow-delay=".5s" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                                    <span class="food-comboo-list">
                                    <span class="offer-image">
                                    <img src="assets/img/offer/pizza.png" alt="img">
                                    </span>
                                    <span class="comboo-title">
                                    20% off tasty pizza with drink
                                    </span>
                                    </span>
                                    </button>
                                    <button class="nav-link wow fadeInUp" data-wow-delay=".7s" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                                    <span class="food-comboo-list">
                                    <span class="offer-image">
                                    <img src="assets/img/offer/burger.png" alt="img">
                                    </span>
                                    <span class="comboo-title">
                                    2pcs humbergur with drinks & sauce
                                    </span>
                                    </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="tab-content" id="nav-tab-Content">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="comboo-image bg-cover" style="background-image: url('assets/img/banner/comboo-bg.jpg');">
                                        <div class="pizza-text">
                                            <img src="assets/img/shape/combo-pizza-text.png" alt="shape-img">
                                        </div>
                                        <div class="pizza-image">
                                            <img src="assets/img/food/big-pizza.png" alt="food-img">
                                        </div>
                                        <div class="offer-shape">
                                            <img src="assets/img/offer/50percent-off-2.png" alt="shape-img">
                                        </div>
                                        <div class="vegetable-shape">
                                            <img src="assets/img/shape/vegetable.png" alt="shape-img">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="comboo-image bg-cover" style="background-image: url('assets/img/banner/comboo-bg.jpg');">
                                        <div class="pizza-text">
                                            <img src="assets/img/shape/combo-pizza-text.png" alt="shape-img">
                                        </div>
                                        <div class="pizza-image">
                                            <img src="assets/img/food/big-pizza.png" alt="food-img">
                                        </div>
                                        <div class="offer-shape">
                                            <img src="assets/img/offer/50percent-off-2.png" alt="shape-img">
                                        </div>
                                        <div class="vegetable-shape">
                                            <img src="assets/img/shape/vegetable.png" alt="shape-img">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="comboo-image bg-cover" style="background-image: url('assets/img/banner/comboo-bg.jpg');">
                                        <div class="pizza-text">
                                            <img src="assets/img/shape/combo-pizza-text.png" alt="shape-img">
                                        </div>
                                        <div class="pizza-image">
                                            <img src="assets/img/food/big-pizza.png" alt="food-img">
                                        </div>
                                        <div class="offer-shape">
                                            <img src="assets/img/offer/50percent-off-2.png" alt="shape-img">
                                        </div>
                                        <div class="vegetable-shape">
                                            <img src="assets/img/shape/vegetable.png" alt="shape-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Marque Section Start -->
        <div class="marque-section fix section-padding pt-0 section-bg">
            <div class="marquee-wrapper text-slider">
                <div class="marquee-inner to-left">
                    <ul class="marqee-list d-flex">
                        <li class="marquee-item">
                            <span class="text-slider text-color">populer</span><span class="text-slider"></span> <span class="text-slider text-color">dishes</span>
                            <span class="text-slider"><img src="assets/img/icon/burger.png" alt="icon-img"></span> <span class="text-slider"></span> <span class="text-slider text-color-2">delicious</span>
                            <span class="text-slider text-color-2">food</span> <img src="assets/img/icon/pizza.png" alt="icon-img"> <span class="text-slider"></span> <span class="text-slider text-color">populer</span>
                            <span class="text-slider text-color">dishes</span> <span class="text-slider"></span><span class="text-slider"><img src="assets/img/icon/burger.png" alt="icon-img"></span> <span class="text-slider"></span> <span class="text-slider text-color-2">delicious</span>
                            <span class="text-slider text-color">populer</span><span class="text-slider"></span> <span class="text-slider text-color">dishes</span>
                            <span class="text-slider"><img src="assets/img/icon/burger.png" alt="icon-img"></span> <span class="text-slider"></span> <span class="text-slider text-color-2">delicious</span>
                            <span class="text-slider text-color-2">food</span> <img src="assets/img/icon/pizza.png" alt="icon-img"> <span class="text-slider"></span> <span class="text-slider text-color">populer</span>
                            <span class="text-slider text-color">dishes</span> <span class="text-slider"></span><span class="text-slider"><img src="assets/img/icon/burger.png" alt="icon-img"></span> <span class="text-slider"></span> <span class="text-slider text-color-2">delicious</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Choose Us Section Start -->
        <section class="choose-us fix section-padding pt-0 section-bg">
            <div class="container">
                <div class="food-icon-wrapper bg-cover" style="background-image: url('assets/img/shape/food-shape-2.png');">
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                            <div class="single-food-icon">
                                <div class="icon">
                                    <i class="flaticon-quality"></i>
                                </div>
                                <div class="content">
                                    <h4>super quality food</h4>
                                    <p>
                                        A team of dreamers and doers building
                                        unique interactive music and art
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                            <div class="single-food-icon">
                                <div class="icon">
                                    <i class="flaticon-cooking"></i>
                                </div>
                                <div class="content">
                                    <h4>original recipes</h4>
                                    <p>
                                        A team of dreamers and doers building
                                        unique interactive music and art
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                            <div class="single-food-icon">
                                <div class="icon">
                                    <i class="flaticon-fast-delivery"></i>
                                </div>
                                <div class="content">
                                    <h4>quick fast delivery</h4>
                                    <p>
                                        A team of dreamers and doers building
                                        unique interactive music and art
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".9s">
                            <div class="single-food-icon">
                                <div class="icon">
                                    <i class="flaticon-quality"></i>
                                </div>
                                <div class="content">
                                    <h4>100% fresh foods</h4>
                                    <p>
                                        A team of dreamers and doers building
                                        unique interactive music and art
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section Start -->
        <section class="about-section fix section-padding pt-0 section-bg">
            <div class="container">
                <div class="about-wrapper">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                            <div class="about-image">
                                <img src="assets/img/about/burger.png" alt="about-img">
                                <div class="burger-text">
                                    <img src="assets/img/about/burger-text.png" alt="shape-img">
                                </div>
                                <div class="price">
                                    <h2>$<span class="count">4,99</span></h2>
                                </div>
                                <div class="since-text bg-cover" style="background-image: url('assets/img/shape/food-shape.png');">
                                    <h3>since /1985</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mt-5 mt-lg-0">
                            <div class="about-content">
                                <div class="section-title">
                                    <span class="wow fadeInUp">about our food</span>
                                    <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                        Where Quality Meet
                                        Excellent <span>Service.</span>
                                    </h2>
                                </div>
                                <p class="wow fadeInUp" data-wow-delay=".5s">
                                    It's the perfect dining experience where every dish is crafted with fresh, high-quality
                                    Experience quick and efficient service that ensures your food is servead fresh It's the
                                    dining experience where every dish is crafted with fresh, high-quality ingredients
                                </p>
                                <div class="icon-area">
                                    <div class="icon-items d-flex wow fadeInUp" data-wow-delay=".3s">
                                        <div class="icon">
                                            <i class="flaticon-quality"></i>
                                        </div>
                                        <div class="content">
                                            <h4>super quality food</h4>
                                            <p>
                                                A team of dreamers and doers build
                                                unique interactive music and art
                                            </p>
                                        </div>
                                    </div>
                                    <div class="icon-items d-flex wow fadeInUp" data-wow-delay=".5s">
                                        <div class="icon">
                                            <i class="flaticon-reputation"></i>
                                        </div>
                                        <div class="content">
                                            <h4>well reputation</h4>
                                            <p>
                                                A team of dreamers and doers build
                                                unique interactive music and art
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-area d-flex align-items-center">
                                    <a href="about.html" class="theme-btn wow style-line-height fadeInUp" data-wow-delay=".3s">more about us</a>
                                    <div class="info-content wow fadeInUp" data-wow-delay=".5s">
                                        <span>BRENDON GARREY</span>
                                        <h6>Customer’s experience is our highest priority.</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Food Banner Section Start -->
        <section class="food-banner-section fix section-padding section-bg pt-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 wow fadeInUp" data-wow-delay=".3s">
                        <div class="burger-banner-items bg-cover" style="background-image: url(assets/img/banner/burger-bg.png);">
                            <div class="burger-content text-center">
                                <h3>today</h3>
                                <h2>special</h2>
                                <h4><a href="shop.html" class="text-white">beef <span>burger</span></a></h4>
                                <a href="shop-single.html" class="theme-btn mt-4">
                                <span class="button-content-wrapper d-flex align-items-center">
                                <span class="button-icon"><i class="flaticon-delivery"></i></span>
                                <span class="button-text">order now</span>
                                </span>
                                </a>
                            </div>
                            <div class="burger-image">
                                <img src="assets/img/food/big-burger.png" alt="food-img">
                            </div>
                            <div class="text-shape">
                                <img src="assets/img/shape/pizza-text-2.png" alt="shape-img">
                            </div>
                            <div class="burger-text">
                                <img src="assets/img/shape/burger-text.png" alt="shape-img">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-9 mt-5 mt-xl-0 wow fadeInUp" data-wow-delay=".5s">
                        <div class="single-offer-items style-2 bg-cover" style="background-image: url('assets/img/banner/pepsi-bg.png');">
                            <div class="offer-content">
                                <h5>crispy, every bite taste</h5>
                                <h3>
                                    FASH FOOD <br>
                                    MEAL
                                </h3>
                                <p>
                                    The mouth-watering aroma of <br>
                                    sizzling burgers
                                </p>
                                <a href="shop-single.html" class="theme-btn mt-4">
                                <span class="button-content-wrapper d-flex align-items-center">
                                <span class="button-icon"><i class="flaticon-delivery"></i></span>
                                <span class="button-text">order now</span>
                                </span>
                                </a>
                            </div>
                            <div class="offer-img">
                                <img src="assets/img/offer/50percent-off-3.png" alt="shape-img">
                            </div>
                            <div class="roller-box">
                                <img src="assets/img/food/roller-box.png" alt="food-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- KFC Banner Section Start -->
        <section class="kfc-banner fix bg-cover section-padding" style="background-image: url('assets/img/bg-image/bg.jpg');">
            <div class="kfc-wrapper">
                <div class="container-fluid">
                    <div class="row justify-content-between">
                        <div class="col-lg-5">
                            <div class="kfc-image-items bg-cover" style="background-image: url('assets/img/banner/kfc-bg.png');">
                                <div class="kfc-image">
                                    <img src="assets/img/food/kfc.png" alt="food-img">
                                </div>
                                <div class="offer-shape">
                                    <img src="assets/img/offer/50percent-off-2.png" alt="shape-img">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="kfc-content text-center">
                                <div class="section-title">
                                    <span class="wow fadeInUp">crispy, every bite taste</span>
                                    <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                        kfc chiken hot <br>
                                        wing & french fries
                                    </h2>
                                </div>
                                <p class="mt-3 mt-lg-0 wow fadeInUp" data-wow-delay=".5s">
                                    Wheat tortilla with spicy chicken bites, cheese sauce <br>
                                    tomatoes and soft cheese
                                </p>
                                <a href="shop-single.html" class="theme-btn mt-5 wow fadeInUp" data-wow-delay=".8s">
                                <span class="button-content-wrapper d-flex align-items-center">
                                <span class="button-icon"><i class="flaticon-delivery"></i></span>
                                <span class="button-text">order now</span>
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial Section Start -->
        <section class="testimonial-section fix section-padding section-bg">
            <div class="burger-shape">
                <img src="assets/img/shape/burger-shape-3.png" alt="burger-shape">
            </div>
            <div class="fry-shape">
                <img src="assets/img/shape/fry-shape-2.png" alt="burger-shape">
            </div>
            <div class="pizza-shape">
                <img src="assets/img/shape/pizzashape.png" alt="burger-shape">
            </div>
            <div class="container">
                <div class="testimonial-wrapper style-responsive">
                    <div class="testimonial-items text-center">
                        <div class="swiper testimonial-content-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testimonial-content">
                                        <div class="client-info">
                                            <h4>Piter Bowman</h4>
                                            <h5>Business CEO & co founder</h5>
                                        </div>
                                        <h3>
                                            “Thank you for dinner last night. It was amazing!! I have
                                            say it’s the best meal I have had in quite some time.
                                            will definitely be seeing more eating next year.”
                                        </h3>
                                        <div class="star">
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial-content">
                                        <div class="client-info">
                                            <h4>Piter Bowman</h4>
                                            <h5>Business CEO & co founder</h5>
                                        </div>
                                        <h3>
                                            “Thank you for dinner last night. It was amazing!! I have
                                            say it’s the best meal I have had in quite some time.
                                            will definitely be seeing more eating next year.”
                                        </h3>
                                        <div class="star">
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial-content">
                                        <div class="client-info">
                                            <h4>Piter Bowman</h4>
                                            <h5>Business CEO & co founder</h5>
                                        </div>
                                        <h3>
                                            “Thank you for dinner last night. It was amazing!! I have
                                            say it’s the best meal I have had in quite some time.
                                            will definitely be seeing more eating next year.”
                                        </h3>
                                        <div class="star">
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper testimonial-image-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="client-image-item">
                                        <div class="client-img bg-cover" style="background-image: url('assets/img/client/01.jpg')"></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-image-item">
                                        <div class="client-img bg-cover" style="background-image: url('assets/img/client/02.jpg')"></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="client-image-item">
                                        <div class="client-img bg-cover" style="background-image: url('assets/img/client/03.jpg')"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Cta Banner Section Start -->
        <section class="main-cta-banner section-padding pt-0">
            <div class="container">
                <div class="main-cta-banner-wrapper bg-cover mt-10" style="background-image: url('assets/img/banner/main-cta-bg.jpg');">
                    <div class="section-title">
                        <span class="theme-color-3 wow fadeInUp">crispy, every bite taste</span>
                        <h2 class="text-white wow fadeInUp" data-wow-delay=".3s">
                            30 minutes fast <br>
                            <span class="theme-color-3">delivery</span> challage
                        </h2>
                    </div>
                    <a href="shop-single.html" class="theme-btn bg-white mt-4 mt-md-0 wow fadeInUp" data-wow-delay=".5s">
                    <span class="button-content-wrapper d-flex align-items-center">
                    <span class="button-icon"><i class="flaticon-delivery"></i></span>
                    <span class="button-text">order now</span>
                    </span>
                    </a>
                    <div class="arrow-shape">
                        <img src="assets/img/shape/arrow-shape.png" alt="shape-img">
                    </div>
                    <div class="delivery-man">
                        <img src="assets/img/delivery-man.png" alt="img">
                    </div>
                    <div class="frame-shape">
                        <img src="assets/img/shape/frame.png" alt="shape-img">
                    </div>
                </div>
            </div>
        </section>

        <!-- Booking Section Start -->
        <section class="booking-section fix section-padding bg-cover" style="background-image: url('assets/img/banner/main-bg.jpg');">
            <div class="container">
                <div class="booking-wrapper style-responsive section-padding pb-0">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-lg-6">
                            <div class="booking-content">
                                <div class="section-title">
                                    <span class="wow fadeInUp">crispy, every bite taste</span>
                                    <h2 class="text-white wow fadeInUp" data-wow-delay=".3s">
                                        need booking? <br>
                                        reserve your table?
                                    </h2>
                                </div>
                                <div class="icon-items d-flex align-items-center wow fadeInUp" data-wow-delay=".5s">
                                    <div class="icon">
                                        <i class="flaticon-phone-call-2"></i>
                                    </div>
                                    <div class="content">
                                        <h5>24/7 Support center</h5>
                                        <h3><a href="tel:+1718-904-4450">+1718-904-4450</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mt-5 mt-lg-0 wow fadeInUp" data-wow-delay=".4s">
                            <div class="booking-contact bg-cover" style="background-image: url('assets/img/shape/booking-shape.png');">
                                <h4 class="text-center text-white">create an reservation</h4>
                                <div class="booking-items">
                                    <div class="form-clt">
                                        <div class="nice-select" tabindex="0">
                                            <span class="current">
                                            no of person
                                            </span>
                                            <ul class="list">
                                                <li data-value="1" class="option selected">
                                                    no of person
                                                </li>
                                                <li data-value="1" class="option">
                                                    no of person
                                                </li>
                                                <li data-value="1" class="option">
                                                    no of person
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-clt">
                                        <input type="text" name="number" id="number" placeholder="phone number">
                                        <div class="icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <div class="form-clt">
                                        <input type="date" id="calendar" name="calendar">
                                    </div>
                                    <div class="form-clt">
                                        <a href="reservation.html" class="theme-btn bg-yellow">
                                        booking now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--<< Footer Section Start >>-->
        <footer class="footer-section fix section-bg">
   <div class="burger-shape">
      <img src="assets/img/shape/burger-shape-3.png" alt="burger-shape">
   </div>
   <div class="fry-shape">
      <img src="assets/img/shape/fry-shape-2.png" alt="burger-shape">
   </div>
   <div class="container">
      <div class="footer-widgets-wrapper">
         <div class="row">
            <div class="col-xl-3 col-sm-6 col-md-6 col-lg-3 wow fadeInUp" data-wow-delay=".2s">
               <div class="single-footer-widget">
                  <div class="widget-head">
                     <a href="index-2.html">
                     <img src="assets/img/logo/logo.svg" alt="logo-img">
                     </a>
                  </div>
                  <div class="footer-content">
                     <p>
                        We believe it has the power to do <br>
                        amazing things.
                     </p>
                     <span>Interested in working with us?</span> <br>
                     <a href="mailto:info@example.com" class="link">info@example.com</a>
                     <div class="social-icon d-flex align-items-center">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-vimeo-v"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-2 ps-lg-5 col-sm-6 col-md-3 col-lg-3 wow fadeInUp" data-wow-delay=".4s">
               <div class="single-footer-widget">
                  <div class="widget-head">
                     <h4>Quick Links</h4>
                  </div>
                  <ul class="list-items">
                     <li>
                        <a href="about.html"> 
                        Services
                        </a>
                     </li>
                     <li>
                        <a href="about.html">
                        About company
                        </a>
                     </li>
                     <li>
                        <a href="news-details.html">
                        latest news
                        </a>
                     </li>
                     <li>
                        <a href="team.html">
                        team member
                        </a>
                     </li>
                     <li>
                        <a href="testimonial.html">
                        testimonials
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-xl-2 ps-lg-4 col-sm-6 col-md-3 col-lg-3 wow fadeInUp" data-wow-delay=".6s">
               <div class="single-footer-widget">
                  <div class="widget-head">
                     <h4>My account</h4>
                  </div>
                  <ul class="list-items">
                     <li>
                        <a href="shop-single.html">
                        My Profile
                        </a>
                     </li>
                     <li>
                        <a href="shop-single.html">
                        My Order History
                        </a>
                     </li>
                     <li>
                        <a href="shop-single.html">
                        My Wish List
                        </a>
                     </li>
                     <li>
                        <a href="shop-single.html">
                        Order Tracking
                        </a>
                     </li>
                     <li>
                        <a href="shop-cart.html">
                        Shopping Cart
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-xl-2 col-sm-6 col-md-6 col-lg-3 wow fadeInUp" data-wow-delay=".8s">
               <div class="single-footer-widget">
                  <div class="widget-head">
                     <h4>Address:</h4>
                  </div>
                  <div class="footer-address-text">
                     <h6>
                        570 8th Ave, New York,NY <span>10018</span>
                        United States
                     </h6>
                     <h5>Hours:</h5>
                     <h6>
                        9.30am – 6.30pm <br>
                        Monday to Friday
                     </h6>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 ps-xl-5 col-sm-6 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".9s">
               <div class="single-footer-widget">
                  <div class="widget-head">
                     <h4>Install app</h4>
                  </div>
                  <div class="footer-apps-items">
                     <h5>From App Store or Google Play</h5>
                     <div class="apps-image d-flex align-items-center">
                        <a href="#"><img src="assets/img/app-store.png" alt="store-img"></a>
                        <a href="#"><img src="assets/img/google-play.png" alt="store-img"></a>
                     </div>
                     <div class="support-text">
                        <h5>24/7 Support center</h5>
                        <h3><a href="tel:+1718-904-4450">+1718-904-4450</a></h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="footer-bottom">
      <div class="container">
         <div class="footer-bottom-wrapper d-flex align-items-center justify-content-between">
            <p class="wow fadeInLeft" data-wow-delay=".3s">
               © Copyright <span class="theme-color-3">2025</span> <a href="index-2.html">Foodking </a>. All Rights Reserved.
            </p>
            <div class="card-image wow fadeInRight" data-wow-delay=".5s">
               <img src="assets/img/card.png" alt="card-img">
            </div>
         </div>
      </div>
   </div>
</footer>
        <!-- Back to top area start here -->
        
<div class="scroll-up">
    <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
    </svg>
</div>
        <!--<< All JS Plugins >>-->
        
<script src="assets/js/jquery-3.7.1.min.js"></script>
<!--<< Viewport Js >>-->
<script src="assets/js/viewport.jquery.js"></script>
<!--<< Bootstrap Js >>-->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--<< Nice Select Js >>-->
<script src="assets/js/jquery.nice-select.min.js"></script>
<!--<< Waypoints Js >>-->
<script src="assets/js/jquery.waypoints.js"></script>
<!--<< Counterup Js >>-->
<script src="assets/js/jquery.counterup.min.js"></script>
<!--<< Swiper Slider Js >>-->
<script src="assets/js/swiper-bundle.min.js"></script>
<!--<< MeanMenu Js >>-->
<script src="assets/js/jquery.meanmenu.min.js"></script>
<!--<< Magnific Popup Js >>-->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!--<< GSAP Animation Js >>-->
<script src="assets/js/animation.js"></script>
<!--<< Wow Animation Js >>-->
<script src="assets/js/wow.min.js"></script>
<!--<< Contact From.js >>-->
<script src="assets/js/contact-from.js"></script>
<!--<< Main.js >>-->
<script src="assets/js/main.js"></script>

    </body>

<!-- Mirrored from bizantheme.com/html/foodking-php/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Apr 2025 03:04:18 GMT -->
</html>