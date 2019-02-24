<?php

require_once 'include/tests.php';

$id = $_GET['id'];
$test = \tests\get_test_info($id);

?>

<article class="theory">
    <h1>Теория к тесту №&nbsp;<?php echo $test['ordinal']; ?></h1>
    <p>
        <?php echo $test['html_theory'] ?>
    </p>
</article>

<a href="test.php?training&id=<?php echo $id ?>">Пройти обучающий тест №&nbsp;<?php echo $test['ordinal'] ?></a>
