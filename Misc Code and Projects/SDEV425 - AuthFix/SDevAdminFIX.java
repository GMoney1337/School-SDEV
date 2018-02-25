package sdevadminfix;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.concurrent.ThreadLocalRandom;
import java.util.Date;
import java.util.Properties;
import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;
import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.scene.layout.GridPane;
import javafx.scene.paint.Color;
import javafx.scene.text.Text;
import javafx.stage.Stage;




public class SDevAdminFIX extends Application {
    int authAttempts; //keeps track of invalid login attempts
    int code = codeGen(); //initialize variable for multifactor authentication.

    @Override
    public void start(Stage primaryStage) {
        primaryStage.setTitle("SDEV425 Login");
        // Grid Pane divides your window into grids
        GridPane grid = new GridPane();
        // Align to Center
        // Note Position is geometric object for alignment
        grid.setAlignment(Pos.CENTER);
        // Set gap between the components
        // Larger numbers mean bigger spaces
        grid.setHgap(10);
        grid.setVgap(10);

        // Create some text to place in the scene
        Text scenetitle = new Text("Welcome. Log in to continue.");
        // Add text to grid 0,0 span 2 columns, 1 row
        grid.add(scenetitle, 0, 0, 2, 1);

        // Create Label
        Label userName = new Label("User Name:");
        // Add label to grid 0,1
        grid.add(userName, 0, 1);

        // Create Textfield
        TextField userTextField = new TextField();
        // Add textfield to grid 1,1
        grid.add(userTextField, 1, 1);

        // Create Label
        Label pw = new Label("Password:");
        // Add label to grid 0,2
        grid.add(pw, 0, 2);

        // Create Passwordfield
        PasswordField pwBox = new PasswordField();
        // Add Password field to grid 1,2
        grid.add(pwBox, 1, 2);
        
        //Create 2nd Passwordfield and label for multifactor authentication IA-2
        PasswordField pwBox2 = new PasswordField();
        grid.add(pwBox2, 1, 3);
        Label pw2 = new Label("Authorization Code: "); //
        grid.add(pw2, 0, 3);

        // Create Login Button
        Button btn = new Button("Login");
        // Add button to grid 1,5
        grid.add(btn, 1, 5);
        
         // Create banner for AC-8.
        Text scenetitle2 = new Text("You are accessing a U.S. Government (USG)  Information\n"
                                 + "System (IS) that is provided for USG-authorized use only.\n"
                                 + "By using this IS (which includes any device attached to this IS),\n"
                                 + "you consent to the following conditions:\n"
                                 + "\n"
                                 + "    IS for purposes including, but not limited to, penetration testing,\n"
                                 + "    COMSEC monitoring, network operations and defense, personnel misconduct (PM),\n"
                                 + "    law enforcement (LE), and counterintelligence (CI) investigations.\n"
                                 + "\n"
                                 + "-   At any time, the USG may inspect and seize data stored on this IS.\n"
                                 + "\n"
                                 + "-   Communications using, or data stored on, this IS are not private,\n"
                                 + "    are subject to routine monitoring, interception, and search, and may\n"
                                 + "    be disclosed or used for any USG-authorized purpose.");
        grid.add(scenetitle2, 0, 8, 2, 1);
        scenetitle2.setFill(Color.FIREBRICK);

        final Text actiontarget = new Text();
        grid.add(actiontarget, 1, 6);

        // Set the Action when button is clicked
        btn.setOnAction(new EventHandler<ActionEvent>() {

            @Override
            public void handle(ActionEvent e) {
                //If no recent login attempts, reset lockout counter to 0
                String username = userTextField.getText();
                boolean recentAttempt = checkLog(username);
                if (recentAttempt == false) {
                    authAttempts = 0;
                }
                if (authAttempts < 5) {
                    // Authenticate the user
                    int usercode = Integer.parseInt(pwBox2.getText()); //get code from user entry in password field
                    boolean isValid = authenticate(username, pwBox.getText(), usercode, code);
                    // If valid clear the grid and Welcome the user
                    if (isValid) {
                        grid.setVisible(false);
                        GridPane grid2 = new GridPane();
                        // Align to Center
                        // Note Position is geometric object for alignment
                        grid2.setAlignment(Pos.CENTER);
                        // Set gap between the components
                        // Larger numbers mean bigger spaces
                        grid2.setHgap(10);
                        grid2.setVgap(10);
                        Text scenetitle = new Text("Welcome " + userTextField.getText() + "!");
                        // Add text to grid 0,0 span 2 columns, 1 row
                        grid2.add(scenetitle, 0, 0, 2, 1);
                        Scene scene = new Scene(grid2, 500, 400);
                        primaryStage.setScene(scene);
                        primaryStage.show();
                        // If Invalid Ask user to try again
                    } else {                    
                        //If credentials are invalid:
                        final Text actiontarget = new Text();
                        grid.add(actiontarget, 1, 7);
                        actiontarget.setFill(Color.FIREBRICK);
                        actiontarget.setText("Please try again.");
                        //Add to the log and increment attempt counter by 1
                        logAttempt(username);
                        authAttempts++;
                        
                    }
                } else {
                    //If lockout counter has reached 5
                    grid.setVisible(false);
                    GridPane grid3 = new GridPane();
                    // Align to Center
                    // Note Position is geometric object for alignment
                    grid3.setAlignment(Pos.CENTER);
                     // Set gap between the components
                    // Larger numbers mean bigger spaces
                    grid3.setHgap(10);
                    grid3.setVgap(10);
                    Text scenetitle = new Text("Account Login Locked");
                    scenetitle.setFill(Color.FIREBRICK);
                    // Add text to grid 0,0 span 2 columns, 1 row
                    grid3.add(scenetitle, 0, 0, 2, 1);
                    Scene scene = new Scene(grid3, 500, 400);
                    primaryStage.setScene(scene);
                    primaryStage.show();
                }

            }
        });
        

        // Set the size of Scene
        Scene scene = new Scene(grid, 700, 600); //enlarge scene to fit system use message
        primaryStage.setScene(scene);
        primaryStage.show();
    }

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        launch(args);
    }


    public boolean authenticate(String user, String pword, int usercode, int code) {
        boolean isValid = false;
        
        if (user.equalsIgnoreCase("sdevadmin")
                && pword.equals("425!pass") 
                && usercode == code){
            isValid = true;
        }
        return isValid;
    }
    
    public static void logAttempt(String username) {
        
        String timestamp = new SimpleDateFormat("yyyy.MM.dd.HH.mm.ss").format(new Date());
        int currentMins = timestampEntry();
        
        // declaring variables of logEntry and initializing the buffered writer
        String logEntry = "Username: " + username + ", Failed login time: " + timestamp + " -" +
                        currentMins + "\n";
        BufferedWriter writer = null;
        
        //write the entry and variables using the bufferedWriter to Authlog.txt
        try {
            writer = new BufferedWriter(new FileWriter("AuthLog.txt"));
            writer.write(logEntry);
        }
        //print error message if an error occurs
        catch (IOException io) {
            System.out.println("File IO Exception" + io.getMessage());
        }
        //finally statement to close file when write action has been completed
        finally {
            try {
                if (writer != null) {
                    writer.close();
                }
            }
            //print error message if there is one
            catch (IOException io) {
                System.out.println("Error: " + io.getMessage());
            }
        }
        
    }
     
    public static boolean checkLog(String username) {
        
        boolean recentAttempt = true;
        int attempts = 0;
        int currentMins = timestampEntry();
        
        BufferedReader inputStream = null;
        String fileLine;
        String filename = "AuthLog.txt";
        
        try {
            inputStream = new BufferedReader(new FileReader(filename));

            // Read one Line using BufferedReader
            while ((fileLine = inputStream.readLine()) != null) {
              
                //Check for recent login attempts by the same user
                if (fileLine.contains(username)) {
                    //check the portion of the log that contains the timestamps in minutes
                    String attemptMins = fileLine.substring(fileLine.lastIndexOf('-') + 1);
                    int attemptMinsInt = Integer.parseInt(attemptMins);
                    //lockout counter reset time set to 2mins for testing purposes
                    if ((currentMins - attemptMinsInt) < 2) {
                        attempts++;
                    }
                }
            } 
            
        } catch (IOException io) {
            System.out.println("File IO exception" + io.getMessage());
        } finally {
            // Need another catch for closing 
            // the streams          
            try {
                if (inputStream != null) {
                    inputStream.close();
                }
            } catch (IOException io) {
                System.out.println("Issue closing the Files" + io.getMessage());
            } 
        }
        if (attempts == 0) {
            recentAttempt = false;
        } 
        return recentAttempt;
    } 
    
    public static int timestampEntry() {
        //Express the current time in minutes
        String year = new SimpleDateFormat("yy").format(new Date());
        String month = new SimpleDateFormat("MM").format(new Date());
        String day = new SimpleDateFormat("dd").format(new Date());
        String min = new SimpleDateFormat("mm").format(new Date());
        int totalMin = (Integer.parseInt(year)*525600)+(Integer.parseInt(month)*43800)+
                (Integer.parseInt(day)*1440)+Integer.parseInt(min);
        return totalMin;    
    }
    
    public static int codeGen() {
        //Generate a random code and email it
        int codeInt = ThreadLocalRandom.current().nextInt(10000000, 99999999);
        String code = Integer.toString(codeInt);
        
        Properties props = new Properties();
                props.put("mail.smtp.auth", "true");
                props.put("mail.smtp.starttls.enable", "true");
                props.put("mail.smtp.host", "smtp.gmail.com");
                props.put("mail.smtp.port", "587");
                props.put("mail.smtp.ssl.trust", "smtp.gmail.com");

		Session session = Session.getDefaultInstance(props,
			new javax.mail.Authenticator() {
				protected PasswordAuthentication getPasswordAuthentication() {
					return new PasswordAuthentication("galensdev425","sdevtest001");
				}
			});

		try {
			Message message = new MimeMessage(session);
			message.setFrom(new InternetAddress("galensdev425@gmail.com"));
                        message.setRecipients(Message.RecipientType.TO,
					InternetAddress.parse("galensdev425@gmail.com"));
			message.setSubject("Authentication Code");
			message.setText(code);
                        Transport.send(message);

		} catch (MessagingException e) {
			throw new RuntimeException(e);
		}   
        //System.out.println("Authorization Code is " + code + "\n");
        return codeInt;
    }
}