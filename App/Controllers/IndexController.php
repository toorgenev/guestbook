<?php
namespace App\Controllers
{
    use System\Controller as Controller,
        App\Models\Posts as Posts;
    
    class IndexController extends Controller
    {
        /*Render main page with list of posts*/
        public function actionIndex(){
            $posts = Posts::getAll();
            $cnt = Posts::getCount();
            $perPage = Posts::$pageSize;
            echo $this->render('index',true,array('posts'=>$posts, 'cnt'=>$cnt, 'perPage'=>$perPage));
        }

        /*Action for AJAX request, render list of posts based on given params (sort, sort_by, page)*/
        public function actionGet(){
            $sort_by = strtolower($_POST['sort_by']);
            $sort = strtoupper($_POST['sort']);
            $page = (int)$_POST['page'];
            $posts = Posts::getAll(array('sort'=>$sort_by,'sort_type'=>$sort,'page'=>$page));
            $cnt = Posts::getCount();
            $perPage = Posts::$pageSize;
            $postView = $this->render('posts',false,array('posts'=>$posts));
            $pageView = $this->render('pagination',false,array('cnt'=>$cnt, 'perPage'=>$perPage, 'page'=>$page));
            echo json_encode(array(
                'status' => 'ok',
                'posts' => $postView,
                'pagination' => $pageView,
            ));
        }

        /*Add new post to DB or render form for new post*/
        public function actionAdd(){
            $error = '';
            if(isset($_POST['submit'])){
                try{
                    if(empty($_POST['username'])) throw new \Exception('You don\'t fill UserName field');
                    $username = substr($_POST['username'],0,50);

                    if(empty($_POST['email'])) throw new \Exception('You don\'t fill E-mail field');
                    $email = substr($_POST['email'],0,100);
                    if(!preg_match("/^(([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9\-]+)\.[a-zA-Z0-9\-]+)$/",$email)){
                        throw new \Exception('Your E-mail is not valid');
                    }
                    if(Posts::getCountByEmail($email)>0) throw new \Exception('You\'ve already send a comment');

                    if(empty($_POST['homepage'])){
                        $homepage = null;
                    }else{
                        $homepage = substr($_POST['homepage'],0,100);
                    }

                    if(empty($_POST['text'])) throw new \Exception('You don\'t fill CommentText field');
                    $text = $_POST['text'];

                    if(!empty($_FILES['img']['name'])){
                        $pic = Posts::processImage();
                        if(!$pic) throw new \Exception('Can\'t process your picture file');
                    }else{
                        $pic = null;
                    }

                    $res = Posts::add($username,$email,$text,$homepage,$pic);
                    if(!$res) throw new \Exception('Can\'t add your comment. Try again later');

                    header('Location: /');
                    exit();
                } catch (\Exception $e){
                    $error = $e->getMessage();
                }
            }
            echo $this->render('add',true,array('error'=>$error));
        }
    }
}
