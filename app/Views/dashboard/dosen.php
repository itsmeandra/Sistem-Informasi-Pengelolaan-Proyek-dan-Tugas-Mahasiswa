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

    <!-- <div class="row">
        <div class="col-md-12 text-right" style="margin-bottom: 15px;">
            <?php if (session()->get('role') === 'dosen'): ?>
                <a href="<?= base_url('project/create'); ?>" class="btn btn-primary">+ Buat Proyek</a>
                <a href="<?= base_url('task/create/1'); ?>" class="btn btn-success">+ Tambah Tugas</a>
                <a href="<?= base_url('extra/statistik/1'); ?>" class="btn btn-info">📊 Statistik</a>
            <?php elseif (session()->get('role') === 'mahasiswa'): ?>
                <a href="<?= base_url('join'); ?>" class="btn btn-primary">Gabung Proyek</a>
                <?php $idProject = getMahasiswaProjectId(); ?>
                <?php if ($idProject): ?>
                    <a href="<?= base_url('task/' . $idProject); ?>" class="btn btn-success">Tugas Saya</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div> -->

    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-blue panel-widget ">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <em class="glyphicon glyphicon-folder-open glyphicon-l"></em>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?= $totalProyek; ?></div>
                        <div class="text-muted">Proyek Saya</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-teal panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <em class="glyphicon glyphicon-floppy-disk glyphicon-l"></em>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?= $totalTugas; ?></div>
                        <div class="text-muted">Total Tugas</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-red panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <em class="glyphicon glyphicon-book glyphicon-l"></em>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?= $belumDinilai; ?></div>
                        <div class="text-muted">Tugas Belum Dinilai</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-orange panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <em class="glyphicon glyphicon-user glyphicon-l"></em>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large"><?= $anggotaProject; ?></div>
                        <div class="text-muted">Anggota Project</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-xs-12 col-md-6 col-lg-3">
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
        </div> -->

    </div>

    <!-- <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>Deadline</span>
                    <a href="<?= base_url('extra/reminder'); ?>" class="btn btn-secondary pull-right">Lihat Semua</a>
                </div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="main-chart" id="line-chart" height="200" width="600">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="panel panel-default">
        <div class="panel-heading">Deadline Terdekat</div>
        <div class="panel-body">
            <?php if (empty($tasks_deadline)): ?>
                <div class="alert alert-success">Tidak ada tugas mendekati deadline.</div>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($tasks_deadline as $task): ?>
                        <li class="list-group-item">
                            <?= esc($task['nama_tugas']); ?> - <strong><?= esc($task['deadline']); ?></strong>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= base_url('reminder'); ?>" class="btn btn-sm btn-primary mt-2">Show All</a>
            <?php endif; ?>
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

    <!-- <div class="row">
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