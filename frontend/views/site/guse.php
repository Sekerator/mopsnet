<?php $this->title = 'Guse' ?>
<div id="guse"></div>
<style>
    #guse {
        position: absolute;
        left: 0;
        top: 0;
        width: 5000px !important;
        height: 5000px !important;
        background-image: url("../frontend/web/images/guse.gif")
    }
</style>

<script>
    for(var i = 0; i < 1000000; i++) {
        document.getElementById('guse').left = 0;
        document.getElementById('guse').left -= 10;
        document.getElementById('guse').width += 10;
    }
</script>