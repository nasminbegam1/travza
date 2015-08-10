
(function($) {

  //$("*").mouseup(  function()   {     
  //      var clickedElement = this; //HTML DOM Element
  //      var $clickedElement = $(this); //jQuery Wrapped HTML DOM Element
  //      $(clickedElement).addClass("sss");
  //  } );
  
  
    var base_url    = 'http://192.168.0.111/livephuket/warp/';
    var xpos        = '';
    var ypos        = '';
    var strCalendar = '';
    var days        = ['S','M','T','W','T','F','S'];

    var months      = ['January','February','March','April','May','June','July','August','September','October','November','December'];

    Date.prototype.getMonthName = function() {
        return months[ this.getMonth() ];
    };
    Date.prototype.getDayName = function() {
        return days[ this.getDay() ];
    };

    $.fn.avail = function() {        
        var startDate             = new Date();
        startDate.setDate(startDate.getDate()-90);
        var startTime           = startDate.getTime();
        var endDate             = new Date();
        endDate.setDate(endDate.getDate()+90);
        var endTime             = endDate.getTime();
        
        strCalendar         = '<section class="bigCalender">';
        strCalendar         = strCalendar + '<section class="bigCalenderTop">';
        strCalendar         = strCalendar + '<div class="bigCalLeft">';
        strCalendar         = strCalendar + '<div class="calNavigation">';
        strCalendar         = strCalendar + '<div class="calNavPrev"></div>';
        strCalendar         = strCalendar + '<div class="calCalendar">';
        strCalendar         = strCalendar + '<a href="javascript:void(0);" class="calGotoToday">Today</a><br><input type="hidden" id="lxcInputDate" class="hasDatepicker"><img class="ui-datepicker-trigger" src="'+base_url+'images/calender-icon.png" alt="..." title="...">';
        strCalendar         = strCalendar + '</div>';
        strCalendar         = strCalendar + '<div class="calNavNext"></div>';
        strCalendar         = strCalendar + '</div>';
        strCalendar         = strCalendar + '</div>';
        
        strCalendar         = strCalendar + '<div class="bigCalRight">';
        strCalendar         = strCalendar + '<div class="calboxPan">';
        strCalendar         = strCalendar + '<div class="calRow rowOne">';
        
        for(loopTime = startTime; loopTime < endTime; loopTime += 86400000){
            strCalendar         = strCalendar + '<div class="calDayBox"><div style="width: 154px; color: rgb(0, 0, 0);" class="calDayMonth">October 2014</div></div>';
        }
        
        strCalendar         = strCalendar + '<div class="calRow rowTwo">';
        for(loopTime = startTime; loopTime < endTime; loopTime += 86400000){
            var loopDay         = new Date(loopTime);
            strCalendar         = strCalendar + '<div class="calDayBox" data-item="'+loopDay.getDay()+'-'+loopDay.getDate()+'-'+loopDay.getFullYear()+'">' + loopDay.getDayName() + '</div>';
        }
        strCalendar         = strCalendar + '</div>';
        
        strCaldar           = strCalendar + '<div class="calRow rowThree">';
        for(loopTime = startTime; loopTime < endTime; loopTime += 86400000){
            var loopDay         = new Date(loopTime);
            strCalendar         = strCalendar + '<div class="calDayBox">' + loopDay.getDate() + '</div>';
        }
        strCalendar         = strCalendar + '</div>';
        
        strCalendar         = strCalendar + '</div>';
        strCalendar         = strCalendar + '</div>';
        strCalendar         = strCalendar + '</div>';
        strCalendar         = strCalendar + '</section>';
        
        strCalendar         = strCalendar + '<section class="bigCalenderBtm">';
        strCalendar         = strCalendar + '<div class="bigCalLeft">';
        for(var p=1; p<=70; p++){
            if (p%2 == 0){
                strCalendar         = strCalendar + '<div class="calProp calPropOdd"><a href="#" target="_blank">A3 - 2BR</a></div>';
            }else{
                strCalendar         = strCalendar + '<div class="calProp"><a href="#" target="_blank">A2 - 2BR</a></div>';
            }
        }
        strCalendar         = strCalendar + '</div>';
        
        strCalendar         = strCalendar + '<div class="bigCalRight">';
        for(var p=1; p<=70; p++){
            strCalendar         = strCalendar + '<div class="calRowPan">';
            for(loopTime = startTime; loopTime < endTime; loopTime += 86400000){                      
                strCalendar         = strCalendar + '<div class="calCountBox"></div>';
            }
            strCalendar         = strCalendar + '</div>';
        }
        strCalendar         = strCalendar + '</div>';
        
        strCalendar         = strCalendar + '</section>';
        /* Naming the week days */
        //for(loopTime = startTime; loopTime < endTime; loopTime += 86400000){
        //    var loopDay     = new Date(loopTime);            
        //    strCalendar         = strCalendar + '<th abbr="'+loopDay.getDay()+'-'+loopDay.getDate()+'-'+loopDay.getFullYear()+'">' +  loopDay.getDayName() + '<br>' + loopDay.getDate() + '</th>';
        //}
        //strCalendar         = strCalendar + '</tr>';
        //strCalendar         = strCalendar + '</thead>';
        //strCalendar         = strCalendar + '<tbody id="calBody">';
        //for(var p=1; p<=70; p++){
        //    strCalendar         = strCalendar + '<tr>';
        //    for(loopTime = startTime; loopTime < endTime; loopTime += 86400000){                      
        //        strCalendar         = strCalendar + '<td>&nbsp;</td>';
        //    }
        //    strCalendar         = strCalendar + '</tr>';
        //}
        //strCalendar         = strCalendar + '</tbody>';
        strCalendar         = strCalendar + '</section>';
        $(this).html(strCalendar);
        
        var counts = [ 0, 0, 0 ];
        
        //$('.bigCalenderTop .bigCalRight').draggable({
        //    axis: "x",
        //    start: function(){
        //      counts[0]++;  
        //    },
        //    drag: function(e){
        //        counts[1]++;
        //    },
        //    stop: function(e){
        //        counts[2]++;
        //        //alert(counts[1]);
        //        ////var offset  = $(this).offset();
        //        //var w = $('#calendarPan').css('left');
        //        //var c = $('#container').width();
        //        //   
        //        //w = parseInt(w,10);
        //        //   
        //        //var bW = c-w;
        //        ////alert(bW);
        //        //var cell = (bW-48)/24;
        //        //
        //        ////alert(cell.toFixed(0));
        //    }
        //});
        //
        //$('.bigCalenderBtm .bigCalRight').draggable({
        //    axis: "x",
        //    start: function(){
        //      counts[0]++;  
        //    },
        //    drag: function(e){
        //        $('.bigCalenderTop .bigCalRight').trigger('drag');
        //        counts[1]++;
        //    },
        //    stop: function(e){
        //        counts[2]++;
        //        //alert(counts[1]);
        //        ////var offset  = $(this).offset();
        //        //var w = $('#calendarPan').css('left');
        //        //var c = $('#container').width();
        //        //   
        //        //w = parseInt(w,10);
        //        //   
        //        //var bW = c-w;
        //        ////alert(bW);
        //        //var cell = (bW-48)/24;
        //        //
        //        ////alert(cell.toFixed(0));
        //    }
        //});
        
        
        $('.bigCalenderBtm .bigCalRight').draggable({axis: "x", containment: "bigCalender", cursor: "move", opacity: 0.35});
        $('.bigCalenderTop .bigCalRight').draggable({axis: "x", containment: "bigCalender", cursor: "move", opacity: 0.35});
        
        /* On dragging the top section */
        /* dragstart */
        //$('.bigCalenderTop .bigCalRight').on('dragstart', function() {
        //    $('.bigCalenderBtm .bigCalRight').each(function() {
        //        $(this).trigger('dragstart');
        //    });
        //});
        //
        ///* drag */
        //$('.bigCalenderTop .bigCalRight').on('drag', function() {
        //    var maintop = $(this).css('top');
        //    var mainleft = $(this).css('left');
        //    
        //    $('.bigCalenderBtm .bigCalRight').each(function() {
        //        $(this).trigger('drag');
        //        $(this).addClass('ui-draggable-dragging');
        //        $(this).css('margin-left', mainleft);
        //    });
        //    
        //    $('.bigCalenderBtm .bigCalRight:first').css('margin-top', maintop);
        //});
        //
        //$('.bigCalenderTop .bigCalRight').on('dragstop', function() {
        //    var maintop = $(this).css('top');
        //    var mainleft = $(this).css('left');
        //   
        //    $('.bigCalenderBtm .bigCalRight').each(function() {
        //        $(this).trigger('dragstop');
        //        $(this).removeClass('ui-draggable-dragging');
        //        $(this).css('margin-left', mainleft);
        //    });
        //   
        //   $('.bigCalenderBtm .bigCalRight:first').css('margin-top', maintop);
        //});
        
        /* On dragging the bottom section */
        /* dragstart */
        $('.bigCalenderBtm .bigCalRight').on('dragstart', function() {            
            $('.bigCalenderTop .bigCalRight').each(function() {
                $(this).trigger('dragstart');
            });
        });
        
        /* drag */
        $('.bigCalenderBtm .bigCalRight').on('drag', function() {
            var maintop = $(this).css('top');
            var mainleft = $(this).css('left');
            
            $('.bigCalenderTop .bigCalRight').each(function() {
                $(this).trigger('drag');
                $(this).addClass('ui-draggable-dragging');
                $(this).css('margin-left', mainleft);
            });
            
            $('.bigCalenderTop .bigCalRight:first').css('margin-top', maintop);
        });
        
        $('.bigCalenderBtm .bigCalRight').on('dragstop', function() {
            var maintop = $(this).css('top');
            var mainleft = $(this).css('left');
           
            $('.bigCalenderTop .bigCalRight').each(function() {
                $(this).trigger('dragstop');
                $(this).removeClass('ui-draggable-dragging');
                $(this).css('margin-left', mainleft);
            });
           
           $('.bigCalenderTop .bigCalRight:first').css('margin-top', maintop);
        });
        
        
        
        /* test different actions on .followers */
        $('.bigCalenderBtm .bigCalRight').on('dragstart', function(event, ui) {
            xpos = ui.position.left;
            ypos = ui.position.top;
        });
        
        $('.bigCalenderBtm .bigCalRight').on('drag', function() {
            // do something
        });
        
        $('.bigCalenderBtm .bigCalRight').on('dragstop', function(event, ui) {
     
            // calculate the dragged distance, with the current X and Y position and the "xpos" and "ypos"
            var xmove = ui.position.left - xpos;
            var ymove = ui.position.top - ypos;
      
            // define the moved direction: right, bottom (when positive), left, up (when negative)
            var xd = xmove >= 0 ? 'R' : 'L';
            var yd = ymove >= 0 ? ' Bottom: ' : ' Up: ';
            
            var style=$(this).attr("style");
            var style_arr=style.split(";");
            var left_pos=style_arr[2].split(": ");
            left_position=parseInt(left_pos[1]);
            var index=0;
            if (left_position<0) {
                 left_position=Math.abs(left_position);
                 index=parseInt(left_position/31);
                 
            }
            var val=$(".rowTwo .calDayBox:eq("+index+")").attr("data-item");
            //alert(val);
            
            //alert(index);
            //alert('The DIV was moved,\n\n'+ xd+ xmove+ ' pixels \n'+ yd+ ymove+ ' pixels');
            //var tt = $('.bigCalenderTop .bigCalRight .rowTwo').find('.calDayBox:visible:first').attr('data-item');
            //alert(tt);
        });
    }
    

}(jQuery));



