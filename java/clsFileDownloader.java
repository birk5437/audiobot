import java.io.*;
import java.net.Proxy;
import java.net.InetAddress;
import java.net.InetSocketAddress;
import java.net.URL;
import java.net.URLConnection;

public class clsFileDownloader
{
	public clsFileDownloader()
	{
	}


public void downloadFile(String source, String dest) throws IOException
{
//                try
//                {

                        //InetAddress proxyAddress = InetAddress.getByName("Please enter your proxy address")  ;
                        //InetSocketAddress inetSocketAddress = new InetSocketAddress(proxyAddress, 80);

                        //Proxy proxy = new Proxy(Proxy.Type.HTTP, inetSocketAddress);


                        URL url = new URL(source);
                        URLConnection urlConnection = url.openConnection();
                        urlConnection.connect();
                        InputStream input = url.openStream();
                        //FileWriter fw = new FileWriter("mck_data_aud_10.4.5.000.tar.gz");
                        //BufferedWriter fw = new BufferedWriter(new FileWriter("mck_data_aud_10.4.5.000.tar.gz"));
                        FileOutputStream fw = new FileOutputStream(dest);

                        //Reader reader = new InputStreamReader(input);
                        //BufferedReader bufferedReader = new BufferedReader(reader);
                        String strLine = "";

                        int count = 0;
                        int inputByte;
                        while((inputByte = input.read()) != -1)
                        {
                                fw.write(inputByte);
                                //fw.newLine();
                        }

//                        return "success";

/*                } catch ( Exception e )
                {
                        return "download failed";
                }*/
}



	
}
