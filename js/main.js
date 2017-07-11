$(function () {

    /*
        Table OF Contents:
        =================
        1- CodeMirror Configurations / Ajax Request 
        2- Firebase App Configuration 
    */

/* ============================ Start CodeMirror ============================================== */

    // Array To Store Our Values OF The Code Editor
    var widgets = []

    // Show Errors When It Occurs in Any Code
    function createLineWidget(line, message) {
        var msg = document.createElement("div");
        var icon = msg.appendChild(document.createElement("span"));
        icon.innerHTML = "!!!";
        icon.className = "lint-error-icon";
        msg.appendChild(document.createTextNode(message));
        msg.className = "lint-error";

        widgets.push(editor.addLineWidget(line, msg, {coverGutter: false, noHScroll: true}));
    }

    // Create CodeMirror
    var editor = CodeMirror(document.getElementById('firepad'), {
        matchBrackets: true,
        lineNumbers: true,
        styleActiveLine: true,
        mode: 'php',
        indentUnit: 4,
        indentWithTabs: true,
        enterMode: 'keep',
        theme : 'base16-dark',
        tabMode: 'shift',
        gutters: ["CodeMirror-lint-markers", "CodeMirror-linenumbers"],
        onCursorActivity: function() {
            editor.addLineClass(hlLine, null);
            hlLine = editor.addLineClass(editor.getCursor().line, "CodeMirror-activeline-background");
        }
    });


    // To Remove Line Error Hint After Correction
    function resetWidgets() {
        for (var i = 0; i < widgets.length; ++i)
        editor.removeLineWidget(widgets[i]);
        widgets.length = 0;
    }

    // To Remove Higlighted Error Line After Correction
    function resetLineClasses()
    {
        lineCount = editor.doc.size;
        for (var i = 0; i < lineCount; ++i)
            editor.removeLineClass(i, "background");
    }

    // Function When Programmer Click Run Button
    function submit() {
        var call = $.ajax({
            type: "POST",
            url: "result.php",
            data: "code=" + editor.getValue(),
            dataType: 'text',
            success: function(result){

                // Store The Result Inside The Result Div
                $("div.result").html(result);

                // Handle The Error
                var error = $.parseJSON( call.getResponseHeader("All-Error") );

                // Check IF There An Error
                if(error) {

                    // Make Highlight ON The Error Line
                    editor.addLineClass(error.line, "background", "CodeMirror-highlightErrorline-background");

                    // Focus ON The Line Which Have The Error
                    editor.setCursor({line: error.line+1});
                    editor.focus();

                    // Make The Error Line Above The Code Line
                    createLineWidget(error.line-1, error.message);

                // IF There're Not Errors Reset All Errors Hints
            } else {
                    resetWidgets();
                    resetLineClasses();
                }
            }
        });

        // Animation Structure
        $("#firepad").animate({
            width:"45%",
            right:"35%"
        }, 1000)
    }
            
        // Run Button Submit The Code
        $("div.btn-code").click(function (){
            submit();
        });

        // key "F1" To Submit The Code"
        CodeMirror.keyMap.LiveEditor = {
            'F5': function(cm) {
                submit();
            },
            fallthrough: 'pcDefault'
        };
/* ============================ End CodeMirror ============================================== */



/* ============================ Start FireBase & Firepad ======================================  */

    // Initialize Our Firebase Application
    var config = {
        apiKey: "AIzaSyDfJ3kz1wzuZrAlYCyKjuSH_aD7J18hQC4",
        authDomain: "webw-online-editor.firebaseapp.com",
        databaseURL: "https://webw-online-editor.firebaseio.com",
    };
    firebase.initializeApp(config);


    // Get Firebase Database Reference.
    var firepadRef = getExampleRef();

   
    // Create A Random ID To Use As Our User ID.
    var userId = Math.floor(Math.random() * 99).toString();

    //// Create Firepad With Our DB Reference, CodeMirror And The User ID.
    var firepad = Firepad.fromCodeMirror(firepadRef, editor,{ 
        userId: userId,
    });

    //// Create Firepad UserList With Our DB Reference And The userId.
    var firepadUserList = FirepadUserList.fromDiv(firepadRef.child('users'),
        document.getElementById('userlist'), userId);

    // Initialize Page Contents With Specific Start Phrase.
    firepad.on('ready', function() {
        if (firepad.isHistoryEmpty()) {
            firepad.setText(
                '<?php \necho "Test Your First Code With WEBW Online Editor" . "<br>";\necho "Created By: Walled Mahmoud";'
            );
        }
    });


    // Function To Get Hash From End OF URL OR Generate A Random One.
    function getExampleRef() {

        // Connect With The Firebase Database
        var ref = firebase.database().ref();

        var hash = window.location.hash.replace(/#/g, 'WEBW');

        // Check IF The Hash is Exist
        if (hash) {

             ref = ref.child(hash);

        } else {

            // Generate Unique Location.
            ref = ref.push();

            // Add It As A Hash To The URL.
            window.location += '#' + ref.key;
        }

        // Show The Firebase Connection IF Everything Is OK!
        if (typeof console !== 'undefined') {
            console.log('Firebase data: ', ref.toString());
        }

        return ref;
    }




    /* ============================ End FireBase & Firepad ======================================  */
});
