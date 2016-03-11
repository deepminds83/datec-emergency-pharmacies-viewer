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
Fügen Sie an der gewünschten Stelle in Ihrem HTML Code folgendes ein:

<?php 
 require_once "Controller/EmergenciesController.php"; 
?> 

URL für die Schnittstellen
--------------------------
Damit das XML-Notdienstportal die Daten aus der XML-Schnittstelle des Notdienstplaners laden kann, müssen Sie sich von der 
gewünschten Apothekerkammer einen Link generieren lassen. 
Das können Sie ganz einfach selbst über die Homepage der Apothekerkammer machen.

Konfiguration
-------------
Dateiname:**Config/config.json**

=================    =========    ===============================================================================================   ============================================
Eigenschaft          Datentyp     Beschreibung                                                                                      Standartwert
=================    =========    ===============================================================================================   ============================================
url                  int          URL der Schnittstelle
period               array        Array von XPath Strings für den Zeitraum                                                          /notdienste/zeitraum, /notdienstplan/zeitraum 
entry                array        Array von XPath Strings für die Apotheken einträgen                                               /container/entries/entry, /notdienste/notdienst, /notdienstplan/notdienste/notdienst 
name                 array        Array von XPath Strings für den Apotheken Namen                                                   /container/entries/entry/name, /notdienste/notdienst/apotheke, /notdienstplan/notdienste/notdienst/apotheke
street               array        Array von XPath Strings für die Straße der Apotheke                                               /container/entries/entry/street, /notdienste/notdienst/strasse, /notdienstplan/notdienste/notdienst/strasse
zipCode              array        Array von XPath Strings für die Postleitzahl der Apotheke                                         /container/entries/entry/zipCode, /notdienste/notdienst/plz, /notdienstplan/notdienste/notdienst/plz
location             array        Array von XPath Strings für den Ort der Apotheke                                                  /container/entries/entry/location, /notdienste/notdienst/ort, /notdienstplan/notdienste/notdienst/ort 
subLocation          array        Array von XPath Strings für den Ortsteil der Apotheke                                             /container/entries/entry/subLocation, /notdienste/notdienst/ortsteil, /notdienstplan/notdienste/notdienst/ortsteil
phone                array        Array von XPath Strings für die Telefonnummer der Apotheke                                        /container/entries/entry/phone, /notdienste/notdienst/telefon, /notdienstplan/notdienste/notdienst/telefon
from                 array        Array von XPath Strings für das Datum und die Urzeit wann der Notdienst der Apotheke beginnt      /container/entries/entry/from       
to                   array        Array von XPath Strings für das Datum und die Uhrzeit bis wann der Notdienst der Apotheke endet   /container/entries/entry/to
lat                  array        Array von XPath Strings für den Breitengrad der Apotheke                                          /container/entries/entry/lat, /notdienste/notdienst/latitude, /notdienstplan/notdienste/notdienst/latitude
lon                  array        Array von XPath Strings für den Längengrad der Apotheke                                           /container/entries/entry/lon, /notdienste/notdienst/longitude, /notdienstplan/notdienste/notdienst/longitude  
date                 array        Array von XPath Strings für das Datum des Notdienstes der Apotheke                                /notdienste/notdienst/datum, /notdienstplan/notdienste/notdienst/datum  
usecurrentTime       bool         Gibt an ob Apotheken wo der Notdienst heute noch nicht geendet hat angezeigt werden               true
toDay                int          Wie viele weitere Tage angezeigt werden sollen                                                    0
phoneRegionPrefix    string       Internationale Telefonvorwahl                                                                     +49
propertiesDisplay    Objekt       Elemente mit HTML Tags die angezeigt werden soll                                                  { "name": ["div"],"street": ["p"],"zipCode": ["span"],"location": ["span"],"phone": ["p","a"],"from": ["div"],"to": ["div"] }
=================    =========    ===============================================================================================   ============================================

Hinweis zu propertiesDisplay
----------------------------
| Es dürfen nur Elemente eingetragen werden die auch als XPath vorhanden sind.
| Sie können ein Array an HTML Tags angeben um einen HTML Baum zu erzeugen

Formatierung mit CSS
--------------------
| Die einzelnen Klassen der HTML Elemente müssen noch mit CSS formatiert werden.
| Für die XML Elemente werden CSS Klassen aus den jeweiligen Elementen generiert.

Schnittstellenspezifische Konfiguration
---------------------------------------
| Je nach Schnittstelle gibt es verschiedene Elemente die zur Anzeige gebracht werden können.
| Die genaue Bezeichnung der Elemente kann aus der XML Datei ausgelesen werden.

Probleme / Fragen / Anmerkungen
-----------------------------
Wenn Sie Probleme, Fragen oder Anmerkungen haben kontaktieren Sie bitte: André Fischer a.fischer@datec-schmidt.de  
