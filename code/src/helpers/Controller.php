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
                    'message' => 'Vui lòng chọn ảnh'
                ]);
            } else {
                $uploadSource = 'src/uploads/' . $targetDir . '/';
                $targetFile = $uploadSource . basename($image[$data]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                if ($image[$data]["size"] > 5000) {
                    return $this->view($viewPage, [
                        'message' => 'Ảnh quá kích thước, vui lòng chọn ảnh < 5MB'
                    ]);
                }
                if (!in_array($imageFileType, ['jpg', 'png', 'jpeg'])) {
                    return $this->view($viewPage, [
                        'message' => 'Ảnh không đúng định dạng, vui lòng kiểm tra lại'
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
                        'message' => 'Có lỗi xảy ra, vui lòng kiểm tra lại'
                    ]);
                }
            }
        }

        public function model($name)
        {
            $path = self::MODEL_FOLDER_NAME . "/" . $name . ".php";

            require $path;

            $model = ucfirst($name) . "Model";

            return new $model;
        }
    }