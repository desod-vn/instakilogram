<?php
    class Admin extends Controller
    {
        static $post;

        public function __construct()
        {
            self::$post = $this->model('Post');
        }

        public function index()
        {
            $admin = "admin";
            $password = "admin";
            if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                $page = 1;
                $getPage = strpos($_GET['page'], '/');
                if ($getPage) {
                    $page = (int) substr($_GET['page'], $getPage + 1);
                    $page = $page == 0 ? 1 : $page;
                }
                $posts = [];
                $posts = self::$post->getAll("DESC", 32);
                $users = $this->users($page, 10);
                return $this->view('admin.index', [
                    'users' => $users,
                    'posts' => $posts
                ]);
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['email'] == $admin && $_POST['password'] == $password) {
                    $_SESSION['admin'] = true;
                    return $this->backAdmin();
                } else {
                    return $this->view('admin.login', [
                        'error' => 'Không thể truy cập'
                    ]);
                }
            } else {
                return $this->view('admin.login');
            }
        }

        public function users($page, $perPage)
        {
            $users = [];
            $accounts = fopen('account.db', 'r') or die('Unable to open file!');
            while(!feof($accounts)) {
                array_push($users, fgets($accounts));
            }
            fclose($accounts);

            return [
                'data' => array_splice($users, $page * $perPage - $perPage, $perPage),
                'all' => count($users),
                'perPage' => $perPage,
                'currentPage' => $page
            ];
        }

        public function find($id)
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}/", $_POST['password'])) {
                    return $this->view('admin.reset', [
                        'email' => $id,
                        'error' => 'Mật khẩu không hợp lệ, mất khẩu từ 8 đến 20 ký tự chứa ít nhất 1 chữ hoa, 1 chữ thường và 1 ký tự'
                    ]);
                } else {
                    $result = '';
                    $accounts = fopen('account.db', 'r') or die('Unable to open file!');
                    while(!feof($accounts)) {
                        $record = fgets($accounts);
                        if (str_contains($record, 'email=' . $id . ';')) {
                            $account = '';
                            $user = explode(';', $record);
                            $user[3] = 'password=' . password_hash($_POST['password'], PASSWORD_DEFAULT);
                            $account = implode(';', $user);
                            $result .= $account;
                            continue;
                        }
                        $result .= $record;
                    }
                    fclose($accounts);
                    $accounts = fopen('account.db', 'w+') or die('Unable to open file!');
                    fwrite($accounts, $result . "\n");
                    fclose($accounts);
                    
                    return $this->view('admin.reset', [
                        'email' => $id,
                        'message' => 'Đổi mật khẩu thành công'
                    ]);
                }
            } else {
                return $this->view('admin.reset', [
                    'email' => $id
                ]);
            }
        }

        public function create()
        {

        }

        public function update($id)
        {
            
        }

        public function delete($id)
        {
            if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                self::$post->deleteOne($id);
                return $this->backAdmin();
            }
        }
    }