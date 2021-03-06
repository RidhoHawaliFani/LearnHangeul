package com.apps.learnhangeul.service_layer;

import android.graphics.Bitmap;
import android.util.Log;

import org.opencv.android.Utils;
import org.opencv.core.Mat;
import org.opencv.core.Rect;
import org.opencv.core.Size;
import org.opencv.imgproc.Imgproc;

import static org.opencv.imgproc.Imgproc.THRESH_BINARY;
import static org.opencv.imgproc.Imgproc.cvtColor;
import static org.opencv.imgproc.Imgproc.resize;
import static org.opencv.imgproc.Imgproc.threshold;

public class MyImageLibrary {

    private final int binaryTreshold = 127;
    private final int imageSize = 200;


    public MyImageLibrary(){

    }

    public double[] GetBobot(Mat output){
        double[] result = new double[output.rows()*output.cols()];
        int i = 0;
        for (int x = 0; x < output.rows(); x++) {
            for (int y = 0; y < output.cols(); y++) {
                result[i] = output.get(x, y)[0];

                i++;
            }

        }



        return result;
    }

    public Mat ConvertBitmapToMat(Bitmap input){
        Mat result = new Mat();

        Utils.bitmapToMat(input.copy(Bitmap.Config.ARGB_8888, true), result);
        return result;
    }
    public Mat Preprocess(Bitmap input){
        Mat result = new Mat();
        Size imgBaseSize = new Size(imageSize,imageSize);

        //convert java bitmap to openCV mat
        Utils.bitmapToMat(input.copy(Bitmap.Config.ARGB_8888, true), result);

        //transform to gray scale image
        cvtColor(result, result, Imgproc.COLOR_RGB2GRAY);

        //transform image to binary
        threshold(result, result, binaryTreshold, 1, THRESH_BINARY);

        //segmentasi + ROI
        int x, y, width, height = 0;
        int[] topLeftPixel = FindTopLeftPixel(result);
        int[] botRightPixel = FindBotRightPixel(result);

        x = topLeftPixel[0];
        y = topLeftPixel[1];
        width = (botRightPixel[0] - topLeftPixel[0]);
        height = (botRightPixel[1] - topLeftPixel[1]);

        Rect roi = new Rect(x, y , width , height);
        result = new Mat(result, roi);

        //resize to size we want
        resize(result, result, imgBaseSize );


        //erode image
        //erode(result, result, kernel);

        return result;
    }
    public int[] FindBotRightPixel(Mat input){

        int[] result = new int[2];
        for (int x = input.rows()-1; x >= 0 ; x--) {
            for (int y = input.cols()-1; y >= 0; y--) {
                if (input.get(x, y)[0] == 0){
                    result[0] = x;
                    result[1] = y;
                    return result;
                }
            }
        }

        result[0] = input.rows()-1;
        result[1] = input.cols()-1;
        return result;
    }
    public int[] FindTopLeftPixel(Mat input){
        int[] result = new int[2];
        for (int x = 0; x < input.rows(); x++) {
            for (int y = 0; y < input.cols(); y++) {
                if (input.get(x, y)[0] == 0){
                    result[0] = x;
                    result[1] = y;
                    return result;
                }
            }
        }

        result[0] = 0;
        result[1] = 0;
        return result;
    }
    public int FindSmallestNumberIndex(double a[]){
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
