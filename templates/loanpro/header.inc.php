<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface no-generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" style=""><!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->core->getTitle(); ?></title>

<link rel="icon" type="image/png" href="<?php echo $this->core->conf['conf']['path']; ?>/templates/loanpro/images/apple-touch-icon-144x144-precomposed.png">
<link rel="apple-touch-startup-image" href="<?php echo $this->core->conf['conf']['path']; ?>/templates/loanpro/images/splash-screen-320x460.png" media="screen and (max-device-width: 320px)" />
<link rel="apple-touch-startup-image" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" href="<?php echo $this->core->conf['conf']['path']; ?>/templates/loanpro/images/splash-screen-640x920.png" />
<link rel="apple-touch-icon" href="<?php echo $this->core->conf['conf']['path']; ?>/templates/loanpro/images/apple-touch-icon-57x57-precomposed.png" />
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->core->conf['conf']['path']; ?>/templates/loanpro/images/apple-touch-icon-72x72-precomposed.png" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->core->conf['conf']['path']; ?>/templates/loanpro/images/apple-touch-icon-114x114-precomposed.png" />
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $this->core->conf['conf']['path']; ?>/templates/loanpro/images/apple-touch-icon-144x144-precomposed.png" />






<?php 
echo $this->cssFiles;
echo $this->jsFiles; 

if(isset($this->jsConflict)){
	echo'<script type="text/javascript">
		jQuery.noConflict();
	</script>';
}
?>

</head>
<body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]--> 

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container" style=" display: flex; flex-direction: row; width: 80% ; margin: auto; ">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" style="width: 5%"; href="<?php echo $this->core->conf['conf']['path']; ?>">
					<img style="width: 90%;" src="<?php echo $this->core->fullTemplatePath; ?>/images/header.png" class="logo" /></a><h1  align="center" style="text-align: center; vertical-align: middle; color: white; line-height:45px;">  NIPA</h1>
               

                    <!-- Searchbar begin -->
                  <form id="namesearch" name="namesearch" method="get" action="<?php echo $this->core->conf['conf']['path'] . '/information/barsearch '?>">
                    <div style="width:50%; flex-direction: row;border-radius: 20px; background-color: white; flex-direction: row; float: right; overflow: auto; margin-top: 6px ">

                     <button type="submit" style="width: 12%; float: right; background: none; border:none; margin: auto; line-height: 40px; margin-right: 5%;"><img src="<?php echo $this->core->fullTemplatePath; ?>/images/magnifying-glass.png" style="width: 80%; border-color: none; background-color: white;" value="<?php echo $this->core->translate("Open Record"); ?>" ></button>
                    
                    <input style="border:none; width:70%; float: right; margin: auto; line-height: 30px;" class="submit" id="studentfirstname" type="search" name="searchItem" placeholder="Search" required />

                    </div>
                   </form>
              `      <!--searchbar end -->

				</div>
			</div>
		</div>
<div class="bodywrapper">
<div class="bodycontainer">
		<br>
		<br>
		<br>
		<br>

 <!--                   
					<div class="nav-collapse collapse">
                        <ul class="nav pull-left">
<body>
<div class="bodywrapper">
<div class="bodycontainer">

 <div class="headercenter">
<div style="float: left; margin-top: 3px;">
<a href="<?php //echo $this->core->conf['conf']['path']; ?>">
<img src="<?php //echo $this->core->fullTemplatePath; ?>/images/header.png" class="logo" /></a>
</a></div>

<div style="float: left; font-size: 22pt; color: #333; margin-top: 30px; margin-left: 0px; ">AviPlat<div style="font-size: 13pt">INFORMATION SYSTEM</div></div>
</div>-->
