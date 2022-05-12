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
                    'error' => 'Email or password wrong. Please try again.'
                ]);
            } else {
                return $this->view('auth.login');
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
                    $this->update($storeImageName);
                    return $this->view('auth.user', [
                        'message' => 'Change avatar success'
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
                            'error' => 'This email address is already registered'
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
                    'message' => 'Successful account registration. Please log in with the information you just registered'
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
                    return 'Please enter full information';
                }
            }
            if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                return 'Email address is not valid';
            }
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}/", $user['password'])) {
                return 'Invalid password, password between 8 and 20 characters. Password contains at least 1 uppercase letter, 1 lowercase letter and 1 character';
            }
            return 'validated';
        }

        public function update($id)
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

        public function find($id)
        {
            $account = '';
            $accounts = fopen('account.db', 'r') or die('Unable to open file!');
            while(!feof($accounts)) {
                $record = fgets($accounts);
                if (str_contains($record, 'email=' . $id . ';')) {
                    $account = $record;
                    break;
                }
            }            
            fclose($accounts);

            $user = explode(';', $account);
            return $user[1] . ' ' . $user[2];
        }

        public function delete($id)
        {
            
        }
    }