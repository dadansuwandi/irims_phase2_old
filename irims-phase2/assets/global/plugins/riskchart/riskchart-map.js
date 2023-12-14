/********************************************************
 *	Risk Chart Map to Draw Risk Chart with SVG and D3 JS	*
 *	Author : Wildan Sawaludin								*
 *	Email  : wildan.sawaludin@gmail.com					 	*
 ********************************************************/

function drawRiskChartMap(data) {
  var svgContainer = d3
    .select("#risk-chart-map-d3")
    .append("svg")
    .attr("width", "100%")
    .attr("height", "100%")
    .attr("viewBox", "0 0 262 262");

  svgContainer
    .append("rect")
    .attr("width", "262")
    .attr("height", "262")
    .attr("fill", "white");

  /*ROW BOX 1*/
  var groupRow1 = svgContainer.append("g");

  groupRow1
    .append("rect")
    .attr("x", "20")
    .attr("y", "1")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "white")
    .attr("stroke", "white");

  /*E DAHSYAT*/
  var groupLabel1 = groupRow1.append("g");

  groupLabel1
    .append("rect")
    .attr("x", "17")
    .attr("y", "2")
    .attr("width", "31")
    .attr("height", "38")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel1
    .append("text")
    .attr("x", "24")
    .attr("y", "20")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Sangat");

  groupLabel1
    .append("text")
    .attr("x", "25")
    .attr("y", "25")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Besar");

  groupLabel1
    .append("rect")
    .attr("x", "50")
    .attr("y", "2")
    .attr("width", "10")
    .attr("height", "38")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel1
    .append("text")
    .attr("x", "53")
    .attr("y", "23")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("E");

  groupRow1
    .append("rect")
    .attr("x", "61")
    .attr("y", "1")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#72DAD7")
    .attr("stroke", "white");

  groupRow1
    .append("rect")
    .attr("x", "101")
    .attr("y", "1")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#72DAD7")
    .attr("stroke", "white");

  groupRow1
    .append("rect")
    .attr("x", "141")
    .attr("y", "1")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FFFF00")
    .attr("stroke", "white");

  groupRow1
    .append("rect")
    .attr("x", "181")
    .attr("y", "1")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FE0000")
    .attr("stroke", "white");

  groupRow1
    .append("rect")
    .attr("x", "221")
    .attr("y", "1")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FE0000")
    .attr("stroke", "white");

  /*ROW BOX 2*/
  var groupRow2 = svgContainer.append("g");

  groupRow2
    .append("rect")
    .attr("x", "20")
    .attr("y", "41")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "white")
    .attr("stroke", "white");

  /*D BESAR*/
  var groupLabel2 = groupRow2.append("g");

  groupLabel2
    .append("rect")
    .attr("x", "17")
    .attr("y", "42")
    .attr("width", "31")
    .attr("height", "38")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel2
    .append("text")
    .attr("x", "25")
    .attr("y", "63")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Besar");

  groupLabel2
    .append("rect")
    .attr("x", "50")
    .attr("y", "42")
    .attr("width", "10")
    .attr("height", "38")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel2
    .append("text")
    .attr("x", "53")
    .attr("y", "63")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("D");

  groupRow2
    .append("rect")
    .attr("x", "61")
    .attr("y", "41")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#51D14F")
    .attr("stroke", "white");

  groupRow2
    .append("rect")
    .attr("x", "101")
    .attr("y", "41")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#72DAD7")
    .attr("stroke", "white");

  groupRow2
    .append("rect")
    .attr("x", "141")
    .attr("y", "41")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FFFF00")
    .attr("stroke", "white");

  groupRow2
    .append("rect")
    .attr("x", "181")
    .attr("y", "41")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FE0000")
    .attr("stroke", "white");

  groupRow2
    .append("rect")
    .attr("x", "221")
    .attr("y", "41")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FE0000")
    .attr("stroke", "white");

  /*ROW BOX 3*/
  var groupRow3 = svgContainer.append("g");

  groupRow3
    .append("rect")
    .attr("x", "20")
    .attr("y", "81")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "white")
    .attr("stroke", "white");

  /*C MENENGAH*/
  var groupLabel3 = groupRow3.append("g");

  groupLabel3
    .append("rect")
    .attr("x", "17")
    .attr("y", "82")
    .attr("width", "31")
    .attr("height", "38")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel3
    .append("text")
    .attr("x", "23")
    .attr("y", "103")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Sedang");

  groupLabel3
    .append("rect")
    .attr("x", "50")
    .attr("y", "82")
    .attr("width", "10")
    .attr("height", "38")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel3
    .append("text")
    .attr("x", "53")
    .attr("y", "103")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("C");

  groupRow3
    .append("rect")
    .attr("x", "61")
    .attr("y", "81")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#51D14F")
    .attr("stroke", "white");

  groupRow3
    .append("rect")
    .attr("x", "101")
    .attr("y", "81")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#72DAD7")
    .attr("stroke", "white");

  groupRow3
    .append("rect")
    .attr("x", "141")
    .attr("y", "81")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FFFF00")
    .attr("stroke", "white");

  groupRow3
    .append("rect")
    .attr("x", "181")
    .attr("y", "81")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FFFF00")
    .attr("stroke", "white");

  groupRow3
    .append("rect")
    .attr("x", "221")
    .attr("y", "81")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FE0000")
    .attr("stroke", "white");

  /*ROW BOX 4*/
  var groupRow4 = svgContainer.append("g");

  groupRow4
    .append("rect")
    .attr("x", "20")
    .attr("y", "121")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "white")
    .attr("stroke", "white");

  /*B RENDAH*/
  var groupLabel4 = groupRow4.append("g");

  groupLabel4
    .append("rect")
    .attr("x", "17")
    .attr("y", "122")
    .attr("width", "31")
    .attr("height", "38")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel4
    .append("text")
    .attr("x", "26")
    .attr("y", "143")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Kecil");

  groupLabel4
    .append("rect")
    .attr("x", "50")
    .attr("y", "122")
    .attr("width", "10")
    .attr("height", "38")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel4
    .append("text")
    .attr("x", "53")
    .attr("y", "143")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("B");

  groupRow4
    .append("rect")
    .attr("x", "61")
    .attr("y", "121")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#51D14F")
    .attr("stroke", "white");

  groupRow4
    .append("rect")
    .attr("x", "101")
    .attr("y", "121")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#51D14F")
    .attr("stroke", "white");

  groupRow4
    .append("rect")
    .attr("x", "141")
    .attr("y", "121")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#72DAD7")
    .attr("stroke", "white");

  groupRow4
    .append("rect")
    .attr("x", "181")
    .attr("y", "121")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FFFF00")
    .attr("stroke", "white");

  groupRow4
    .append("rect")
    .attr("x", "221")
    .attr("y", "121")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FE0000")
    .attr("stroke", "white");

  /*ROW BOX 5*/
  var groupRow5 = svgContainer.append("g");

  groupRow5
    .append("rect")
    .attr("x", "20")
    .attr("y", "161")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "white")
    .attr("stroke", "white");

  /*A TIDAK SIGNIFIKAN*/
  var groupLabel5 = groupRow5.append("g");

  groupLabel5
    .append("rect")
    .attr("x", "17")
    .attr("y", "162")
    .attr("width", "31")
    .attr("height", "38")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel5
    .append("text")
    .attr("x", "24")
    .attr("y", "180")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Sangat");

  groupLabel5
    .append("text")
    .attr("x", "26")
    .attr("y", "186")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Kecil");

  groupLabel5
    .append("rect")
    .attr("x", "50")
    .attr("y", "162")
    .attr("width", "10")
    .attr("height", "38")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel5
    .append("text")
    .attr("x", "53")
    .attr("y", "183")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("A");

  /* groupLabel5
    .append("text")
    .attr("x", "26")
    .attr("y", "189")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("SIGNIFIKAN"); */

  groupRow5
    .append("rect")
    .attr("x", "61")
    .attr("y", "161")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#51D14F")
    .attr("stroke", "white");

  groupRow5
    .append("rect")
    .attr("x", "101")
    .attr("y", "161")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#51D14F")
    .attr("stroke", "white");

  groupRow5
    .append("rect")
    .attr("x", "141")
    .attr("y", "161")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#72DAD7")
    .attr("stroke", "white");

  groupRow5
    .append("rect")
    .attr("x", "181")
    .attr("y", "161")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FFFF00")
    .attr("stroke", "white");

  groupRow5
    .append("rect")
    .attr("x", "221")
    .attr("y", "161")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "#FFFF00")
    .attr("stroke", "white");

  /*ROW BOX 6*/
  var groupRow6 = svgContainer.append("g");

  groupRow6
    .append("rect")
    .attr("x", "20")
    .attr("y", "201")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "white")
    .attr("stroke", "white");

  groupRow6
    .append("rect")
    .attr("x", "61")
    .attr("y", "201")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "white")
    .attr("stroke", "white");

  var groupLabel61 = groupRow6.append("g");

  groupLabel61
    .append("rect")
    .attr("x", "62")
    .attr("y", "213")
    .attr("width", "38")
    .attr("height", "31")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel61
    .append("text")
    .attr("x", "75")
    .attr("y", "227")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Tidak");

  groupLabel61
    .append("text")
    .attr("x", "70")
    .attr("y", "233")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Signifikan");

  groupLabel61
    .append("rect")
    .attr("x", "62")
    .attr("y", "202")
    .attr("width", "38")
    .attr("height", "10")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel61
    .append("text")
    .attr("x", "79")
    .attr("y", "209")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("1");

  groupRow6
    .append("rect")
    .attr("x", "101")
    .attr("y", "201")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "white")
    .attr("stroke", "white");

  var groupLabel62 = groupRow6.append("g");

  groupLabel62
    .append("rect")
    .attr("x", "102")
    .attr("y", "213")
    .attr("width", "38")
    .attr("height", "31")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel62
    .append("text")
    .attr("x", "113")
    .attr("y", "229")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Minor");

  groupLabel62
    .append("rect")
    .attr("x", "102")
    .attr("y", "202")
    .attr("width", "38")
    .attr("height", "10")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel62
    .append("text")
    .attr("x", "118")
    .attr("y", "209")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("2");

  groupRow6
    .append("rect")
    .attr("x", "141")
    .attr("y", "201")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "white")
    .attr("stroke", "white");

  var groupLabel63 = groupRow6.append("g");

  groupLabel63
    .append("rect")
    .attr("x", "142")
    .attr("y", "213")
    .attr("width", "38")
    .attr("height", "31")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel63
    .append("text")
    .attr("x", "151")
    .attr("y", "229")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Medium");

  groupLabel63
    .append("rect")
    .attr("x", "142")
    .attr("y", "202")
    .attr("width", "38")
    .attr("height", "10")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel63
    .append("text")
    .attr("x", "158")
    .attr("y", "209")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("3");

  groupRow6
    .append("rect")
    .attr("x", "181")
    .attr("y", "201")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "white")
    .attr("stroke", "white");

  var groupLabel64 = groupRow6.append("g");

  groupLabel64
    .append("rect")
    .attr("x", "182")
    .attr("y", "213")
    .attr("width", "38")
    .attr("height", "31")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel64
    .append("text")
    .attr("x", "189")
    .attr("y", "229")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Signifikan");

  groupLabel64
    .append("rect")
    .attr("x", "182")
    .attr("y", "202")
    .attr("width", "38")
    .attr("height", "10")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel64
    .append("text")
    .attr("x", "198")
    .attr("y", "209")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("4");

  groupRow6
    .append("rect")
    .attr("x", "221")
    .attr("y", "201")
    .attr("width", "40")
    .attr("height", "40")
    .attr("fill", "white")
    .attr("stroke", "white");

  var groupLabel65 = groupRow6.append("g");

  groupLabel65
    .append("rect")
    .attr("x", "222")
    .attr("y", "213")
    .attr("width", "38")
    .attr("height", "31")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel65
    .append("text")
    .attr("x", "232")
    .attr("y", "227")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Sangat");

  groupLabel65
    .append("text")
    .attr("x", "229")
    .attr("y", "233")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("Signifikan");

  groupLabel65
    .append("rect")
    .attr("x", "222")
    .attr("y", "202")
    .attr("width", "38")
    .attr("height", "10")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel65
    .append("text")
    .attr("x", "237")
    .attr("y", "209")
    .attr("font-family", "arial")
    .attr("font-size", "5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("5");

  var groupLabelChart = groupRow6.append("g");

  groupLabel65
    .append("rect")
    .attr("x", "0")
    .attr("y", "2")
    .attr("width", "15")
    .attr("height", "198")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel65
    .append("text")
    .attr("x", "1")
    .attr("y", "130")
    .attr("font-family", "arial")
    .attr("font-size", "6.5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .attr("transform", "rotate(270, 10, 130)")
    .text("TINGKAT KEMUNGKINAN");

  groupLabel65
    .append("rect")
    .attr("x", "62")
    .attr("y", "246")
    .attr("width", "198")
    .attr("height", "15")
    .attr("fill", "white")
    .attr("stroke", "black")
    .attr("stroke-width", "0.5");

  groupLabel65
    .append("text")
    .attr("x", "133")
    .attr("y", "256")
    .attr("font-family", "arial")
    .attr("font-size", "6.5")
    .attr("fill", "black")
    .attr("font-weight", "bold")
    .text("TINGKAT DAMPAK");

  /*DEFINE COORDINATE DOTS*/
  var dots_coordinate = new Array();

  dots_coordinate["1E"] = [81, 20];
  dots_coordinate["2E"] = [121, 20];
  dots_coordinate["3E"] = [161, 20];
  dots_coordinate["4E"] = [201, 20];
  dots_coordinate["5E"] = [241, 20];

  dots_coordinate["1D"] = [81, 60];
  dots_coordinate["2D"] = [121, 60];
  dots_coordinate["3D"] = [161, 60];
  dots_coordinate["4D"] = [201, 60];
  dots_coordinate["5D"] = [241, 60];

  dots_coordinate["1C"] = [81, 101];
  dots_coordinate["2C"] = [121, 101];
  dots_coordinate["3C"] = [161, 101];
  dots_coordinate["4C"] = [201, 101];
  dots_coordinate["5C"] = [241, 101];

  dots_coordinate["1B"] = [81, 141];
  dots_coordinate["2B"] = [121, 141];
  dots_coordinate["3B"] = [161, 141];
  dots_coordinate["4B"] = [201, 141];
  dots_coordinate["5B"] = [241, 141];

  dots_coordinate["1A"] = [81, 181];
  dots_coordinate["2A"] = [121, 181];
  dots_coordinate["3A"] = [161, 181];
  dots_coordinate["4A"] = [201, 181];
  dots_coordinate["5A"] = [241, 181];

  /*DEFINE COORDINAT NUMBER PER BLOCK*/
  var number_coordinate = new Array();

  number_coordinate["1E"] = [
    [80, 14],
    [87, 21.5],
    [80, 28.5],
    [73, 21.5],
    [80, 7.5],
    [93, 21.5],
    [80, 34.5],
    [67, 21.5],
    [87, 14],
    [87, 28.5],
    [73, 28.5],
    [73, 14],
    [93, 7.5],
    [93, 34.5],
    [67, 34.5],
    [67, 7.5],
  ];
  number_coordinate["2E"] = [
    [120, 14],
    [127, 21.5],
    [120, 28.5],
    [113, 21.5],
    [120, 7.5],
    [133, 21.5],
    [120, 34.5],
    [107, 21.5],
    [127, 14],
    [127, 28.5],
    [113, 28.5],
    [113, 14],
    [133, 7.5],
    [133, 34.5],
    [107, 34.5],
    [107, 7.5],
  ];
  number_coordinate["3E"] = [
    [160, 14],
    [167, 21.5],
    [160, 28.5],
    [153, 21.5],
    [160, 7.5],
    [173, 21.5],
    [160, 34.5],
    [147, 21.5],
    [167, 14],
    [167, 28.5],
    [153, 28.5],
    [153, 14],
    [173, 7.5],
    [173, 34.5],
    [147, 34.5],
    [147, 7.5],
  ];
  number_coordinate["4E"] = [
    [200, 14],
    [207, 21.5],
    [200, 28.5],
    [193, 21.5],
    [200, 7.5],
    [213, 21.5],
    [200, 34.5],
    [187, 21.5],
    [207, 14],
    [207, 28.5],
    [193, 28.5],
    [193, 14],
    [213, 7.5],
    [213, 34.5],
    [187, 34.5],
    [187, 7.5],
  ];
  number_coordinate["5E"] = [
    [240, 14],
    [247, 21.5],
    [240, 28.5],
    [233, 21.5],
    [240, 7.5],
    [253, 21.5],
    [240, 34.5],
    [227, 21.5],
    [247, 14],
    [247, 28.5],
    [233, 28.5],
    [233, 14],
    [253, 7.5],
    [253, 34.5],
    [227, 34.5],
    [227, 7.5],
  ];

  number_coordinate["1D"] = [
    [80, 54],
    [87, 61.5],
    [80, 68.5],
    [73, 61.5],
    [80, 47.5],
    [93, 61.5],
    [80, 74.5],
    [67, 61.5],
    [87, 54],
    [87, 68.5],
    [73, 68.5],
    [73, 54],
    [93, 47.5],
    [93, 74.5],
    [67, 74.5],
    [67, 47.5],
  ];
  number_coordinate["2D"] = [
    [120, 54],
    [127, 61.5],
    [120, 68.5],
    [113, 61.5],
    [120, 47.5],
    [133, 61.5],
    [120, 74.5],
    [107, 61.5],
    [127, 54],
    [127, 68.5],
    [113, 68.5],
    [113, 54],
    [133, 47.5],
    [133, 74.5],
    [107, 74.5],
    [107, 47.5],
  ];
  number_coordinate["3D"] = [
    [160, 54],
    [167, 61.5],
    [160, 68.5],
    [153, 61.5],
    [160, 47.5],
    [173, 61.5],
    [160, 74.5],
    [147, 61.5],
    [167, 54],
    [167, 68.5],
    [153, 68.5],
    [153, 54],
    [173, 47.5],
    [173, 74.5],
    [147, 74.5],
    [147, 47.5],
  ];
  number_coordinate["4D"] = [
    [200, 54],
    [207, 61.5],
    [200, 68.5],
    [193, 61.5],
    [200, 47.5],
    [213, 61.5],
    [200, 74.5],
    [187, 61.5],
    [207, 54],
    [207, 68.5],
    [193, 68.5],
    [193, 54],
    [213, 47.5],
    [213, 74.5],
    [187, 74.5],
    [187, 47.5],
  ];
  number_coordinate["5D"] = [
    [240, 54],
    [247, 61.5],
    [240, 68.5],
    [233, 61.5],
    [240, 47.5],
    [253, 61.5],
    [240, 74.5],
    [227, 61.5],
    [247, 54],
    [247, 68.5],
    [233, 68.5],
    [233, 54],
    [253, 47.5],
    [253, 74.5],
    [227, 74.5],
    [227, 47.5],
  ];

  number_coordinate["1C"] = [
    [80, 94],
    [87, 101.5],
    [80, 108.5],
    [73, 101.5],
    [80, 87.5],
    [93, 101.5],
    [80, 114.5],
    [67, 101.5],
    [87, 94],
    [87, 108.5],
    [73, 108.5],
    [73, 94],
    [93, 87.5],
    [93, 114.5],
    [67, 114.5],
    [67, 87.5],
  ];
  number_coordinate["2C"] = [
    [120, 94],
    [127, 101.5],
    [120, 108.5],
    [113, 101.5],
    [120, 87.5],
    [133, 101.5],
    [120, 114.5],
    [107, 101.5],
    [127, 94],
    [127, 108.5],
    [113, 108.5],
    [113, 94],
    [133, 87.5],
    [133, 114.5],
    [107, 114.5],
    [107, 87.5],
  ];
  number_coordinate["3C"] = [
    [160, 94],
    [167, 101.5],
    [160, 108.5],
    [153, 101.5],
    [160, 87.5],
    [173, 101.5],
    [160, 114.5],
    [147, 101.5],
    [167, 94],
    [167, 108.5],
    [153, 108.5],
    [153, 94],
    [173, 87.5],
    [173, 114.5],
    [147, 114.5],
    [147, 87.5],
  ];
  number_coordinate["4C"] = [
    [200, 94],
    [207, 101.5],
    [200, 108.5],
    [193, 101.5],
    [200, 87.5],
    [213, 101.5],
    [200, 114.5],
    [187, 101.5],
    [207, 94],
    [207, 108.5],
    [193, 108.5],
    [193, 94],
    [213, 87.5],
    [213, 114.5],
    [187, 114.5],
    [187, 87.5],
  ];
  number_coordinate["5C"] = [
    [240, 94],
    [247, 101.5],
    [240, 108.5],
    [233, 101.5],
    [240, 87.5],
    [253, 101.5],
    [240, 114.5],
    [227, 101.5],
    [247, 94],
    [247, 108.5],
    [233, 108.5],
    [233, 94],
    [253, 87.5],
    [253, 114.5],
    [227, 114.5],
    [227, 87.5],
  ];

  number_coordinate["1B"] = [
    [80, 134],
    [87, 141.5],
    [80, 148.5],
    [73, 141.5],
    [80, 127.5],
    [93, 141.5],
    [80, 154.5],
    [67, 141.5],
    [87, 134],
    [87, 148.5],
    [73, 148.5],
    [73, 134],
    [93, 127.5],
    [93, 154.5],
    [67, 154.5],
    [67, 127.5],
  ];
  number_coordinate["2B"] = [
    [120, 134],
    [127, 141.5],
    [120, 148.5],
    [113, 141.5],
    [120, 127.5],
    [133, 141.5],
    [120, 154.5],
    [107, 141.5],
    [127, 134],
    [127, 148.5],
    [113, 148.5],
    [113, 134],
    [133, 127.5],
    [133, 154.5],
    [107, 154.5],
    [107, 127.5],
  ];
  number_coordinate["3B"] = [
    [160, 134],
    [167, 141.5],
    [160, 148.5],
    [153, 141.5],
    [160, 127.5],
    [173, 141.5],
    [160, 154.5],
    [147, 141.5],
    [167, 134],
    [167, 148.5],
    [153, 148.5],
    [153, 134],
    [173, 127.5],
    [173, 154.5],
    [147, 154.5],
    [147, 127.5],
  ];
  number_coordinate["4B"] = [
    [200, 134],
    [207, 141.5],
    [200, 148.5],
    [193, 141.5],
    [200, 127.5],
    [213, 141.5],
    [200, 154.5],
    [187, 141.5],
    [207, 134],
    [207, 148.5],
    [193, 148.5],
    [193, 134],
    [213, 127.5],
    [213, 154.5],
    [187, 154.5],
    [187, 127.5],
  ];
  number_coordinate["5B"] = [
    [240, 134],
    [247, 141.5],
    [240, 148.5],
    [233, 141.5],
    [240, 127.5],
    [253, 141.5],
    [240, 154.5],
    [227, 141.5],
    [247, 134],
    [247, 148.5],
    [233, 148.5],
    [233, 134],
    [253, 127.5],
    [253, 154.5],
    [227, 154.5],
    [227, 127.5],
  ];

  number_coordinate["1A"] = [
    [80, 174],
    [87, 181.5],
    [80, 188.5],
    [73, 181.5],
    [80, 167.5],
    [93, 181.5],
    [80, 194.5],
    [67, 181.5],
    [87, 174],
    [87, 188.5],
    [73, 188.5],
    [73, 174],
    [93, 167.5],
    [93, 194.5],
    [67, 194.5],
    [67, 167.5],
  ];
  number_coordinate["2A"] = [
    [120, 174],
    [127, 181.5],
    [120, 188.5],
    [113, 181.5],
    [120, 167.5],
    [133, 181.5],
    [120, 194.5],
    [107, 181.5],
    [127, 174],
    [127, 188.5],
    [113, 188.5],
    [113, 174],
    [133, 167.5],
    [133, 194.5],
    [107, 194.5],
    [107, 167.5],
  ];
  number_coordinate["3A"] = [
    [160, 174],
    [167, 181.5],
    [160, 188.5],
    [153, 181.5],
    [160, 167.5],
    [173, 181.5],
    [160, 194.5],
    [147, 181.5],
    [167, 174],
    [167, 188.5],
    [153, 188.5],
    [153, 174],
    [173, 167.5],
    [173, 194.5],
    [147, 194.5],
    [147, 167.5],
  ];
  number_coordinate["4A"] = [
    [200, 174],
    [207, 181.5],
    [200, 188.5],
    [193, 181.5],
    [200, 167.5],
    [213, 181.5],
    [200, 194.5],
    [187, 181.5],
    [207, 174],
    [207, 188.5],
    [193, 188.5],
    [193, 174],
    [213, 167.5],
    [213, 194.5],
    [187, 194.5],
    [187, 167.5],
  ];
  number_coordinate["5A"] = [
    [240, 174],
    [247, 181.5],
    [240, 188.5],
    [233, 181.5],
    [240, 167.5],
    [253, 181.5],
    [240, 194.5],
    [227, 181.5],
    [247, 174],
    [247, 188.5],
    [233, 188.5],
    [233, 174],
    [253, 167.5],
    [253, 194.5],
    [227, 194.5],
    [227, 167.5],
  ];

  /*PROCESS DATA*/
  for (var code in data) {
    var chartContent = data[code];

    /*DRAW CIRCLE*/
    svgContainer
      .append("circle")
      .attr("cx", dots_coordinate[code][0])
      .attr("cy", dots_coordinate[code][1])
      .attr("r", "2")
      .attr("fill", "black");

    /*PLACE TEXT*/
    var i = 0;
    for (var ccontent in chartContent) {
      if (i <= 15) {
        svgContainer
          .append("text")
          .attr("x", number_coordinate[code][i][0])
          .attr("y", number_coordinate[code][i][1])
          .attr("font-family", "arial")
          .attr("font-size", "4")
          .attr("fill", "black")
          .attr("font-weight", "bold")
          .attr("data-toggle", "tooltip")
          .attr("data-placement", "auto left")
          .attr("data-trigger", "hover")
          .attr("data-container", "body")
          .attr("title", chartContent[ccontent])
          .text(ccontent);
      }
      i++;
    }
  }
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
