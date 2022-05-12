<?php
    abstract class Controller
    {
        const VIEW_FOLDER_NAME = './src/views';

        const MODEL_FOLDER_NAME = './src/models';

        abstract function index();

        abstract function find($id);

        abstract function create();

        abstract function update($id);

        abstract function delete($id);

        public function view($path, $data = [])
        {
            foreach($data as $key => $value) {
                $$key = $value;
            }

            $view = self::VIEW_FOLDER_NAME . "/" . str_replace(".", "/", $path) . ".deo.php";

            return require $view;
        }

        public function storeImage($image, $data, $targetDir, $viewPage)
        {
            if ($image[$data]['error']) {
                return $this->view($viewPage, [
                    'message' => 'Please choose an image'
                ]);
            } else {
                $uploadSource = 'src/uploads/' . $targetDir . '/';
                if (!file_exists($uploadSource)) {
                    mkdir($uploadSource, 0777, true);
                }
                $targetFile = $uploadSource . basename($image[$data]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                if ($image[$data]["size"] > 500000) {
                    return $this->view($viewPage, [
                        'message' => 'Image is too big, please choose <5MB'
                    ]);
                }
                if (!in_array($imageFileType, ['jpg', 'png', 'jpeg'])) {
                    return $this->view($viewPage, [
                        'message' => 'The image is not in the correct format, please check again'
                    ]);
                }
                while (file_exists($targetFile)) {
                    $originFileType = '.' . $imageFileType;
                    $targetFile = str_replace($originFileType, '-' . rand() . $originFileType,  $targetFile);
                }
                if (move_uploaded_file($image[$data]["tmp_name"], $targetFile)) {
                    return $targetFile;
                } else {
                    return $this->view($viewPage, [
                        'message' => 'An error occurred, please check again'
                    ]);
                }
            }
        }

        public function backHome($path = '') {
            header('Location: /home/' . $path);
            die();
        }

        public function backAdmin($path = '') {
            header('Location: /admin/' . $path);
            die();
        }

        public function findUser($id)
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
            return isset($user[1]) ? (str_replace('lastname=', '', $user[1]) . ' ' . str_replace('firstname=', '', $user[2])) : null;
        }

        public function model($name)
        {
            $path = self::MODEL_FOLDER_NAME . "/" . $name . ".php";

            require $path;

            $model = ucfirst($name) . "Model";

            return new $model;
        }
    }