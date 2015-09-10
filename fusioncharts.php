<?php

    // class fcwp_FusionCharts {
    //     private $totalHtml;

    //     private $constructorOptions = array();

    //     private $constructorTemplate = '
    //     <script type="text/javascript">
    //         FusionCharts.ready(function () {
    //             new FusionCharts(__constructorOptions__);
    //         });
    //     </script>';

    //     private $renderTemplate = '
    //     <script type="text/javascript">
    //         FusionCharts.ready(function () {
    //             FusionCharts("__chartId__").render();
    //         });
    //     </script>
    //     ';

    //     function __construct($type, $id, $width = 400, $height = 300, $renderAt, $dataFormat, $dataSource) {
    //         isset($width) ? $this->constructorOptions['width'] = $width : '';
    //         isset($height) ? $this->constructorOptions['height'] = $height : '';
    //         isset($renderAt) ? $this->constructorOptions['renderAt'] = $renderAt : '';
    //         isset($dataFormat) ? $this->constructorOptions['dataFormat'] = $dataFormat : '';
    //         isset($type) ? $this->constructorOptions['type'] = $type : '';
    //         isset($id) ? $this->constructorOptions['id'] = $id : 'php-fc-'.time();
    //         isset($dataFormat) ? $this->constructorOptions['dataFormat'] = $dataFormat : '';
    //         isset($dataSource) ? $this->constructorOptions['dataSource'] = stripslashes($dataSource) : '';
    //         $tempArray = array();
    //         foreach($this->constructorOptions as $key => $value) {
    //             if ($key === 'dataSource') {
    //                 $tempArray['dataSource'] = '__dataSource__';
    //             } else {
    //                 $tempArray[$key] = $value;
    //             }
    //         }
            
    //         $jsonEncodedOptions = json_encode($tempArray);
            
    //         if ($dataFormat === 'json') {
    //             $jsonEncodedOptions = preg_replace('/\"__dataSource__\"/', $this->constructorOptions['dataSource'], $jsonEncodedOptions);
    //         } elseif ($dataFormat === 'xml') { 
    //             $jsonEncodedOptions = preg_replace('/\"__dataSource__\"/', '\'__dataSource__\'', $jsonEncodedOptions);
    //             $jsonEncodedOptions = preg_replace('/__dataSource__/', $this->constructorOptions['dataSource'], $jsonEncodedOptions);
    //         } elseif ($dataFormat === 'xmlurl') {
    //             $jsonEncodedOptions = preg_replace('/__dataSource__/', $this->constructorOptions['dataSource'], $jsonEncodedOptions);
    //         } elseif ($dataFormat === 'jsonurl') {
    //             $jsonEncodedOptions = preg_replace('/__dataSource__/', $this->constructorOptions['dataSource'], $jsonEncodedOptions);
    //         }
    //         $newChartHTML = preg_replace('/__constructorOptions__/', $jsonEncodedOptions, $this->constructorTemplate);

    //         $this->totalHtml = $newChartHTML;
    //     }

    //     function fcwp_render() {
    //        $renderHTML = preg_replace('/__chartId__/', isset($this->constructorOptions['id'])?$this->constructorOptions['id']:"fc_chart_1", $this->renderTemplate);
    //        return $this->totalHtml.$renderHTML;
    //     }

    // }
    class fcwp_FusionCharts {
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

        function __construct($chartType="", $chartId="", $chartWidth = 400, $chartHeight = 300, $chartRenderAt="", $chartDataFormat="", $chartDataSource="") {//echo stripcslashes($chartDataSource);die();
            $this->chartOptions["id"] = $chartId;
            $this->chartOptions["width"] = $chartWidth;
            $this->chartOptions["height"] = $chartHeight;
            $this->chartOptions["renderAt"] = $chartRenderAt;
            $this->chartOptions["type"] = $chartType;
            $this->chartOptions["dataFormat"] = $chartDataFormat;
            if(!strpos($this->chartOptions["dataFormat"], "url")) {
                $chartDataSource = json_decode(stripcslashes($chartDataSource), true);
            }
            $this->chartOptions["dataSource"] = $chartDataSource;
        }
        
        function render() {
            $outputHTML = str_replace("__constructorOptions__", json_encode($this->chartOptions), $this->constructorTemplate).str_replace("__chartId__", $this->chartOptions["id"], $this->renderTemplate);
            return $outputHTML;
        }
    }
?>