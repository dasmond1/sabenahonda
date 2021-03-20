<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For Us Watching Something</title>
    <style type="text/css">
    body,iframe{position:absolute !important;width:100%!important;height:100%!important;background-color: #000!important; overflow: hidden!important;}
    .vid-content {
    width:100%;
    padding-bottom:54%;
    position:relative;
    z-index:6;
    box-shadow:0 0 3px #000;
    -webkit-box-shadow:0 0 3px #000;
    -moz-box-shadow:0 0 3px #000;
    background:#000 
    }
    .fa-3x{
        font-size:4em !important;
    }
    
    .fa-3x:hover{
        font-size:4em !important;
        -webkit-transform: translate(-50%,-50%);
        -moz-transform: translate(-50%,-50%);
        color: #f0f0f0;top: 50%;left: 50%;

    }
    </style>
</head>
<body>
    <iframe src="https://databes.driveplayer.net/player/movie?id=<?= $tt; ?>" width="100%" height="100%" frameborder="0" scrolling="no" allowfullscreen></iframe>
</body>
</html>