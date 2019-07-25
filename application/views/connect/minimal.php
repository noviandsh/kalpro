<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>

  <link rel="stylesheet" href="<?=base_url('assets/css/koneksi.css')?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
  <script src="<?=base_url('assets/js/jsplumb.js')?>"></script>
</head>
    <body data-demo-id="flowchart">
<!-- demo -->
      <div class="jtk-demo-canvas canvas-wide flowchart-demo jtk-surface jtk-surface-nopan" id="canvas">
          <div class="window jtk-node" id="flowchartWindow1"><strong>1</strong><br/><br/></div>
          <div class="window jtk-node" id="flowchartWindow2"><strong>2</strong><br/><br/></div>
          <div class="window jtk-node" id="flowchartWindow3"><strong>3</strong><br/><br/></div>
          <div class="window jtk-node" id="flowchartWindow4"><strong>4</strong><br/><br/></div>
      </div>
      <!-- /demo -->
  </div>
<script src="<?=base_url('assets/js/koneksi.js')?>"></script>
<script>
  jsPlumb.ready(function () {
    var toolkit = jsPlumb.getInstance();
    
  });
</script>
</body>
</html>

