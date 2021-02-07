import 'package:flutter/material.dart';
import 'main.dart'; // Main menu
import 'dart:math'; // Random number generator
import 'promptDialog.dart'; // Message dialog

// Define each button properties
class BtnProp {
  final id; // Add unique id for each button
  bool clicked; // Add a click state for button

  BtnProp(
    // Buttons are not clicked by default
    {this.id, this.clicked = false}
  );
}

// Create each button with reference to state
class TicTacToe extends StatefulWidget {
  @override
  TicTacToeState createState() => TicTacToeState();
}

// Define state of button
class TicTacToeState extends State<TicTacToe>{
  List<BtnProp> btnList ; // Forms a list of buttons using the template from BtnProp class
  var player, comp; // Stores list of button clicks by both player or computer
  bool turn; // Indicates turn of player, false during opponent's turn
  var iconState; // Stores icons state to switch between users

  // Override standard initialisation
  @override
  void initState(){
    // Initialise the current class
    super.initState();
    // Create a customised initialisation
    btnList = doInit();
  }

  // Define initial state of widget tree
  List<BtnProp> doInit(){
    player = new List();
    comp = new List();
    turn = true;

    // Define initial state of buttons
    var gameBtn = <BtnProp>[
      // Assigns each button with a special id
      new BtnProp(id: 1),
      new BtnProp(id: 2),
      new BtnProp(id: 3),
      new BtnProp(id: 4),
      new BtnProp(id: 5),
      new BtnProp(id: 6),
      new BtnProp(id: 7),
      new BtnProp(id: 8),
      new BtnProp(id: 9),
    ];
    return gameBtn;
  }

  // Game logic
  void gameStart(BtnProp gameBtn){
    setState(() {
      // Check clicked status
      if (gameBtn.clicked == false){
        // If player's turn
        if (turn){
          // Store
          iconState = Icon(Icons.clear); 
          player.add(gameBtn.id);
          turn = false;
        } else {
          iconState = Icon(Icons.ac_unit);
          comp.add(gameBtn.id);
          turn = true;
        }
      }
      // Change button property upon click
      gameBtn.clicked = true;
      // Check if button combination triggers game end
      int gameState = checkCombo();
      // Check game status
      if (gameState == 0) {
        if (btnList.every((btn) => btn.clicked == true)){
          // Game draw
          showDialog(
            context: context,
            builder: (_) => new PromptDialog(
              "Draw", // Title
              "Click reset to restart", // Message coontent
              resetGame // Function to run upon button click
              )
          );
        } else if (gameState == 1){
          // Player win
          showDialog(
            context: context,
            builder: (_) => new PromptDialog(
              "Player wins", // Title
              "Click reset to restart", // Message coontent
              resetGame // Function to run upon button click
              )
          );
        } else if (gameState == 2){
          // Computer win
          showDialog(
            context: context,
            builder: (_) => new PromptDialog(
              "Player lose", // Title
              "Click reset to restart", // Message coontent
              resetGame // Function to run upon button click
              )
          );
        }
      } else {
        // Switch player after each turn
        if (!turn) {
          compTurn();
        }
      }
    });
  }

  // Computer automated desicion making
  compTurn(){
    // Create unclicked button list
    var unchosen = new List();

    // Check for each button selected, avoid clicked buttons
    var genList = new List.generate(9, (i) => i + 1);
    for (var boxId in genList){
      if (!(player.contains(boxId)) || comp.contains(boxId)){
        unchosen.add(boxId);
      }
    }

    // Allocate 1 btn for player's 1st move
    var randRange = Random().nextInt(unchosen.length - 1); 
    var boxId = unchosen[randRange];
    // Marks computer selection on to button grid
    int i = btnList.indexWhere((p) => p.id == boxId);
    gameStart(btnList[i]);
  }

  // Check click button combination
  int checkCombo(){
    var gameState = 0;
    
    // 1st row
    if (player.contains(1) && player.contains(2) && player.contains(3)) {
      gameState = 1;
    }
    if (comp.contains(1) && comp.contains(2) && comp.contains(3)) {
      gameState = 2;
    }

    // 2nd row
    if (player.contains(4) && player.contains(5) && player.contains(6)) {
      gameState = 1;
    }
    if (comp.contains(4) && comp.contains(5) && comp.contains(6)) {
      gameState = 2;
    }

    // 3rd Row
    if (player.contains(7) && player.contains(8) && player.contains(9)) {
      gameState = 1;
    }
    if (comp.contains(7) && comp.contains(8) && comp.contains(9)) {
      gameState = 2;
    }

    // 1st Column
    if (player.contains(1) && player.contains(4) && player.contains(7)) {
      gameState = 1;
    }
    if (comp.contains(1) && comp.contains(4) && comp.contains(7)) {
      gameState = 2;
    }

    // 2nd Column
    if (player.contains(2) && player.contains(5) && player.contains(8)) {
      gameState = 1;
    }
    if (comp.contains(2) && comp.contains(5) && comp.contains(8)) {
      gameState = 2;
    }

    // 3rd Column
    if (player.contains(3) && player.contains(6) && player.contains(9)) {
      gameState = 1;
    }
    if (comp.contains(3) && comp.contains(6) && comp.contains(9)) {
      gameState = 2;
    }

    // Diagonal axis check
    if (player.contains(1) && player.contains(5) && player.contains(9)) {
      gameState = 1;
    }
    if (comp.contains(1) && comp.contains(5) && comp.contains(9)) {
      gameState = 2;
    }

    if (player.contains(3) && player.contains(5) && player.contains(7)) {
      gameState = 1;
    }
    if (comp.contains(3) && comp.contains(5) && comp.contains(7)) {
      gameState = 2;
    }
    // Informs calling function upon completion
    return gameState;
  }

  // Call to reset game
  void resetGame() {
    // If dialog can be exitted, allow exit
    if (Navigator.canPop(context)) 
    Navigator.pop(context);
    // Re-init buttons to default states
    setState(() {
      btnList = doInit();
    });
  }

  // Creates an Icon button
  @override
  Widget build(BuildContext context){
    return new IconButton(
      // Icon image used
      icon: iconState ?? Icon(null), // Default (no icon), Changes depending on player's or computer's turn 
      iconSize: 40.0, // Icon size on Icon button
      color: Colors.white, // Color of the icon in use
      disabledColor: Colors.black, // Color of icon when disabled 
      onPressed: () => gameStart(btnList[1]) // Action to run on click
    );
  }
}

// Unify column into one widget
class RowButtons extends StatelessWidget{
  @override
  Widget build(BuildContext context){
    return new Material(
      // Creates shadows on widget
        elevation: 3.0,
        // Creates the splash animation layer for IconButton
        child: Ink(
        // Allow define dimensions for each box
          width: 80.0,
          height: 80.0,
          decoration: ShapeDecoration(
            color: Colors.blue,
            // Defines the shape of the border of the Ink layer
            shape: RoundedRectangleBorder()
          ),
          // Forms an clickable button with an icon
          child: TicTacToe()
        ),);
  }
}

// Main class
class EasyMode extends StatelessWidget{
   // Game UI
  @override
  Widget build(BuildContext context){
    return new Scaffold(
      // Forms an App Bar which serves as a title bar
      appBar: AppBar(
        title: Text('Level : Easy',        
          style: TextStyle(
            // Loads custom font for text
            fontFamily: 'Varela Round'),
        ), 
        backgroundColor: Colors.blue
        ),
      // Main section of app UI
      body: new Material(
        child: new Container(
          // Add padding on each axis
          padding: const EdgeInsets.all(10.0), 
          // Changes background color
          color: Colors.blueAccent[100],
          child: new Container(
            // Places content in the center of the screen
            child: new Center(
              child: new Column(children: <Widget>[
                  new Padding(padding: EdgeInsets.only(top: 60.0)),
                  new Text(
                    'Do your best', 
                    style: new TextStyle(
                      color: Colors.blue,
                      fontSize: 25.0, 
                      fontWeight: FontWeight.bold,
                      fontFamily: 'Varela Round',
                      )
                  ),
                  // Adds spacing between text and content
                  new Padding(padding: EdgeInsets.only(top: 30.0),),
                  // Add Tic tac toe
                  new Container(
                    padding: new EdgeInsets.all(10.0),
                    child: Column(
                      // Creates multiple child widget vertically
                      children: <Widget>[
                        Container(
                          padding: new EdgeInsets.all(10),
                          // 1st row in column
                          child: Row(
                            // Add spacing between each button
                            mainAxisAlignment: MainAxisAlignment.spaceEvenly, 
                            // Creates multiple child widget horizontally
                            children: <Widget>[
                              // Button 1
                              RowButtons(),
                              // Button 2
                              RowButtons(),
                              // Button 3
                              RowButtons(),
                            ],
                          ),
                        ),
                        Container(
                          padding: new EdgeInsets.all(10),
                          // 2nd Row in a column
                          child: Row(
                            // Creates multiple child widget horizontally
                            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                            children: <Widget>[
                              // Button 4
                              RowButtons(),
                              // Button 5
                              RowButtons(),
                              // Button 6
                              RowButtons(),
                            ],
                          ),
                        ),
                        Container(
                          padding: new EdgeInsets.all(10),
                          // 3rd Row in column
                          child: Row(
                            // Creates multiple child widget horizontally
                            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                            children: <Widget>[
                              // Button 7
                              RowButtons(),
                              // Button 8
                              RowButtons(),
                              // Button 9
                              RowButtons(),
                            ],
                          ),
                        ),
                      ],
                    ),
                  ),                 
                  // Navigation button to return to front page
                  new Container(
                    padding: new EdgeInsets.only(top: 10.0),
                    child: new Material(
                      elevation: 5.0,
                      // Creates curved corners for buttons
                      borderRadius: new BorderRadius.circular(30.0),
                      color: Colors.grey,
                      child: MaterialButton(
                        minWidth: 300.0,
                        padding: EdgeInsets.fromLTRB(20.0, 15.0, 20.0 ,15.0),
                        onPressed: (){
                          // Removes current page 
                          Navigator.pop(
                            context,
                            new MaterialPageRoute(
                              // Allow returning to main menu
                              builder: (context) => HomeScreen(),
                            )
                          );
                        },
                        child:Text("Return", textAlign: TextAlign.center,style: TextStyle(
                              fontFamily: 'Varela Round'
                            ),)
                      ))),
              ])),
          ))));
  }
}