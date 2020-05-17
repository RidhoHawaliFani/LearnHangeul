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
import android.graphics.Matrix;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Environment;
import android.os.StrictMode;
import android.provider.MediaStore;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.FileProvider;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;

public class ChoosePicture extends AppCompatActivity {

    ImageView btnBack;
    LinearLayout btnSelectPicture, btnOpenCamera, nextButton, rotateButton;

    private ProgressDialog mProgressDialog;
    private String imageName="";

    ImageView previewImage;

    private int degree = 0;

    private Bitmap bitmap;

    private Uri imageUri;

    public static int TAKE_IMAGE = 111;
    Uri mCapturedImageURI;

    private int PICK_IMAGE_REQUEST = 1;
    private static final int CAMERA_REQUEST = 1567;
    private Uri filePath;

    private static final String TAG = "MainActivity";
    private static final String[] PERMISSIONS = {android.Manifest.permission.READ_EXTERNAL_STORAGE, android.Manifest.permission.WRITE_EXTERNAL_STORAGE,Manifest.permission.CAMERA};
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


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_choose_picture);


        btnBack = findViewById(R.id.btnBack);
        btnBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent gtfPage = new Intent(ChoosePicture.this, MainActivity.class);
                PendingIntent pendingIntent1 = PendingIntent.getActivity(ChoosePicture.this, 0, gtfPage,
                        PendingIntent.FLAG_UPDATE_CURRENT);
                startActivity(gtfPage);
                finish();
            }
        });

        btnOpenCamera = findViewById(R.id.llButtonOpenCamera);
        btnOpenCamera.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (!hasPermissions(ChoosePicture.this, PERMISSIONS)) {


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

        btnSelectPicture = findViewById(R.id.llButonSelectPicture);
        btnSelectPicture.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent();
                intent.setType("image/*");
                intent.setAction(Intent.ACTION_GET_CONTENT);
                startActivityForResult(Intent.createChooser(intent, "Pilih Citra"), PICK_IMAGE_REQUEST);


            }
        });

        nextButton = findViewById(R.id.llNextButton);
        nextButton.setVisibility(View.GONE);

        nextButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                uploadImage();
            }
        });

        rotateButton = findViewById(R.id.llButtonRotate);
        rotateButton.setVisibility(View.GONE);

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

        previewImage = findViewById(R.id.previewImageHere);


        ActivityCompat.requestPermissions(ChoosePicture.this, PERMISSIONS, 112);
        StrictMode.VmPolicy.Builder builder = new StrictMode.VmPolicy.Builder();
        StrictMode.setVmPolicy(builder.build());
    }


    public String getStringImage(Bitmap bmp){
        ByteArrayOutputStream baos = new ByteArrayOutputStream();
        bmp.compress(Bitmap.CompressFormat.JPEG, 100, baos);
        byte[] imageBytes = baos.toByteArray();
        String encodedImage = Base64.encodeToString(imageBytes, Base64.DEFAULT);
        return encodedImage;
    }

    private void uploadImage(){
        class UploadImage extends AsyncTask<Bitmap,Void,String> {

            RequestHandler rh = new RequestHandler();

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                //loading = ProgressDialog.show(OrderBarangConfirmation.this, "Uploading...", null,true,true);
                //mProgressDialog.show();
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
//                mProgressDialog.dismiss();
                Toast.makeText(getApplicationContext(),"Berhasil disimpan.",Toast.LENGTH_LONG).show();

                Intent gtfPage = new Intent(ChoosePicture.this, AddDataTraining.class);
                PendingIntent pendingIntent1 = PendingIntent.getActivity(ChoosePicture.this, 0, gtfPage,
                        PendingIntent.FLAG_UPDATE_CURRENT);
                startActivity(gtfPage);

                Log.e("result hasil", s);
            }

            @Override
            protected String doInBackground(Bitmap... params) {
                Bitmap bitmap = params[0];
                String uploadImage = getStringImage(bitmap);

                HashMap<String,String> data = new HashMap<>();

                data.put("imageSent", uploadImage);
                data.put("imageName", imageName);
                String result = rh.sendPostRequest(konfigurasi.URL_PROCESS_ADD_NEW_BUKTI_PEMBAYARAN,data);

                return result;
            }
        }

        UploadImage ui = new UploadImage();
        ui.execute(bitmap);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        Log.e("RESULTCODE", Integer.toString(requestCode)+" "+ resultCode);

        if (requestCode == PICK_IMAGE_REQUEST && resultCode == RESULT_OK && data != null && data.getData() != null) {

            filePath = data.getData();

            File f = new File(filePath.toString());
            String imageName = f.getName();

            Log.e("namaImage", filePath.toString());

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


//            Bitmap selectedImage = (Bitmap) data.getExtras().get("data");
//
//            previewImage.setImageBitmap(selectedImage);

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




}
