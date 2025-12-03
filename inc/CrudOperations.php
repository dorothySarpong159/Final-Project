<?php
require_once './inc/Database.php';
class CrudOperations{
    private $conn;
    private $table_products = "products";

    public function __construct($db){
        $this->conn = $db;
    }

    private function validateProductImage(array $uploadedImg){
        if(empty($uploadedImg['name'])){
            $this->error = "Please upload an image";
            return false;
        }

        $fileName = $uploadedImg['name'];
        $fileTempPath = $uploadedImg['tmp_name'];
        $fileSize = $uploadedImg['size'];
        $fileError = $uploadedImg['error'];

        if($fileError != 0){
        $this->error = "Your file was unable to upload";
        return false;
    }

    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if(!in_array($fileExt, $allowed)){
        $this-> error = "File extenstion must be jpg, jpeg, png or gif";
        return false;
    }

    $maxSize = 2 * 1024 * 1024;
    if($fileSize > $maxSize){
        $this->error = "File size must be less than 2MB";
        return false;
    }

    $newFileName = uniqid('', true) . "." . $fileExt;
    $uploadPath = './img/' . $newFileName;

    if(!move_uploaded_file($fileTempPath, $uploadPath)){
        $this->error = "File upload failed";
        return false;
    }
    return ['success' => true, 'path' => $uploadPath];
    }

     public function createProduct($data){
        if (!isset($_FILES['image_path'])) {
            return ['success' => false, 'message' => 'No image uploaded.'];
        }

        $imageValidation = $this->validateProductImage($_FILES['image_path']);
        if (!$imageValidation['success']) {
            return $imageValidation;
        }
        $image = htmlspecialchars(strip_tags($imageValidation['path']));

        $query = "INSERT INTO " . $this->table_products . "
                SET name=:name,
                    description = :description,
                    price = :price,
                    image_path = :image_path";
        $stmt = $this->conn->prepare($query);

        $name = htmlspecialchars(strip_tags($data['name']));
        $description = htmlspecialchars(strip_tags($data['description']));
        $price = htmlspecialchars(strip_tags($data['price']));

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image_path', $image);

        if($stmt->execute()){
            return ['success' => true, 'message' => 'Product created'];
        }
        return ['success' => false, 'message' => 'Product not created'];
    }

    public function readProducts(){
        $query = "SELECT * FROM " . $this->table_products . " ORDER BY product_id ASC";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function readProduct($id){
        $query = "SELECT * FROM " . $this->table_products . " WHERE product_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
   
    public function updateProduct($id, $data){
        $query = "UPDATE " . $this->table_products . "
                    SET name = :name,
                    description = :description,
                    price = :price,
                    image_path = :image_path
                    WHERE product_id = :id";
        $stmt  = $this->conn->prepare($query);

        $name = htmlspecialchars(strip_tags($data['name']));
        $description = htmlspecialchars(strip_tags($data['description']));
        $price = htmlspecialchars(strip_tags($data['price']));
        $image = htmlspecialchars(strip_tags($data['image_path']));

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image_path', $image);

         if($stmt->execute()){
            if ($stmt->rowCount() > 0) {
                 return ['success' => true, 'message' => 'Record updated successfully.'];
            }
            return ['success' => true, 'message' => 'Record updated successfully, there was no change'];
        }
        return ['success' => false, 'message' => 'Failed to update record.'];
    }

    public function deleteProduct($id){
        $query = "DELETE FROM " . $this->table_products . " WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $clean_id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(1, $clean_id);
        if($stmt->execute()){
            if ($stmt->rowCount() > 0) {
                 return ['success' => true, 'message' => 'Record deleted successfully.'];
            }
            return ['success' => false, 'message' => 'Record not found or already deleted.'];
        }
        return ['success' => false, 'message' => 'Failed to delete record.'];
    }
    }
   
?>