<!-- <!doctype html>
<html>
  <head>
    <script src="https://www.gstatic.com/firebasejs/4.8.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.8.1/firebase-database.js"></script>
    <script>
      // Initialize Firebase
      var config = {
        apiKey: "AIzaSyD-2KiVJY_55E2MRXUQv7FlxhOL6nY-N_U",
        authDomain: "my-development-app.firebaseapp.com",
        databaseURL: "https://my-development-app.firebaseio.com",
        projectId: "my-development-app",
        storageBucket: "my-development-app.appspot.com",
        messagingSenderId: "56730489319"
      };
      firebase.initializeApp(config);
    </script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <link rel='stylesheet' type='text/css' href='/resources/tutorial/css/example.css'>
  </head>
  <body>
    <div id='messagesDiv'></div>
    <input type='text' id='nameInput' placeholder='Name'>
    <input type='text' id='messageInput' placeholder='Message, press enter to submit'>
  
    <script>      
      var myDataRef = firebase.database().ref('chat');
      $('#messageInput').keypress(function (e) {
        if (e.keyCode == 13) {
          var name = $('#nameInput').val();
          var text = $('#messageInput').val();
          // myDataRef.push({name: name, text: text});
          myDataRef.push({
              name: name,
              text: text
          });
          $('#messageInput').val('');
        }
      });
      myDataRef.on('child_added', function(snapshot) {
        var message = snapshot.val();
        displayChatMessage(message.name, message.text);
      });
      myDataRef.on('child_removed', function(snapshot) {
        var deletedPost = snapshot.val();
        console.log("Chat was removed", deletedPost);
      });
      function displayChatMessage(name, text) {
        $('<div/>').text(text).prepend($('<em/>').text(name+': ')).appendTo($('#messagesDiv'));
        $('#messagesDiv')[0].scrollTop = $('#messagesDiv')[0].scrollHeight;
      };
    </script>
  </body>
</html> -->