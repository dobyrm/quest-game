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
            </div>

            <p><?=$response['point']->title?></p>
            <p><?=$response['point']->description?></p>
            <div class="mb-5"></div>

            <p class="text-center">
                <a class="btn btn-primary btn-sm" href="?page=playing&answer=yes" role="button"><?=LANG_YES?></a>
                <a class="btn btn-primary btn-sm" href="?page=playing&answer=no" role="button"><?=LANG_NO?></a>
            </p>
        </div>
    </main>
</body>
  <? require_once(TEMPLATE_ROOT . 'base/footer.php') ?>
</html>