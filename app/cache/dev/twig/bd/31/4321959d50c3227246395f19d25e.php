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
                    
                    <div class=\"brand\"><a href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_home"), "html", null, true);
        echo "\">Procrasto</a> <small>The simply todo tracker.</small></div>                                        
                    
                    <div class=\"nav-collapse\">
                        <ul class=\"nav\">
                            <li><a href=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_home"), "html", null, true);
        echo "\"><i class=\"icon-home\"></i> Home</a></li>
                            <li><a href=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_registration_register"), "html", null, true);
        echo "\"><i class=\"icon-ok-circle\"></i> Register</a></li>
                            <li><a href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_security_login"), "html", null, true);
        echo "\"><i class=\"icon-user\"></i> Login</a></li>
                            <li><a href=\"#\"><span class=\"badge badge-success\">0</span></a></li>
                        </ul>
                    </div>
                    
                    <span class=\"navbar-text pull-right visible-desktop\" style=\"padding-right: 15px;\">
                        <small>Status: <a href=\"javascript://\" style=\"color: orange;\" rel=\"tooltip\" title=\"Procrasto is currently in beta-testing mode!\">Beta</a></small>
                    </span>
                    
                </div>
            </div>
        </div> 
    </header>
    
    ";
        // line 46
        $this->displayBlock('content', $context, $blocks);
        // line 49
        echo "    
    <footer>
        <div class=\"container\">
            <hr />
            
            <div class=\"pull-right\">
                <a href=\"javascript://\" onclick=\"\$('#privacy-policy').modal()\">Privacy Policy</a>
            </div>
            
            <div class=\"center\">
                &copy; ";
        // line 59
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
        
        <div class=\"modal modal-form fade\" id=\"login-popup\" style=\"display: none;\">            
            <form action=\"";
        // line 75
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_security_check"), "html", null, true);
        echo "\" method=\"post\" class=\"form-horizontal\">
                <div class=\"modal-header\">
                    <button class=\"close\" data-dismiss=\"modal\">&times;</button>
                    <h3>Login</h3>
                </div>
                
                <div class=\"modal-body\">
                    <fieldset>
                        <div class=\"control-group\">
                            <label class=\"control-label\">Email Address:</label>
                            
                            <div class=\"controls\">
                                <input type=\"text\" class=\"input-large\" name=\"email\" placeholder=\"Email\" required=\"required\" />
                            </div>
                        </div>
                        
                        <div class=\"control-group\">
                            <label class=\"control-label\">Password:</label>
                            
                            <div class=\"controls\">
                                <input type=\"password\" class=\"input-large\" name=\"password\" placeholder=\"Password\" required=\"required\" />
                            </div>
                        </div>                     
                    </fieldset>                
                </div>
                
                <div class=\"modal-footer\">
                    <input class=\"btn btn-primary\" type=\"submit\" name=\"submit\" value=\"Login\" />
                </div>
            </form>
        </div>
        
        <!-- JS -->
        <script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 109
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

    // line 46
    public function block_content($context, array $blocks = array())
    {
        // line 47
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
        return array (  183 => 47,  180 => 46,  174 => 5,  157 => 109,  120 => 75,  101 => 59,  89 => 49,  87 => 46,  70 => 32,  66 => 31,  62 => 30,  55 => 26,  37 => 11,  33 => 10,  25 => 5,  19 => 1,);
    }
}
