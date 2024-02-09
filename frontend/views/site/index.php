<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application МОПС';

?>

<!--Hey! This is the original version
of Simple CSS Waves-->

<div class="header">

    <!--Content before waves-->
    <div class="inner-header flex">
        <!--Just the logo.. Don't mind this-->
        <img src="/frontend/web/images/logo.svg" height="150px">
        <div>
            <h1 style="color: black">MopsNET</h1>
            <h5>Разработка сайтов и приложений</h5>
        </div>
    </div>

    <!--Waves Container-->
    <div>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
            </g>
        </svg>
    </div>
    <!--Waves end-->

</div>
<!--Header ends-->

<!--Content starts-->
<div class="content flex">
    <div style="width: 100%">
        <div>
            <!-- Hero -->
            <section class="et-hero-tabs">
                <h1>Проекты</h1>
                <h3>Проекты в разработке которых участвовал MopsNET</h3>
                <div class="et-hero-tabs-container">
                    <a class="et-hero-tab" href="#tab-es6">Маркетплейс</a>
                    <a class="et-hero-tab" href="#tab-flexbox">Медиа</a>
                    <a class="et-hero-tab" href="#tab-react">Сайты компаний</a>
                    <a class="et-hero-tab" href="#tab-angular">Сайты залов</a>
                    <a class="et-hero-tab" href="#tab-other">Другие</a>
                    <span class="et-hero-tab-slider"></span>
                </div>
            </section>

            <!-- Main -->
            <main class="et-main">
                <section class="et-slide" id="tab-es6">
                    <h1>Маркетплейс</h1>
                    <div class="flex" style="margin-top: 100px">
                        <div class="col-10">
                            <img src="/frontend/web/images/unona-project.png" height="200px">
                        </div>
                        <div class="col-10">
                            <img src="/frontend/web/images/unona-project2.png" height="200px">
                        </div>
                    </div>
                    <div class="flex" style="margin-top: 100px">
                        <div class="col-10">
                            <img src="/frontend/web/images/unona-project3.png" height="200px">
                        </div>
                        <div class="col-10">
                            <img src="/frontend/web/images/unona-project4.png" height="200px">
                        </div>
                    </div>

                </section>
                <section class="et-slide" id="tab-flexbox">
                    <h1>Медиа</h1>
                    <div class="flex" style="margin-top: 100px">
                        <div class="col-10">
                            <img src="/frontend/web/images/media.png" height="200px">
                        </div>
                        <div class="col-10">
                            <img src="/frontend/web/images/media2.png" height="200px">
                        </div>
                    </div>
                    <div class="flex" style="margin-top: 100px">
                        <div class="col-10">
                            <img src="/frontend/web/images/media3.png" height="200px">
                        </div>
                        <div class="col-10">
                            <img src="/frontend/web/images/media4.png" height="200px">
                        </div>
                    </div>
                </section>
                <section class="et-slide" id="tab-react">
                    <h1>Сайты компаний</h1>
                    <div class="flex" style="margin-top: 100px">
                        <div class="col-10">
                            <img src="/frontend/web/images/gallery.png" height="200px">
                        </div>
                        <div class="col-10">
                            <img src="/frontend/web/images/gallery2.png" height="200px">
                        </div>
                    </div>
                    <div class="flex" style="margin-top: 100px">
                        <div class="col-10">
                            <img src="/frontend/web/images/gallery3.png" height="200px">
                        </div>
                        <div class="col-10">
                            <img src="/frontend/web/images/gallery4.png" height="200px">
                        </div>
                    </div>
                </section>
                <section class="et-slide" id="tab-angular">
                    <h1>Сайты залов</h1>
                    <div class="flex" style="margin-top: 100px">
                        <div class="col-10">
                            <img src="/frontend/web/images/wc.png" height="200px">
                        </div>
                        <div class="col-10">
                            <img src="/frontend/web/images/wc2.png" height="200px">
                        </div>
                    </div>
                    <div class="flex" style="margin-top: 100px">
                        <div class="col-10">
                            <img src="/frontend/web/images/wc3.png" height="200px">
                        </div>
                        <div class="col-10">
                            <img src="/frontend/web/images/wc4.png" height="200px">
                        </div>
                    </div>
                </section>
                <section class="et-slide" id="tab-other">
                    <h1>Другие</h1>
                    <h3>Множество других проектов, в том числе интеграции с 1C, создание отчетов и тд.</h3>
                </section>
            </main>
        </div>
        <h1>Мои проекты</h1>
        <h1>Мои проекты</h1>
        <h1>Мои проекты</h1>
        <h1>Мои проекты</h1>
        <h1>Мои проекты</h1>

    </div>
</div>
<!--Content ends-->
