<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- code mirror -->
    <script src="codemirror/lib/codemirror.js"></script>
<link rel="stylesheet" href="codemirror/lib/codemirror.css">
<link rel="stylesheet" href="codemirror/theme/ayu-mirage.css">
<script src="codemirror/mode/clike/clike.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            text-align: center;
            margin: 30px;
        }
        p {
            text-align: justify;
        }

        

        

        em{
            text-decoration: underline;
        }
        footer{
            margin: 30px
        }
        .q{
            font-family:'Space Grotesk';
            font-size: 3em;
        }

        .comm{
            font-size: 30em;
            position: fixed;
            z-index: -9999;
            margin: 0;
            opacity: .1;
            top: 0;
            line-height: 1em;;
        }

        .CodeMirror{
            width: 100%; 
            height: 80vh; 
            /* resize:none; */
            margin-bottom: 50px;
            /* background-color: #555; */
            /* font-family: monospace; */
            /* font-size: 1.3em; */
            text-align: left;
        }

        

    </style>

    <title>Commentator | Comments are about storytelling.</title>
</head>
<body>
    <div class="comm">/*</div>

    
    <div class="container center">
        <h1>/*Commentator*/</h1>
        <h3>Comments are about <u>storytelling</u>.</h3>
        

        <div class="quote">
            <p><span class="q">"</span>Beginner programming students have asked me "We're required to comment our code. What makes good comments?" Answering this question is always difficult. What constitutes good comments is often quite subjective and there is no definite answer. We just hammer the idea in the students' minds that they need to write comments. Then we judge them on what they have written with rules like "Explain the why, not the how." and "Be succint but not too much."</p>
            <p>I still don't have a perfect answer but here's a different approach: "Do your comments tell a story?" If we were to strip your source file of all its code and retain only the comments, could we read what's left and still understand what is going on? Of course, we wouldn't exactly expect a coherent story but I think it's an avenue worth exploring.</p>
            <p>OK, so how do you strip a source file of its code? You could use your imagination... or you could use software. Enter commentator.</p>
            <p>commentator is a command line tool used to strip files of C or C++ source code from the code they contain, leaving whitespace in its place and preserving only the comments. For a given file source.c it produces a file source.comments.c with only the whitespace and comments retained. The code it contained is converted to whitespace. Though it may look weird to look at "Swiss cheese" produced by the code's absence, I think it is interesting nonetheless from the perspective of "comments as a story".</p>
            <p>For the time being, I expect I'll be the only one using this tool for my grading benefits. For it to be as painless as possible to use for students, <em>I can imagine it being turned into a web API and corresponding friendly site.</em></p>
            <p>~Prof. Thierry Seegers</p>
        </div>

        <div class="editor">
            <h2>Try it!</h2>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-12">
                    <p class="text-center"><b>Code:</b> <br/><small>You can drag and drop your C/C++ file to this editor and magically strip it out of its code.</small></p>
                    <div class="editorarea " id="editorarea1"></div>
                </div>
                <div class="col-lg-6 col-12">
                    <p class="text-center"><b>Comments:</b> <br/><small>Now, do these comments tell a good story ?</small></p>
                    <div class="editorarea" id="editorarea2"></div>
                </div>
            </div>
            <a id="download_link1" download="code.cpp" href=”” class="btn btn-success">Download Code</a>

            <a id="download_link2" download="comments.cpp" href=”” class="btn btn-primary">Download Comments</a>
           
        </div>
        
        
    </div>


    <div id="editor-value" style="display: none;"></div>
    <script>

        var initCode = `#include<stdio.h> //includes stdio
int main() //main function
{
	puts("Hello World!"); //prints "Hello World!" 
	return 0; //returns 0 to shell
}
`;

    var myCodeMirrorSource = CodeMirror(document.getElementById("editorarea1"), {
        value: '',
        mode:  "clike",
        theme: "ayu-mirage",
        lineNumbers: true,
        dragDrop: true,
        
    });

    var myCodeMirrorComments = CodeMirror(document.getElementById("editorarea2"), {
        value: ``,
        mode:  "clike",
        theme: "ayu-mirage",
        lineNumbers: true,
        readOnly: true,
    });




    
    CodeMirror.on(myCodeMirrorSource, "change", function(){
        var text = myCodeMirrorSource.doc.getValue();
        
        var data = new Blob([text], {type: 'text/plain'});

        var url = window.URL.createObjectURL(data);

        document.getElementById('download_link1').href = url;

        var formdata = new FormData();
        formdata.append("code", myCodeMirrorSource.doc.getValue());
    
        
        fetch("process-live.php", {
            method: "POST",
            body: formdata
        })
        .then((response)=>{
            response.text().then(function(responseString) { 
                myCodeMirrorComments.doc.setValue(responseString);
                var text = responseString;
                var data = new Blob([text], {type: 'text/plain'});

                var url = window.URL.createObjectURL(data);

                document.getElementById('download_link2').href = url;
            });
        })
        .catch((err)=>{
            console.log("error with request\n", err);
        })
    });

    myCodeMirrorSource.doc.setValue(initCode);


    CodeMirror.on(myCodeMirrorSource, "dragover", function(){
        myCodeMirrorSource.doc.setValue("");
    });

    document.getElementById("editorarea1").addEventListener("mouseover", function(){
        myCodeMirrorSource.focus();
    });

    document.getElementById("editorarea2").addEventListener("mouseover", function(){
        myCodeMirrorComments.focus();
    });

    CodeMirror.on(myCodeMirrorSource, "scroll", function(){
        if(myCodeMirrorSource.hasFocus()){
            var {top, left} = myCodeMirrorSource.getScrollInfo();
            myCodeMirrorComments.scrollTo(left, top);
        }
    });

    CodeMirror.on(myCodeMirrorComments, "scroll", function(){
        if(myCodeMirrorComments.hasFocus()){
            var {top, left} = myCodeMirrorComments.getScrollInfo();
            myCodeMirrorSource.scrollTo(left, top);
        }
    });
	

	
    </script> 
    
    
    <footer><small>Made with ♥️ by <a href="https://github.com/bouzinabdotcom" target="blank">Omar Bouzinab</a> using Prof. Thierry Seegers's <a href="https://github.com/thierryseegers/Commentator" target="blank">Commentator</a>. </small></footer>
    
</body>
</html>
