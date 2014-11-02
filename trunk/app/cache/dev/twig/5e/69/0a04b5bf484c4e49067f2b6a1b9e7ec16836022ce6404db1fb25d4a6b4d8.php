<?php

/* MainStockManagerBundle:Pages:about.html.twig */
class __TwigTemplate_5e690a04b5bf484c4e49067f2b6a1b9e7ec16836022ce6404db1fb25d4a6b4d8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::visitors.html.twig");

        $this->blocks = array(
            'sidebar' => array($this, 'block_sidebar'),
            'page_title' => array($this, 'block_page_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::visitors.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_sidebar($context, array $blocks = array())
    {
    }

    // line 7
    public function block_page_title($context, array $blocks = array())
    {
        // line 8
        echo "\t<h1 class=\"page-header\">About StockManager</h1>
";
    }

    // line 10
    public function block_content($context, array $blocks = array())
    {
        // line 11
        echo "<table>
  <tr>
    <td><img src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("includes/images/home.jpg"), "html", null, true);
        echo "\" /></td>
    <td>
    \t<div class=\"panel panel-primary\">
    \t\t<div class=\"panel-heading\">
    \t\t\t<h3 class=\"panel-title\">What is this?</h3>
    \t\t</div>
    \t\t<div class=\"panel-body\">This application is used to manage more easy the stock os a shop.</div>
    \t</div>
\t\t
\t\t
\t</td>
  </tr>
</table>

\t
";
    }

    public function getTemplateName()
    {
        return "MainStockManagerBundle:Pages:about.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 13,  46 => 11,  43 => 10,  38 => 8,  35 => 7,  30 => 4,);
    }
}
