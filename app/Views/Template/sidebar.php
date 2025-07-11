<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <li class="active"><a href="<?= base_url('dashboard/' . session()->get('role')); ?>">
                <span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
        <?php
        if (session()->get('role') == 'dosen'): ?>
            <li><a href="<?= base_url('project'); ?>"><span class="glyphicon glyphicon-folder-open"></span>Project</a></li>
            <li><a href="<?= base_url('extra/reminder'); ?>"><span class="glyphicon glyphicon-calendar"></span>Deadline Tugas</a></li>
            <!-- <li><a href="<?= base_url('extra/statistik/1'); ?>"><span class="glyphicon glyphicon-stats"></span> Statistik Project</a></li> -->
            <li><a href="<?= base_url('task/laporan-semua'); ?>"><span class="glyphicon glyphicon-file"></span>Laporan</a></li>
            <li><a href="<?= base_url('extra/peserta/1'); ?>"><span class="glyphicon glyphicon-user"></span> Anggota Project</a></li>

        <?php elseif (session()->get('role') == 'mahasiswa'): ?>
            <li><a href="<?= base_url('join'); ?>"><span class="glyphicon glyphicon-th"></span> Gabung Project</a></li>

            <?php
            $idProject = session()->get('active_project_id');
            ?>

            <?php if ($idProject): ?>
                <li><a href="<?= base_url('task/' . $idProject); ?>"><span class="glyphicon glyphicon-tasks"></span>Tugas Saya</a></li>
                <li><a href="<?= base_url('extra/reminder'); ?>"><span class="glyphicon glyphicon-time"></span>Jadwal</a></li>
                <li><a href="<?= base_url('extra/statistik/' . $idProject); ?>"><span class="glyphicon glyphicon-signal"></span>Progres Saya</a></li>
                <li><a href="<?= base_url('nilai'); ?>"> <span class="glyphicon glyphicon-certificate"></span>Nilai</a></li>
            <?php endif; ?>
        <?php endif; ?>

        <li role="presentation" class="divider"></li>
        <li><a href="<?= base_url('/auth/logout/'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
    <div class="attribution">Template by <a href="http://www.medialoot.com/item/lumino-admin-bootstrap-template/">Medialoot</a></div>
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