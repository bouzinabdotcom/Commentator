<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
        
        <form target="_blank" action="process.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload" style="display: none;" onchange="document.getElementById('uploadfront').value=this.value.replace('C:\\fakepath\\', '');">
            <input class="btn btn-primary" id="uploadfront" type="button" value="Choose file" onclick="document.getElementById('fileToUpload').click();">
            <input type="submit" value="Download Comments" class="btn btn-success" id="submit" disabled>
        </form>
    </div>
    <script>
	
	document.getElementById("fileToUpload")
		.addEventListener('change', function(){
			document.getElementById("submit").disabled=false;
		});
	
    </script> 
    
    
    <footer><small>Made with ♥️ by <a href="https://github.com/bouzinabdotcom" target="blank">Omar Bouzinab</a> using Prof. Thierry Seegers's <a href="https://github.com/thierryseegers/Commentator" target="blank">Commentator</a>. <iframe src="https://ghbtns.com/github-btn.html?user=thierryseegers&repo=Commentator&type=star&count=true" frameborder="0" scrolling="0" width="150" height="20" title="GitHub"></iframe></small></footer>
    
</body>
</html>
