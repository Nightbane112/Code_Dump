import 'package:flutter/material.dart';
import "CALCULTE GPA.dart";
import "CGPA.dart";
import "LIST OF COURSES.dart";


void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return new MaterialApp(home: new HomeScreen());
  }
}
class HomeScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    Color hexToColor(String code) {
      return new Color(int.parse(code.substring(1, 7), radix: 16) + 0xFF000000);

    }


    return new Scaffold(
        appBar: AppBar(title: Text('CGPA CALCULATOR'),//title at the top
          backgroundColor: Colors.black12,), //Color of AppBar
        body: new Material(
            color: Colors.deepOrangeAccent,
            child: new Container(
              decoration: new BoxDecoration (
                image: new DecorationImage(image: new AssetImage('assets/grad.png')),//background image
              )
              ,child: new Center(
                child: new Column(children: [



                  new Container(
                      padding: new EdgeInsets.only(top: 130.0),
                      child: new Material(
                          elevation: 30.0,
                          borderRadius: BorderRadius.circular(10.0),
                          color: Colors.white,
                          child: MaterialButton(
                              minWidth: 200.0,
                              padding:
                              EdgeInsets.fromLTRB(20.0, 38.0, 20.0, 38.0), //text alignment
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  new MaterialPageRoute(
                                      builder: (context) => Calcultegpa()),
                                );
                              },
                              child: Text("CALCULATE GPA", textAlign: TextAlign.center,
                                  style: new TextStyle(color: Colors.black, fontSize: 30.0, fontFamily: 'Times New Roman'),),
                          ))),
                  new Container(
                      padding: new EdgeInsets.only(top: 80.0),
                      child: new Material(
                          elevation: 15.0,
                          borderRadius: BorderRadius.circular(10.0),
                          color: Colors.white,
                          child: MaterialButton(
                              minWidth: 150.0,
                              padding:
                              EdgeInsets.fromLTRB(100.0, 30.0, 100.0, 30.0),
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  new MaterialPageRoute(
                                      builder: (context) => Cgpa()),
                                );
                              },
                              child:
                              Text ("CGPA", textAlign: TextAlign.center,
                                style: new TextStyle(color: Colors.black, fontSize: 30.0, fontFamily: 'Times New Roman'),)
                          ))),
                  new Container(
                      padding: new EdgeInsets.only(top: 80.0),
                      child: new Material(
                          elevation: 15.0,
                          borderRadius: BorderRadius.circular(10.0),
                          color: Colors.white,
                          child: MaterialButton(
                              minWidth: 150.0,
                              padding:
                              EdgeInsets.fromLTRB(10.0, 30.0, 10.0, 30.0),
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  new MaterialPageRoute(
                                      builder: (context) => Listofcourses()),
                                );
                              },
                              child:
                              Text("LIST OF COURSES", textAlign: TextAlign.center,
                                style: new TextStyle(color: Colors.black, fontSize: 30.0, fontFamily: 'Times New Roman'),),
                          ))),
                ])),
            )));
  }

}