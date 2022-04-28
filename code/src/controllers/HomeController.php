<?php
    class Home extends Controller
    {

        static $user;

        public function __construct()
        {
            self::$user = $this->model('User');
        }

        public function index()
        {
            return $this->view('home', []);
        }

        public function find($id)
        {
            $data = self::$user->getOne($id);

            return $this->view('home', [
                'masage' => $data,
            ]);
        }

        public function create()
        {
            $mesage = "";

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $data = [
                    'name' => 'Bán hàng',
                ];

                if(self::$user->createOne($data))
                    $mesage = "Thành công";
                else
                    $mesage = "Thất bại";
            }

            return $this->view('home', [
                'masage' => $mesage,
            ]);
        }

        public function update($id)
        {
            $mesage = "";

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $data = [
                    'name' => 'Bán hàng',
                ];

                if(self::$user->createOne($data))
                    $mesage = "Thành công";
                else
                    $mesage = "Thất bại";
            }

            return $this->view('home', [
                'masage' => $mesage,
            ]);
        }

        public function delete($id)
        {
            $mesage = "";

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $data = [
                    'name' => 'Bán hàng',
                ];

                if(self::$user->createOne($data))
                    $mesage = "Thành công";
                else
                    $mesage = "Thất bại";
            }

            return $this->view('home', [
                'masage' => $mesage,
            ]);
        }

    }