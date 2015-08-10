    $(document).ready(function(){
	
	var itemType =$('ul.yeartab > li.active').attr('data-itemtype');
	$('#curr_tab').val(itemType);

	$('.cloneSeason').click(function(){
            
		if($("#clone_exist").val()==1){
			var no_of_year=$('.yeartab li').length;
			var current_year=new Date();
			current_year =current_year.getFullYear();
			var current_year_index= $(".yeartab li").index( $(".yeartab li[data-itemtype^='"+current_year+"']") );
			next_year_count=Number(no_of_year) - Number(current_year_index);
			if (next_year_count < 4) {
			     
			 $("#tab_content").find(".property_tab_container").removeClass("active");
			 var clone_box=$(".property_tab_container").last().attr("id");
			 
                         var data_year=$("#"+clone_box).attr("data-year");
			 var next_data_year=Number(data_year)+1;
			 
			 $(".yeartab").find("li").removeClass("active");
			 var li_html=$(".yeartab").find("li").last().html();
			 li_html =li_html.replace(data_year,next_data_year);
			 
			 var li_str='<li class="active" data-itemtype="'+next_data_year+'">';
			 li_str +=li_html;
			 li_str +="</li>";
			 $(".yeartab").append(li_str);
			 $(".yeartab").find("li").last().find("a").attr("title",next_data_year);
			 $(".yeartab").find("li").last().find("a").attr("alt",next_data_year);
			 $(".yeartab").find("li").last().find("a").text(next_data_year);
			 
			 
			 var div_content=$("#"+clone_box).html();
			 div_content=div_content.replace(data_year,next_data_year);
			 var str='<div id="season_pan_'+next_data_year+'" class="property_tab_container active" data-year="'+next_data_year+'">';
			 str +=div_content;
			 str +="</div>";
			 $("#tab_content").append(str);
			// alert(data_year);
			 
			  $(".property_tab_container").last().find('table[id^="tableSeasons_"]').attr("id","tableSeasons_"+next_data_year);
			  $(".property_tab_container").last().find('tr').each(function(){
			     var id=$(this).attr("id");
			     id=id.replace("_"+data_year,"_"+next_data_year);
			     $(this).attr("id",id);	
			 });
			 var id=$(".property_tab_container").last().find('a[id^="removeSeason_"]').attr("id");
			 id=id.replace(data_year,next_data_year);
			 $(".property_tab_container").last().find('a[id^="removeSeason_"]').attr("id",id);
			 $(".property_tab_container").last().find('a[id^="removeSeason_"]').attr("data-year",next_data_year);
			 
			 $(".property_tab_container").last().find('input, select').each(function(){
			     var id=$(this).attr("id");
			     id=id.replace("_"+data_year,"_"+next_data_year);
			     $(this).attr("id",id);
			     $(this).attr("data-year",next_data_year);
			 });
			 
			 var onclick=$(".property_tab_container").last().find('.seasonDefault').attr("onclick")
			 onclick =onclick.replace(data_year,next_data_year);
			 $(".property_tab_container").last().find('.seasonDefault').attr("onclick",onclick);
			
			 $(".property_tab_container").last().find('.rental_start_month').each(function(){
			     var val=$(this).val();
			     val=val.replace(data_year,next_data_year);
			     $(this).attr("value",val);
			 });
			 
			 $(".property_tab_container").last().find('.rental_end_month').each(function(){
			     var val=$(this).val();
			     val=val.replace(data_year,next_data_year);
			     $(this).attr("value",val);
			 });
			 
			 $("#clone_exist").val(0);
			 
			}else{
			     alert("You have crossed the seasons limit");
			 
			}
		}else{
			alert("Clone not possible before saving the last one");
		}
	});
	
	
	//$(document).on('click', '.seasonHolder', function(){
	$('.yeartab .seasonHolder').bind("click", function(){	
	    
	    
	    
	});
    });
    function activeTab(element) {
	    $('.seasonHolder').parent().removeClass('active');
	    $(element).parent().addClass('active');
	    var year	= $(element).attr('id').replace('season_holder_', '');
	    var pid	= $('#property_id').val();
	    var year1 = year-1;
	    var panID	= 'season_pan_' + year;
	    $('.property_tab_container').removeClass('active');
	    var panId1 = 'season_pan_' + year1;
	   // $('#' + panId1).addClass('active');
	    $('#' + panID).addClass('active');
	    $('#curr_tab').val(year);
    }
    $(function(){
	
	$(document).on('change', '.form-control', function(){
		if ($(this).val()!='') {
			$(this).parent().find("em").remove();
			$(this).removeClass("err-form-control");
		}
		
	});
	
	$(document).on('change', '.end_month', function(){
	    
	    var id=$(this).attr("id");
	    var id_arr=id.split("_");
	    var data_element=id_arr[3];
	    
	    $("#end_month_"+year+"_"+data_element +" option[value='"+val+"']").prop('selected', true);
	    $("#end_month_"+year+"_"+data_element).trigger( "change" );
	    var year=$(this).attr("data-year");
	    var month=$(this).val();
	    var date = new Date(year+"-"+month+"-01"), y = date.getFullYear(), m = date.getMonth();
	    var firstDay = new Date(y, m, 1);
	    var lastDay = new Date(y, m + 1, 0);
	    if (firstDay!='Invalid Date') {
		$(this).next().val(lastDay.getFullYear()+"-"+month+"-"+lastDay.getDate());
	    }else{
		$(this).next().val("");
	    }
	    
	    
	    var val=Number($(this).val())+1;
	    if (val<10) {
		val="0"+val;
	    }
	    if (Number(val)<=12) {
		$("#start_month_"+year+"_"+(Number(data_element)+1) ).html( "<option value='"+val+"'>"+Months[Number(val)]+"</option>" );
	    }else{
		$("#start_month_"+year+"_"+(Number(data_element)+1) ).html( "" );
	    }
	    
	    $("#start_month_"+year+"_"+(Number(data_element)+1)).trigger( "change" );
	    $("#end_month_"+year+"_"+(Number(data_element)+1)).trigger( "change" );
	    $(this).parent().find("em").remove();
        });
	
	$(document).on('change', '.start_month', function(){
	   	
		var id=$(this).attr("id");
		var id_arr=id.split("_");
		var data_element=id_arr[3];
		
		var year=$(this).attr("data-year");
		var month=$(this).val();
		var date = new Date(year+"-"+month+"-01"), y = date.getFullYear(), m = date.getMonth();
		var firstDay = new Date(y, m, 1);
		if (firstDay!='Invalid Date') {
		    $(this).next().val(firstDay.getFullYear()+"-"+month+"-01");
		
		}else{
		    $(this).next().val("");
		}
		    
		var val=Number($(this).val());
		if (val<10) {
		    val="0"+val;
		}
		var str="";
		
		var selected_val=$("#end_month_"+year+"_"+data_element).val();
		for(var x in Months){
		    if (Number(val) >0 && x>=Number(val)) {
			var y=Number(x);
			if (y<10) {
			    y="0"+y;
			}
			if (selected_val==y) {
			    str +="<option value='"+y+"' selected='selected'>"+Months[ Number(y) ]+"</option>";
			}else{
			    str +="<option value='"+y+"'>"+Months[ Number(y) ]+"</option>";
			}
			
		    }
		}
		$("#end_month_"+year+"_"+data_element).html(str);
		$("#end_month_"+year+"_"+data_element).trigger( "change" );
		$(this).parent().find("em").remove();
		
        });
	
	$( ".end_month" ).trigger( "change" );
	$( ".start_month" ).trigger( "change" );
	
	$(document).on('click', '.removeSeason', function(){
	      var year=$(this).attr("data-year");
	      var element_data=$(this).attr("data-element");
	      
	      var is_checked=$(this).parents("tr").find("input[type=radio]").prop("checked");
	      
	      if (is_checked==false) {
		var parent_id="season_"+year+"_"+element_data;
		var count=1;
		
		$("#tableSeasons_"+year+" .season_content").each(function(parent_elemnt){
		    if($(parent_elemnt).attr("id")!=parent_id){
			
			if (count > $("#"+parent_id).attr("data-element")) {
			    var next_tr=Number(count)-1;
			     $(this).find("[id$='_"+count+"']").each(function(){
				var id=$(this).attr("id");
				id=id.replace("_"+year,"");
				id=id.replace("_"+count,"");
				$(this).attr("id",id+"_"+year+"_"+next_tr);
			      
			    });
			    $(this).find(".removeSeason").attr("data-element",next_tr);
			    $(this).find(".removeSeason").attr("id","removeSeason_"+next_tr+"_"+year);
			    $(this).find("h3.season_heading").text("Season "+next_tr);
			    $(this).attr("id","season_"+year+"_"+next_tr);
			    $(this).attr("data-element",next_tr);
			}
			
		    }
		    count=Number(count)+1;
		});
		
		
		$('#'+parent_id).remove();
		
		$("#season_pan_"+year).find(".start_month").first().html("<option value='01'>January</option>");
		 $("#clone_exist").val(0);
		
		var top_left=$("#season_pan_"+year).find("tr.season_content").last().position();
		var height=$("#season_pan_"+year).find("tr.season_content").last().height();
		
		
		$('html, body').animate({scrollTop : (Number(top_left.top)+Number(height))},500);
		
		
		$( ".end_month" ).trigger( "change" );
		$( ".start_month" ).trigger( "change" );
		 
		 
	      }else{
		alert("Default Season dont be deleted");
	      }
	      //alert(year+"\n"+element_data);
	});
	
    })
   var Months={
      1:"January",
      2:"February",
      3:"March",
      4:"April",
      5:"May",
      6:"June",
      7:"July",
      8:"August",
      9:"September",
      10:"October",
      11:"November",
      12:"December",
    };
    
    var select_month=Array();
    function addMoreSeasons(year){
	var no_season=$("#season_pan_"+year).find("tr.season_content").length;
	
	var last_end_month=Number($("#season_pan_"+year).find("tr.season_content").last().find(".end_month").val());
	//alert(no_season);
	if ($("#season_pan_"+year).find("tr.season_content").length ==0 || last_end_month <  12) {
		
	    var next_tr=(Number(no_season)+1);
	    
	    var str="";
	    str +='<tr data-element="'+next_tr+'" class="season_content" id="season_'+year+'_'+next_tr+'">';
	    str +='<td>';
            str +='<div class="col-mb-12">'
            str +='<div class="col-md-4">';
            str +='<h3 class="season_heading">Season '+next_tr+'</h3>';
            str +='</div>';
            str +='<div class="col-md-8 text-right">';
            str +='<button type="button" id="removeSeason_'+next_tr+'_'+year+'" class="removeSeason btn btn-primary" data-year="'+year+'" data-element="'+next_tr+'" >';
            str +='<i class="fa fa-times"></i>';
            str +='Remove Season';
            str +='</button>';
            str +='</div>';
            str +='<div style="clear: both"></div>';
            str +='</div>';
	    str +='<div class="col-sm-4">';
	    str +='<label class="req" for="reg_input_name">1 Month Price</label>';
	    str +='<input type="text" id="one_month_price_'+year+'_'+next_tr+'" data-type="number" value="" data-required="true" class="form-control  number required daily-price-fld" name="one_month_price[]" data-year="'+year+'">';
	    str +='</div>';
	    str +='<div class="col-sm-4">';
	    str +='<label class="req" for="reg_input_name">3 Month Price</label>'
	    str +='<input type="text" id="three_month_price_'+year+'_'+next_tr+'" data-type="number" data-required="true" class="form-control required" name="three_month_price[]" value="" data-year="'+year+'">';
	    str +='</div>';
	    str +='<div class="col-sm-4">';
	    str +='<label class="req" for="reg_input_name">6 Month Price</label>';
	    str +='<input type="text" id="six_month_price_'+year+'_'+next_tr+'" data-type="number" data-required="true" class="form-control required" name="six_month_price[]" value="" data-year="'+year+'">';
	    str +='</div>';
	    str +='<div style="clear: both"></div>';
    
	    str +='<div class="col-sm-4">';
	    str +='<label class="req" for="reg_input_name">Start Month</label>';
	    str +='<select data-year="'+year+'" class="form-control start_month month_drop" id="start_month_'+year+'_'+next_tr+'" name="start_month[]">';
	    if($("#season_pan_"+year).find("tr.season_content").length==0){
		str +='<option  value="01">January</option>';
	    }
	    str +='</select>';
	    str +='<input type="hidden" id="season_start_month_'+year+'_'+next_tr+'" name="season_start_month[]" class="date-picker  required rental_start_month date_start_0" data-required="true" value="" readonly="" data-year="'+year+'">';
	    str +='</div>';
	    str +='<div class="col-sm-4">';
	    str +='<label class="req" for="reg_input_name">End Month</label>';
	    str +='<select data-year="'+year+'" class="form-control end_month month_drop" id="end_month_'+year+'_'+next_tr+'" name="end_month[]"></select>';
	    str +='<input type="hidden" id="season_end_month_'+year+'_'+next_tr+'" name="season_end_month[]" class="required rental_end_month date_end_0" data-required="true" value="" readonly="" data-year="'+year+'">';
	    str +='</div>';
	    str +='<div class="col-sm-4 text-center">';
	    str +='<label>&nbsp;</label>';
	    str +='<div class="defaultSeason" style="width: 100%">';
	    str +='<label class="req" for="reg_input_name"> Is Default Season ?</label>';
	    str +='<input type="hidden" value="Yes" class="is_default_hidden_class" id="is_default_hidden_'+year+'_'+next_tr+'" name="is_default_hidden[]" data-year="'+year+'">';
	    str +='<input type="radio"  name="isDefault[]" id="isdefault_'+year+'_'+next_tr+'" class="form-controltwo seasonDefault" onclick="setDefault('+next_tr+','+year+');" value="1" data-year="'+year+'">';
	    str +='</div>';
	    str +='</div>';
	    str +='<div style="clear: both"></div>';
	    str +='</td>';
	    str +='</tr>';
	   
	    $("#season_pan_"+year+" tbody").append(str);
	    $("#season_pan_"+year).find("tr.season_content").last().find("[id$='_"+no_season+"']").each(function(){
		var id=$(this).attr("id");
		id=id.replace("_"+year,"");
		id=id.replace("_"+no_season,"");
		$(this).attr("id",id+"_"+year+"_"+next_tr);
		if ($(this).hasClass("seasonDefault")==true) {
		    $(this).attr("onclick","setDefault("+next_tr+","+year+")");
		}	
	    });
	    $("#season_pan_"+year).find("tr.season_content").last().find(".removeSeason").attr("data-element",next_tr);
	    $("#season_pan_"+year).find("tr.season_content").last().find("legend b").text("Season "+next_tr);
	    
	    $( ".end_month" ).trigger( "change" );
	    $( ".start_month" ).trigger( "change" );
	     $("#clone_exist").val(0);
	     
	    var top_left=$("#season_pan_"+year).find("tr.season_content").last().position();
	    var height=$("#season_pan_"+year).find("tr.season_content").last().height();
	    
	    $('html, body').animate({scrollTop : (Number(top_left.top)+Number(height)+250)},500);
	    
	}else{
	    alert("Season is completed");
	}
	return false;
    }

    
    $(function(){
	$(".submit_but").click(function(){
	   var incomplete_count=0, incomplete_str='',incomplete_element='',incorrect_index='';var blank_count=0;
	   var first_err='', first_err_content_index='';
	   $("#tab_content").find("em").remove();
	   $("#tab_content").find(".err-form-control").removeClass('err-form-control');
	    $("#tab_content").find("input.form-control").each(function(){
		
		if ($(this).val()=='') {
		    if (blank_count==0) {
			first_err=$(this);
			first_err_content_index=$(".tableSeasons").index( $(this).parents(".tableSeasons") );
		    }
		    $(this).parent().append("<em>Field is required</em>");
		    $(this).addClass('err-form-control');
		    blank_count=Number(blank_count)+1;
		}
	    });
	    
	    $("#tab_content").find(".property_tab_container").each(function(element){
		
		if ( $(this).find(".end_month").length >0 ) {
		
			
			var text=$(this).find(".end_month").last().val();
			if (text!='12') {
			    incomplete_count=Number(incomplete_count)+1;
			    incomplete_element=  $(this).find(".end_month").last();
			    incomplete_str="Year has incomplete end please reset the last season";
			    
			    incorrect_index=$("#tab_content .property_tab_container").index(this);
			    
			    //return false;
			}
		}
	   });
	    
	    $("#tab_content").find(".property_tab_container").each(function(element){
		
		if ( $(this).find(".start_month").length >0 ) {
		
			
			var text=$(this).find(".start_month").first().val();
			if (text!='01') {
			    incomplete_count=Number(incomplete_count)+1;
			    incomplete_element=$(this).find(".start_month").first();
			    incomplete_str=$(this).find(".start_month").first().attr("data-year")+" has incomplete end please reset the last season";
			    incorrect_index=$("#tab_content .property_tab_container").index(this);
			    //return false;
			}
			
			var text=$(this).find(".start_month").last().val();
			//alert(text);
			if (text==null) {
			    incomplete_count=Number(incomplete_count)+1;
			    incomplete_element=$(this).find(".start_month").last();
			    incomplete_str=$(this).find(".start_month").last().attr("data-year")+" has incomplete end please reset the last season";
			    incorrect_index=$("#tab_content .property_tab_container").index(this);
			    //return false;
			}
		}
	   });
	    
	   $("#tab_content").find(".seasonDefault").each(function(){
		if ($(this).prop("checked")==false) {
			$(this).prev().val("No");
		}else{
			$(this).prev().val("yes");
		}
	   });
	   
	    if (blank_count!=0) {
		$(".yeartab li").removeClass("active");
		$(".yeartab li:eq("+first_err_content_index+")").addClass("active");
		$("#tab_content .property_tab_container").removeClass("active");
		$("#tab_content .property_tab_container:eq("+first_err_content_index+")").addClass("active");
		first_err.focus();
                $.scojs_message("some required fields are blank", $.scojs_message.TYPE_ERROR);
		
		return false;
	    }
	     if (incomplete_count!=0) {
		incomplete_element.addClass('err-form-control');
		incomplete_element.parent().append('<em>Wrong Month </em>');
		
		$("#tab_content .property_tab_container").removeClass('active');
		$("#tab_content .property_tab_container:eq("+incorrect_index+")").addClass("active");
		
		$(".yeartab li").removeClass('active');
		$(".yeartab li:eq("+incorrect_index+")").addClass("active");
		
                $.scojs_message(incomplete_str , $.scojs_message.TYPE_ERROR);
		
		return false;
	    }
	});
    });
function setDefault(element,year){
    $(".is_default_hidden_class").val("No");
    $("#is_default_hidden_"+year+"_"+element).val("Yes");
    $(".defaultSeason").removeClass("active");
    $("#is_default_hidden_"+year+"_"+element).parent().addClass("active");
}