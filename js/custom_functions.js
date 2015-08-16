var FRONT_URL = 'http://192.168.2.5/traveldotz/';
function previewImage(element,targetElement,height,width){
        var myfiles = element;
	var files = myfiles.files;
	//alert(height);

	var i=0;
	for (i = 0; i<files.length; i++) {
	    var readImg = new FileReader();
	    var file=files[i];
	    file['st']=i;
	    if(file.type.match('image.*')){
		    
	       // storedFiles.push(file);
		readImg.onload = (function(file) {
		    return function(e) {
			$(targetElement).html('<img width="'+width+'" height="'+height+'" src="'+e.target.result+'"/>');
		    };
		})(file);
		readImg.readAsDataURL(file);
		$(".PreviewImage").show();
	    }else{
		alert('the file '+file.name+' is not an image');
		$('.filename').html('');
	    }
	}
}
//End of custom javascript and jquery codes that are used for Admin Section by WDC
$(function() {
	var nowDate 	= new Date();
	var today 	= new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
	$(".PreviewImage").hide();
	$('#profile_file').change(function(){
		$('.filename').html($(this).val());
	});
	$('#deal_image').change(function(){
		$('.filename').html($(this).val());
	});
	$("#closed_holidays").datetimepicker({
		startDate: today,
		pickTime: false
	});
	$("#exp_date_bucket_draft").datetimepicker({
		startDate: today,
		pickTime: false
	});
	$("#exp_date_page_draft").datetimepicker({
		startDate: today,
		pickTime: false
	});
	
	$("#exp_date_bucket").datetimepicker({
		startDate: today,
		pickTime: false
	});
	$("#exp_date_page").datetimepicker({
		startDate: today,
		pickTime: false
	});
	$("#dealForm").validate({
		// Specify the validation rules
		rules: {
		   deal_title			: "required",
		   category_id			: "required",
		   deal_address			: "required",
		   country_id			: "required",
		   city				: "required",
		   state			: "required",
		   zip				: "required",
		   start_date			: "required",
		   end_date			: "required",
		   website              	: {required:true,url :true},
		   link_to_video        	: {url :true},
		   senior_citizen_age 		: {number: true },
		   custom_discount_amount	: {number: true,"offerAmount" :true,"discountType" : true},
		   deal_image			: {"imagePresent": true},
		   'discount_amount[]'		: {number : true,"discountValue" :true},
		   exp_date_of_deal		: "required",
		   exp_date_of_deal_on_bucket	: "required",
		},
		
		// Specify the validation error messages
		messages: {
		    deal_title		: "Please enter offer title",
		    category_id		: "Please select offer category",
		    deal_address	: "Please enter offer address",
		    country_id		: "Please select country",
		    city		: "Please enter city",
		    state		: "Please enter state",
		    zip			: "Please enter zip code",
		    start_date		: "Please enter Start Time/Date",
		    end_date		: "Please enter End Time/Date",
		    website             : {required : "Please enter website",
					   url :"The site URL is incorrect. Use the form http://www.traveldotz.com"},
		    link_to_video	: {required: "Please enter link to video",
					   url :"Please enter valid link to video"},
		    custom_discount_amount : {number : 'Discount must be in number'},
		    senior_citizen_age	: {number: "Senior Citizen Age must be in numbers"},
		    'discount_amount[]'	: {number: "Discount Amount must be in numbers"},
		    exp_date_of_deal		: "Please select Expiration Date of Offer",
		    exp_date_of_deal_on_bucket	: "Please select Expiration Date of Offer on Bucket List"
		},
		
		submitHandler: function(form) {
		    form.submit();
		}
	});
	$.validator.addMethod("offerAmount",function ()
	{
	    var offerAmt = true;
	    var offer = $('#offer_price').val();
	    var custom_discount = $('#custom_discount_amount').val();
	    var custom_discount_type = $('#custom_discount_type').val();
	    if ((parseInt(custom_discount) > parseInt(offer) ) && custom_discount_type == '$') {
		offerAmt = false;
		return false;
	    }
	    return offerAmt;
	},'Your entered discount amount is greater than Offer Amount.');
	
	$.validator.addMethod("imagePresent",function ()
	{
	    var imageEmpty = true;
	    var deal_image_value = $('#deal_image_value').val();
	    var deal_image	 = $('#deal_image').val();
	    if (deal_image_value == '' && deal_image == '') {
		imageEmpty	= false;
	    }
	    return imageEmpty;
	},'Please Upload image');
	
	$.validator.addMethod("discountValue",function ()
	{
	    var discountCheck = true;
	    $(".discount_amount").each(function(){
		var id = this.id;
		if($(this).val() !=''){
		var discounttype = $('#discountType_'+id+' option:selected').val();
		if (discounttype == '') {
			discountCheck = false;
			return false;
		}
		}
	    });
	    return discountCheck;
	},'Please Select Discount ($ or %)');
	$.validator.addMethod("discountType",function ()
	{
	    var discountTypeCheck = true;
	    var custom_discount_amount = $("#custom_discount_amount").val();
		var id = this.id;
		if(custom_discount_amount !=''){
		var discounttype = $('#custom_discount_type option:selected').val();
		if (discounttype == '') {
			discountTypeCheck = false;
			return false;
		}
		}
	    return discountTypeCheck;
	},'Please Select Discount ($ or %)');
	
	    //vendor contact information update
	$('.update_details').hide();
	$('.cancelbutn').hide();
	
	$('.vend-List li').click(function(){
		
		var i = $(this).index();
		$('.vend-List li').removeClass('active');
		$(this).addClass('active');
		//$('.vendorRight .vendorBilling').removeClass('active');
		//$('.vendorRight .vendorBilling:eq('+i+')').addClass('active');
		 var type_val = $(".active >  .edit_type").attr('id');
		 //alert(type_val);
		 var vendor_id = $("#vendor_id").val();
		
		if (type_val == 'billing_info') {
			$.ajax({
                    
                              type: "POST",
                              dataType: "HTML",
                              url:  FRONT_URL + "vendor_profile/vendor_billinginfo/",
                              data: { vendor_id:vendor_id},
                              success:function(data) {
				
					$(".vendorBilling").html(data);
				        $('.update_details').hide();
		                        $('.cancelbutn').hide();
                              }
                      });
		}
		else if (type_val == 'billing_history') {
			
			
			$.ajax({
                    
                              type: "POST",
                              dataType: "HTML",
                              url:  FRONT_URL + "vendor_profile/vendor_billinghistory/",
                              data: { vendor_id:vendor_id},
                              success:function(data) {
				
					$(".vendorBilling").html(data);
				       
                              }
                      });
			
		}
		else if (type_val == 'reset_password') {
			
			$.ajax({
                    
                              type: "POST",
                              dataType: "HTML",
                              url:  FRONT_URL + "vendor_profile/vendor_resetpassword/",
                              data: { vendor_id:vendor_id},
                              success:function(data) {
				
					$(".vendorBilling").html(data);
                              }
                      });
		}
		else if (type_val == 'contact_info') {
			
			$.ajax({
                    
                              type: "POST",
                              dataType: "HTML",
                              url:  FRONT_URL + "vendor_profile/vendor_contactdetails/",
                              data: { vendor_id:vendor_id},
                              success:function(data) {
				
					$(".vendorBilling").html(data);
					 $('.update_details').hide();
		                        $('.cancelbutn').hide();
                              }
                      });
			
		}
	});
	//$(document).on('click', '.view-offer', function(){
	//	alert('hi');
	//$( ".view-offer" ).on( "click",function() {
	$('.view-offer').click(function(){
		
		var offer_id = $(this).attr('data-element');
		$('#view-offer').attr("id","view-offer"+offer_id);
		title = $(this).attr('title');
		$.ajax({			
			 type: "POST",
			 url: FRONT_URL + "home/view_offer/",
			 data: { 'offer_id': offer_id },
			 success: function(msg){
				  $('#offer_details').html(msg);
				  $("#view-offer"+offer_id).attr("id","view-offer");
				  $('#offertitle').html(title);
			 }
		});
	});
	
	$('.view-name').click(function(){
		
		var id = $(this).attr('data-element');
		var type = $(this).attr('type');
		
		$('#view-name').attr("id","view-name"+id);
		$.ajax({			
			 type: "POST",
			 url: FRONT_URL + "home/view_name/",
			 data: { 'id': id, 'type':type },
			 success: function(msg){
				  $('#details_name').html(msg);
				  $("#view-name"+id).attr("id","view-name");
			 }
		});
	});
	
	$('.view-flyer').click(function(){
		var flyer_id = $(this).attr('data-element');
		$('#view-flyer').attr("id","view-flyer"+flyer_id);
		title = $(this).attr('title');
		$.ajax({			
			type: "POST",
			url: FRONT_URL + "home/view_flyer/",
			data: { 'flyer_id': flyer_id },
			success: function(msg){
				 $('#flyer_details').html(msg);
				 $("#view-flyer"+flyer_id).attr("id","view-flyer");
				 $('#flyertitle').html(title);
			}
		});
	});
	//vendor profile view
	$('.view-vendor-profile').click(function(){
		var id = $(this).attr('data-element');
		
		$('#view-vendor-profile').attr("id","view-vendor-profile"+id);
		$.ajax({			
			type: "POST",
			url: FRONT_URL + "dashboard/view_vendor_info/",
			data: { 'id': id },
			success: function(msg){
				 $('#view_vendor_details').html(msg);
				 $("#view-vendor-profile"+id).attr("id","view-vendor-profile");
			}
		});
	});
	
	//view review//
	$('.view-review').click(function(){
		
		var id = $(this).attr('data-element');		
		$('#view-review').attr("id","view-review"+id);
		$.ajax({			
			type: "POST",
			url: FRONT_URL + "dashboard/view_review/",
			data: { 'id': id },
			success: function(msg){
				 $('#view_review_details').html(msg);
				 $("#view-review"+id).attr("id","view-review");
			}
		});
		
	});
	
	//Apply promocode for offer
	$('.applyPromoCode').hide();
	$('#promocode').keyup(function(){
	if($('#promocode').val() != ''){
		$('.applyPromoCode').show();
	}else{
		$('#success_msg').html('');
		$('#promocode_use').val('No');
		$('.error_msg').html('');
		$('#click_count').val(0);
		$('.applyPromoCode').hide();
		$('#total_cost').val($('#original_total_cost').val());
		$('.price').children('strong').text('$'+$('#original_total_cost').val());
	}
	});
	$('.applyPromoCode').click(function(){ 
		var promocode 	= $('#promocode').val();
		var total_cost 	= $('#original_total_cost').val();
		var p_type	= $('#p_type').val();
		var promocode_use = $('#promocode_use').val();
		var click_count = $('#click_count').val();
		var prev_promocode = $('#prev_promocode').val();
		var deal_flyer_id = $('#deal_flyer_id').val();
		if (click_count == 0 || (prev_promocode == '' || (prev_promocode != promocode)) ) {
			$.ajax({			
				type: "POST",
				url: FRONT_URL + "offer/check_promocode/",
				data: { 'promocode': promocode , "total_cost" : total_cost, "p_type" : p_type,"deal_flyer_id" : deal_flyer_id},
				success: function(msg){
					//alert(msg)
					$("#prev_promocode").val(promocode);
					var get_msg = msg.split('||');
					//alert(get_msg[0]);
					if (get_msg[0] == 'error') {
						$("#success_msg").html('');
						$('.error_msg').html(get_msg[1]);
					}else{
					$("#success_msg").html('Promo code successfully applied!');	
					$('#promocode_use').val('Yes');
					$('.error_msg').html('');
					$('#click_count').val(1);
					$('#total_cost').val(msg);
					$('.price').children('strong').text('$'+msg);
					}
				}
			});
		}
	});
	
	
});




