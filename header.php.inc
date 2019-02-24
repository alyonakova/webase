<?php function print_header($where) { ?>
    <header class="header">
        <div class="logo">
            <div class="logo_text">
                <h1><a href="index.php">
                        <img src="assets/img/logo2.png" class="logopng">
                        webase
                    </a></h1>
                <h2>Обучаемся программированию веб-приложений вместе!</h2>
            </div>
        </div>
        <nav class="menubar">
            <ul class="menu">
                <li <?php if ($where == 'index') { ?> class="selected" <?php } ?>>
                    <a href="index.php">Главная</a>
                </li>
                <?php if (is_logged_in()) { ?>
                    <?php if ($_SESSION['user']['is_teacher']) { ?>
                        <li <?php if ($where == 'account') { ?> class="selected" <?php } ?>><a href="teacher_account.php">Личный кабинет</a></li>
                    <?php } else { ?>
                        <li <?php if ($where == 'account') { ?> class="selected" <?php } ?>><a href="student_account.php">Личный кабинет</a></li>
                    <?php }
                } ?>
                <li <?php if ($where == 'course') { ?> class="selected" <?php } ?>><a href="course.php">Обучение</a></li>
                <li <?php if ($where == 'rules') { ?> class="selected" <?php } ?>><a href="rules.php">О курсе</a></li>
                <?php if (is_logged_in()) { ?>
                    <li><a href="logout.php">Выход</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
<?php } ?>
