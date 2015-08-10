<?php
if (!defined('BASEPATH')) exit('No direct access allowed.');
class MY_Pagination extends CI_Pagination{

    function setAdminPaginationStyle(&$config){
	
		$config['page_query_string'] 	= FALSE;
		$config['display_pages'] 		= TRUE;
		
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		
		$config['cur_tag_open'] = '<b>';
		$config['cur_tag_close'] = '</b>';
		
		$config['num_tag_open'] = '<div>';
		$config['num_tag_close'] = '</div>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<div class="first">';
		$config['first_tag_close'] = '</div>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<div class="last">';
		$config['last_tag_close'] = '</div>';
		
		$config['cur_tag_open'] = '<div class="current" >';
		$config['cur_tag_close'] = '</div>';
		
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<div class="previous">';
		$config['prev_tag_close'] = '</div>';
		
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<div class="next">';
		$config['next_tag_close'] = '</div>';
    }
    
    function setCustomAdminPaginationStyle(&$config){
	
		$config['page_query_string'] 	= FALSE;
		$config['display_pages'] 	= TRUE;
		
		$config['full_tag_open'] = '<ul class="pagination pagination-sm man">';
		$config['full_tag_close'] = '</ul>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="first">';
		$config['first_tag_close'] = '</li>';
		
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="last">';
		$config['last_tag_close'] = '</li>';
		
		
		
		$config['prev_link'] = '&lt;&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		
		$config['cur_tag_open'] = '<li class="active" ><a href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';
		
		
		
		$config['next_link'] = '&gt;&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
    }
    
//    function setCustomAdminPaginationStyle1(&$config){
//	
//		$config['page_query_string'] 	= FALSE;
//		$config['display_pages'] 		= TRUE;
//		
//		$config['full_tag_open'] = '<div class="pagination-panel">';
//		$config['full_tag_close'] = '</div>';
//		
//		
//		
//		$config['num_tag_open'] = '<li>';
//		$config['num_tag_close'] = '</li>';
//		
//		$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
//		$config['prev_tag_open'] = '<a class="btn btn-sm btn-default btn-prev"';
//		$config['prev_tag_close'] = '</a>';
//		
//		$config['cur_tag_open'] = '<input type="text" maxlenght="5" class="pagination-panel-input form-control input-mini input-inline input-sm text-center">';
//		$config['cur_tag_close'] = '</>';
//		
//		
//		
//		$config['next_link'] = '<i class="fa fa-angle-right"></i>';
//		$config['next_tag_open'] = '<a class="btn btn-sm btn-default btn-prev"';
//		$config['next_tag_close'] = '</a>';
//		
//    }
//    
    
    function setFrontendPaginationStyle(&$config){
		
		$config['page_query_string'] 	= FALSE;
		$config['display_pages'] 		= TRUE;
		
		$config['full_tag_open'] = '<div class="pagination_bar">';
		$config['full_tag_close'] = '</div>';
									  
		$config['num_tag_open'] = '<div class="pagi_bar">';
		$config['num_tag_close'] = '</div>';
		
		$config['cur_tag_open'] = '<div class="pagi_bar_active">';
		$config['cur_tag_close'] = '</div>';
		
		$config['first_tag_open'] = '<div class="pagi_bar">';
		$config['first_tag_close'] = '</div>';
		$config['first_link'] = 'Previous';
		
		$config['prev_tag_open'] = '<div class="pagi_bar">';
		$config['prev_tag_close'] = '</div>';
		$config['prev_link'] = 'Previous';
		
		$config['next_tag_open'] = '<div class="pagi_bar">';
		$config['next_tag_close'] = '</div>';
		$config['next_link'] = 'Next';
		
		$config['last_tag_open'] = '<div class="pagi_bar">';
		$config['last_tag_close'] = '</div>';
		$config['last_link'] = 'Next';	
		
    }
    
	function setAlbumPaginationStyle(&$config){
	
		$config['page_query_string'] 	= FALSE;
		$config['display_pages'] 		= TRUE;
		
		$config['full_tag_open'] = '<table border="0" cellspacing="2" cellpadding="0" align="right" width="712"><tr>';
		$config['full_tag_close'] =  '</tr></table>';
									  
		$config['prev_tag_open'] = '<td width="46">';
		$config['prev_tag_close'] = '</td>';
		$config['prev_link'] = lang('prev');
		
		$config['next_tag_open'] = '<td width="620" style="border-color:#020202;"></td><td width="46">';
		$config['next_tag_close'] = '</td>';	
		$config['next_link'] = lang('next');				  
    }
    
    
    
    
    
    
    
    function getPaginationCustom($page_no, $count_property)
    {
	$PER_PAGE_LIMIT=1;
        $pagenum 	= $page_no;
	$total_nums	= $count_property;
	$rowsperpage	= $PER_PAGE_LIMIT;
	$total_pages	= ceil($total_nums/$rowsperpage);
	$first = $prev = $nav = $next = $last = $pagination_html ='';
	
	if($total_nums > $PER_PAGE_LIMIT)
	{
	    $pagination_html = "<div class='pagination'><ul id='paginationLinks'>";
				
	    $range = 5; //NUMBER OF PAGES TO BE SHOWN BEFORE AND AFTER THE CURRENT PAGE NUMBER
			
            //FIRST, PREVIOUS, NEXT, AND LAST LINKS
            if($pagenum>1)
	    {
                $page = $pagenum - 1;
		$first	= '<li class="paginate_class paginateFirst" id="1"><a href="javascript:void(0);">First</a></li> ';
	    }
            if($pagenum<$total_pages)
            {
                $page = $pagenum + 1;
		$last = '<li class="paginate_class paginateLast" id="'.$total_pages.'"><a href="javascript:void(0);">Last</a></li> ';
	    }
	
            //PAGINATION
	    for($page=($pagenum-$range); $page<=($pagenum+$range); $page++)
            {
		if($page>=1 && $page<=$total_pages)
		{
		    if($page == $pagenum)
		    {
                        $nav .= '<li class="current"><span class="current_number">'.$page.'</span></li> ';
		    }
                    else
                    {
                        $nav .= '<li class="paginate_class" id="'.$page.'"><a href="javascript:void(0);">'.$page.'</a></li> ';
                    }
		}
            }
            $pagination_html = $pagination_html.$first . $prev . $nav . $next . $last."</ul></div>";
	}
        
        return $pagination_html;
    }

    function getPaginationCustom123($page_no, $count_property)
    {
	$PER_PAGE_LIMIT=1;
        $pagenum 	= $page_no;
	$total_nums	= $count_property;
	$rowsperpage	= $PER_PAGE_LIMIT;
	$total_pages	= ceil($total_nums/$rowsperpage);
	$first = $prev = $nav = $next = $last = $pagination_html ='';
	
	if($total_nums > $PER_PAGE_LIMIT)
	{
	    $pagination_html = "<div class='pagination'><ul id='paginationLinks'>";
				
	    $range = 5; //NUMBER OF PAGES TO BE SHOWN BEFORE AND AFTER THE CURRENT PAGE NUMBER
			
            //FIRST, PREVIOUS, NEXT, AND LAST LINKS
            if($pagenum>1)
	    {
                $page = $pagenum - 1;
		$first	= '<li class="paginate_class paginateFirst" id="1"><a href="javascript:void(0);">First</a></li> ';
	    }
            if($pagenum<$total_pages)
            {
                $page = $pagenum + 1;
		$last = '<li class="paginate_class paginateLast" id="'.$total_pages.'"><a href="javascript:void(0);">Last</a></li> ';
	    }
	
            //PAGINATION
	    for($page=($pagenum-$range); $page<=($pagenum+$range); $page++)
            {
		if($page>=1 && $page<=$total_pages)
		{
		    if($page == $pagenum)
		    {
                        $nav .= '<li class="current"><span class="current_number">'.$page.'</span></li> ';
		    }
                    else
                    {
                        $nav .= '<li class="paginate_class" id="'.$page.'"><a href="javascript:void(0);">'.$page.'</a></li> ';
                    }
		}
            }
            $pagination_html = $pagination_html.$first . $prev . $nav . $next . $last."</ul></div>";
	}
        
        return $pagination_html;
    }
    
}
?>