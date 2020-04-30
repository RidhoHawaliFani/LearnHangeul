package com.apps.learnhangeul;

import android.app.PendingIntent;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.view.View;

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
