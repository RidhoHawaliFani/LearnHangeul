<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;

class Welcome extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Agivest_model');
        $this->load->model('Home_model');
        $this->load->model('Email_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->helper('download');
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->library('session');
    }


    public function prosesAddDataTraining()
    {
        $result[] = "";

        $imageNamex = 'no-img.jpg';
        $imageNamex = $this->input->post('imageName');
        $image = $this->input->post('imageSent');

        $nameParsed = str_replace("%","_",$imageNamex);

        

        $path = 'assets/uploaded/'.$nameParsed.'.png';
        

        file_put_contents($path,base64_decode($image));

                $data = array(
                            'filePath' => 'assets/uploaded/'.$nameParsed.'.png'
                        );

                $xxx =$this->Home_model->insertData('data_training' , $data);

            // TUTUP - UPLOAD GAMBAR -----------------------------------------------------------------



            //Menampilkan Array dalam Format JSON
        echo json_encode(array('result'=>"berhasil"));


    }

    public function getNewestItem()
    {
        $result[] = "";

       

        $selectAllShop = $this->Home_model->getSelectData("*","data_training", "ORDER BY idTraining DESC LIMIT 1");
        foreach ($selectAllShop->result() as $row) {
                //Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat 
           

            array_push($result,array(
                "filePath"=> "http://192.168.43.90/pashania/".$row->filePath
                
            ));
        }
            //Menampilkan Array dalam Format JSON
        echo json_encode(array('result'=>$result));


    }

    public function getStaticData()
    {
        $result[] = "";

       

        $selectAllShop = $this->Home_model->getSelectData("*","data_static", "");
        foreach ($selectAllShop->result() as $row) {
                //Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat 
           

            array_push($result,array(
                "maxEpoch"=> $row->maxEpoch,
                "minError"=> $row->minError,
                "learningRate"=> $row->learningRate,
                
            ));
        }
            //Menampilkan Array dalam Format JSON
        echo json_encode(array('result'=>$result));


    }

    public function checkDataFirst()
    {
        $result[] = "";

       

        $selectAllShop = $this->Home_model->getSelectData("*","data_static", "");
        foreach ($selectAllShop->result() as $row) {
                //Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat 
           

            array_push($result,array(
                "dataHere"=> $row->maxEpoch,
                
            ));
        }
            //Menampilkan Array dalam Format JSON
        echo json_encode(array('result'=>$result));


    }
    

    public function updateNewestItem(){

            $result[] = "";
            $idData = "";
            $selectNewestData = $this->Home_model->getSelectData("*","data_training", "ORDER BY idTraining DESC LIMIT 1");
            foreach ($selectNewestData->result() as $row) {
                $idData = $row->idTraining;
            }

        
           $kataKorea = $this->input->post('kataKorea');
           $kataKanji = $this->input->post('kataKanji');
           $artiKata = $this->input->post('artiKata');
           
                             $data = array(
                                'kataKorea' => $kataKorea,
                                'kataKanjiKorea' => $kataKanji,
                                'artiKata' => $artiKata,
                                
                            );
            
                $result = $this->Home_model->updateData('data_training' , $data, "idTraining=$idData");

                echo json_encode(array( "status" => "true"));     
            
        

               
        
    }

public function checkData(){

            $result[] = "";
            $idData = "";

        
           $kataKorea = $this->input->post('kataKorea');
           $kataKanji = $this->input->post('kataKanji');
           $artiKata = $this->input->post('artiKata');
           
            $selectNewestData = $this->Home_model->getSelectData("*","data_training", "WHERE (kataKorea='$kataKorea' and kataKorea!='') or (kataKanjiKorea='$kataKanji' and kataKanjiKorea!='') or (artiKata='$artiKata' and artiKata!='') ORDER BY idTraining DESC");
            
            if ($selectNewestData->result()) {
                echo json_encode(array( "status" => "true"));     
            }else {
                echo json_encode(array( "status" => "false"));     
            }

            
        
    }




    public function getAllItem()
    {
       $result[] = "";
       $simpanBobotHere[] = "";
       $selectAllShop = $this->Home_model->getSelectData("*","data_training", "ORDER BY idTraining ASC");


       
        foreach ($selectAllShop->result() as $row) {
                //Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat 
                
                $idGet = $row->idTraining;

                $getBobot = $this->Home_model->getDataBobotByID("bobot_data_training", "WHERE id_data_training='$idGet'");

                        foreach ($getBobot->result() as $row2) {
                            if ($row->idTraining == $row2->id_data_training) {
                                array_push($simpanBobotHere, array(
                                    "bobot_data_value" =>$row2->bobot
                                ));
                            }
                        }


                        array_push($result,array(
                
                            "kataKanji"=>$row->kataKanjiKorea,
                            "kataKorea"=>$row->kataKorea,
                            "artiKata"=>$row->artiKata,
                            "gambarKanji"=> "http://192.168.43.90/pashania/".$row->filePath,
                            "bobot_array" => $simpanBobotHere
                            
                        ));

                        
            
            //$simpanBobotHere[] = $row->bobot;

            
        }
            //Menampilkan Array dalam Format JSON
        echo json_encode(array('result'=>$result));


    }

    public function insertBobotToNewestItemBackup()
    {
        $result[] = "";
        $idTerbaru = "";
        $kataKorea = json_decode($this->input->post('valueBobot'));
       

        $selectAllShop = $this->Home_model->getSelectData("*","data_training", "ORDER BY idTraining DESC LIMIT 1");
        foreach ($selectAllShop->result() as $row) {
                $idTerbaru = $row->idTraining;
        }

        $i = 0;

        foreach ($kataKorea as $key => $value) {
            $data = array(
                            'bobot' => $value,
                            'id_data_training' => $idTerbaru
                        );

                $xxx =$this->Home_model->insertData('bobot_data_training' , $data);
        }

        // while ($i <= sizeof($kataKorea)) {
            
        //     $data = array(
        //                     'bobot' => $kataKorea,
        //                     'id_data_training' => $idTerbaru
        //                 );

        //         $xxx =$this->Home_model->insertData('bobot_data_training' , $data);

        //     $i++;
        // }


            //Menampilkan Array dalam Format JSON
        echo json_encode(array('result'=>$result));


    }

    public function insertBobotToNewestItem()
    {
        $result[] = "";
        $idTerbaru = "";
        $kataKorea = json_decode($this->input->post('valueBobot'));
       

        //proseshapusdata di table bobot_data_training
        //$query = $this->db->query("TRUNCATE bobot_data_training");

        $selectAllShop = $this->Home_model->getSelectData("*","data_training", "ORDER BY idTraining DESC LIMIT 1");
        foreach ($selectAllShop->result() as $row) {
                $idTerbaru = $row->idTraining;
        }

        $i = 0;
        $data = array();
        foreach ($kataKorea as $key => $value) {
            array_push($data,array(
                            'bobot' => $value,
                            'id_data_training' => $idTerbaru
                        ));

        }

        $xxx =$this->Home_model->insertDataBulk('bobot_data_training' , $data);
            //Menampilkan Array dalam Format JSON
        echo json_encode(array('result'=>$result));


    }
    
}
