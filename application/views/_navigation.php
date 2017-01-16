<body>
<!-- Navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">AboutMusic</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="<?php echo $pageTitle == 'home' ? 'active' : '' ;?>"><?php echo anchor('ProductuploadC/index', 'Home', 'class="link-class"') ?></li>
            <li class="dropdown <?php echo ($pageTitle == 'uploadBoard' || $pageTitle == 'seeSample') ? 'active' : '' ;?>"><a class="dropdown-toggle" data-toggle="dropdown" href="#">網站內容更動<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $pageTitle == 'uploadBoard' ? 'active' : '' ;?>"><?php echo anchor('ProductuploadC/do_what/uploadNew', '新增專輯', 'class="link-class"') ?></li>
                    <li class="<?php echo $pageTitle == 'seeSample' ? 'active' : '' ;?>"><?php echo anchor('ProductuploadC/do_what/seeSample', '刪除/修改專輯內容', 'class="link-class"') ?></li>
                </ul>
            </li>
            <li class="<?php echo $pageTitle == 'guestBook' ? 'active' : '' ;?>"><?php echo anchor('ProductuploadC/do_what/guestBook', '回覆留言', 'class="link-class"') ?></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div> <!--end of <div class="container-fluid"> -->
</nav>