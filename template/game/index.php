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
                <p><?=LANG_APP_DESCRIPTION?></p>
                <div class="mb-3"></div>

                <p><?=LANG_CHOOSE_YOUR_PATH?></p>
                <div class="bd-example">
                    <dl>
                        <? foreach ($response['maps'] as $row) : ?>
                            <dt><?=$row['title']?></dt>
                            <dd><?=$row['description']?></dd>
                            <p><a class="btn btn-primary btn-sm" href="?page=map&id=<?=$row['id']?>" role="button"><?=LANG_START?></a></p>
                            <div class="mb-3"></div>
                        <? endforeach; ?>
                    </dl>
                </div>
            </div>
        </div>
    </main>
</body>
  <? require_once(TEMPLATE_ROOT . 'base/footer.php') ?>
</html>