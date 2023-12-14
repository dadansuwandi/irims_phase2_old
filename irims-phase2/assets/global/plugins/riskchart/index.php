<html>
	<body>
		<!-- id div wajib diberi nama risk-chart-d3 -->
		<div id="risk-chart-d3" style="height: 500px; width:500px;"></div><!-- widht dan height bisa diatur sesuai kebutuhan, bisa memakai % -->
		<?php
			/*sample data dari backend*/ 
			$data = array(
				'3E'=>array('1','5','9'),//isi arraynya adalah nomor risknya, key array wajib capital contoh 3E,2D,5C
				'2D'=>array('4','6','12'),
				'5C'=>array('3','8','10','11'),
				'1B'=>array('2','7','13'),
				'5B'=>array('14','15','16'),
				'3A'=>array('17','18','19')
			);
		?>

		<script type="text/javascript" src="d3.min.js"></script>
		<script type="text/javascript" src="riskchart.js"></script>
		<script>
			drawRiskChart(<?php echo json_encode($data)?>);
		</script>
	</body>
</html>