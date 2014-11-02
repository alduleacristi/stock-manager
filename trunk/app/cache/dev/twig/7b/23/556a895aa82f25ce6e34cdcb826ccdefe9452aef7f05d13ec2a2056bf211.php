<?php

/* ::base.html.twig */
class __TwigTemplate_7b23556a895aa82f25ce6e34cdcb826ccdefe9452aef7f05d13ec2a2056bf211 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'navbar' => array($this, 'block_navbar'),
            'sidebar' => array($this, 'block_sidebar'),
            'sidebar_content' => array($this, 'block_sidebar_content'),
            'page_title' => array($this, 'block_page_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
<meta charset=\"utf-8\">
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta name=\"description\" content=\"\">
<meta name=\"author\" content=\"\">
<link rel=\"icon\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("includes/images/stock.ico"), "html", null, true);
        echo "\">

<title>Dashboard Template for Bootstrap</title>

<!-- Bootstrap core CSS -->
<link href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("includes/style/bootstrap.min.css"), "html", null, true);
        echo "\"
\trel=\"stylesheet\">


<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src=\"../../assets/js/ie8-responsive-file-warning.js\"></script><![endif]-->
<script
\tsrc=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("includes/javascript/ie-emulation-modes-warning.js"), "html", null, true);
        echo "\"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
      <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->

<link href=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("includes/style/style.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
</head>
<body>
\t<nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
\t\t<div class=\"container-fluid\">
\t\t\t<div class=\"navbar-header\">
\t\t\t\t<button type=\"button\" class=\"navbar-toggle collapsed\"
\t\t\t\t\tdata-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\"
\t\t\t\t\taria-controls=\"navbar\">
\t\t\t\t\t<span class=\"sr-only\">Toggle navigation</span> <span
\t\t\t\t\t\tclass=\"icon-bar\"></span> <span class=\"icon-bar\"></span> <span
\t\t\t\t\t\tclass=\"icon-bar\"></span>
\t\t\t\t</button>
\t\t\t\t<a class=\"navbar-brand\" href=\"#\">StockManager</a>
\t\t\t</div>
\t\t\t
\t\t\t<div id=\"navbar\" class=\"navbar-collapse collapse\">
\t\t\t\t<ul class=\"nav navbar-nav navbar-right\">
\t\t\t\t";
        // line 47
        $this->displayBlock('navbar', $context, $blocks);
        // line 56
        echo "\t\t\t</div>
\t\t\t
\t\t</div>
\t</nav>
\t<!------------------------------------------------------------------------------------------------------------------------ -->
\t
\t";
        // line 62
        $this->displayBlock('sidebar', $context, $blocks);
        // line 74
        echo "\t<!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
\t<div class=\"col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main\">
\t\t";
        // line 76
        $this->displayBlock('page_title', $context, $blocks);
        // line 79
        echo "
\t\t";
        // line 80
        $this->displayBlock('content', $context, $blocks);
        // line 83
        echo "\t</div>

\t<!------------------------------------------------------------------------------------------------------------------------------------  -->

\t<div class=\"footer\">
\t\t<div class=\"container\">
\t\t\t<p class=\"text-muted\">&copy; StockManager Team 2014</p>
\t\t</div>
\t</div>

\t<script
\t\tsrc=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
\t<script src=\"";
        // line 95
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("javascript/bootstrap.min.js"), "html", null, true);
        echo "'\"></script>
\t<script src=\"";
        // line 96
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("javascript/docs.min.js"), "html", null, true);
        echo "\"></script>
\t<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
\t<script src=\"";
        // line 98
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("javascript/ie10-viewport-bug-workaround.js"), "html", null, true);
        echo "\"></script>
</body";
    }

    // line 47
    public function block_navbar($context, array $blocks = array())
    {
        // line 48
        echo "\t\t\t\t\t<!--  <li><a href=\"#\">Profile</a></li>
\t\t\t\t\t<li><a href=\"#\">Help</a></li> -->
\t\t\t\t</ul>
\t\t\t\t
\t\t\t<!--  \t<form class=\"navbar-form navbar-right\">
\t\t\t\t\t<input type=\"text\" class=\"form-control\" placeholder=\"Search...\">
\t\t\t\t</form> -->
\t\t\t\t";
    }

    // line 62
    public function block_sidebar($context, array $blocks = array())
    {
        // line 63
        echo "  \t <div class=\"col-sm-3 col-md-2 sidebar\">
\t\t<ul class=\"nav nav-sidebar\"> 
\t\t\t";
        // line 65
        $this->displayBlock('sidebar_content', $context, $blocks);
        // line 71
        echo "\t\t</ul>\t\t
\t</div> 
\t";
    }

    // line 65
    public function block_sidebar_content($context, array $blocks = array())
    {
        // line 66
        echo "\t\t\t<!--  <li class=\"active\"><a href=\"#\">Overview</a></li>
\t\t\t<li><a href=\"#\">Reports</a></li>
\t\t\t<li><a href=\"#\">Analytics</a></li>
\t\t\t<li><a href=\"#\">Export</a></li> -->
\t\t\t";
    }

    // line 76
    public function block_page_title($context, array $blocks = array())
    {
        // line 77
        echo "\t\t<h1 class=\"page-header\">Welcome to StockManager</h1>
\t\t";
    }

    // line 80
    public function block_content($context, array $blocks = array())
    {
        // line 81
        echo "\t\t<img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("includes/images/home.jpg"), "html", null, true);
        echo "\" />
\t\t";
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  187 => 81,  184 => 80,  179 => 77,  176 => 76,  168 => 66,  165 => 65,  159 => 71,  157 => 65,  153 => 63,  150 => 62,  139 => 48,  136 => 47,  130 => 98,  125 => 96,  121 => 95,  107 => 83,  105 => 80,  102 => 79,  100 => 76,  96 => 74,  94 => 62,  86 => 56,  84 => 47,  63 => 29,  52 => 21,  42 => 14,  34 => 9,  24 => 1,);
    }
}
