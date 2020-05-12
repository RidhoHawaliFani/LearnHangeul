package com.apps.learnhangeul;

import android.Manifest;
import android.app.PendingIntent;
import android.app.ProgressDialog;
import android.content.ContentValues;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.os.StrictMode;
import android.provider.MediaStore;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.text.Editable;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.apps.learnhangeul.service_layer.MyImageExtractor;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.opencv.android.OpenCVLoader;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.DecimalFormatSymbols;
import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.Locale;

import dmax.dialog.SpotsDialog;

public class RunLogic extends AppCompatActivity {

    ImageView btnBack;
    TextView tvArtiKata, tvKanji, tvKataKorea;
    LinearLayout btnSelectPicture, btnOpenCamera, nextButton, rotateButton, llSelectImageSide, llResult;

    ProgressDialog mProgressDialog;
    private String imageName="";

    ImageView previewImage;



    private int degree = 0;

    private Bitmap bitmap;

    private Uri imageUri;

    public static int TAKE_IMAGE = 111;
    Uri mCapturedImageURI;

    ArrayList<HashMap<String, String>> list = new ArrayList<>();
    ArrayList<ModelData> mItems;

    private int PICK_IMAGE_REQUEST = 1;
    private static final int CAMERA_REQUEST = 1567;
    private Uri filePath;

    private String JSON_STRING;

    private static final String TAG = "MainActivity";
    private static final String[] PERMISSIONS = {Manifest.permission.READ_EXTERNAL_STORAGE, Manifest.permission.WRITE_EXTERNAL_STORAGE,Manifest.permission.CAMERA};
    private static boolean hasPermissions(Context context, String... permissions) {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M && context != null && permissions != null) {
            for (String permission : permissions) {
                if (ActivityCompat.checkSelfPermission(context, permission) != PackageManager.PERMISSION_GRANTED) {
                    return false;
                }
            }
        }
        return true;
    }

    static {
        if (OpenCVLoader.initDebug()){
            Log.d(TAG, "OpenCV is configured successfully");
        }
        else{

            Log.d(TAG, "OpenCV is not configured correctly");
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_run_logic);


        mItems = new ArrayList<>();


        if (!OpenCVLoader.initDebug()) {
            // Handle initialization error
        }

        //starting loading data first...
        loadAllDataFromDatabase();



        tvArtiKata = findViewById(R.id.artiKataTV);
        tvKataKorea = findViewById(R.id.kataKoreaTV);
        tvKanji = findViewById(R.id.kanjiTV);



        btnBack = findViewById(R.id.btnBackRunLogic);
        btnBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
                Intent gtfPage = new Intent(RunLogic.this, MainActivity.class);
                PendingIntent pendingIntent1 = PendingIntent.getActivity(RunLogic.this, 0, gtfPage,
                        PendingIntent.FLAG_UPDATE_CURRENT);
                startActivity(gtfPage);
            }
        });

        btnOpenCamera = findViewById(R.id.llButtonOpenCameraRunLogic);
        btnOpenCamera.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (!hasPermissions(RunLogic.this, PERMISSIONS)) {


                    Toast t = Toast.makeText(getApplicationContext(), "You don't have write access !", Toast.LENGTH_LONG);
                    t.show();

                } else {

//                    Intent takePicture = new Intent(android.provider.MediaStore.ACTION_IMAGE_CAPTURE);
//                    startActivityForResult(takePicture, 0);

                    try {
                        String fileName = "temp.jpg";
                        ContentValues values = new ContentValues();
                        values.put(MediaStore.Images.Media.TITLE, fileName);
                        mCapturedImageURI = getContentResolver()
                                .insert(
                                        MediaStore.Images.Media.EXTERNAL_CONTENT_URI,
                                        values);
                        Intent intent = new Intent(
                                MediaStore.ACTION_IMAGE_CAPTURE);
                        intent.putExtra(MediaStore.EXTRA_OUTPUT,
                                mCapturedImageURI);
                        startActivityForResult(intent, TAKE_IMAGE);
                    } catch (Exception e) {
                        Log.e("", "", e);
                    }



                }

            }
        });

        btnSelectPicture = findViewById(R.id.llButonSelectPictureRunLogic);
        btnSelectPicture.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent();
                intent.setType("image/*");
                intent.setAction(Intent.ACTION_GET_CONTENT);
                startActivityForResult(Intent.createChooser(intent, "Pilih Citra"), PICK_IMAGE_REQUEST);


            }
        });

        previewImage = findViewById(R.id.previewImageHereRunLogic);

        nextButton = findViewById(R.id.llNextButtonRunLogic);
        nextButton.setVisibility(View.GONE);

        nextButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //call image extractor function
                if (mItems!= null){



                    Toast.makeText(getApplicationContext(), "Processing successed...", Toast.LENGTH_LONG).show();

                    ModelData[] data = mItems.toArray(new ModelData[mItems.size()]);
                    MyImageExtractor extractor = new MyImageExtractor();



                    for (int i=0; i<mItems.size();i++){
                        Log.e("getDataAll_"+i, mItems.get(i).getAllData());
                    }

                    //result contain all the image details
                    ModelData result = extractor.FindKoreanWord(bitmap, data, new StaticData[1]);

                    tvArtiKata.setText(result.artiKata);
                    tvKataKorea.setText(result.kataKorea);
                    tvKanji.setText(result.kataKanji);

                }else{
                    //data have not been loaded
                    Toast.makeText(getApplicationContext(), "Processing failed...", Toast.LENGTH_LONG).show();

                }


                llSelectImageSide.setVisibility(View.GONE);
                rotateButton.setVisibility(View.GONE);

                llResult.setVisibility(View.VISIBLE);
            }
        });

        rotateButton = findViewById(R.id.llButtonRotateRunLogic);
        rotateButton.setVisibility(View.GONE);

        llResult = findViewById(R.id.llResult);
        llResult.setVisibility(View.GONE);

        llSelectImageSide = findViewById(R.id.llButtonSelectImage);
        llSelectImageSide.setVisibility(View.VISIBLE);

        rotateButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                degree = degree + 90;
                if(degree % 360 == 0) {
                    degree = 0;
                }
                previewImage.setRotation(degree);
            }
        });



        ActivityCompat.requestPermissions(RunLogic.this, PERMISSIONS, 112);
        StrictMode.VmPolicy.Builder builder = new StrictMode.VmPolicy.Builder();
        StrictMode.setVmPolicy(builder.build());

        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
        StrictMode.setThreadPolicy(policy);

    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        Log.e("RESULTCODE", Integer.toString(requestCode)+" "+ resultCode);

        if (requestCode == PICK_IMAGE_REQUEST && resultCode == RESULT_OK && data != null && data.getData() != null) {

            filePath = data.getData();

            File f = new File(filePath.toString());
            String imageName = f.getName();
            this.imageName = imageName;

            try {
                nextButton.setVisibility(View.VISIBLE);
                rotateButton.setVisibility(View.VISIBLE);
                bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), filePath);
                previewImage.setImageBitmap(bitmap);
            } catch (IOException e) {
                e.printStackTrace();
            }
        }else if (resultCode != RESULT_CANCELED) {

            nextButton.setVisibility(View.VISIBLE);
            rotateButton.setVisibility(View.VISIBLE);


            File f = new File(mCapturedImageURI.toString());
            String imageName = f.getName();

            this.imageName = imageName;

            String[] projection = { MediaStore.Images.Media.DATA };
            Cursor cursor = getContentResolver().query(mCapturedImageURI, projection, null, null, null);
            int column_index_data = cursor
                    .getColumnIndexOrThrow(MediaStore.Images.Media.DATA);
            cursor.moveToFirst();

            //THIS IS WHAT YOU WANT!
            String capturedImageFilePath = cursor.getString(column_index_data);

            bitmap = BitmapFactory.decodeFile(capturedImageFilePath);

            previewImage.setImageBitmap(bitmap);

        }

    }


    private void loadAllDataFromDatabase(){

        //mProgressDialog.show();
         RequestQueue queue = Volley.newRequestQueue(this);
         StringRequest arrayRequest = new StringRequest(Request.Method.GET, konfigurasi.URL_GET_ALL_ITEM, new Response.Listener<String>() {

            JSONObject jsonObject;
            JSONArray Jarray;



            @Override
            public void onResponse(String response) {
//                pd.cancel();
                //mProgressDialog.cancel();
                Log.d("volley", "response : " + response);

                try {


                    jsonObject = new JSONObject(response);
                    Jarray = jsonObject.getJSONArray("result");


                    Log.e("ARRAYSIZEM_ITEMS", Integer.toString(Jarray.length()));

                    for (int i=1; i <= Jarray.length(); i++){

                        JSONObject Jasonobject = Jarray.getJSONObject(i);

                        Bitmap resultImage = getBitmapFromURL(Jasonobject.getString("gambarKanji"));
                        ModelData md = new ModelData();

                        md.setImage(resultImage);
                        md.setKataKanji(Jasonobject.getString("kataKanji"));
                        md.setKataKorea(Jasonobject.getString("kataKorea"));
                        md.setArtiKata(Jasonobject.getString("artiKata"));
                        // memanggil nama array yang kita buat
                        mItems.add(md);
                        Log.e("getDataAllBawah_"+(i-1), mItems.get(i-1).getAllData());
                    }


                } catch (JSONException e) {
                    e.printStackTrace();
                }

            }
        }, new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError error) {
                //mProgressDialog.cancel();
                Log.d("volley", "error : " + error.getMessage());
            }
        });
        queue.add(arrayRequest);
    }

    public static Bitmap getBitmapFromURL(String src) {
        try {
            URL url = new URL(src);
            Bitmap image = BitmapFactory.decodeStream(url.openConnection().getInputStream());
            return  image;
        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }
    }





}
