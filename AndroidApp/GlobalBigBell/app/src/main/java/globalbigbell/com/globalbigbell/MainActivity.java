package globalbigbell.com.globalbigbell;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import android.annotation.TargetApi;
import android.os.Build;
import android.webkit.WebResourceRequest;
import android.webkit.WebView;
import android.webkit.WebViewClient;

public class MainActivity extends AppCompatActivity {

    private class MyWebViewClient extends WebViewClient {

        @TargetApi(Build.VERSION_CODES.N)
        @Override
        public boolean shouldOverrideUrlLoading(WebView view, WebResourceRequest request) {
            view.loadUrl(request.getUrl().toString());
            return true;
        }

        // Для старых устройств
        @Override
        public boolean shouldOverrideUrlLoading(WebView view, String url) {
            view.loadUrl(url);
            return true;
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        WebView mywebview = (WebView) findViewById(R.id.webView);
        mywebview.setWebViewClient(new MyWebViewClient());
        mywebview.getSettings().setJavaScriptEnabled(true);
        mywebview.loadUrl("https://globalbigbell.com/services/robotic-trading");

        /*String data = "<html><body><h1>Hello, Javatpoint!</h1></body></html>";
        mywebview.loadData(data, "text/html", "UTF-8"); */
        //mywebview.loadUrl("file:///android_asset/myresource.html");
    }

//    @Override
//    public void onBackPressed() {
//        if(mywebview.canGoBack()) {
//            mywebview.goBack();
//        } else {
//            super.onBackPressed();
//        }
//    }

}
