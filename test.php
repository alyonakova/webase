<?php

require_once 'include/tests.php';
require_once 'include/authentication.php';

$id = $_GET['id'];
$is_training = isset($_GET['training']);

if (!$is_training && !is_logged_in()) {
    http_response_code(401);
    echo "Для прохождения аттестующих тестов нужно сначала <a href='index.php'>войти</a>.";
    echo "<br>";
    echo "Можете также <a href='test.php?training&id=$id'>пройти обучающий тест</a>.";
    die;
}

$test = \tests\get_test_info($id);
$questions = \tests\get_test_questions($id, $is_training);

?>

<?php if ($is_training) { ?>
    <h1>Обучающий тест №&nbsp;<?php echo $test['ordinal'] ?></h1>
<?php } else { ?>
    <h1>Аттестующий тест №&nbsp;<?php echo $test['ordinal'] ?></h1>
<?php } ?>

<form action="check_test.php" method="post" class="test">
    <input type="hidden" name="test_id" value="<?php echo $test['id'] ?>"/>
    <?php foreach ($questions as $question) { ?>
        <section class="question">
            <input name="question<?php echo $question['ordinal'] ?>" type="hidden" value="<?php echo $question['id'] ?>">
            <p class="question ordinal">
                Вопрос №&nbsp;<?php echo $question['ordinal']; ?>
            </p>
            <p class="question text">
                <?php echo $question['text_html']; ?>
            </p>
            <?php if ($question['options'] != null) { ?>
                <?php foreach (str_getcsv($question['options']) as $option) { ?>
                    <label>
                        <input name="answer<?php echo $question['ordinal'] ?>" type="radio"
                               value="<?php echo htmlspecialchars($option) ?>" required>
                        <?php echo $option; ?>
                    </label>
                <?php } ?>
            <?php } else { ?>
                <label>
                    Ответ:
                    <input class="test answer" name="answer<?php echo $question['ordinal'] ?>" type="text" required>
                </label>
            <?php } ?>
        </section>
        <hr>
    <?php } ?>
    <button type="submit">Готово</button>
</form>