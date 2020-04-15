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
                <p><?=$response['message']?></p>

                <p><a class="btn btn-primary" href="?page=start" role="button"><?=LANG_START?></a> </p>
            </div>
        </div>
    </main>
</body>
  <? require_once(TEMPLATE_ROOT . 'base/footer.php') ?>
</html>