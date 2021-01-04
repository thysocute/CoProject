// $(function(){
//     alert("lll")
// })
// alert("lll");
//声明省
var types = ["PC", "laptop", "tablet", "cellPhone"]; //直接声明Array
 //声明市
var brands = [
    ["戴尔", "联想", "惠普", "华硕", "清华同方"],
    ["华为", "苹果", "联想", "戴尔", "惠普", "宏基", "索尼","神州"],
    ["华为", "苹果", "微软", "三星"],
    ["华为", "苹果", "索尼", "OPPO"]
];
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

//设置一个省的公共下标
var pIndex = -1;
var typeEle = document.getElementById("type");
var brandEle = document.getElementById("brand");
var modelEle = document.getElementById("model");
console.log(types.length)
console.log(typeEle)
console.log(brandEle)
console.log(modelEle)

 //先设置省的值
for (var i = 0; i < types.length; i++) {
    //声明option.<option value="types[i]">types[i]</option>
    var op = new Option(types[i], i);
    console.log(op)
    //添加
    typeEle.options.add(op);
}



function chg(obj) {
    if (obj.value == -1) {
        brandEle.options.length = 0;
        modelEle.options.length = 0;
    }
    //获取值
    var val = obj.value;
    pIndex = obj.value;
    //获取ctiry
    var cs = brands[val];
    //获取默认区
    var as = models[val][0];
    //先清空市
    brandEle.options.length = 0;
    modelEle.options.length = 0;
    for (var i = 0; i < cs.length; i++) {
        var op = new Option(cs[i], i);
        brandEle.options.add(op);
    }
    for (var i = 0; i < as.length; i++) {
        var op = new Option(as[i], i);
        modelEle.options.add(op);
    }
}

function chg2(obj) {
    var val = obj.selectedIndex;
    var as = models[pIndex][val];
    modelEle.options.length = 0;
    for (var i = 0; i < as.length; i++) {
        var op = new Option(as[i], i);
        modelEle.options.add(op);
    }
}

// });