<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <li class="active"><a href="<?= base_url('admin/index'); ?>"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a>
        </li>
        <li><a href="<?= base_url('admin/users/dosen'); ?>"><span class="glyphicon glyphicon-user"></span> Data Dosen</a></li>
        <li><a href="<?= base_url('admin/users/mahasiswa'); ?>"><span class="glyphicon glyphicon-user"></span> Data Mahasiswa</a></li>
        <li><a href="<?= base_url('admin/monitor/projects'); ?>"><span class="glyphicon glyphicon-folder-open"></span> Laporan Project</a></li>
        <li><a href="<?= base_url('admin/monitor/tasks'); ?>"><span class="glyphicon glyphicon-list-alt"></span> Laporan Tugas</a></li>
        <li role="presentation" class="divider"></li>
        <li><a href="<?= base_url('/auth/logout/'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
    <div class="attribution">Template by <a
            href="http://www.medialoot.com/item/lumino-admin-bootstrap-template/">Medialoot</a></div>
</div>

<script src="/Assets/js/jquery-1.11.1.min.js"></script>
<script src="/Assets/js/bootstrap.min.js"></script>
<script src="/Assets/js/chart.min.js"></script>
<script src="/Assets/js/chart-data.js"></script>
<script src="/Assets/js/easypiechart.js"></script>
<script src="/Assets/js/easypiechart-data.js"></script>
<script src="/Assets/js/bootstrap-datepicker.js"></script>
<script>
    $('#calendar').datepicker({});

    ! function($) {
        $(document).on("click", "ul.nav li.parent > a > span.icon", function() {
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function() {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function() {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>