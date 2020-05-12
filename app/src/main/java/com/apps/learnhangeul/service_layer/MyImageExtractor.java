package com.apps.learnhangeul.service_layer;
import org.opencv.android.Utils;
import org.opencv.core.Mat;
import org.opencv.core.Point;
import org.opencv.core.Rect;
import org.opencv.core.Size;
import org.opencv.imgproc.Imgproc;
import android.graphics.Bitmap;
import android.graphics.Color;

import com.apps.learnhangeul.ModelData;
import com.apps.learnhangeul.ModelTraining;
import com.apps.learnhangeul.StaticData;

import java.util.Arrays;

import static org.opencv.imgproc.Imgproc.THRESH_BINARY;
import static org.opencv.imgproc.Imgproc.cvtColor;
import static org.opencv.imgproc.Imgproc.erode;
import static org.opencv.imgproc.Imgproc.resize;
import static org.opencv.imgproc.Imgproc.threshold;

public class MyImageExtractor {
    //Configurations adjust this to your liking
    private final int erodeAmount = 1;
    private final int binaryTreshold = 127;
    private final int imageSize = 400;

    //Do not change this
    private final Mat kernel = Imgproc.getStructuringElement(Imgproc.CV_SHAPE_RECT,
            new Size(2 * erodeAmount + 1, 2 * erodeAmount + 1),
            new Point(erodeAmount, erodeAmount));

    public MyImageExtractor(){}

    public ModelData FindKoreanWord(Bitmap input, ModelData[] data, StaticData[] values){
        MyImageLibrary lib = new MyImageLibrary();
        Mat test = lib.Preprocess(input);


        int smallestDistanceIndex = 0;

        //persiapan penampung hasil jarak sesuai banyaknya jumlah maxEpoch (data.length)
        double[] result = new double[data.length];

        //loop sesuai jumlah maxEpoch
        for (int i = 0; i < data.length ; i++){

            //konversi Data training ke bentuk yang kita mau ( 400x400 dan binary )
            Mat trained = lib.ConvertBitmapToMat(data[i].getImage());

            //variable temporary untuk penampung jarak antara training dan testing
            int distance = 0;

            //loop sesuai besar image testing
            for (int x = 0; x < test.width(); x++){
                for (int y = 0; y < test.height(); y++){
                result[i] = 0;

                //mengambil nilai pixel image testing dan training
                double testPixel = test.get(y, x)[0];
                double trainedPixel = trained.get(y, x)[0];

                //menghitung jarak dari train ke testing, lalu ditambahkan ke penampung
                distance += Math.pow((testPixel - trainedPixel), 2);

                }
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
        Mat trained = lib.Preprocess(image);
        input.setBobot(lib.GetBobot(trained));
        return input;
    }
    //Panggil ini kalau data training uda ada di db
    public ModelData[] TrainDataLama(Bitmap input, ModelData[] data, StaticData[] staticData){
        MyImageLibrary lib = new MyImageLibrary();

        float learning_rate = staticData[0].getLearningRate();
        int max_epoch = staticData[0].getMaxEpoch();
        float min_error = staticData[0].getMinError();

        Mat test = lib.Preprocess(input);

        Mat[] trainedData = new Mat[data.length];

        int smallestDistanceIndex = 0;

        //persiapan penampung hasil jarak sesuai banyaknya jumlah maxEpoch (data.length)
        double[] result = new double[data.length];

        int epoch = 0;
        //loop sesuai jumlah maxEpoch
        while(epoch < max_epoch && learning_rate > min_error){
            for (int i = 0; i < data.length ; i++){


                //konversi Data training ke bentuk yang kita mau ( 400x400 dan binary )
                Mat trained = lib.ConvertBitmapToMat(data[i].getImage());

                trainedData[i] = trained;
                //variable temporary untuk penampung jarak antara training dan testing
                int distance = 0;

                //loop sesuai besar image testing
                for (int x = 0; x < test.width(); x++){
                    for (int y = 0; y < test.height(); y++){
                        result[i] = 0;

                        //mengambil nilai pixel image testing dan training
                        double testPixel = test.get(y, x)[0];
                        double trainedPixel = trained.get(y, x)[0];

                        //menghitung jarak dari train ke testing, lalu ditambahkan ke penampung
                        distance += Math.pow((testPixel - trainedPixel), 2);

                    }
                }

                //jumlah semua jarak pixel testing dan training diakar kuadrat
                result[i] = Math.sqrt(distance);

            }

            //mengambil index dari array data training yang nilai jaraknya terendah
            smallestDistanceIndex = lib.FindSmallestNumberIndex(result);

            //data training yang sesuai dikembalikan
            //update bobot ke yang terbaru
            double[] bobotTest = lib.GetBobot(trainedData[smallestDistanceIndex]);
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
