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

    public ModelData( String kataKanji, String kataKorea, String artiKata,Bitmap image,  double[] bobot) {
        this.kataKanji = kataKanji;
        this.kataKorea = kataKorea;
        this.image = image;
        this.artiKata = artiKata;
        this.bobot = bobot;
    }
    public ModelData(){}

    String kataKanji;
    String kataKorea;
    Bitmap image;
    String artiKata;
    double[] bobot;

    public float getTarget() {
        return target;
    }

    public void setTarget(float target) {
        this.target = target;
    }

    float target;

}
