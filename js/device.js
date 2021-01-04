$(function(){

  $("#test").click(function(){
    $.ajax({
      url:'../php/searchDevice.php',
      data: {"action":"action"},
      type:'POST',
      dataType:'json',
      success:function(data){

        console.log(data);
        // 刷新当前文档
        // location.reload();
        // 从各个数据源重新获取并且渲染数据：
        // $('#calendar').fullCalendar('refetchEvents');
        
      },
      error:function(){
        alert("Failed");
      }
        
    });
  })

  //声明设备类型
  var types = ["PC", "laptop", "tablet", "cellPhone"]; //直接声明Array
 //声明设备品牌
  var brands = [
    ["戴尔", "联想", "惠普", "华硕", "清华同方"],
    ["华为", "苹果", "联想", "戴尔", "惠普", "宏基", "索尼","神州"],
    ["华为", "苹果", "微软", "三星"],
    ["华为", "苹果", "索尼", "OPPO"]
  ];
  // 声明设备型号
  var models = [
    [
      ["戴尔成就3681", "戴尔Vostro", "戴尔灵越3880"],
      ["联想天逸510 Pro", "联想拯救者刃7000", "联想扬天M2601d", "联想启天M428"],
      ["惠普小欧S01-pF054ccn", "惠普战99 Pro G2 MT", "惠普星 TP01-055ccn"],
      ["华硕弘道D630MT", "华硕ROG 光魔G35DX", "硕ROG 光魔G15"],
      ["清华同方精锐M820", "清华同方超越E500-83781", "清华同方超扬A7500"]
    ],
    [
      ["matebook X Pro 高端，超级本bai，轻薄本", "matebook X高端，上bai网本，轻薄du本，影音本", "matebook D 中端办公本"],
      ["macbook", "macbook air", "macbook pro"],
      ["联想小新Pro 13", "联想小新Air 14", "联想拯救者Y7000P ", "联想拯救者R7000"],
      ["戴尔灵越 5493 14", "戴尔XPS 13-9300-1808T", "戴尔Vostro成就", "戴尔燃7000 3代"],
      ["惠普暗影精灵6", "惠普战66 Pro G3", "惠普光影精灵5", "惠普星14 青春版 "]
    ],
    [
      ["华为MatePad Pro", "华为M6", "华为MatePad", "华为畅享平板"],
      ["苹果ipad air 3", "苹果iPad", "苹果 iPad Pro"],
      ["微软Surface Pro", "微软Surface Go ", "微软Surface Pro X", "微软Surface mini"],
      ["三星Galaxy Tab S6 ", "三星 Galaxy Tab S5e", "三星Galaxy Tab A Plus"]
    ],
    [
      ["华为nova 7", "华为nova 7 Pro ", "华为P40 ", "华为P40 Pro"],
      ["苹果iPhone11 ", "苹果iPhone11ProMax", "苹果iPhoneXS Max "],
      ["索尼Xperia 1 ", "索尼Xperia5 ", "索尼XZ2 Premium"],
      ["OPPO Reno 4  ", "OPPO A92s", "OPPO Reno 4 Pro "]

    ]
  ];

  var typeEle = document.getElementById("type");
  var brandEle = document.getElementById("brand");
  var modelEle = document.getElementById("model");


  // 点击添加按钮
  $("#addBtn").click(function() {
    // 显示添加设备框
    $(".boxBackground").css("display","block");
    // alert("eee")
    //设置一个设备类型的公共下标
    var pIndex = -1;

    //先设置设备类型的值
    for (var i = 0; i < types.length; i++) {
        //声明option.<option value="types[i]">types[i]</option>
        var op = new Option(types[i], i);
        //添加
        typeEle.options.add(op);
    }


  }) /*添加设备事件结束*/

  $("#CancelAddBtn").click(function() {
    // cancel 添加设备框
    $("#deviceTips").empty();
    $(".boxBackground").css("display","none");
  });


  // 当设备类型改变时
  $("#type").change(function(){
    $("#deviceTips").empty();

    if ($(this).value == -1) {
        brandEle.options.length = 0;
        modelEle.options.length = 0;
    }
    //获取值
    var val = $(this).val();
    pIndex = $(this).val();
    // console.log(pIndex)

    //获取品牌brands
    var cs = brands[val];
    //获取默认型号models
    var as = models[val][0];
    //先清空品牌brands和型号models
    brandEle.options.length = 0;
    modelEle.options.length = 0;
    // 再重新填
    for (var i = 0; i < cs.length; i++) {
        var op = new Option(cs[i], i);
        brandEle.options.add(op);
    }
    // $("#brand").find("option").eq(0).attr("selected","selected");

    for (var i = 0; i < as.length; i++) {
        var op = new Option(as[i], i);
        modelEle.options.add(op);
    }
    // $("#model").find("option").eq(0).attr("selected","selected");
  });

  // 当设备品牌改变时
  $("#brand").change(function(){
    $("#deviceTips").empty();

    var val = $(this).val();
    var as = models[pIndex][val];
    // console.log(val)
    modelEle.options.length = 0;
    for (var i = 0; i < as.length; i++) {
        var op = new Option(as[i], i);
        modelEle.options.add(op);
    }
  });

  $("#jsCol").on("click", "#addDeviceBtn", function(event){
    event.preventDefault();
    $("#deviceTips").empty();

    var typeVal = $(type).val();
    var brandVal = $(brand).val();
    var modelVal = $(model).val();
    console.log(typeVal + "\n" + brandVal + "\n" + modelVal)

    if(typeVal < 0) {
      $("#deviceTips").text("设备选择为空，请重新选择！");
      return false;

    } else {
      $("#deviceTips").empty();
      var dType  = types[typeVal];
      var dBrand = brands[typeVal][brandVal];
      var dModel = models[typeVal][brandVal][modelVal];
      console.log(dType + "\n" + dBrand + "\n" + dModel)
      $.ajax({
        url:'../php/addDevice.php',
        data: {deviceType:dType,deviceBrand:dBrand,deviceModel:dModel},
        type:'POST',
        dataType:'json',
        success:function(data){
          console.log(data);
          $(".boxBackground").css("display","none");
          // 刷新当前文档
          location.reload();
          // 从各个数据源重新获取并且渲染数据：
          // $('#calendar').fullCalendar('refetchEvents');
          
        },
        error:function(){
          alert("Failed");
        }
          
      });
    }
    // alert("ddd")
  }) /*$("#jsCol").on() end*/

})
