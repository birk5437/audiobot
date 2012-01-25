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

public class parseMp3Salacious{

    public static String targetDirectory = "/var/www/adhd4.me/www/audiobot/files/";
    public static String sourceWebpage = "http://feeds.feedburner.com/salacioussound";

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

    public static void addReturns(String filename) throws IOException
    {
	FileReader MyStreamReader = new FileReader(filename);

	FileWriter writer = new FileWriter(filename + "_modified");

	int prevChar = 0;

	int charInt;
	while((charInt = MyStreamReader.read()) != -1)
	{
	    if ((char)charInt == '<' && (char)prevChar == '>')
	    {
		writer.write(13);
		//System.out.println((char)charInt);
		//System.out.println((char)prevChar);
	    } 
	    writer.write(charInt);
	    prevChar = charInt;
	}
	writer.close();
    }

    public static void main(String[] args) {


        try
        {
		System.out.println("Downloading HTML");

	    File folder = new File(targetDirectory);
    	    File[] listOfFiles = folder.listFiles();

	    clsFileDownloader downloader = new clsFileDownloader();
	    downloader.downloadFile(sourceWebpage, targetDirectory + "website.html");

	    addReturns(targetDirectory + "website.html");           

	    File file = new File(targetDirectory + "website.html_modified");
	    //int fcounter = 0;

            for(String s : readFileLines(file))
            {
                if(s.contains(".mp3"))
                {
		    //fcounter++;
                    //System.out.println(s);
                    int index = s.indexOf(".mp3");
                    int end = s.indexOf("\'", index);
                    int start = s.indexOf("\'", s.indexOf("href")) + 1;
		

		    String fileURL = "";
                    for (int i = start; i < end; i++)
                    {
			fileURL += s.charAt(i);
                        //System.out.print(s.charAt(i));
                    }

		    fileURL = fileURL.replace(" ", "%20");

		    System.out.println(fileURL);
		    String fileName = fileURL.substring(fileURL.lastIndexOf("/") + 1);
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
		        
			try{
			downloader.downloadFile(fileURL, targetDirectory + fileName);
			System.out.print(" done");
			System.out.println("");
			}
			catch(IOException e)
			{
				System.out.println("fail!");
			}

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
