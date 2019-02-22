## Algemeen
- [ ] Author meta is aanwezig
- [ ] Grafische controle door designers
- [ ] 'designed by digicreate.be' is aanwezig
- [ ] De klant heeft de logingegevens van het CMS ontvangen
- [ ] De klant heeft een demo van de CMS gekregen
- [ ] Microsoft login (digicreate) werkt voor CMS
- [ ] De URL's uit de vorige site werden uit Screaming Frog gegenereerd
- [ ] De SEO-mapping werd uitgevoerd (vlak voor live plaatsen)
- [ ] Talen werden ingesteld
- [ ] Alle vertalingen werden ingegeven
- [ ] Het contactformulier werd getest
- [ ] Er is een reCAPTCHA aanwezig waar nodig
- [ ] Inschrijven op nieuwsbrief werd getest, alsook eventuele synchronisatie met externe service(s) (bv: Mailchimp)
- [ ] SSL certificaat is aanwezig
- [ ] W3C-validator toont geen fouten meer aan
- [ ] Er werd een Analytics-account aangemaakt of de gegevens werden bij de klant opgevraagd
- [ ] De UA-code staat in de broncode
- [ ] In Analytics werd de opsplitsing gemaakt tussen 'ongefilterde websitegegevens' en 'gefilterde websitegegevens'
- [ ] De website werd gecontroleerd op Anysurfer (indien nodig)
    - [ ] [WCAG AA](https://www.w3.org/WAI/WCAG21/quickref/?currentsidebar=%23col_customize&levels=aaa) of [WCAG Checklist](https://www.wuhcag.com/wcag-checklist/)

## Tijdens Live zetten
- [ ] Klant heeft toegang tot Analytics (incl. Dashboard)

## Na het Live plaatsen
- [ ] `No index no follow` staat niet meer in de broncode
- [ ] Slechts één hoofddomein, alle andere redirecten via een 301-redirect
- [ ] Alle links in RTE-velden (incl. Pagebuilder) werden omgezet van demo naar live
- [ ] De website staat ingeschreven bij Google & Search Console
- [ ] De sitemap (sitemap.xml) werd ingediend bij Search Console
- [ ] In Analytics staat de url op `https://` i.p.v. `http://` (voor elke dataweergave)
- [ ] Alle (belangrijke) issues in Gitlab zijn gesloten
- [ ] De website werd ingediend bij Anysurfer indien van toepassing

## Rapporteren
- [ ] Het Woorank-rapport geeft een score boven de 60%
- [ ] De scores van [https://website.grader.com](Grader) zijn aanvaardbaar
	- [ ] Performance > 20
	- [ ] Mobile = 30
	- [ ] SEO > 20
	- [ ] Security = 10
- [ ] De Google Pagespeed score voor mobiel is > 75 en voor desktop > 80
- [ ] De scores van ssllabs.com moet overal A zijn

## Wettelijke verplichtingen websites
- [ ] De (handels)naam van de zaak word duidelijk vernoemd
- [ ] Het geografisch adres van de zaak wordt meegedeeld
- [ ] Het ondernemingsnummer is aanwezig
- [ ] Er is een mailadres of elektronisch contactformulier aanwezig
- [ ] De rechtsvorm staat voluit of afgekort (enkel verplicht bij vennootschap)
- [ ] De maatschappelijke zetel van de vennootschap wordt meegedeeld
- [ ] Het woord 'Rechtspersonenregister' of RPR en de RPR-locatie is aanwezig
- [ ] Er is een privacy disclaimer of policy aanwezig
- [ ] Cookie banner is aanwezig
- [ ] Elk formulier beschikt over een `checkbox` om akkoord te gaan met de privacy disclaimer of policy
- [ ] Er is een 'Recht om vergeten te worden' formulier aanwezig
- [ ] Er is een 'Recht op inzage' formulier aanwezig

## Webshop
- [ ] De verkoopsvoorwaarden zijn aanwezig (incl. herroepingsrecht en garantievoorwaarden)
- [ ] De klant heeft de mogelijkheid om de verkoopsvoorwaarden te lezen en aanvaarden vooraleer een bestelling kan geplaatst worden
- [ ] De prijzen zijn duidelijk vermeld, indien niet mogelijk moet de prijsberekening worden meegedeeld
- [ ] Alle betaalmogelijkheden worden vermeld
- [ ] Eventuele verzendkosten worden meegedeeld
- [ ] De levertijd van de goederen wordt meegedeeld
- [ ] Alles van bijkomende (retour)kosten wordt meegedeeld
- [ ] 'Nieuwe klant worden' werd getest
- [ ] Er werd een test-bestelling uitgevoerd
	- [ ] Alle mogelijke manieren van bestellen werden getest
	- [ ] Alle mogelijke manieren van betalen werden getest
	- [ ] Alle mogelijke manieren van verzenden werden getest
- [ ] E-mails voor bestellen, betalen, verzenden (etc) zijn correct ingesteld
- [ ] Eventuele geschenkbon(nen) werden uitgetest
- [ ] Eventuele kortingscode(s) werden uitgetest
- [ ] De korting wordt vermeld bij het product
- [ ] Het Euro-teken staat overal **voor** de prijs
- [ ] De webshop-configuratie werd nagekeken, vooral:
	- [ ] Algemeen
		- [ ] Standaard land
		- [ ] Taal & tijdzone zijn correct
		- [ ] Webshop naam
		- [ ] Webshop adres-gegevens
	- [ ] Web
		- [ ] `Base Url`
		- [ ] `Base Url (Secure)`
		- [ ] `Use secure URLs on Storefront` staat aan
	- [ ] Currency Setup
		- [ ] `Currency` staat op Euro
	- [ ] Store Email Addresses
		- [ ] `General Contact`, `Sales Representative` & `Customer Support` zijn correct ingevuld
	- [ ] Contacts
		- [ ] `Sends Email To` is correct ingevuld
	- [ ] GDPR
		- [ ] `Online Dispute Resolution` is correct ingevuld
	- [ ] Sales
		- [ ] `Sales Emails` zijn correct ingevuld
	- [ ] Shipping Settings
		- [ ] `Origin` moet correct ingevuld zijn
	- [ ] Shipping Methods
		- [ ] `Title` en `Method name` van geactiveerde _methods_ moeten juist zijn (vertaling)
		- [ ] `Price` per _method_ is correct ingevuld
		- [ ] `Displayed error message` moet vertaald worden per _method_
- [ ] Marketing
	- [ ] Email templates werden vertaald
- [ ] Bij live plaatsen zijn alle testbetalingen verwijderd en staat de teller op 0

## Content Management
- [ ] Adwords: Alle URL's staan correct ingesteld
- [ ] SEO-Copywriting: Nacontrole _density keywords_ via SEOQuake uitgevoerd

## Nazorg
- [ ] Er werd een review aan de klant gevraagd voor Google en Facebook
- [ ] Er werd een intern evaluatiegesprek gehouden

## Jeeves ToDo's
- [ ] Toevoegen 'checklist issue template'
- [ ] Default 'author' Meta Tag
- [ ] Default 'no index no follow' Meta Tag (!= prod)
- [ ] Remove `User-scalable` override from default layout cfr. AnySurfer
- [ ] Add `NOTIFICATION_MAIL` to generator
- [ ] Console command om url's aan te passen van url X naar url Y

## Magento ToDo's
- [ ] Toevoegen 'checklist issue template'
- [ ] Script om alle testbetalingen/-gegevens te verwijderen
- [ ] Default 'author' Meta Tag
- [ ] Default 'no index no follow' Meta Tag (!= prod)
