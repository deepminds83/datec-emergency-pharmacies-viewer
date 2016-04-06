=================================
Datec Notdienst-Apotheken Anzeige
=================================
Scripte für das laden und anzeigen(HTML) von Apotheken Notdienst Informationen (XML) 

LIZENZBEDINGUNGEN
-----------------
Das XML-Notdienstportal ist frei verwendbar.
Es ist nicht gestattet den Link auf Datec Schmidt Software GmbH zu entfernen.


Installation
------------
Entpacken Sie die Datei an einen beliebigen Pfad auf Ihrem Server.

Fügen Sie an der gewünschten Stelle in Ihrem HTML Code folgendes ein:

<iframe src="<Ihr Installationspfad>/datec-emergency-pharmacies-viewer-master/index.php"></iframe>

Oder verweisen Sie auf folgende Datei:

<Ihr Installationspfad>/datec-emergency-pharmacies-viewer-master/index.php


(Optional)
Möchten Sie die Ressourcen für mehrere Instanzen mit unterschiedlicher Konfiguration einsetzen, können Sie den Pfad zur Konfigurationsdatei folgenderweise ergänzen.

?configFilePath=<Pfad zur Konfigurationsdatei>.json

Wobei Sie absolute oder relative Dateipfade angeben können.


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
Sie können eine  Liste (Array) an HTML Tags-Namen angeben um einen HTML Baum zu erzeugen.
Oder Geben Sie reines HTML an um z.B. eigene Tags zu definieren, mehrere Eigenschaften zusammenzufassen oder Symbole hinzuzufügen. Sehen Sie sich dazu die Konfiguration für "zipCode" und "location" im Beispiel an.


Hinweis zu propertiesXmlPaths
-----------------------------
Es können nur XML Elemente konfiguriert werden die im XML Baum stehen, prüfen Sie die Richtigkeit der möglichen Pfade.
Alle gelisteten Pfade werden ausgelesen, bis ein Wert zur Anzeige gefunden ist.

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
Wenn Sie Probleme, Fragen oder Anmerkungen haben kontaktieren Sie bitte: André Fischer a.fischer@datec-schmidt.de  
