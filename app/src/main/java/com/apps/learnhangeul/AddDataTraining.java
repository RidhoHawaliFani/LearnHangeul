package com.apps.learnhangeul;

import android.app.PendingIntent;
import android.content.Intent;
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

import java.util.HashMap;
import java.util.Map;

public class AddDataTraining extends AppCompatActivity {

    ImageView previewImageHere,btnBack;
    EditText kataKorea, kataKanji, meaningKanji;
    private CustomToast customToast;
    LinearLayout btnSave;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_data_training);

        previewImageHere = findViewById(R.id.previewImageHere2);
        loadJSONInformasiAtas();

        kataKorea = findViewById(R.id.kataKorea);
        kataKanji = findViewById(R.id.kataKanjiKorea);
        meaningKanji = findViewById(R.id.meaningKanji);

        btnSave = findViewById(R.id.llSaveButton);
        btnSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sendJsonAddInvoice();
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

                            String genderParse, statusParse = "";



                            for (int i=1; i < Jarray.length(); i++){

                                JSONObject Jasonobject = Jarray.getJSONObject(i);

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
        ModelData inputUser = new ModelData();
        ModelData[] dataTraining = new ModelData[1];
        StaticData[] static_values = new StaticData[1];

        MyImageExtractor extractor = new MyImageExtractor();
        // New Logic here
        // Kalau data belum ada di db
        inputUser = extractor.TrainDataBaru(inputUser);
        // insert inputan baru ke db

        // Kalau data sudah ada di db
        dataTraining = extractor.TrainDataLama(inputUser.getImage(), dataTraining, static_values );
        //delete semua di db, insert ulang pakai data training baru


        // Creating string request with post method.
        StringRequest stringRequest2 = new StringRequest(Request.Method.POST, konfigurasi.URL_UPDATE_ITEM,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String ServerResponse) {
                        //act
                        Log.d("RESPONS EDIT AKUN", ServerResponse);

                        try {
                            JSONObject jsonObject = new JSONObject(ServerResponse);
                            if (jsonObject.optString("status").equals("true")) {
                                customToast.Show_Toast(AddDataTraining.this, "Pengaturan tersimpan!", Gravity.TOP|Gravity.CENTER);

                            } else {
                                customToast.Show_Toast(AddDataTraining.this, "Mohon maaf, data gagal disimpan.", Gravity.TOP|Gravity.CENTER);
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


}
