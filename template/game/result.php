<!doctype html>
<html lang="en">
    <head>
      <? require_once(TEMPLATE_ROOT . 'base/head.php') ?>
    </head>
<body>
    <main role="main">
        <div class="container">
            <div class="col-md-12">
                <h1><?=LANG_APP_NAME?></h1>
                <div class="mb-5"></div>

                <p><?=LANG_GAME_RESULT?></p>
                <p><?=$response['success_points']?> <?=LANG_CORRECT_MOVIES?> <?=LANG_WITH?> <?=$response['count_points']?></p>
                <div class="mb-5"></div>

                <a class="btn btn-primary btn-sm" href="/" role="button"><?=LANG_HOME?></a>
            </div>
        </div>
    </main>
</body>
  <? require_once(TEMPLATE_ROOT . 'base/footer.php') ?>
</html>