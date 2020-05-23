package com.apps.learnhangeul.service_layer;
import org.opencv.core.Mat;

import android.graphics.Bitmap;
import android.util.Log;

import com.apps.learnhangeul.ModelData;
import com.apps.learnhangeul.StaticData;

import static org.opencv.imgproc.Imgproc.cvtColor;
import static org.opencv.imgproc.Imgproc.erode;
import static org.opencv.imgproc.Imgproc.resize;

public class MyImageExtractor {

    public MyImageExtractor(){}

    public ModelData FindKoreanWord(Bitmap input, ModelData[] data){
        MyImageLibrary lib = new MyImageLibrary();
        Mat test = lib.Preprocess(input);
        double[] bobotTesting = lib.GetBobot(test);

        int smallestDistanceIndex = 0;

        //persiapan penampung hasil jarak sesuai banyaknya jumlah data training
        double[] result = new double[data.length];

        //loop sesuai jumlah maxEpoch
        for (int i = 0; i < data.length ; i++){

            //konversi Data training ke bentuk yang kita mau ( 400x400 dan binary )
            double[] bobotTraining = data[i].getBobot();

            //variable temporary untuk penampung jarak antara
            // training dan testing
            int distance = 0;

            //loop sesuai besar image testing
            for (int x = 0; x < bobotTraining.length; x++){
                result[i] = 0;
                //mengambil nilai pixel image testing dan training
                double testPixel = bobotTesting[x];
                double trainedPixel = bobotTraining[x];
                //menghitung jarak dari train ke testing, lalu ditambahkan ke penampung
                distance += Math.pow((testPixel - trainedPixel), 2);
            }

            //jumlah semua jarak pixel testing dan training diakar kuadrat
            result[i] = Math.sqrt(distance);

        }

        //mengambil index dari array data training yang nilai jaraknya terendah
        smallestDistanceIndex = lib.FindSmallestNumberIndex(result);

        //data training yang sesuai dikembalikan
        return data[smallestDistanceIndex];
    }

    //Panggil ini kalau data training belom ada di db
    public ModelData TrainDataBaru(ModelData input){
        MyImageLibrary lib = new MyImageLibrary();

        Bitmap image = input.getImage();
        //ubah image jadi binary
        Mat trained = lib.Preprocess(image);
        //cari bobot dari image
        input.setBobot(lib.GetBobot(trained));



        //kembalikan set data yang sudah berbobot
        return input;


    }

    //Panggil ini kalau data training uda ada di db
    public ModelData[] TrainDataLama(Bitmap input, ModelData[] data, StaticData[] staticData){
        MyImageLibrary lib = new MyImageLibrary();

        Mat test = lib.Preprocess(input);

        float learning_rate = staticData[0].getLearningRate();
        int max_epoch = staticData[0].getMaxEpoch();
        float min_error = staticData[0].getMinError();

        double[] bobotTesting = lib.GetBobot(test);



        //persiapan penampung hasil jarak sesuai banyaknya jumlah maxEpoch (data.length)
        double[] result = new double[data.length];

        int epoch = 1;
        //loop sesuai jumlah maxEpoch
        while(epoch < max_epoch && learning_rate > min_error){
            int smallestDistanceIndex = 0;
            for (int i = 0; i < data.length ; i++){
                double[] bobotTraining = data[i].getBobot();


                //konversi Data training ke bentuk yang kita mau ( 400x400 dan binary )
                Mat trained = lib.ConvertBitmapToMat(data[i].getImage());

                //variable temporary untuk penampung jarak antara training dan testing
                int distance = 0;

                //loop sesuai besar image testing
                for (int x = 0; x < bobotTraining.length; x++){

                    result[i] = 0;

                    //mengambil nilai pixel image testing dan training
                    double testPixel = bobotTesting[x];
                    double trainedPixel = bobotTraining[x];

                    //menghitung jarak dari train ke testing, lalu ditambahkan ke penampung
                    distance += Math.pow((testPixel - trainedPixel), 2);
                }

                //jumlah semua jarak pixel testing dan training diakar kuadrat
                result[i] = Math.sqrt(distance);

            }

            //mengambil index dari array data training yang nilai jaraknya terendah
            smallestDistanceIndex = lib.FindSmallestNumberIndex(result);

            //data training yang sesuai dikembalikan
            //update bobot ke yang terbaru
            double[] bobotTest = bobotTesting;
            double[] bobotTrain = data[smallestDistanceIndex].getBobot();

            double[] bobotBaru = new double[bobotTrain.length];

            for (int i = 0; i< bobotBaru.length; i++){
                bobotBaru[i] = Math.round(bobotTrain[i] + learning_rate * (bobotTest[i] - bobotTrain[i]));
            }

            data[smallestDistanceIndex].setBobot(bobotBaru);

            learning_rate = learning_rate - ((1/10) * learning_rate);
            epoch++;

        }

        return data;
    }



}
