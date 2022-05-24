<div class="row" style="padding-left: 10px; padding-right:10px;">
  <div class="col-md-12">
    <div class="row" style="background:#142127 !important; border-radius:20px; padding:20px; margin-bottom:15px; color:white;">
      <div style="background-color: #FF8D29;height:5px;"></div>
      <div style="height:250px;position: relative;">
        <div style="position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);">
          <div class="col-md-4">
            <img src="<?= base_url('assets/uploads/image/logo/') . $setting_aplikasi->kode; ?>" width="65%" alt="">
          </div>
          <div class="col-md-8">
            <p style="font-size: 50px; font-family:'Poppins', Courier, monospace">Orange Press</p>
            <p style="font-size: 20px; font-family:'Poppins', Courier, monospace">Lorem ipsum dolor, sit amet consectetur adipisicing.</p>
          </div>
        </div>
      </div>
      <div style="background-color: #FF8D29;height:5px;"></div>
    </div>
  </div>
</div>

<?php
if ($this->ion_auth->in_group(34)) {
?>
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Jumlah Produk</span>
          <span class="info-box-number"><?= $penulis_jumlah_produk; ?></span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="progress-description">
            Total Produk
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div>
<?php
}
?>

<?php
if ($this->ion_auth->in_group(1)) {
?>
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Jumlah Produk</span>
          <span class="info-box-number"><?= $admin_jumlah_produk; ?></span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="progress-description">
            Total Produk
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Last Submission</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body" style="min-height: 150px">
          <div class="chart">
            <canvas id="barChart" style="height:270px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-md-4 col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Last Submission</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body" style="height:295px">
          <table class="table table-bordered table-striped">
            <thead>
              <th>No</th>
              <th>Nama</th>
              <th>Waktu</th>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Admin</td>
                <td>12/11/2018</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Cashier</td>
                <td>12/11/2018</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Akunting</td>
                <td>12/11/2018</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Gudang</td>
                <td>12/11/2018</td>
              </tr>
              <tr>
                <td>5</td>
                <td>Purchasing</td>
                <td>12/11/2018</td>
              </tr>
              <tr>
                <td>6</td>
                <td>Gudang</td>
                <td>12/11/2018</td>
              </tr>
              <tr>
                <td>7</td>
                <td>Purchasing</td>
                <td>12/11/2018</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </div>
  </div>
<?php
}
?>
<!-- ChartJS -->
<script src="<?= base_url(); ?>assets/bower_components/chart.js/Chart.js"></script>
<script type="text/javascript">
  $(function() {
    var areaChartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'Sept', 'Oct', 'Nov', 'Dec'],
      datasets: [{
          label: 'Electronics',
          fillColor: 'rgba(210, 214, 222, 1)',
          strokeColor: 'rgba(210, 214, 222, 1)',
          pointColor: 'rgba(210, 214, 222, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: [65, 59, 80, 81, 56, 55, 44, 30, 70, 60, 20, 90]
        },
        {
          label: 'Digital Goods',
          fillColor: 'rgba(0, 92, 231,1.0)',
          strokeColor: 'rgba(9, 92, 231,1.0)',
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(0, 92, 231,1.0)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [28, 48, 40, 19, 86, 27, 90, 10, 48, 90, 50, 30]
        }
      ]
    }
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChart = new Chart(barChartCanvas)
    var barChartData = areaChartData
    barChartData.datasets[1].fillColor = '#6c5ce7'
    barChartData.datasets[1].strokeColor = '#6c5ce7'
    barChartData.datasets[1].pointColor = '#00a65a'
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  });
</script>