 
<?php $__env->startSection('styles'); ?> 
<link href="<?php echo e(asset('plugins/morris.js/morris.css')); ?>" rel="stylesheet" />


<link href="<?php echo e(asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")); ?>" rel="stylesheet" />
<link href="<?php echo e(asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")); ?>" rel="stylesheet" /> 

<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('content'); ?> 
<h1 class="page-header">Dashboard  <small>Selamat datang <?php echo e(Auth::user()->name); ?> </small></h1>
<div class="d-sm-flex align-items-center mb-3">
    
        <input type="text" name="tanggal" id="tanggal" value="<?php echo e(date("Y")); ?>"class="btn btn-dark me-2 text-truncate text-white text-opacity-50 ms-n1" placeholder="Pilih Periode" required/>
        
    
</div>


<div class="row">

    <div class="col-xl-8">
    
    <div class="card border-0 mb-3 overflow-hidden bg-dark text-white">
    
    <div class="card-body">
    
    <div class="row">
    
    <div class="col-xl-7 col-lg-9">
    
    <div class="mb-3 text-grey">
    <b>Penjualan by KPR <?php echo e(date("Y")); ?></b>
    <span class="ml-2">
    <i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Total Penjualan" data-placement="top" data-content="Penjualan Unit dengan Cara bayar KPR "></i>
    </span>
    </div>
    
    <?php $__currentLoopData = $kprall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="d-flex mb-1">
    <h2 class="mb-0">Rp <span data-animation="number" data-value="<?php echo e($r->gross_total); ?>">0.00</span></h2>
    <div class="ml-auto mt-n1 mb-n1"><div id="total-sales-sparkline"></div></div>
    </div>
    <?php $qty = $r->qty; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <hr class="bg-white-transparent-2" />
    
    <div class="row text-truncate">
    <?php $__currentLoopData = $kpr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-3">
    <div class="f-s-12 text-grey">Realisasi</div>
    <div class="f-s-18 m-b-5 f-w-600 p-b-1" data-animation="number" data-value="<?php echo e($r->realisasi); ?>">0</div>
    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
    <div class="progress-bar progress-bar-striped rounded-right bg-teal" data-animation="width" data-value="<?php echo e(@($r->realisasi/$qty*100)); ?>%" style="width: 0%"></div>
    </div>
    </div> 
    <div class="col-2">
    <div class="f-s-12 text-grey">SP3K</div>
    <div class="f-s-18 m-b-5 f-w-600 p-b-1" data-animation="number" data-value="<?php echo e($r->acc); ?>">0</div>
    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
    <div class="progress-bar progress-bar-striped rounded-right bg-teal" data-animation="width" data-value="<?php echo e(@($r->acc/$qty*100)); ?>%" style="width: 0%"></div>
    </div>
    </div> 
    <div class="col-2">
    <div class="f-s-12 text-grey">Proses</div>
    <div class="f-s-18 m-b-5 f-w-600 p-b-1"><span data-animation="number" data-value="<?php echo e($r->proses); ?>"></span></div>
    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
    <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="<?php echo e(@($r->proses/$qty*100)); ?>%" style="width: 0%"></div>
    </div>
    </div>
     <div class="col-2">
    <div class="f-s-12 text-grey">Tolak</div>
    <div class="f-s-18 m-b-5 f-w-600 p-b-1"><span data-animation="number" data-value="<?php echo e($r->tolak); ?>"></span></div>
    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
    <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="<?php echo e(@($r->tolak/$qty*100)); ?>%" style="width: 0%"></div>
    </div>
    </div>
     
     <div class="col-3">
    <div class="f-s-12 text-grey">Blm Pengajuan</div>
    <div class="f-s-18 m-b-5 f-w-600 p-b-1"><span data-animation="number" data-value="<?php echo e($r->belum); ?>"></span></div>
    <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
    <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="<?php echo e(@($r->belum/$qty*100)); ?>%" style="width: 0%"></div>
    </div>
    </div>
     
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
    </div>
    
    
    <div class="col-xl-5 col-lg-3 align-items-center d-flex justify-content-center">
    <img src="<?php echo e(asset('img/img-1.svg')); ?>" height="150px" class="d-none d-lg-block" />
    </div>
    
    </div>
    
    </div>
    
    </div>
    
</div>    
</div>    

<?php $__currentLoopData = $perumahan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row">
    <div class="col-xl-8">    
        <div class="card border-0 mb-3 overflow-hidden bg-dark text-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="mb-3 text-grey">
                        <b><?php echo e($r->nama); ?> - Tren Penjualan by KPR <?php echo e(date("Y")); ?> </b>
                            <span class="ml-2">
                                <i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Total Penjualan Unit" data-placement="top" data-content="Total Penjualan Unit di Tahun <?php echo e(date("Y")); ?>."></i>
                            </span>
                        </div>
                        <hr class="bg-white-transparent-2" />        
                    <div id="morris-line-chart-<?php echo e($r->id); ?>" class="height-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">    
        <div class="card border-0 mb-3 overflow-hidden bg-dark text-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="mb-3 text-grey">
                        <b><?php echo e($r->nama); ?> - Stock Kavling</b>
                            <span class="ml-2">
                                <i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Total Penjualan Unit" data-placement="top" data-content="Total Penjualan Unit di Tahun <?php echo e(date("Y")); ?>."></i>
                            </span>
                        </div>
                        <hr class="bg-white-transparent-2" />        
                    <div id="morris-donut-chart-<?php echo e($r->id); ?>" class="height-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class="row">
    <div class="col-xl-12">    
        <div class="card border-0 mb-3 overflow-hidden bg-dark text-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="mb-3 text-grey">
                            <b>PENJUALAN UNIT </b>
                            <span class="ml-2">
                                <i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Total Penjualan Unit" data-placement="top" data-content="Total Penjualan Unit di Tahun <?php echo e(date("Y")); ?>."></i>
                            </span>
                        </div>
                        <hr class="bg-white-transparent-2" />        
                        <div id="container"></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

      

<!-- end row --> 


<?php $__env->stopSection(); ?>
 
<?php $__env->startSection("scripts"); ?>
<script src="<?php echo e(asset('js/chart/highcharts.js')); ?>"></script>
<script src="<?php echo e(asset('js/chart/highcharts-3d.js')); ?>"></script>
<script src="<?php echo e(asset('js/chart/modules/exporting.js')); ?>"></script>
<script src="<?php echo e(asset('js/chart/modules/export-data.js')); ?>"></script>
<script src="<?php echo e(asset('js/chart/modules/accessibility.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/raphael/raphael.min.js')); ?>" ></script>
<script src="<?php echo e(asset('plugins/morris.js/morris.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrap-daterangepicker/moment.js')); ?>"></script>

<script type="text/javascript">
 $(function () {
    Highcharts.chart('container', {        
        chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 10,
                        beta: 10,
                        viewDistance: 90,
                        depth: 30
                    }, 
                },
        title: {
            text: 'Penjualan Unit Periode <?php echo e(date("Y")); ?>'
        },
        subtitle: {
            text: 'Source: PT. Sembilan Bintang Lestari'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Penjualan (Unit)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Unit</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                depth: 50
            }
        },
        series: [ <?php echo $gab; ?> ]
    });
});

</script>


<script type="text/javascript">
    var handleMorrisLineChart = function () {
    
        const monthNames = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];

        <?php $__currentLoopData = $perumahan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        var tax_data_<?php echo e($r->id); ?> = [
            <?php echo $gst[$r->id]; ?>
        ];
   
	    Morris.Line({
            element: 'morris-line-chart-<?php echo e($r->id); ?>',
            data: tax_data_<?php echo e($r->id); ?>,
            xkey: 'y',
            parseTime: false,
            ykeys: ['masuk','proses', 'acc', 'tolak'],
            labels: ['Total MOU','Proses', 'Acc', 'Tolak'],
            labelColor: '#999999',
            xLabelFormat: function (x) {
                var index = parseInt(x.src.y);
                return monthNames[index];
            },
            xLabels: "month",
            resize: true,
            pointSize: 3,
            fillOpacity:1.0,
            lineWidth: 2.0, 
            hideHover: 'auto', 
            resize: true, 
            lineColors: ['#31c471','#d48404', '#0490d6', '#b53656'],
        }); 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    };

    var handleMorrisDonusChart = function() {
        <?php $__currentLoopData = $perumahan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        Morris.Donut({
            element: 'morris-donut-chart-<?php echo e($r->id); ?>',
            data: [
                <?php echo $rdonat[$r->id]; ?>
            ],
            formatter: function (y) { return y + " Unit" },
            resize: true,
            gridLineColor: [COLOR_GREY_LIGHTER],
            gridTextFamily: FONT_FAMILY,
            gridTextColor: FONT_COLOR,
            labelColor: '#d9d9d9',
            gridTextWeight: FONT_WEIGHT,
            gridTextSize: FONT_SIZE,
            //colors: ['#0fd6b5', 'COLOR_DARK', '#f5a802', '#0439d9']
            colors: [  '#0fd6b5', '#4a1ec5', '#ff8b0f',  '#33CC33'],
          
        });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    };
    
var MorrisChart = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleMorrisLineChart(); 
			handleMorrisDonusChart(); 
		}
	};
}(); 
$(document).ready(function() {
	MorrisChart.init();
    $("#tanggal").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                viewMode: "years", 
				minViewMode: "years",
                format: "yyyy",
            });
    $("#tanggal").on('change', function postinput(){
        var tanggal = $(this).val(); // this.value
        $(location).prop('href', 'http://admin.sembilanbintanglestari.com/home/data/'+ tanggal)
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\zarvi\sbl\zarvisystem\app\Modules/Home/resources/views/index.blade.php ENDPATH**/ ?>