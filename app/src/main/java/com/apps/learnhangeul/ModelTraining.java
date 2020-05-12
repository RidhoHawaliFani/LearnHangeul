package com.apps.learnhangeul;

import android.graphics.Bitmap;

public class ModelTraining {

    public Bitmap getResult() {
        return result;
    }

    public void setResult(Bitmap result) {
        this.result = result;
    }

    public ModelData[] getDataTraining() {
        return dataTraining;
    }

    public void setDataTraining(ModelData[] dataTraining) {
        this.dataTraining = dataTraining;
    }

    Bitmap result;
    ModelData[] dataTraining;
}
