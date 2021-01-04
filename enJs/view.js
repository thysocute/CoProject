$(function(){
    var width = 1000;
    var height = 550;
    var svg = d3.select(".right-content")
        .append("svg")
        .attr("width",width)
        .attr("height",height);

    var marge = {top:10,bottom:10,left:10,right:10}

    var g = svg.append("g")
        .attr("transform","translate("+marge.top+","+marge.left+")");
    var nodes;
    var edges;
    d3.json("../data/force.json").then(function(root) { //设置一个color的颜色比例尺，为了让不同的扇形呈现不同的颜色
            console.log(root);
            nodes=root.nodes;
            edges=root.edges;
            var colorScale = d3.scaleOrdinal()
                .domain(d3.range(nodes.length))
                .range(d3.schemeCategory10);


            var forceSimulation = d3.forceSimulation()
                .force("link", d3.forceLink())
                .force("charge", d3.forceManyBody())
                .force("center", d3.forceCenter());
    //生成节点数据
            forceSimulation.nodes(nodes)
                .on("tick", ticked);//这个函数很重要，后面给出具体实现和说明
    //生成边数据
            forceSimulation.force("link")
                .links(edges)
                .distance(function (d) {//每一边的长度
                    return d.value * 50;
                })
    //设置图形的中心位置
            forceSimulation.force("center")
                .x(width / 2)
                .y(height / 2);
    //在浏览器的控制台输出
            console.log(nodes);
            console.log(edges);
    //绘制边
            var links = g.append("g")
                .selectAll("line")
                .data(edges)
                .enter()
                .append("line")
                .attr("stroke", function (d, i) {
                    return colorScale(d.value);   //边的颜色
                    //return "#ccc";
                })
                .attr("stroke-width", 1);
    //边上文字
            var linksText = g.append("g")
                .selectAll("text")
                .data(edges)
                .enter()
                .append("text")
                .text(function (d) {
                    return d.relation;
                })
    //建立用来放在每个节点和对应文字的分组<g>
            var gs = g.selectAll(".circleText")
                .data(nodes)
                .enter()
                .append("g")
                .attr("transform", function (d, i) {
                    var cirX = d.x;
                    var cirY = d.y;
                    return "translate(" + cirX + "," + cirY + ")";
                })
                .call(d3.drag()
                    .on("start", started)
                    .on("drag", dragged)
                    .on("end", ended)
                );

    //绘制节点
            gs.append("circle")
                // .attr("r",20)
                .attr("r", function (d, i) {    //圆圈半径
                    return d.group * 15;
                })
                .attr("fill", function (d, i) {
                    //return colorScale(i);
                    return colorScale(d.group);
                })
    //文字
            gs.append("text")
                /*.attr("x",-10)
                .attr("y",-20)
                .attr("dy",10)*/
                .attr("x", -25)
                .attr("y", -5)
                .attr("dy", 10)
                .text(function (d) {
                    return d.name;
                })

            function ticked() {
                links
                    .attr("x1", function (d) {
                        return d.source.x;
                    })
                    .attr("y1", function (d) {
                        return d.source.y;
                    })
                    .attr("x2", function (d) {
                        return d.target.x;
                    })
                    .attr("y2", function (d) {
                        return d.target.y;
                    });

                linksText
                    .attr("x", function (d) {
                        return (d.source.x + d.target.x) / 2;
                    })
                    .attr("y", function (d) {
                        return (d.source.y + d.target.y) / 2;
                    });

                gs
                    .attr("transform", function (d) {
                        return "translate(" + d.x + "," + d.y + ")";
                    });
            }

    //drag
            function started(d) {
                if (!d3.event.active) {
                    forceSimulation.alphaTarget(0.9).restart();//设置衰减系数，对节点位置移动过程的模拟，数值越高移动越快，数值范围[0，1]
                }
                d.fx = d.x;
                d.fy = d.y;
            }

            function dragged(d) {
                d.fx = d3.event.x;
                d.fy = d3.event.y;
            }

            function ended(d) {
                if (!d3.event.active) {
                    forceSimulation.alphaTarget(0);
                }
                d.fx = null;
                d.fy = null;
            }
        }
    );
})