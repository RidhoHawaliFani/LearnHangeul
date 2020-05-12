package com.apps.learnhangeul;

public class StaticData {

    public float getLearningRate() {
        return learningRate;
    }

    public void setLearningRate(Float learningRate) {
        this.learningRate = learningRate;
    }

    public int getMaxEpoch() {
        return maxEpoch;
    }

    public void setMaxEpoch(Integer maxEpoch) {
        this.maxEpoch = maxEpoch;
    }

    public float getMinError() {
        return minError;
    }

    public void setMinError(Float minError) {
        this.minError = minError;
    }

    float learningRate;
    int maxEpoch;
    float minError;
}
