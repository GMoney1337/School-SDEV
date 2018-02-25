/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package guitest;

import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.event.ActionEvent;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.GridPane;
import javafx.stage.Stage;

/**
 *
 * @author GMoney
 */
public class GUITest extends Application {
    Button btnscene1, btnscene2;
    Label lblscene1, lblscene2;
    GridPane pane1, pane2;
    Scene scene1, scene2;
    Stage thestage;
    
    @Override
    public void start(Stage primaryStage) {
        //can now use the stage in other methods 
        thestage=primaryStage;
        
         
          //make 2 Panes
         pane1=new GridPane();
         pane1.setAlignment(Pos.CENTER);
         pane2=new GridPane();
         pane2.setAlignment(Pos.CENTER);
         pane1.setVgap(10);
         pane1.setHgap(10);
         pane2.setVgap(10);
         pane2.setHgap(10);
        
        //make things to put on panes
        btnscene1=new Button("Proceed to Login");
        
        btnscene2=new Button("Login");
        btnscene1.setOnAction(e-> ButtonClicked(e));
        lblscene1=new Label("Scene 1");
        lblscene2=new Label("Scene 2");

        

         //set background color of each Pane


         //add everything to panes
         pane1.getChildren().addAll(lblscene1, btnscene1);
         pane2.getChildren().addAll(lblscene2, btnscene2);
         
                 //make 2 scenes from 2 panes
        scene1 = new Scene(pane1, 500, 400);
        scene2 = new Scene(pane2, 500, 400);
        
        primaryStage.setTitle("SDEV 425 Login");
        primaryStage.setScene(scene1);
        primaryStage.show();
    }
    
     public void ButtonClicked(ActionEvent e)
    {
        if (e.getSource()==btnscene1){
            thestage.setScene(scene2);
        }else{
            thestage.setScene(scene1);}
    }
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        launch(args);
    }
    
}
