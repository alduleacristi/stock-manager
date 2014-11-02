<?php

/* ::visitors.html.twig */
class __TwigTemplate_bcf9876ca0f25b102f324daa82d2ff29d5f798359a2794e6ae2269689e79bf3f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::base.html.twig");

        $this->blocks = array(
            'navbar' => array($this, 'block_navbar'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_navbar($context, array $blocks = array())
    {
        // line 4
        echo "\t<li><a href=\"#\">Login</a></li>
\t<li><a href=\"";
        // line 5
        echo $this->env->getExtension('routing')->getPath(twig_constant("Main\\StockManagerBundle\\Common\\StockManagerRouting::ABOUT_KEY"));
        echo "\">About</a></li>
";
    }

    public function getTemplateName()
    {
        return "::visitors.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 5,  31 => 4,  28 => 3,);
    }
}
