<?php
defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$menu = $app->getMenu();
$option = JRequest::GetWord('option');

$doc -> addStyleSheet('templates/' . $this->template . '/css/main.css');
$doc -> addScript('templates/' . $this->template . '/js/main.js', 'text/javascript');
$showLeftColumn = $this->countModules('left');
$showRightColumn = $this->countModules('right');
$classContent = '';
if ($option != 'com_search') {
    if ($showLeftColumn && $showRightColumn) {
        $classContent = 'bothbar';
    } else if (!$showLeftColumn && $showRightColumn) {
        $classContent = 'rightbar';
    } else if ($showLeftColumn && !$showRightColumn) {
        $classContent = 'leftbar';
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<jdoc:include type="head" />
</head>

<?php if ($menu->getActive() == $menu->getDefault()) { ?>
    <body class="index">
<?php } else { ?>
    <body>
<?php } ?>

<header class="container">

    <h1>
        <a href="<?php echo $this->baseurl; ?>"><?php echo $app->getCfg('sitename'); ?></a>
    </h1>

    <?php if($this->countModules('search')) : ?>
        <div id="search">
            <jdoc:include type="modules" name="search" style="none" />
        </div>
    <?php endif; ?>

    <?php if ($this->countModules('menu')) : ?>
        <nav>
            <jdoc:include type="modules" name="menu" style="none" />
        </nav>
    <?php endif; ?>

</header>

<section class="container">        

    <article class="<?php echo $classContent; ?>">

        <?php if($this->countModules('breadcrumbs')) : ?>
            <div id="breadcrumbs">
                <p>You are in:</p>
                <jdoc:include type="modules" name="breadcrumbs" style="none" />
            </div>
        <?php endif; ?>

        <jdoc:include type="message" />

        <?php if ($menu->getActive() != $menu->getDefault()) { ?>
            <jdoc:include type="component" />
        <?php } ?>

        <?php if ($option != 'com_search' && $this->countModules('content')) : ?>
            <jdoc:include type="modules" name="content" style="xhtml" />
        <?php endif; ?>

    </article>

    <?php if ($option != 'com_search' && $this->countModules('left')) : ?>
        <aside class="left">
            <jdoc:include type="modules" name="left" style="xhtml" />
        </aside>
    <?php endif; ?>

    <?php if ($option != 'com_search' && $this->countModules('right')) : ?>
        <aside class="right">
            <jdoc:include type="modules" name="right" style="xhtml" />
        </aside>
    <?php endif; ?>

</section>

<footer class="container">

    <?php if($this->countModules('footer')) : ?>
        <jdoc:include type="modules" name="footer" style="none" />
    <?php endif; ?>

    <?php echo '<dl>
        <dt>Template</dt>
        <dd>Joomla Blank Template</dd>
        <dt>Developed by</dt>
        <dd><a href="http://solutibrasil.com.br">http://solutibrasil.com.br</a></dd>
        <dt>E-mail</dt>
        <dd><a href="mailto:contato@solutibrasil.com.br">contato@solutibrasil.com.br</a></dd>
    </dl>
    <a href="#" id="go-to-top">Go to Top</a>'; ?>

</footer>

<jdoc:include type="modules" name="debug" style="none" />

</body>
</html>