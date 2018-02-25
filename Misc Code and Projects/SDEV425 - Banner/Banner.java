/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package banner;

import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.layout.GridPane;
import javafx.scene.text.Text;
import javafx.stage.Stage;

/**
 *
 * @author GMoney
 */
public class Banner extends Application {
    
    Stage mainStage;
    Text banner;
    Scene scene;
    
    public void start(Stage primaryStage) {
            mainStage = primaryStage;
            mainStage.setTitle("SDEV425 Login");
                // Grid Pane divides your window into grids
                GridPane grid = new GridPane();
                // Align to Center
                // Note Position is geometric object for alignment
                grid.setAlignment(Pos.CENTER);
                // Set gap between the components
                // Larger numbers mean bigger spaces
                grid.setHgap(10);
                grid.setVgap(10);
                // Create notification screen/banner to comply with AC-8

                // Create some text to place in the scene
                banner = new Text("You are accessing a U.S. Government (USG)  Information\n"
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
                // Add text to grid 0,0 span 2 columns, 1 row
                grid.add(banner, 0, 0, 2, 1);
                // Create Proceed Button
                Button bannerBtn = new Button("Proceed");
                grid.add(bannerBtn, 1, 4);

                Scene scene = new Scene(grid, 500, 400);
                primaryStage.setScene(scene);
                primaryStage.show();

            }   

    public static void main(String[] args) {
        
        launch(args);
    }
}