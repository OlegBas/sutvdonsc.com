<?
class lib_SemanticURL
{
    private $url = '';
    public  $dbTable = 'urls';
    private  $result = null;
    private $db;

    function __construct($url)
    {
        global $DB;
        $this->db = $DB;

        $this->url = mysql_real_escape_string($url);
        return $this;
    }

    public function getOptions()
    {
        if(!$this->is()) return null;
        return $this->result['options'];
    }

    public function getModule()
    {
        if(!$this->is()) return null;
        return $this->result['module'];
    }

    public function getId()
    {
        if(!$this->is()) return null;
        return $this->result['id'];
    }

    public function getUrl()
    {
        if(!$this->is()) return null;
        return $this->result['module'];
    }

    public function is()
    {
        if(is_null($this->result) && !$this->result()) return false;
        return true;
    }

    private function result()
    {
        $where = 'url = "'.$this->url.'"';
        //if(is_int($this->url)) $where = 'id = "'.$this->url.'"';

        $sql = 'SELECT * FROM `'.$this->dbTable.'` WHERE '.$where.' LIMIT 1';

        $result = $this->db->query($sql);

        if(!$this->db->num_rows($result)) return false;

        $row = $this->db->fetch_array($result);

        $this->result['id']     =  $row['id'];
        $this->result['url']    =  $row['url'];
        $this->result['options'] =  unserialize($row['options']);

        return true;
    }

    public function insert($options = array())
    {
        $options = serialize($options);
        $options = mysql_real_escape_string($options);

        $sql = 'INSERT INTO `'.$this->dbTable.'` (`id`, `url`, `options`)
                VALUE(NULL, "'.$this->url.'", "'.$options.'" )';


        $result = $this->db->query($sql);
        if($result == 'true') return $this->db->insert_id();
        else return null;
    }

    public function delete()
    {

        $where = 'url = "'.$this->url.'"';

        $sql = 'DELETE FROM `'.$this->dbTable.'` WHERE '.$where.' LIMIT 1';

        $result = $this->db->query($sql);

        if($result == 'true') return true;
        else return false;
    }

    public static function is_url($url,  $param=array())
    {
        $route = new lib_SemanticURL($url);
        $url_id = $param[1]['url_id'];
        if(!$route->is()) return true;

        //редактирование
        if(!is_null($url_id))
        {
            //если был изменен
            if($route->getId() != $url_id) return false;
            //if(!$route->is() && $route->getId() != $url_id) return false;
        }
        elseif($route->is()) return false;

        return true;
    }


}
?>