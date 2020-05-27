//var samples = [], variants = {'S6': [], 'S21': []}, variants_section = { 'has_vatiant_selected_samples': [] , 'html' : ''};

//var samples = {'selected_samples': [], 'has_variants': [], 'selected_has_variants': []}, variants = [], variants_section = { 'html' : ''};

var samples = {'selected': [], 'has_variant': ['S6', 'S21'], 'selected_has_variant': []}, variants = {'S6': [], 'S21': []}; variants_section = {'html': ''}

$(document).ready(function() {


  $('.loader-div').removeClass('loader');
  
    jQuery('#create_record_form').submit(create_record);

    
    function create_record(){


      $('.loader-div').addClass('loader');
      nuc=$("#nuc").val();  
      date=$("#date").val(); 
      expirated_date=$("#expirated-date").val(); 
      authority=$("#authority").val();
      fiscalia=$("#fiscalia").val();
      perito=$("#perito").val();  
      oficio=$("#oficio").val(); 
      crime=0;

            $.ajax({  
              type: "POST",  
              url: "../views/genetic/records/service/validate_nuc.php",  
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
              url: "../views/genetic/records/service/create_record.php",  
              data:   "nuc="+nuc+
                      "&date="+date+
                      "&expirated_date="+expirated_date+
                      "&authority="+authority+
                      "&fiscalia="+fiscalia+
                      "&perito="+perito+
                      "&oficio="+oficio+
                      "&crime="+crime
          }).done(function(response){
            //document.getElementById("create_record_form").reset();
            document.getElementById("nuc").disabled = true;
            document.getElementById("date").disabled = true;
            document.getElementById("expirated-date").disabled = true;
            document.getElementById("authority").disabled = true;
            document.getElementById("fiscalia").disabled = true;
            document.getElementById("perito").disabled = true;
            document.getElementById("oficio").disabled = true;
            document.getElementById("save-record-btn").disabled = true;
            document.getElementById("cancel-record-btn").disabled = true;
            document.getElementById("save-record-btn").style.display = "none";
            document.getElementById("cancel-record-btn").style.display = "none";
            document.getElementById("update-record-btn").style.display = "block";
            record_id = response;
            
            $("#study-container").load('../views/genetic/records/templates/forms/create_study_form.php',
                                      {'record_id': response});

            $("#document-container").load('../views/genetic/records/templates/forms/create_document_form.php',
                                      {'record_id': response});
            //document.getElementById("create_study_form").style.display = "block";
            //document.getElementById("add-study-btn").disabled = false;
    
            //document.getElementById("create_study_form").style.display = "block";
            //document.getElementById("add-study-btn").disabled = false;
    
            showLoading(false);

			window.scrollTo(0,document.body.scrollHeight);
			blurt({'title' : 'Correcto', 'text' : 'Expediente agregado correctamente, a continuación ingrese los estudios', 'type' : 'success'});
    
    
            //var inputs = document.getElementsByClassName("record-input");
    
    
            //inputs.addEventListener("change", showAlert(true));
    
    
        });
            
            
      });

        
        
      return false;
    }

    jQuery('#create_study_form').submit(create_study);
    function create_study(){
      $('.loader-div').addClass('loader');
        description = $("#description").val(); 
        person = $("#person").val(); 
        nuc = $("#nuc").val();
        study = $("#study").val();
        sample = $("#sample").val();
        /*variant = $("#variant").val();
        if(variant == undefined){
          variant = "n/a";
        }*/
        alert("123");

        console.log(variants);

        $.ajax({  
            type: "POST",  
            url: "../views/genetic/records/service/create_study.php",  
            data:   "record_id="+record_id+
                    "&description="+description+
                    "&person="+person+
                    "&nuc="+nuc+
                    "&study="+study+
                    "&sample="+sample+
                    "&variants="+JSON.stringify(variants)
        }).done(function(response){
          //document.getElementById("create_record_form").reset();
          //console.log('ExpedienteID', response);

          $.ajax({  
              type: "POST",  
              url: "../views/genetic/records/service/get_studies.php", 
              data: "record_id="+response,
              success: function(html){
                $("#detail-table").html(html);
                document.getElementById("create_study_form").reset();
                document.getElementById("study").selectedIndex = -1;
                $("#catalog-detail").html('');
				blurt({'title' : 'Correcto', 'text' : 'Estudio agregado correctamente', 'type' : 'success'});
                resetVariantInput();
                showLoading(false);
              }  
          });

        });  
        
        
        return false;
    }

    

    jQuery('#create_document_form').submit(create_document);

    
    function create_document(){

      $('.loader-div').addClass('loader');

      document_type=$("#document-type").val();
      emited_document=$("#emited-document").val();
      indication=$("#indication").val();
      area = $("#area").val();
      result = $("#result").val(); 
      observation = $("#observation").val(); 
    
      $.ajax({  
          type: "POST",  
          url: "../views/genetic/records/service/create_document.php",  
          data:   "record_id="+record_id+
                  "&document_type="+document_type+
                  "&emited_document="+emited_document+
                  "&indication="+indication+
                  "&area="+area+
                  "&result="+result+
                  "&observation="+observation
      }).done(function(response){
        document.getElementById("document-type").disabled = true;
        document.getElementById("emited-document").disabled = true;
        document.getElementById("indication").disabled = true;
        document.getElementById("area").disabled = true;
        document.getElementById("result").disabled = true;
        document.getElementById("observation").disabled = true;
        document.getElementById("sp").disabled = true;

        document.getElementById("save-document-btn").style.display = "none";
        document.getElementById("cancel-document-btn").style.display = "none";
        document.getElementById("update-document-btn").style.display = "block";
        
        showLoading(false);

		blurt({'title' : 'Correcto', 'text' : 'Documento agregado correctamente', 'type' : 'success'});
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
                url: "../views/genetic/records/service/search_records.php", 
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
            url: "../views/genetic/records/service/search_records.php", 
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
    

  });








  function deleteStudy(study_id, record_id) {
    $.ajax({  
        type: "POST",  
        url: "../views/genetic/records/service/delete_study.php", 
        data: "study_id="+study_id,
        success: function(response){
          $.ajax({  
              type: "POST",  
              url: "../views/genetic/records/service/get_studies.php", 
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
  console.log("search", searchTerm);
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

function getCatalogDetails() {
  cat_study_id = $("#study").val(); 


  $.ajax({  
        type: "POST",  
        url: "../views/genetic/records/service/get_catalog_details_by_study.php", 
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
      url: "../views/genetic/records/service/get_peritos_by_fiscalia.php", 
      data: "fiscalia="+fiscalia,
      success: function(html){
        $("#perito-select").html(html);
      }  
  });

  $.ajax({  
      type: "POST",  
      url: "../views/genetic/records/service/get_authorities_by_fiscalia.php", 
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
  document.getElementById("expirated-date").disabled = false;
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
  document.getElementById("expirated-date").disabled = true;
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
  
    showLoading(true);

    nuc=$("#nuc").val();  
    date=$("#date").val(); 
    expirated_date=$("#expirated-date").val(); 
    authority=$("#authority").val();
    fiscalia=$("#fiscalia").val();
    perito=$("#perito").val();  
    oficio=$("#oficio").val();
    crime=0;

    $.ajax({  
        type: "POST",  
        url: "../views/genetic/records/service/validate_nuc.php",  
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
          url: "../views/genetic/records/service/update_record.php",  
          data:   "nuc="+nuc+
                  "&date="+date+
                  "&expirated_date="+expirated_date+
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
        document.getElementById("expirated-date").disabled = true;
        document.getElementById("authority").disabled = true;
        document.getElementById("fiscalia").disabled = true;
        document.getElementById("perito").disabled = true;
        document.getElementById("oficio").disabled = true;
        document.getElementById("save-record-btn").disabled = true;
        document.getElementById("cancel-record-btn").disabled = true;
        document.getElementById("update-record-btn").style.display = "block";
        document.getElementById("save-update-record-btn").style.display = "none";
        document.getElementById("cancel-update-record-btn").style.display = "none";
        showAlert(false);
        showLoading(false);
        

        window.scrollTo(0,document.body.scrollHeight);
		blurt({'title' : 'Correcto', 'text' : 'Expediente modificado correctamente, a continuación ingrese los estudios', 'type' : 'success'});
      });
      
      
    });
}


function blockDocumentForm(ind){
	if(document.getElementById("save-document-btn") != null || document.getElementById("save-document-btn") != undefined){
		document.getElementById("save-document-btn").disabled = true;
		document.getElementById("save-document-btn").style.display = "none";
	}
	if(ind){
		document.getElementById("document-type").disabled = true;
		document.getElementById("emited-document").disabled = true;
		document.getElementById("indication").disabled = true;
		document.getElementById("area").disabled = true;
		document.getElementById("result").disabled = true;
    document.getElementById("observation").disabled = true;
    document.getElementById("sp").disabled = true;

		//document.getElementById("cancel-document-btn").disabled = true;
		if(document.getElementById("update-document-btn") != null || document.getElementById("save-update-document-btn") != null){
			document.getElementById("update-document-btn").style.display = "block";
			document.getElementById("save-update-document-btn").style.display = "none";
			document.getElementById("cancel-update-document-btn").style.display = "none";
		}
		
	}
	else{
		document.getElementById("document-type").disabled = false;
		document.getElementById("emited-document").disabled = false;
		document.getElementById("indication").disabled = false;
		document.getElementById("area").disabled = false;
		document.getElementById("result").disabled = false;
    document.getElementById("observation").disabled = false;
    document.getElementById("sp").disabled = false;

		
		//document.getElementById("cancel-document-btn").disabled = false;
		if(document.getElementById("update-document-btn") != null || document.getElementById("save-update-document-btn") != null){
			document.getElementById("update-document-btn").style.display = "none";
			document.getElementById("save-update-document-btn").style.display = "block";
			document.getElementById("cancel-update-document-btn").style.display = "block";
		}
		
	}
  
}




function showAlert(ind){
  if(!ind){
    document.getElementById("update-alert").style.display = "none";
  }
  else{
    document.getElementById("update-alert").style.display = "block";
  }
}




function updateRecordById(record_id){


  $.ajax({  
    type: "POST",  
    url: "../views/genetic/records/service/get_records_by_id.php", 
    data: "record_id="+record_id,
    success: function(response){

    var content_records = JSON.parse(response);
    
    $("#record-container").load('../views/genetic/records/templates/forms/update_record_form.php',
            {'record_id': record_id, 'nuc': content_records.nuc, 'date': content_records.date, 'expirated_date': content_records.expirated_date, 'authority': content_records.authority, 'perito': content_records.perito, 'oficio': content_records.oficio, 'fiscalia': content_records.fiscalia});


    }  
    
    
  });

  $.ajax({  
    type: "POST",  
    url: "../views/genetic/records/service/get_document_by_record.php", 
    data: "record_id="+record_id,
    success: function(response){

    var content_documents = JSON.parse(response);

    console.log(content_documents);
    
    $("#document-container").load('../views/genetic/records/templates/forms/update_document_form.php',
            {'record_id': record_id, 'document_type': content_documents.document_type, 'emited_document': content_documents.emited_document, 'indication': content_documents.indication, 'area': content_documents.area, 'result': content_documents.result, 'observation': content_documents.observation, 'sp': content_documents.sp});

			setExistantDocumentAlert(content_documents.exists);
			showInputsByReport();

    }
      
    
    
  });


  $("#study-container").load('../views/genetic/records/templates/forms/update_study_form.php',
                                      {'record_id': record_id});

  $.ajax({  
      type: "POST",  
      url: "../views/genetic/records/service/get_studies.php", 
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
  expirated_date=$("#expirated-date").val(); 
  authority=$("#authority").val();
  fiscalia=$("#fiscalia").val();
  perito=$("#perito").val();  
  oficio=$("#oficio").val();
  crime=0;

  if(nuc.length == 13){

    $.ajax({  
        type: "POST",  
        url: "../views/genetic/records/service/validate_nuc.php",  
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
          url: "../views/genetic/records/service/update_record.php",  
          data:   "nuc="+nuc+
                  "&date="+date+
                  "&expirated_date="+expirated_date+
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

function createDocument(record_id){ 

  showLoading(true);

  document_type=$("#document-type").val();
  emited_document=$("#emited-document").val();
  indication=$("#indication").val();
  area = $("#area").val();
  result = $("#result").val(); 
  observation = $("#observation").val(); 
  sp = $("#sp").val(); 

  if(document_type == "Informe"){
    result = "n/a";
  }

  $.ajax({  
      type: "POST",  
      url: "../views/genetic/records/service/create_document.php",  
      data:   "record_id="+record_id+
              "&document_type="+document_type+
              "&emited_document="+emited_document+
              "&indication="+indication+
              "&area="+area+
              "&result="+result+
              "&observation="+observation+
              "&sp="+sp
  }).done(function(response){

    blockDocumentForm(true);

    showLoading(false);
    
	blurt({'title' : 'Correcto', 'text' : 'Documento guardado correctamente', 'type' : 'success'});
  });

}

function updateDocument(record_id, location){ 

  showLoading(true);

  document_type=$("#document-type").val();
  emited_document=$("#emited-document").val();
  indication=$("#indication").val();
  area = $("#area").val();
  result = $("#result").val(); 
  observation = $("#observation").val(); 
  sp = $("#sp").val(); 

  if(document_type == "Informe"){
    result = "n/a";
  }

  $.ajax({  
      type: "POST",  
      url: "../views/genetic/records/service/update_document.php",  
      data:   "record_id="+record_id+
              "&document_type="+document_type+
              "&emited_document="+emited_document+
              "&indication="+indication+
              "&area="+area+
              "&result="+result+
              "&observation="+observation+
              "&sp="+sp
  }).done(function(response){

    setExistantDocumentAlert(response);

	if(location != 'update'){
		blockDocumentForm(true);
	}

    showLoading(false);
    
	blurt({'title' : 'Correcto', 'text' : 'Documento guardado correctamente', 'type' : 'success'});
  });

}

function setExistantDocumentAlert(ind){

  setTimeout(function(){ 
    if(!ind){
      $("#existant-document-alert").html('<div style="background-color: #FFE66A; width: 100%; text-align: center; font-size: 16pt; color: grey;"><strong>NO SE HA CAPTURADO DOCUMENTO</strong> </div>');
    }
    else{
      $("#existant-document-alert").html('');
    }
  }, 1000);
  
}

function deleteRecordById(record_id){
  $.ajax({  
    type: "POST",  
    url: "../views/genetic/records/service/delete_record.php", 
    data: "record_id="+record_id,
    success: function(response){
      console.log("elimino");
    }  
  });  
}

function update_study(){
        description = $("#description").val(); 
        person = $("#person").val(); 
        nuc = $("#nuc").val();
        study = $("#study").val();
        sample = $("#sample").val();

        console.log(variants);

        $.ajax({  
          type: "POST",  
          url: "../views/genetic/records/service/create_study.php",  
          data:   "record_id="+record_id+
                  "&description="+description+
                  "&person="+person+
                  "&nuc="+nuc+
                  "&study="+study+
                  "&sample="+sample+
                  "&variants="+JSON.stringify(variants)
        }).done(function(response){
          //document.getElementById("create_record_form").reset();
          //console.log('ExpedienteID', response);

          $.ajax({  
              type: "POST",  
              url: "../views/genetic/records/service/get_studies.php", 
              data: "record_id="+response,
              success: function(html){
                $("#detail-table").html(html);
                resetVariantInput();
				blurt({'title' : 'Correcto', 'text' : 'Estudio agregado correctamente', 'type' : 'success'});
              }  
          });

        });  

        return false;
}

function setVariantInput1(){

  console.log("holap");
}

function setVariantInput(){

	$("#variants-section").html('');

	let ind = false;
	samples['selected_has_variant'] = [];
	samples['selected'] = [];

	for(let i = 0; i < 26; i++){

		sample = "S"+(i+1);

		if(document.getElementById(sample) != undefined){

			if($("#"+sample+" input").is(':checked')){

				if(samples['has_variant'].includes(sample)){
					samples['selected_has_variant'].push(sample);
					ind = true;
				}

				samples['selected'].push({'sample_id' : sample, 'sample_name' : document.getElementById(sample).name});
				
			}
			
		}
	}

	showLoading(ind);

	getCatalogVariantsBySample();

	setTimeout(function(){
		$("#variants-section").html(variants_section['html']);
		showLoading(false);
		console.log("samples", samples['selected']);
	}, 3000);
	
}

/*function setSamplesArray(sample){
	if(!samples['selected'].includes(sample)){
		samples['selected'].push(sample);
	}
	else{
		let temp_samples = [];

		for(let i=0; i<samples['selected'].length; i++){
			if(samples['selected'][i] != sample){
				temp_samples.push(samples['selected'][i]);
			}
		}

		samples['selected'] = temp_samples;
	}
}*/


function resetVariantInput(){

	for(let i = 0; i<samples['has_variant'].length; i++){
		console.log(variants[samples['has_variant'][i]]);
		variants[samples['has_variant'][i]] = [];
	}

	samples['selected'] = [];

	samples['selected_has_variant'] = [];
	variants_section['html'] = '';

    $("#variants-section").html('');
    
    $("#show-variants-modal-content").html('No se han agregado variantes');
}

function getCatalogVariantsBySample(){

	variants_section['html'] = '';

	for(let i=0; i<samples['selected_has_variant'].length; i++){

		$.ajax({  
			type: 	"POST",  
			url: 	"../views/genetic/records/service/get_catalog_variants_by_samples.php", 
			data: 	"sample="+samples['selected_has_variant'][i]+
					"&name="+document.getElementById(samples['selected_has_variant'][i]).name+
					"&variants_number="+variants[samples['selected_has_variant'][i]].length,
			success: function(html){
				variants_section['html']+=html;
			}  
		});

	}
}


function addStudyVariant(sample, name){

	var variant = document.getElementById("variant-"+sample).value.trim();

	var variant_name = document.getElementById("variant-"+sample).options[document.getElementById("variant-"+sample).selectedIndex].text;

	var ind = false;

	if(variant != ""){

		if(variants[sample].length != 0){
			for(let i = 0; i<variants[sample].length; i++){

				if(variants[sample][i]['variant_id'] == variant ){
					ind = true;
				}
	
			}
		}
		

		if(!ind){
			variants[sample].push({'variant_id': variant, 'variant_name': variant_name});

			$("#variant-label-"+sample).html('Variante ('+name+'): <a style="color: #dc3545;">('+variants[sample].length+' agregados)</a>');

			console.log(variants);
			blurt({'title' : 'Correcto', 'text' : 'Variante agregada correctamente', 'type' : 'success'});

		}
		else{
			blurt({'title' : 'Variante existente', 'text' : 'Ya se ha agregado esta variante con anterioridad', 'type' : 'warning'});
		}

	}
	
  
}

function showStudyVariant(sample, name){

	if(sample != ""){
	
		$.ajax({  
			type: 	"POST",  
			url: 	"../views/genetic/records/templates/tables/variant_table.php", 
			data: 	"variants="+JSON.stringify(variants[sample])+
					"&name="+name+
					"&sample="+sample,
			success: function(html){

				$("#show-variants-modal-content").html(html);
			
			}  
		});

	}
  
}


function removeVariantById(sample, name, variant){

	let temp_variants = [];

	for(let i = 0; i<variants[sample].length; i++){
		if(variants[sample][i]['variant_id'] != variant ){
			temp_variants.push(variants[sample][i]);
		}
	}

	variants[sample] = temp_variants;

	$.ajax({  
		type: 	"POST",  
		url: 	"../views/genetic/records/templates/tables/variant_table.php", 
		data: 	"variants="+JSON.stringify(variants[sample])+
				"&name="+name+
				"&sample="+sample,
		success: function(html){

			$("#show-variants-modal-content").html(html);
			$("#variant-label-"+sample).html('Variante ('+name+'): <a style="color: #dc3545;">('+variants[sample].length+' agregados)</a>');
		
		}  
	});

}


function showInputsByReport(){
  var document_type = $("#document-type").val();

  if(document_type == "Informe"){
		if(document.getElementById("result") != null){
      document.getElementById("result").selectedIndex = 0;
			document.getElementById("result-label").style.display = "none";
			document.getElementById("result").style.display = "none";
		}
    
	$("#area-form-group").removeClass("col-md-6");
	$("#area-form-group").addClass("col-md-12");
  }
  else{
	if(document.getElementById("result") != null){
		document.getElementById("result-label").style.display = "";
		document.getElementById("result").style.display = "";
	}
	$("#area-form-group").removeClass("col-md-12");
	$("#area-form-group").addClass("col-md-6");
  }
}

function showLoading(ind){
  if(ind){
    $(".loader-div").addClass("loader");
  }
  else{
    $(".loader-div").removeClass("loader");
  }
}


function createStudy(record_id, location){
	showLoading(true);
	description = $("#description").val(); 
	person = $("#person").val(); 
	nuc = $("#nuc").val();
	study = $("#study").val();
	//sample = $("#sample").val();
	/*variant = $("#variant").val();
	if(variant == undefined){
		variant = "n/a";
	}*/

	console.log('samples', samples['selected']);

	console.log('variants', variants);

	let selected_has_variant = [];
	for(let i = 0; i<samples['selected_has_variant'].length; i++){
		for(let j = 0; j<variants[samples['selected_has_variant'][i]].length; j++){
			selected_has_variant.push({'variant_id' : variants[samples['selected_has_variant'][i]][j]['variant_id'], 'variant_name' : variants[samples['selected_has_variant'][i]][j]['variant_name']});
		}
	}

	
	console.log('holap', JSON.stringify(selected_has_variant));

	console.log('holap samples', JSON.stringify(samples['selected']));

	$.ajax({  
		type: "POST",  
		url: "../views/genetic/records/service/create_study.php",  
		data:   "record_id="+record_id+
				"&description="+description+
				"&person="+person+
				"&nuc="+nuc+
				"&study="+study+
				"&samples="+JSON.stringify(samples['selected'])+
				"&variants="+JSON.stringify(selected_has_variant)
	}).done(function(response){

		$.ajax({  
			type: "POST",  
			url: "../views/genetic/records/service/get_studies.php", 
			data: "record_id="+record_id,
			success: function(html){
				$("#detail-table").html(html);

				if(location != 'update'){
					document.getElementById("create_study_form").reset();
				}
				else{
					document.getElementById("update_study_form").reset();
				}

				resetVariantInput();
				showLoading(false);
				blurt({'title' : 'Correcto', 'text' : 'Estudio agregado correctamente', 'type' : 'success'});
				//alert("Estudio agregado correctamente");
			}  
		});

	});  
}

