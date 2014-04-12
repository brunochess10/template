/*
* Simple Print Plugin 1.0
*
* Copyright (c) 2010 Alejandro Robles Ortega
*
*  jQuery plugin page : http://plugins.jquery.com/project/simplePrint
*  
* Dual licensed under the MIT and GPL licenses:
*   http://www.opensource.org/licenses/mit-license.php
*   http://www.gnu.org/licenses/gpl.html
*/
$.simplePrint = function(selector)
{
    // Crea un nuevo elemento iframe
    printArea = document.createElement('iframe');
    
    // Applies styles to hide the item set
    $(printArea).attr({style: 'border:0;position:absolute;width:0px;height:0px;left:0px;top:0px;'});
    
    // Add the element to document
    document.body.appendChild(printArea);
    
    // Applies the content
    printArea.doc = printArea.contentWindow.document;
    
    // Starts the document, writes data and closes
    printArea.doc.open();
    printArea.doc.write($(selector).html());
    printArea.doc.close();
    
    // Focuses on the item and print launches
    printArea.contentWindow.focus();
    printArea.contentWindow.print();
    
    // Return
    return false;
    
    // Remove the element to document
    document.body.removeChild(printArea);
}