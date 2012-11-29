
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>EdenPHP Translator - {$title}</title>
    <!-- Le styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="/">EdenPHP Translator</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li {if get(1) == "index"}class="active"{/if}><a href="#">Home</a></li>
              <li {if get(2) == "error"}class="active"{/if}><a href="/trad/error/">Error</a></li>
              <li {if get(2) == "success"}class="active"{/if}><a href="/trad/success/">Success</a></li>
              <li {if get(2) == "text"}class="active"{/if}><a href="/trad/text/">Text</a></li>
              <li {if get(2) == "title"}class="active"{/if}><a href="/trad/title/">Title</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
	    <h1>{$title}</h1>
	    <div class="well well-large">
		    {if isset($page)}
	      		{include file="{$page}.tpl"}
	      	{else}
	      		{include file="404.tpl"}
	      	{/if}
	    </div>

    </div> <!-- /container -->
  </body>
</html>