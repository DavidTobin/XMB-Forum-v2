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
        echo "    <div class=\"container\">
        <h1>What is Procrasto?</h1>            
        
        <br />
        
        <div class=\"well\">
            <h2>Procrasto</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nisl nulla, cursus vel congue quis, adipiscing eu augue. Donec nec laoreet enim. Nunc erat sapien, fermentum pellentesque posuere vitae, bibendum at eros. In facilisis lorem sit amet quam scelerisque a faucibus felis ultrices. Vestibulum nisl massa, ultrices egestas cursus id, viverra a ipsum. Sed iaculis accumsan turpis nec accumsan. Fusce sodales varius adipiscing.
            Nunc sed mauris elit. Praesent imperdiet volutpat fermentum. Pellentesque sit amet arcu urna. Cras sit amet dolor sed ligula pulvinar elementum. Proin at urna eros. Fusce consectetur enim a nulla sodales id consectetur nulla pharetra. Pellentesque sagittis ligula vitae justo tristique et facilisis nulla cursus. Nulla sed dolor eget nisl lacinia porta in vel massa. Nunc viverra justo sit amet tellus rutrum ut accumsan nisl semper. Cras lobortis posuere massa. Quisque laoreet egestas leo a ultricies. Mauris pulvinar facilisis purus, congue aliquet mauris cursus in.</p>
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
        return array (  29 => 4,  26 => 3,);
    }
}
