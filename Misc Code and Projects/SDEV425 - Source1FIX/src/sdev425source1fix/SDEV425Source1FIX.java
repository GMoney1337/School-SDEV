package sdev425source1fix;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.text.Normalizer;
import java.text.Normalizer.Form;
import java.util.regex.Pattern;
import java.util.regex.Matcher;
//@author Galen Yanofsky
public class SDEV425Source1FIX {
  
    public static void main(String[] args) throws Exception { //Exception must be thrown if filename uses illegal naming convention.  
        if (args.length < 1) { //checks for unsafe naming convention

        }//Read the filename from the command line argument
    String filename = args[0];
    String fileLine;
    BufferedReader inputStream = null;
    Pattern pattern = Pattern.compile("[^A-Za-z0-9._]");
    Matcher matcher = pattern.matcher(filename);
    if (matcher.find()) {
        //File name contains unsafe characters, handle error
        System.out.println("Filename contains illegal characters");
    }
    
    
    try {
   
        inputStream = new BufferedReader(new FileReader(filename));
        
        System.out.println("Email Address:");
        //Read one line of the file using BufferedReader
        while ((fileLine = inputStream.readLine()) != null) { //While loop to iterate through lines of file
            fileLine =  Normalizer.normalize(fileLine,Form.NFKC); //Normalize data in lines of file
            //Regular expression for matching to email address convention
            Pattern p = Pattern.compile("[A-Za-z0-9]+@[A-Za-z0-9]+.[A-Za-z0-9]+");
            Matcher m = p.matcher(fileLine);
            if (m.find()) {
            System.out.println(fileLine); //If fileLine contains email address
                                          //program will print address
            } else if (!m.find()) {    
            System.out.println("Invalid data in text file");
            }
            //If fileLine contains unmatching data based on regex      
        }    
      } catch (IOException io) {
          System.out.println("File IO Exception " + io.getMessage());
      } finally {
        // Need another catch for closing the streams
        try {
            if (inputStream != null) {
                inputStream.close();
            }
            } catch (IOException io) {
                System.out.println("Issue closing the Files" + io.getMessage());
            }
        }
    }
}
