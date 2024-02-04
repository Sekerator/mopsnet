<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    var conn = new WebSocket('ws://localhost:4321?username=Ass&auth_key=oCuiw_CRJqO06WkBI4b7NLuNhIkJDz9Y');
    conn.onmessage = function(e) {
        console.log('Response:' + e.data);
    };
    conn.onopen = function(e) {
        console.log('ping');
        conn.send(JSON.stringify({action: 'ConnectRoom', username: 'Ass', auth_key: 'oCuiw_CRJqO06WkBI4b7NLuNhIkJDz9Y'}));
    };
    conn.onclose = function(e) {
        console.log('close connect');
    };
</script>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>
