$(document).ready(function() {
  $('.loader-div').removeClass('loader');

    jQuery('#create_record_form').submit(create_record);

    
    function create_record(){

      $('.loader-div').addClass('loader');
        nuc=$("#nuc").val();  
        date=$("#date").val(); 
        authority=$("#authority").val();
        fiscalia=$("#fiscalia").val();
        perito=$("#perito").val();  
        oficio=$("#oficio").val();
        crime=0;

        $.ajax({  
            type: "POST",  
            url: "../views/chemistry/records/service/validate_nuc.php",  
            data:   "nuc="+nuc
        }).done(function(response){

          if(response != 0){
            crime = response;
          }
          else{

            //alert("nuc inexistente");
          }

          $.ajax({  
              type: "POST",  
              url: "../views/chemistry/records/service/create_record.php",  
              data:   "nuc="+nuc+
                      "&date="+date+
                      "&authority="+authority+
                      "&fiscalia="+fiscalia+
                      "&perito="+perito+
                      "&oficio="+oficio+
                      "&crime="+crime
          }).done(function(response){
            //document.getElementById("create_record_form").reset();
            document.getElementById("nuc").disabled = true;
            document.getElementById("date").disabled = true;
            document.getElementById("authority").disabled = true;
            document.getElementById("fiscalia").disabled = true;
            document.getElementById("perito").disabled = true;
            document.getElementById("oficio").disabled = true;
            document.getElementById("save-record-btn").disabled = true;
            document.getElementById("cancel-record-btn").disabled = true;
            document.getElementById("save-record-btn").style.display = "none";
            document.getElementById("cancel-record-btn").style.display = "none";
            document.getElementById("update-record-btn").style.display = "block";
            
            $("#study-container").load('../views/chemistry/records/create_study_form.php',
                                      {'record_id': response});
            //document.getElementById("create_study_form").style.display = "block";
            //document.getElementById("add-study-btn").disabled = false;

            window.scrollTo(0,document.body.scrollHeight);
            blurt({'title' : 'Correcto', 'text' : 'Expediente agregado correctamente, a continuación ingrese los estudios', 'type' : 'success'});
          });
          
          
        });

        
        
        return false;
    }

    jQuery('#create_study_form').submit(create_study);
    function create_study(){
      $('.loader-div').addClass('loader');
      
        description = $("#description").val();  
        //person = $("#person").val();
        person = "n/a"; 
        document_type=$("#document-type").val();
        emited_document=$("#emited-document").val();
        indication=$("#indication").val();
        nuc = $("#nuc").val();
        result = $("#result").val(); 
        sample = $("#sample").val(); 
        //description = $("#description-detail").val(); 
        study = $("#study").val();
        detail = $("#detail").val();

        sp = $("#sp").val(); 
        
        if(detail == undefined){
          detail = 'n/a';
        }
        if(sample == undefined){
          sample = 'n/a';
        }

        if(document_type == "Informe"){
          result = "n/a";
          detail = "n/a";
        }

        detail_collection = [];

        if(document.getElementById("drug-51") != undefined){
          if($("#drug-51 input").is(':checked')){
            detail_collection.push("51");
          }
          if($("#drug-52 input").is(':checked')){
            detail_collection.push("52");
          }
          if($("#drug-53 input").is(':checked')){
            detail_collection.push("53");
          }
          if($("#drug-54 input").is(':checked')){
            detail_collection.push("54");
          }
          if($("#drug-55 input").is(':checked')){
            detail_collection.push("55");
          }
          if($("#drug-56 input").is(':checked')){
            detail_collection.push("56");
          }
          if($("#drug-57 input").is(':checked')){
            detail_collection.push("57");
          }
          if($("#drug-58 input").is(':checked')){
            detail_collection.push("58");
          }
          if($("#drug-59 input").is(':checked')){
            detail_collection.push("59");
          }
          if($("#drug-60 input").is(':checked')){
            detail_collection.push("60");
          }
          if($("#drug-61 input").is(':checked')){
            detail_collection.push("61");
          } 
        }

        if(document.getElementById("toxic-substance-34") != undefined){
          if($("#toxic-substance-34 input").is(':checked')){
            detail_collection.push("34");
          }
          if($("#toxic-substance-35 input").is(':checked')){
            detail_collection.push("35");
          }
          if($("#toxic-substance-36 input").is(':checked')){
            detail_collection.push("36");
          }
          if($("#toxic-substance-37 input").is(':checked')){
            detail_collection.push("37");
          }
        }

        if(document.getElementById("waste-30") != undefined){
          if($("#waste-30 input").is(':checked')){
            detail_collection.push("30");
          }
          if($("#waste-31 input").is(':checked')){
            detail_collection.push("31");
          }
        }

        if(document.getElementById("determination-drug-42") != undefined){
          if($("#determination-drug-42 input").is(':checked')){
            detail_collection.push("42");
          }
          if($("#determination-drug-43 input").is(':checked')){
            detail_collection.push("43");
          }
          if($("#determination-drug-44 input").is(':checked')){
            detail_collection.push("44");
          }
          if($("#determination-drug-45 input").is(':checked')){
            detail_collection.push("45");
          }
          if($("#determination-drug-46 input").is(':checked')){
            detail_collection.push("46");
          }
          if($("#determination-drug-47 input").is(':checked')){
            detail_collection.push("47");
          }
          if($("#determination-drug-48 input").is(':checked')){
            detail_collection.push("48");
          }
          if($("#determination-drug-49 input").is(':checked')){
            detail_collection.push("49");
          }
        }

        if(document.getElementById("acelerant-13") != undefined){
          if($("#acelerant-13 input").is(':checked')){
            detail_collection.push("13");
          }
          if($("#acelerant-14 input").is(':checked')){
            detail_collection.push("14");
          }
          if($("#acelerant-15 input").is(':checked')){
            detail_collection.push("15");
          }
          if($("#acelerant-16 input").is(':checked')){
            detail_collection.push("16");
          }
          if($("#acelerant-17 input").is(':checked')){
            detail_collection.push("17");
          }
        }

        if(document.getElementById("seminal-component-18") != undefined){
          if($("#seminal-component-18 input").is(':checked')){
            detail_collection.push("18");
          }
          if($("#seminal-component-19 input").is(':checked')){
            detail_collection.push("19");
          }
          if($("#seminal-component-20 input").is(':checked')){
            detail_collection.push("20");
          }
        }

        if(document.getElementById("botanic-28") != undefined){
          if($("#botanic-28 input").is(':checked')){
            detail_collection.push("28");
          }
          if($("#botanic-29 input").is(':checked')){
            detail_collection.push("29");
          }
        }

        if(document_type == "Informe"){
          detail_collection = [];
        }

        $.ajax({  
            type: "POST",  
            url: "../views/chemistry/records/service/create_study.php",  
            data:   "record_id="+record_id+
                    "&description="+description+
                    "&person="+person+
                    "&document_type="+document_type+
                    "&emited_document="+emited_document+
                    "&indication="+indication+
                    "&nuc="+nuc+
                    "&document_type="+document_type+
                    "&emited_document="+emited_document+
                    "&indication="+indication+
                    "&result="+result+
                    "&sample="+sample+
                    "&detail="+detail+
                    "&study="+study+
                    "&sp="+sp+
                    "&detail_collection="+JSON.stringify(detail_collection)
        }).done(function(response){
          //document.getElementById("create_record_form").reset();
          //console.log('ExpedienteID', response);

          $.ajax({  
              type: "POST",  
              url: "../views/chemistry/records/service/get_studies.php", 
              data: "record_id="+response,
              success: function(html){
                $("#detail-table").html(html);
                document.getElementById("create_study_form").reset();
                document.getElementById("result-catalog-detail-row").style.display = "";
                document.getElementById("study").selectedIndex = -1;
                $("#catalog-description").html('');
                $("#catalog-detail").html('');
                window.scrollTo(0,document.body.scrollHeight);
                blurt({'title' : 'Correcto', 'text' : 'Estudio agregado correctamente', 'type' : 'success'});
              }  
          });

		    });  
        return false;
    }


    

    jQuery('#search_records_form').submit(search_records);
    function search_records(){

      $('.loader-div').addClass('loader');
      
        fiscalia = $("#fiscalia").val(); 
        start_date = $("#start_date").val();  
        finish_date = $("#finish_date").val();

        $.ajax({  
          type: "POST",  
          url: "../views/genetic/records/service/update_records_crime.php",
          }).done(function(response){

            $.ajax({  
                type: "POST",  
                url: "../views/chemistry/records/service/search_records.php", 
                data: "fiscalia="+fiscalia+
                      "&start_date="+start_date+
                      "&finish_date="+finish_date,
                success: function(html){
    
                  $("#record-table").html(html);
    
                  
    
                }  
            });

          });
        
        return false;
    }
    



    jQuery('#filter_records_by_nuc_form').submit(search_records_by_nuc);
    function search_records_by_nuc(){
        fiscalia = $("#fiscalia").val(); 
        start_date = $("#start_date").val();  
        finish_date = $("#finish_date").val();

        $.ajax({  
            type: "POST",  
            url: "../views/chemistry/records/service/search_records.php", 
            data: "fiscalia="+fiscalia+
                  "&start_date="+start_date+
                  "&finish_date="+finish_date,
            success: function(html){

              //var content = JSON.parse(response);

              $("#record-table").html(html);

              //$('#filter_records_by_nuc_form').style.display = "block";

            }  
        });
        
        return false;
    }

    

    $("#cancel-record-btn").click(function(){
      document.getElementById("nuc").value = "";
      document.getElementById("date").valueAsDate = new Date();
      document.getElementById("authority").selectedIndex = -1;
      document.getElementById("oficio").value = "";
      document.getElementById("indication").value = "";
    });

    $("#cancel-study-btn").click(function(){ 
      document.getElementById("create_study_form").reset();
    });
    
    $("#search_records-btn").click(function(){ 
      //$('.loader-div').addClass('loader');
    });

    $("#save-record-btn").click(function(){ 
      //$('.loader-div').addClass('loader');
    });

    

  });








  function deleteStudy(study_id, record_id) {
    $.ajax({  
        type: "POST",  
        url: "../views/chemistry/records/service/delete_study.php", 
        data: "study_id="+study_id,
        success: function(response){
          $.ajax({  
              type: "POST",  
              url: "../views/chemistry/records/service/get_studies.php", 
              data: "record_id="+record_id,
              success: function(html){
                $("#detail-table").html(html);
              }  
          });
        }  
    });  
  }


  function filter () {
  var searchTerm = $(".search").val();
  var listItem = $('.results tbody').children('tr');
  var searchSplit = searchTerm.replace(/ /g, "'):containsi('");
  
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
  else {$('.no-result').hide();}
}

function getCatalogsByStudy() {
  cat_study_id = $("#study").val();
  
  getCatalogDescriptions(cat_study_id);

  getCatalogDetails(cat_study_id);
}

function getCatalogDescriptions(cat_study_id) {


  $.ajax({  
        type: "POST",  
        url: "../views/chemistry/records/service/get_catalog_samples_by_study.php", 
        data: "cat_study_id="+cat_study_id,
        success: function(html){
          $("#catalog-description").html(html);
        }  
  });
}

function getCatalogDetails(cat_study_id) {


  $.ajax({  
        type: "POST",  
        url: "../views/chemistry/records/service/get_catalog_details_by_study.php", 
        data: "cat_study_id="+cat_study_id,
        success: function(html){
          $("#catalog-detail").html(html);
        }  
  });
}

function download() {
  var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById("records-table");
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    tableHTML = tableHTML.replace(/ /g, "'):containsi('");
    
    // Specify file name
    filename = 'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}


function tableToExcel ()  {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta cha' + 'rset="UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  
    

    table = document.getElementById('records-table');
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx));
    
}


function des() {
  let sheet = 'Forense';
  let filename = ''+(new Date())+'.xls';

  var uri = 'data:application/vnd.ms-excel;base64,';


  table = document.getElementById('records-table');

  var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-mic' + 'rosoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta cha' + 'rset="UTF-8"><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:Exce' + 'lWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/>' + '</x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></' + 'xml><![endif]--></head><body>{table}</body></html>';

  var context = {
      worksheet: sheet || 'Worksheet',
      table: table
  };

  // If IE11

  console.log('msSave', window.navigator.msSaveOrOpenBlob);
  if (window.navigator.msSaveOrOpenBlob) {
      var fileData = ['' + ('<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-mic' + 'rosoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta cha' + 'rset="UTF-8"><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:Exce' + 'lWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/>' + '</x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></' + 'xml><![endif]--></head><body>') + table + '</body></html>'];
      var blobObject = new Blob(fileData);
      document.getElementById('react-html-table-to-excel').click()(function () {
      window.navigator.msSaveOrOpenBlob(blobObject, filename);
      });

      return true;
  }

  var element = window.document.createElement('a');
  element.href = uri;
  element.download = filename;
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);


  return true;
}





function multiselectCombobox(){
  var options = [];


   var $target = $( event.currentTarget ),
       val = $target.attr( 'data-value' ),
       $inp = $target.find( 'input' ),
       idx;

   if ( ( idx = options.indexOf( val ) ) > -1 ) {
      options.splice( idx, 1 );
      setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
   } else {
      options.push( val );
      setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
   }

   $( event.target ).blur();
      
   return false;
}

function changePeritosAuthorities(){

  fiscalia = $("#fiscalia").val(); 

  $.ajax({  
      type: "POST",  
      url: "../views/chemistry/records/service/get_peritos_by_fiscalia.php", 
      data: "fiscalia="+fiscalia,
      success: function(html){
        $("#perito-select").html(html);
      }  
  });

  $.ajax({  
      type: "POST",  
      url: "../views/chemistry/records/service/get_authorities_by_fiscalia.php", 
      data: "fiscalia="+fiscalia,
      success: function(html){
        $("#authority-select").html(html);
      }  
  });

  return false;
}


function validateNuc(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

function updateRecordBtn(){
  document.getElementById("nuc").disabled = false;
  document.getElementById("date").disabled = false;
  document.getElementById("authority").disabled = false;
  document.getElementById("fiscalia").disabled = false;
  document.getElementById("perito").disabled = false;
  document.getElementById("oficio").disabled = false;
  document.getElementById("save-record-btn").disabled = false;
  document.getElementById("cancel-record-btn").disabled = false;
  document.getElementById("update-record-btn").style.display = "none";
  document.getElementById("save-update-record-btn").style.display = "block";
  document.getElementById("cancel-update-record-btn").style.display = "block";
}

function cancelUpdateRecordBtn(){
  document.getElementById("nuc").disabled = true;
  document.getElementById("date").disabled = true;
  document.getElementById("authority").disabled = true;
  document.getElementById("fiscalia").disabled = true;
  document.getElementById("perito").disabled = true;
  document.getElementById("oficio").disabled = true;
  document.getElementById("save-record-btn").disabled = true;
  document.getElementById("cancel-record-btn").disabled = true;
  document.getElementById("update-record-btn").style.display = "block";
  document.getElementById("save-update-record-btn").style.display = "none";
  document.getElementById("cancel-update-record-btn").style.display = "none";
}

function saveUpdateRecordBtn(){ 

  nuc=$("#nuc").val();  
  date=$("#date").val(); 
  authority=$("#authority").val();
  fiscalia=$("#fiscalia").val();
  perito=$("#perito").val();  
  oficio=$("#oficio").val();
  crime=0;

  $.ajax({  
      type: "POST",  
      url: "../views/chemistry/records/service/validate_nuc.php",  
      data:   "nuc="+nuc
  }).done(function(response){

    if(response != 0){
      crime = response;
    }
    else{

      //alert("nuc inexistente");
    }

    $.ajax({  
        type: "POST",  
        url: "../views/chemistry/records/service/update_record.php",  
        data:   "nuc="+nuc+
                "&date="+date+
                "&authority="+authority+
                "&fiscalia="+fiscalia+
                "&perito="+perito+
                "&oficio="+oficio+
                "&crime="+crime+
                "&record_id="+record_id
    }).done(function(response){
      //document.getElementById("create_record_form").reset();
      document.getElementById("nuc").disabled = true;
      document.getElementById("date").disabled = true;
      document.getElementById("authority").disabled = true;
      document.getElementById("fiscalia").disabled = true;
      document.getElementById("perito").disabled = true;
      document.getElementById("oficio").disabled = true;
      document.getElementById("save-record-btn").disabled = true;
      document.getElementById("cancel-record-btn").disabled = true;
      document.getElementById("update-record-btn").style.display = "block";
      document.getElementById("save-update-record-btn").style.display = "none";
      document.getElementById("cancel-update-record-btn").style.display = "none";
      

      window.scrollTo(0,document.body.scrollHeight);
      blurt({'title' : 'Correcto', 'text' : 'Expediente modificado correctamente, a continuación ingrese los estudios', 'type' : 'success'});
    });
    
    
  });
}

function updateRecordById(record_id){


  $.ajax({  
    type: "POST",  
    url: "../views/chemistry/records/service/get_records_by_id.php", 
    data: "record_id="+record_id,
    success: function(response){

    var content_records = JSON.parse(response);
    
    $("#record-container").load('../views/chemistry/records/update_record_form.php',
            {'record_id': record_id, 'nuc': content_records.nuc, 'date': content_records.date, 'authority': content_records.authority, 'perito': content_records.perito, 'oficio': content_records.oficio, 'fiscalia': content_records.fiscalia});

    }  
    
  });

  $("#study-container").load('../views/chemistry/records/update_study_form.php',
                                      {'record_id': record_id});

  $.ajax({  
      type: "POST",  
      url: "../views/chemistry/records/service/get_studies.php", 
      data: "record_id="+record_id,
      success: function(html){
        $("#detail-table").html(html);
      }  
  });

  $(window).scrollTop(0);
}

function updateRecord(){ 

	nuc=$("#nuc").val();  
	date=$("#date").val(); 
	authority=$("#authority").val();
	fiscalia=$("#fiscalia").val();
	perito=$("#perito").val();  
	oficio=$("#oficio").val();
	crime=0;

	if(nuc.length == 13){
	
		$.ajax({  
			type: "POST",  
			url: "../views/chemistry/records/service/validate_nuc.php",  
			data:   "nuc="+nuc
		}).done(function(response){

		if(response != 0){
			crime = response;
		}
		else{

			//alert("nuc inexistente");
		}

		$.ajax({  
			type: "POST",  
			url: "../views/chemistry/records/service/update_record.php",  
			data:   "nuc="+nuc+
					"&date="+date+
					"&authority="+authority+
					"&fiscalia="+fiscalia+
					"&perito="+perito+
					"&oficio="+oficio+
					"&crime="+crime+
					"&record_id="+record_id
		}).done(function(response){
			
			$("#nuc-label").html(nuc);

			blurt({'title' : 'Correcto', 'text' : 'Expediente modificado correctamente', 'type' : 'success'});
		});
		
		
		});

	}
	else{
		blurt({'title' : 'Formato invalido', 'text' : 'Ingrese un formato de nuc válido', 'type' : 'warning'});
	}
}

function deleteRecordById(record_id){
  $.ajax({  
    type: "POST",  
    url: "../views/chemistry/records/service/delete_record.php", 
    data: "record_id="+record_id,
    success: function(response){
        /*$.ajax({  
            type: "POST",  
            url: "../views/chemistry/records/service/get_studies.php", 
            data: "record_id="+record_id,
            success: function(html){
              $("#detail-table").html(html);
            }  
        });*/

        console.log("elimino");
      }  
  });  
}


function update_study(){
  $('.loader-div').addClass('loader');
  
    description = $("#description").val();   
    //person = $("#person").val();
    person = "n/a";
    document_type=$("#document-type").val();
    emited_document=$("#emited-document").val();
    indication=$("#indication").val();
    nuc = $("#nuc").val();
    result = $("#result").val(); 
    sample = $("#sample").val(); 
    //description = $("#description-detail").val(); 
    study = $("#study").val();
    detail = $("#detail").val();

    sp = $("#sp").val(); 

    if(detail == undefined){
      detail = 'n/a';
    }
    if(description == undefined){
      description = 'n/a';
    }

    if(document_type == "Informe"){
      result = "n/a";
      detail = "n/a";
    }
    detail_collection = [];

    if(document.getElementById("drug-51") != undefined){
      if($("#drug-51 input").is(':checked')){
        detail_collection.push("51");
      }
      if($("#drug-52 input").is(':checked')){
        detail_collection.push("52");
      }
      if($("#drug-53 input").is(':checked')){
        detail_collection.push("53");
      }
      if($("#drug-54 input").is(':checked')){
        detail_collection.push("54");
      }
      if($("#drug-55 input").is(':checked')){
        detail_collection.push("55");
      }
      if($("#drug-56 input").is(':checked')){
        detail_collection.push("56");
      }
      if($("#drug-57 input").is(':checked')){
        detail_collection.push("57");
      }
      if($("#drug-58 input").is(':checked')){
        detail_collection.push("58");
      }
      if($("#drug-59 input").is(':checked')){
        detail_collection.push("59");
      }
      if($("#drug-60 input").is(':checked')){
        detail_collection.push("60");
      }
      if($("#drug-61 input").is(':checked')){
        detail_collection.push("61");
      } 
    }

    if(document.getElementById("toxic-substance-34") != undefined){
      if($("#toxic-substance-34 input").is(':checked')){
        detail_collection.push("34");
      }
      if($("#toxic-substance-35 input").is(':checked')){
        detail_collection.push("35");
      }
      if($("#toxic-substance-36 input").is(':checked')){
        detail_collection.push("36");
      }
      if($("#toxic-substance-37 input").is(':checked')){
        detail_collection.push("37");
      }
    }

    if(document.getElementById("waste-30") != undefined){
      if($("#waste-30 input").is(':checked')){
        detail_collection.push("30");
      }
      if($("#waste-31 input").is(':checked')){
        detail_collection.push("31");
      }
    }

    if(document.getElementById("determination-drug-42") != undefined){
      if($("#determination-drug-42 input").is(':checked')){
        detail_collection.push("42");
      }
      if($("#determination-drug-43 input").is(':checked')){
        detail_collection.push("43");
      }
      if($("#determination-drug-44 input").is(':checked')){
        detail_collection.push("44");
      }
      if($("#determination-drug-45 input").is(':checked')){
        detail_collection.push("45");
      }
      if($("#determination-drug-46 input").is(':checked')){
        detail_collection.push("46");
      }
      if($("#determination-drug-47 input").is(':checked')){
        detail_collection.push("47");
      }
      if($("#determination-drug-48 input").is(':checked')){
        detail_collection.push("48");
      }
      if($("#determination-drug-49 input").is(':checked')){
        detail_collection.push("49");
      }
    }

    if(document.getElementById("acelerant-13") != undefined){
      if($("#acelerant-13 input").is(':checked')){
        detail_collection.push("13");
      }
      if($("#acelerant-14 input").is(':checked')){
        detail_collection.push("14");
      }
      if($("#acelerant-15 input").is(':checked')){
        detail_collection.push("15");
      }
      if($("#acelerant-16 input").is(':checked')){
        detail_collection.push("16");
      }
      if($("#acelerant-17 input").is(':checked')){
        detail_collection.push("17");
      }
    }

    if(document.getElementById("seminal-component-18") != undefined){
      if($("#seminal-component-18 input").is(':checked')){
        detail_collection.push("18");
      }
      if($("#seminal-component-19 input").is(':checked')){
        detail_collection.push("19");
      }
      if($("#seminal-component-20 input").is(':checked')){
        detail_collection.push("20");
      }
    }

    if(document.getElementById("botanic-28") != undefined){
      if($("#botanic-28 input").is(':checked')){
        detail_collection.push("28");
      }
      if($("#botanic-29 input").is(':checked')){
        detail_collection.push("29");
      }
    }

    if(document_type == "Informe"){
      detail_collection = [];
    }
    

    /*if(document.getElementById("human-blood-32") != undefined){
      if($("#human-blood-32 input").is(':checked')){
        detail_collection.push("32");
      }
      if($("#human-blood-33 input").is(':checked')){
        detail_collection.push("33");
      }
    }*/

    $.ajax({  
        type: "POST",  
        url: "../views/chemistry/records/service/create_study.php",  
        data:   "record_id="+record_id+
                "&description="+description+
                "&person="+person+
                "&document_type="+document_type+
                "&emited_document="+emited_document+
                "&indication="+indication+
                "&nuc="+nuc+
                "&document_type="+document_type+
                "&emited_document="+emited_document+
                "&indication="+indication+
                "&result="+result+
                "&sample="+sample+
                "&detail="+detail+
                "&study="+study+
                "&sp="+sp+
                "&detail_collection="+JSON.stringify(detail_collection)
    }).done(function(response){
      //document.getElementById("create_record_form").reset();
      //console.log('ExpedienteID', response);

		$.ajax({  
			type: "POST",  
			url: "../views/chemistry/records/service/get_studies.php", 
			data: "record_id="+response,
			success: function(html){
				$("#detail-table").html(html);
				blurt({'title' : 'Correcto', 'text' : 'Estudio agregado correctamente', 'type' : 'success'});
			}  
		});

    });  
    return false;
}

function showInputsByReport(){
  var document_type = $("#document-type").val();

  if(document_type == "Informe"){
    document.getElementById("result-catalog-detail-row").style.display = "none";
  }
  else{
    document.getElementById("result-catalog-detail-row").style.display = "";
  }
}