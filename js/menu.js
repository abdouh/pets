

  $(document).ready(function() {
	  
	  /*menu resposive elements*/
	  function resp_menu(){
	  var y=$(window).width() ;
	  
	  	if(y>1000){
			$(".menu_trigger").hide();
			$("ul.main_menu li").not(".menu_trigger").show();
		} else{
			$(".menu_trigger").show();
			$("ul.main_menu li").not(".menu_trigger").hide();		
		}
	  };
	  
	   resp_menu();
	   $(window).resize(function() {resp_menu ();
	   });
	   
	   
		$("ul.main_menu li.menu_trigger").click(function(){
		var c=$(window).width() ;
			if(c<1000){
			$("ul.main_menu li").not(".menu_trigger").toggle();
			}
		});
		/*menu resposive elements*/
				
				
				 
	  
	   /*showing sub1 menu*/
	  $("ul.main_menu>li").click(function(){		  
	  
		  $("ul.main_menu>li").not(this).next('ul.sub_menu1').hide();
		  if( $(this).next('ul.sub_menu1').is(':hidden') ){
		  $(this).next('ul.sub_menu1').show(90);
		  } else {
			  $(this).next('ul.sub_menu1').hide(90);
		  }

	  })
	  
	  
	  $("ul.sub_menu1>li").click(function(){
		  
		  $("ul.sub_menu1>li").not(this).next('ul.sub_menu2').hide();
		  if( $(this).next('ul.sub_menu2').is(':hidden') ){
		  $(this).next('ul.sub_menu2').show(90);
		  } else {
			  $(this).next('ul.sub_menu2').hide(90);
		  }

	  })
	  
	  
	   $("ul.sub_menu2>li").click(function(){
		   
		  $("ul.sub_menu2>li").not(this).next('ul.sub_menu3').hide();
		  if( $(this).next('ul.sub_menu3').is(':hidden') ){
		  $(this).next('ul.sub_menu3').show(90);
		  } else {
			  $(this).next('ul.sub_menu3').hide(90);
		  }

	  })
	  
});
