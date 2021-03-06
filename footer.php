<script src="https://cdn.bootcss.com/materialize/0.98.2/js/materialize.min.js"></script>
<footer class="page-footer orange">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">关于</h5>
                <p class="grey-text text-lighten-4">本站提供网络存储空间.</p>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">用户</h5>
                <ul>
                    <li><a class="white-text" href="user">用户中心</a></li>
                    <li><a class="white-text" href="user/login.php">登录</a></li>
                    <li><a class="white-text" href="user/register.php">注册</a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">页面</h5>
                <ul>
                    <li><a class="white-text" href="user/tos.php">TOS</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            &copy; <?php echo $site_name."  ".date('Y'); ?>  Powered by <b>webDisk</b> <?php echo $version; ?>
            Processed in <?php
            $Runtime->Stop();
            echo $Runtime->SpendTime()."ms";
            ?> Theme by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
        </div>
    </div>
</footer>
</body>
</html>
