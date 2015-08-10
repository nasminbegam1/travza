/*
  jQuery Document ready
*/
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
		minDate: 0,
		/*
			maxDate
			jQuery datepicker option 
			which set 30 days later date as maximum date
		*/
		maxDate: 30,
		dateFormat: 'yy-mm-dd'
		
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
		minDate: 0,
		/*
			maxDate
			jQuery datepicker option 
			which set 30 days later date as maximum date
		*/
		maxDate: 30,
		dateFormat: 'yy-mm-dd'
	});
	/*
		below code just enable time picker.
	*/	
	//$('#start_date_time').timepicker();
	//$('#end_date_time').timepicker();
});