import 'package:flutter/material.dart';

// Define dialog properties
class PromptDialog extends StatelessWidget {
  final title;
  final content;
  final VoidCallback callback;
  final actionText;

  PromptDialog(
    this.title, // Title of dialog
    this.content, // Display message
    this.callback, // Action to perform upon dialog button click
    [this.actionText = "Reset"] // Button text / label
  );

  // Widget UI
  @override
  Widget build(BuildContext context) {
    return new AlertDialog(
      title: new Text(title),
      content: new Text(content),
      actions: <Widget>[
        new FlatButton(
          onPressed: callback,
          color: Colors.white,
          child: new Text(actionText),
        )
      ],
    );
  }
}
