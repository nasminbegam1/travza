/*
  jQuery Document ready
*/
// To set mindate in enddate
function customRange(input) 
{
	if (input.id == "end_date_time") {
		
		var start_date = $("#start_date_time").datetimepicker("getDate");
		var start_date_val = $("#start_date_time").val();
		
		if (start_date == null || start_date_val == '00-00-0000 00:00:00' ) {
			
			alert('Please select start date');			
			$( "#start_date_time" ).focus();
			return false;
			
		}
		
	}
return {
        minDate: (input.id == "end_date_time" ? $("#start_date_time").datetimepicker("getDate") : new Date())
      }; 
}

// To set maxdate in startdate
//function customRangeStart(input) 
//{ 
//return {
//        maxDate:(input.id == "start_date_time" ? $("#end_date_time").datetimepicker("getDate") : null)
//      }; 
//}
$(function()
{
	
	$('#start_date_time').datetimepicker(
	{
		/*
			timeFormat
			Default: "HH:mm",
			A Localization Setting - String of format tokens to be replaced with the time.
		*/
		timeFormat: "HH:mm",
		/*
			hourMin
			Default: 0,
			The minimum hour allowed for all dates.
		*/
		hourMin: 0,
		/*
			hourMax
			Default: 23, 
			The maximum hour allowed for all dates.
		*/
		hourMax: 23,
		/*
			numberOfMonths
			jQuery DatePicker option
			that will show two months in datepicker
		*/
		numberOfMonths: 1,
		/*
			minDate
			jQuery datepicker option 
			which set today date as minimum date
		*/
		//beforeShow: customRangeStart,
		minDate: 0,
		/*
			maxDate
			jQuery datepicker option 
			which set 30 days later date as maximum date
		*/
		maxDate: 30,
		dateFormat: 'mm-dd-yy'
		
	});
	
	
		$('#end_date_time').datetimepicker(
	{
		/*
			timeFormat
			Default: "HH:mm",
			A Localization Setting - String of format tokens to be replaced with the time.
		*/

		timeFormat: "HH:mm",
		/*
			hourMin
			Default: 0,
			The minimum hour allowed for all dates.
		*/
		hourMin: 0,
		/*
			hourMax
			Default: 23, 
			The maximum hour allowed for all dates.
		*/
		hourMax: 23,
		/*
			numberOfMonths
			jQuery DatePicker option
			that will show two months in datepicker
		*/
		numberOfMonths: 1,
		/*
			minDate
			jQuery datepicker option 
			which set today date as minimum date
		*/
		//minDate: 0,
		beforeShow: customRange,
		/*
			maxDate
			jQuery datepicker option 
			which set 30 days later date as maximum date
		*/
		maxDate: 30,
		dateFormat: 'mm-dd-yy'
	});
	/*
		below code just enable time picker.
	*/	
	$('#start_date_time').timepicker();
	$('#end_date_time').timepicker();	
});