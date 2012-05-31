<?php

namespace XMB\ForumBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpFoundation\Response;

class XMBForumBundle extends Bundle
{        
    public function renderJSON($data) {        
        $response = new Response(json_encode($data));
            
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
    
    public function getParent() {
        return 'FOSUserBundle';
    }
}
