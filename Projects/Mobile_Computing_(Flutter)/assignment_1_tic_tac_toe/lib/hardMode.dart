import 'package:flutter/material.dart';
import 'main.dart'; // Main menu

// Create button with reference to state
class HardModeButton extends StatefulWidget {
  @override
  _HardModeButtonState createState() => _HardModeButtonState();
}

// Define state of button
class _HardModeButtonState extends State<HardModeButton>{
  bool _isSelected = true;
  int clickCounter = 0;

   // Check button selection
  void _markSelected(){
    setState(() {
      if (clickCounter < 1) {
        if (_isSelected) {
          _isSelected = false;
        } else {
         _isSelected = true;
        }
        clickCounter++;
      }
    });
  }

  // Update UI on click
  @override
  Widget build(BuildContext context) {
    return IconButton(
      icon: (
        // Icon image used
        _isSelected ? Icon(Icons.crop_square) : Icon(Icons.wifi)),
        iconSize: 40.0,
        color: Colors.white, // Color of the icon in use
        onPressed: _markSelected, // Action to run on click
    );
  }
}

class HardMode extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return new Scaffold(
      // Forms an App Bar which serves as a title bar
      appBar: AppBar(
        title: Text('Git Gud', 
          style: TextStyle(
            // Loads custom font for text
            fontFamily: 'Mrs Sheppards'
          ),
        ),
        backgroundColor: Colors.red,
      ),
      // Main section of app UI
      body: new Material(
        child: new Container(
          // Add padding on each axis
          padding: const EdgeInsets.all(10.0),
          // Changes background color
          color: Colors.red[100],
          child: new Container(
            // Places content in the center of the screen
            child: new Center(
              child: new Column(children: <Widget>[
                  new Padding(padding: EdgeInsets.only(top: 60.0)),
                  new Text(
                    'Level : Hard', 
                    style: new TextStyle(
                      color: Colors.redAccent,
                      fontSize: 25.0,
                      fontWeight: FontWeight.bold,
                      fontFamily: 'Mrs Sheppards'
                      ),
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
                              Material(
                                // Creates shadows on widget
                                elevation: 3.0,
                                // Matches widget shape with ink
                                shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50)),
                                // Creates the splash animation layer for IconButton
                                child: Ink(
                                  // Allow define dimensions for each box
                                    width: 80.0,
                                    height: 80.0,
                                    decoration: ShapeDecoration(
                                      color: Colors.red,
                                      // Defines the shape of the border of the Ink layer
                                      shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50))
                                    ),
                                    // Forms an clickable button with an icon
                                    child: HardModeButton()
                                    ),),
                              // Button 2
                              Material(
                                // Creates shadows on widget
                                elevation: 3.0,
                                // Matches widget shape with ink
                                shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50)),
                                // Creates the splash animation layer for IconButton
                                child: Ink(
                                  // Allow define dimensions for each box
                                    width: 80.0,
                                    height: 80.0,
                                    decoration: ShapeDecoration(
                                      color: Colors.red,
                                      // Defines the shape of the border of the Ink layer
                                      shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50))
                                    ),
                                    // Forms an clickable button with an icon
                                    child: HardModeButton()
                                    ),),
                              // Button 3
                              Material(
                                // Creates shadows on widget
                                elevation: 3.0,
                                // Matches widget shape with ink
                                shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50)),
                                // Creates the splash animation layer for IconButton
                                child: Ink(
                                  // Allow define dimensions for each box
                                    width: 80.0,
                                    height: 80.0,
                                    decoration: ShapeDecoration(
                                      color: Colors.red,
                                      // Defines the shape of the border of the Ink layer
                                      shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50))
                                    ),
                                    // Forms an clickable button with an icon
                                    child: HardModeButton()
                                    ),),
                            ],
                          ),
                        ),
                        Container(
                          padding: new EdgeInsets.all(10),
                          // 1st row in column
                          child: Row(
                            // Add spacing between each button
                            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                            // Creates multiple child widget horizontally
                            children: <Widget>[
                              // Button 4
                              Material(
                                // Creates shadows on widget
                                elevation: 3.0,
                                // Matches widget shape with ink
                                shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50)),
                                // Creates the splash animation layer for IconButton
                                child: Ink(
                                  // Allow define dimensions for each box
                                    width: 80.0,
                                    height: 80.0,
                                    decoration: ShapeDecoration(
                                      color: Colors.red,
                                      // Defines the shape of the border of the Ink layer
                                      shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50))
                                    ),
                                    // Forms an clickable button with an icon
                                    child: HardModeButton()
                                    ),),
                              // Button 5
                              Material(
                                // Creates shadows on widget
                                elevation: 3.0,
                                // Matches widget shape with ink
                                shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50)),
                                // Creates the splash animation layer for IconButton
                                child: Ink(
                                  // Allow define dimensions for each box
                                    width: 80.0,
                                    height: 80.0,
                                    decoration: ShapeDecoration(
                                      color: Colors.red,
                                      // Defines the shape of the border of the Ink layer
                                      shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50))
                                    ),
                                    // Forms an clickable button with an icon
                                    child: HardModeButton()
                                    ),),
                              // Button 6
                              Material(
                                // Creates shadows on widget
                                elevation: 3.0,
                                // Matches widget shape with ink
                                shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50)),
                                // Creates the splash animation layer for IconButton
                                child: Ink(
                                  // Allow define dimensions for each box
                                    width: 80.0,
                                    height: 80.0,
                                    decoration: ShapeDecoration(
                                      color: Colors.red,
                                      // Defines the shape of the border of the Ink layer
                                      shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50))
                                    ),
                                    // Forms an clickable button with an icon
                                    child: HardModeButton()
                                    ),),
                            ],
                          ),
                        ),
                        Container(
                          padding: new EdgeInsets.all(10),
                          // 1st row in column
                          child: Row(
                            // Add spacing between each button
                            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                            // Creates multiple child widget horizontally
                            children: <Widget>[
                              // Button 7
                              Material(
                                // Creates shadows on widget
                                elevation: 3.0,
                                // Matches widget shape with ink
                                shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50)),
                                // Creates the splash animation layer for IconButton
                                child: Ink(
                                  // Allow define dimensions for each box
                                    width: 80.0,
                                    height: 80.0,
                                    decoration: ShapeDecoration(
                                      color: Colors.red,
                                      // Defines the shape of the border of the Ink layer
                                      shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50))
                                    ),
                                    // Forms an clickable button with an icon
                                    child: HardModeButton()
                                    ),),
                              // Button 8
                              Material(
                                // Creates shadows on widget
                                elevation: 3.0,
                                // Matches widget shape with ink
                                shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50)),
                                // Creates the splash animation layer for IconButton
                                child: Ink(
                                  // Allow define dimensions for each box
                                    width: 80.0,
                                    height: 80.0,
                                    decoration: ShapeDecoration(
                                      color: Colors.red,
                                      // Defines the shape of the border of the Ink layer
                                      shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50))
                                    ),
                                    // Forms an clickable button with an icon
                                    child: HardModeButton()
                                    ),),
                              // Button 9
                              Material(
                                // Creates shadows on widget
                                elevation: 3.0,
                                // Matches widget shape with ink
                                shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50)),
                                // Creates the splash animation layer for IconButton
                                child: Ink(
                                  // Allow define dimensions for each box
                                    width: 80.0,
                                    height: 80.0,
                                    decoration: ShapeDecoration(
                                      color: Colors.red,
                                      // Defines the shape of the border of the Ink layer
                                      shape: BeveledRectangleBorder(borderRadius: BorderRadius.circular(50))
                                    ),
                                    // Forms an clickable button with an icon
                                    child: HardModeButton()
                                    ),),
                            ],
                          ),
                        ),
                      ],
                    ),
                  ),
                  //
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
                        // Removes current page
                        onPressed: (){
                          Navigator.pop(
                            context,
                            new MaterialPageRoute(
                              // Allow returning to main menu
                              builder: (context) => HomeScreen()
                              ),
                          );
                        },
                        child:
                          Text("Return", textAlign: TextAlign.center, style: TextStyle(
                              fontFamily: 'Mrs Sheppards'
                            ),
                          ),
                        ))),
              ])),
          ))));
  }
}