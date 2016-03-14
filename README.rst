=================================
Datec Notdienst-Apotheken Anzeige
=================================
Scripte für das laden und anzeigen(HTML) von Apotheken Notdienst Informationen (XML) 

LIZENZBEDINGUNGEN
-----------------
| Das XML-Notdienstportal ist frei verwendbar.
| Es ist nicht gestattet den Link auf Datentechnik Schmidt GmbH zu entfernen.

Installation
------------
Entpacken Sie die Datei an einen beliebigen Pfad auf Ihrem Server.

Fügen Sie an der gewünschten Stelle in Ihrem HTML Code folgendes ein:

<iframe src="<Ihr Installationspfad>/datec-emergency-pharmacies-viewer-master/index.php"></iframe>

Oder verweisen Sie auf folgende Datei:

<Ihr Installationspfad>/datec-emergency-pharmacies-viewer-master/index.php

URL für die Schnittstellen
--------------------------
Damit das XML-Notdienstportal die Daten aus der XML-Schnittstelle des Notdienstplaners laden kann, müssen Sie sich von der 
gewünschten Apothekerkammer einen Link generieren lassen. 
Gehen Sie dazu auf die Homepage der gewünschten Apothekenkammer, dann auf Notdienstportal, XML-Schnittstelle und dort geben Sie die benötigten Informationen an.

Konfiguration
-------------
Dateiname: **Config/config.json**

===================  ==========   ===============================================================================================   ============================================
Eigenschaft          Datentyp     Beschreibung                                                                                      Standartwert
===================  ==========   ===============================================================================================   ============================================
url                  int          URL der Schnittstelle
propertiesXmlPaths   Objekt       Elemente die mit dem angegebenen XPath ausgelesen werden sollen.                                  {"to": ["/container/entries/entry/to"],...}
usecurrentTime       bool         Gibt an ob Apotheken angezeigt werden wo der Notdienst noch nicht geendet hat                     true
toDay                int          Wie viele weitere Tage angezeigt werden sollen                                                    0
phoneRegionPrefix    string       Internationale Telefonvorwahl                                                                     +49
propertiesDisplay    Objekt       Elemente die angezeigt werden und mit HTML Tags umschlossen werden.                               { "name": ["div"], ...}
===================  ==========   ===============================================================================================   ============================================


Hinweis zu propertiesDisplay
----------------------------
Es dürfen nur Eigenschaften eingetragen werden die auch als XPath vorhanden sind.
Sie können ein Array an HTML Tags angeben um einen HTML Baum zu erzeugen.

Hinweis zu propertiesXmlPaths
-----------------------------
Es dürfen nur XML Elemente ausgelesen werden die im XML Baum stehen.

Formatierung mit CSS
--------------------
Die einzelnen Klassen der HTML Tags müssen noch mit CSS formatiert werden.
Für die XML Elemente werden CSS Klassen aus den jeweiligen Elementen generiert.

Schnittstellenspezifische Konfiguration
---------------------------------------
Je nach Schnittstelle gibt es verschiedene Elemente die zur Anzeige gebracht werden können.
Die genaue Bezeichnung der Elemente kann aus der XML Datei ausgelesen werden.

Probleme / Fragen / Anmerkungen
-----------------------------
Wenn Sie Probleme, Fragen oder Anmerkungen haben kontaktieren Sie bitte: André Fischer info@datec-schmidt.de  
