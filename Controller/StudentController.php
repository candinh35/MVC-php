<?php
session_start();
require_once "./Model/Student.php";
require_once "./Model/Image.php";
require_once "./Helper/Helper.php";
require_once  "./App/core/View.php";
class StudentController
{
    private $student;
    private $image;
    public function __construct()
    {
        $this->student = new Student();
        $this->image = new Image();
    }

    public function index()
    {
        $student = $this->student->getAll();
        View::redirect('student/index', compact('student'));
    }

    public function show($id)
    {
        $student = $this->student->getById($id);
        View::redirect('student/show');
    }

    public function create()
    {
        View::redirect('student/addStudent');
    }

    public function store()
    {
        // kiểm tra validate dữ liệu
        if (Helper::validate($_POST, 'store')) {
            $student = [
                'name' => Helper::validateInput($_POST['name']) ,
                'birthday' => $_POST['birthday'],
                'address' => Helper::validateInput($_POST['address']),
            ];
            $id =  $this->student->create($student);
            if (isset($_FILES['images']['name'])) {
                $this->createImage($id);
            }
            $_SESSION['success'] = "You are create success";

             header('location:student');
        } else {
            $previous_url = str_replace('http://candv.test:86/', '', $_SERVER['HTTP_REFERER']);
            header("Location:$previous_url");
        }
    }

    public function edit($id)
    {
        $student = $this->student->getById($id);
        if ($student) {
            $student['image_urls']  = explode(",", $student['image_urls']);
        }
        View::redirect('student/editStudent', compact('student'));
    }

    public function update($id)
    {
        if (Helper::validate($_POST, 'update')) {
            // pass validate thì sẽ upload tabel student trước 
            $this->student->update($id, $_POST);

            // kiểm tra nếu upload có gửi kèm cả ảnh thì sẽ tiến hành xóa và thêm mới 
            if (isset($_FILES['images']['name']) && $_FILES['images']['name'][0] != null) {
                // lấy dữ liệu ra và xóa nhưng url cũ đi để thêm mới vào
                $images = $this->image->getById($id);
                foreach ($images as $image) {
                    unlink($image['url']);
                }
                $this->image->delete($id);

                // hàm để thêm url mới vào
                $this->createImage($id);
            }
            $_SESSION['success'] = "You are update success";
            header('Location:student');
        } else {
            $previous_url = str_replace('http://candv.test:86/', '', $_SERVER['HTTP_REFERER']);
            header("Location:$previous_url");
        }
    }

    public function delete($id)
    {
        $images = $this->image->getById($id);
        foreach ($images as $image) {
            unlink('./Uploads/'.$image['url']);
        }
        $this->image->delete($id);
        $this->student->delete($id);
        $_SESSION['success'] = "You are delete success";
        $previous_url = str_replace('http://candv.test:86/', '', $_SERVER['HTTP_REFERER']);
        header("Location:$previous_url");
    }

    /**
     * @param $id
     * @return void
     */
    public function createImage($id)
    {
        foreach ($_FILES['images']['name'] as $key => $value) {
            $fileName = $_FILES['images']['name'][$key];
            $fileTmp = $_FILES['images']['tmp_name'][$key];
            $url = Helper::upload($fileName, $fileTmp);
            $image = [
                'student_id' => $id,
                'url' => $url
            ];
            $this->image->create($image);
        }
    }
}
