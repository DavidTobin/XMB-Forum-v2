<?php

/* TodoBundle::layout.html.twig */
class __TwigTemplate_bd314321959d50c3227246395f19d25e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\" />
    <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
    <meta name=\"description\" content=\"\" />
    <meta name=\"keywords\" content=\"\" />
        
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/bootstrap.css"), "html", null, true);
        echo "\" />        
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/bootstrap-responsive.min.css"), "html", null, true);
        echo "\" />        
    
    <!--[if lt IE 9]>
      <script src=\"//html5shim.googlecode.com/svn/trunk/html5.js\"></script>
    <![endif]-->
</head>
<body>
    <header>
        <div class=\"navbar navbar-fixed-top\">
            <div class=\"navbar-inner\">
                <div class=\"container-fluid\">
                    <a class=\"btn btn-navbar btn-inverse\" data-toggle=\"collapse\" data-target=\".nav-collapse\">
                        <span class=\"icon-arrow-down\"></span>
                    </a> 
                    
                    <div class=\"brand\">Procrasto <small>The simply todo tracker.</small></div>                                        
                    
                    <div class=\"nav-collapse\">
                        <ul class=\"nav\">
                            <li><a href=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_home"), "html", null, true);
        echo "\">Home</a></li>
                            <li><a href=\"#\">Login</a></li>
                            <li><a href=\"#\">Register</a></li>
                            <li><a href=\"#\">My Account</a></li>
                            <li><a href=\"#\"><span class=\"badge badge-success\">0</span></a></li>
                        </ul>
                    </div>
                    
                    <span class=\"navbar-text pull-right\" style=\"padding-right: 15px;\">
                        <small>Status: <a href=\"javascript://\" style=\"color: orange;\" rel=\"tooltip\" title=\"Procrasto is currently in beta-testing mode!\">Beta</a></small>
                    </span>
                    
                </div>
            </div>
        </div> 
    </header>
    
    ";
        // line 47
        $this->displayBlock('content', $context, $blocks);
        // line 50
        echo "    
    <footer>
        <div class=\"container\">
            <hr />
            
            <div class=\"pull-right\">
                <a href=\"javascript://\" onclick=\"\$('#privacy-policy').modal()\">Privacy Policy</a>
            </div>
            
            <div class=\"center\">
                &copy; ";
        // line 60
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " Procrasto
            </div>                
        </div>
        
        <div class=\"modal fade\" id=\"privacy-policy\" style=\"display: none;\">
            <div class=\"modal-header\">
                <button class=\"close\" data-dismiss=\"modal\">&times;</button>
                <h3>Privacy Policy</h3>
            </div>
            
            <div class=\"modal-body\">
                # PRIVACY POLICY HERE #
            </div>
        </div>
        
        <!-- JS -->
        <script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 77
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
        
        <script type=\"text/javascript\">
            \$(document).ready(function() {
                \$(\"[rel=tooltip]\").tooltip({
                    animation : true,
                    placement : 'bottom'
                });
            });
        </script>
    </footer>
</body>
</html>";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Procrasto";
    }

    // line 47
    public function block_content($context, array $blocks = array())
    {
        // line 48
        echo "    
    ";
    }

    public function getTemplateName()
    {
        return "TodoBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  139 => 48,  136 => 47,  130 => 5,  113 => 77,  93 => 60,  81 => 50,  79 => 47,  59 => 30,  37 => 11,  33 => 10,  25 => 5,  19 => 1,);
    }
}
