// AUTHOR: Galen Yanofsky
// DATE: 6/21/2017
// PURPOSE: Demonstrate Timestamp Implementation

import java.util.*;
import java.text.*;
import java.sql.*;
// @author Galen Yanofsky
 public class HW1 {
    
     public static void main(String[] args) { //main method
        Timestamp dateTime = new Timestamp(System.currentTimeMillis()); //timestamp class 
        System.out.println("Hello World!"); //print Hello World
        System.out.println("Current Date & Time: " + dateTime); //print time stamp
      }   
}
