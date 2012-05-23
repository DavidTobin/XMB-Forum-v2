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
            WHERE t.slug = ? AND p.parentid = 0
            ORDER BY t.dateline DESC            
        ", array($slug));
        
        return $thread->fetch();
    }
    
    public function fetchReplies($thread) {
        $replies = $this->db->executeQuery("
            SELECT u.*, p.* FROM post AS p
            INNER JOIN users AS u ON (u.id = p.userid)
            WHERE p.parentid > 0 AND p.threadid = ?
            ORDER BY p.postdateline ASC
        ", array($thread['threadid']));
        
        return $replies->fetchAll();
    }
    
    public function fetchAll($where="") {
        // Get threads
        $threads = $this->db->fetchAll("
            SELECT t.*, t.id AS threadid, t.slug AS threadslug, f.*, u.* FROM thread AS t
            INNER JOIN users AS u ON (t.userid = u.id)
            INNER JOIN forum AS f ON (t.forumid = f.id)
            $where
            ORDER BY t.lastactivity DESC
            LIMIT 0,15                      
        ");
        
        return $threads;
    }
     
}