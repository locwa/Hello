<?php
    session_start();
    include_once("../private/includes/hello_api.php");

    if (isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($email && $password){
            $accounts = new Accounts();
            $accounts->login($email, $password); 
        }
        else {
            header("Location: ../public/homepage.php");
        }
    }
    else if (isset($_POST['signup'])){
        header("Location: ../public/signup.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    $page_name = "Hello | A messaging app";
    include_once("../private/includes/header.php");
    if(isset($_SESSION['check']) && $_SESSION['check'] == true){
        header("location: inbox.php");
        exit;
    }
?>
<body>
    <nav>
        <a href="homepage.php" class="nav-logo">
            <svg
                width="150"
                height="70"
                viewBox="0 0 180 46.566696"
                version="1.1"
                id="svg1"
                xml:space="preserve"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:svg="http://www.w3.org/2000/svg">
                <defs
                    id="defs1"><rect
                    x="35.695824"
                    y="104.04952"
                    width="431.38782"
                    height="219.49133"
                    id="rect1" /><rect
                    x="35.695824"
                    y="104.04952"
                    width="431.38782"
                    height="219.49133"
                    id="rect1-1" /></defs><g
                    id="layer1"
                    transform="translate(60,-6.6905746)"><text
                    xml:space="preserve"
                    transform="matrix(0.75368191,0,0,0.78158514,-112.92602,-82.823726)"
                    id="text1"
                    style="font-size:72.6962px;white-space:pre;shape-inside:url(#rect1);display:inline;fill:#ffffff;stroke-width:0"
                    x="12.983988"
                    y="0"><tspan
                        x="157.93872"
                        y="170.19329"
                        id="tspan3"><tspan
                        style="font-weight:900;font-family:'Noto Sans';-inkscape-font-specification:'Noto Sans Heavy';text-align:center;text-anchor:middle"
                        id="tspan1">hello</tspan></tspan></text><text
                    xml:space="preserve"
                    transform="matrix(0.75368191,0,0,0.78158514,-115.60872,-80.440226)"
                    id="text1-0"
                    style="font-size:72.6962px;white-space:pre;shape-inside:url(#rect1-1);display:inline;fill:#000000;stroke-width:0"
                    x="12.983988"
                    y="0"><tspan
                        x="157.93872"
                        y="170.19329"
                        id="tspan5"><tspan
                        style="font-weight:900;font-family:'Noto Sans';-inkscape-font-specification:'Noto Sans Heavy';text-align:center;text-anchor:middle"
                        id="tspan4">hello</tspan></tspan></text></g>
            </svg>
        </a>
    </nav>
    <div class="hero">
        <div class="hero-text">
            <h1 class="headline">Connect with friends. Whenever, Wherever.</h1>
            <p class="support">Hello provides a way to connect with your favorite people.</p>
        </div>
        <div class="login-signup-container">
            <form action="homepage.php" method="post" class="login-form">
                <input type="email" name="email" class="landing-input" placeholder="E-mail Address">
                <input type="password" name="password" class="landing-input" placeholder="Password">
                <?php
                if (isset($_GET['error'])) {
                    include_once("../private/includes/errors.php");
                    $error = $_GET['error'];
                    loginError($error);
                }
                ?>
                <button type="submit" name="login" class="btn1">Log in</button>
                <button type="submit" name="signup" class="btn2">Sign up</button>
            </form>
        </div>
    </div>
    <footer>
        <a href="privacy_policy.html">Privacy Policy</a>
        <a href="terms_and_conditions.html">Terms and Conditions</a>
    </footer>
</body>
</html>