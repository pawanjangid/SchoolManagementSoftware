
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-196K4HMZZ5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-196K4HMZZ5');
</script>


<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-icons/entypo/css/entypo.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/core.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/forms.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

<?php
    $skin_colour = $this->db->get_where('settings' , array(
        'type' => 'skin_colour'
    ))->row()->description; 
    if ($skin_colour != ''):?>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/<?php echo $skin_colour;?>.css">

<?php endif;?>

<?php if ($text_align == 'right-to-left') : ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/rtl.css">
<?php endif; ?>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>

        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/vertical-timeline/css/component.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/datatables/responsive/css/datatables.responsive.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/wysihtml5/bootstrap-wysihtml5.css">

<!--Amcharts-->
<script src="<?php echo base_url();?>assets/js/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/gauge.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/funnel.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/radar.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/exporting/amexport.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/exporting/rgbcolor.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/exporting/canvg.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/exporting/jspdf.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/exporting/filesaver.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/amcharts/exporting/jspdf.plugin.addimage.js" type="text/javascript"></script>

<script>
    function checkDelete()
    {
        var chk=confirm("Are You Sure To Delete This !");
        if(chk)
        {
          return true;  
        }
        else{
            return false;
        }
    }
</script>