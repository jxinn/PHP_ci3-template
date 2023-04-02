<link rel="stylesheet" type="text/css" href="/assets/css/reset.css">
<style>
.container {height:100%; background:#f8f9fb; text-align:center;}
.container__txt_box {position:absolute; top:45%; left:50%; transform:translateX(-50%) translateY(-50%);}
.container__title {font-size: 96px; color:#1e2842; margin-bottom:34px;}
.container__content {font-size:16px; margin-bottom:34px; font-weight:200; line-height:1.5}
.container__btn {display:inline-block; width: 140px; height:36px; box-sizing:border-box; border:2px solid #010101; text-align:center; font-size:14px; padding:6px 0; text-decoration: none; border-radius: 4px; background:#fff; color: #3f464d;}
</style>
<div class="container">
    <div class="container__txt_box">
        <h2 class="container__title">404</h2>
        <p class="container__content">Page not found.<br/>The page you requested is gone, or you took the wrong path :(</p>
        <a href="<?=base_url()?>" class="container__btn">Return to home</a>
    </div>
</div>