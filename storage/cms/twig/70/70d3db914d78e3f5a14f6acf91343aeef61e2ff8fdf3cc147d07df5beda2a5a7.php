<?php

/* /Users/bauwils/Documents/Local_host/Jacob_hair/themes/jacob_hair/layouts/Home.htm */
class __TwigTemplate_2995a87221b5c7e3154cbcc4de1585273c3c0273bf45bce75b347cd2dd8ab565 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
\t<title>Jacob's Hair</title>
\t<link rel=\"stylesheet\" href=\"/themes/jacob_hair/assets/css/vendor.min.css\">
\t<link rel=\"stylesheet\" href=\"/themes/jacob_hair/assets/css/main.min.css\">
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no\">
</head>
<body>
\t<header>
\t\t<nav>
\t\t  <div class=\"container-fluid\">
\t\t    <!-- Collect the nav links, forms, and other content for toggling -->
\t\t    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
\t\t    <div class=\"navbar-gradient\">
\t\t    \t
\t\t    </div>
\t\t      <ul class=\"nav navbar-nav navbar-absolute\">
\t\t        <li><a href=\"#about\">about</a></li>
\t\t        <li><a href=\"#pricing\">pricing</a></li>
\t\t        <li><a href=\"#portfolio\">portfolio</a></li>
\t\t        <li><a href=\"#\">contact</a></li>
\t\t      </ul>
\t\t    </div><!-- /.navbar-collapse -->
\t\t  </div><!-- /.container-fluid -->
\t\t</nav>
\t</header>
\t<main>
\t
\t\t";
        // line 30
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('CMS')->partialFunction("home/banner"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 31
        echo "
\t\t";
        // line 32
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('CMS')->partialFunction("home/about"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 33
        echo "
\t\t";
        // line 34
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('CMS')->partialFunction("home/pricing"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 35
        echo "
\t\t";
        // line 36
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('CMS')->partialFunction("home/tile"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 37
        echo "
\t\t";
        // line 38
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('CMS')->partialFunction("home/contact"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 39
        echo "
\t\t<section class=\"footer\">
\t\t\t
\t\t</section>

\t</main>

\t<script src=\"http://localhost:35729/livereload.js\"></script>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "/Users/bauwils/Documents/Local_host/Jacob_hair/themes/jacob_hair/layouts/Home.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 39,  78 => 38,  75 => 37,  71 => 36,  68 => 35,  64 => 34,  61 => 33,  57 => 32,  54 => 31,  50 => 30,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/* 	<title>Jacob's Hair</title>*/
/* 	<link rel="stylesheet" href="/themes/jacob_hair/assets/css/vendor.min.css">*/
/* 	<link rel="stylesheet" href="/themes/jacob_hair/assets/css/main.min.css">*/
/* 	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">*/
/* </head>*/
/* <body>*/
/* 	<header>*/
/* 		<nav>*/
/* 		  <div class="container-fluid">*/
/* 		    <!-- Collect the nav links, forms, and other content for toggling -->*/
/* 		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">*/
/* 		    <div class="navbar-gradient">*/
/* 		    	*/
/* 		    </div>*/
/* 		      <ul class="nav navbar-nav navbar-absolute">*/
/* 		        <li><a href="#about">about</a></li>*/
/* 		        <li><a href="#pricing">pricing</a></li>*/
/* 		        <li><a href="#portfolio">portfolio</a></li>*/
/* 		        <li><a href="#">contact</a></li>*/
/* 		      </ul>*/
/* 		    </div><!-- /.navbar-collapse -->*/
/* 		  </div><!-- /.container-fluid -->*/
/* 		</nav>*/
/* 	</header>*/
/* 	<main>*/
/* 	*/
/* 		{% partial 'home/banner' %}*/
/* */
/* 		{% partial 'home/about' %}*/
/* */
/* 		{% partial 'home/pricing' %}*/
/* */
/* 		{% partial 'home/tile' %}*/
/* */
/* 		{% partial 'home/contact' %}*/
/* */
/* 		<section class="footer">*/
/* 			*/
/* 		</section>*/
/* */
/* 	</main>*/
/* */
/* 	<script src="http://localhost:35729/livereload.js"></script>*/
/* </body>*/
/* </html>*/
