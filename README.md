qgov-payment-phpclient
======================

This is an unofficial client implementation of the Queensland Government Payment Gateway (PAPI). This client is not owned or supported in any way by the Queensland Government and has no warrenties or guarantees. Feel free to extend, copy or do whatever you want with this client.

__Setup__

Create a file: "/etc/qgov-payment-conf.ini" with your online service configuration.

e.g.

	[webservices]
	username=test
	passphrase=test
	papiDomainAndContext=https://test.smartservice.qld.gov.au/payment
	
	[site]
	#used as base for: shop.php, notify.php and download.php 
	context=/mywebsite
	serviceName=My Service

