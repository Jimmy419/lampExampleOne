<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>asdf</title>
    <link href='__PUBLIC__/plugins/font-awesome/css/font-awesome.min.css' rel="stylesheet" type="text/css" />
    <link href='__PUBLIC__/plugins/bootstrap/css/bootstrap.min.css' rel="stylesheet" type="text/css" />
    <link href="../Public/css/index.css" rel="stylesheet" type="text/css" />
</head>
<body class="indexPage">
	<div class="header">
		<div><?php echo (session('username')); ?> [&nbsp;<a href="javascript:void(0)" onclick="logout()" id="logoutLink" class="left-font01">退出</a>&nbsp;]</div>
        <div><a href="<?php echo U('Columns/index');?>">类目</a></div>
        <div><a href="<?php echo U('Tables/index');?>">我的表</a></div>
        <div><a href="<?php echo U('Map/index');?>">表映射</a></div>
        <div><a href="<?php echo U('Upload/index');?>">上传数据</a></div>
	</div>
	<div class="content">
        <?php if(is_array($tblist)): $i = 0; $__LIST__ = $tblist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tb): $mod = ($i % 2 );++$i;?><div id='chart<?php echo ($tb[id]); ?>'></div><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="for_sub_chart"></div>
        <div id="container"></div>
        <div>我的数据</div>
        <table class="table table-bordered table-hover">
            <thead>
                <th>id</th>
                <th>Table Name</th>
                <th>Class Id</th>
                <th>所属分类</th>
                <th>列名</th>
                <th>值</th>
                <th>备注</th>
                <th>时间</th>
                <th>填写时间</th>
                <th colspan="2">Setting</th>
            </thead>
            <tbody>
                <?php if(is_array($tables)): $i = 0; $__LIST__ = $tables;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($table[id]); ?></td>
                        <td><?php echo ($table[tablename]); ?></td>
                        <td><?php echo ($table[cid]); ?></td>
                        <td><?php echo ($table[mclass]); ?></td>
                        <td><?php echo ($table[name]); ?></td>
                        <td><?php echo ($table[value]); ?></td>
                        <td><?php echo ($table[notes]); ?></td>
                        <td><?php echo ($table[time]); ?></td>
                        <td><?php echo ($table[ctime]); ?></td>
                        <td><a href="<?php echo U('edit');?>/id/<?php echo ($table[dataId]); ?>/cid/<?php echo ($table[cid]); ?>">Edit</a></td>
                        <td><a href="<?php echo U('delete');?>/id/<?php echo ($table[dataId]); ?>">Delete</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div><a href="<?php echo U('add');?>" class="left-font01">添加数据</a></div>
	</div>
</body>
<script src='__PUBLIC__/plugins/jquery/jquery.min.js'></script>
<script src='__PUBLIC__/plugins/bootstrap/js/bootstrap.min.js'></script>
<script src="__PUBLIC__/plugins/underscore/underscore-min.js"></script>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script src="__PUBLIC__/plugins/highcharts/exporting.js"></script>
<script src="__PUBLIC__/plugins/highcharts/highcharts-zh_CN.js"></script>
<script>
$(function() {   	
    var data = null;
    var tables = null;
	$("#logoutLink").click(function(){
        $.ajax({
            url:"<?php echo U('Login/logout');?>",
            type:'get',
            success:function(result){
                if(result.status){
                    window.location.href="<?php echo U('Login/index');?>"; 
                }else{
                    alert("Logout failed!");
                }
            }
        })      		
	})

    $.ajax({
        url:"<?php echo U('getDate');?>",
        type:'get',
        success:function(result){
            var data = result.data;
            var tables = result.tables;
            var subtabs = result.subtables;
            subCharts(tables,data,subtabs);
            drawCharts(tables,data);
        }
    })

    function drawCharts(tables,data){
        tables.forEach(function(table){
            var chartData = [];
            var chartCol = [];
            var chartColId = [];
            var series = [];
            data.forEach(function(val){
                if(val.tid === table.id) {
                    chartData.push(val);
                    chartCol.push(val.name);
                    chartColId.push(val.cid);
                }
            });
            chartColName = _.uniq(chartCol);
            chartColId = _.uniq(chartColId);
            chartColId.forEach(function(col,colIndex){
                var itemData = [];
                chartData.forEach(function(itemDataItem){
                    if(itemDataItem.cid === col){
                        var temp = [
                            parseFloat(itemDataItem.time)*1000,
                            parseFloat(itemDataItem.value)
                        ];
                        itemData.push(temp);                            
                    }
                })
                var chartItem = {
                    name: chartColName[colIndex],
                    data: itemData
                }
                series.push(chartItem);
            })

            var chart1 = Highcharts.chart('chart'+table.id, {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: table.tablename
                },
                subtitle: {
                    text: null
                },
                xAxis: {
                    title: {
                        text: null
                    },
                    type: "datetime",
                    labels: {
                        format: '{value: %Y%m%d}'
                    }
                },
                yAxis: {
                    title: {
                        text: null
                    },
                    min: 0
                },
                tooltip: {
                    split: true
                },
                plotOptions: {
                    spline: {
                        marker: {
                            enabled: true
                        }
                    }
                },
                series: series
            });
        })
    }

    function clarrifySubCols(table,subtables){
        var tempSubTbs = _.filter(subtables, function(num){ return num.tid == table.id; });
        var sbtbnames = _.uniq(_.pluck(tempSubTbs, 'name'));
        var finalsubtables = [];
        sbtbnames.forEach(function(sbtbname){
            var subtableItem = {
                'name': sbtbname,
                'columns': []
            }
            tempSubTbs.forEach(function(subtable){
                if(subtable.name === sbtbname){
                    subtableItem.columns.push(subtable)
                }
            });
            finalsubtables.push(subtableItem);
        });
        return finalsubtables;
    }

    function subCharts(tables,sourcedata,subtabs){
        // tables:[{id:4,uid:1,tablename:'Stock'}]
        // sourcedata:[{cid:"20",ctime:"1528515614",dataId:"974",tid:"4",mclass:"Stock",name:"Stock Value",notes:null,tablename:"Stock",time:"1516147200",uid:"1",value:"35903.5300"}]

        tables.forEach(function(table){
            var tableSourceData = [];
            var tableDates = null;
            var tableColumns = [];
            var subTableData = [];
            var subtables = clarrifySubCols(table,subtabs);

            //get table data;
            sourcedata.forEach(function(sditem){
                if(sditem.tid === table.id){
                    tableSourceData.push(sditem);
                }
            });

            //get table dates;
            var tempDates = [];
            var columnsTemp = [];
            tableSourceData.forEach(function(sditem){
                tempDates.push(parseFloat(sditem.time) * 1000);
                var sditemColumn = {
                    cid: sditem.cid,
                    name: sditem.name
                }
                columnsTemp.push(sditemColumn);
            });
            tableDates = _.uniq(tempDates).sort();

            //get columns;
            columnsTemp.forEach(function(tempColItem){
                var foundCol = _.find(tableColumns, function(col){ return col.cid === tempColItem.cid; })
                if(!foundCol){
                    tableColumns.push(tempColItem);
                }
            });

            //arrange data for subtable
            tableDates.forEach(function(dateItem){
                var subTableItem = {
                    date: dateItem
                }
                tableSourceData.forEach(function(sdItem){
                    if(parseFloat(sdItem.time) * 1000 === dateItem){
                        subTableItem[sdItem.cid] = sdItem.value;
                    }
                });
                subTableData.push(subTableItem);
            });

            //calculate sub table data
            subtables.forEach(function(subtable, subtableIx){
                subtable.chartData = [];
                subtable.columns.forEach(function(subCol){
                    var tempdata = [];
                    subTableData.forEach(function(subDataItem){
                        var calc = subCol.calculation.replace(/(\[[0-9]+\])/g,"subDataItem$1");
                        var calculatedVal = eval(calc);
                        if(!isNaN(calculatedVal)){
                            tempdata.push([subDataItem.date, calculatedVal]);
                        };
                    })
                    subtable.chartData.push({
                        name: subCol.subTbColName,
                        data: tempdata
                    })
                })
                

                $('.for_sub_chart').append('<div id="subtable'+subtableIx+'"></div>');
                var chart1 = Highcharts.chart('subtable'+subtableIx, {
                    chart: {
                        type: 'spline'
                    },
                    title: {
                        text: subtable.name
                    },
                    subtitle: {
                        text: null
                    },
                    xAxis: {
                        title: {
                            text: null
                        },
                        type: "datetime",
                        labels: {
                            format: '{value: %Y%m%d}'
                        }
                    },
                    yAxis: {
                        title: {
                            text: null
                        }
                    },
                    tooltip: {
                        split: true
                    },
                    plotOptions: {
                        spline: {
                            marker: {
                                enabled: true
                            }
                        }
                    },
                    series: subtable.chartData
                });
            });
        })
    }    
});
</script>
</html>