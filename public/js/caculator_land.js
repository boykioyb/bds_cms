/*
--------------------------------------------------------------------------------------------------------------
| diện tích lô đất |      m2     | <= 50 | 75 | 100 | 200 | 300 | 500 | 1000 |
--------------------------------------------------------------------------------------------------------------
|  mật độ          | nội thành   | 100   | 90 | 85 |  80  | 75 |  70 |   65  |
|  mật độ          | ngoại thành | 100  |  90 | 80 |  70 | 60  |  50 |  50   |
| VD: 83 m2 nhà ở nội thành
mật độ (%) = 90+(85-90)/(100-75)*(83-75) = 88.4%
diện tích được phép xây: 83 x 88.4% = 73.37m2
---------------------------------------------------------------------------------------------------------------
*/
$(document).on('keyup', '#land_area_of_study', function () {
    let area = $('#area').val();
    let lang_area = $(this).val();
    if (parseInt(area) === 1) {
        let value = innerCity(lang_area).toFixed(1);
        $('#construction_land_area').val(((value*lang_area)/100).toFixed(2));
        $('#construction_density').val(value);
    } else {
        let value = suburban(lang_area).toFixed(1);
        $('#construction_land_area').val(((value*lang_area)/100).toFixed(2));
        $('#construction_density').val(value);
    }
});

function innerCity(number) {
    let land_area = parseInt(number);
    let result = 0;

    if (land_area <= 50) {
        result = 100+(90-100)/(75-50)*(land_area-50);
    }
    if (land_area > 50 && land_area <= 75) {
        result = 0;
    }
    if (land_area > 75 && land_area <= 100) {
        result = 90+(85-90)/(100-75)*(land_area-75);
    }
    if (land_area > 100 && land_area <= 200) {
        result = 85+(80-85)/(200-100)*(land_area-100);
    }
    if (land_area > 200 && land_area <= 300) {
        result = 80+(75-80)/(300-200)*(land_area-200);

    }
    if (land_area > 300 && land_area <= 500) {
        result = 75+(70-75)/(500-200)*(land_area-300);
    }
    if (land_area > 500 && land_area <= 1000) {
        result = 70+(65-70)/(1000-500)*(land_area-500);
    }
    if (land_area > 1000) {
        result = 65+(65)/(1000)*(land_area);
    }
    return result;
}

function suburban(number) {
    let land_area = parseInt(number);
    let result = 0;

    if (land_area <= 50) {
        result = 100+(90-100)/(75-50)*(land_area-50);
    }
    if (land_area > 50 && land_area <= 75) {
        result = 0;
    }
    if (land_area > 75 && land_area <= 100) {
        result = 90+(80-90)/(100-75)*(land_area-75);
    }
    if (land_area > 100 && land_area <= 200) {
        result = 80+(70-80)/(200-100)*(land_area-100);
    }
    if (land_area > 200 && land_area <= 300) {
        result = 70+(60-70)/(300-200)*(land_area-200);

    }
    if (land_area > 300 && land_area <= 500) {
        result = 60+(50-60)/(500-200)*(land_area-300);
    }
    if (land_area > 500 && land_area <= 1000) {
        result = 50+(50-50)/(1000-500)*(land_area-500);
    }
    if (land_area > 1000) {
        result = 50+(50)/(1000)*(land_area);
    }
    return result;
}

