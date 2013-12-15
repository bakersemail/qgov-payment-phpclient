qgov-payment-phpclient
======================

Create a file: "/etc/qgov-payment-conf.ini" with your online service configuration.

e.g.

	[webservices]
	username=test
	passphrase=test
	papiDomainAndContext=https://test.smartservice.qld.gov.au/payment
	
	[site]
	#used as base for: shop.php, notify.php and download.php 
	context=/mywebsite

