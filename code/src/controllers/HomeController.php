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

        public function register()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $storeImageName = $this->storeImage($_FILES, 'avatar', 'avatars', 'auth.register');
                if (is_string($storeImageName)) {
                    return $this->createUser($_POST, $storeImageName);
                }
            } else {
                return $this->view('auth.register', []);
            }
        }

        public function login()
        {
            return $this->view('auth.login', []);
        }

        public function createUser($data, $avatar)
        {
            $data['avatar'] = $avatar;
            $validate = $this->validateUser($data);
            if ($validate == 'validated') {
                $data['email'] = strtolower($data['email']);
                $accounts = fopen('account.db', 'a+') or die('Unable to open file!');
                $isEmailExist = false;
                while(!feof($accounts)) {
                    if (str_contains(fgets($accounts), $data['email'])) {
                        $isEmailExist = true;
                        return $this->view('auth.register', [
                            'message' => 'Địa chỉ email này đã được đăng ký tài khoản'
                        ]);
                    }
                }
                if (!$isEmailExist) {
                    $account = '';
                    foreach ($data as $key => $value) {
                        $account .= $key . '=' . $value . ';';
                    }
                    fwrite($accounts, $account . "\n");
                }
                fclose($accounts);
            } else {
                return $this->view('auth.register', [
                    'message' => $validate
                ]);
            }
        }

        public function validateUser($user)
        {
            foreach ($user as $property) {
                if (trim($property) == '') {
                    return 'Vui lòng nhập đầy đủ thông tin';
                }
            }
            if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                return 'Địa chỉ email không hợp lệ';
            }
            return 'validated';
        }

        public function find($id)
        {

        }

        public function create()
        {
            
        }

        public function update($id)
        {
            
        }

        public function delete($id)
        {
            
        }
    }