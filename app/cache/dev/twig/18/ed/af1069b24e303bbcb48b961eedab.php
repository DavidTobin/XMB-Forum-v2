<?php

/* TodoBundle:Default:index.html.twig */
class __TwigTemplate_18edaf1069b24e303bbcb48b961eedab extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("TodoBundle::layout.html.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TodoBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"container\" style=\"text-align: center;\">
        <div class=\"row\">
            <div class=\"span3\">&nbsp;</div>
            <div class=\"span6\">
                <form action=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_beta"), "html", null, true);
        echo "\" method=\"post\" class=\"form-horizontal\">    
                    <fieldset>
                        <legend>Participate in our beta testing!</legend>       
                        
                        <br />
                        
                        ";
        // line 14
        echo $this->env->getExtension('form')->renderWidget($this->getContext($context, "form"));
        echo " <input type=\"submit\" class=\"btn btn-primary\" name=\"_submit\" value=\"Sign Up\" />
                    </fieldset>
                </form>
            </div>
            <div class=\"span3\">&nbsp;</div>
        </div>
    </div>    
";
    }

    public function getTemplateName()
    {
        return "TodoBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 14,  35 => 8,  29 => 4,  26 => 3,);
    }
}
