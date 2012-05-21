<?php

namespace XMB\ForumBundle\Model;

class Thread {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getTopThreads($count = 5) {
        $top = $this->db->executeQuery("
            SELECT t.*, u.* FROM thread AS t
            INNER JOIN users AS u ON (u.id = t.userid)
            ORDER BY t.rating DESC
            LIMIT 0,10
        ", array());
        
        return $thread->fetch();
    } 
    
    public function fetchThread($slug) { 
        $thread = $this->db->executeQuery("
            SELECT t.*, u.*, p.* FROM thread AS t
            INNER JOIN users AS u ON (u.id = t.userid)
            INNER JOIN post AS p ON (t.id = p.threadid)
            WHERE t.id = ?
            ORDER BY t.dateline DESC            
        ", array($slug));
        
        return $thread->fetch();
    }
    
    public function fetchAll($where="") {
        // Get threads
        $threads = $this->db->fetchAll("
            SELECT t.*, t.id AS threadid, f.*, u.* FROM thread AS t
            INNER JOIN users AS u ON (t.userid = u.id)
            INNER JOIN forum AS f ON (t.forumid = f.id)
            $where
            ORDER BY t.dateline DESC
            LIMIT 0,15                      
        ");
        
        return $threads;
    }
     
}