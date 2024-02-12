<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
        <head>
            <meta name="yandex-verification" content="8763efc20d08d512" />
            <meta name="google-site-verification" content="UTRL483Sm-pchNyJIGdlBKqSf4oISXKsJzDR0utvUDM" />
            <meta property="og:type" content="website">
            <meta property="og:url" content="https://mopsnet.ru">
            <meta property="og:title" content="MopsNET">
            <meta property="og:description" content="Разработка сайтов и приложений">
            <meta property="og:image" content="https://mopsnet.ru/frontend/web/images/mopsnet-op.png">

            <meta name="viewport" content="width=device-width, initial-scale=0.99">
            <meta charset="<?= Yii::$app->charset ?>">
            <?php $this->registerCsrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>
            <?php $this->head() ?>
            <link rel="shortcut icon" href="<?= Url::base() ?>/images/logo.svg" type="image/x-icon">

            <?php if (!YII_DEBUG): ?>
                <!-- Yandex.Metrika counter -->
                <script type="text/javascript">
                    (function (m, e, t, r, i, k, a) {
                        m[i] = m[i] || function () {
                            (m[i].a = m[i].a || []).push(arguments)
                        };
                        m[i].l = 1 * new Date();
                        for (var j = 0; j < document.scripts.length; j++) {
                            if (document.scripts[j].src === r) {
                                return;
                            }
                        }
                        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
                    })
                    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

                    ym(94647972, "init", {
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true,
                        webvisor: true,
                        trackHash: true
                    });
                </script>
                <noscript>
                    <div><img src="https://mc.yandex.ru/watch/94647972" style="position:absolute; left:-9999px;" alt=""/>
                    </div>
                </noscript>
                <!-- /Yandex.Metrika counter -->

                <!-- Varioqub experiments -->
                <script type="text/javascript">
                    (function (e, x, pe, r, i, me, nt) {
                        e[i] = e[i] || function () {
                            (e[i].a = e[i].a || []).push(arguments)
                        },
                            me = x.createElement(pe), me.async = 1, me.src = r, nt = x.getElementsByTagName(pe)[0], nt.parentNode.insertBefore(me, nt)
                    })
                    (window, document, 'script', 'https://abt.s3.yandex.net/expjs/latest/exp.js', 'ymab');
                    ymab('metrika.94647972', 'init'/*, {clientFeatures}, {callback}*/);
                </script>

                <!-- Top.Mail.Ru counter -->
                <script type="text/javascript">
                    var _tmr = window._tmr || (window._tmr = []);
                    _tmr.push({id: "3385443", type: "pageView", start: (new Date()).getTime()});
                    (function (d, w, id) {
                        if (d.getElementById(id)) return;
                        var ts = d.createElement("script");
                        ts.type = "text/javascript";
                        ts.async = true;
                        ts.id = id;
                        ts.src = "https://top-fwz1.mail.ru/js/code.js";
                        var f = function () {
                            var s = d.getElementsByTagName("script")[0];
                            s.parentNode.insertBefore(ts, s);
                        };
                        if (w.opera == "[object Opera]") {
                            d.addEventListener("DOMContentLoaded", f, false);
                        } else {
                            f();
                        }
                    })(document, window, "tmr-code");
                </script>
                <noscript>
                    <div><img src="https://top-fwz1.mail.ru/counter?id=3385443;js=na"
                              style="position:absolute;left:-9999px;" alt="Top.Mail.Ru"/></div>
                </noscript>
                <!-- /Top.Mail.Ru counter -->
            <?php endif; ?>

        </head>
        <body class="d-flex flex-column h-100">
        <?php $this->beginBody() ?>

        <main role="main" class="flex-shrink-0">
            <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>

        <?php $this->endBody() ?>

        </body>
    </html>
<?php $this->endPage();
