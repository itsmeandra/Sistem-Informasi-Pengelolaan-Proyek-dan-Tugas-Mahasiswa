<!-- <head>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
</head> -->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <!-- <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-blue panel-widget ">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <em class="glyphicon glyphicon-shopping-cart glyphicon-l"></em>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"></div>
                        <div class="text-muted">Total Tugas</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-orange panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <em class="glyphicon glyphicon-comment glyphicon-l"></em>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"></div>
                        <div class="text-muted">Tugas Selesai</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-teal panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <em class="glyphicon glyphicon-user glyphicon-l"></em>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"></div>
                        <div class="text-muted">Nilai Tertinggi</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-red panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <em class="glyphicon glyphicon-stats glyphicon-l"></em>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">25.2k</div>
                        <div class="text-muted">Visitors</div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
        <!-- <div class="row"> -->
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Total Tugas</div>
                <div class="panel-body">
                    <?= $totalTugas ?? '0'; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">Tugas Aktif</div>
                <div class="panel-body">
                    <?= count($tugasAktif); ?> tugas belum dikumpulkan
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">Rata-rata Nilai</div>
                <div class="panel-body">
                    <?= $rataNilai ?? '-'; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="glyphicon glyphicon-time"></span> <strong>Deadline Terdekat</strong>
            </h3>
        </div>
        <div class="panel-body">
            <?php if (empty($tugasTerdekat)): ?>
                <div class="alert alert-info text-center">
                    <h4><span class="glyphicon glyphicon-ok-circle"></span> Tugas Selesai!</h4>
                    <p>Tidak ada deadline dalam waktu dekat, selamat bersantai.</p>
                </div>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($tugasTerdekat as $t): ?>
                        <li class="list-group-item">
                            <?php
                            // Logika untuk menentukan kelas warna badge
                            $badge_class = 'badge-success';
                            if ($t['h'] <= 1) {
                                $badge_class = 'badge-danger';
                            } elseif ($t['h'] <= 3) {
                                $badge_class = 'badge-warning';
                            }
                            ?>
                            <span class="badge pull-right <?= $badge_class; ?>">
                                H-<?= $t['h']; ?>
                            </span>

                            <strong><?= esc($t['nama_tugas']); ?></strong>
                            <br>
                            <small>Deadline: <?= esc($t['deadline']); ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <?php if (!empty($tugasTerdekat)): ?>
            <div class="panel-footer">
                <a href="<?= base_url('extra/reminder'); ?>" class="btn btn-primary btn-sm btn-block">📖 Lihat Semua</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- <div class="panel panel-default">
        <div class="panel-heading">📈 Grafik Progres Nilai</div>
        <div class="panel-body">
            <canvas id="nilaiChart" width="100%" height="40"></canvas>
        </div>
    </div> -->

    <div class="panel panel-default">
        <div class="panel-heading">📄 Riwayat Tugas</div>
        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tugas</th>
                        <th>Status</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($riwayatTugas as $t): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= esc($t['nama_tugas']); ?></td>
                            <td>
                                <?php if ($t['file_laporan']): ?>
                                    ✅ Sudah Upload
                                <?php else: ?>
                                    ❌ Belum Upload
                                <?php endif; ?>
                            </td>
                            <td><?= $t['nilai'] ?? '-'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- <div class="panel panel-default">
        <div class="panel-heading">Kalender Deadline Tugas</div>
        <div class="panel-body">
            <div id="calendar"></div>
        </div>
    </div> -->

<!-- <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Deadline</div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>New Orders</h4>
                    <div class="easypiechart" id="easypiechart-blue" data-percent="92"><span class="percent">92%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>Comments</h4>
                    <div class="easypiechart" id="easypiechart-orange" data-percent="65"><span class="percent">65%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>New Users</h4>
                    <div class="easypiechart" id="easypiechart-teal" data-percent="56"><span class="percent">56%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>Visitors</h4>
                    <div class="easypiechart" id="easypiechart-red" data-percent="27"><span class="percent">27%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">

            <div class="panel panel-default chat">
                <div class="panel-heading" id="accordion"><span class="glyphicon glyphicon-comment"></span> Chat</div>
                <div class="panel-body">
                    <ul>
                        <li class="left clearfix">
                            <span class="chat-img pull-left">
                                <img src="http://placehold.it/80/30a5ff/fff" alt="User Avatar" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">John Doe</strong> <small class="text-muted">32 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ante turpis, rutrum ut ullamcorper sed, dapibus ac nunc. Vivamus luctus convallis mauris, eu gravida tortor aliquam ultricies.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix">
                            <span class="chat-img pull-right">
                                <img src="http://placehold.it/80/dde0e6/5f6468" alt="User Avatar" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="pull-left primary-font">Jane Doe</strong> <small class="text-muted">6 mins ago</small>
                                </div>
                                <p>
                                    Mauris dignissim porta enim, sed commodo sem blandit non. Ut scelerisque sapien eu mauris faucibus ultrices. Nulla ac odio nisl. Proin est metus, interdum scelerisque quam eu, eleifend pretium nunc. Suspendisse finibus auctor lectus, eu interdum sapien.
                                </p>
                            </div>
                        </li>
                        <li class="left clearfix">
                            <span class="chat-img pull-left">
                                <img src="http://placehold.it/80/30a5ff/fff" alt="User Avatar" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">John Doe</strong> <small class="text-muted">32 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ante turpis, rutrum ut ullamcorper sed, dapibus ac nunc. Vivamus luctus convallis mauris, eu gravida tortor aliquam ultricies.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-md" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-success btn-md" id="btn-chat">Send</button>
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-4">

            <div class="panel panel-blue">
                <div class="panel-heading dark-overlay"><span class="glyphicon glyphicon-check"></span>To-do List</div>
                <div class="panel-body">
                    <ul class="todo-list">
                        <li class="todo-list-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">Make a plan for today</label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="#" class="flag"><span class="glyphicon glyphicon-flag"></span></a>
                                <a href="#" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>
                        </li>
                        <li class="todo-list-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">Update Basecamp</label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="#" class="flag"><span class="glyphicon glyphicon-flag"></span></a>
                                <a href="#" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>
                        </li>
                        <li class="todo-list-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">Send email to Jane</label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="#" class="flag"><span class="glyphicon glyphicon-flag"></span></a>
                                <a href="#" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>
                        </li>
                        <li class="todo-list-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">Drink coffee</label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="#" class="flag"><span class="glyphicon glyphicon-flag"></span></a>
                                <a href="#" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>
                        </li>
                        <li class="todo-list-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">Do some work</label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="#" class="flag"><span class="glyphicon glyphicon-flag"></span></a>
                                <a href="#" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>
                        </li>
                        <li class="todo-list-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">Tidy up workspace</label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="#" class="flag"><span class="glyphicon glyphicon-flag"></span></a>
                                <a href="#" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-md" placeholder="Add new task" />
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-md" id="btn-todo">Add</button>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div> -->
</div>

<!-- FullCalendar JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id',
            height: 500,
            events: '<?= base_url('api/tugas-kalender'); ?>',
            eventClick: function(info) {
                alert('Tugas: ' + info.event.title + '\nDeadline: ' + info.event.start.toLocaleDateString());
            }
        });

        calendar.render();
    });
</script> -->


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
</body>

</html>