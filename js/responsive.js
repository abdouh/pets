
  $(document).ready(function() {
	  
	  
	  function responsive (){
		  
		  var x=$(window).width() ;
		
		if(x>1000){
			$(".ads").show();
			$(".menu_section").width(180);
			$(".menu_section ul.main_menu li .text").width(125);
			$(".content").width(x -595 );
			$(".ads").width(300);
			
			/*social media icons*/
			$(".social_home").css({'width' : '100%' });
			
			
		} else{
			$(".ads").hide();
			$(".menu_section").width(x-32);
			$(".menu_section ul.main_menu li .text").width(x-90);
			$(".content").width(x-32);
			
			/*social media icons*/
			$(".social_home").css({'width' : '49%' , 'float' : 'right'});
		}
		
	  };
	  
	  
	  responsive ();
	  $(window).resize(function() {responsive ();  });
	  
	
  });