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
    private final int imageSize = 50;

    //Do not change this
    private final Mat kernel = Imgproc.getStructuringElement(Imgproc.CV_SHAPE_RECT,
            new Size(2 * erodeAmount + 1, 2 * erodeAmount + 1),
            new Point(erodeAmount, erodeAmount));

    public MyImageExtractor(){}

    public ModelData FindKoreanWord(Bitmap input, ModelData[] data){
        Mat test = Preprocess(input);

        double smallestDistance = 0;
        int smallestDistanceIndex = 0;

        for (int i = 0; i < data.length ; i++){
            Mat trained = Preprocess(data[i].getImage());

            double[] result = new double[test.width()*test.height()];

            //Find the smallest distance
            for (int x = 0; x < test.width(); x++){
                for (int y = 0; y < test.height(); y++){
                result[i] = 0;
                result[i] += Math.pow((test.get(y, x)[0] - trained.get(y, x)[0]), 2);
                }
            }

            //Compare to get the smallest distance
            if (smallestDistance > Math.sqrt(result[i])){
                smallestDistance = Math.sqrt(result[i]);
                smallestDistanceIndex = i;
            }
        }

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
}
