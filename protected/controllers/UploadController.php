<?php

class UploadController extends Controller {
    
    public function actionIndex() {
        // var_dump($_FILES);
        
    }

    public function actionCropAll(){
        
    }

    public function actionRender( $path ) {

        if(!is_file('upload/'.$path)){

            $e  = explode( '/', $path );
            $modelClass = $e[0];
            if(is_file('protected/models/'.$e[0].'.php')){

                $type = $e[1];
                $model = CActiveRecord::model($modelClass);
                $saveName= str_replace($modelClass.'-image-','',$e[2]);
                $saveName = explode('.',$e[2]);
                $file = 'upload/'.str_replace($type.'/', 'full/', $path);
                if(!is_file($file))
                    $file = 'upload/'.str_replace('full/', 'preview/', $path);

                $this->saveFile($model , $file, $type ,$saveName[0] );
                if(is_file($file)){

                    header('Pragma: public');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Content-Transfer-Encoding: binary');
                    header("Content-type: image/png");
                    header('Content-Length ' . filesize(str_replace('full/',($type.'/'),$file)));
                    echo file_get_contents(str_replace('full/',($type.'/'),$file));
                }
                die;
            }else{
                $method = 'action'.ucfirst($e[0]);
                $this->$method();
            }
        }
    }
    public function actionFile() {
        $path = 'upload/tmp/';
        $file = md5(rand(0, 99999) . $_GET['model'] . '-' . $_GET['qqfile']) . '.jpg';
        if (isset($_GET['qqfile'])) {
            $this->saveXhr($path . $file);
        } elseif (isset($_FILES['qqfile'])) {
            $this->saveForm($path . $file);
        }
        // TODO Сделать резайз загруженного изображения с зависимости от модели.
        $model = CActiveRecord::model($_GET['model']);
        $options = $model->options();
        $response = $this->resizeImage($path . $file, $model->options());
        //    print_r($_GET['model']);
        // $filename = $this->saveFile($model,$path.$file);
        $filesize = (int)$_SERVER["CONTENT_LENGTH"];
        $response['success'] = true;
        $response['filesize'] = $filesize;
        echo htmlspecialchars(json_encode($response) , ENT_NOQUOTES);
    }
    function saveXhr($path) {
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        if (isset($_SERVER["CONTENT_LENGTH"])) {
            $size = (int)$_SERVER["CONTENT_LENGTH"];
        } else {
            $size = 0;
        }
        if ($realSize != $size) {
            
            return false;
        }
        $target = fopen($path, "w");
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        
        return true;
    }
    function saveForm($path) {
        if (!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)) {
            
            return false;
        }
        
        return true;
    }
    function resizeImage($filePath, $options, $types = array(
        'sm',
        'full'
    )) {
        if (!is_file($filePath)) 
        return array();
        $pathinfo = pathinfo($filePath);
        Yii::import('application.extensions.image.Image');
        $imageOrig = new Image($filePath);
        $w = $imageOrig->width;
        $h = $imageOrig->height;
        $filePathImage = null;
        
        foreach ((array)$options['images'] as $type => $size) {
            if (!in_array($type, $types)) continue;
            $image = $imageOrig;
            $rt = $w / $h < $size['width'] / $size['height'];
            if ($size['type'] === 'crop') {
                if ($w > $size['width'] || $h > $size['height']) {
                    if ($w > $h) {
                        if ($rt) $image->resize($size['width'], $size['height'], 4);
                        else $image->resize($size['width'], $size['height'], 3);
                        $image->crop($size['width'], $size['height']);
                    } else {
                        if ($rt) $image->resize($size['width'], $size['height'], 4);
                        else $image->resize($size['width'], $size['height'], 3);
                        $image->crop($size['width'], $size['height'], 0);
                    }
                } else {
                    $image->resize($size['width'], $size['height']);
                }
            } else if ($w > $size['width'] || $h > $size['height']) {
                $image->resize($size['width'], $size['height']);
            }
            // echo 'upload/' . $modelClass . $path . '/' . $fileName;
            $filename = $type . '_' . $pathinfo['filename'] . '.' . strtolower($pathinfo['extension']);
            $path = 'upload/tmp/' . $filename;
            if ($type == 'full') $filePathImage = $path;
            $image->save($path);
        }
        $response['fileName'] = $pathinfo['filename'] . '.' . strtolower($pathinfo['extension']);
        $response['filePath'] = $filePathImage;
        unlink($filePath);
        
        return $response;
    }

    public function actionAvatar() {
        $pathinfo = pathinfo($_GET['qqfile']);
        $path = 'upload/tmp/';


        $file = Yii::app()->user->id.'-'.md5(rand(0, 99999) .'-' . $_GET['qqfile']) . '.'.$pathinfo['extension'];
        if (isset($_GET['qqfile'])) {
            $this->saveXhr($path . $file);
        } elseif (isset($_FILES['qqfile'])) {
            $this->saveForm($path . $file);
        }
        $options = array(
            'images' => array(
                'full' => array(
                    'width' => 50,
                    'height' => 50,
                    'type' => 'crop'
                )
            )
        );
        if((int)$_GET['type']===2){
            $options['images']['full']['width']=904;
        }
        $response = $this->resizeImage($path . $file, $options , array(
            'full'
        ));
        
        $filesize = (int)$_SERVER["CONTENT_LENGTH"];
        $response['success'] = true;
        $response['filesize'] = $filesize;        
        echo htmlspecialchars(json_encode($response) , ENT_NOQUOTES);
    }
    public function saveFile($model, $name = null, $resizeType = null,$saveName=null)
    {
        // die;
        $modelClass = get_class($model);

        $tmp = $_POST[$name . '-src'];
        $ActiveR = CActiveRecord::model($modelClass);
        $options = $ActiveR->options();
        $options = $options['images'];
        if($_POST[$name . '-delete']=='1'){
            if(is_array($options)){
                foreach ($options as $type => $size) {
                    $path = '/' . $type;
                    if (is_file('upload/' . $modelClass . $path . '/' . $tmp)) unlink('upload/' . $modelClass . $path . '/' . $tmp);
                }
            }else{
                if (is_file('upload/' . $modelClass . '/' . $tmp)) unlink('upload/' . $modelClass . '/' . $tmp);
            }
            return '';

        }
        if ($name !== null) {
            if (is_file($name)) {
                $path = pathinfo($name);
                $size = getimagesize($name);
                if ($type == null) {
                    switch ($size[2]) {
                        case 1:
                            $type = 'image/gif';
                            break;
                        case 2:
                            $type = 'image/jpeg';
                            break;
                        case 3:
                            $type = 'image/png';
                            break;
                        default:
                            $type = 'image/jpeg';
                    }
                }


                $UPimage = new CUploadedFile($path['basename'], $name, $type, filesize($name), 0);
                $field = 'image';
            } else{
                $field = $name;
                $UPimage = CUploadedFile::getInstance($model, $name);
            }
            // var_dump($UPimage); die;
            if ($UPimage !== NULL) {

                $path = pathinfo($UPimage->name);
//                if($saveName!==null) $id = $saveName;
//                else if($model->id)
//                    $id = $model->id;
//                else
//                    $id = 'temp'.rand(1000,99999);

                $fileName = $saveName .  '.' . strtolower($path["extension"]);
                // if($saveName!==null) $fileName = $saveName;
                // var_dump($fileName);
                // die;
                if (strstr($UPimage->type, 'image')) {// && !strstr($UPimage->type, 'image/gif')
                    Yii::import('application.extensions.image.Image');
                    if (!is_file($name)) {
                        $temp = 'upload/tmp_' . $modelClass . '_' . $fileName;
                        $UPimage->saveAs($temp); // save the uploaded file
                        $imageOrig = new Image($temp);
                    } else {
                        $temp = $name;
                        $imageOrig = new Image($name);
                    }

                    $w = $imageOrig->width;
                    $h = $imageOrig->height;
                    if (is_array($options)) {
                        foreach ($options as $type => $size) {
                            if($resizeType!==null){
                                if($resizeType!==$type) continue;
                            }
                            $image = $imageOrig;
                            $path = '/' . $type;
                            if (!is_dir('upload/' . $modelClass . $path)) {
                                mkdir('upload/' . $modelClass . $path, 0777, true);
                            }
                            $rt = $w/$h < $size['width']/$size['height'];
                            if ($size['type'] == 'crop') {
                                if ($w > $size['width'] || $h > $size['height']) {
                                    if ($w>$h) {
                                        if($rt)
                                            $image->resize($size['width'], $size['height'], 4);
                                        else
                                            $image->resize($size['width'], $size['height'], 3);
                                        $image->crop($size['width'], $size['height']);
                                    } else {
                                        if($rt)
                                            $image->resize($size['width'], $size['height'], 4);
                                        else
                                            $image->resize($size['width'], $size['height'], 3);
                                        $image->crop($size['width'], $size['height'], 0);
                                    }
                                }else{
                                    $image->resize($size['width'], $size['height']);
                                }
                            } else
                                if ($w > $size['width'] || $h > $size['height']) {
                                    $image->resize($size['width'], $size['height']);
                                }
                            $image->save('upload/' . $modelClass . $path . '/' . $fileName);
                        }
                    } else {
                        $imageOrig->save('upload/' . $modelClass . '/' . $fileName); // save the uploaded file
                    }
                    // if(!is_file($name))
                    //     unlink($temp);
                    unset ($image);
                    unset ($imageOrig);
                } else {
                    $UPimage->saveAs('upload/' . $modelClass . '/' . $fileName); // save the uploaded file
                }

                return $fileName;
            } elseif ($_POST[$name . '-src'] != '') {
                return $_POST[$name . '-src'];
            }
        }
        return $tmp;
    }
}

