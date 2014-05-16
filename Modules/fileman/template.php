<!DOCTYPE html>
<html>
    <head>
        <title> 2SN </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <!-------- licence --------->
        <script type="text/javascript" src="../libs/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="../libs/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="../libs/js/file_manager.js"></script>
        <script type="text/javascript" src="../libs/js/jquery.fileupload.js"></script>
        <script type="text/javascript" src="../libs/js/jquery.fileupload-jquery-ui.js"></script>
        <script type="text/javascript" src="../libs/js/jquery-1.11.0.js"></script>
        
        <!-------- maison --------->
        <link rel="stylesheet" href="../libs/bootstrap/css/bootstrap.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="../style/style1.css" />
        <link rel="stylesheet" type="text/css" href="../style/file_manager.css" />
		<link rel="stylesheet" type="text/css" href="../libs/css/jquery.fileupload.css" />
		
        <script type="text/javascript">
        
        </script>
    </head>

<body>
	<script>
		$('#cssmenu').prepend('<div id="menu-button">Menu</div>');
		$('#cssmenu #menu-button').on('click', function(){
			var menu = $(this).next('ul');
			if (menu.hasClass('open')) {
				menu.removeClass('open');
			} else {
				menu.addClass('open');
			}
		});
	</script>

<div class="row">
	<div id='cssmenu'>
			<ul>
				<li class='active'><a href='index.html'><span>Home</span></a></li>
				<li class='has-sub'><a href='#'><span>Products</span></a>
				<ul>
				<li class='has-sub'><a href='#'><span>Product 1</span></a>
				<ul>
				<li><a href='#'><span>Sub Item</span></a></li>
				<li class='last'><a href='#'><span>Sub Item</span></a></li>
				</ul>
				</li>
				<li class='has-sub'><a href='#'><span>Product 2</span></a>
				<ul>
				<li><a href='#'><span>Sub Item</span></a></li>
				<li class='last'><a href='#'><span>Sub Item</span></a></li>
				</ul>
				</li>
				</ul>
				</li>
				<li><a href='#'><span>About</span></a></li>
				<li class='last'><a href='#'><span>Contact</span></a></li>
				<li class='last'><a href='deconnect.php'><span>Deconnexion</span></a></li>
			</ul>
	</div>
</div>

