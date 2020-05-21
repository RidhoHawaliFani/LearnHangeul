package com.apps.learnhangeul;

import android.app.PendingIntent;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.StrictMode;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.apps.learnhangeul.service_layer.MyImageExtractor;
import com.apps.learnhangeul.service_layer.MyImageLibrary;
import com.bumptech.glide.Glide;
import com.bumptech.glide.load.resource.bitmap.CenterCrop;
import com.bumptech.glide.load.resource.bitmap.RoundedCorners;
import com.bumptech.glide.request.RequestOptions;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.opencv.android.OpenCVLoader;

import java.net.URL;
import java.nio.channels.FileLock;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class AddDataTraining extends AppCompatActivity {

    ImageView previewImageHere,btnBack;
    EditText kataKorea, kataKanji, meaningKanji;
    private CustomToast customToast;
    LinearLayout btnSave;
    ArrayList<StaticData> mItemsStatic;
    ArrayList<ModelData> mItems;

    Bitmap GambarInputanUser = null;


    private static final String TAG = "AddTrainingData";
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
        setContentView(R.layout.activity_add_data_training);

        previewImageHere = findViewById(R.id.previewImageHere2);
        loadJSONInformasiAtas();

        mItemsStatic = new ArrayList<>();
        mItems = new ArrayList<>();
        if (!OpenCVLoader.initDebug()) {
            // Handle initialization error
        }



        loadStaticData();

        kataKorea = findViewById(R.id.kataKorea);
        kataKanji = findViewById(R.id.kataKanjiKorea);
        meaningKanji = findViewById(R.id.meaningKanji);

        btnSave = findViewById(R.id.llSaveButton);
        btnSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
//                sendJsonAddInvoice();
                checkDataByWord();
            }
        });

        btnBack = findViewById(R.id.btnBackAddData);
        btnBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent gtfPage = new Intent(AddDataTraining.this, ChoosePicture.class);
                PendingIntent pendingIntent1 = PendingIntent.getActivity(AddDataTraining.this, 0, gtfPage,
                        PendingIntent.FLAG_UPDATE_CURRENT);
                startActivity(gtfPage);
                finish();
            }
        });



        StrictMode.VmPolicy.Builder builder = new StrictMode.VmPolicy.Builder();
        StrictMode.setVmPolicy(builder.build());

        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
        StrictMode.setThreadPolicy(policy);


    }



    private void loadJSONInformasiAtas(){

        // Instantiate the RequestQueue.
        RequestQueue queue = Volley.newRequestQueue(this);


        // Request a string response from the provided URL.
        StringRequest stringRequest = new StringRequest(Request.Method.GET, konfigurasi.URL_GET_NEWEST_ITEM,
                new Response.Listener<String>() {

                    JSONObject jsonObject;
                    JSONArray Jarray;


                    @Override
                    public void onResponse(String response) {
                        // mProgressDialog.dismiss();
                        // Display the first 500 characters of the response string.
                        try {
                            jsonObject = new JSONObject(response);
                            Jarray = jsonObject.getJSONArray("result");

                            Log.e("resultArray", response);

                            for (int i=1; i < Jarray.length(); i++){

                                JSONObject Jasonobject = Jarray.getJSONObject(i);

                                Bitmap resultImage = getBitmapFromURL(Jasonobject.getString("filePath"));

                                GambarInputanUser = resultImage;

                                Log.e("getDataAllAtas_", GambarInputanUser.toString());


                                RequestOptions requestOptions = new RequestOptions();
                                requestOptions = requestOptions
                                        .transforms(new CenterCrop(), new RoundedCorners(10))

                                ;


                                Glide.with(getApplicationContext())
                                        .load(Jasonobject.getString("filePath"))
                                        .apply(requestOptions)
                                        .into(previewImageHere);



                            }



                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });

        // Add the request to the RequestQueue.
        queue.add(stringRequest);
    }

    private void sendJsonAddInvoice() {

        // Creating string request with post method.
        StringRequest stringRequest2 = new StringRequest(Request.Method.POST, konfigurasi.URL_UPDATE_ITEM,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String ServerResponse) {
                        //act
                        Log.d("RESPONS EDIT AKUN", ServerResponse);

                        try {
                            JSONObject jsonObject = new JSONObject(ServerResponse);
                            //place message here.......
                            customToast.Show_Toast(AddDataTraining.this, "Data berhasil disimpan...", Gravity.TOP|Gravity.CENTER);
                            //load data after saving new data-
                            loadAllDataFromDatabase();


                            //update datatraining baru ke db disini
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }


                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError volleyError) {

                    }
                }) {
            @Override
            protected Map<String, String> getParams() {

                // Creating Map String Params.
                Map<String, String> params = new HashMap<>();

                // Adding All values to Params.

                params.put("kataKorea", kataKorea.getText().toString());
                params.put("kataKanji", kataKanji.getText().toString());
                params.put("artiKata", meaningKanji.getText().toString());

                return params;
            }

        };

        // Creating RequestQueue.
        RequestQueue requestQueue = Volley.newRequestQueue(this);

        // Adding the StringRequest object into requestQueue.
        requestQueue.add(stringRequest2);
    }

    private void insertBobotToDatabase(final ModelData modelData) {

        // Creating string request with post method.
        StringRequest stringRequest2 = new StringRequest(Request.Method.POST, konfigurasi.URL_INSERT_BOBOT,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String ServerResponse) {
                        //act
                        Log.d("RESPONS EDIT AKUN", ServerResponse);


                        try {
                            JSONObject jsonObject = new JSONObject(ServerResponse);
                            //place message here.......
                            customToast.Show_Toast(AddDataTraining.this, "Data bobot disimpan...", Gravity.TOP|Gravity.CENTER);
                            //load data after saving new data-
                            loadAllDataFromDatabase();


                            //update datatraining baru ke db disini
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }


                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError volleyError) {

                    }
                }) {
            @Override
            protected Map<String, String> getParams() {

                // Creating Map String Params.
                Map<String, String> params = new HashMap<>();

                // Adding All values to Params.

                params.put("valueBobot", modelData.getBobot().toString());


                return params;
            }

        };

        // Creating RequestQueue.
        RequestQueue requestQueue = Volley.newRequestQueue(this);

        // Adding the StringRequest object into requestQueue.
        requestQueue.add(stringRequest2);
    }


    private void checkDataByWord() {

//        ModelData[] dataTraining = new ModelData[1];


        // New Logic here
        // Kalau data belum ada di db
//        inputUser = extractor.TrainDataBaru(inputUser);
        // insert inputan baru ke db

        // Kalau data sudah ada di db
        // ambil semua huruf beserta bobot yang ada di db => ModelData[]
//        ModelData[] dataTrainingLama = FindDataLama(); //ambil data dari db
//        ModelData[] dataTrainingBaru = extractor.TrainDataLama(inputUser.getImage(), dataTrainingLama, static_values );

        //hapus semua bobot yang ada di db

        // insert data yang ada di dataTrainingBaru


        //delete semua di db, insert ulang pakai data training baru


        // Creating string request with post method.
        StringRequest stringRequest2 = new StringRequest(Request.Method.POST, konfigurasi.URL_CHECK_DATA,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(
                            String ServerResponse) {
                        //act
                        Log.d("RESPONS EDIT AKUN", ServerResponse);


                        try {
                            JSONObject jsonObject = new JSONObject(ServerResponse);
                            if (jsonObject.optString("status").equals("true")) {
                                customToast.Show_Toast(AddDataTraining.this, "Data Sudah Ada.\nMemproses Ulang.", Gravity.TOP|Gravity.CENTER);

                                //Tarok logic functionnya disini kalo data sudah ada sebelumnya didatabase
                                loadAllDataFromDatabase();


                                ModelData[] dataTrainingLama = mItems.toArray(new ModelData[mItems.size()]);
                                StaticData[] dataStaticTraining =  mItemsStatic.toArray(new StaticData[mItemsStatic.size()]);
                                 //ini harusnya bitmap inputan user, bantu assignkan ke variabel bang do

                                MyImageExtractor extractor = new MyImageExtractor();
                                ModelData[] dataTrainingBaru = extractor.TrainDataLama(GambarInputanUser, dataTrainingLama, dataStaticTraining);//Bang do insert ini ke DB setelah bobot di db dihapus semua

                            } else {
                                customToast.Show_Toast(AddDataTraining.this, "Data Baru Sedang Diproses\nHarap menunggu...", Gravity.TOP|Gravity.CENTER);

                                sendJsonAddInvoice();

                                ModelData inputanUser = new ModelData(kataKanji.getText().toString(), kataKorea.getText().toString(), meaningKanji.getText().toString(), GambarInputanUser, null);
                                MyImageExtractor extractor = new MyImageExtractor();
                                ModelData InputanUserBerbobot = extractor.TrainDataBaru(inputanUser); //Bang do insert ini ke DB

                                //PROBLEMNYA : bobot belum didapat
                                insertBobotToDatabase(InputanUserBerbobot);



                                //Tarok logic functionnya disini kalo data BELUM ada sebelumnya didatabase
                                //place traindatabaru here...

                            }

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }


                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError volleyError) {

                    }
                }) {
            @Override
            protected Map<String, String> getParams() {

                // Creating Map String Params.
                Map<String, String> params = new HashMap<>();

                // Adding All values to Params.

                params.put("kataKorea", kataKorea.getText().toString());
                params.put("kataKanji", kataKanji.getText().toString());
                params.put("artiKata", meaningKanji.getText().toString());

                return params;
            }

        };

        // Creating RequestQueue.
        RequestQueue requestQueue = Volley.newRequestQueue(this);

        // Adding the StringRequest object into requestQueue.
        requestQueue.add(stringRequest2);
    }


    private void loadStaticData(){

        // Instantiate the RequestQueue.
        RequestQueue queue = Volley.newRequestQueue(this);


        // Request a string response from the provided URL.
        StringRequest stringRequest = new StringRequest(Request.Method.GET, konfigurasi.URL_LOAD_STATIC_DATA,
                new Response.Listener<String>() {

                    JSONObject jsonObject;
                    JSONArray Jarray;


                    @Override
                    public void onResponse(String response) {
                        // mProgressDialog.dismiss();
                        // Display the first 500 characters of the response string.
                        try {
                            jsonObject = new JSONObject(response);
                            Jarray = jsonObject.getJSONArray("result");

                            StaticData sd = new StaticData();

                            Log.e("resultArray", response);

                            for (int i=1; i < Jarray.length(); i++){

                                JSONObject Jasonobject = Jarray.getJSONObject(i);

                                sd.setMaxEpoch(Integer.parseInt(Jasonobject.getString("maxEpoch")));
                                sd.setMinError(Float.parseFloat(Jasonobject.getString("minError")));
                                sd.setLearningRate(Float.parseFloat(Jasonobject.getString("learningRate")));
                                mItemsStatic.add(sd);



                            }

                            Log.e("maxEpoch", Integer.toString(mItemsStatic.get(0).getMaxEpoch()));
                            Log.e("minError", Float.toString(mItemsStatic.get(0).getMinError()));
                            Log.e("learningRate", Float.toString(mItemsStatic.get(0).getLearningRate()));



                        } catch (JSONException e) {
                            e.printStackTrace();
                        }

                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });

        // Add the request to the RequestQueue.
        queue.add(stringRequest);
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
