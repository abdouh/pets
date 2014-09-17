<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="footer-inner">
        2013 &copy; Metronic by keenthemes.
    </div>
    <div class="footer-tools">
        <span class="go-top">
            <i class="icon-angle-up"></i>
        </span>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->  
<script src="<?= TEMPLATE_URL; ?>plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
<script src="<?= TEMPLATE_URL; ?>plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?= TEMPLATE_URL; ?>plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
<script src="<?= TEMPLATE_URL; ?>plugins/bootstrap/js/bootstrap-rtl.min.js" type="text/javascript"></script>
<script src="<?= TEMPLATE_URL; ?>plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<!--[if lt IE 9]>
<script src="assets/plugins/excanvas.min.js"></script>
<script src="assets/plugins/respond.min.js"></script>  
<![endif]-->   
<script src="<?= TEMPLATE_URL; ?>plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= TEMPLATE_URL; ?>plugins/jquery.blockui.min.js" type="text/javascript"></script>  
<script src="<?= TEMPLATE_URL; ?>plugins/jquery.cookie.min.js" type="text/javascript"></script>
<script src="<?= TEMPLATE_URL; ?>plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<?= get_codes($plugins, 'plugin'); ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?= get_codes($scripts, 'script'); ?>
<!-- END PAGE LEVEL SCRIPTS --> 
<?= $script; ?>
<!-- END JAVASCRIPTS -->