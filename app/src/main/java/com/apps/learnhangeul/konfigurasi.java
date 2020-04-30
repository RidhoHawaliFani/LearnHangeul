package com.apps.learnhangeul;

public class konfigurasi {

    //Dibawah ini merupakan Pengalamatan dimana Lokasi Skrip CRUD PHP disimpan
    //PENTING! JANGAN LUPA GANTI IP SESUAI DENGAN IP KOMPUTER DIMANA DATA PHP BERADA



    public static final String URL_PROCESS_ADD_NEW_BUKTI_PEMBAYARAN = "http://192.168.43.90/pashania/Welcome/prosesAddDataTraining";
    public static final String URL_GET_NEWEST_ITEM = "http://192.168.43.90/pashania/Welcome/getNewestItem";
    public static final String URL_GET_ALL_ITEM = "http://192.168.43.90/pashania/Welcome/getAllItem";
    public static final String URL_UPDATE_ITEM = "http://192.168.43.90/pashania/Welcome/updateNewestItem";

    //Dibawah ini merupakan Kunci yang akan digunakan untuk mengirim permintaan ke Skrip PHP
    public static final String KEY_EMP_ID = "id";
    public static final String KEY_EMP_NAMA = "name";

    //JSON Tags
    public static final String TAG_JSON_ARRAY = "result";
    public static final String TAG_ID = "id";
    public static final String TAG_NAMA = "name";
    public static final String SALDOMASUK = "saldoMasuk";

    public static final String TAG_USERNAME = "username";
    public static final String TAG_PASSWORD = "pass";
    public static final String TAG_TOKONAME = "namatoko";
    public static final String TAG_SURENAME = "namaLengkap";
    public static final String TAG_EMAIL = "email";


    public static final String USER_ID = "id_identitas";


}