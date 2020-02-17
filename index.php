<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'Blackjack.php';
require 'Participant.php';
require 'Dealer.php';

session_start();

if(!isset($_SESSION['blackjack']) || isset($_GET['nuke'])) {
    $_SESSION['blackjack'] = new Blackjack();
}

if(isset($_POST['action'])) {
    switch($_POST['action']) {
        case 'hit':
            $_SESSION['blackjack']->getPlayer()->hit();

//            $_SESSION['blackjack']->dealerPlays();

            if($_SESSION['blackjack']->getDealer()->canContinue()) {
                //$_SESSION['blackjack']->getDealer()->hit();
            }

            break;
        case 'stand':
            $_SESSION['blackjack']->dealerPlays();

            $_SESSION['blackjack']->checkWinner();
            break;
        case 'surrender':
            $_SESSION['blackjack']->getPlayer()->surrender();
            $_SESSION['blackjack']->checkWinner();
            break;
    }
}


$blackjack = $_SESSION['blackjack'];
if($_SESSION['blackjack']->doWeHaveAWinner()) {
    $_SESSION['blackjack'] = new Blackjack();
}
echo $blackjack->getWinner();
?>

<form method="post">
    <button type="submit" name="action" value="hit">Hit</button>
    <button type="submit" name="action" value="stand">Stand</button>
    <button type="submit" name="action" value="surrender">Surrender</button>
</form>


    <p>Player score: <?php echo $blackjack->getPlayer()->getScore()?></p>
    <p>Dealer score: <?php echo $blackjack->getDealer()->getScore()?></p>

<?php if($blackjack->doWeHaveAWinner()):?>
        <p>The <?php echo $blackjack->getWinner()?> won!</p>
<?php endif;?>