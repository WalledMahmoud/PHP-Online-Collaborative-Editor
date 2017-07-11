<?php

    // Report All PHP Errors And Show Them
    error_reporting(E_ALL); // E_ALL or -1
    ini_set('display_errors', 'on');


    // Send HTTP Header Before Get Outputs To Set Encoding
    header('Content-Type: text/html; charset=UTF-8');


    // Store The Data That Coming From Ajax Request 
    $code = $_POST['code'];
    
    // Check IF The Code is Running
    if (isset($code) !== false) {

        /*
        - Remove PHP Start And End Tags
        - ^< : Anchors The Match To The Beginning OF The String With < Mark.
        - <\?php : Matches The Specific tag ?php.
        - (.*) : Matches Any Charachter Until The End OF The String
        - (\?>) : Matches The Specific Tag ?>.
        - ?$ : Anchors The Pattern To The End OF The String.
        - /s : Metacharacter Is Used To Find A Whitespace Character.
        - '$1' : Is a Back References To The Matches
        */ 
        $code = preg_replace('/^<\?php(.*)(\?>)?$/s', '$1', $code);
        $code = trim($code);

        // Output Buffered
        ob_start();

        // Evaluates The Code as PHP code
        eval($code);
        
        // Returns The Contents OF The Output Buffer .. False IF Empty
        $Buffer = ob_get_clean();

        // Get The Last Errors Occurs Into Associative Array
        $Errors = error_get_last();


        // Check IF There An Error
        if($Errors > 0) {

            /* 
                * We Will Use The Type OF Errors
                * Send The Errors As text/html To The Result Area
                * Array As Json Via Header
            */
            $Errors['error'] = ErrorType($Errors['type']);
            $json = json_encode($Errors, true);
            echo $Errors['error'];
            header('All-Error: '. $json);

        } else {
            // IF There're Not Any Errors Echo The Buffer Contents
            echo $Buffer;
        }
    }

    // Function To Print Error Type in Our Manners
    function ErrorType($e)
    {
        $ErrorTypes = array(
        
            E_CORE_ERROR      => 'Core Error !!',
            E_CORE_WARNING    => 'Core Warning !!',
            E_COMPILE_ERROR   => 'Compile Error !!',
            E_COMPILE_WARNING => 'Compile Warning !!',
            E_USER_ERROR      => 'User Error !!',
            E_USER_WARNING    => 'User Warning !!',
            E_USER_NOTICE     => 'User Notice !!',
            E_ERROR           => 'Error !!',
            E_WARNING         => 'Warning !!',
            E_PARSE           => 'Parsing Error !!',
            E_NOTICE          => 'Notice !!'
        );

        return $ErrorTypes[$e];
    }
?>