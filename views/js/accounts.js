$(document).ready(function() {
	
    /*open accounts light box*/
    $(".account").parent("li").click(function(){
        $(".lighbox_container.accounts").show();
        $(".login").show();
    })
	
	
    /*open search light box*/
    $(".search").parent("li").click(function(){
        $(".lighbox_container.searching").show();
    })
	
    /*close light box*/
    $(".CloseLightBox").click(function(){
        $(this).parent().parent().hide();
        $(this).siblings('form').hide();
    })
	
	
    /*switch to signup*/
    $(".GoToSignup").click(function(){
        $(".signup , .forgetPass , .login").slideUp('slow');
        $(".signup").slideDown('slow');
	
    })
	
    /*switch to login*/
    $(".GoToLogin").click(function(){
        $(".signup , .forgetPass , .login").slideUp('slow');
        $(".login").slideDown('slow');
	
    })
	
	
    /*switch to password recovery*/
    $(".GoForgetPass").click(function(){
        $(".signup , .forgetPass , .login").slideUp('slow');
        $(".forgetPass").slideDown('slow');
	
    })
	
 
});
