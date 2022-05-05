<?php
    class Post extends Controller
    {
        static $post;

        public function __construct()
        {
            self::$post = $this->model('Post');
        }

        public function index()
        {

        }

        public function find($id)
        {
           
        }

        public function create()
        {
            if (!isset($_SESSION['email'])) {
                return $this->backHome();
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $storeImageName = $this->storeImage($_FILES, 'image', 'posts', 'home');
                if (is_string($storeImageName)) {
                    $data['description'] = $_POST['description'];
                    $data['src'] = $storeImageName;
                    $data['level'] = $_POST['level'];
                    $data['email'] = $_SESSION['email'];
                    if (self::$post->createOne($data)) {
                        return $this->backHome();
                    }
                }
            } else {
                return $this->view('home', [
                    'error' => 'error',
                ]);
            }
        }

        public function update($id)
        {
            
        }

        public function delete($id)
        {
            
        }
    }