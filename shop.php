<?php
  require_once 'config.php';
  require_once 'cart_func.php';

  $cartId = getCartId();
  $ini = getIni();
  $papiDomainAndContext = $ini['papiDomainAndContext'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-AU" lang="en-AU">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>qgov-payment-phpclient</title>

  <link rel="stylesheet" type="text/css" href="//static.qgov.net.au/assets/v2/style/qgov.css" media="all" />
  <!--[if lt IE 9]><link rel="stylesheet" href="//static.qgov.net.au/assets/v2/style/qgov-ie.css" type="text/css" media="all" /><![endif]-->
  
  <!-- layout-small is assumed by default (combined with qgov.css) -->
  <link href="//static.qgov.net.au/assets/v2/style/layout-medium.css" media="only all and (min-width: 640px) and (max-width: 980px)" rel="stylesheet" type="text/css" />
  <link href="//static.qgov.net.au/assets/v2/style/layout-large.css" media="only all and (min-width: 980px)" rel="stylesheet" type="text/css" />
    
  <meta name="viewport" content="width=device-width" />
  <!-- Grab Google CDN's jQuery. Fall back to local copy if necessary --> 
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> 
  <script type="text/javascript"><!-- //
    !window.jQuery && document.write(unescape('%3Cscript src="//static.qgov.net.au/assets/v2/script/jquery-1.7.2.min.js"%3E%3C/script%3E'));
  // --></script>
    <script type="text/javascript" src="//static.qgov.net.au/assets/v2/script/qgov-environment.js" id="qgov-environment"></script>
  <!--[if lt IE 9]>
  <script type="text/javascript">document.createElement('abbr');document.createElement('time');</script>
  <script type="text/javascript" src="//static.qgov.net.au/assets/v2/script/ie-layout.js"></script>
  <![endif]-->
  <link type="text/css"
    href="<?php echo $papiDomainAndContext."/ui/minicart_1.0.css"?>"
    rel="stylesheet" />

  <link type="text/css" rel="stylesheet" href="<?php echo $papiDomainAndContext."/minicart/synchronise?cartId="?><?php echo $cartId;?>" />
  <script  src="<?php echo $papiDomainAndContext."/minicart/contents_1.0.js"?>"
    type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo $papiDomainAndContext."/outage/outage_warnings.js"?>"></script>
</head>

<body id="qld-gov-au" class="cart">
  

<!-- noindex -->
  <!--[if lt IE 9]><script type="text/javascript">jQuery && jQuery.transformer({addClasses:true});</script><![endif]-->
  
  <div id="access">
    <h2>Skip links and keyboard navigation</h2>
    <ul>
      <li><a href="#content">Skip to content</a></li>
      <!-- <li><a href="#nav-site">Skip to site navigation</a></li>
      <li><a href="#footer">Skip to footer</a></li> -->
      <li id="access-instructions"><a href="//www.qld.gov.au/help/accessibility/keyboard.html#section-aria-keyboard-navigation">Use tab and cursor keys to move around the page (more information)</a></li>
    </ul>
  </div>

  <div id="header-wrapper"><div id="header"><div id="header-bg"></div><div class="box-sizing"><div class="max-width">
    <h2>Site header</h2>

    <div id="qg-coa"><a href="//www.qld.gov.au/">
      <!--[if gte IE 7]><!--><img src="//static.qgov.net.au/assets/v2/images/skin/qg-coa.png" width="287" height="50" alt="Queensland Government home" /><!--<![endif]-->
      <!--[if lte IE 6]><img src="//static.qgov.net.au/assets/v2/images/skin/qg-coa-ie6.png" width="287" height="50" alt="Queensland Government home" /><![endif]-->
      <img src="//static.qgov.net.au/assets/v2/images/skin/qg-coa-print.png" class="print-version" alt="" />
    </a></div>

    <ul id="tools">
      <li class="nav-contact"><a accesskey="4" href="//www.qld.gov.au/contact-us/">Contact us</a></li>
      <li class="last-child" id="header-search">
        <form action="http://pan.search.qld.gov.au/search/search.cgi" id="search-form">
          <div>
            <label for="search-query">Search website</label>
            <input accesskey="5" type="search" name="query" id="search-query" size="27" value="" />
            <input id="search-button" type="image" src="//static.qgov.net.au/assets/v2/images/skin/button-search.png" value="Search" />
            <input type="hidden" name="num_ranks" value="10" />
            <input type="hidden" name="tiers" value="off" />
            <input type="hidden" name="collection" value="qld-gov" />
            <input type="hidden" name="profile" value="qld" />
          </div>
        </form>
      </li>
    </ul>

    <div id="nav-site"><ul>
      <li class="nav-residents">
        <a href="//www.qld.gov.au/queenslanders/">For Queenslanders</a>
      </li>
      <li class="nav-business">
        <a href="http://www.business.qld.gov.au/">Business and industry</a>
      </li>
      <!--<li class="nav-non-residents">
        <a href="//www.qld.gov.au/non-residents/">For non-residents</a>
      </li>-->
    </ul></div>

  </div></div></div></div>
<!-- endnoindex -->

  <div id="page-container"><div class="max-width">
    <div id="breadcrumbs">
      <h2>You are here:</h2>
      <ol>
<li class="nav-home"><a href="//www.qld.gov.au/">Queensland Government home</a></li>
<li><a href="//www.qld.gov.au/services/">Services</a></li>
        <!-- TODO breadcrumb? -->
        <li class="last-child"></li>
      </ol>
    </div>

    <div id="content-container">
        <div id="content">
            <div class="article"><div class="box-sizing"><div class="border">
<!-- Global alert -->

<form action="add.php" method="post">
    <ul class="actions">
      <li>
      <strong>
        <input type="submit" value="Add" />
      </strong>
      </li>
<?php
if ($cartId) {?>
      <li>
      <strong>
        <a class="button"
          href="<?php echo $papiDomainAndContext."/minicart/synchronise?cartId=${cartId}&redirectUrl=cart/checkout"?>">
          Checkout
        </a>
      </strong>
    </li>
<?php } ?>

    </ul>
    <script type="text/javascript"><!--     
      document.write('<input type="hidden" name="ssqCartId" value="' + SSQ.cart.id + '" />'); 
    // --></script> 
    
  </form>
  




            </div></div></div><!-- end .article, .box-sizing, .border -->
        </div><!-- end #content -->

        <div id="asides"><div class="box-sizing"><div class="border">
<!-- global aside -->

    <div id="minicart" >
    <div class="inner">
      <div id="ssq-minicart" class="placeholder">
        <h2>Cart</h2>
        <div id="ssq-minicart-view">
          <script type="text/javascript"> <!--
            document.write('<div class="ssq-minicart-loading"><p>Loading <a href="<?php echo $papiDomainAndContext."/cart/view"?>">cart</a>...</p></div>');
            // --> </script>
            
          <noscript>
            <p class="ssq-minicart-noscript">Edit cart or checkout to place your order.</p>
            <div class="ssq-minicart-submit">
              <input type="hidden" id="ssq-cart-contents" name="ssq-cart-contents" value="" /> 
                <a href="<?php echo $papiDomainAndContext."/cart/checkout"?>" id="ssq-cart-checkout"><img id="ssq_minicart_checkout" src="<?php echo $papiDomainAndContext."/minicart/btn-checkout.png"?>" alt="Checkout" /></a>
                <a href="<?php echo $papiDomainAndContext."/cart/view"?>" id="ssq-cart-edit"><img id="ssq_minicart_cart" src="<?php echo $papiDomainAndContext."/minicart/btn-cart.png"?>" alt="Edit cart" /></a>
            </div>
          </noscript>
        </div>
        <div class="ssq-minicart-cards">
          <h3>Cards accepted</h3>
          <ul>
            <li><img src="<?php echo $papiDomainAndContext."/minicart/visa.png"?>" alt="Visa" /></li>
            <li><img src="<?php echo $papiDomainAndContext."/minicart/mastercard.png"?>" alt="MasterCard" /></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
            
        </div></div></div><!-- end #asides, .box-sizing, .border -->

        <div id="meta-wrapper"><div class="meta-box-sizing"><div class="border">

            <div id="document-properties"><div class="box-sizing">
                <dl>
                    <dt>Last updated</dt>
                    <dd>???</dd>
                </dl>
            </div></div>

<!-- noindex -->
<div id="post-page-options" class="page-options">
  <ul>
    <!-- <li class="subscribe"><a href="404.html"><img alt="Subscribe" src="//static.qgov.net.au/assets/v2/images/skin/button-subscribe.png" /></a></li>-->
    <li class="share">
      <!-- <img src="//static.qgov.net.au/assets/v2/images/skin/button-share-share.png" alt="Share: " />-->
            <h2>Share:</h2>
      <a href="//www.qld.gov.au/share/?via=facebook&amp;title=Cart" title="Share using Facebook"><img src="//static.qgov.net.au/assets/v2/images/skin/button-share-facebook.png" alt="Share using Facebook" /></a>
      <a href="//www.qld.gov.au/share/?via=twitter&amp;title=Cart" title="Share using Twitter"><img src="//static.qgov.net.au/assets/v2/images/skin/button-share-twitter.png" alt="Share using Twitter" /></a>
      <a href="//www.qld.gov.au/share/?via=linkedin&amp;title=Cart" title="Share using LinkedIn"><img src="//static.qgov.net.au/assets/v2/images/skin/button-share-linkedin.png" alt="Share using LinkedIn" /></a>
      <a href="//www.qld.gov.au/share/?title=Cart" title="Share using another service..."><img src="//static.qgov.net.au/assets/v2/images/skin/button-share-more.png" alt="Share using another service..." /></a>
    </li>
  </ul>
</div>

<div id="page-feedback">
  <form method="post" action="//www.qld.gov.au/assets/apps/feedback/feedback.jsp" class="form">
    <h2>Page feedback</h2>

    <div id="page-feedback-privacy" class="preamble">
      <h3>Your privacy</h3>
      <p>Information collected through this form is used to improve this website.</p>
      <p>Any information you submit that could identify you (e.g. name, email address) will be stored securely, and destroyed after we process your feedback.</p>
    </div>

    <ol class="questions">
      <li id="page-was-useful">
        <fieldset>
          <legend>
            <span class="label">This page was</span>
          </legend>
          <ul class="choices compact">
            <li>
              <input type="radio" name="useful" id="useful-yes" value="yes" /> 
              <label for="useful-yes">Useful</label>
            </li>
            <li>
              <input type="radio" name="useful" id="useful-no" value="no" /> 
              <label for="useful-no">Not useful</label>
            </li>
          </ul>
        </fieldset>
      </li>
      <li class="instruction">
        <p>We want this information to be the best it can be and we know we can't do it without you.
        Let us know what you thought of this page and what other information you would like to see.</p>
        <p>We do not reply to feedback. <a href="//www.qld.gov.au/contact-us/">Contact us if you need a response</a>.</p>
      </li>

      <li>
        <label for="comments">
          <span class="label">Other comments</span>
        </label>
        <textarea name="comments" id="comments" cols="50" rows="7"></textarea>
      </li>

      <li class="section">
        <fieldset id="feedback-contact">
          <legend>
            <span class="h3">Contact (optional)</span>
          </legend>
          <ol class="questions">
            <li>
              <label for="contact">
                <span class="label">Please provide your <strong>phone number</strong> or <strong>email address</strong> if you are happy for us to contact you with any follow-up questions</span>
              </label>
              <input type="text" value="" name="contact" id="contact" size="48" />
            </li>
          </ol>
        </fieldset>
      </li>

      <li id="captcha-container">
        <label for="captcha">Please leave this blank (this helps us identify automatic spam)</label>
        <input type="text" name="captcha" id="captcha" value="" />
      </li>

      <li class="footer">
        <input type="hidden" name="franchise" id="franchise" value="" />
        <input type="hidden" name="page-title" id="page-title" value="" />
        <ul class="actions">
          <li><strong><input type="submit" value="Submit feedback" /></strong></li>
        </ul>
      </li>
    </ol>
  </form>
</div>
<!-- endnoindex -->

        </div></div></div><!-- end #meta-wrapper, .meta-box-sizing, .border -->

    </div><!-- end #content-container -->

<div id="nav-section">
<!--  <div class="box-sizing">
    <h2><a href="/disability/">People with disability</a></h2>
    <ul>
      <li><a href="/disability/children-young-people/">Support for children and young people</a></li>
      <li><a href="/disability/adults/">Support for adults</a></li>
      <li><a href="/disability/families-carers-friends/">Support for families, carers and friends</a></li>
      <li><a href="/disability/out-and-about/">Getting out and about</a></li>
      <li><a href="/disability/legal-and-rights/">Legal information and your rights</a></li>
      <li><a href="/disability/community/">For the community and business</a></li>
      <li><a href="/disability/service-providers/">For service providers</a></li>
    </ul>
  </div> -->
</div>

  </div></div><!-- end #page-container, .max-width -->

<div id="footer">
  <!-- noindex -->
  <div id="fat-footer">
    <div class="max-width"><div class="box-sizing">
      <h2>Explore this site</h2>
      <div class="section">
        <h3><a href="//www.qld.gov.au/">Queensland Government</a></h3>
        <ul>
          <li><a href="//www.qld.gov.au/about/contact-government/contacts/">Government contacts</a></li>
          <li><a href="//www.qld.gov.au/about/contact-government/have-your-say/">Have your say</a></li>
          <li><a href="//www.qld.gov.au/about/staying-informed/">Staying informed</a></li>
          <li><a href="//www.qld.gov.au/about/government-jobs/">Government jobs</a></li>
          <li><a href="//www.qld.gov.au/about/how-government-works/">How government works</a></li>
        </ul>
      </div>
      <div class="section" id="for-qldrs">
        <h3><a href="//www.qld.gov.au/queenslanders/">For Queenslanders</a></h3>
        <ul>
          <li><a href="//www.qld.gov.au/transport/">Transport and motoring</a></li>
          <li><a href="//www.qld.gov.au/jobs/">Employment and jobs</a></li>
          <li><a href="//www.qld.gov.au/housing/">Homes and housing</a></li>
          <li><a href="//www.qld.gov.au/education/">Education and training</a></li>
          <li><a href="//www.qld.gov.au/community/">Community support</a></li>
          <li><a href="//www.qld.gov.au/health/">Health and wellbeing</a></li>
          <li><a href="//www.qld.gov.au/emergency/">Emergency services and safety</a></li>
          <li><a href="//www.qld.gov.au/about/">About Queensland and its government</a></li>
        </ul>
        <ul>
          <li><a href="//www.qld.gov.au/families/">Parents and families</a></li>
          <li><a href="//www.qld.gov.au/disability/">People with disability</a></li>
          <li><a href="//www.qld.gov.au/seniors/">Seniors</a></li>
          <li><a href="//www.qld.gov.au/atsi/">Aboriginal and Torres Strait Islander peoples</a></li>
          <li><a href="//www.qld.gov.au/youth/">Youth</a></li>
          <li><a href="//www.qld.gov.au/environment/">Environment, land and water</a></li>
          <li><a href="//www.qld.gov.au/law/">Your rights, crime and the law</a></li>
          <li><a href="//www.qld.gov.au/recreation/">Recreation, sports and arts</a></li>
        </ul>
      </div>
      <div class="section">
        <h3><a href="http://www.business.qld.gov.au/">Business and industry</a></h3>
        <ul>
          <li><a href="http://www.business.qld.gov.au/getting-into-business.html">Getting into business</a></li>
          <li><a href="http://www.business.qld.gov.au/running-a-business.html">Running a business</a></li>
          <li><a href="http://www.business.qld.gov.au/employing-people.html">Employing people</a></li>
          <li><a href="http://www.business.qld.gov.au/trade-and-investment.html">Trade and investment</a></li>
          <li><a href="http://www.business.qld.gov.au/industry-sectors.html">Industry sectors</a></li>
          <li><a href="http://www.business.qld.gov.au/regional-queensland.html">Regional Queensland</a></li>
        </ul>
      </div>
      <div class="section">
        <!-- For non-residents -->
      </div>
    </div></div>
  </div>
  <div class="max-width"><div class="box-sizing">
    <h2>Site footer</h2>
    <ul>
      <li id="link-help"><a href="//www.qld.gov.au/help/">Help</a></li>
      <!--<li id="link-legal"><a href="//www.qld.gov.au/legal/">Terms and conditions</a></li>-->
      <li class="legal"><a href="//www.qld.gov.au/legal/copyright/">Copyright</a></li>
      <li class="legal"><a href="//www.qld.gov.au/legal/disclaimer/">Disclaimer</a></li>
      <li class="legal"><a href="//www.qld.gov.au/legal/privacy/">Privacy</a></li>
      <li class="legal"><a href="//www.qld.gov.au/right-to-information/">Right to information</a></li>
      <li id="link-accessibility"><a href="//www.qld.gov.au/help/accessibility/">Accessibility</a></li>
      <li id="link-jobs"><a href="https://smartjobs.qld.gov.au/">Jobs in Queensland Government</a></li>
      <li id="link-languages"><a href="//www.qld.gov.au/languages/">Other languages</a></li>
    </ul>
    <!-- endnoindex -->
    <p class="legal"></p>
    <p><a href="//www.qld.gov.au/" accesskey="1">Queensland Government</a></p>
    <div id="qg-branding"><p><img class="tagline" src="//static.qgov.net.au/assets/v2/images/skin/tagline.png" alt="Great state. Great opportunity." /></p></div>
  </div></div>
</div>

    
  
<div id="scripts">
  <script type="text/javascript" src="//static.qgov.net.au/assets/v2/script/loader.js"></script>
  <script type="text/javascript" src="//static.qgov.net.au/assets/v2/script/init.js"></script>
  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
  <script  src="<?php echo $papiDomainAndContext."/ui/minicart_1.0.js"?>" type="text/javascript"></script>
</div>
</body>
</html>
