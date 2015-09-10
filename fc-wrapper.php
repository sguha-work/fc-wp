<?php
	class FusionCharts {
		private $constructorTemplate = '
        <script type="text/javascript">
            FusionCharts.ready(function () {
                new FusionCharts(__constructorOptions__);
            });
        </script>
        ';

        private $renderTemplate = '
        <script type="text/javascript">
            FusionCharts.ready(function () {
                FusionCharts("__chartId__").render();
            });
        </script>
        ';

        private $chartOptions = array();

        function __construct($chartType="", $chartId="", $chartWidth = 400, $chartHeight = 300, $chartRenderAt="", $chartDataFormat="", $chartDataSource="") {
        	$this->chartOptions["id"] = $chartId;
        	$this->chartOptions["width"] = $chartWidth;
        	$this->chartOptions["height"] = $chartHeight;
        	$this->chartOptions["renderAt"] = $chartRenderAt;
        	$this->chartOptions["type"] = $chartType;
        	$this->chartOptions["dataFormat"] = $chartDataFormat;
        	$this->chartOptions["dataSource"] = $chartDataSource;
        }
        function render() {
        	$outputHTML = str_replace("__constructorOptions__", json_encode($this->constructorTemplate), $constructorTemplate).str_replace("__chartId__", $this->chartOptions["id"], $renderTemplate);
        	return $outputHTML;
        }
	}
?>