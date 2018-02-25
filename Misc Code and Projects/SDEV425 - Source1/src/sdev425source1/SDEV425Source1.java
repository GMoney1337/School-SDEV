package sdev425source1;
// import the necessary libraries
import java.io.*;
/**
 *
 * @author GMoney
 */
public class SDEV425Source1 {

    public static void main(String[] args) {
//Read the filename from the command line argument
    String filename = args[0];
    BufferedReader inputStream = null;
    
    String fileLine;
    try {
        inputStream = new BufferedReader(new FileReader(filename));
        
        System.out.println("Email Address:");
        //Read one line of the file using BufferedReader
        while ((fileLine = inputStream.readLine()) != null) {
            System.out.println(fileLine);
        }
      } catch (IOException io) {
          System.out.println("File IO Exception" + io.getMessage());
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
