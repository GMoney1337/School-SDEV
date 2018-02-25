

import java.io.BufferedReader;
import java.io.IOException;
import java.io.LineNumberReader;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class EmailAddressMatcher {

    /**
     * The following program verifies that lines of the text file
     * contain valid email addresses. The program achieves this
     * by using regular expressions
     * 
     * The regular expression used is
     * "^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@" 
     * + "[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*
     * (\\.[A-Za-z]{2,})$").matcher(fileLine);
     * 
     * If a line does not contain the specific pattern
     * IllegalStateException is thrown
         
     */
public void findBadLines(String aFileName) {
    //Pattern and Matcher are used here, not String.matches(regexp),
    //since String.matches(regexp) would repeatedly compile the same
    //regular expression
    Pattern regexp = Pattern.compile("^\\\\N\\t(\\d)+\\t(\\w)+");
    Matcher matcher = regexp.matcher("");

    Path path = Paths.get(aFileName);
    try (
      BufferedReader reader = Files.newBufferedReader(path, ENCODING);
      LineNumberReader lineReader = new LineNumberReader(reader);
    ){
      String line = null;
      while ((line = lineReader.readLine()) != null) {
        matcher.reset(line); //reset the input
        if (!matcher.find()) {
          String msg = "Line " + lineReader.getLineNumber() + " is bad: " + line;
          
        }
      }      
    }    
    catch (IOException ex){
      ex.printStackTrace();
    }
  }
}