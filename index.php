<?php
	$navitems = explode( "\n", file_get_contents( "content/index" ) );
	for ( $i = 0; $i < count( $navitems ); $i++ ) $navitems[$i] = explode( "/", $navitems[$i] );
	$content = $navitems[0][0];
	if ( isset( $_GET["content"] ) ) $content = $_GET["content"];
?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>OpenGL</title>
		
		<link rel="shortcut icon" type="image/png" href="media/tag.png" />
		<link rel="stylesheet" type="text/css" href="media/style.css" />
		
		<link rel="stylesheet" href="http://yandex.st/highlightjs/6.1/styles/zenburn.min.css" />
		<script type="text/javascript" src="http://yandex.st/highlightjs/6.1/highlight.min.js"></script>
		<script type="text/javascript">
			// Syntax highlighting
			hljs.initHighlightingOnLoad();
			
			// Disqus
			var disqus_url = "http://open.gl/?content=<?php print( $content ); ?>";
			var disqus_identifier = "<?php print( $content ); ?>";
			
			// Google Analytics
			var _gaq = _gaq || [];
			_gaq.push( [ "_setAccount", "UA-25119105-1" ] );
			_gaq.push( [ "_setDomainName", "open.gl" ] );
			_gaq.push( [ "_setAllowHash", "false" ] );
			_gaq.push( [ "_trackPageview" ] );

			( function()
			{
				var ga = document.createElement( "script" );
				ga.type = "text/javascript";
				ga.async = true;
				ga.src = ( "https:" == document.location.protocol ? "https://ssl" : "http://www" ) + ".google-analytics.com/ga.js";
				var s = document.getElementsByTagName( "script" )[0]; s.parentNode.insertBefore( ga, s );
			} )();
		</script>
	</head>
	
	<body onload="addGLReferenceLinks()">
		<div id="page">
			<div id="nav">
				<ul>
					<?php
						foreach ( $navitems as $navitem )
						{
							if ( $navitem[0] == $content )
								print( '<li class="selected">' . $navitem[1] . '</li>' . "\n" );
							else
								print( '<li><a href="/' . $navitem[0] . '">' . $navitem[1] . '</a></li>' . "\n" );
						}
					?>
				</ul>
			</div>
			
			<div id="content">
				<?php
					include_once( "includes/markdown.php" );
					
					$notfound = !preg_match( "/^[a-z]+$/", $content ) || !file_exists( "content/" . $content . ".md" );
					if ( $notfound )
						print( Markdown( file_get_contents( "content/notfound.md" ) ) );
					else
						print( Markdown( file_get_contents( "content/" . $content . ".md" ) ) );
					
					if ( !$notfound )
					{
				?>
				<hr />
				
				<!-- Disqus comments -->
				<div id="disqus_thread"></div>
				<script type="text/javascript">
					var dsq = document.createElement( "script" );
					dsq.type = "text/javascript";
					dsq.async = true;
					dsq.src = "http://opengl.disqus.com/embed.js";
					document.getElementsByTagName( "head" )[0].appendChild( dsq );
				</script>
				<?php
					}
				?>
			</div>
		</div>
	</body>
</html>