package com.apps.learnhangeul;

import android.app.PendingIntent;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.util.Log;
import android.view.View;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {

    CardView btnSelectPict, btnKenaliTulisan;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);





        btnSelectPict = findViewById(R.id.btnSelectPict);
        btnSelectPict.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent gtfPage = new Intent(MainActivity.this, ChoosePicture.class);
                PendingIntent pendingIntent1 = PendingIntent.getActivity(MainActivity.this, 0, gtfPage,
                        PendingIntent.FLAG_UPDATE_CURRENT);
                startActivity(gtfPage);
            }
        });

        btnKenaliTulisan= findViewById(R.id.btnKenalTulisan);
        btnKenaliTulisan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent gtfPage = new Intent(MainActivity.this, RunLogic.class);
                PendingIntent pendingIntent1 = PendingIntent.getActivity(MainActivity.this, 0, gtfPage,
                        PendingIntent.FLAG_UPDATE_CURRENT);
                startActivity(gtfPage);
            }
        });
    }


}
