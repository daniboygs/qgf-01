$(document).ready(function(){ 

    $('.loader-div').removeClass('loader');
    
    jQuery('#search_chart_form').submit(showChart);
    function showChart(){
        $('.loader-div').addClass('loader');
        fiscalia = $("#fiscalia").val(); 
        start_date = $("#start_date").val();  
        finish_date = $("#finish_date").val();
        chart = $("#chart-selector").val();

        if(chart == undefined){
            chart = '0';
        }

        changeChart('0', fiscalia, start_date, finish_date);
        setTable('0', fiscalia, start_date, finish_date);

        document.getElementById("chart-type").style.display = "block";
        document.getElementById("chart-table-selector").style.display = "block";
        return false;
    }

    $('#chart-selector').on('change', function (e) {
        $('.loader-div').addClass('loader');
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        fiscalia = $("#fiscalia").val(); 
        start_date = $("#start_date").val();  
        finish_date = $("#finish_date").val();
        
        changeChart(valueSelected, fiscalia, start_date, finish_date);
        setTable(valueSelected, fiscalia, start_date, finish_date);
    });

    $("#cancel-record-btn").click(function(){ 
      document.getElementById("create_record_form").reset();
    });

    $("#cancel-study-btn").click(function(){ 
      document.getElementById("create_study_form").reset();
    });



    $('#search-chart-btn').on('click', function() {
		$("#chart-container").load('../views/chemistry/charts/bars_chart.php',
            {'id': this.id, 'url':'<?=$url?>'});
		return false;
    });

    function changeChart(type, fiscalia, start_date, finish_date){

        switch(type){
            case '0':
                $.ajax({  
                    type: "POST",  
                    url: "../views/chemistry/charts/service/get_count_records_by_month.php", 
                    data: "fiscalia="+fiscalia+
                          "&start_date="+start_date+
                          "&finish_date="+finish_date,
                    success: function(response){
        
                        var content_records = JSON.parse(response);
        
                        $.ajax({  
                            type: "POST",  
                            url: "../views/chemistry/charts/service/get_count_studies_by_month.php", 
                            data: "fiscalia="+fiscalia+
                                "&start_date="+start_date+
                                "&finish_date="+finish_date,
                            success: function(response){
                
                            var content_details = JSON.parse(response);
                            
                            $("#chart-container").load('../views/chemistry/charts/bars_charts.php',
                                    {'x1': content_records.x, 'y1': content_records.y, 'x2': content_details.x, 'y2': content_details.y});
                
                            }  
                        });
        
                    }  
                });
                break;
            case '1':
                $.ajax({  
                    type: "POST",  
                    url: "../views/chemistry/charts/service/get_count_studies_by_type.php", 
                    data: "fiscalia="+fiscalia+
                        "&start_date="+start_date+
                        "&finish_date="+finish_date,
                    success: function(response){
        
                    var content_details = JSON.parse(response);

                    
                    $("#chart-container").load('../views/chemistry/charts/stacked_bars_charts.php',
                            {'x1': content_details.x, 'y1': content_details.y});
        
                    }  
                });
                break;
            case '2':
                $.ajax({  
                    type: "POST",  
                    url: "../views/chemistry/charts/service/get_count_records_by_month.php", 
                    data: "fiscalia="+fiscalia+
                          "&start_date="+start_date+
                          "&finish_date="+finish_date,
                    success: function(response){
        
                        var content_records = JSON.parse(response);
        
                        $.ajax({  
                            type: "POST",  
                            url: "../views/chemistry/charts/service/get_count_studies_by_month.php", 
                            data: "fiscalia="+fiscalia+
                                "&start_date="+start_date+
                                "&finish_date="+finish_date,
                            success: function(response){
                
                            var content_details = JSON.parse(response);
                            
                            $("#chart-container").load('../views/chemistry/charts/line_charts.php',
                                    {'x1': content_records.x, 'y1': content_records.y, 'x2': content_details.x, 'y2': content_details.y});
                
                            }  
                        });
        
                    }  
                });
                break;

            case '3':
                $.ajax({  
                    type: "POST",  
                    url: "../views/chemistry/charts/service/get_count_records_by_region.php", 
                    data: "fiscalia="+fiscalia+
                          "&start_date="+start_date+
                          "&finish_date="+finish_date,
                    success: function(response){
        
                        var content_records = JSON.parse(response);
        
                        $.ajax({  
                            type: "POST",  
                            url: "../views/chemistry/charts/service/get_count_studies_by_region.php", 
                            data: "fiscalia="+fiscalia+
                                "&start_date="+start_date+
                                "&finish_date="+finish_date,
                            success: function(response){
                
                            var content_details = JSON.parse(response);
                            
                            $("#chart-container").load('../views/chemistry/charts/bars_charts.php',
                                    {'x1': content_records.x, 'y1': content_records.y, 'x2': content_details.x, 'y2': content_details.y});
                
                            }  
                        });
        
                    }  
                });
                break;

            case '4':
                $.ajax({  
                    type: "POST",  
                    url: "../views/chemistry/charts/service/get_count_drugs_by_crime.php", 
                    data: "fiscalia="+fiscalia+
                        "&start_date="+start_date+
                        "&finish_date="+finish_date,
                    success: function(response){
        
                    var content_details = JSON.parse(response);

                    
                    $("#chart-container").load('../views/chemistry/charts/stacked_bars_charts.php',
                            {'x1': content_details.x, 'y1': content_details.y});
        
                    }  
                });
                break;

            case '5':
                $.ajax({  
                    type: "POST",  
                    url: "../views/chemistry/charts/service/get_count_details_by_study.php", 
                    data: "fiscalia="+fiscalia+
                        "&start_date="+start_date+
                        "&finish_date="+finish_date,
                    success: function(response){

                        console.log(response);
        
                    var content_details = JSON.parse(response);

                    
                    $("#chart-container").load('../views/chemistry/charts/stacked_bars_charts.php',
                            {'x1': content_details.x, 'y1': content_details.y});
        
                    }  
                });
                break;

            default:
                $("#chart-container").html('<div></div>');

        }
    }

    function setTable(type, fiscalia, start_date, finish_date){

        switch(type){

            case '0':

                $.ajax({  
                    type: "POST",  
                    url: "../views/chemistry/charts/templates/tables/records_studies_by_month.php", 
                    data: "fiscalia="+fiscalia+
                        "&start_date="+start_date+
                        "&finish_date="+finish_date,
                    success: function(response){

                        $("#table-container").html(response);
        
                    }  
                });

            break;

            case '1':

                $.ajax({  
                    type: "POST",  
                    url: "../views/chemistry/charts/templates/tables/studies_by_type.php", 
                    data: "fiscalia="+fiscalia+
                        "&start_date="+start_date+
                        "&finish_date="+finish_date,
                    success: function(response){

                        $("#table-container").html(response);
        
                    }  
                });

            break;

            case '2':

                $.ajax({  
                    type: "POST",  
                    url: "../views/chemistry/charts/templates/tables/records_by_month.php", 
                    data: "fiscalia="+fiscalia+
                        "&start_date="+start_date+
                        "&finish_date="+finish_date,
                    success: function(response){

                        $("#table-container").html(response);
        
                    }  
                });

            break;

            case '3':

                $.ajax({  
                    type: "POST",  
                    url: "../views/chemistry/charts/templates/tables/records_studies_by_region.php", 
                    data: "fiscalia="+fiscalia+
                        "&start_date="+start_date+
                        "&finish_date="+finish_date,
                    success: function(response){

                        $("#table-container").html(response);
        
                    }  
                });

            break;

            case '4':
                $.ajax({  
                    type: "POST",  
                    url: "../views/chemistry/charts/templates/tables/drugs_by_crime.php", 
                    data: "fiscalia="+fiscalia+
                            "&start_date="+start_date+
                            "&finish_date="+finish_date,
                    success: function(response){
        

                        $("#table-container").html(response);
        
                    }  
                });
                break;
            
            case '5':
                $.ajax({  
                    type: "POST",  
                    url: "../views/chemistry/charts/templates/tables/details_by_study.php", 
                    data: "fiscalia="+fiscalia+
                            "&start_date="+start_date+
                            "&finish_date="+finish_date,
                    success: function(response){
        

                        $("#table-container").html(response);
        
                    }  
                });
                break;

            default:
                $("#table-container").html('<div></div>');

        }

    }
    

    function myFunction() {
        var checkBox = document.getElementById("myCheck");
        
        if (checkBox.checked == true){
          text.style.display = "block";
        } else {
           text.style.display = "none";
        }
      }

   

});	

function tableToExcel ()  {
    var uri = 'data:application/vnd.ms-excel;base64,'
      , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta cha' + 'rset="UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
      , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
      , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
    
      
  
      table = document.getElementById('table_count');
      var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
      window.location.href = uri + base64(format(template, ctx));
      
  }


function changeSelector(){
    if (document.getElementById('table-option').checked) {
        document.getElementById('chart-container').style.display = "none";
        document.getElementById('table-container').style.display = "block";
    }
    else{
        document.getElementById('table-container').style.display = "none";
        document.getElementById('chart-container').style.display = "block";
    }
}

