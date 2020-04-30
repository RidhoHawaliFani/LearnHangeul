package com.apps.learnhangeul;

/**
 * Created by Parsania Hardik on 19-Apr-17.
 */

import android.content.Context;
import android.content.SharedPreferences;

public class PreferenceHelper {

    private final String INTRO = "intro";
    private final String NAME = "uname";
    private final String USERNAME = "uname";
    private final String ID = "idToko";
    private final String SURENAME = "namaLengkap";
    private final String EMAIL = "email";
    private final String TELEPON = "telepon";
    private final String ALAMAT = "alamat";

    private final String IDKARYAWAN = "idKaryawan";

    private SharedPreferences app_prefs;
    private Context context;

    public PreferenceHelper(Context context) {
        app_prefs = context.getSharedPreferences("sharedSession",
                Context.MODE_PRIVATE);
        this.context = context;
    }

    public void putIsLogin(boolean loginorout) {
        SharedPreferences.Editor edit = app_prefs.edit();
        edit.putBoolean(INTRO, loginorout);
        edit.apply();

    }

    public String getName() {
        return app_prefs.getString(NAME, "");
    }

    public void putUserID(String loginorout) {
        SharedPreferences.Editor edit = app_prefs.edit();
        edit.putString(ID, loginorout);
        edit.apply();
    }
    public String getUserID() {
        return app_prefs.getString(ID, "");
    }

    public void putKaryawanID(String loginorout) {
        SharedPreferences.Editor edit = app_prefs.edit();
        edit.putString(IDKARYAWAN, loginorout);
        edit.apply();
    }
    public String getKaryawanID() {
        return app_prefs.getString(IDKARYAWAN, "");
    }




}
