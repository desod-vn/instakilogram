<?php
    class Home extends Controller
    {
        static $post;

        public function __construct()
        {
            self::$post = $this->model('Post');
        }

        public function index()
        {
            $posts = [];
            $where = '';
            if (isset($_SESSION['email'])) {
                $where = "level IN ('public', 'logged') OR email='" . $_SESSION['email'] ."'";
            } else {
                $where = "level='public'";
            }
            $posts = self::$post->getAllWhere("DESC", 32, $where);

            return $this->view('home', [
                'posts' => $posts
            ]);
        }

        public function register()
        {
            if (isset($_SESSION['email'])) {
                return $this->backHome();
            }
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
            if (isset($_SESSION['email'])) {
                return $this->backHome();
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = strtolower($_POST['email']);
                $password = $_POST['password'];
                $accounts = fopen('account.db', 'r') or die('Unable to open file!');
                while(!feof($accounts)) {
                    $record = fgets($accounts);
                    if (str_contains($record, 'email=' . $email . ';')) {
                        $storeUser = explode(';', $record);
                        $hashPassword = str_replace('password=', '', $storeUser[3]);
                        if (password_verify($password, $hashPassword)) {
                            $this->saveUser($storeUser);
                            return $this->backHome();
                        }
                    }
                }
                fclose($accounts);
                return $this->view('auth.login', [
                    'error' => 'Thông tin địa chỉ email hoặc mật khẩu không chính xác'
                ]);
            } else {
                return $this->view('auth.login', []);
            }
        }

        public function logout() {
            session_destroy();
            $this->backHome();
        }

        public function user()
        {
            if (!isset($_SESSION['email'])) {
                return $this->backHome();
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $storeImageName = $this->storeImage($_FILES, 'avatar', 'avatars', 'auth.user');
                if (is_string($storeImageName)) {
                    $this->find($storeImageName);
                    return $this->view('auth.user', [
                        'message' => 'Thay đổi ảnh đại diện thành công'
                    ]);
                }
            } else {
                return $this->view('auth.user');
            }
        }

        public function saveUser($data)
        {
            foreach ($data as $value) {
                if (isset($value)) {
                    $userProperty = explode('=', $value);
                    $_SESSION[$userProperty[0]] = isset($userProperty[1]) ? $userProperty[1] : '';
                }
            }
        }

        public function createUser($data, $avatar)
        {
            $data['avatar'] = $avatar;
            $validate = $this->validateUser($data);
            if ($validate == 'validated') {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $data['email'] = strtolower($data['email']);
                $accounts = fopen('account.db', 'a+') or die('Unable to open file!');
                $isEmailExist = false;
                while(!feof($accounts)) {
                    if (str_contains(fgets($accounts), 'email=' . $data['email'] . ';')) {
                        $isEmailExist = true;
                        unlink($avatar);
                        return $this->view('auth.register', [
                            'error' => 'Địa chỉ email này đã được đăng ký tài khoản'
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
                
                return $this->view('auth.register', [
                    'message' => 'Đăng ký tài khoản thành công. Vui lòng đăng nhập theo các thông tin bạn vừa đăng ký'
                ]);
            } else {
                unlink($avatar);
                return $this->view('auth.register', [
                    'error' => $validate
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
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}/", $user['password'])) {
                return 'Mật khẩu không hợp lệ, mất khẩu từ 8 đến 20 ký tự chứa ít nhất 1 chữ hoa, 1 chữ thường và 1 ký tự';
            }
            return 'validated';
        }

        public function find($id)
        {
            $_SESSION['avatar'] = $id;
            $result = '';
            $accounts = fopen('account.db', 'r') or die('Unable to open file!');
            while(!feof($accounts)) {
                $record = fgets($accounts);
                if (str_contains($record, 'email=' . $_SESSION['email'] . ';')) {
                    $account = '';
                    foreach ($_SESSION as $key => $value) {
                        if ($value != '') {
                            $account .= $key . '=' . $value . ';';
                        }
                    }
                    $result .= $account;
                    continue;
                }
                $result .= $record;
            }
            
            fclose($accounts);
            $accounts = fopen('account.db', 'w+') or die('Unable to open file!');
            fwrite($accounts, $result . "\n");
            fclose($accounts);
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