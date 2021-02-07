import 'package:flutter/material.dart';
import 'easyMode.dart'; // Easy mode page
import 'mediumMode.dart'; // Medium mode page
import 'hardMode.dart'; // Hard mode page

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: new HomeScreen(), // Creates a class that can be easily called later
      );
  }
}

class HomeScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    // Forms the base of the app UI where everything else is laid onto
    return new Scaffold(
      // Forms an App Bar which serves as a title bar
      appBar: AppBar(
        title: Text('Tic Tac Toe', style: TextStyle(
            // Loads custom font for text
            fontFamily: 'Abel'
          ),
        ),
        backgroundColor: Colors.grey,
        ),
      // Main section of app UI
      body: new Material(
        child: new Container(
          padding: const EdgeInsets.all(30.0),
          // Changes background color
          color: Colors.grey[100],
          child: new Container(
            // Places content in the center of the screen
            child: new Center(
              child: new Column(children: <Widget>[
                  new Padding(padding: EdgeInsets.only(top: 100.0)),
                  new Text(
                    'Choose a difficulty', 
                    style: new TextStyle(
                      color: Colors.grey, 
                      fontSize: 25.0,
                      fontWeight: FontWeight.bold,
                      fontFamily: 'Abel'
                      ),
                  ),
                  // Adds spacing between text and content
                  new Padding(padding: EdgeInsets.only(top: 50.0),),
                  new Container(
                    padding: new EdgeInsets.only(top: 10.0),
                    child: new Material(
                      elevation: 5.0,
                      // Creates curved corners for buttons
                      borderRadius: new BorderRadius.circular(30.0),
                      color: Colors.blue,
                      child: MaterialButton(
                        minWidth: 300.0,
                        padding: EdgeInsets.fromLTRB(20.0, 15.0, 20.0 ,15.0),
                        onPressed: (){
                          // Load Easy mode page on button click
                          Navigator.push(
                            context,
                            new MaterialPageRoute(
                              builder: (context) => EasyMode()
                              ),
                          );
                        },
                        child:
                          Text("Easy", textAlign: TextAlign.center,style: TextStyle(
                              fontFamily: 'Abel', fontSize: 20
                            ),
                          )
                        )
                      )
                    ),
                    new Container(
                    padding: new EdgeInsets.only(top: 10.0),
                    child: new Material(
                      elevation: 5.0,
                      // Creates curved corners for buttons
                      borderRadius: new BorderRadius.circular(30.0),
                      color: Colors.yellow,
                      child: MaterialButton(
                        minWidth: 300.0,
                        padding: EdgeInsets.fromLTRB(20.0, 15.0, 20.0 ,15.0),
                        onPressed: (){
                          // Load Medium mode page on button click
                          Navigator.push(
                            context,
                            new MaterialPageRoute(
                              builder: (context) => MediumMode()
                              ),
                          );
                        },
                        child:
                          Text("Medium", textAlign: TextAlign.center,style: TextStyle(
                              fontFamily: 'Abel', fontSize: 20
                            ),
                          )
                        )
                      )
                    ),
                    new Container(
                      padding: new EdgeInsets.only(top: 10.0),
                      child: new Material(
                        elevation: 5.0,
                        // Creates curved corners for buttons
                        borderRadius: new BorderRadius.circular(30.0),
                        color: Colors.red,
                        child: MaterialButton(
                          minWidth: 300.0,
                          padding: EdgeInsets.fromLTRB(20.0, 15.0, 20.0 ,15.0),
                          onPressed: (){
                            // Load Hard mode page on button click
                            Navigator.push(
                              context,
                              new MaterialPageRoute(
                                builder: (context) => HardMode()
                                ),
                            );
                          },
                          child:
                            Text("Hard", textAlign: TextAlign.center,style: TextStyle(
                              fontFamily: 'Abel', fontSize: 20
                              ),
                            )
                          )
                        )
                      ),
              ])),
          ))));
  }
}