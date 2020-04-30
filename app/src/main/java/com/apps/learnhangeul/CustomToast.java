package com.apps.learnhangeul;

import android.content.Context;
import android.view.Gravity;

import com.github.johnpersano.supertoasts.library.Style;
import com.github.johnpersano.supertoasts.library.SuperActivityToast;
import com.github.johnpersano.supertoasts.library.utils.PaletteUtils;

public class CustomToast {

	// Custom Toast Method
	public static void Show_Toast(Context context, String message) {

		SuperActivityToast superActivityToast = new SuperActivityToast(context);
		superActivityToast.setText(message);
		superActivityToast.setIndeterminate(false);
		superActivityToast.setAnimations(Style.ANIMATIONS_POP);
		superActivityToast.setProgressMax(100);
		superActivityToast.setProgress(50);
		superActivityToast.setFrame(Style.FRAME_LOLLIPOP);
		superActivityToast.setColor(PaletteUtils.getSolidColor(PaletteUtils.MATERIAL_PINK));
		superActivityToast.setDuration(Style.DURATION_LONG);
		superActivityToast.show();
	}

	public static void Show_Toast(Context context, String message, Integer gravity) {

		SuperActivityToast superActivityToast = new SuperActivityToast(context);
		superActivityToast.setText(message);
		superActivityToast.setIndeterminate(false);
		superActivityToast.setAnimations(Style.ANIMATIONS_POP);
		superActivityToast.setProgressMax(100);
		superActivityToast.setProgress(50);
		superActivityToast.setFrame(Style.FRAME_STANDARD);
		superActivityToast.setColor(PaletteUtils.getSolidColor(PaletteUtils.MATERIAL_ORANGE));
		superActivityToast.setDuration(Style.DURATION_VERY_LONG);
		superActivityToast.setPriorityLevel(Style.PRIORITY_HIGH);

		superActivityToast.setDuration(Style.DURATION_LONG);
		superActivityToast.setGravity(gravity);

		superActivityToast.show();
	}

}
