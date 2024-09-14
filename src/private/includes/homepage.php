<!DOCTYPE html>
<html lang="en">
<?php 
    $page_name = "Hello | A messaging app";
    include_once("header.php")
?>
<body class="container-fluid vh-100 m-0 g-0">
    <nav class="navbar navbar-expand-lg" id="navBar">
        <svg
            width="150"
            height="80"
            viewBox="0 0 135.46667 135.46667"
            version="1.1"
            id="svg1"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:svg="http://www.w3.org/2000/svg">
            <defs
                id="defs1">
                <rect
                x="35.695822"
                y="104.04952"
                width="431.38781"
                height="219.49133"
                id="rect1" />
            </defs>
            <g
                id="layer1">
                <text
                xml:space="preserve"
                transform="matrix(0.68621181,0,0,0.71161713,-105.34506,-73.467357)"
                id="text1"
                style="font-size:162.667px;white-space:pre;shape-inside:url(#rect1);display:inline;fill:#000000;stroke-width:0"
                x="12.983988"
                y="0"><tspan
                    x="159.97075"
                    y="256.14248"
                    id="tspan4"><tspan
                    style="font-family:Sansilk;-inkscape-font-specification:Sansilk;text-align:center;text-anchor:middle"
                    id="tspan1">hello</tspan></tspan></text>
            </g>
        </svg>
    </nav>
    <div class="container-fluid hero">
        <div class="row">
            <div class="col-6 headline-container">
                <h1 class="headline">Connect with friends. Whenever, Wherever<sup style="font-size: 30%; top: -1.7em; margin-left: 0.3rem">1</sup>.</h1>
                <p class="fs-6 fw-light">Hello provides a way to connect with friends.</p>
                <div class="row">
                    <form name="signup" method="post">
                        <input type="text" name="email" id="email" placeholder="E-Mail Address">
                        <input type="password" name="password" id="password" placeholder="Password">
                        <button type="submit">Signup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include_once("js_components.php")?>
</body>
</html>