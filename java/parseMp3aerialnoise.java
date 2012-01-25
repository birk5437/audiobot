/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//package readfile;

/**
 *
 * @author burke
 */

import java.io.*;
import java.util.*;

public class parseMp3aerialnoise {

    public static String targetDirectory = "/var/www/adhd4.me/www/audiobot/files/";
    public static String sourceWebpage = "http://aerialnoise.com";

    /**
     * @param args the command line arguments
     */
    public static ArrayList<String> readFileLines(File f) throws IOException
    {
        //FileReader reader = new FileReader(f);
        BufferedReader reader = new BufferedReader(new FileReader(f));
        //BufferedReader r = new BufferedReader(f);

        String line;
        ArrayList<String> fileLines = new ArrayList<String>();

        while((line = reader.readLine()) != null)
        {
            fileLines.add(line);
        }

        return fileLines;
    }

    public static void main(String[] args) {


        try
        {

	    File folder = new File(targetDirectory);
    	    File[] listOfFiles = folder.listFiles();

	    clsFileDownloader downloader = new clsFileDownloader();
	    downloader.downloadFile(sourceWebpage, targetDirectory + "aerialnoise.html");
            File file = new File(targetDirectory + "aerialnoise.html");
	    //int fcounter = 0;

            for(String s : readFileLines(file))
            {
                if(s.contains(".mp3"))
                {
		    //fcounter++;
                    System.out.println(s);
                    int index = s.indexOf(".mp3");
                    int end = s.indexOf("\"", index);
                    int start = s.indexOf("href=\"") + 6;
		

		    String fileURL = "";
                    for (int i = start; i < end; i++)
                    {
			fileURL += s.charAt(i);
                        System.out.print(s.charAt(i));
                    }

		    String fileName = fileURL.substring(fileURL.lastIndexOf("/") + 1);
		    System.out.println(fileName);
		    boolean skipDownload = false;

		    for(File fi : listOfFiles)
		    {
			//System.out.println(fi.getName());
			if (fi.getName().equals(fileName))
			{
			    System.out.println("Skipping: " + fi.getName());
			    skipDownload = true;
			}
		    }

		    if(!skipDownload)
		    {
			System.out.print("Downloading: " + fileName + "...");
		        downloader.downloadFile(fileURL, targetDirectory + fileName);
			System.out.print(" done");
			System.out.println("");


			//System.out.println(fileURL);
			//System.out.println("");
			//System.out.println("");
		    }
                }
            }
        }
        catch(IOException e)
        {
            System.out.println(e);
        }



    }

}
