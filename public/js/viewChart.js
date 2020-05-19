var value = $("#chart-option").html();
//event add new option and assign click event for remove button
$(".btn-add").click(function () { 
    //check selected before append
    var skills = getSkillsArray();
    if(notDuplicate(skills) && notNull(skills)){
        if ($("#error").text() == errAdd) {
            $("#error").text("");
        }
        $("#chart-option").append(value);
        //add event click for button remove
        $(".btn-remove").on('click', function() {
            removeOption(this);
        });
    } else {
        //display an error
        $("#error").text(errAdd);
    }
});

$(".btn-refresh").click(function () { 
    $("#chart-option").html(null);
    $("#chart-option").append(value);
});

// ==================================
// === functions for REMOVE button ==
// ==================================
function removeOption(selected) {
    var option = findParent(selected, "option");
    $(option).remove();
}

function findParent(obj, className) {
    var element = obj;
    var arrClass = $(element).attr('class');
    while (arrClass != "") {
        if (checkClassName(arrClass, className)) {
            return element;
        } else {
            element = $(element).parent();
            arrClass = $(element).attr('class');
        }
    }
}
// ==================================
// ======== end functions  ==========
// ==================================

function checkClassName(arrClass, className) {
    var string = "";
    let check = false;
    for (let i = 0; i < arrClass.length; i++) {
        if (arrClass[i] == " ") {
            if (string == className) {
                check = true;
                break;
            } else {
                string = "";
            }
        } else {
            string += arrClass[i];
        }
    }
    return check;
}

$(function () {  
    $(".datepicker1").datepicker({         
        autoclose: true,         
        'format': 'yyyy-mm-dd'
    });
});

$("#btn-show-chart").click(function (e) {
    var skills = getSkillsArray();
    var priorities = getPriorityArray();
    var userId = $("#member-select").val();
    var startDate = $("#datepickerStart").val();
    var endDate = $("#datepickerEnd").val();
    //validate input data
    if (validateUser(userId) && validateSkills(skills) && validateDate(endDate)) {
        $("#error").text("");
        //create data to call ajax
        var arrSkill = getSkillsData(skills);
        var date = getDateReport(startDate, endDate);
        $.ajax({
            url: '/chart/display',
            type: 'GET',
            data: {
                id : userId,
                arrSkill : arrSkill,
                arrPriority : priorities,
                startDate : date["start"],
                endDate : date["end"]
            },
            success : function(response){
                chartData = [];
                displayChartBar(response);
            }
        });
    }
});

function validateUser(userId){
    //check variable
    var check = true;
    //check input
    if (userId == '0') {
        $("#error").text(errNullMember);
        $("#member-select").css("border", "1px solid red");
        check = false;
    } else {
        $("#error").text("");
        $("#member-select").css("border", "");
    }
    return check;
}

function validateSkills(skillsArr) {
    if (skillsArr.length > 1) {
        if (notDuplicate(skillsArr) && notNull(skillsArr)) {
            return true;
        } else {
            $("#error").text(errSkill);
            return false;
        }
    } else {
        return true;
    }
}

function getSkillsData(skillsArr) {
    if (skillsArr.length == 0) {
        return null;
    } else {
        if (skillsArr.length == 1 && skillsArr[0] == 0) {
            return null;
        } else {
            return skillsArr;
        }
    }
}

function getSkillsArray() {
    var skills = [];
    $(".my-select").each(function(){
        skills.push($(this).val());
    });
    return skills;
}

function getPriorityArray() {
    var priority = [];
    $(".input-number").each(function(){
        priority.push($(this).val());
    });
    return priority;
}

function notDuplicate(array) {
    let tempArray = []; 
    let check = true; 
    for (let index=0; index <array.length;index++){
        if(tempArray.indexOf(array[index]) > -1) { 
            check = false; 
            break; 
        } 
        tempArray.push(array[index]);
    } 
    return check;
}

// function getPriorityData(priority) {
//     if (priority.length == 0) {
//         return null;
//     } else {
//         if (priority.length == 1 && priority[0] == 0) {
//             return null;
//         } else {
//             return priority;
//         }
//     }
// }
// ==================================
// === functions for DATE ===========
// ==================================
function validateDate(endDate) {
    let check = new Date(endDate);
    let now = new Date();
    if (check > now) {
        $("#datepickerEnd").css("border", "1px solid red");
        $("#error-date").text(overDate);
        return false;
    } else {
        $("#datepickerEnd").css("border", "");
        $("#error-date").text("");
        return true;
    }
}

function checkDate(date) {
    return (date == "") ? false : true;
}

function getDateReport(startDay, endDay) {
    var date = [];
    var dayDefault = "01";
    if (!checkDate(startDay) && !checkDate(endDay)) {
        let datetime = new Date();
        date['end'] = datetime.getFullYear()+"-"+(datetime.getMonth()+1)+"-"+datetime.getDate();
        date['start'] = datetime.getFullYear()+"-"+getFirstOfQuarter(date['end'])+"-"+dayDefault;
    }
    if (checkDate(startDay) && !checkDate(endDay)) {
        let datetime = new Date();
        date['end'] = datetime.getFullYear()+"-"+(datetime.getMonth()+1)+"-"+datetime.getDate();
        date['start'] = startDay;
    }
    if (!checkDate(startDay) && checkDate(endDay)) {
        let datetime = new Date(endDay);
        date['end'] = endDay;
        date['start'] = datetime.getFullYear()+"-"+getFirstOfQuarter(date['end'])+"-"+dayDefault;
    }
    if (checkDate(startDay) && checkDate(endDay)) {
        date['end'] = endDay;
        date['start'] = startDay;
    }
    return date;
}


function getFirstOfQuarter(date) {
    let datetime = new Date(date);
    //month of year variable
    let january = "01";
    let april = "04";
    let july = "07";
    let october = "10";
    switch(datetime.getMonth()+1) {
        case 1:
            return january;
            break;
        case 2:
            return january;
            break;
        case 3:
            return january;
            break;
        case 4:
            return april;
            break;
        case 5:
            return april;
            break;
        case 6:
            return april;
            break;
        case 7:
            return july;
            break;
        case 8:
            return july;
            break;
        case 9:
            return july;
            break;
        case 10:
            return october;
            break;
        case 11:
            return october;
            break;
        case 12:
            return october;
            break;
    }
}
// ==================================
// ======== end functions  ==========
// ==================================

// ==================================
// == functions for click username ==
// ==================================
$(window).on('load', function () {
    if($(".hidden-userId").val()) {
      getChartById($(".hidden-userId").val());
    }
});

function getChartById(userId) {
    var arrSkill = getSkillsData([""]);
    var date = getDateReport("", "");
    $.ajax({
        url: '/chart/display',
        type: 'GET',
        data: {
            id : userId,
            arrSkill : arrSkill,
            arrPriority : [""],
            startDate : date["start"],
            endDate : date["end"]
        },
        success : function(response) {
            chartData = [];
            displayChartBar(response);
        }
    });
}
// ==================================
// ======== end functions  ==========
// ==================================

function notNull(array) {
    var check = true;
    for (let index = 0; index < array.length; index++) {
        if(array[index] == "0") {
            check = false;
            break;
        }
    }
    return check;
}

var chart;
var chartData = [];
function displayChartBar(response) {
    //create chart data
    for (let i = 0; i < response.length; i++) {
        var arr = [];
        var temp = response[i].timerange;
        if (temp != null) {
            for (let j = 0; j < temp.length; j++) {
            arr.push({"skill" : temp[j].quarter, "level" : temp[j].value});
            }
        } 
        var data = {
            "skill" : response[i].skill_name,
            "level" : response[i].skill_level,
            "url" : "#",
            "description" : drill,
            //driffdown data  
            // "quarters" : [
            //     { "skill": "Q1", "level": 2 },
            //     { "skill": "Q2", "level": 2 },
            //     { "skill": "Q3", "level": 3 },
            //     { "skill": "Q4", "level": 3 }
            // ]
            "quarters" : arr
        };
        chartData.push(data);
    }

    chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "none",
        "pathToImages": "/lib/3/images/",
        "autoMargins": false,
        "marginLeft": 30,
        "marginRight": 8,
        "marginTop": 10,
        "marginBottom": 26,
        "titles": [{
            "text": chartTitle
        }],
        "dataProvider": chartData,
        "startDuration": 1,
        "graphs": [{
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span> <br>[[description]]",
            "dashLengthField": "dashLengthColumn",
            "fillAlphas": 1,
            "title": "Level",
            "type": "column",
            "valueField": "level","urlField":"url"
        }],
        "categoryField": "skill",
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "tickLength": 0
        }
    });

    chart.addListener("clickGraphItem", function (event) {
        if ( 'object' === typeof event.item.dataContext.quarters ) {

        // set the monthly data for the clicked quarters
        event.chart.dataProvider = event.item.dataContext.quarters;
        
        // update the chart title
        event.chart.titles[0].text = event.item.dataContext.skill + driffTitle;
        
        // let's add a label to go back
        event.chart.addLabel(
            "!15", 25, 
            "Go back >",
            "right", 
            undefined, 
            undefined, 
            undefined, 
            undefined, 
            true, 
            'javascript:resetChart();');
        
        // validate the new data and make the chart animate again
        event.chart.validateData();
        event.chart.animateAgain();
        }
    });
}

// function which resets the chart back
function resetChart() {
    chart.dataProvider = chartData;
    chart.titles[0].text = chartTitle;
    
    // remove the "Go back" label
    chart.allLabels = [];
    
    chart.validateData();
    chart.animateAgain();
}