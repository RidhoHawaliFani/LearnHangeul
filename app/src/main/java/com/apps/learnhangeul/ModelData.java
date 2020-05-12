package com.apps.learnhangeul;


import android.graphics.Bitmap;

public class ModelData {

    public String getAllData(){
        return  kataKanji+" "+ kataKorea+ " "+ artiKata+" " + image.toString();

    }

    public String getKataKanji() {
        return kataKanji;
    }

    public void setKataKanji(String kataKanji) {
        this.kataKanji = kataKanji;
    }

    public String getKataKorea() {
        return kataKorea;
    }

    public void setKataKorea(String kataKorea) {
        this.kataKorea = kataKorea;
    }

    public Bitmap getImage() {
        return image;
    }

    public void setImage(Bitmap image) {
        this.image = image;
    }

    public String getArtiKata() {
        return artiKata;
    }

    public void setArtiKata(String artiKata) {
        this.artiKata = artiKata;
    }

    public double[] getBobot() {
        return bobot;
    }

    public void setBobot(double[] bobot) {
        this.bobot = bobot;
    }

    String kataKanji;
    String kataKorea;
    Bitmap image;
    String artiKata;
    double[] bobot;

}
