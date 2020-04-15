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
                <div class="mb-3"></div>

                <dt><?=$response['map']['title']?></dt>
                <dd><?=$response['map']['description']?></dd>
                <div class="mb-5"></div>

                <p class="text-center">
                    <a class="btn btn-secondary btn-sm" href="/" role="button"><?=LANG_BACK?></a>
                    <a class="btn btn-primary btn-sm" href="?page=playing" role="button"><?=LANG_GO?></a>
                </p>
            </div>
        </div>
    </main>
</body>
  <? require_once(TEMPLATE_ROOT . 'base/footer.php') ?>
</html>