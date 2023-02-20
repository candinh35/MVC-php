<?php

class Helper
{
    public static function upload($fileName, $fileTmp)
    {
        // lấy đường dẫn thư mục lưu trữ file
        $dir =  date('m') . "-" . date('y');
        $uploads = "./Uploads/";
        if (!file_exists($uploads.$dir) && !is_file($uploads.$dir)) {
            mkdir($uploads.$dir);
        }
        // lấy tên của image
        $imgName = time() . $fileName;
        // lấy đường dẫn tạm của image
        $image = $dir . '/' . $imgName;

        move_uploaded_file($fileTmp, $uploads.$image);
        return $image;
    }
    public static function validate($data, $method): bool
    {
        // kiểm tra xem có tồn tại giá trị không
        if (empty($data['name']) || empty($data['birthday']) || empty($data['address'])) {
            $_SESSION['error'] = 'Please fill in all required fields.';
            return false;
        }
        // kiểm tra nếu tạo mới thì phải thêm cả ảnh
        if ($method == 'store') {
            if (isset($_FILES['images']['name']) && !$_FILES['images']['name'][0] != null) {
                $_SESSION['error'] = 'Please fill in files required fields.';
                return false;
            }
        }
        return true;
    }
    public static function validateInput($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
