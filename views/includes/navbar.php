    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>

                </div>

                <div>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="nav-item dropdown d-flex flex-row-reverse">
                            <button class="btn btn-dark dropdown-toggle dropbtn " type="button" id="dropdownMenuButton"
                                onclick="Dropdown()">
                                <i class="fa-solid fa-user"></i>
                                <?= $_SESSION['user'] ?>
                            </button>
                            <ul class="dropdown-menu dropdown-content" id="dropdown-list">
                                <div><a class="text-reset text-decoration-none" href="#"><?= __('Order History') ?></a></div>
                                <div><a class="text-reset text-decoration-none" href="logout.php"><?= __('Logout') ?></a></div>
                                <form action="delete_account.php" method="POST">
                                    <input type="hidden" name="username" value="<?= $_SESSION['user'] ?>">
                                    <button type="submit" class="btn btn-danger"><?= __('Delete Account') ?></button>
                                </form>
                            </ul>
                        </li>
                    <?php else: ?>
                        <a class="text-reset" href="login.html" rel="sponsored"><?= __('Login') ?></a>
                        <div class="vr mx-2"></div>
                        <a class="text-reset" href="register.html"><?= __('Register') ?></a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php"><?= WEBSITE_NAME ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php"><?= __('Home') ?></a></li>

                    <!-- Translation dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-while dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-globe"></i>
                            <?= __('Language') ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <?php
                            // 建立目前網址參數（排除 lang 參數）
                            function select_lang($lang)
                            {
                                $params = $_GET;
                                $params['lang'] = $lang;
                                return basename($_SERVER['PHP_SELF']) . '?' . http_build_query($params);
                            }
                            ?>
                            <div><a class="text-reset text-decoration-none" href="<?= select_lang('en-us'); ?>"><?= __('English(USA)') ?></a></div>
                            <div><a class="text-reset text-decoration-none" href="<?= select_lang('zh-tw'); ?>"><?= __('Chinese(Traditional)') ?></a></div>
                        </ul>
                    </div>

                </ul>
                <form class="d-flex" action="cart.php">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <?= __('Cart') ?>
                        <?php

                        if (isset($_SESSION['cart'])) {
                            $count = count($_SESSION['cart']);
                            echo "<span class='badge bg-dark text-white ms-1 rounded-pill'>$count</span>";
                        } else {
                            echo "
                                <span class='badge bg-dark text-white ms-1 rounded-pill'>0</span>";
                        }

                        // When checkout button is clicked, clear the cart
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
                            unset($_SESSION['cart']);
                        }
                        ?>

                    </button>
                </form>

                <!-- Register & Login for mobile view -->
                <div class="d-lg-none mt-3">
                    <?php if (isset($_SESSION['user'])): ?>
                        <button class="btn btn-while dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                            <?= $_SESSION['user'] ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <div><a class="text-reset text-decoration-none" href="logout.php"><?= __('Logout') ?></a></div>
                            <div><a class="text-reset text-decoration-none" href="#"><?= __('Order History') ?></a></div>
                            <form action="delete_account.php" method="POST">
                                <input type="hidden" name="username" value="<?= $_SESSION['user'] ?>">
                                <button type="submit" class="btn btn-danger"><?= __('Delete Account') ?></button>
                            </form>
                        </ul>
                    <?php else: ?>
                        <a class="text-reset" href="login.html" rel="sponsored"><?= __('Login') ?></a>
                        <div class="vr mx-2"></div>
                        <a class="text-reset" href="register.html"><?= __('Register') ?></a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </nav>