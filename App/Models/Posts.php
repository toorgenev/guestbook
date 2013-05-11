<?php
namespace App\Models
{
    use System\App as App;

    class Posts
    {
        public static $pageSize = 5;

        /*Get all posts from DB based on given params (sort, sort_type, page)*/
        public static function getAll($params = array()){
            $sortable = array('user','email','date');
            if(isset($params['sort'])){
                $sort = strtolower($params['sort']);
                if(!in_array($sort,$sortable)) $sort = 'date';
            }else{
                $sort = 'date';
            }

            $sortType = isset($params['sort_type']) ? $params['sort_type'] : 'DESC';
            $page = (isset($params['page']) && !empty($params['page'])) ? $params['page'] : 1;
            $sql = 'SELECT * FROM `posts`
                    ORDER BY `'. $sort . '` ' . (($sortType==='ASC') ? 'ASC' : 'DESC') . '
                    LIMIT ' . ($page-1)*self::$pageSize . ', ' . self::$pageSize;
            $query = App::get()->db->prepare($sql);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }

        /*Get count or posts in DB (for pagination)*/
        public static function getCount(){
            $query = App::get()->db->prepare('SELECT COUNT(id) AS cnt FROM posts');
            $query->execute();
            $res = $query->fetch(\PDO::FETCH_ASSOC);
            return $res['cnt'];
        }

        /*Add new post record to DB*/
        public static function add($name, $email, $text, $homepage = null, $img = null){
            $sql = 'INSERT INTO posts (user,email,homepage,text,date,photo) VALUES (?, ?, ?, ?, ?, ?)';
            $query = App::get()->db->prepare($sql);
            $query->bindParam(1,$name,\PDO::PARAM_STR);
            $query->bindParam(2,$email,\PDO::PARAM_STR);
            $query->bindParam(3,$homepage);
            $query->bindParam(4,$text,\PDO::PARAM_LOB);
            $query->bindParam(5,time(),\PDO::PARAM_INT);
            $query->bindParam(6,$img);
            $res = $query->execute();
            return $res;
        }

        /*Get post count for specified email.
         * In controoler we check this counter, if count>0 - reject new post*/
        public static function getCountByEmail($email){
            $sql = 'SELECT count(email) AS cnt FROM posts where email= ?';
            $query = App::get()->db->prepare($sql);
            $query->bindParam(1,$email,\PDO::PARAM_STR);
            $query->execute();
            $res = $query->fetch(\PDO::FETCH_ASSOC);
            return $res['cnt'];
        }

        /*Resize loaded image to 320x240px and save to ./www/images folder
         * return: filename for save to DB record
         * TODO: Add js resize for reducing server load
         */
        public static function processImage(){
            $formats = array('jpg','jpeg','gif','png');
            $maxWidth = 320;
            $maxHeight = 240;

            $name = $_FILES['img']['name'];
            $newName = str_replace('.','_',uniqid('im_', true)) . '.jpg';
            
            $path = App::get()->basePath . '/www/images/';
            
            $ext = end(explode('.',$name));
            if(!in_array($ext, $formats)) return false;
            $uploadfile = $_FILES['img']['tmp_name'];
            switch ($ext){
                case 'jpg':
                case 'jpeg':
                    $src = imagecreatefromjpeg($uploadfile);
                    break;
                case 'png':
                    $src = imagecreatefrompng($uploadfile);
                    break;
                case 'gif':
                    $src = imagecreatefromgif($uploadfile);
                    break;
            }
            if(!$src) return false;

            try{
                list($width, $height) = getimagesize($uploadfile);

                if($width > $maxWidth || $height > $maxHeight){
                    $koef = max(array($width/$maxWidth, $height/$maxHeight));
                    $newWidth = round($width/$koef);
                    $newHeight = round($height/$koef);
                    $tmp = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagejpeg($tmp, $path . $newName);
                }else{
                    imagejpeg($src, $path . $newName);
                }
            }catch(Exception $e){
                $newName = false;
            }
            return $newName;
        }
    }
}
