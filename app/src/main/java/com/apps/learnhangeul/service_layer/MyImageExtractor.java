package com.apps.learnhangeul.service_layer;
import org.opencv.android.Utils;
import org.opencv.core.Mat;
import org.opencv.core.Point;
import org.opencv.core.Size;
import org.opencv.imgproc.Imgproc;
import android.graphics.Bitmap;

import com.apps.learnhangeul.ModelData;

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

    public MyImageExtractor(){

    }

    public double FindLearningRate(Bitmap input){
        double result = 0;
        //Find
        return result;
    }
    public ModelData FindKoreanWord(Bitmap input, ModelData[] data){
        Mat test = Preprocess(input);


        int smallestDistanceIndex = 0;

        //persiapan penampung hasil jarak sesuai banyaknya jumlah maxEpoch (data.length)
        double[] result = new double[data.length];

        //loop sesuai jumlah maxEpoch
        for (int i = 0; i < data.length ; i++){

            //konversi Data training ke bentuk yang kita mau ( 400x400 dan binary )
            Mat trained = Preprocess(data[i].getImage());

            //variable temporary untuk penampung jarak antara training dan testing
            int distance = 0;

            //loop sesuai besar image testing
            for (int x = 0; x < test.width(); x++){
                for (int y = 0; y < test.height(); y++){
                result[i] = 0;

                //mengambil nilai pixel image testing dan training
                double testPixel = test.get(y, x)[0] / 255;
                double trainedPixel = trained.get(y, x)[0] / 255;

                //menghitung jarak dari train ke testing, lalu ditambahkan ke penampung
                distance += Math.pow((testPixel - trainedPixel), 2);

                }
            }

            //jumlah semua jarak pixel testing dan training diakar kuadrat
            result[i] = Math.sqrt(distance);

        }

        //mengambil index dari array data training yang nilai jaraknya terendah
        smallestDistanceIndex = FindSmallestNumberIndex(result);

        //data training yang sesuai dikembalikan
        return data[smallestDistanceIndex];
    }
    private Mat Preprocess(Bitmap input){
        Mat result = new Mat();
        Size imgBaseSize = new Size(imageSize,imageSize);

        //convert java bitmap to openCV mat
        Utils.bitmapToMat(input.copy(Bitmap.Config.ARGB_8888, true), result);

        //resize to size we want
        resize(result, result, imgBaseSize );

        //transform to gray scale image
        cvtColor(result, result, Imgproc.COLOR_RGB2GRAY);

        //transform image to binary
        threshold(result, result, binaryTreshold, 255, THRESH_BINARY);

        //erode image
        erode(result, result, kernel);

        return result;
    }
    private int FindSmallestNumberIndex(double a[]){
        double minimum;
        int index=0,i=1;
        minimum=a[0];
        while(i<a.length)
        {
            if(minimum>a[i])
            {
                minimum=a[i];
                index=i;
            }
            i++;
        }
        return index;
    }
}
